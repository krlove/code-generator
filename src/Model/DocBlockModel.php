<?php

namespace Krlove\Generator\Model;

use Krlove\Generator\Collection\LineCollection;
use Krlove\Generator\RenderableInterface;

/**
 * Class DocBlockModel
 * @package Krlove\Generator\Model
 */
class DocBlockModel implements RenderableInterface
{
    /**
     * @var array
     */
    protected $content = [];

    /**
     * DocBlockModel constructor.
     */
    public function __construct()
    {
        $args = func_get_args();
        foreach ($args as $arg) {
            $this->addContent($arg);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function render()
    {
        $output = new LineCollection();
        $output[] = '/**';
        if ($this->content) {
            foreach ($this->content as $item) {
                $output[] = sprintf(' * %s', $item);
            }
        } else {
            $output[] = ' *';
        }
        $output[] = ' */';

        return $output;
    }

    /**
     * @return array
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     *
     * @return $this
     */
    public function addContent($content)
    {
        $this->content[] = $content;

        return $this;
    }
}
