<?php

Namespace App\Importer;

use App\Warping\Stage\ScreenCollection;
use App\Warping\Stage\Screen;
use App\Warping\Stage\Stage;

class StageCSVImporter {

    /**
     * Stage
     */
    private $stage;

    protected const SCREEN_FIELDS = [
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

    public function __construct(Stage $stage, array $post)
    {
        $this->stage = $stage;
        $currentGroup;
        $currentScreen;

        if (empty($post['stage-csv'])) {
            throw new ImporterException("CSV settings for Stage is not provided!", 1);
        }

        $csv = explode(PHP_EOL, $post['stage-csv']);

        foreach ($csv as $line) {
            if (empty($line)) {
                continue;
            }
            $line = str_getcsv($line,',');

            if ($line[0] == 'group') {
                $currentGroup = $this->createGroup($line);
                $this->stage->appendScreenGroup($currentGroup);
            }

            if (array_shift($line) == 'screen') {
                $currentScreen = $this->createScreen($line);
                $currentGroup->addScreen($currentScreen);
            }
        }
    }

    protected function createGroup(array $group)
    {
        $collection = new ScreenCollection();

        $collection->setName($group[1]);
        $collection->setStartX($group[2]);
        $collection->setStartY($group[3]);
        $collection->setAlignment($group[4]);

        return $collection;
    }

    protected function createScreen(array $values)
    {
        $fields = array_keys(self::SCREEN_FIELDS);

        foreach ($fields as $key => $field) {
            $tmpScreen[$field] = isset($values[$key]) ? $values[$key] : null;
        }
        
        return new Screen($tmpScreen);
    }

    static public function getFields()
    {
        return self::FIELDS;
    }

    public function getScreenGroups()
    {
        return $this->screens;
    }
}
