<?php

namespace Anper\Twig\TemplateCollector;

use Twig\Source;

class Context extends Template
{
    /**
     * @var array<string,mixed>
     */
    protected $context;

    /**
     * @var int
     */
    protected $id;

    /**
     * @var int
     */
    protected $parent = 0;

    /**
     * @param Source $source
     * @param int $id
     * @param array<string,mixed> $context
     */
    public function __construct(Source $source, int $id, array $context)
    {
        parent::__construct($source);

        $this->context = $context;
        $this->id = $id;
    }

    /**
     * @return array<string,mixed>
     */
    public function getContext(): array
    {
        return $this->context;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getParent(): int
    {
        return $this->parent;
    }

    /**
     * @param int $parent
     */
    public function setParent(int $parent): void
    {
        $this->parent = $parent;
    }

    /**
     * @return bool
     */
    public function isRoot(): bool
    {
        return $this->parent === 0;
    }

    /**
     * @return array<string,mixed>
     */
    public function toArray(): array
    {
        return \array_merge(parent::toArray(), [
            'context' => $this->getContext(),
            'parent_id' => $this->getParent(),
            'id' => $this->getId(),
        ]);
    }
}
