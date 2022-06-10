<?php

Namespace App\Importer;

use App\Warping\Stage\Projector;
use App\Warping\Stage\ProjectorCollection;
use App\Warping\Stage\ScreenCollection;

class ProjectorsCSVImporter {

    private $projectors;

    protected const FIELDS = [
        "name" => "Name of the screen (can be displayed on the grid)",
        "screen" => "Name of the screen to attach the projector",
        "width" => "Width in pixels (compute any rotation before filling this field)",
        "height" => "Height in pixels (compute any rotation before filling this field)",
        "output" => "Server output (server id and output id)",
        "ip" => "Can be meter, ft or pixel (density is not applied for the latter)",
    ];

    public function __construct(array $post, ?ScreenCollection $screens)
    {
        if (empty($post['projectors-csv'])) {
            throw new ImporterException("CSV settings for projectors not provided!", 1);
        }

        $this->projectors = new ProjectorCollection();
        $projectors = explode(PHP_EOL, $post['projectors-csv']);

        $count = count(self::FIELDS);
        $fields = array_keys(self::FIELDS);

        foreach ($projectors as $projector) {
            if (empty($projector)) {
                continue;
            }
            $projector = str_getcsv($projector,',');
            foreach ($fields as $key => $field) {
                $tmpProjector[$field] = isset($projector[$key]) ? $projector[$key] : null;
            }

            $projectorObject = new Projector($tmpProjector);

            $this->projectors->addProjector($projectorObject);

            if (!empty($screens) && $screen = $screens->getScreen($projectorObject->getScreen())) {
                $screen->appendProjector($projectorObject);
            }
        }
    }

    static public function getFields()
    {
        return self::FIELDS;
    }

    public function getProjectors()
    {
        return $this->projectors;
    }
}
