<?php

namespace Krlove\Generator\Model;

use Krlove\Generator\Line\Line;
use Krlove\Generator\Model\Traits\ValueTrait;
use Krlove\Generator\RenderableInterface;

/**
 * Class PHPClassConstant
 * @package Krlove\Generator\Model
 */
class ConstantModel implements RenderableInterface
{
    use ValueTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * PHPClassConstant constructor.
     * @param string $name
     * @param mixed $value
     */
    public function __construct($name, $value)
    {
        $this->setName($name);
        $this->setValue($value);
    }

    /**
     * {@inheritDoc}
     */
    public function render()
    {
        $value = $this->renderValue();

        return new Line(sprintf('const %s = %s;', $this->name, $value));
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
