<?php

namespace Krlove\Generator\Model\Traits;

/**
 * Trait AccessModifierTrait
 * @package Krlove\Generator\Model\Traits
 */
trait AccessModifierTrait
{
    /**
     * @var string
     */
    protected $access;

    /**
     * @return string
     */
    public function getAccess()
    {
        return $this->access;
    }

    /**
     * @param string $access
     * @return $this
     */
    public function setAccess($access)
    {
        if (!in_array($access, ['private', 'protected', 'public'])) {
            $access = 'public';
        }

        $this->access = $access;

        return $this;
    }
}