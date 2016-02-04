<?php

namespace Krlove\Generator;

/**
 * Class RenderableModel
 * @package Krlove\Generator
 */
abstract class RenderableModel implements RenderableInterface, LineableInterface
{
    /**
     * {@inheritDoc}
     */
    final public function render($indent = 0)
    {
        $lines = $this->toLines();

        if (!is_array($lines)) {
            $lines = [$lines];
        }

        if ($indent > 0) {
            array_walk($lines, function (&$item) use ($indent) {
                $item = str_repeat(' ', $indent) . $item;
            });
        }

        return implode(PHP_EOL, $lines);
    }
}