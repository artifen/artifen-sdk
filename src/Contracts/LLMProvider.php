<?php

declare(strict_types=1);

namespace Artifen\Contracts;

interface LLMProvider
{
    public function chat(array $messages, array $options = []): string;
    public function stream(array $messages, callable $onChunk): void;
    public function embeddings(string $input): array;
    public function models(): array;
    public function health(): bool;
    public function name(): string;
}
