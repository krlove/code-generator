<?php

namespace Krlove\Generator\Collection;

use Krlove\Generator\Exception\GeneratorException;
use Krlove\Generator\Line\ContentLineInterface;
use Krlove\Generator\RenderableInterface;

/**
 * Class RenderableCollection
 * @package Krlove\Generator
 */
class RenderableCollection extends Collection implements RenderableInterface
{
    /**
     * {@inheritDoc}
     */
    public function render()
    {
        $lines = new LineCollection();
        /** @var RenderableInterface $element */
        foreach ($this->elements as $element) {
            $lines[] = $element->render();
        }

        return $lines;
    }

    /**
     * {@inheritDoc}
     */
    public function offsetSet($offset, $value)
    {
        if (!$value instanceof RenderableInterface) {
            throw new GeneratorException('Invalid value');
        }

        parent::offsetSet($offset, $value);
    }
}
