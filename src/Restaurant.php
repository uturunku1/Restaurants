<?php
    /**
     *
     */
    class Restaurant
    {
        private $id;
        private $name;
        private $cuisine_id;

        function __construct($id=null, $name, $cuisine_id)
        {
            $this->id= $id;
            $this->name= $name;
            $this->cuisine_id= $cuisine_id;
        }
        function setName($new_name)
        {
            $this->name= (string)$new_name;
        }
        function getId()
        {
            return $this->id;
        }
        function getName()
        {
            return $this->name;
        }
        function getCuisineId()
        {
            return $this->cuisine_id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO restaurants (name, cuisine_id) VALUES('{$this->getName()}', {$this->getCuisineId()})");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }
        static function getAll()
        {
            $returned_restaurants= $GLOBALS['DB']->query("SELECT * FROM restaurants;");
            $restaurants=array();
            foreach ($returned_restaurants as $restaurant) {
                $id = $restaurant['id'];
                $name = $restaurant['name'];
                $cuisine_id = $restaurant['cuisine_id'];
                $new_restaurant= new Restaurant($id,$name,$cuisine_id);
                array_push($restaurants, $new_restaurant);
            }
            return $restaurants;
        }
        static function findOne($search_id)
        {
            $found_restaurant = null;
            $restaurants = Restaurant::getAll();
            foreach($restaurants as $restaurant){
                $id= $restaurant->getId();
                $name= $restaurant->getName();
                $cuisine_id = $restaurant->getCuisineId();

                if($id == $search_id){
                    $found_restaurant = $restaurant;
                }
            }
            return $found_restaurant;

        }

        function deleteOne()
        {
            $GLOBALS['DB']->exec("DELETE FROM restaurants WHERE id={$this->getId()};");

            // $GLOBALS['DB']->exec("DELETE FROM restaurants WHERE cuisine_id={$this->getid()};");
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM restaurants;");
        }



    }


 ?>
