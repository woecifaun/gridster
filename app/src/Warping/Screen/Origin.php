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
        if (!array_key_exists('origin-x',$settings)) {
            throw new ScreenException("X Origin must be defined", 1);
        }

        if (!array_key_exists('origin-y',$settings)) {
            throw new ScreenException("Y Origin must be defined", 1);
        }

        if (isset($settings['origin-unit']) && !in_array($settings['origin-unit'], self::SUPPORTED_UNITS)) {
            throw new ScreenException("Unit for Origin must be one of ".implode(', ',self::SUPPORTED_UNITS), 1);
        }

        $this->x = $settings['origin-x'] ?? $this->x;
        $this->y = $settings['origin-y'] ?? $this->y;
        $this->unit = $settings['origin-unit'] ?? $this->unit;
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