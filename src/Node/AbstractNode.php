<?php

namespace Anper\Twig\TemplateCollector\Node;

use Twig\Node\Node;

abstract class AbstractNode extends Node
{
    /**
     * @param string $extensionName
     */
    public function __construct(string $extensionName)
    {
        parent::__construct([], ['extension_name' => $extensionName]);
    }
}
