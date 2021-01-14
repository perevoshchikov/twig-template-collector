<?php

if (\interface_exists('Twig_NodeInterface')) {
    \class_alias('Twig_NodeInterface', 'Anper\Twig\TemplateCollector\NodeInterface');
} else {
    \class_alias('Twig\Node\Node', 'Anper\Twig\TemplateCollector\NodeInterface');
}
