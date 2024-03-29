<?php

Namespace App\FileSystem;

/**
 * consistency to improve:
 * some methods don't need extension other do
 */

class Filesystem
{
    private $svgFolder;

    public function __construct($directory_path)
    {
        $this->svgFolder = $directory_path;
    }

    public function persistSVG($filename, $svg)
    {
        $fullPath = $this->svgFolder.$filename.".svg";

        $svgFile = fopen($fullPath, "w") or die(__FILE__."::".__METHOD__." :Unable to open file!");
        fwrite($svgFile, $svg);
        fclose($svgFile);
    }

    public function persistTxt($filename, $txt)
    {
        $fullPath = $this->svgFolder."/".$filename.".txt";

        $txtFile = fopen($fullPath, "w") or die(__FILE__."::".__METHOD__." :Unable to open file!");
        fwrite($txtFile, $txt);
        fclose($txtFile);
    }

    public function getFullPath($filename)
    {
        return $this->svgFolder.$filename;
    }
}
