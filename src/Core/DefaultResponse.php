<?php

declare(strict_types=1);

namespace Artifen\Core;

use Artifen\Contracts\Response;

/**
 * Implémentation concrète par défaut de Response.
 * Produite par Kernel::run() à partir du contexte du pipeline.
 */
final class DefaultResponse implements Response
{
    /** @param array<string, mixed> $meta */
    public function __construct(
        private readonly string $content,
        private readonly bool $success = true,
        private readonly float $duration = 0.0,
        private readonly int $tokens = 0,
        private readonly string $provider = '',
        private readonly string $model = '',
        private readonly array $meta = [],
    ) {
    }

    public function content(): string
    {
        return $this->content;
    }

    public function success(): bool
    {
        return $this->success;
    }

    public function duration(): float
    {
        return $this->duration;
    }

    public function tokens(): int
    {
        return $this->tokens;
    }

    public function provider(): string
    {
        return $this->provider;
    }

    public function model(): string
    {
        return $this->model;
    }

    public function meta(string $key, mixed $default = null): mixed
    {
        return $this->meta[$key] ?? $default;
    }
}
