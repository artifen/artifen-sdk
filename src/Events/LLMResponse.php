<?php
declare(strict_types=1);
namespace Artifen\Events;
class LLMResponse {
    public function __construct(public string $provider, public string $response, public float $duration) {}
}