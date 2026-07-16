<?php

declare(strict_types=1);

namespace Artifen\Contracts;

interface EventDispatcher
{
    public function dispatch(object $event): void;
    public function listen(string $eventClass, callable $listener): void;
}
