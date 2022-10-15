<?php

Namespace App\Service;

use App\Warping\Grid\Grid;

class PNGMaker
{
    public function convertSVG($filename, Grid $grid)
    {
        $path = pathinfo($filename);
        $im = new \Imagick();
        $svg = file_get_contents($filename);

        $im->readImageBlob($svg);
        $im->setImageResolution(
            $grid->getWidth(),
            $grid->getHeight()
        );

        $im->setImageFormat("png24");

        $im->writeImage($path['dirname'].DIRECTORY_SEPARATOR.$path['filename'].'.png');
        $im->clear();
        $im->destroy();
    }
}
