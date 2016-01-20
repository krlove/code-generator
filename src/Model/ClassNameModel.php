<?php

namespace Krlove\Generator\Model;

use Krlove\Generator\Collection\LineCollection;
use Krlove\Generator\Line\Line;
use Krlove\Generator\RenderableInterface;

/**
 * Class Name
 * @package Krlove\Generator\Model
 */
class ClassNameModel implements RenderableInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $extends;

    /**
     * @var array
     */
    protected $implements = [];

    /**
     * PHPClassName constructor.
     * @param string $name
     * @param string $extends
     */
    public function __construct($name, $extends)
    {
        $this->setName($name);
        $this->setExtends($extends);
    }

    /**
     * {@inheritDoc}
     */
    public function render()
    {
        $lines = new LineCollection();
        $name = sprintf('class %s', $this->name);
        if ($this->extends !== null) {
            $name .= sprintf(' extends %s', $this->extends);
        }
        if ($this->implements !== null) {
            $name .= sprintf(' implements %s', implode(', ', $this->implements));
        }

        $lines[] = new Line($name);
        $lines[] = new Line('{');

        return $lines;
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

    /**
     * @return string
     */
    public function getExtends()
    {
        return $this->extends;
    }

    /**
     * @param string $extends
     *
     * @return $this
     */
    public function setExtends($extends)
    {
        $this->extends = $extends;

        return $this;
    }

    /**
     * @return array
     */
    public function getImplements()
    {
        return $this->implements;
    }

    /**
     * @param string $implements
     *
     * @return $this
     */
    public function addImplements($implements)
    {
        $this->implements[] = $implements;

        return $this;
    }
}
