<?php

Namespace App\Warping\Stage;

class ScreenCollection implements \Countable
{
    protected $screens = [];

    protected $name;

    // int
    protected $startX = 1000;

    // int
    protected $startY = 1000;

    // alignment is b
    protected $alignment = 'horizontal';

    // choice made below will align with either startX or startY
    // e.g: 'top' will align screens' top along $this->startY
    const ALIGN_CHOICES = [
        'horizontal' => "Align screens' center horizontally",
        'top' => "Align screen's top horizontally",
        'bottom' => "Align screen's bottom horizontally",
        'vertical' => "Align screen's center vertically",
        'left' => "Align screen's left side vertically",
        'right' => "Align screen's right side vertically",
    ];

    public function addScreen(Screen $screen)
    {
        $this->screens[] = $screen;
    }

    public function foreach()
    {
        return $this->screens;
    }

    public function count(): int
    {
        return count($this->screens);
    }

    public function getScreen($screenName)
    {
        foreach ($this->screens as $screen) {
            if ($screen->getName() == $screenName) {
                return $screen;
            }
        }
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setStartX($startX)
    {
        // TODO : add control over int value
        $this->startX = $startX;
    }

    public function getStartX()
    {
        // TODO : add control over int value
        return $this->startX;
    }

    public function setStartY($startY)
    {
        $this->startY = $startY;
    }

    public function getStartY()
    {
        return $this->startY;
    }

    public function setAlignment($alignment)
    {
        $choices = array_keys(self::ALIGN_CHOICES);

        if (!in_array($alignment, $choices)) {
            $choices = implode(',', $choices);
            throw new StageException("Invalid alignement choice ($alignment) for screen group [".$this->name."]. Valid value should be in $choices", 1);
        }

        $this->alignment = $alignment;
    }

    public function getAlignment()
    {
        return $this->alignment;
    }


}
