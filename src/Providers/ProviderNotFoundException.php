<?php

declare(strict_types=1);

namespace Artifen\Providers;

class ProviderNotFoundException extends \RuntimeException
{
    public function __construct(string $provider)
    {
        parent::__construct("Provider '$provider' not found");
    }
}
