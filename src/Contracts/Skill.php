<?php

declare(strict_types=1);

namespace Artifen\Contracts;

interface Skill
{
    public function name(): string;
    public function description(): string;
    public function instructions(): string;
}
