<?php
declare(strict_types=1);
namespace Artifen\Events;
class BeforeAgentRun {
    public function __construct(public string $agentId, public string $task) {}
}
