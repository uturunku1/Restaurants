<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once "src/Cuisine.php";
    require_once "src/Restaurant.php";

    $server = 'mysql:host=localhost:8889;dbname=test_restaurants';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class RestaurantTest extends PHPUnit_Framework_TestCase
    {
        // protected function tearDown()
        // {
        //     Cuisine::deleteAll();
        //     // Restaurant::deleteAll();
        // }

        function test_getId()
        {

            $id=null;
            $type="Japanese";
            $cuisine= new Cuisine($id, $type);
            $cuisine->save();

            $id=1;
            $name="Yama";
            $cuisine_id= $cuisine->getId();
            $restaurant = new Restaurant($id,$name,$cuisine_id);
            $restaurant->save();

            $result= $restaurant->getId();

            $this->assertEquals(true, is_numeric($result));
        }
        function test_getName()
        {
            $id=null;
            $type="Japanese";
            $cuisine= new Cuisine($id, $type);
            $cuisine->save();

            $id=1;
            $name="Yama";
            $cuisine_id= $cuisine->getId();
            $restaurant = new Restaurant($id,$name,$cuisine_id);
            $restaurant->save();

            $result= $restaurant->getName();

            $this->assertEquals($name, $result);

        }
    }
 ?>
