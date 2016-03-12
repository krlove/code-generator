<?php

namespace Krlove\CodeGenerator\Model;

use Krlove\CodeGenerator\RenderableModel;

/**
 * Class DocBlockModel
 * @package Krlove\CodeGenerator\Model
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
     * @param array|string $content
     *
     * @return $this
     */
    public function addContent($content)
    {
        if (is_array($content)) {
            foreach ($content as $item) {
                $this->addContent($item);
            }
        } else {
            $this->content[] = $content;
        }

        return $this;
    }
}
