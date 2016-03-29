<?php

namespace Krlove\CodeGenerator\Model;

use Krlove\CodeGenerator\Exception\GeneratorException;
use Krlove\CodeGenerator\Model\Traits\DocBlockTrait;
use Krlove\CodeGenerator\RenderableModel;

/**
 * Class ClassModel
 * @package Krlove\CodeGenerator\Model
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
     * @var UseClassModel[]
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
     * @var BasePropertyModel[]
     */
    protected $properties = [];

    /**
     * @var BaseMethodModel[]
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
        $this->prepareDocBlock();
        if ($this->docBlock !== null) {
            $lines[] = $this->docBlock->render();
        }
        $lines[] = $this->name->render();
        if (count($this->traits) > 0) {
            $lines[] = $this->renderArrayLn($this->traits, 4);
        }
        if (count($this->constants) > 0) {
            $lines[] = $this->renderArrayLn($this->constants, 4);
        }
        $this->processProperties($lines);
        $this->processMethods($lines);
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
     * @return UseClassModel[]
     */
    public function getUses()
    {
        return $this->uses;
    }

    /**
     * @param UseClassModel $use
     *
     * @return $this
     */
    public function addUses(UseClassModel $use)
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
     * @return BasePropertyModel[]
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * @param BasePropertyModel $property
     *
     * @return $this
     */
    public function addProperty(BasePropertyModel $property)
    {
        $this->properties[] = $property;

        return $this;
    }

    /**
     * @return BaseMethodModel[]
     */
    public function getMethods()
    {
        return $this->methods;
    }

    /**
     * @param BaseMethodModel
     *
     * @return $this
     */
    public function addMethod(BaseMethodModel $method)
    {
        $this->methods[] = $method;

        return $this;
    }

    /**
     * Convert virtual properties and methods to DocBlock content
     */
    protected function prepareDocBlock()
    {
        $content = [];

        foreach ($this->properties as $property) {
            if ($property instanceof VirtualPropertyModel) {
                $content[] = $property->toLines();
            }
        }

        foreach ($this->methods as $method) {
            if ($method instanceof VirtualMethodModel) {
                $content[] = $method->toLines();
            }
        }

        if ($content) {
            if ($this->docBlock === null) {
                $this->docBlock = new DocBlockModel();
            }

            $this->docBlock->addContent($content);
        }
    }

    /**
     * @param array $lines
     */
    protected function processProperties(&$lines)
    {
        $properties = array_filter($this->properties, function ($property) {
            return !$property instanceof VirtualPropertyModel;
        });
        if (count($properties) > 0) {
            $lines[] = $this->renderArrayLn($properties, 4, str_repeat(PHP_EOL, 2));
        }
    }

    /**
     * @param array $lines
     * @throws GeneratorException
     */
    protected function processMethods(&$lines)
    {
        $methods = array_filter($this->methods, function ($method) {
            return !$method instanceof VirtualMethodModel;
        });
        if (count($methods) > 0) {
            $lines[] = $this->renderArray($methods, 4, str_repeat(PHP_EOL, 2));
        }
    }
}
