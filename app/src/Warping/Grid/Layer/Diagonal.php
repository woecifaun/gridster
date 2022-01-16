<?php

Namespace App\Warping\Grid\Layer;

Use App\SVG\Line;
Use App\Warping\Screen\Screen;

class Diagonal extends LayerAbstract implements LayerInterface
{
    private $thickness = 4;
    private $color = 'white';


    public function __construct(array $settings, Screen $screen)
    {
        if (!empty($settings['thickness'])) {
            $this->thickness = (float)$settings['thickness'];
        }

        if (!empty($settings['color'])) {
            $this->color = $settings['color'];
        }
    }

    public function toSVG()
    {
        $line = new Line();
        $line->color($this->color)->width($this->thickness);

        return
        '<g id="diagonal">'.
        $line->x1(0)->y1(0)->x2('100%')->y2('100%')->render().
        $line->x1(0)->y1('100%')->x2('100%')->y2(0)->render().
        '</g>'
        ;
    }
}
