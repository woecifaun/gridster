<?php

Namespace App\Warping\Grid\Layer;

use App\Warping\Stage\Screen;

class LayerFactory {

    private $layers = [];

    public function __construct($layers)
    {
        // if (empty($post['layers'])) {
        //     throw new LayerException("Layers settings not found in $_POST", 1);
        // }

        $this->layers = $layers;
        // json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $post['layers']), true);
    }

    public function new($layerType, array $settings, Screen $screen){
        if (empty($layerType)) {
            throw new LayerException("Layer type must be provided", 1);
        }

        switch ($layerType) {
            case 'background':
                return new Background($settings, $screen);
                break;

            case 'border':
                return new Border($settings, $screen);
                break;

            case 'circles':
                return new Circles($settings, $screen);
                break;

            case 'diagonal':
                return new Diagonal($settings, $screen);
                break;

            case 'horizontal lines':
                return new LinesHorizontal($settings, $screen);
                break;

            case 'vertical lines':
                return new LinesVertical($settings, $screen);
                break;

            case 'name':
                return new Name($settings, $screen);
                break;

            case 'projectors':
                return new Projectors($settings, $screen);
                break;

            default:
                throw new LayerException("Layer type unknown", 1);
                break;
        }
    }

    public function getLayerStack(Screen $screen)
    {
        $layerStack = new LayerStack();

        foreach ($this->layers as $layerType => $settings) {
            $layer = $this->new($layerType, $settings, $screen);
            $layerStack->setLayer($layerType, $layer);
        }

        return $layerStack;
    }

    public function getLayerSettings()
    {
        return $this->layers;
    }
}
