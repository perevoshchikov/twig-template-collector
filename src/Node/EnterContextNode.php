<?php

namespace Anper\Twig\TemplateCollector\Node;

use Twig\Compiler;

class EnterContextNode extends AbstractNode
{
    /**
     * @inheritDoc
     */
    public function compile(Compiler $compiler): void
    {
        $compiler
            ->write('$this->env->getExtension(')
            ->repr($this->getAttribute('extension_name'))
            ->raw(')->enter($this->getSourceContext(), $context ?? []);')
            ->raw("\n\n")
        ;
    }
}
