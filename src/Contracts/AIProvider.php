<?php

declare(strict_types=1);

namespace Artifen\Contracts;

interface AIProvider
{
    public function name(): string;
    public function isAvailable(): bool;
    public function chat(array $messages, array $options = []): string;
    public function embed(string $input): array;
}
