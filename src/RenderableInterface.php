<?php

namespace Krlove\Generator;

/**
 * Interface RenderableInterface
 * @package Krlove\Generator
 */
interface RenderableInterface
{
    /**
     * @param int $indent
     *
     * @return string
     */
    public function render($indent = 0);
}
