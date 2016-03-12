<?php

namespace Krlove\CodeGenerator\Model;

use Krlove\CodeGenerator\Exception\ValidationException;

/**
 * Class VirtualPropertyModel
 * @package Krlove\CodeGenerator\Model
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
    public function __construct($name, $type = null)
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

        if ($this->type !== null) {
            $property .= ' ' . $this->type;
        }

        return $property . ' $' . $this->name;
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
