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
        protected function tearDown()
        {
            Cuisine::deleteAll();
            Restaurant::deleteAll();
        }

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

        function test_getCuisineId()
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

            $result= $restaurant->getCuisineId();

            $this->assertEquals($cuisine_id, $result);
        }

        function test_save()
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

            $result = Restaurant::getAll();
            $this->assertEquals($restaurant, $result[0]);

        }
        function test_getAll()
        {
            $id=null;
            $type="Japanese";
            $cuisine= new Cuisine($id, $type);
            $cuisine->save();

            $id=1;
            $name="Yama";
            $cuisine_id=$cuisine->getId();
            $restaurant= new Restaurant($id, $name, $cuisine_id);
            $restaurant->save();
            $id2=2;
            $name2="Yuki";
            $cuisine_id=$cuisine->getId();
            $restaurant2= new Restaurant($id2, $name2, $cuisine_id);
            $restaurant2->save();

            $result= Restaurant::getAll();

            $this->assertEquals([$restaurant, $restaurant2], $result);

        }
        function test_deleteOne()
        {
            $id=null;
            $type="Japanese";
            $cuisine= new Cuisine($id, $type);
            $cuisine->save();

            $id=null;
            $name="Yama";
            $cuisine_id= $cuisine->getId();
            $restaurant = new Restaurant($id,$name,$cuisine_id);
            $restaurant->save();
            $id=null;
            $name2= "Yuki";
            $cuisine_id= $cuisine->getId();
            $restaurant2 = new Restaurant($id,$name2,$cuisine_id);
            $restaurant2->save();

            $restaurant2->deleteOne();
            $result = Restaurant::getAll();

            $this->assertEquals([$restaurant], $result);
        }


    }
 ?>
