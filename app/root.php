<?php

use App\FileSystem\FileSystem;
use App\Importer\StageCSVImporter;
use App\Importer\StageFromPOSTImporter;
use App\Service\PNGMaker;
use App\Warping\Grid\Layer\LayerFactory;
use App\Warping\Stage\Stage;
use App\Warping\Warping;

define('DOCUMENT_ROOT',realpath(__DIR__."/.."));

require DOCUMENT_ROOT.'/app/config/config.php';
require DOCUMENT_ROOT.'/vendor/autoload.php';


$fileSystem = new FileSystem(SVG_FOLDER);

$loader = new \Twig\Loader\FilesystemLoader(TEMPLATE_FOLDER);
$twig = new \Twig\Environment($loader);

// print_r($_POST);die;
// Layers
$layerSettings = include(DOCUMENT_ROOT.'/app/defaults/layers.php');
$layerFactory = new LayerFactory($layerSettings);


// Stage
// Stage is a collection of groups
// a group features collection of screens
// a screen features a collection of projectors

$stage = new Stage();

// Always try to load stage from POST
new StageFromPOSTImporter($stage, $_POST);

// print_r($stage);die(__FILE__.__LINE__);

if (!empty($_POST['import-stage-from-csv'])) {
    $stage = new Stage();
    $importer = new StageCSVImporter($stage, $_POST);
}

// print_r($stage);die(__FILE__.__LINE__);

// Form Helpers
if (!empty($_POST['add-group'])) {
    $stage->appendEmptyGroup();
}

$screenFields = StageCSVImporter::getScreenFields(); // Should fields be in Class Screen ?

$projectorFields = StageCSVImporter::getProjectorFields();


$warping = new Warping($stage, $layerFactory);


if (!empty($_POST['generate-grids'])) {
    $converter = new PNGMaker();

    foreach ($warping->getGrids() as $grid) {
        $fileSystem->persistSVG($grid->getFilename(), $grid->toSVG());

        $converter->convertSVG(
            $fileSystem->getFullPath($grid->getFilename().'.svg'),
            $grid
        );
    }
}

$watchoutSizes = null;
if (!empty($_POST['watchout-sizes'])) {
    $watchoutSizes = true; // trigger twig block
}
