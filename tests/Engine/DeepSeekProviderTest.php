<?php

declare(strict_types=1);

namespace Artifen\Tests\Engine;

use PHPUnit\Framework\TestCase;
use Artifen\Engine\DeepSeekProvider;
use Artifen\Engine\AbstractProvider;
use Artifen\Contracts\LLMProvider;
use Artifen\Contracts\HasCapabilities;

final class DeepSeekProviderTest extends TestCase
{
    public function testProviderImplementsContracts(): void
    {
        $provider = new DeepSeekProvider(['api_key' => 'test-key']);
        $this->assertInstanceOf(LLMProvider::class, $provider);
        $this->assertInstanceOf(HasCapabilities::class, $provider);
        $this->assertInstanceOf(AbstractProvider::class, $provider);
    }

    public function testProviderName(): void
    {
        $provider = new DeepSeekProvider(['api_key' => 'test-key']);
        $this->assertSame('DeepSeek', $provider->name());
    }

    public function testProviderDefaultCapabilities(): void
    {
        $provider = new DeepSeekProvider(['api_key' => 'test-key']);
        $caps = $provider->capabilities();

        $this->assertIsArray($caps);
        $this->assertArrayHasKey('streaming', $caps);
        $this->assertArrayHasKey('vision', $caps);
        $this->assertArrayHasKey('tools', $caps);
        $this->assertArrayHasKey('json', $caps);
        $this->assertArrayHasKey('embeddings', $caps);
    }

    public function testHealthWithoutApiKeyReturnsFalse(): void
    {
        $provider = new DeepSeekProvider([]);
        $this->assertFalse($provider->health());
    }
}
