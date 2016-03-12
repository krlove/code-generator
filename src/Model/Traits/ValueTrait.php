<?php

namespace Krlove\CodeGenerator\Model\Traits;

/**
 * Trait PHPValueTrait
 * @package Krlove\CodeGenerator\Model\Traits
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
        return $this->renderTyped($this->value);
    }

    /**
     * @param mixed $value
     * @return string|null
     */
    protected function renderTyped($value)
    {
        $type = gettype($value);

        switch ($type) {
            case 'boolean':
                $value = $value ? 'true' : 'false';

                break;
            case 'int':
                // do nothing

                break;
            case 'string':
                $value = sprintf('\'%s\'', addslashes($value));

                break;
            case 'array':
                $parts = [];
                foreach ($value as $item) {
                    $parts[] = $this->renderTyped($item);
                }
                $value = '[' . implode(', ', $parts) . ']';

                break;
            default:
                $value = null; // TODO: how to render null explicitly?
        }

        return $value;
    }
}
