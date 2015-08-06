<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Car.php";

    $app = new Silex\Application();

    $app->get("/new_car", function() {
        return "
        <!DOCTYPE html>
        <html>
        <head>
            <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css'>
            <title>Find a Car</title>
        </head>
        <body>
            <div class='container'>
                <h1>Find a Car!</h1>
                <form action='/view_car'>
                    <div class='form-group'>
                        <label for='price'>Enter Maximum Price:</label>
                        <input id='price' name='price' class='form-control' type='number'>
                        <label for='miles'>Enter Maximum Miles:</label>
                        <input id='miles' name='miles' class='form-control' type='number'>
                    </div>
                    <button type='submit' class='btn-success'>Submit</button>
                </form>
            </div>
        </body>
        </html>
        ";
    });

    $app->get("/view_car", function() {
        $porsche = new Car("2014 Porsche 911", 114991, 7864, "images/porsche.jpg");
        $ford = new Car("2011 Ford F450", 55995, 14241, "images/ford.jpg");
        $lexus = new Car("2013 Lexus RX 350", 44700, 20000, "images/lexus.jpg");
        $mercedes = new Car("Mercedes Benz CLS550", 39900, 37979, "images/benz.jpg");

        $cars = array($porsche, $ford, $lexus, $mercedes);

        $cars_matching_search = array();
        foreach ($cars as $car) {
            if ($car->getPrice() < $_GET["price"] && $car->getMiles() < $_GET["miles"]) {
                array_push($cars_matching_search, $car);
            }
        }


        $output = "";
        $output .= "<h1>Car Dealership</h1>";
            if (empty($cars_matching_search)) {
                $output .= "<h2>No matching result!</h2>";
              } else {
                foreach ($cars_matching_search as $car) {
                    $output .= "<li>". $car->getMakeModel() . "</li>
                    <ul>
                        <li><img src=" . $car->getImage() ." width='300'></li>
                        <li> $" . $car->getPrice() . "</li>
                        <li> Miles:" . $car->getMiles() . "</li>
                    </ul>";
                }
            }

            return $output;
        });

    return $app;
?>
