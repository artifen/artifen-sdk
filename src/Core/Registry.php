<?php

declare(strict_types=1);

namespace Artifen\Core;

use Artifen\Contracts\LLMProvider;
use Artifen\Contracts\Agent;
use Artifen\Contracts\Skill;
use Artifen\Contracts\Prompt;

class Registry
{
    private array $providers = [];
    private array $agents = [];
    private array $skills = [];
    private array $prompts = [];
    private ?string $defaultProvider = null;

    public function provider(string $name, ?LLMProvider $instance = null): LLMProvider|Registry
    {
        if ($instance !== null) {
            $this->providers[$name] = $instance;
            $this->defaultProvider ??= $name;
            return $this;
        }
        return $this->providers[$name] ?? throw new \RuntimeException("Provider '$name' not registered");
    }

    public function agent(string $id, ?Agent $instance = null): Agent|Registry
    {
        if ($instance !== null) {
            $this->agents[$id] = $instance;
            return $this;
        }
        return $this->agents[$id] ?? throw new \RuntimeException("Agent '$id' not registered");
    }

    public function skill(string $name, ?Skill $instance = null): Skill|Registry
    {
        if ($instance !== null) {
            $this->skills[$name] = $instance;
            return $this;
        }
        return $this->skills[$name] ?? throw new \RuntimeException("Skill '$name' not registered");
    }

    public function prompt(string $path, ?Prompt $instance = null): Prompt|Registry
    {
        if ($instance !== null) {
            $this->prompts[$path] = $instance;
            return $this;
        }
        return $this->prompts[$path] ?? throw new \RuntimeException("Prompt '$path' not registered");
    }

    public function providers(): array { return $this->providers; }
    public function agents(): array { return $this->agents; }
    public function skills(): array { return $this->skills; }
    public function defaultProvider(): string { return $this->defaultProvider ?? 'deepseek'; }
}
