<?php

namespace Anper\Twig\TemplateCollector\Node;

use Twig\Compiler;

class EnterTemplateNode extends AbstractNode
{
    /**
     * @inheritDoc
     */
    public function compile(Compiler $compiler): void
    {
        $compiler
            ->write('$env->getExtension(')
            ->repr($this->getAttribute('extension_name'))
            ->raw(')->enter($this->getSourceContext());')
            ->raw("\n\n")
        ;
    }
}
