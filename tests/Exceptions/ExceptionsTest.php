<?php

declare(strict_types=1);

namespace Artifen\Tests\Exceptions;

use PHPUnit\Framework\TestCase;
use Artifen\Exceptions\LLMException;
use Artifen\Exceptions\ProviderException;
use Artifen\Exceptions\PromptException;
use Artifen\Exceptions\RuntimeException;
use Artifen\Exceptions\SkillException;
use Artifen\Providers\ProviderNotFoundException;

final class ExceptionsTest extends TestCase
{
    public function testAllExceptionsExtendBaseException(): void
    {
        $this->assertInstanceOf(\Exception::class, new LLMException('x'));
        $this->assertInstanceOf(\Exception::class, new ProviderException('x'));
        $this->assertInstanceOf(\Exception::class, new PromptException('x'));
        $this->assertInstanceOf(\Exception::class, new RuntimeException('x'));
        $this->assertInstanceOf(\Exception::class, new SkillException('x'));
    }

    public function testProviderNotFoundExceptionExtendsProviderException(): void
    {
        $e = new ProviderNotFoundException('mock');
        $this->assertInstanceOf(ProviderException::class, $e);
        $this->assertSame("Provider 'mock' not found", $e->getMessage());
    }

    public function testExceptionsPreserveMessageAndCode(): void
    {
        $e = new LLMException('LLM call failed', 42);
        $this->assertSame('LLM call failed', $e->getMessage());
        $this->assertSame(42, $e->getCode());
    }
}
