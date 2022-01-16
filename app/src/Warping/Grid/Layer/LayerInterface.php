<?php

Namespace App\Warping\Grid\Layer;

Use App\Warping\Screen\Screen;

interface LayerInterface {

    public function __construct(array $settings, Screen $screen);

    public function getType();

    public function toSVG();
}
