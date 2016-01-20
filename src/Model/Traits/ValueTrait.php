<?php

namespace Krlove\Generator\Model\Traits;

/**
 * Class PHPValueTrait
 * @package Krlove\Generator\Model\Traits
 */
trait ValueTrait
{
    /**
     * @var mixed
     */
    protected $value;

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     *
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return string|null
     */
    protected function renderValue()
    {
        $type = gettype($this->value);

        switch ($type) {
            case 'boolean':
                $value = $this->value ? 'true' : 'false';
                break;
            case 'int':
                $value = $this->value;
                break;
            case 'string':
                $value = sprintf('\'%s\'', addslashes($this->getValue()));
                break;
            case 'array':
                $value = '1'; // add array support
                break;
            default:
                $value = null;
        }

        return $value;
    }
}
