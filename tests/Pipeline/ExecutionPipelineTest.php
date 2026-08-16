<?php

declare(strict_types=1);

namespace Artifen\Tests\Pipeline;

use PHPUnit\Framework\TestCase;
use Artifen\Pipeline\ExecutionPipeline;

final class ExecutionPipelineTest extends TestCase
{
    public function testExecuteReturnsInputWhenNoStages(): void
    {
        $pipeline = new ExecutionPipeline();
        $this->assertSame(['a' => 1], $pipeline->execute(['a' => 1]));
    }

    public function testStagesExecuteInOrder(): void
    {
        $pipeline = new ExecutionPipeline();
        $order = [];

        $pipeline
            ->addStage('first', function (array $ctx) use (&$order): array {
                $order[] = 'first';
                return [...$ctx, 'first' => true];
            })
            ->addStage('second', function (array $ctx) use (&$order): array {
                $order[] = 'second';
                return [...$ctx, 'second' => true];
            });

        $result = $pipeline->execute(['start' => true]);

        $this->assertSame(['first', 'second'], $order);
        $this->assertTrue($result['first']);
        $this->assertTrue($result['second']);
        $this->assertTrue($result['start']);
    }

    public function testStageReceivesPreviousContext(): void
    {
        $pipeline = new ExecutionPipeline();

        $pipeline
            ->addStage('add', fn(array $ctx): array => [...$ctx, 'value' => 5])
            ->addStage('multiply', fn(array $ctx): array => [...$ctx, 'value' => $ctx['value'] * 2]);

        $result = $pipeline->execute([]);

        $this->assertSame(10, $result['value']);
    }

    public function testAddStageIsFluent(): void
    {
        $pipeline = new ExecutionPipeline();
        $this->assertSame($pipeline, $pipeline->addStage('x', fn(array $ctx): array => $ctx));
    }
}
