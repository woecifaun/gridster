<?php

Namespace App\Warping\Grid\Layer;

Use App\Warping\Stage\Screen;

class Circles extends LayerAbstract implements LayerInterface
{
    private $width;
    private $height;
    private $quantity; // null for automatic or int number if decide by user
    private $thickness = 1;
    private $color = 'white';


    public function __construct(array $settings, Screen $screen)
    {
        $this->width = $screen->getWidthInPixels();

        $this->height = $screen->getHeightInPixels();

        if (!empty($settings['thickness'])) {
            $this->thickness = (float)$settings['thickness'];
        }

        if (!empty($settings['color'])) {
            $this->color = $settings['color'];
        }

        $this->radius = min($this->width, $this->height) / 2;
    }

    public function toSVG()
    {
        return
        '<g id="circles">'.
        '<circle cx="50%" cy="50%" r="'. $this->radius .'"  '.
        'style="stroke:'. $this->color .';stroke-width:'. $this->thickness .';fill:none;"/>'.
        '</g>'
        ;
    }

/*    public function prepareForJSON()
    {
        $layer = [];

        $layer['type'] = 'circles';
        $layer['quantity'] = $this->quantity;
        $layer['thickness'] = $this->thickness;
        $layer['color'] = $this->color;

        return $layer;
    }*/

}
