<?php

Namespace App\Importer;

use App\Warping\Stage\Projector;
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

    protected const PROJECTOR_FIELDS = [
        "name" => "Name of the screen (can be displayed on the grid)",
        "width" => "Width in pixels (compute any rotation before filling this field)",
        "height" => "Height in pixels (compute any rotation before filling this field)",
        "output" => "Server output (server id and output id)",
        "ip" => "Can be meter, ft or pixel (density is not applied for the latter)",
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

            if ($line[0] == 'screen') {
                array_shift($line);
                $currentScreen = $this->createScreen($line);
                $currentGroup->addScreen($currentScreen);
            }

            if ($line[0] == 'projector') {
                array_shift($line);
                $projector = $this->createProjector($line);
                $currentScreen->appendProjector($projector);
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

    protected function createProjector(array $values)
    {
        $fields = array_keys(self::PROJECTOR_FIELDS);

        foreach ($fields as $key => $field) {
            $tmpProjector[$field] = isset($values[$key]) ? $values[$key] : null;
        }
        
        return new Projector($tmpProjector);
    }

    static public function getScreenFields()
    {
        return self::SCREEN_FIELDS;
    }

    static public function getProjectorFields()
    {
        return self::PROJECTOR_FIELDS;
    }

    public function getScreenGroups()
    {
        return $this->screens;
    }
}
