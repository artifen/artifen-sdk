<?php

declare(strict_types=1);

namespace Artifen\Contracts;

interface Prompt
{
    public function path(): string;
    public function render(array $variables = []): string;
    public static function fromFile(string $path): self;
}
