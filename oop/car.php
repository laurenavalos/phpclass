<?php

namespace oop;

class Car{
    public $make;
    public $model;
    public $year;
    public $color;

    public function print()
    {
        echo "This car is $this->color.";
    }
}

$laurensCar = new Car();
$laurensCar ->color = 'Black';

$nicksCar = new Car();
$nicksCar -> color = 'White';

$laurensCar->print();
$nicksCar->print();