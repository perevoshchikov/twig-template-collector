<?php

namespace Anper\Twig\TemplateCollector\NodeVisitor;

use Anper\Twig\TemplateCollector\Node\EnterTemplateNode;
use Twig\Environment;
use Twig\Node\ModuleNode;
use Twig\Node\Node;
use Twig\NodeVisitor\NodeVisitorInterface;

class TemplateNodeVisitor implements NodeVisitorInterface
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
        if ($node instanceof ModuleNode) {
            $node->setNode('constructor_start', new Node([
                new EnterTemplateNode($this->extensionName),
                $node->getNode('constructor_start')
            ]));
        }

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
