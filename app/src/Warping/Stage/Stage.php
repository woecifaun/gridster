<?php

Namespace App\Warping\Stage;

class Stage {

    /**
     * ScreenCollection[]
     */
    private $screenGroups = [];

    public function appendScreenGroup(ScreenCollection $group)
    {
        $this->screenGroups[] = $group;
    }

    public function getScreenGroups()
    {
        return $this->screenGroups;
    }
}