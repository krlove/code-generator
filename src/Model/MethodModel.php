<?php

namespace Krlove\Generator\Model;

use Krlove\Generator\Collection\LineCollection;
use Krlove\Generator\Collection\RenderableCollection;
use Krlove\Generator\Line\Line;
use Krlove\Generator\Model\Traits\ModifierTrait;
use Krlove\Generator\RenderableInterface;

/**
 * TODO: add support for static and virtual methods
 * Class PHPClassMethod
 * @package Krlove\Generator\Model
 */
class MethodModel implements RenderableInterface
{
    use ModifierTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var RenderableCollection|ArgumentModel[]
     */
    protected $arguments;

    /**
     * @var string
     */
    protected $body;

    /**
     * PHPClassMethod constructor.
     * @param string $name
     */
    public function __construct($name)
    {
        $this->setName($name);

        $this->arguments = new RenderableCollection();
    }

    /**
     * {@inheritDoc}
     */
    public function render()
    {
        $lines = new LineCollection();
        $output = sprintf('%s function %s(', $this->modifier, $this->name);
        if ($this->arguments) {
            $arguments = [];
            foreach ($this->arguments as $argument) {
                $arguments[] = $argument->render();
            }

            $output .= implode(', ', $arguments);
        }
        $output .= ')';

        $lines[] = new Line($output);
        $lines[] = new Line('{');
        if ($this->body) {
            $lines[] = new Line($this->body); // todo make body renderable
        }
        $lines[] = new Line('}');

        return $lines;
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
     * @return mixed
     */
    public function getModifier()
    {
        return $this->modifier;
    }

    /**
     * @param mixed $modifier
     *
     * @return $this
     */
    public function setModifier($modifier)
    {
        $this->modifier = $modifier;

        return $this;
    }

    /**
     * @return RenderableCollection
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
