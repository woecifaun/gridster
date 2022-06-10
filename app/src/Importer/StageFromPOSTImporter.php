<?php

Namespace App\Importer;

use App\Warping\Stage\ScreenCollection;

class StageFromPOSTImporter
{
    public function __construct($stage, array $post)
    {
        $this->screens = new ScreenCollection();

        foreach ($post['groups'] as $group) {
            $collection = new ScreenCollection();

            $collection->setName($group['name']);
            $collection->setStartX($group['start-x']);
            $collection->setStartY($group['start-y']);
            $collection->setAlignment($group['alignment']);

            $stage->appendScreenGroup($collection);
        }
    }

    static public function getFields()
    {
        return self::FIELDS;
    }

    public function getScreens()
    {
        return $this->screens;
    }
}
