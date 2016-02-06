<?php

namespace Krlove\Generator\Model;

use Krlove\Generator\Exception\ValidationException;

/**
 * Class VirtualPropertyModel
 * @package Krlove\Generator\Model
 */
class VirtualPropertyModel extends BasePropertyModel
{
    /**
     * @var string
     */
    protected $type;

    /**
     * @var boolean
     */
    protected $readable = true;

    /**
     * @var
     */
    protected $writable = true;

    /**
     * VirtualPropertyModel constructor.
     * @param string $name
     * @param string $type
     */
    public function __construct($name, $type)
    {
        $this->setName($name)
            ->setType($type);
    }

    /**
     * {@inheritDoc}
     */
    public function toLines()
    {
        $property = '@property';
        if (!$this->readable) {
            $property .= '-write';
        } elseif (!$this->writable) {
            $property .= '-read';
        }

        return $property . ' ' . $this->type . ' $' . $this->name;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isReadable()
    {
        return $this->readable;
    }

    /**
     * @param boolean $readable
     *
     * @return $this
     */
    public function setReadable($readable = true)
    {
        $this->readable = $readable;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getWritable()
    {
        return $this->writable;
    }

    /**
     * @param mixed $writable
     *
     * @return $this
     */
    public function setWritable($writable = true)
    {
        $this->writable = $writable;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    protected function validate()
    {
        if (!$this->readable && !$this->writable) {
            throw new ValidationException('Property cannot be unreadable and unwritable at the same time');
        }
    }
}
