<?php

Namespace App\Importer;

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

    public function __construct($stage, array $post)
    {
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

        foreach ($post['screens'] as $screenProperties) {
            $screen = new Screen($screenProperties);

            $stage->addScreenToGroup($screen, $screenProperties['group-index']);
        }
    }

    static public function getFields()
    {
        return self::SCREEN_FIELDS;
    }

    public function getScreens()
    {
        return $this->screens;
    }
}
