<?php

namespace oop;

class Car{
    public $make;
    public $model;
    public $year;
    public $color;
    public $status;

    public function __construct(){
        //echo "new car created!";
        $this->park();
    }


    public function print()
    {
        echo "This car is $this->color, and is $this->status.";
    }

    public function forward()
    {
        $this->status = "moving forward";
    }

    public function park()
    {
        $this->status = "parked";
    }
}

$laurensCar = new Car();
$laurensCar ->color = "Black";
$laurensCar->forward();

$nicksCar = new Car();
$nicksCar -> color = "White";
$nicksCar->park();

$michaelsCar = new Car();
$michaelsCar -> color = "Blue";
$michaelsCar ->print();

$laurensCar->print();
$nicksCar->print();