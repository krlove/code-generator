<?php

namespace Krlove\Generator\Line;

/**
 * Class EmptyLine
 * @package Krlove\Generator
 */
class EmptyLine implements LineInterface
{
    /**
     * @var int
     */
    protected $count;

    /**
     * EmptyLine constructor.
     * @param int $count
     */
    public function __construct($count = 1)
    {
        $this->count = $count;
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {
        $output = '';
        for ($i = 0; $i < $this->count; $i++) {
            $output .= PHP_EOL;
        }

        return $output;
    }
}
