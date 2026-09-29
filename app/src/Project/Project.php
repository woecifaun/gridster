<?php

Namespace App\Project;


class Project
{
    // used for URL andfolder name inside project directory
    // public $id;

    public $name;

    public function __construct(public $id) {}
}
