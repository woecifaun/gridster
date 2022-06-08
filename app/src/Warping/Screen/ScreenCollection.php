<?php

Namespace App\Warping\Screen;

class ScreenCollection {

    private $screens = [];

    public function addScreen(Screen $screen)
    {
        $this->screens[] = $screen;
    }

    public function foreach()
    {
        return $this->screens;
    }

    public function count()
    {
        return count($this->screens);
    }

    public function getScreen($screenName)
    {
        foreach ($this->screens as $screen) {
            if ($screen->getName() == $screenName) {
                return $screen;
            }
        }
    }
}
