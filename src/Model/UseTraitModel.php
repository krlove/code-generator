<?php

namespace Krlove\Generator\Model;

use Krlove\Generator\Line\Line;
use Krlove\Generator\RenderableInterface;

/**
 * Class PHPClassTrait
 * @package Krlove\Generator\Model
 */
class UseTraitModel implements RenderableInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * PHPClassTrait constructor.
     * @param string $name
     */
    public function __construct($name)
    {
        $this->setName($name);
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
