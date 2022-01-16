<?php

Namespace App\Exporter\Watchout;


class Adapter
{
    /**
     * Grids $grids
     */
    public function adaptForVirtualDisplays($grids, array $offset)
    {
        $id = 7; // was the first ID when copied/pasted from Watchout
        $screens = [];
        $left = $offset[0];
        $top = $offset[1];

        foreach ($grids as $grid) {
            $screen = [];

            $screen['name'] = $grid->getName();
            $screen['id'] = $id;
            $screen['width'] = $grid->getWidth();
            $screen['height'] = $grid->getWidth();
            $screen['x'] = $left + round($grid->getWidth() / 2);
            $screen['y'] = $top + round($grid->getHeight() / 2);

            $id++;
            $left += $grid->getWidth();
            $screens[] = $screen;
        }

        return $screens;
    }
}
