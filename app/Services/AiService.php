<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log; // Untuk log ralat jika perlu

class AiService
{
    protected string $apiKey;
    protected string $apiUrl = 'https://api.openai.com/v1/chat/completions'; // Endpoint API Chat Completions

    public function __construct()
    {
        $this->apiKey = config('services.openai.key');

        if (empty($this->apiKey)) {
            // Anda mungkin mahu throw exception atau log ralat di sini
            // Mengikut arahan, kita biarkan mudah dahulu
            Log::error('OpenAI API key not configured.');
        }
    }

    /**
     * Get a reply from OpenAI based on user message and history.
     *
     * @param string $userMessage The user's message.
     * @param array $history Conversation history (array of messages).
     * @param string $model The OpenAI model to use (default: gpt-3.5-turbo).
     * @return string|null The reply from OpenAI or null on failure.
     */
    public function getReply(string $userMessage, array $history = [], string $model = 'gpt-3.5-turbo'): ?string
    {
        if (empty($this->apiKey)) {
            return 'Error: OpenAI API key not configured.'; // Mengembalikan mesej ralat mudah
        }

        // Format mesej mengikut format OpenAI API
        $messages = $history; // History sepatutnya sudah dalam format yang betul
        $messages[] = ['role' => 'user', 'content' => $userMessage];

        $response = Http::withToken($this->apiKey)
            ->timeout(60) // Menetapkan timeout kepada 60 saat
            ->post($this->apiUrl, [
                'model' => $model,
                'messages' => $messages,
                // Anda boleh menambah parameter lain seperti temperature, max_tokens, dll.
                // 'temperature' => 0.7,
                // 'max_tokens' => 150,
            ]);

        if ($response->failed()) {
            Log::error('OpenAI API request failed:', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
            // Mengembalikan mesej ralat jika panggilan API gagal
            return 'Error communicating with AI service. Status: ' . $response->status();
        }

        // Ekstrak jawapan dari respons
        $reply = $response->json('choices.0.message.content');

        return $reply;
    }
} 