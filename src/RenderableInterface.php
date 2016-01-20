<?php

namespace Krlove\Generator;

use Krlove\Generator\Line\LineInterface;

/**
 * Interface RenderableInterface
 * @package Krlove\Generator
 */
interface RenderableInterface
{
    /**
     * @return LineInterface $line
     */
    public function render();
}
