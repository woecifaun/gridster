<?php

Namespace App\Service;

class URICleaner
{
    public function clean($string)
    {
        // remove trailing white spaces
        $string = trim($string);

        // make string lowercase
        $string = strtolower($string);

        return $string;
    }
}
