<?php

declare(strict_types=1);

namespace Artifen\Tests\Providers;

use PHPUnit\Framework\TestCase;
use Artifen\Providers\ProviderFactory;
use Artifen\Providers\ProviderNotFoundException;
use Artifen\Contracts\LLMProvider;

final class ProviderFactoryTest extends TestCase
{
    public function testFactoryStartsEmpty(): void
    {
        $factory = new ProviderFactory();
        $this->assertSame([], $factory->available());
    }

    public function testRegisterAndCreate(): void
    {
        $factory = new ProviderFactory();
        $provider = $this->createMock(LLMProvider::class);

        $factory->register('mock', $provider);

        $this->assertSame(['mock'], $factory->available());
        $this->assertSame($provider, $factory->create('mock'));
    }

    public function testCreateDefaultsToDeepseek(): void
    {
        $factory = new ProviderFactory();
        $provider = $this->createMock(LLMProvider::class);

        $factory->register('deepseek', $provider);

        $this->assertSame($provider, $factory->create());
    }

    public function testCreateThrowsForUnknownProvider(): void
    {
        $factory = new ProviderFactory();
        $this->expectException(ProviderNotFoundException::class);
        $factory->create('unknown');
    }
}
