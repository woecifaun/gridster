<?php

use App\FileSystem\FileSystem;
use App\Service\URICleaner;
use App\Warping\Warping;

define('DOCUMENT_ROOT',realpath(__DIR__."/.."));

require DOCUMENT_ROOT.'/app/config/config.php';
require DOCUMENT_ROOT.'/vendor/autoload.php';


$fileSystem = new FileSystem(SVG_FOLDER);

$loader = new \Twig\Loader\FilesystemLoader(TEMPLATE_FOLDER);
$twig = new \Twig\Environment($loader);

$warping = null;
if (!empty($_POST)) {
    $warping = new Warping($_POST);

    foreach ($warping->getGrids() as $grid) {
        $fileSystem->persistSVG($grid->getFilename(), $grid->toSVG());
    }
}

// $screens = json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $post['screens']), true);
