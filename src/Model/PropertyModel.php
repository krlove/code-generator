<?php

namespace Krlove\Generator\Model;

use Krlove\Generator\Line\Line;
use Krlove\Generator\Model\Traits\ModifierTrait;
use Krlove\Generator\Model\Traits\ValueTrait;
use Krlove\Generator\RenderableInterface;

/**
 * TODO: add support for static and virtual properties
 * Class PHPClassProperty
 * @package Krlove\Generator\Model
 */
class PropertyModel implements RenderableInterface
{
    use ValueTrait;
    use ModifierTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * PHPClassProperty constructor.
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
        $output = sprintf('%s $%s', $this->modifier, $this->name);
        if ($this->value !== null) {
            $value = $this->renderValue();
            if ($value !== null) {
                $output .= sprintf(' = %s', $this->renderValue());
            }
        }
        $output .= ';';

        return new Line($output);
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
