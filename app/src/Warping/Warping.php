<?php

Namespace App\Warping;

use App\FileSystem\FileSystem;
use App\Warping\Grid\Grid;
use App\Warping\Grid\Layer\LayerFactory;
use App\Warping\Stage\ScreenCollection;

class Warping
{
    // settings for each grid : background, border, marks, grid, projector ids…
    protected $layerFactory = [];

    // Screens in real life with values in meters, inches or pixels and their projectors
    protected $screens = [];

    // Generated grids based on layers settings above and real life screens features
    protected $grids = [];


    public function __construct(ScreenCollection $screens, LayerFactory $layerFactory)
    {
        $this->layerFactory = $layerFactory;
        $this->screens = $screens;

        foreach ($this->screens->foreach() as $screen) {
            // $grid = new Grid($screen, $this->layerFactory);
            $this->grids[] = new Grid($screen, $this->layerFactory);
        }
    }

    public function getGrids()
    {
        return $this->grids;
    }

    public function getScreensToJSON()
    {
        // return "hello\n\rstop";
        return $_POST['screens'];
    }

    public function getLayersToJSON()
    {
        return $_POST['layers'];

        // return json_encode($_POST['layers'], JSON_PRETTY_PRINT);
    }

    public function getScreens()
    {
        return $this->screens;
    }
}
