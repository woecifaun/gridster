<?php

// use App\Warping\Screen\ScreenCollection;

require(__DIR__."/app/root.php");

// $screens = include(DOCUMENT_ROOT.'/app/defaults/vangogh-boston.php');


echo $twig->render('UI/index.html.twig', [
    'screen_fields' => $screenFields,
    'screens' => $screens,

    'layers' => $layerSettings,

    'projectorFields' => $projectorFields,
    'projectors' => $projectors,

    'warping' => $warping,
    'watchoutSizes' => $watchoutSizes,
]);
