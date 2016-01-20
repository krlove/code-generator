<?php

namespace Krlove\Generator\Collection;

/**
 * Class DecoratedCollection
 * @package Krlove\Generator\Collection
 */
class DecoratorCollection implements CollectionInterface
{
    /**
     * @var LineCollection
     */
    protected $collection;

    /**
     * IndentLineCollection constructor.
     * @param CollectionInterface $collection
     */
    public function __construct(CollectionInterface $collection)
    {
        $this->collection = $collection;
    }

    /**
     * {@inheritDoc}
     */
    public function elements()
    {
        return $this->collection->elements();
    }

    /**
     * {@inheritDoc}
     */
    public function isEmpty()
    {
        return $this->collection->isEmpty();
    }

    /**
     * {@inheritDoc}
     */
    public function offsetExists($offset)
    {
        return $this->collection->offsetExists($offset);
    }

    /**
     * {@inheritDoc}
     */
    public function offsetGet($offset)
    {
        return $this->collection->offsetGet($offset);
    }

    /**
     * {@inheritDoc}
     */
    public function offsetSet($offset, $value)
    {
        $this->collection->offsetSet($offset, $value);
    }

    /**
     * {@inheritDoc}
     */
    public function offsetUnset($offset)
    {
        $this->collection->offsetUnset($offset);
    }

    /**
     * {@inheritDoc}
     */
    public function current()
    {
        return $this->collection->current();
    }

    /**
     * {@inheritDoc}
     */
    public function next()
    {
        return $this->collection->next();
    }

    /**
     * {@inheritDoc}
     */
    public function key()
    {
        return $this->collection->key();
    }

    /**
     * {@inheritDoc}
     */
    public function valid()
    {
        return $this->collection->valid();
    }

    /**
     * {@inheritDoc}
     */
    public function rewind()
    {
        return $this->collection->rewind();
    }}
