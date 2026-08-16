<?php

declare(strict_types=1);

namespace Artifen\Contracts;

interface AgentResult
{
    public function output(): string;
    public function success(): bool;
    public function duration(): float;
    public function tokens(): int;
    public function logs(): array;
}
