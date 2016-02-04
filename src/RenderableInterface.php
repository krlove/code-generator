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
     * @param string $delimiter
     * @return string
     */
    public function render($indent = 0, $delimiter = PHP_EOL);
}
