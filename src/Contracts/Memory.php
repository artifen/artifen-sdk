<?php

declare(strict_types=1);

namespace Artifen\Contracts;

interface Memory
{
    public function remember(string $key, mixed $value): void;
    public function recall(string $key): mixed;
    public function search(string $query): array;
}
