<?php

// use App\Warping\Stage\ScreenCollection;

require(__DIR__."/app/root.php");

echo $twig->render('UI/index.html.twig', [
    'stage' => $stage,
    
    'screen_fields' => $screenFields,
    'screens' => $screens,

    'layers' => $layerSettings,

    'projectorFields' => $projectorFields,
    'projectors' => $projectors,

    'warping' => $warping,
    'watchoutSizes' => $watchoutSizes,
]);
