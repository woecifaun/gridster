<?php

Namespace App\SVG;

class Line implements NodeInterface
{
    public function x1($x1)
    {
        $this->x1 = $x1;

        return $this;
    }

    public function y1($y1)
    {
        $this->y1 = $y1;

        return $this;
    }

    public function x2($x2)
    {
        $this->x2 = $x2;

        return $this;
    }

    public function y2($y2)
    {
        $this->y2 = $y2;

        return $this;
    }

    public function width($width)
    {
        $this->width = $width;

        return $this;
    }

    public function color($color)
    {
        $this->color = $color;

        return $this;
    }

    public function render()
    {
        $style = '';

        if (!empty($this->color)) {
            $style .= 'stroke:'. $this->color .';';
        }

        if (!empty($this->width)) {
            $style .= 'stroke-width:'. $this->width .';other:property;';
        }

        return
        '<line '.
        'x1="'.$this->x1.'" '.
        'y1="'.$this->y1.'" '.
        'x2="'.$this->x2.'" '.
        'y2="'.$this->y2.'" '.
        ($style ? 'style="'. $style .'" ' : '').
        '/>';
    }
}
