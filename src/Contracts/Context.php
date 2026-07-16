<?php

declare(strict_types=1);

namespace Artifen\Contracts;

interface Context
{
    public function user(): array;
    public function workspace(): array;
    public function conversation(): array;
    public function environment(): array;
    public function get(string $key, mixed $default = null): mixed;
    public function set(string $key, mixed $value): void;
    public function all(): array;
}
