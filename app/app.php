<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Car.php";

    session_start();

    if (empty($_SESSION['list_of_cars'])) {
        $_SESSION['list_of_cars'] = array();
    }

    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'
    ));

    $app->get('/', function() use ($app) {

        return $app['twig']->render('home.html.twig');
    });

    $app->get('/post', function() use ($app) {

    return $app['twig']->render('cars.html.twig', array('cars' => Car::getAll()));

    });

    $app->post("/cars", function() use ($app) {
        $car = new Car($_POST['model'], $_POST['price'], $_POST['miles'], $_POST['image_path']);

        $car->save();

        return $app['twig']->render('create_car.html.twig', array('newcar' => $car));
    });

    $app->post("/delete_car", function() use ($app) {
        Car::deleteAll();
        return $app['twig']->render('delete_cars.html.twig', array('cars' => Car::getAll()));
    });

    $app->get("/view_car", function() use ($app) {
        $cars_matching_search = array();
        $cars = Car::getAll();
        $user_price = $_GET["price"];
        $user_miles = $_GET["miles"];

        foreach ($cars as $car) {
            if ($car->getPrice() < $user_price && $car->getMiles() < $user_miles)
            {
                array_push($cars_matching_search, $car);
            }
        }
        return $app['twig']->render('car_posting.html.twig', array('cars' => $cars_matching_search));
    });

    $app->get("/search", function() use ($app) {
        return $app['twig']->render('search_cars.html.twig');
    });

    return $app;
?>
