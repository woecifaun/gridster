<?php

require(__DIR__ . "/../app/root.php");

echo $twig->render('UI/index-old.html.twig', [
    'stage' => $stage,

    'screen_fields' => $screenFields,
    'projectorFields' => $projectorFields,

    'layers' => $layerSettings,

    'warping' => $warping,
    'watchoutSizes' => $watchoutSizes,
]);
