<?php

Namespace App\Warping\Screen;

/**
 * Should have been App\Warping\Grid\Origin but origin settings are per screen.
 * */

class ProjectorCollection implements \Countable
{
    private $alignment = 0;
    private $projectors = [];

    private const SUPPORTED_UNITS = ['pixel', 'percent', 'meter', 'foot'];

    public function __construct($screen)
    {
        if (empty($screen['projectors'])) {
            return;
        }

        if (!isset($screen['projectors']['alignment'])) {
            throw new ScreenException("Alignment setting for projectors is not defined for screen [".$screen['name']."].", 1);
        }

        if (!is_array($screen['projectors']['list'])) {
            throw new ScreenException("List of projectors must be an array for screen [".$screen['name']."].", 1);
        }

        // TO DO : check for values is in known list
        $this->projectorAlignment = $screen['projectors']['alignment'];

        foreach ($screen['projectors']['list'] as $projector) {
            $this->projectors[] = new Projector($projector);
        }
    }

    public function getAlignment()
    {
        return $this->alignment;
    }

    public function foreach()
    {
        return $this->projectors;
    }

    public function count()
    {
        return count($this->projectors);
    }

    public function getFirstProjector()
    {
        return $this->projectors[0];
    }

    public function getLastProjector()
    {
        return end($this->projectors);
    }
}
