<?php

Namespace App\Warping\Screen;

class Projector {

    protected $name;
    protected $width;
    protected $height;
    protected $IP;
    protected $output;

    public function __construct(array $projector)
    {
        if (empty($projector['name'])) {
            throw new ScreenException("Projector name must be specified", 2);
        }

        if (empty($projector['width'])) {
            throw new ScreenException("Projector width must be specified", 2);
        }

        if (empty($projector['height'])) {
            throw new ScreenException("Projector height must be specified", 2);
        }

        $this->name = $projector['name'];
        $this->width = $projector['width'];
        $this->height = $projector['height'];

        if (!empty($projector['ip'])) {
            $this->IP = $projector['ip'];
        }

        if (!empty($projector['output'])) {
            $this->output = $projector['output'];
        }
    }

    public function getName()
    {
        return $this->name;
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function getHeight()
    {
        return $this->height;
    }

    public function getIP()
    {
        return $this->IP;
    }

    public function getOutput()
    {
        return $this->output;
    }
}
