<?php

namespace Anper\Twig\TemplateCollector\Extension;

use Anper\Twig\TemplateCollector\Context;
use Anper\Twig\TemplateCollector\NodeVisitor\ContextNodeVisitor;
use Twig\Extension\AbstractExtension;
use Twig\Source;

class CollectContextExtension extends AbstractExtension
{
    /**
     * @var int
     */
    protected $counter = 0;

    /**
     * @var array|int[]
     */
    protected $parents = [];

    /**
     * @var callable
     */
    protected $collector;

    /**
     * @param callable $collector
     */
    public function __construct(callable $collector)
    {
        $this->collector = $collector;
    }

    /**
     * @param Source $source
     * @param array<string,mixed> $context
     */
    public function enter(Source $source, array $context): void
    {
        $profile = new Context($source, ++$this->counter, $context);
        $profile->setParent(\end($this->parents) ?: 0);

        $this->parents[] = $this->counter;

        ($this->collector)($profile);
    }

    public function leave(): void
    {
        \array_pop($this->parents);
    }

    /**
     * @inheritDoc
     */
    public function getNodeVisitors(): array
    {
        return [
            new ContextNodeVisitor(static::class)
        ];
    }
}
