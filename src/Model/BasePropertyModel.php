<?php

namespace Krlove\CodeGenerator\Model;

use Krlove\CodeGenerator\RenderableModel;

/**
 * Class BaseProperty
 * @package Krlove\CodeGenerator\Model
 */
abstract class BasePropertyModel extends RenderableModel
{
    /**
     * @var string
     */
    protected $name;

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
