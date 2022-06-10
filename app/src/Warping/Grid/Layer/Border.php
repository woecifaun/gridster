<?php

Namespace App\Warping\Grid\Layer;

use App\Warping\Stage\Screen;

class Border extends LayerAbstract implements LayerInterface
{
    // dimensions are CSS "outbox" style i.e. content + border = width…
    private $width;
    private $height;
    private $thickness = 1;
    private $color = 'white';


    public function __construct(array $settings, Screen $screen)
    {
        $this->width = $screen->getWidthInPixels();

        $this->height = $screen->getHeightInPixels();

        if (!empty($settings['thickness'])) {
            $this->thickness = (float)$settings['thickness'];
        }

        if (!empty($settings['color'])) {
            $this->color = $settings['color'];
        }
    }

    public function toSVG()
    {
        $width = $this->width - $this->thickness;
        $height = $this->height - $this->thickness;

       return
        '<g id="border">'.
        '<rect id="borderid" name="bordername" '.
        'x="'. $this->thickness / 2 .'" y="'. $this->thickness / 2 .'" '.
        'width="'. $width .'" height="'. $height .'" fill="none" '.
        'style="stroke-width:'. $this->thickness .'px;stroke:'. $this->color .';fill:none;" />'.
        '</g>';
    }
}
