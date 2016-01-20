<?php

namespace Krlove\Generator\Model;

use Krlove\Generator\Line\Line;
use Krlove\Generator\RenderableInterface;

/**
 * Class PHPClassNamespace
 * @package Krlove\Generator\Model
 */
class NamespaceModel implements RenderableInterface
{
    /**
     * @var string
     */
    protected $namespace;

    /**
     * PHPClassNamespace constructor.
     * @param string $namespace
     */
    public function __construct($namespace)
    {
        $this->setNamespace($namespace);
    }

    /**
     * {@inheritDoc}
     */
    public function render()
    {
        return new Line(sprintf('namespace %s;', $this->namespace));
    }

    /**
     * @return string
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * @param string $namespace
     *
     * @return $this
     */
    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;

        return $this;
    }
}
