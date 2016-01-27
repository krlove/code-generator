<?php

namespace Krlove\Generator\Model;

use Krlove\Generator\Collection\IndentLineCollection;
use Krlove\Generator\Collection\LineCollection;
use Krlove\Generator\Collection\RenderableCollection;
use Krlove\Generator\Line;
use Krlove\Generator\Line\EmptyLine;
use Krlove\Generator\Model\Traits\DocBlockTrait;
use Krlove\Generator\RenderableInterface;

class ClassModel implements RenderableInterface
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
     * @var RenderableCollection|UseNamespaceModel[]
     */
    protected $uses;

    /**
     * @var RenderableCollection|UseTraitModel[]
     */
    protected $traits;

    /**
     * @var RenderableCollection|ConstantModel[]
     */
    protected $constants;

    /**
     * @var RenderableCollection|PropertyModel[]
     */
    protected $properties;

    /**
     * @var RenderableCollection|MethodModel[]
     */
    protected $methods;

    /**
     * PHPClass constructor.
     */
    public function __construct()
    {
        $this->uses       = new RenderableCollection();
        $this->traits     = new RenderableCollection();
        $this->constants  = new RenderableCollection();
        $this->properties = new RenderableCollection();
        $this->methods    = new RenderableCollection();
    }

    /**
     * {@inheritDoc}
     */
    public function render()
    {
        $output = new LineCollection('');
        $output[] = '<?php';
        $output[] = new EmptyLine(2);
        if ($this->namespace !== null) {
            $output[] = $this->namespace->render();
            $output[] = new EmptyLine(2);
        }
        if (!$this->uses->isEmpty()) {
            $output[] = $this->uses->render();
            $output[] = new EmptyLine(2);
        }
        if ($this->docBlock !== null) {
            $output[] = $this->docBlock->render();
            $output[] = new EmptyLine();
        }
        $output[] = $this->name->render();
        $output[] = new EmptyLine();
        if (!$this->traits->isEmpty()) {
            $output[] = new IndentLineCollection($this->traits->render(), 4);
            $output[] = new EmptyLine(2);
        }
        if (!$this->constants->isEmpty()) {
            $output[] = new IndentLineCollection($this->constants->render(), 4);
            $output[] = new EmptyLine(2);
        }
        if (!$this->properties->isEmpty()) {
            $output[] = new IndentLineCollection($this->properties->render(), 4);
            $output[] = new EmptyLine(2);
        }
        if (!$this->methods->isEmpty()) {
            $output[] = new IndentLineCollection($this->methods->render(), 4);
            $output[] = new EmptyLine();
        }
        $output[] = '}';

        return $output;
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
     * @return RenderableCollection
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
     * @return UseTraitModel|RenderableCollection
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
     * @return ConstantModel[]|RenderableCollection
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
     * @return PropertyModel[]|RenderableCollection
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
     * @return MethodModel[]|RenderableCollection
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
