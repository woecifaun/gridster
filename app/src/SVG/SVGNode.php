<?php

Namespace App\SVG;

// Not for for being used as Root SVG Node

class SVGNode implements NodeInterface
{
    /**
     * NodeInterface[]
     */
    protected $nodes;

    public function width($width)
    {
        $this->width = $width;

        return $this;
    }

    public function height($height)
    {
        $this->height = $height;

        return $this;
    }

    public function x($x)
    {
        $this->x = $x;

        return $this;
    }

    public function y($y)
    {
        $this->y = $y;

        return $this;
    }

    public function id($id)
    {
        $this->id = $id;

        return $this;
    }

    public function append(NodeInterface $node)
    {
        $this->nodes[] = $node;

        return $this;
    }

    public function render()
    {
        $svg =
        '<svg id="'.$this->id.'" width="'. $this->width .'" height="'. $this->height .'" '.
        'x="'.$this->x.'" y="'.$this->y.'">';

        foreach ($this->nodes as $node) {
            $svg .= $node->render();
        }

        return $svg.'</svg>';
    }
}
