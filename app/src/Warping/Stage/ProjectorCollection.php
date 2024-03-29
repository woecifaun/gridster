<?php

Namespace App\Warping\Stage;

class ProjectorCollection implements \Countable
{
    /**
     *  For now, only possible choice is 'bottom'
     *  Not even sure it should be in this class (or in Screen object)
     */
    protected $alignment = 'bottom'; // For now

    protected $projectors = [];

    protected const SUPPORTED_UNITS = ['pixel', 'percent', 'meter', 'foot'];

    public function addProjector(Projector $projector)
    {
        $this->projectors[] = $projector;
    }

    public function getAlignment()
    {
        return $this->alignment;
    }

    public function foreach()
    {
        return $this->projectors;
    }

    public function count(): int
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
