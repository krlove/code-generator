<?php

namespace Krlove\CodeGenerator\Model;

/**
 * Class VirtualMethodModel
 * @package Krlove\CodeGenerator\Model
 */
class VirtualMethodModel extends BaseMethodModel
{
    /**
     * @var string
     */
    protected $type;

    /**
     * VirtualMethodModel constructor.
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
        $type = $this->type ?: 'void';

        return '@method ' . $type . ' ' . $this->name . '(' . $this->renderArguments() . ')';
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
}
