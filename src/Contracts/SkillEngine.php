<?php

declare(strict_types=1);

namespace Artifen\Contracts;

interface SkillEngine
{
    public function register(Skill $skill): void;
    public function execute(string $name, array $params = []): mixed;
    public function available(): array;
}
