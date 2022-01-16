<?php

Namespace App\Warping\Screen;

/**
 * Should have been App\Warping\Grid\Origin but origin settings are per screen.
 * */

class Origin
{
    // Used for calculating origin location within the grid
    // as well as subgrid point zero
    private $x = 0;
    private $y = 0;
    private $unit = 'pixel';

    private const SUPPORTED_UNITS = ['pixel', 'percent', 'meter', 'foot'];

    public function __construct($settings)
    {
        if (!isset($settings['origin'])) {
            return;
        }

        if (!isset($settings['origin']['x'])) {
            throw new ScreenException("X Origin must be defined", 1);
        }

        if (!isset($settings['origin']['y'])) {
            throw new ScreenException("Y Origin must be defined", 1);
        }

        if (!isset($settings['origin']['unit'])) {
            throw new ScreenException("Unit for Origin must be defined", 1);
        }

        if (!in_array($settings['origin']['unit'], self::SUPPORTED_UNITS)) {
            throw new ScreenException("Unit for Origin must be defined", 1);
        }

        $this->x = $settings['origin']['x'];
        $this->y = $settings['origin']['y'];
        $this->unit = $settings['origin']['unit'];
    }

    public function getX()
    {
        return $this->x;
    }

    public function getY()
    {
        return $this->y;
    }

    public function getUnit()
    {
        return $this->unit;
    }
}