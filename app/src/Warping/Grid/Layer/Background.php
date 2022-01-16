<?php

Namespace App\Warping\Grid\Layer;

Use App\Warping\Screen\Screen;

class Background extends LayerAbstract implements LayerInterface {

    private $color = 'black';


    public function __construct(array $settings, Screen $screen)
    {
        if (!empty($settings['color'])) {
            $this->color = $settings['color'];
        }
    }

    public function getColor()
    {
        return $this->color;
    }

    public function toSVG()
    {
        return
        '<g id="background">'.
        '<rect id="background" '.
        'x="0" y="0" '.
        'width="100%" height="100%" '.
        'style="fill:'.$this->color.';" />'.
        '</g>';
    }
}
