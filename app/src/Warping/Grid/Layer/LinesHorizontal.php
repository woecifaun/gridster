<?php

Namespace App\Warping\Grid\Layer;

Use App\SVG\Line;
Use App\Warping\Screen\Screen;

class LinesHorizontal extends Lines implements LayerInterface
{
    public function toSVG()
    {
        $line = new Line();
        $line->x1(0)->x2('100%');

        $grid = '<g id="horizontal-lines">';

        $subColor = reset($this->subColors);

        // Subdivision first
        // TO DO add interactive settings for color and width
        $increment = round(1 / $this->subdivision, 2);
        while (($y = $this->y - ($this->division * $increment)) > 0) {
            // trick to loop through colors w/o taking care of the array count (for now)
            $subColor = $this->subColors[$subColor];

            $grid .= $line->color($subColor)->width("0.5")->y1($y)->y2($y)->render();
            $increment += round(1 / $this->subdivision, 2);
        }

        // Then main grid
        $increment = 1;
        while (($y = $this->y - ($this->division * $increment)) > 0) {
            $grid .= $line->color($this->color)->width($this->thickness)->y1($y)->y2($y)->render();
            $increment++;
        }

        // Subdivision first
        // TO DO add interactive settings for color and width
        $increment = round(1 / $this->subdivision, 2);
        while (($y = $this->y + ($this->division * $increment)) < $this->height) {
            // trick to loop through colors w/o taking care of the array count (for now)
            $subColor = $this->subColors[$subColor];

            $grid .= $line->color('white')->width("0.5")->y1($y)->y2($y)->render();
            $increment += round(1 / $this->subdivision, 2);
        }

        $increment = 1;
        while (($y = $this->y + ($this->division * $increment)) < $this->height) {
            $grid .= $line->color($this->color)->width($this->thickness)->y1($y)->y2($y)->render();
            $increment++;
        }

        // Adding origin lines on top
        // Color and Width for origin must be added to user settings (one day)
        $grid .= $line->width(4)->color('white')->y1($this->y)->y2($this->y)->render();

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
            $this->division = $this->width * $percent; // <- the difference is here
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
