<?php

Namespace App\Importer;

use App\Warping\Stage\Screen;
use App\Warping\Stage\ScreenCollection;

class ScreensFromPOSTImporter {

    private $screens;

    protected const FIELDS = [
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

    public function __construct(array $post)
    {
        if (empty($post['screens'])) {
            throw new ImporterException("Settings for screens not provided!", 1);
        }

        $this->screens = new ScreenCollection();

        foreach ($post['screens'] as $screen) {
            $this->screens->addScreen(new Screen($screen));
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
