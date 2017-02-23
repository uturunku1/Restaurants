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

    class CuisineTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Cuisine::deleteAll();
            Restaurant::deleteAll();
        }
        function test_getType()
        {
            $id=1;
            $type= "Japanese";
            $cuisine = new Cuisine($id, $type);

            $result= $cuisine->getType();

            $this->assertEquals($type, $result);
        }

        function test_getId()
        {
            $id=1;
            $type = "Japanese";
            $cuisine = new Cuisine($id, $type);

            $result = $cuisine->getId();

            $this->assertEquals(true, is_numeric($result));
        }

        function test_save()
        {
            $id=1;
            $type = "Japanese";
            $cuisine = new Cuisine($id, $type);
            $cuisine->save();

            $result = $cuisine::getAll();

            $this->assertEquals($cuisine, $result[0]);
        }

        function test_getAll()
        {
            $id=1;
            $type = "Japanese";
            $id2=2;
            $type2="Peruvian";
            $cuisine = new Cuisine($id, $type);
            $cuisine->save();
            $cuisine2 = new Cuisine($id2, $type2);
            $cuisine2->save();

            $result=Cuisine::getAll();


            $this->assertEquals([$cuisine, $cuisine2], $result);
        }

        function test_find()
        {
            $id = 1;
            $id2 = 2;
            $type = "Yama";
            $type2 = "Japanese";
            $cuisine = new Cuisine($id, $type);
            $cuisine->save();
            $cuisine2 = new Cuisine($id, $type2);
            $cuisine2->save();

            $result = Cuisine::find($cuisine->getId());

            $this->assertEquals($cuisine, $result);
        }

        function test_deleteAll()
        {
            $id=1;
            $type = "Japanese";
            $id2=2;
            $type2="Peruvian";
            $cuisine = new Cuisine($id, $type);
            $cuisine->save();
            $cuisine2 = new Cuisine($id2, $type2);
            $cuisine2->save();
            Cuisine::deleteAll();

            $result=Cuisine::getAll();


            $this->assertEquals([], $result);
        }
        function test_getRestaurants()
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


            $result= $cuisine->getRestaurants();

            $this->assertEquals([$restaurant, $restaurant2], $result);
        }

        function test_editCuisine()
        {
          $id=null;
          $type="Japanese";
          $cuisine= new Cuisine($id, $type);
          $cuisine->save();

          $new_type="Sushi";

          $cuisine->editCuisine($new_type);
          $result = $cuisine->getType();

          $this->assertEquals($new_type, $result);
        }


    }



 ?>
