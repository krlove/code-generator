<?php

namespace Krlove\Generator\Model\Traits;

/**
 * Trait StaticMidifierTrait
 * @package Krlove\Generator\Model\Traits
 */
trait StaticModifierTrait
{
    /**
     * @var boolean
     */
    protected $static;

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
    public function setStatic($static = true)
    {
        $this->static = boolval($static);

        return $this;
    }
}