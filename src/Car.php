<?php
class Car
{
    private $make_model;
    private $price;
    private $miles;
    private $image_path;

    function __construct($car_model, $car_price, $car_miles, $car_pic)
    {
      $this->make_model = $car_model;
      $this->price = $car_price;
      $this->miles = $car_miles;
      $this->image_path = $car_pic;
    }

    function getMakeModel()
    {
      return $this->make_model;
    }

    function setMakeModel($new_model)
    {
      $this->make_model = (string) $new_model;
    }

    function getPrice()
    {
      return $this->price;
    }

    function setPrice($new_price)
    {
      $this->price = (integer) $new_price;
    }

    function getMiles()
    {
      return $this->miles;
    }

    function setMiles()
    {
      $this->miles = (integer) $new_miles;
    }

    function getImage()
    {
      return $this->image_path;
    }
}

?>
