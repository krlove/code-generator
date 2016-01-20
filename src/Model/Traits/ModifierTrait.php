<?php

namespace Krlove\Generator\Model\Traits;

/**
 * Class ModifierTrait
 * @package Krlove\Generator\Model\Traits
 */
trait ModifierTrait
{
    /**
     * @var string
     */
    protected $modifier = 'public';

    /**
     * @return string
     */
    public function getModifier()
    {
        return $this->modifier;
    }

    /**
     * @param string $modifier
     *
     * @return $this
     */
    public function setModifier($modifier)
    {
        if (!in_array($modifier, ['private', 'protected', 'public'])) {
            $modifier = 'public';
        }

        $this->modifier = $modifier;

        return $this;
    }
}
