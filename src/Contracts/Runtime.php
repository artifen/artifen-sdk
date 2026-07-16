<?php

declare(strict_types=1);

namespace Artifen\Contracts;

interface AgentRuntime
{
    public function run(string $task, array $context = []): AgentResult;
    public function registerAgent(Agent $agent): void;
    public function agent(string $id): ?Agent;
}

interface AgentResult
{
    public function output(): string;
    public function success(): bool;
    public function duration(): float;
    public function tokens(): int;
    public function logs(): array;
}

interface MemoryManager
{
    public function remember(string $namespace, string $key, mixed $value): void;
    public function recall(string $namespace, string $key): mixed;
    public function search(string $namespace, string $query): array;
    public function forget(string $namespace, string $key): void;
}

interface SkillEngine
{
    public function register(Skill $skill): void;
    public function execute(string $name, array $params = []): mixed;
    public function available(): array;
}

interface ToolRuntime
{
    public function register(Tool $tool): void;
    public function execute(string $name, array $params = []): mixed;
    public function available(): array;
}

interface PromptManager
{
    public function render(string $path, array $variables = []): string;
    public function register(string $name, Prompt $prompt): void;
    public function available(): array;
}
