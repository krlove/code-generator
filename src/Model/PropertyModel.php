<?php

namespace Krlove\Generator\Model;

use Krlove\Generator\Model\Traits\DocBlockTrait;
use Krlove\Generator\Model\Traits\ModifierTrait;
use Krlove\Generator\Model\Traits\ValueTrait;
use Krlove\Generator\RenderableModel;

/**
 * TODO: add support for static and virtual properties
 * TODO: add abstract and final modifiers
 * Class PHPClassProperty
 * @package Krlove\Generator\Model
 */
class PropertyModel extends RenderableModel
{
    use ValueTrait;
    use ModifierTrait;
    use DocBlockTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * PropertyModel constructor.
     * @param string $name
     * @param string $modifier
     * @param mixed|null $value
     */
    public function __construct($name, $modifier = 'public', $value = null)
    {
        $this->setName($name)
            ->setModifier($modifier)
            ->setValue($value);
    }

    /**
     * {@inheritDoc}
     */
    public function toLines()
    {
        $lines = [];
        if ($this->docBlock !== null) {
            $lines[] = $this->docBlock->render();
        }
        $property = sprintf('%s $%s', $this->modifier, $this->name);
        if ($this->value !== null) {
            $value = $this->renderValue();
            if ($value !== null) {
                $property .= sprintf(' = %s', $this->renderValue());
            }
        }
        $property .= ';';
        $lines[] = $property;

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
}
