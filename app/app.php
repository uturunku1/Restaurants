<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Restaurant.php";
    require_once __DIR__."/../src/Cuisine.php";

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $server = 'mysql:host=localhost:8889;dbname=restaurants';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app = new Silex\Application();
    $app['debug']= true;

    $app->register(
       new Silex\Provider\TwigServiceProvider(),
       array('twig.path' => __DIR__.'/../views')
    );

    $app->get('/', function() use($app) {
        return $app['twig']->render('index.html.twig', array('cuisines' => Cuisine::getAll()));
    });

    $app->post('/cuisines', function() use($app) {
        $cuisine = new Cuisine($id=null, $_POST['type']);
        $cuisine->save();
        return $app['twig']->render('index.html.twig', array('cuisines' => Cuisine::getAll()));
    });

    $app->get('/cuisines/{id}', function($id) use($app){
        $cuisine = Cuisine::find($id);
        return $app['twig']->render('cuisine.html.twig', array('cuisine'=>$cuisine, 'restaurants'=>$cuisine->getRestaurants()));
    });
    $app->get('/cuisines/{id}/edit', function($id) use($app) {
        $cuisine = Cuisine::find($id);
        return $app['twig']->render('cuisine_edit.html.twig', array('cuisine'=>$cuisine, 'restaurants'=>$cuisine->getRestaurants()));
    });
    $app->patch('/cuisines/{id}', function($id) use($app) {
        $new_type = $_POST['type'];
        $cuisine= Cuisine::find($id);
        $cuisine->editCuisine($new_type);
        return $app['twig']->render('cuisine.html.twig', array('cuisine'=>$cuisine, 'restaurants'=>$cuisine->getRestaurants()));
    });

    $app->delete('/cuisines/{id}', function($id) use($app) {
        $cuisine = Cuisine::find($id);
        $cuisine->deleteCuisine();
        return $app['twig']->render('index.html.twig', array('cuisines' => Cuisine::getAll()));
    });

    $app->post("/restaurants", function() use($app){
        $name = $_POST['name'];
        $cuisine_id = $_POST['cuisine_id'];
        $restaurant = new Restaurant($id= null, $name, $cuisine_id);
        $restaurant->save();
        $cuisine = Cuisine::find($cuisine_id);
        return $app['twig']->render('cuisine.html.twig', array('cuisine'=>$cuisine, 'restaurants'=>$cuisine->getRestaurants()));
    });

    return $app;

 ?>
