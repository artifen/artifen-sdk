<?php

declare(strict_types=1);

namespace Artifen\Core;

use Artifen\Contracts\{Kernel as KernelInterface, LLMProvider, Agent, Skill, Prompt, Response, Context};
use Artifen\Core\{Registry, DefaultResponse};
use Artifen\Pipeline\ExecutionPipeline;

class Kernel implements KernelInterface
{
    private Registry $registry;
    private ExecutionPipeline $pipeline;
    private array $options = [];

    public function __construct()
    {
        $this->registry = new Registry();
        $this->pipeline = new ExecutionPipeline();
    }

    public static function make(): self
    {
        return new self();
    }

    public function provider(string $name, LLMProvider $instance): self
    {
        $this->registry->provider($name, $instance);
        return $this;
    }

    public function agent(Agent $instance): self
    {
        $this->registry->agent($instance->id(), $instance);
        return $this;
    }

    public function skill(Skill $instance): self
    {
        $this->registry->skill($instance->name(), $instance);
        return $this;
    }

    public function prompt(Prompt $instance): self
    {
        $this->registry->prompt($instance->path(), $instance);
        return $this;
    }

    public function with(string $key, mixed $value): self
    {
        $this->options[$key] = $value;
        return $this;
    }

    public function run(string $agent, string $task, ?string $provider = null): Response
    {
        $provider ??= $this->registry->defaultProvider();
        $providerInstance = $this->registry->provider($provider);

        $agentInstance = $this->registry->agent($agent);
        $prompt = $this->registry->prompt("agents/{$agent}");

        $start = microtime(true);
        $context = $this->pipeline
            ->addStage('prompt', fn($ctx) => [...$ctx, 'prompt' => $prompt->render(['task' => $task])])
            ->addStage('llm', fn($ctx) => [...$ctx, 'raw' => $providerInstance->chat(
                [['role' => 'user', 'content' => $ctx['prompt']]],
                ['temperature' => 0.7] + $this->options
            )])
            ->execute(['task' => $task, 'agent' => $agent, 'provider' => $provider]);
        $duration = microtime(true) - $start;

        $raw = (string) ($context['raw'] ?? '');

        return new DefaultResponse(
            content: $raw,
            success: $raw !== '',
            duration: $duration,
            tokens: 0,
            provider: $provider,
            model: $providerInstance->models()[0] ?? 'unknown',
            meta: $context,
        );
    }

    public function registry(): Registry
    {
        return $this->registry;
    }
    public function llm()
    {
        return $this->registry;
    }
}
