<?php

namespace Anper\Twig\TemplateCollector\NodeVisitor;

use Anper\Twig\TemplateCollector\Node\EnterContextNode;
use Anper\Twig\TemplateCollector\Node\LeaveContextNode;
use Twig\Environment;
use Twig\Node\ModuleNode;
use Twig\Node\Node;
use Twig\NodeVisitor\AbstractNodeVisitor;

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
     * @param Node<Node> $node
     * @param Environment $env
     *
     * @return Node<Node>
     */
    protected function doEnterNode(Node $node, Environment $env)
    {
        return $node;
    }

    /**
     * @param Node<Node> $node
     * @param Environment $env
     *
     * @return Node<Node>
     */
    protected function doLeaveNode(Node $node, Environment $env)
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
