<?php

namespace Krlove\Generator\Collection;

use Krlove\Generator\Exception\GeneratorException;

/**
 * Class Collection
 * @package Krlove\Generator
 */
class Collection implements CollectionInterface
{
    /**
     * @var array
     */
    protected $elements = [];

    /**
     * {@inehritDoc}
     */
    public function elements()
    {
        return $this->elements;
    }

    /**
     * {@inheritDoc}
     */
    public function isEmpty()
    {
        return count($this->elements) === 0;
    }

    /**
     * {@inheritDoc}
     */
    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->elements);
    }

    /**
     * {@inheritDoc}
     */
    public function offsetGet($offset)
    {
        if ($this->offsetExists($offset)) {
            return $this->elements[$offset];
        }
        throw new GeneratorException('Invalid offset');
    }

    /**
     * {@inheritDoc}
     */
    public function offsetSet($offset, $value)
    {
        if ($offset === null) {
            $this->elements[] = $value;
        } else {
            $this->elements[$offset] = $value;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function offsetUnset($offset)
    {
        unset($this->elements[$offset]);
    }

    /**
     * {@inheritDoc}
     */
    public function current()
    {
        return current($this->elements);
    }

    /**
     * {@inheritDoc}
     */
    public function next()
    {
        return next($this->elements);
    }

    /**
     * {@inheritDoc}
     */
    public function key()
    {
        return key($this->elements);
    }

    /**
     * {@inheritDoc}
     */
    public function valid()
    {
        return key($this->elements) !== null;
    }

    /**
     * {@inheritDoc}
     */
    public function rewind()
    {
        return reset($this->elements);
    }
}
