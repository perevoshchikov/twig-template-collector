<?php

namespace Anper\Twig\TemplateCollector\NodeVisitor;

use Anper\Twig\TemplateCollector\Node\EnterContextNode;
use Anper\Twig\TemplateCollector\Node\LeaveContextNode;
use Twig\Environment;
use Twig\Node\ModuleNode;
use Twig\Node\Node;
use Twig\NodeVisitor\NodeVisitorInterface;

class ContextNodeVisitor implements NodeVisitorInterface
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
     * @param Node<Node> $node
     * @param Environment $env
     *
     * @return Node<Node>
     */
    public function enterNode($node, Environment $env): Node
    {
        return $node;
    }

    /**
     * @param Node<Node> $node
     * @param Environment $env
     *
     * @return Node<Node>|null
     */
    public function leaveNode($node, Environment $env): ?Node
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
