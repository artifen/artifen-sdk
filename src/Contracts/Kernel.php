<?php

declare(strict_types=1);

namespace Artifen\Contracts;

interface Kernel
{
    public function runtime(): AgentRuntime;
    public function llm(): LLMManager;
    public function memory(): MemoryManager;
    public function skills(): SkillEngine;
    public function tools(): ToolRuntime;
    public function prompts(): PromptManager;
}
