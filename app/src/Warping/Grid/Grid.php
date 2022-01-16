<?php

Namespace App\Warping\Grid;

use App\Warping\Grid\Layer\LayerFactory;
use App\Warping\Grid\Layer\LayerStack;
use App\Warping\Screen\Screen;

class Grid
{
    private $screen;
    private $layerStack;


    public function __construct(Screen $screen, LayerFactory $layerFactory)
    {
        $this->screen = $screen;

        $this->layerStack = $layerFactory->getLayerStack($this->screen);
    }

    public function toSVG()
    {
        $width = $this->screen->getWidthInPixels();
        $height = $this->screen->getHeightInPixels();

        $svg =
        '<svg xmlns="http://www.w3.org/2000/svg" '.
        'width="'.$width.'" height="'.$height.'" '.
        'viewbox="0 0 '.$width.' '.$height.'">';

        foreach ($this->layerStack->foreach() as $layer) {
            $svg .= $layer->toSVG();
        }

        return $svg.'</svg>';
    }

    public function getName()
    {
        return $this->screen->getName();
    }

    public function getFilename()
    {
        return $this->screen->getFilename();
    }

    public function getWidth()
    {
        return $this->screen->getWidthInPixels();
    }

    public function getHeight()
    {
        return $this->screen->getHeightInPixels();
    }
}
