<?php

declare(strict_types=1);

namespace Artifen\Contracts;

interface PipelineStage
{
    public function name(): string;
    public function handle(array $context): array;
}
