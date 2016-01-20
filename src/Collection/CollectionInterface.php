<?php

namespace Krlove\Generator\Collection;

/**
 * Interface CollectionInterface
 * @package Krlove\Generator\Collection
 */
interface CollectionInterface extends \ArrayAccess, \Iterator
{
    /**
     * @return array
     */
    public function elements();

    /**
     * @return bool
     */
    public function isEmpty();
}
