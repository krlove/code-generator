<?php

namespace Krlove\CodeGenerator\Model;

use Krlove\CodeGenerator\Exception\ValidationException;
use Krlove\CodeGenerator\Model\Traits\AbstractModifierTrait;
use Krlove\CodeGenerator\Model\Traits\FinalModifierTrait;
use Krlove\CodeGenerator\RenderableModel;

/**
 * Class Name
 * @package Krlove\CodeGenerator\Model
 */
class ClassNameModel extends RenderableModel
{
    use AbstractModifierTrait;
    use FinalModifierTrait;

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
    public function toLines()
    {
        $lines = [];

        $name = '';
        if ($this->final) {
            $name .= 'final ';
        }
        if ($this->abstract) {
            $name .= 'abstract ';
        }
        $name .= 'class ' . $this->name;

        if ($this->extends !== null) {
            $name .= sprintf(' extends %s', $this->extends);
        }
        if (count($this->implements) > 0) {
            $name .= sprintf(' implements %s', implode(', ', $this->implements));
        }

        $lines[] = $name;
        $lines[] = '{';

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

    /**
     * {@inheritDoc}
     */
    protected function validate()
    {
        if ($this->final && $this->abstract) {
            throw new ValidationException('Entity cannot be final and abstract at the same time');
        }

        return parent::validate();
    }
}
