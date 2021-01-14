<?php

namespace Anper\Twig\TemplateCollector;

use Twig\Source;

class Template
{
    /**
     * @var Source
     */
    protected $source;

    /**
     * @param Source $source
     */
    public function __construct(Source $source)
    {
        $this->source = $source;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->source->getName();
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->source->getPath();
    }

    /**
     * @return array<string,string>
     */
    public function toArray(): array
    {
        return [
            'path' => $this->getPath(),
            'name' => $this->getName(),
        ];
    }
}
