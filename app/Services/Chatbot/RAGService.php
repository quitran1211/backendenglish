<?php

namespace App\Services\Chatbot;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class RAGService
{
    private Client $client;

    private string $chromaUrl;

    private string $collectionName;

    private EmbeddingService $embeddingService;

    public function __construct(EmbeddingService $embeddingService)
    {
        $this->embeddingService = $embeddingService;
        $this->client = new Client(['timeout' => 30]);
        $this->chromaUrl = config('chatbot.chroma.url');
        $this->collectionName = config('chatbot.chroma.collection_name');
    }

    /**
     * Initialize collection
     */
    public function initialize(): void
    {
        try {
            // Create or get collection
            $this->client->post($this->chromaUrl.'/api/v1/collections', [
                'json' => [
                    'name' => $this->collectionName,
                    'metadata' => ['hnsw:space' => 'cosine'],
                ],
            ]);

            Log::info('ChromaDB collection initialized');

        } catch (\Exception $e) {
            if (! str_contains($e->getMessage(), 'already exists')) {
                Log::error('ChromaDB initialization error: '.$e->getMessage());
            }
        }
    }

    /**
     * Add documents to vector DB
     */
    public function addDocuments(array $documents): array
    {
        $ids = [];
        $texts = [];
        $metadatas = [];

        foreach ($documents as $index => $doc) {
            $ids[] = 'doc_'.time().'_'.$index;
            $texts[] = $doc['content'];
            $metadatas[] = $doc['metadata'];
        }

        // Generate embeddings
        $embeddings = $this->embeddingService->embedBatch($texts);

        // Add to ChromaDB
        try {
            $this->client->post(
                $this->chromaUrl.'/api/v1/collections/'.$this->collectionName.'/add',
                [
                    'json' => [
                        'ids' => $ids,
                        'embeddings' => $embeddings,
                        'documents' => $texts,
                        'metadatas' => $metadatas,
                    ],
                ]
            );

            Log::info('Added '.count($documents).' documents to RAG');

            return $ids;

        } catch (\Exception $e) {
            Log::error('Add documents error: '.$e->getMessage());
            throw $e;
        }
    }

    /**
     * Search similar documents
     */
    public function search(string $query, int $topK = 5): array
    {
        try {
            // Generate query embedding
            $queryEmbedding = $this->embeddingService->embed($query);

            // Query ChromaDB
            $response = $this->client->post(
                $this->chromaUrl.'/api/v1/collections/'.$this->collectionName.'/query',
                [
                    'json' => [
                        'query_embeddings' => [$queryEmbedding],
                        'n_results' => $topK,
                    ],
                ]
            );

            $result = json_decode($response->getBody(), true);

            // Format results
            $documents = [];
            if (isset($result['documents'][0])) {
                foreach ($result['documents'][0] as $index => $doc) {
                    $documents[] = [
                        'content' => $doc,
                        'metadata' => $result['metadatas'][0][$index] ?? [],
                        'distance' => $result['distances'][0][$index] ?? 0,
                    ];
                }
            }

            return $documents;

        } catch (\Exception $e) {
            Log::error('Search error: '.$e->getMessage());

            return [];
        }
    }

    /**
     * Generate response with RAG
     */
    public function generateResponse(string $query, array $userContext = []): array
    {
        try {
            // 1. Search relevant documents
            $relevantDocs = $this->search($query, 5);

            // 2. Build context
            $context = '';
            foreach ($relevantDocs as $index => $doc) {
                $title = $doc['metadata']['title'] ?? 'Document';
                $context .= '[Tài liệu '.($index + 1).": {$title}]\n";
                $context .= $doc['content']."\n\n";
            }

            if (empty($context)) {
                $context = 'Không tìm thấy tài liệu liên quan.';
            }

            // 3. Build prompt
            $systemPrompt = $this->buildSystemPrompt($userContext, $context);

            // 4. Call OpenAI
            $response = $this->callGroq($systemPrompt, $query);

            // 5. Format sources
            $sources = array_slice(
                array_map(fn ($doc) => [
                    'title' => $doc['metadata']['title'] ?? 'Document',
                    'type' => $doc['metadata']['type'] ?? 'unknown',
                ], $relevantDocs),
                0,
                3
            );

            return [
                'response' => $response,
                'sources' => $sources,
            ];

        } catch (\Exception $e) {
            Log::error('Generate response error: '.$e->getMessage());

            return [
                'response' => 'Xin lỗi, hiện tại tôi gặp sự cố kỹ thuật. Vui lòng thử lại sau.',
                'sources' => [],
            ];
        }
    }

    /**
     * Build system prompt
     */
    private function buildSystemPrompt(array $userContext, string $context): string
    {
        $level = $userContext['level'] ?? 'Chưa xác định';
        $targetScore = $userContext['targetScore'] ?? 'Chưa xác định';
        $completedLessons = $userContext['completedLessons'] ?? 0;

        return <<<PROMPT
Bạn là trợ lý AI chuyên về TOEIC. Nhiệm vụ của bạn là giúp học viên học TOEIC hiệu quả.

THÔNG TIN HỌC VIÊN:
- Mức độ: {$level}
- Điểm mục tiêu: {$targetScore}
- Số bài đã hoàn thành: {$completedLessons}

NGUYÊN TẮC TRẢ LỜI:
1. Trả lời bằng tiếng Việt, rõ ràng, dễ hiểu
2. Sử dụng thông tin từ tài liệu được cung cấp
3. Đưa ra ví dụ cụ thể khi có thể
4. Nếu không chắc chắn, hãy thừa nhận
5. Luôn động viên và khích lệ học viên
6. Format câu trả lời với markdown

TÀI LIỆU THAM KHẢO:
{$context}

Hãy dựa vào tài liệu trên để trả lời câu hỏi một cách chính xác nhất.
PROMPT;
    }

    /**
     * Call OpenAI API
     */
    private function callGroq(string $systemPrompt, string $userQuery): string
    {
        $client = new Client([
            'timeout' => 60,
        ]);

        $response = $client->post(
            'https://api.groq.com/openai/v1/chat/completions',
            [
                'headers' => [
                    'Authorization' => 'Bearer '.config('chatbot.groq.api_key'),
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'model' => config('chatbot.groq.model'),
                    'messages' => [
                        ['role' => 'system', 'content' => $systemPrompt],
                        ['role' => 'user', 'content' => $userQuery],
                    ],
                    'temperature' => 0.3,
                    'max_tokens' => 800,
                ],
            ]
        );

        $result = json_decode($response->getBody(), true);

        return $result['choices'][0]['message']['content'] ?? '';
    }

    /**
     * Get stats
     */
    public function getStats(): array
    {
        try {
            $response = $this->client->get(
                $this->chromaUrl.'/api/v1/collections/'.$this->collectionName
            );

            $result = json_decode($response->getBody(), true);

            return [
                'totalDocuments' => $result['count'] ?? 0,
                'collectionName' => $this->collectionName,
            ];

        } catch (\Exception $e) {
            return ['totalDocuments' => 0];
        }
    }
}
