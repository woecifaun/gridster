<?php

Namespace App\Warping\Grid\Layer;

use App\SVG\SVGNode;
use App\SVG\Text;
use App\Warping\Screen\Screen;

class Projectors extends LayerAbstract implements LayerInterface
{
    protected $width;
    protected $height;
    protected $align;
    protected $projectors = [];


    public function __construct(array $settings, Screen $screen)
    {
        // Do not need to check for projectors, handled in ProjectorCollection

        $this->width = $screen->getWidthInPixels();
        $this->height = $screen->getHeightInPixels();
        $this->projectors = $screen->getProjectors();
    }

    public function toSVG()
    {
        if (empty(count($this->projectors))) {
            return;
        }

        if (count($this->projectors) == 1) {
            return $this->renderForASingleProjector();
        }

        if ($this->projectors->getAlignment() == 'bottom') {
            return $this->renderForBottomAlignment();
        }
    }

    // public function getXStart()
    // {
    //     // Should be different depending on $this->align setting

    //     return 0;
    // }

    // public function getXStep()
    // {
    //     // print_r($this->projectors);

    //     $lastVP = $this->projectors->getLastProjector();
    //     $lastX = $this->width - ($lastVP->getWidth() / 2);

    //     $firstVP = $this->projectors->getFirstProjector();
    //     $firstX = $firstVP->getWidth() /2;

    //     return ($lastX - $firstX) / (count($this->projectors) - 1);
    // }

    // public function getYStart()
    // {
    //     // Should be different depending on $this->align setting

    //     return $this->height - 1920;
    // }

    // public function getYStep()
    // {
    //     return 0;
    // }

    protected function renderForASingleProjector()
    {
        $projector = $this->projectors->getFirstProjector();

        $svg = new SVGNode();
        $svg->width($this->width)->height($this->height)
            ->y(0)->x(0)
            ->id($projector->getName());

        $name = (new Text($projector->getName()))
            ->x('50%')->y('20%')
            ->color('gold')->size('60');
        $svg->append($name);

        $ip = (new Text($projector->getIp()))
            ->x('50%')->y('10%')
            ->color('white')->size('30');
        $svg->append($ip);

        $output = (new Text($projector->getOutput()))
            ->x('50%')->y('30%')
            ->color('white')->size('30');
        $svg->append($output);

        return $svg->render();
    }

    protected function renderForBottomAlignment()
    {
        // Bottom alignment means:
        // -  horizontal array of projectors
        // -  same dimension for every projectors
        // -  dimension is decided on the first one


        $width = $this->projectors->getFirstProjector()->getWidth();
        $xStep = ($this->width - $width) / (count($this->projectors) - 1) ;

        $i = 0;
        $svgAsText = '';

        foreach ($this->projectors->foreach() as $projector) {

            $x = $xStep * $i;

            $svg = new SVGNode();
            $svg->width($width)->height($this->height)
                ->y(0)->x($x)
                ->id($projector->getName());

            $name = (new Text($projector->getName()))
                ->x('50%')->y('20%')
                ->color('gold')->size('60');
            $svg->append($name);

            $ip = (new Text($projector->getIP()))
                ->x('50%')->y('10%')
                ->color('white')->size('30');
            $svg->append($ip);

            $output = (new Text($projector->getOutput()))
                ->x('50%')->y('30%')
                ->color('white')->size('30');
            $svg->append($output);

            $svgAsText .= $svg->render();

            $i++;
        }

        return $svgAsText;
    }
}
