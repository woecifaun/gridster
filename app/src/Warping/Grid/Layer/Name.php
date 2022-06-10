<?php

Namespace App\Warping\Grid\Layer;

use App\SVG\Text;
use App\Warping\Stage\Screen;

class Name extends LayerAbstract implements LayerInterface
{
    private $name;

    private $size = 100; // default font size
    private $color = 'white'; // default color


    public function __construct(array $settings, Screen $screen)
    {
        if (!empty($settings['color'])) {
            $this->color = $settings['color'];
        }

        if (!empty($settings['size'])) {
            $this->size = (float) $settings['size'];
        }

        $this->name = $screen->getName();
    }

    public function toSVG()
    {
        $name = (new Text($this->name))
            ->x('50%')->y('50%')
            ->color($this->color)->size($this->size);

       return
        '<g id="name">'.
        $name->render().
        '</g>';
    }
}
