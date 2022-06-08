<?php

Namespace App\SVG;

class Text implements NodeInterface
{
    public function __construct($text)
    {
        $this->text = $text;

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

    public function color($color)
    {
        $this->color = $color;

        return $this;
    }

    public function stroke($stroke)
    {
        $this->stroke = $stroke;

        return $this;
    }

    public function size($size)
    {
        $this->size = $size;

        return $this;
    }

    public function render()
    {
        $style = '';

        if (!empty($this->color)) {
            $style .= 'fill:'. $this->color .';';
        }

        if (!empty($this->stroke)) {
            $style .= 'stroke:'. $this->stroke .';stroke-width:2px;';
        }

        return
        '<text '.
        'x="'.$this->x.'" '.
        'y="'.$this->y.'" '.
        'font-size="'.$this->size.'" '.
        ($style ? 'style="'. $style .'" ' : '').
        'dominant-baseline="middle" '.
        'text-anchor="middle" >'.
        $this->text.
        '</text>';
    }
}
