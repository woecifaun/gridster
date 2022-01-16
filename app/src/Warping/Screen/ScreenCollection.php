<?php

Namespace App\Warping\Screen;

class ScreenCollection {

    private $screens = [];

    protected const FIELDS = [
        "name" => "Name of the screen (can be displayed on the grid)",
        "filename" => "URL compatible name",
        "width" => "Width in whatever unit specified",
        "height" => "Height in whatever unit specified",
        "density" => "pixel/meter or pixel/foot depending on the specified unit. Doesn't apply with unit in px",
        "unit" => "Can be meter, ft or pixel (density is not applied for the latter)",
        "origin x" => "From left to right",// From left to right (like Blender top view)
        "origin y" => "From bottom to top (default 50%)", // From bottom to top (like Blender top view)
        "origin unit" => "Can be percent, pixel, meter or foot"
    ];

    public function __construct(array $post)
    {
        if (empty($post['screens'])) {
            $screens = require DOCUMENT_ROOT.'/app/defaults/screens.php';
        } else {
            // $screens = json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $post['screens']), true);
            $screens = explode(PHP_EOL, $post['screens']);
            print_r($screens);die;
        }

        if (!is_array($screens)) {
            throw new ScreenException("Screens settings is not an array", 1);
        }

        foreach ($screens as $screen) {
            $this->screens[] = new Screen($screen);
        }
    }

    public function foreach()
    {
        return $this->screens;
    }

    static public function getFields()
    {
        return self::FIELDS;
    }
}
