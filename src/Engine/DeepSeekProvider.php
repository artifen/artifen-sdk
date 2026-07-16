<?php

declare(strict_types=1);

namespace Artifen\Engine;

class DeepSeekProvider extends AbstractProvider
{
    private string $apiKey;
    private string $model;
    private string $baseUrl = 'https://api.deepseek.com/v1';

    public function __construct(array $config = [])
    {
        parent::__construct($config);
        $this->apiKey = $config['api_key'] ?? '';
        $this->model = $config['model'] ?? 'deepseek-chat';
        $this->baseUrl = $config['base_url'] ?? $this->baseUrl;
    }

    public function chat(array $messages, array $options = []): string
    {
        return $this->retry(function () use ($messages, $options) {
            $body = json_encode([
                'model' => $options['model'] ?? $this->model,
                'messages' => $messages,
                'temperature' => $options['temperature'] ?? 0.7,
                'max_tokens' => $options['max_tokens'] ?? 4096,
            ]);

            $ch = curl_init($this->baseUrl . '/chat/completions');
            curl_setopt_array($ch, [
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $body,
                CURLOPT_HTTPHEADER => [
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $this->apiKey,
                ],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => $this->timeout,
            ]);

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $error = curl_error($ch);
            curl_close($ch);

            if ($error) {
                throw new \RuntimeException("DeepSeek request failed: $error");
            }

            $data = json_decode($response, true);

            if ($httpCode !== 200) {
                throw new \RuntimeException(
                    "DeepSeek API error ($httpCode): " . ($data['error']['message'] ?? $response)
                );
            }

            return $data['choices'][0]['message']['content'] ?? '';
        });
    }

    public function stream(array $messages, callable $onChunk): void
    {
        throw new \RuntimeException('Streaming not supported yet');
    }

    public function embeddings(string $input): array
    {
        throw new \RuntimeException('Embeddings not supported yet');
    }

    public function models(): array
    {
        $ch = curl_init($this->baseUrl . '/models');
        curl_setopt_array($ch, [
            CURLOPT_HTTPHEADER => ['Authorization: Bearer ' . $this->apiKey],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 10,
        ]);
        $response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($response, true);
        return $data['data'] ?? [];
    }

    public function supportsStreaming(): bool { return false; }
    public function supportsJson(): bool { return true; }
}
