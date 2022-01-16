<?php

Namespace App\Warping\Grid\Layer;

class LayerStack {

    // settings for each grid : background, border, marks, grid, projector ids…
    private $layers = [];

    public function setLayer(string $layerType, LayerInterface $layer)
    {
        $this->layers[$layerType] = $layer;
    }

    public function getLayer($layerType)
    {
        if(!isset($this->layers[$layerType])) {
            throw new LayerException("Unable to get layer with name '$layerType'", 1);
        }

        return $this->layers[$layerType];
    }

    public function foreach()
    {
        return $this->layers;
    }
}
