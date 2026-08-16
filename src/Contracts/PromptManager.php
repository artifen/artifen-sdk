<?php

declare(strict_types=1);

namespace Artifen\Contracts;

interface PromptManager
{
    public function render(string $path, array $variables = []): string;
    public function register(string $name, Prompt $prompt): void;
    public function available(): array;
}
