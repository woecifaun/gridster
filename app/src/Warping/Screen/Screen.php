<?php

Namespace App\Warping\Screen;

class Screen {

    protected $name = 'Screen Name';
    protected $unit = 'pixel'; // Can be meter, ft or pixel if so, density will not be used
    protected $width = 1920;
    protected $height = 1200;

    // density in pixels / meter or pixel / foot depending on unit
    // if not provided is set to 1 (for width & height provided in pixels)
    protected $density = null;

    // unit is not really necessary
    // if one sets density to 1 or null when in pixel
    // or with specific density when in other real world unit
    // calculation will be good anyway
    // but should be kept for UX when asking for density
    // it makes logical sense to ask for the unit
    protected const SUPPORTED_UNITS = ['pixel', 'meter', 'foot'];

    protected $origin;

    /**
     * Projector[]
     */
    protected $projectors = [];

    /**
     * How projectors are aligned
     * 'bottom' or 'top' means horizontaly
     * 'left' or 'right' means verticaly
     * 'position' means each projector must be provided with (x,y) coordinates
     */
    protected $projectorAlignment;

    public function __construct(array $screen)
    {
        if (empty($screen['name'])) {
            throw new ScreenException("Screen name must be specified", 2);
        }

        // TO DO check for proper filename with no special character
        if (empty($screen['filename'])) {
            throw new ScreenException("Screen filename must be specified", 2);
        }

        if (empty($screen['unit']) || !in_array($screen['unit'], self::SUPPORTED_UNITS)) {
            throw new ScreenException("Screen unit is not correct", 1);
        }

        if (empty($screen['width'])) {
            throw new ScreenException("Screen width must be specified", 2);
        }

        if (empty($screen['height'])) {
            throw new ScreenException("Screen height must be specified", 2);
        }

        $this->name = $screen['name'];
        $this->filename = $screen['filename'];
        $this->unit = $screen['unit'];
        $this->width = $screen['width'];
        $this->height = $screen['height'];
        $this->density = !empty($screen['density']) ? $screen['density'] : 1;

        $this->origin = new Origin($screen, $this->width, $this->height);
        $this->projectors = new ProjectorCollection($screen);
    }

    public function getWidthInPixels()
    {
        return (int) round($this->width * $this->density);
    }

    public function getHeightInPixels()
    {
        return (int) round($this->height * $this->density);
    }

    public function getOrigin()
    {
        return $this->origin;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getFilename()
    {
        return $this->filename;
    }

    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * Return density in metric system as it is ISO
     */
    public function getMetricDensity()
    {
        if ($this->unit == 'pixel') {
            throw new ScreenException("Cannot determine screen density for [".$this->name."]. A real life unit must be provided e.g meter or foot.", 1);
        }

        if ($this->unit == 'meter') {
            return $this->density;
        }

        if ($this->unit == 'foot') {
            return $this->density / UNIT_FOOT;
        }

    }

    public function getProjectors()
    {
        return $this->projectors;
    }
}
