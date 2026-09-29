<?php

if (!isset($_GET['project'])) {
  throw new Exception("Missing project id in query string (e.g ?project=project-a).", 1);
}


use App\Project\ProjectCenter;

require(__DIR__ . "/../app/root.php");

$projectCenter = new ProjectCenter(PROJECT_FOLDER);
$project = $projectCenter->loadProject($_GET['project']);

echo $twig->render('UI/project.html.twig', [
    'project' => $project,
    'stage' => $stage,

    'screen_fields' => $screenFields,
    'projectorFields' => $projectorFields,

    'layers' => $layerSettings,

    'warping' => $warping,
    'watchoutSizes' => $watchoutSizes,
]);
