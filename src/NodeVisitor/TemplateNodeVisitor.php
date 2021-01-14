<?php

namespace Anper\Twig\TemplateCollector\NodeVisitor;

use Anper\Twig\TemplateCollector\Node\EnterTemplateNode;
use Twig\Environment;
use Twig\Node\ModuleNode;
use Twig\Node\Node;
use Twig\NodeVisitor\AbstractNodeVisitor;

class TemplateNodeVisitor extends AbstractNodeVisitor
{
    /**
     * @var string
     */
    protected $extensionName;

    /**
     * @param string $extensionName
     */
    public function __construct(string $extensionName)
    {
        $this->extensionName = $extensionName;
    }

    /**
     * @inheritDoc
     */
    protected function doEnterNode(Node $node, Environment $env)
    {
        if ($node instanceof ModuleNode) {
            $node->setNode('constructor_start', new Node([
                new EnterTemplateNode($this->extensionName),
                $node->getNode('constructor_start')
            ]));
        }

        return $node;
    }

    /**
     * @inheritDoc
     */
    protected function doLeaveNode(Node $node, Environment $env)
    {
        return $node;
    }

    /**
     * @inheritDoc
     */
    public function getPriority()
    {
        return 0;
    }
}
