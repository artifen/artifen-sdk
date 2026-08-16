<?php

declare(strict_types=1);

namespace Artifen\Pipeline;

class ExecutionPipeline
{
    /** @var array<string, callable(array<string,mixed>): array<string,mixed>> */
    private array $stages = [];

    /**
     * @param callable(array<string,mixed>): array<string,mixed> $handler
     */
    public function addStage(string $name, callable $handler): self
    {
        $this->stages[$name] = $handler;
        return $this;
    }

    /**
     * @param array<string,mixed> $input
     * @return array<string,mixed>
     */
    public function execute(array $input): array
    {
        $context = $input;
        foreach ($this->stages as $handler) {
            $context = $handler($context);
        }
        return $context;
    }
}
