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

    public function appendEmptyGroup()
    {
        $new = new ScreenCollection();
        $new->setName('new group');

        $this->screenGroups[] = $new;
    }

    public function addScreenToGroup(Screen $screen, $groupIndex)
    {
        $this->screenGroups[$groupIndex]->addScreen($screen);
    }

    public function isEmpty()
    {
        $count = 0;

        foreach ($this->screenGroups as $group) {
            $count += count($group);
        }

        return ($count == 0);
    }

    public function getAllScreens()
    {
        $screens = new ScreenCollection();

        foreach ($this->screenGroups as $group) {
            foreach ($group as $screen) {
                $screens->addScreen($screen);
            }
        }

        return $screens;
    }
}
