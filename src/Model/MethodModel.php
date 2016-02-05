<?php

namespace Krlove\Generator\Model;

use Krlove\Generator\Exception\ValidationException;
use Krlove\Generator\Model\Traits\AbstractModifierTrait;
use Krlove\Generator\Model\Traits\AccessModifierTrait;
use Krlove\Generator\Model\Traits\DocBlockTrait;
use Krlove\Generator\Model\Traits\FinalModifierTrait;
use Krlove\Generator\Model\Traits\StaticModifierTrait;
use Krlove\Generator\RenderableModel;

/**
 * TODO: add support for virtual methods
 * Class PHPClassMethod
 * @package Krlove\Generator\Model
 */
class MethodModel extends RenderableModel
{
    use AbstractModifierTrait;
    use AccessModifierTrait;
    use DocBlockTrait;
    use FinalModifierTrait;
    use StaticModifierTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var ArgumentModel[]
     */
    protected $arguments = [];

    /**
     * @var string
     */
    protected $body;

    /**
     * MethodModel constructor.
     * @param string $name
     * @param string $access
     */
    public function __construct($name, $access = 'public')
    {
        $this->setName($name)
            ->setAccess($access);
    }

    /**
     * {@inheritDoc}
     */
    public function toLines()
    {
        $lines = [];
        if ($this->docBlock !== null) {
            $lines[] = $this->docBlock->render();
        }

        $function = '';
        if ($this->final) {
            $function .= 'final ';
        }
        if ($this->abstract) {
            $function .= 'abstract ';
        }
        $function .= $this->access . ' ';
        if ($this->static) {
            $function .= 'static ';
        }
        $function .= 'function ' . $this->name . '(';

        if ($this->arguments) {
            $arguments = [];
            foreach ($this->arguments as $argument) {
                $arguments[] = $argument->render();
            }

            $function .= implode(', ', $arguments);
        }
        $function .= ')';

        if ($this->abstract) {
            $function .= ';';
        }

        $lines[] = $function;
        if (!$this->abstract) {
            $lines[] = '{';
            if ($this->body) {
                $lines[] = $this->body; // TODO: make body renderable
            }
            $lines[] = '}';
        }

        return $lines;
    }

    /**
     * {@inheritDoc}
     */
    protected function validate()
    {
        if ($this->abstract and ($this->final or $this->static)) {
            throw new ValidationException('Entity cannot be abstract and final or static at the same time');
        }

        return parent::validate();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return ArgumentModel[]
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * @param ArgumentModel $argument
     *
     * @return $this
     */
    public function addArgument(ArgumentModel $argument)
    {
        $this->arguments[] = $argument;

        return $this;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param string $body
     *
     * @return $this
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }
}
