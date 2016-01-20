<?php

namespace Krlove\Generator\Model;

use Krlove\Generator\Line\Line;
use Krlove\Generator\RenderableInterface;

/**
 * Class PHPClassUse
 * @package Krlove\Generator\Model
 */
class UseNamespaceModel implements RenderableInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * PHPClassUse constructor.
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * {@inheritDoc}
     */
    public function render()
    {
        return new Line(sprintf('use %s;', $this->name));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
