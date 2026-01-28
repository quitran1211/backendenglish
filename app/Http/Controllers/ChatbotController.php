<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChatRequest;
use App\Services\Chatbot\ChatbotService;
use App\Services\Chatbot\RAGService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    private ChatbotService $chatbotService;

    private RAGService $ragService;

    public function __construct(ChatbotService $chatbotService, RAGService $ragService)
    {
        $this->chatbotService = $chatbotService;
        $this->ragService = $ragService;
    }

    /**
     * Send message to chatbot
     *
     * POST /api/chatbot/chat
     */
    public function chat(ChatRequest $request): JsonResponse
    {
        try {
            $message = $request->input('message');
            $conversationId = $request->input('conversation_id');

            $result = $this->chatbotService->processMessage(
                $message,
                $conversationId
            );

            return response()->json([
                'success' => true,
                'data' => $result,
            ]);

        } catch (\Exception $e) {
            Log::error('Chat API error: '.$e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'success' => false,
                'error' => 'Không thể xử lý tin nhắn.',
                'message' => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }
    }

    /**
     * Get user conversations
     *
     * GET /api/chatbot/conversations
     */
    public function getConversations(Request $request): JsonResponse
    {
        try {
            $limit = $request->input('limit', 20);

            $conversations = $this->chatbotService->getUserConversations($limit);

            return response()->json([
                'success' => true,
                'data' => $conversations,
            ]);

        } catch (\Exception $e) {
            Log::error('Get conversations error: '.$e->getMessage());

            return response()->json([
                'success' => false,
                'error' => 'Không thể tải danh sách hội thoại',
            ], 500);
        }
    }

    /**
     * Get conversation history
     *
     * GET /api/chatbot/conversations/{id}
     */
    public function getConversationHistory(string $id): JsonResponse
    {
        try {
            $messages = $this->chatbotService->getConversationHistory($id);

            return response()->json([
                'success' => true,
                'data' => $messages,
            ]);

        } catch (\Exception $e) {
            Log::error('Get conversation history error: '.$e->getMessage());

            return response()->json([
                'success' => false,
                'error' => 'Không thể tải lịch sử hội thoại',
            ], 500);
        }
    }

    /**
     * Delete conversation
     *
     * DELETE /api/chatbot/conversations/{id}
     */
    public function deleteConversation(string $id): JsonResponse
    {
        try {
            $deleted = $this->chatbotService->deleteConversation($id);

            if (! $deleted) {
                return response()->json([
                    'success' => false,
                    'error' => 'Không tìm thấy hội thoại',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Đã xóa hội thoại',
            ]);

        } catch (\Exception $e) {
            Log::error('Delete conversation error: '.$e->getMessage());

            return response()->json([
                'success' => false,
                'error' => 'Không thể xóa hội thoại',
            ], 500);
        }
    }

    /**
     * Get RAG statistics
     *
     * GET /api/chatbot/stats
     */
    public function getStats(): JsonResponse
    {
        try {
            $stats = $this->ragService->getStats();

            return response()->json([
                'success' => true,
                'data' => $stats,
            ]);

        } catch (\Exception $e) {
            Log::error('Get stats error: '.$e->getMessage());

            return response()->json([
                'success' => false,
                'error' => 'Không thể tải thống kê',
            ], 500);
        }
    }
}
