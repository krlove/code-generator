<?php

namespace Krlove\Generator\Model;

use Krlove\Generator\RenderableModel;

/**
 * Class DocBlockModel
 * @package Krlove\Generator\Model
 */
class DocBlockModel extends RenderableModel
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
    public function toLines()
    {
        $lines = [];
        $lines[] = '/**';
        if ($this->content) {
            foreach ($this->content as $item) {
                $lines[] = sprintf(' * %s', $item);
            }
        } else {
            $lines[] = ' *';
        }
        $lines[] = ' */';

        return $lines;
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
