<?php

declare(strict_types=1);

namespace Artifen\Providers;

use Artifen\Exceptions\ProviderException;

class ProviderNotFoundException extends ProviderException
{
    public function __construct(string $provider)
    {
        parent::__construct("Provider '$provider' not found");
    }
}
