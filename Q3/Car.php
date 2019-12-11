<?php

class Car {
    protected $brand;
    protected $color;

    public function __construct($brand, $color) {
        $this->brand = $brand;
        $this->color = $color;
    }

    public function display() {
        return "{$this->brand} {$this->color}";
    }
}

class SpecialCar extends Car {
    protected $model;

    public function __construct($brand, $color, $model) {
        parent::__construct($brand, $color);
        $this->model = $model;
    }

    public function display() {
        return "{$this->color} {$this->brand} {$this->model}";
    }
}

$car1 = new Car('BMW', 'White');
$car2 = new Car('Proton', 'Red');
$specialCar = new SpecialCar('Proton', 'Black', 'Inspira');
