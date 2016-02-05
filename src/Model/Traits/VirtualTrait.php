<?php

namespace Krlove\Generator\Model\Traits;

/**
 * Trait VirtualTrait
 * @package Krlove\Generator\Model\Traits
 */
trait VirtualTrait
{
    /**
     * @var boolean
     */
    protected $virtual;

    /**
     * @return mixed
     */
    public function getVirtual()
    {
        return $this->virtual;
    }

    /**
     * @param boolean $virtual
     * @return $this
     */
    public function setVirtual($virtual)
    {
        $this->virtual = boolval($virtual);

        return $this;
    }
}