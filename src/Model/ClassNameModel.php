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
     * @param string|null $extends
     */
    public function __construct($name, $extends = null)
    {
        $this->setName($name)
            ->setExtends($extends);
    }

    /**
     * {@inheritDoc}
     */
    public function render()
    {
        $output = new LineCollection();
        $name = sprintf('class %s', $this->name);
        if ($this->extends !== null) {
            $name .= sprintf(' extends %s', $this->extends);
        }
        if (count($this->implements) > 0) {
            $name .= sprintf(' implements %s', implode(', ', $this->implements));
        }

        $output[] = new Line($name);
        $output[] = new Line('{');

        return $output;
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
