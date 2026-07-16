<?php

declare(strict_types=1);

namespace Artifen\Contracts;

interface Skill
{
    public function name(): string;
    public function description(): string;
    public function instructions(): string;
}

interface Memory
{
    public function remember(string $key, mixed $value): void;
    public function recall(string $key): mixed;
    public function search(string $query): array;
}

interface Prompt
{
    public function render(array $variables = []): string;
    public static function fromFile(string $path): self;
}

interface Tool
{
    public function name(): string;
    public function execute(array $params): mixed;
    public function schema(): array;
}
