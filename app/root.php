<?php

use App\Importer\ScreensCSVImporter;
use App\Importer\ScreensFromPOSTImporter;
use App\FileSystem\FileSystem;
use App\Warping\Grid\Layer\LayerFactory;
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

// Screens
$screenFields = ScreensCSVImporter::getFields(); // Should fields be in Class Screen ?

$screens;
if (!empty($_POST['screens'])) {
    $importer = new ScreensFromPOSTImporter($_POST);
    $screens = $importer->getScreens();
}

if (!empty($_POST['load-screens'])) {
    $importer = new ScreensCSVImporter($_POST);
    $screens = $importer->getScreens();
}

// Projectors
$projectors = null;


$warping = null;

if (!empty($_POST['generate-grids'])) {
    $warping = new Warping($screens, $layerFactory);

    foreach ($warping->getGrids() as $grid) {
        $fileSystem->persistSVG($grid->getFilename(), $grid->toSVG());
    }
}

$watchoutSizes = null;
if (!empty($_POST['watchout-sizes'])) {
    $watchoutSizes = true; // trigger twig block
    $warping = new Warping($screens, $layerFactory);
}

