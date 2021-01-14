<?php

namespace Anper\Twig\TemplateCollector\NodeVisitor;

use Anper\Twig\TemplateCollector\Node\EnterContextNode;
use Anper\Twig\TemplateCollector\Node\LeaveContextNode;
use Twig\Environment;
use Twig\Node\ModuleNode;
use Twig\Node\Node;
use Twig\NodeVisitor\AbstractNodeVisitor;
use Twig\NodeVisitor\NodeVisitorInterface;
use Anper\Twig\TemplateCollector\NodeInterface;
use Twig_Environment;
use Twig_Node;

class ContextNodeVisitor extends AbstractNodeVisitor
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
    protected function doEnterNode(Node $node, Twig_Environment $env)
    {
        return $node;
    }

    /**
     * @inheritDoc
     */
    protected function doLeaveNode(Node $node, Twig_Environment $env)
    {
        if ($node instanceof ModuleNode) {
            $this->setNodes($node);
        }

        return $node;
    }

    /**
     * @inheritDoc
     */
    public function getPriority()
    {
        return 0;
    }

    /**
     * @param ModuleNode<Node> $node
     */
    protected function setNodes(ModuleNode $node): void
    {
        $node->setNode('display_start', new Node([
            new EnterContextNode($this->extensionName),
            $node->getNode('display_start')
        ]));

        $node->setNode('display_end', new Node([
            new LeaveContextNode($this->extensionName),
            $node->getNode('display_end')
        ]));
    }
}
