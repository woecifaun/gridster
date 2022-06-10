<?php

Namespace App\Importer;

use App\Warping\Stage\Projector;
use App\Warping\Stage\ProjectorCollection;
use App\Warping\Stage\Screen;
use App\Warping\Stage\ScreenCollection;

class ProjectorsFromPOSTImporter {

    private $projectors;

    protected const FIELDS = [
        "name",
        "screen",
        "width",
        "height",
        "output",
        "ip",
    ];

    public function __construct(array $post, ScreenCollection $screens)
    {
        if (empty($post['projectors'])) {
            throw new ImporterException("Settings for projectors not provided!", 1);
        }

        $this->projectors = new ProjectorCollection();

        foreach ($post['projectors'] as $projectorArray) {
            $projector = new Projector($projectorArray);
            $this->projectors->addProjector($projector);
            
            if (!empty($screens) && $screen = $screens->getScreen($projector->getScreen())) {
                $screen->appendProjector($projector);
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
