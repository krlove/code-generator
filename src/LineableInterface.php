<?php

namespace Krlove\Generator;

/**
 * Interface ArrayableInterface
 * @package Krlove\Generator
 */
interface LineableInterface
{
    /**
     * @return string|string[]
     */
    public function toLines();
}