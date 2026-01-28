<?php

namespace App\Services\Chatbot;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class EmbeddingService
{
    private Client $client;

    private string $apiUrl;

    public function __construct()
    {
        $this->client = new Client([
            'timeout' => 30,
            'verify' => false, // Tắt SSL verification cho local dev
        ]);

        $this->apiUrl = config('chatbot.embedding.api_url');
    }

    /**
     * Generate embedding cho 1 text
     */
    public function embed(string $text): array
    {
        try {
            $response = $this->client->post($this->apiUrl.'/embed', [
                'json' => ['text' => $text],
            ]);

            $result = json_decode($response->getBody(), true);

            return $result['embedding'] ?? [];

        } catch (\Exception $e) {
            Log::error('Embedding error: '.$e->getMessage());
            throw new \Exception('Failed to generate embedding');
        }
    }

    /**
     * Generate embeddings cho nhiều texts
     */
    public function embedBatch(array $texts): array
    {
        try {
            $response = $this->client->post($this->apiUrl.'/embed-batch', [
                'json' => ['texts' => $texts],
            ]);

            $result = json_decode($response->getBody(), true);

            return $result['embeddings'] ?? [];

        } catch (\Exception $e) {
            Log::error('Batch embedding error: '.$e->getMessage());
            throw new \Exception('Failed to generate embeddings');
        }
    }
}
