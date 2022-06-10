<?php

Namespace App\Warping\Grid\Layer;

Use App\SVG\Line;
Use App\Warping\Stage\Screen;

class Grid extends LayerAbstract
{
    // calculated from Screen Objec
    private $width;
    private $height;

    // Origin
    // Calculated from Screen Object (in pixels)
    // In case, real world units defined in layer settings for a "pixel" screen, fallback to (0,0)
    private $x = 0;
    private $y = 0;

    // Grid division
    // Calculated from Screen Object & Grid settings (in pixels)
    // if not possible to transpose IRL unit to pixel, fallback to 100 px
    private $division = 100;

    // From provided layer settings
    private $thickness = 1;
    private $color = 'white';
    private $divisionUnit = 'pixel';
   /* private $step = '100';*/

    private const SUPPORTED_UNITS = ['pixel', 'percent', 'meter', 'foot'];

    public function __construct(array $settings, Screen $screen)
    {
        throw new GridException("DEPRECATED class. Use LinesHorizontal & LinesVertical", 1);

        // Checking $settings first
        if (!empty($settings['color'])) {
            $this->color = $settings['color'];
        }

        if (!empty($settings['thickness'])) {
            $this->thickness = $settings['thickness'];
        }

        if (empty($settings['unit'])) {
            throw new LayerException("Unit for Grid Layer must be provided : ".implode(',', self::SUPPORTED_UNITS), 1);
        }

        if (!in_array($settings['unit'], self::SUPPORTED_UNITS)) {
            throw new LayerException("Unit for Grid Layer is not supported -> ".$settings['unit'], 1);
        }
        $this->divisionUnit = $settings['unit'];

        /*if (!empty($settings['step'])) {
            $this->step = $settings['step'];
        }*/

        // Calculating proper values for the Grid layer
        $this->width = $screen->getWidthInPixels();
        $this->height = $screen->getHeightInPixels();

        // Check if settings are ok then set origin in pixels
        $this->setOrigin($screen);

        // Check if settings are ok then set step in pixels
        $this->setDivision($settings, $screen);
    }

    public function toSVG()
    {
        $line = new Line();
        $line->width($this->thickness)->color($this->color);
        $style = 'style="stroke:'. $this->color .';stroke-width:'. $this->thickness .';"';

        $grid = '<g id="grid">';

        $increment = 1;
        while ($this->width > ($x = $this->x + ($this->division * $increment))) {
            $grid .= '<line x1="'.$x.'" y1="0" x2="'.$x.'" y2="100%" '.$style.'/>';
            $increment++;
        }

        $increment = 1;
        while (0 < ($x = $this->x - ($this->division * $increment))) {
            $grid .= '<line x1="'.$x.'" y1="0" x2="'.$x.'" y2="100%" '.$style.'/>';
            $increment++;
        }

        $increment = 1;
        while ($this->height > ($y = $this->y + ($this->division * $increment))) {
            $grid .= '<line x1="0" y1="'.$y.'" x2="100%" y2="'.$y.'" '.$style.'/>';
            $increment++;
        }

        $increment = 1;
        while (0 < ($y = $this->y - ($this->division * $increment))) {
            $grid .= '<line x1="0" y1="'.$y.'" x2="100%" y2="'.$y.'" '.$style.'/>';
            $increment++;
        }

        // Addign origin lines on top
        $grid .= '<line x1="'.$this->x.'" y1="0" x2="'.$this->x.'" y2="100%" '.$style.'/>'.
        '<line x1="0" y1="'.$this->y.'" x2="100%" y2="'.$this->y.'" '.$style.'/>'.
        '</g>'
        ;

        return $grid;
    }

/*    public function prepareForJSON()
    {
        $layer = [];

        $layer['thickness'] = $this->thickness;
        $layer['color'] = $this->color;
        $layer['unit'] = $this->unit;
        $layer['step'] = $this->step;

        return $layer;
    }*/

    /**
     * Only used in __construct but needed to unclutter it
     */
    public function setOrigin(Screen $screen)
    {
        $originUnit = $screen->getOrigin()->getUnit();

        //Check first if origin is defined in percent
        if ($originUnit === 'percent') {
            $this->setOriginFromPercent($screen);
            return;
        }

        //Then check if screen unit is in pixel
        $screenUnit = $screen->getUnit();
        if ($screenUnit === 'pixel') {
            $this->setOriginWhenScreenUnitIsPixel($screen);
            return;
        }

        //Eventually get Origin from metric computation (special cases would already be handled above)
        $this->setOriginFromMetric($screen);
    }

    public function setOriginFromPercent(Screen $screen)
    {
        $xPercent = ($screen->getOrigin()->getX() > 1) ? $screen->getOrigin()->getX() / 100 : $screen->getOrigin()->getX();
        $yPercent = ($screen->getOrigin()->getY() > 1) ? $screen->getOrigin()->getY() / 100 : $screen->getOrigin()->getY();

        $this->x = $this->width * $xPercent;
        $this->y = $this->height - ($this->height * $yPercent);
    }

    public function setOriginWhenScreenUnitIsPixel(Screen $screen)
    {
        if ($screen->getOrigin()->getUnit() === 'pixel') {
            $this->x = $screen->getOrigin()->getX();
            $this->y = $screen->getOrigin()->getY();
            return;
        }

        // if layer settings is in a real world unit (meter or foot)
        // and screen is defined in pixe
        // fallback to (0,0) as origin
        // -> default for $this->x & $this->y
    }

    public function setOriginFromMetric(Screen $screen)
    {
        $density = $screen->getMetricDensity();

        $this->x = $screen->getOrigin()->getX() * $density;
        $this->y = $this->height - ($screen->getOrigin()->getY() * $density);
    }

    public function setDivision(array $settings, Screen $screen)
    {
        if ($this->divisionUnit === 'percent') {
            /* For now, percent means percent of width */
            /* It should be separated in two layers: horizontal lines & vertical lines */

            $percent = ($settings['step'] > 1) ? $settings['step'] / 100 : $this->step;
            $this->division = $this->width * $percent;
            return;
        }

        if ($screen->getUnit() === 'pixel') {
            if ($this->divisionUnit === 'pixel') {
                $this->division = $this->step;
            }

            // In case grid unit is IRL unit, don't do anything, just fallback to 100 px
            return;
        }

        $this->division = $this->step * $screen->getMetricDensity();
    }
}
