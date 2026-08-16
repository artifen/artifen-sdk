<?php

declare(strict_types=1);

namespace Artifen\Contracts;

interface AgentRuntime
{
    public function run(string $task, array $context = []): AgentResult;
    public function registerAgent(Agent $agent): void;
    public function agent(string $id): ?Agent;
}
