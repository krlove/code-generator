<?php

namespace Krlove\Generator\Line;

/**
 * Interface ContentLineInterface
 * @package Krlove\Generator\Line
 */
interface ContentLineInterface extends LineInterface
{
    /**
     * @param mixed $value
     */
    public function setValue($value);

    /**
     * @return mixed
     */
    public function getValue();
}
