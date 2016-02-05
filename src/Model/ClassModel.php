<?php

namespace Krlove\Generator\Model;

use Krlove\Generator\Model\Traits\DocBlockTrait;
use Krlove\Generator\RenderableModel;

/**
 * Class ClassModel
 * @package Krlove\Generator\Model
 */
class ClassModel extends RenderableModel
{
    use DocBlockTrait;

    /**
     * @var ClassNameModel
     */
    protected $name;

    /**
     * @var NamespaceModel
     */
    protected $namespace;

    /**
     * @var UseNamespaceModel[]
     */
    protected $uses = [];

    /**
     * @var UseTraitModel[]
     */
    protected $traits = [];

    /**
     * @var ConstantModel[]
     */
    protected $constants = [];

    /**
     * @var PropertyModel[]
     */
    protected $properties = [];

    /**
     * @var MethodModel[]
     */
    protected $methods = [];

    /**
     * {@inheritDoc}
     */
    public function toLines()
    {
        $lines = [];
        $lines[] = $this->ln('<?php');
        if ($this->namespace !== null) {
            $lines[] = $this->ln($this->namespace->render());
        }
        if (count($this->uses) > 0) {
            $lines[] = $this->renderArrayLn($this->uses);
        }
        if ($this->docBlock !== null) {
            $lines[] = $this->ln($this->docBlock->render());
        }
        $lines[] = $this->name->render();
        if (count($this->traits) > 0) {
            $lines[] = $this->renderArrayLn($this->traits, 4);
        }
        if (count($this->constants) > 0) {
            $lines[] = $this->renderArrayLn($this->constants, 4);
        }
        if (count($this->properties) > 0) {
            $lines[] = $this->renderArrayLn($this->properties, 4, str_repeat(PHP_EOL, 2));
        }
        if (count($this->methods) > 0) {
            $lines[] = $this->renderArray($this->methods, 4, str_repeat(PHP_EOL, 2));
        }
        $lines[] = $this->ln('}');

        return $lines;
    }

    /**
     * @return ClassNameModel
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param ClassNameModel $name
     *
     * @return $this
     */
    public function setName(ClassNameModel $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return NamespaceModel
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * @param NamespaceModel $namespace
     *
     * @return $this
     */
    public function setNamespace(NamespaceModel $namespace)
    {
        $this->namespace = $namespace;

        return $this;
    }

    /**
     * @return UseNamespaceModel[]
     */
    public function getUses()
    {
        return $this->uses;
    }

    /**
     * @param UseNamespaceModel $use
     *
     * @return $this
     */
    public function addUses(UseNamespaceModel $use)
    {
        $this->uses[] = $use;

        return $this;
    }

    /**
     * @return UseTraitModel[]
     */
    public function getTraits()
    {
        return $this->traits;
    }

    /**
     * @param UseTraitModel
     *
     * @return $this
     */
    public function addTrait(UseTraitModel $trait)
    {
        $this->traits[] = $trait;

        return $this;
    }

    /**
     * @return ConstantModel[]
     */
    public function getConstants()
    {
        return $this->constants;
    }

    /**
     * @param ConstantModel $constant
     *
     * @return $this
     */
    public function addConstant(ConstantModel $constant)
    {
        $this->constants[] = $constant;

        return $this;
    }

    /**
     * @return PropertyModel[]
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * @param PropertyModel $property
     *
     * @return $this
     */
    public function addProperty(PropertyModel $property)
    {
        $this->properties[] = $property;

        return $this;
    }

    /**
     * @return MethodModel[]
     */
    public function getMethods()
    {
        return $this->methods;
    }

    /**
     * @param MethodModel
     *
     * @return $this
     */
    public function addMethod(MethodModel $method)
    {
        $this->methods[] = $method;

        return $this;
    }
}
