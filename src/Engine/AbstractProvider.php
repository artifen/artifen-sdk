<?php

declare(strict_types=1);

namespace Artifen\Engine;

use Artifen\Contracts\{LLMProvider, HasCapabilities};

abstract class AbstractProvider implements LLMProvider, HasCapabilities
{
    protected array $config = [];
    protected int $maxRetries = 3;
    protected int $timeout = 30;

    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    public function supportsStreaming(): bool { return false; }
    public function supportsVision(): bool { return false; }
    public function supportsTools(): bool { return false; }
    public function supportsJson(): bool { return true; }
    public function supportsEmbeddings(): bool { return false; }
    public function capabilities(): array
    {
        return [
            'streaming' => $this->supportsStreaming(),
            'vision' => $this->supportsVision(),
            'tools' => $this->supportsTools(),
            'json' => $this->supportsJson(),
            'embeddings' => $this->supportsEmbeddings(),
        ];
    }

    public function health(): bool
    {
        try {
            return $this->models() !== [];
        } catch (\Throwable) {
            return false;
        }
    }

    public function name(): string
    {
        return str_replace('Provider', '', (new \ReflectionClass($this))->getShortName());
    }

    protected function retry(callable $fn, int $maxRetries = null): mixed
    {
        $maxRetries ??= $this->maxRetries;
        $attempt = 0;
        while (true) {
            try {
                return $fn();
            } catch (\Throwable $e) {
                $attempt++;
                if ($attempt >= $maxRetries) {
                    throw $e;
                }
                usleep(100_000 * (2 ** $attempt));
            }
        }
    }
}
