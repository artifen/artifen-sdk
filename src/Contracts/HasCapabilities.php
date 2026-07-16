<?php

declare(strict_types=1);

namespace Artifen\Contracts;

interface HasCapabilities
{
    public function supportsStreaming(): bool;
    public function supportsVision(): bool;
    public function supportsTools(): bool;
    public function supportsJson(): bool;
    public function supportsEmbeddings(): bool;
    public function capabilities(): array;
}
