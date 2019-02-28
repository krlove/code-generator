<?php

namespace Krlove\CodeGenerator\Model;

use Krlove\CodeGenerator\RenderableModel;

/**
 * Class UseClassModel
 * @package Krlove\CodeGenerator\Model
 */
class UseClassModel extends RenderableModel
{
    /**
     * @var string
     */
    protected $name;
    /**
     * @var string
     */
    protected $alias=null;

    /**
     * PHPClassUse constructor.
     * @param string $name
     */
    public function __construct($name,$alias=null)
    {
        $this->name = $name;
        if ($alias) $this->alias=$alias;
    }

    /**
     * {@inheritDoc}
     */
    public function toLines()
    {
        if (is_null($this->alias)) {
            return sprintf('use %s;', $this->name);
        }
        else {
            return sprintf('use %s as %s;', $this->name,$this->alias);
        }
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
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
     * @param string $alias
     *
     * @return $this
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;

        return $this;
    }
}
