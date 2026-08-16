<?php

declare(strict_types=1);

namespace Artifen\Contracts;

interface Tool
{
    public function name(): string;
    public function execute(array $params): mixed;
    public function schema(): array;
}
