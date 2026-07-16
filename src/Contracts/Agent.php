<?php

declare(strict_types=1);

namespace Artifen\Contracts;

interface Agent
{
    public function id(): string;
    public function name(): string;
    public function skills(): array;
    public function run(string $input): string;
    public function withSkill(string $skill): self;
}
