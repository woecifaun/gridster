<?php

// use App\Warping\Screen\ScreenCollection;

require(__DIR__."/app/root.php");

// $screens = include(DOCUMENT_ROOT.'/app/defaults/vangogh-boston.php');


echo $twig->render('UI/index.html.twig', [
    'fields' => $screenFields,

    'layers' => $layerSettings,
    'screens' => $screens,
    'projectors' => $projectors,

    'warping' => $warping,
    'watchoutSizes' => $watchoutSizes,
]);
