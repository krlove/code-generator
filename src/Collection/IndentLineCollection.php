<?php

namespace Krlove\Generator\Collection;

use Krlove\Generator\Line\IndentLine;
use Krlove\Generator\Line\LineInterface;

/**
 * Class IndentLineCollection
 * @package Krlove\Generator\Collection
 */
class IndentLineCollection extends DecoratorCollection implements LineInterface
{
    /**
     * @var int
     */
    protected $indent;

    /**
     * @var LineCollection
     */
    protected $collection;

    /**
     * IndentLineCollection constructor.
     * @param LineCollection $collection
     * @param int $indent
     */
    public function __construct(LineCollection $collection, $indent)
    {
        parent::__construct($collection);
        $this->indent     = $indent;
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {
        foreach ($this->collection as $key => $element) {
            if ($element instanceof LineCollection) {
                $element = new self($element, $this->indent);
            } else {
                $element = new IndentLine($element, $this->indent);
            }
            $this->collection[$key] = $element;
        }

        return $this->collection->__toString();
    }
}
