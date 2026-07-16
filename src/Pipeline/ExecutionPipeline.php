<?php
declare(strict_types=1);
namespace Artifen\Pipeline;
class ExecutionPipeline {
    private array $stages = [];
    public function addStage(string $name, callable $handler): self {
        $this->stages[$name] = $handler;
        return $this;
    }
    public function execute(array $input): array {
        $context = $input;
        foreach ($this->stages as $handler) {$context = $handler($context);}
        return $context;
    }
}