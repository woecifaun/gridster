<?php

Namespace App\Importer;

use App\Warping\Stage\ScreenCollection;
use App\Warping\Stage\Stage;

class StageCSVImporter {

    /**
     * Stage
     */
    private $stage;

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

    static public function getFields()
    {
        return self::FIELDS;
    }

    public function getScreenGroups()
    {
        return $this->screens;
    }
}
