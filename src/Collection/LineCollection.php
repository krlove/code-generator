<?php

namespace Krlove\Generator\Collection;

use Krlove\Generator\Exception\GeneratorException;
use Krlove\Generator\Line\Line;
use Krlove\Generator\Line\LineInterface;

/**
 * Class LineCollection
 * @package Krlove\Generator
 */
class LineCollection extends Collection implements LineInterface
{
    /**
     * @var string
     */
    protected $delimiter;

    /**
     * LineCollection constructor.
     * @param string $delimiter
     */
    public function __construct($delimiter = PHP_EOL)
    {
        $this->delimiter = $delimiter;
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {
        $output = [];
        /** @var LineInterface $element */
        foreach ($this->elements as $element) {
            $output[] = $element->__toString();
        }

        return implode($this->delimiter, $output);
    }

    /**
     * {@inheritDoc}
     */
    public function offsetSet($offset, $value)
    {
        if (!$value instanceof LineInterface) {
            if (is_scalar($value)) {
                $value = new Line($value);
            } else {
                throw new GeneratorException('Invalid value');
            }
        }

        parent::offsetSet($offset, $value);
    }
}
