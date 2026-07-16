<?php

declare(strict_types=1);

namespace Artifen\Core;

class Kernel
{
    public function __construct(
        private array $providers = [],
        private array $agents = [],
        private array $skills = [],
    ) {}

    public function registerProvider(string $name, object $provider): self
    {
        $this->providers[$name] = $provider;
        return $this;
    }

    public function registerAgent(object $agent): self
    {
        $this->agents[$agent->id()] = $agent;
        return $this;
    }

    public function registerSkill(object $skill): self
    {
        $this->skills[$skill->name()] = $skill;
        return $this;
    }

    public function provider(string $name): ?object
    {
        return $this->providers[$name] ?? null;
    }

    public function agent(string $id): ?object
    {
        return $this->agents[$id] ?? null;
    }
}
