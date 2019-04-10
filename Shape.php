<?php

class Shape
{
}

class Square extends Shape
{
    protected $length = 4;

    public function getArea()
    {
        return pow($this->length, 2);
    }
}

echo (new Square)->getArea();
