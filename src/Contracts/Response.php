<?php

declare(strict_types=1);

namespace Artifen\Contracts;

interface Response
{
    public function content(): string;
    public function success(): bool;
    public function duration(): float;
    public function tokens(): int;
    public function provider(): string;
    public function model(): string;
    public function meta(string $key, mixed $default = null): mixed;
}
