<?php

namespace Krlove\Generator\Model;

use Krlove\Generator\Model\Traits\AccessModifierTrait;
use Krlove\Generator\Model\Traits\DocBlockTrait;
use Krlove\Generator\Model\Traits\ValueTrait;
use Krlove\Generator\RenderableModel;

/**
 * TODO: Add support for virtual properties
 * Class PHPClassProperty
 * @package Krlove\Generator\Model
 */
class PropertyModel extends RenderableModel
{
    use AccessModifierTrait;
    use DocBlockTrait;
    use ValueTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var boolean
     */
    protected $static;

    /**
     * PropertyModel constructor.
     * @param string $name
     * @param string $access
     * @param mixed|null $value
     */
    public function __construct($name, $access = 'public', $value = null)
    {
        $this->setName($name)
            ->setAccess($access)
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

        $property = $this->access . ' ';
        if ($this->static) {
            $property .= 'static ';
        }
        $property .= $this->name;

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

    /**
     * @return boolean
     */
    public function isStatic()
    {
        return $this->static;
    }

    /**
     * @param boolean $static
     * @return $this
     */
    public function setStatic($static)
    {
        $this->static = boolval($static);

        return $this;
    }
}
