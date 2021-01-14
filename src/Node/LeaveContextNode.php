<?php

namespace Anper\Twig\TemplateCollector\Node;

use Twig\Compiler;

class LeaveContextNode extends AbstractNode
{
    /**
     * @inheritDoc
     */
    public function compile(Compiler $compiler): void
    {
        $compiler
            ->write('$this->env->getExtension(')
            ->repr($this->getAttribute('extension_name'))
            ->raw(')->leave();')
            ->raw("\n")
        ;
    }
}
