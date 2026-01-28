<?php

namespace App\Services\Chatbot;

use App\Models\ChatMessage;
use App\Models\Conversation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ChatbotService
{
    private RAGService $ragService;

    public function __construct(RAGService $ragService)
    {
        $this->ragService = $ragService;
    }

    /**
     * Process chat message (NO USER)
     */
    public function processMessage(string $message, ?string $conversationId = null): array
    {
        DB::beginTransaction();

        try {
            // 1. User context mặc định (không cá nhân hóa)
            $userContext = $this->getGuestContext();

            // 2. Create conversation nếu chưa có
            if (! $conversationId) {
                $conversationId = $this->createConversation($message);
            }

            // 3. Save user message
            $this->saveMessage($conversationId, 'user', $message);

            // 4. Generate response
            $result = $this->ragService->generateResponse($message, $userContext);

            // 5. Save assistant message
            $this->saveMessage(
                $conversationId,
                'assistant',
                $result['response'],
                $result['sources']
            );

            // 6. Update conversation timestamp
            $this->updateConversation($conversationId);

            DB::commit();

            return [
                'response' => $result['response'],
                'sources' => $result['sources'],
                'conversation_id' => $conversationId,
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Chat processing error: '.$e->getMessage());
            throw $e;
        }
    }

    /**
     * Guest context (no login)
     */
    private function getGuestContext(): array
    {
        return [
            'level' => 'Intermediate',
            'targetScore' => null,
            'completedLessons' => 0,
        ];
    }

    /**
     * Create new conversation
     */
    private function createConversation(string $firstMessage): string
    {
        $conversationId = 'conv_'.uniqid();
        $title = mb_substr($firstMessage, 0, 100);

        Conversation::create([
            'id' => $conversationId,
            'title' => $title,
        ]);

        return $conversationId;
    }

    /**
     * Update conversation timestamp
     */
    private function updateConversation(string $conversationId): void
    {
        Conversation::where('id', $conversationId)->touch();
    }

    /**
     * Save message
     */
    private function saveMessage(
        string $conversationId,
        string $role,
        string $content,
        ?array $metadata = null
    ): void {
        ChatMessage::create([
            'conversation_id' => $conversationId,
            'role' => $role,
            'content' => $content,
            'metadata' => $metadata,
        ]);
    }

    /**
     * Get conversation history
     */
    public function getConversationHistory(string $conversationId, int $limit = 20): array
    {
        return ChatMessage::where('conversation_id', $conversationId)
            ->orderBy('created_at', 'asc')
            ->limit($limit)
            ->get()
            ->map(fn ($message) => [
                'id' => $message->id,
                'role' => $message->role,
                'content' => $message->content,
                'metadata' => $message->metadata,
                'created_at' => $message->created_at->toIso8601String(),
            ])
            ->toArray();
    }

    /**
     * Get conversations (NO USER)
     */
    public function getConversations(int $limit = 20): array
    {
        return Conversation::orderBy('updated_at', 'desc')
            ->limit($limit)
            ->get()
            ->map(fn ($conv) => [
                'id' => $conv->id,
                'title' => $conv->title,
                'created_at' => $conv->created_at->toIso8601String(),
                'updated_at' => $conv->updated_at->toIso8601String(),
            ])
            ->toArray();
    }

    /**
     * Delete conversation (NO USER)
     */
    public function deleteConversation(string $conversationId): bool
    {
        return Conversation::where('id', $conversationId)->delete() > 0;
    }
}
