<?php

Namespace App\Importer;

use App\Warping\Stage\Projector;
use App\Warping\Stage\Screen;
use App\Warping\Stage\ScreenCollection;

class StageFromPOSTImporter
{
    protected const SCREEN_FIELDS = [
        "name",
        "filename",
        "width",
        "height",
        "density",
        "unit",
        "origin-x",
        "origin-y",
        "origin-unit",
    ];

    protected const PROJECTOR_FIELDS = [
        "name",
        "width",
        "height",
        "output",
        "ip",
    ];

    public function __construct($stage, array $post)
    {
        // print_r($post);die(__FILE__);
        if (empty($post['groups'])) {
            return;
        }

        foreach ($post['groups'] as $group) {
            $collection = new ScreenCollection();

            $collection->setName($group['name']);
            $collection->setStartX($group['start-x']);
            $collection->setStartY($group['start-y']);
            $collection->setAlignment($group['alignment']);

            $stage->appendScreenGroup($collection);
        }

        if (empty($post['screens'])) {
            return;
        }

        $screens = [];
        $screenIndex = 0;

        foreach ($post['screens'] as $screenProperties) {
            $screens[$screenIndex] = new Screen($screenProperties);

            $stage->addScreenToGroup($screens[$screenIndex], $screenProperties['group-index']);
            $screenIndex++;
        }

        if (empty($post['projectors'])) {
            return;
        }

        foreach ($post['projectors'] as $projectorProperties) {
            $projector = new Projector($projectorProperties);

            $screenIndex = (int) $projectorProperties['screen-index'];
            $screens[$screenIndex]->appendProjector($projector);
        }


    }

    static public function getScreenFields()
    {
        return self::SCREEN_FIELDS;
    }

    static public function getProjectorFields()
    {
        return self::PROJECTOR_FIELDS;
    }

    public function getScreens()
    {
        return $this->screens;
    }
}
