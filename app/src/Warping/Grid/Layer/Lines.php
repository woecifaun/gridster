<?php

Namespace App\Warping\Grid\Layer;

Use App\Warping\Screen\Screen;

class Lines extends LayerAbstract
{
    // calculated from Screen Object
    protected $width;
    protected $height;

    // Origin
    // Calculated from Screen Object (in pixels)
    // In case, real world units defined in layer settings for a "pixel" screen, fallback to (0,0)
    protected $x = 0;
    protected $y = 0;

    // Grid division
    // Calculated from Screen Object & Grid settings (in pixels)
    // if not possible to transpose IRL unit to pixel, fallback to 100 px
    protected $division = 100;

    // From provided layer settings
    protected $thickness = 1;
    protected $color = 'white';
    protected $divisionUnit = 'pixel';

    // int number of squares in the main square (not numbers of lines)
    protected $subdivision = 1;

    // Just a trick for now but should be settable in the UI
    protected $subColors = [
        'tomato' => 'aquamarine',
        'aquamarine' => 'magenta',
        'magenta' => 'LightGreen',
        'LightGreen' => 'tomato'
    ];

    protected const SUPPORTED_UNITS = ['pixel', 'percent', 'meter', 'foot'];

    public function __construct(array $settings, Screen $screen)
    {
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

        // Set subdivision
        $this->setSubdivision($settings);
    }

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

    public function setSubdivision($subdivision)
    {
        if (!empty($subdivision['subdivision'])) {
            $this->subdivision = (int) $subdivision['subdivision'];
        }

        // otherwise fallback to default value -> 1
    }
}
