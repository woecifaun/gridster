<?php

Namespace App\Warping;

use App\FileSystem\FileSystem;
use App\Warping\Grid\Grid;
use App\Warping\Grid\Layer\LayerFactory;
use App\Warping\Screen\ScreenCollection;

class Warping
{
    // settings for each grid : background, border, marks, grid, projector ids…
    private $layerFactory = [];

    // Screens in real life with values in meters, inches or pixels and their projectors
    private $screens = [];

    // Generated grids based on layers settings above and real life screens features
    private $grids = [];


    public function __construct(array $post)
    {
        // if (empty($post['layers'])) {
        //     throw new WarpingException("Layers settings must be provided through \$_POST", 1);
        // }

        if (empty($post['screens'])) {
            throw new WarpingException("Screens specifications must be provided through \$_POST", 1);
        }

        $this->layerFactory = new LayerFactory($post);

        $this->screens = new ScreenCollection($post);

        foreach ($this->screens->foreach() as $screen) {
            $grid = new Grid($screen, $this->layerFactory);
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
