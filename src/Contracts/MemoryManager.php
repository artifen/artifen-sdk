<?php

declare(strict_types=1);

namespace Artifen\Contracts;

interface MemoryManager
{
    public function remember(string $namespace, string $key, mixed $value): void;
    public function recall(string $namespace, string $key): mixed;
    public function search(string $namespace, string $query): array;
    public function forget(string $namespace, string $key): void;
}
