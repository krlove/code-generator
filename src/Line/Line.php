<?php

namespace Krlove\Generator\Line;

/**
 * Class Line
 * @package Krlove\Generator
 */
class Line implements ContentLineInterface
{
    /**
     * @var string
     */
    protected $value;

    /**
     * Line constructor.
     * @param string $value
     */
    public function __construct($value)
    {
        $this->setValue($value);
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {
        return $this->value;
    }

    /**
     * {@inheritDoc}
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * {@inheritDoc}
     */
    public function getValue()
    {
        return $this->value;
    }
}
