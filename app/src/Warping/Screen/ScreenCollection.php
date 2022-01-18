<?php

Namespace App\Warping\Screen;

class ScreenCollection {

    private $screens = [];

    public function __construct()
    {
        // if (empty($post['screens'])) {
        //     $screens = require DOCUMENT_ROOT.'/app/defaults/screens.php';
        // } else {
        //     // $screens = json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $post['screens']), true);
        //     $screens = explode(PHP_EOL, $post['screens']);
        // }

        // if (!is_array($screens)) {
        //     throw new ScreenException("Screens settings is not an array", 1);
        // }

        // foreach ($screens as $screen) {
        //     $this->screens[] = new Screen($screen);
        // }
    }

    public function addScreen(Screen $screen)
    {
        $this->screens[] = $screen;
    }

    public function foreach()
    {
        return $this->screens;
    }
}
