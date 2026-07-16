<?php

declare(strict_types=1);

namespace Artifen\Providers;

use Artifen\Contracts\LLMProvider;

class ProviderFactory
{
    private array $providers = [];

    public function register(string $name, LLMProvider $provider): void
    {
        $this->providers[$name] = $provider;
    }

    public function create(?string $name = null): LLMProvider
    {
        $name ??= 'deepseek';

        if (!isset($this->providers[$name])) {
            throw new ProviderNotFoundException("Provider '$name' not registered");
        }

        return $this->providers[$name];
    }

    public function available(): array
    {
        return array_keys($this->providers);
    }
}
