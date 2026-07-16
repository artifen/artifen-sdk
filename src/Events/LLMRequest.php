<?php
declare(strict_types=1);
namespace Artifen\Events;
class LLMRequest {
    public function __construct(public string $provider, public array $messages) {}
}