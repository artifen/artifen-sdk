<?php

declare(strict_types=1);

namespace Artifen\Contracts;

interface ToolRuntime
{
    public function register(Tool $tool): void;
    public function execute(string $name, array $params = []): mixed;
    public function available(): array;
}
