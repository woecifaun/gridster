<?php

Namespace App\Warping\Grid\Layer;

Use App\SVG\Line;
Use App\Warping\Screen\Screen;

class LinesVertical extends Lines implements LayerInterface
{
    public function toSVG()
    {
        $line = new Line();
        $line->y1(0)->y2('100%');

        $grid = '<g id="vertical-lines">';

        // Subdivision first
        // TO DO add interactive settings for color and width
        $increment = round(1 / $this->subdivision, 2);
        while (($x = $this->x + ($this->division * $increment)) < $this->width) {
            $grid .= $line->color('white')->width("0.5")->x1($x)->x2($x)->render();
            $increment += round(1 / $this->subdivision, 2);
        }

        $increment = 1;
        while (($x = $this->x + ($this->division * $increment)) < $this->width) {
            $grid .= $line->color($this->color)->width($this->thickness)->x1($x)->x2($x)->render();
            $increment++;
        }

        // Subdivision first
        // TO DO add interactive settings for color and width
        $increment = round(1 / $this->subdivision, 2);
        while (($x = $this->x - ($this->division * $increment)) > 0) {
            $grid .= $line->color('white')->width("0.5")->x1($x)->x2($x)->render();
            $increment += round(1 / $this->subdivision, 2);
        }

        $increment = 1;
        while (($x = $this->x - ($this->division * $increment)) > 0) {
            $grid .= $line->color($this->color)->width($this->thickness)->x1($x)->x2($x)->render();
            $increment++;
        }

        // Adding origin lines on top
        $grid .= $line->width(4)->color('white')->x1($this->x)->x2($this->x)->render();

        return $grid.'</g>';
    }

    /**
     * This method differs between LinesHorizontal & LinesVertical
     * for the part of calculating in percent
     */
    public function setDivision(array $settings, Screen $screen)
    {
        if ($this->divisionUnit === 'percent') {
            $percent = ($settings['step'] > 1) ? $settings['step'] / 100 : $this->step;
            $this->division = $this->height * $percent; // <- the difference is here
            return;
        }

        if ($screen->getUnit() === 'pixel') {
            if ($this->divisionUnit === 'pixel') {
                $this->division = $settings['step'];
            }

            // In case grid unit is IRL unit, don't do anything, just fallback to 100 px
            return;
        }

        $this->division = $settings['step'] * $screen->getMetricDensity();
    }
}
