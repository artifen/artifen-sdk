<?php

declare(strict_types=1);

namespace Artifen\Tests\Core;

use PHPUnit\Framework\TestCase;
use Artifen\Core\Kernel;
use Artifen\Core\Registry;
use Artifen\Contracts\LLMProvider;
use Artifen\Contracts\Agent;
use Artifen\Contracts\Skill;
use Artifen\Contracts\Prompt;

final class KernelTest extends TestCase
{
    public function testKernelCanBeInstantiated(): void
    {
        $kernel = new Kernel();
        $this->assertInstanceOf(Kernel::class, $kernel);
    }

    public function testKernelExposesRegistry(): void
    {
        $kernel = new Kernel();
        $this->assertInstanceOf(Registry::class, $kernel->registry());
    }

    public function testRegistryStartsEmpty(): void
    {
        $registry = new Registry();
        $this->assertCount(0, $registry->providers());
        $this->assertCount(0, $registry->agents());
        $this->assertCount(0, $registry->skills());
    }

    public function testRegistryProviderFluentApi(): void
    {
        $registry = new Registry();
        $provider = $this->createMock(LLMProvider::class);

        // Setter (fluent) retourne le Registry
        $return = $registry->provider('mock', $provider);
        $this->assertSame($registry, $return);

        // Getter retourne le provider
        $this->assertSame($provider, $registry->provider('mock'));
        $this->assertCount(1, $registry->providers());
    }

    public function testRegistryThrowsForUnknownProvider(): void
    {
        $registry = new Registry();
        $this->expectException(\RuntimeException::class);
        $registry->provider('does-not-exist');
    }

    public function testRegistryAgentAndSkillRegistration(): void
    {
        $registry = new Registry();
        $agent = $this->createMock(Agent::class);
        $skill = $this->createMock(Skill::class);

        $registry->agent('writer', $agent);
        $registry->skill('seo', $skill);

        $this->assertSame($agent, $registry->agent('writer'));
        $this->assertSame($skill, $registry->skill('seo'));
    }

    public function testDefaultProviderFallsBackToDeepseek(): void
    {
        $registry = new Registry();
        $this->assertSame('deepseek', $registry->defaultProvider());
    }

    public function testFirstRegisteredProviderBecomesDefault(): void
    {
        $registry = new Registry();
        $provider = $this->createMock(LLMProvider::class);
        $registry->provider('openai', $provider);

        $this->assertSame('openai', $registry->defaultProvider());
    }
}
