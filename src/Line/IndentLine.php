<?php

namespace Krlove\Generator\Line;

/**
 * Class IndentLine
 * @package Krlove\Generator
 */
class IndentLine implements LineInterface
{
    /**
     * @var int
     */
    protected $indent;

    /**
     * @var LineInterface
     */
    protected $line;

    /**
     * IndentLine constructor.
     * @param LineInterface $line
     * @param int $indent
     */
    public function __construct(LineInterface $line, $indent)
    {
        $this->line   = $line;
        $this->indent = $indent;
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {
        return str_repeat(' ', $this->indent) . $this->line->__toString();
    }
}
