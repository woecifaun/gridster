<?php

Namespace App\Warping;

use App\FileSystem\FileSystem;
use App\Warping\Grid\Grid;
use App\Warping\Grid\Layer\LayerFactory;
use App\Warping\Stage\ScreenCollection;
use App\Warping\Stage\Stage;

class Warping
{
    // settings for each grid : background, border, marks, grid, projector ids…
    protected $layerFactory = [];

    // Screens in real life with values in meters, inches or pixels and their projectors
    protected $stage;

    // Generated grids based on layers settings above and real life screens features
    protected $grids = [];


    public function __construct(Stage $stage, LayerFactory $layerFactory)
    {
        $this->layerFactory = $layerFactory;
        $this->stage = $stage;

        foreach ($this->stage->getScreenGroups() as $group)
        {
            foreach ($group->foreach() as $screen) {
                $this->grids[] = new Grid($screen, $this->layerFactory);
            }
        }
    }

    public function getGrids()
    {
        return $this->grids;
    }

    public function getScreens()
    {
        return $this->screens;
    }
}
