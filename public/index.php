<?php

use App\Project\ProjectCenter;

require(__DIR__ . "/../app/root.php");

$projectCenter = new ProjectCenter(PROJECT_FOLDER);

if (isset($_POST['new-project'])) {
  $project = $projectCenter->createProject($_POST);
}


echo $twig->render('UI/index.html.twig', [
    'projects' => $projectCenter->listProjects(),
    'stage' => $stage,

    'screen_fields' => $screenFields,
    'projectorFields' => $projectorFields,

    'layers' => $layerSettings,

    'warping' => $warping,
    'watchoutSizes' => $watchoutSizes,
]);
