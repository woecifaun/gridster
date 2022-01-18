<?php

Namespace App\Importer;

use App\Warping\Screen\Screen;
use App\Warping\Screen\ScreenCollection;

class ScreensCSVImporter {

    private $screens;

    protected const FIELDS = [
        "name" => "Name of the screen (can be displayed on the grid)",
        "filename" => "URL compatible name",
        "width" => "Width in whatever unit specified",
        "height" => "Height in whatever unit specified",
        "density" => "pixel/meter or pixel/foot depending on the specified unit. Doesn't apply with unit in px",
        "unit" => "Can be meter, ft or pixel (density is not applied for the latter)",
        "origin-x" => "From left to right",// From left to right (like Blender top view)
        "origin-y" => "From bottom to top (default 50%)", // From bottom to top (like Blender top view)
        "origin-unit" => "Can be percent, pixel, meter or foot"
    ];

    public function __construct(array $post)
    {
        if (empty($post['screens-csv'])) {
            throw new ImporterException("CSV settings for screens not provided!", 1);
        }

        $this->screens = new ScreenCollection();
        $screens = explode(PHP_EOL, $post['screens-csv']);

        $count = count(self::FIELDS);
        $fields = array_keys(self::FIELDS);

        foreach ($screens as $screen) {
            if (empty($screen)) {
                continue;
            }
            $screen = str_getcsv($screen,',');
            foreach ($fields as $key => $field) {
                $tmpScreen[$field] = isset($screen[$key]) ? $screen[$key] : null;
            }
            $this->screens->addScreen(new Screen($tmpScreen));
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
