<?php
declare(strict_types=1);
namespace Artifen\Events;
class AfterAgentRun {
    public function __construct(public string $agentId, public string $result, public float $duration) {}
}
