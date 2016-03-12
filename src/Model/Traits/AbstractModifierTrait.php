<?php

namespace Krlove\CodeGenerator\Model\Traits;

/**
 * Trait AbstractModifierTrait
 * @package Krlove\CodeGenerator\Model\Traits
 */
trait AbstractModifierTrait
{
    /**
     * @var boolean;
     */
    protected $abstract;

    /**
     * @return boolean
     */
    public function isAbstract()
    {
        return $this->abstract;
    }

    /**
     * @param boolean $abstract
     *
     * @return $this
     */
    public function setAbstract($abstract = true)
    {
        $this->abstract = boolval($abstract);

        return $this;
    }
}