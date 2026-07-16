<?php

declare(strict_types=1);

namespace Artifen\Contracts;

use Artifen\Core\Registry;

interface Kernel
{
    public static function make(): self;
    public function run(string $agent, string $task, ?string $provider = null): Response;
    public function registry(): Registry;
}
