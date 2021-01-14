<?php

namespace Anper\Twig\TemplateCollector\Extension;

use Anper\Twig\TemplateCollector\NodeVisitor\TemplateNodeVisitor;
use Anper\Twig\TemplateCollector\Template;
use Twig\Extension\AbstractExtension;
use Twig\Source;

class CollectTemplateExtension extends AbstractExtension
{
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
     */
    public function enter(Source $source): void
    {
        ($this->collector)(new Template($source));
    }

    /**
     * @inheritDoc
     */
    public function getNodeVisitors(): array
    {
        return [
            new TemplateNodeVisitor(static::class)
        ];
    }
}
