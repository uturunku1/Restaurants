<?php
  class Cuisine
  {
    private $id;
    private $type;

    function __construct($id=null, $type)
    {
      $this->id = $id;
      $this->type = $type;
    }

    function setType($new_type)
    {
      $this->type = (string)$new_type;
    }

    function getType()
    {
      return $this->type;
    }

    function getId()
    {
      return $this->id;
    }

    function save()
    {
        $GLOBALS['DB']->exec("INSERT INTO cuisines (type) VALUES ('{$this->getType()}')");
        $this->id=$GLOBALS['DB']->lastInsertId();
    }

    static function getAll()
    {
        $returned_cuisines = $GLOBALS['DB']->query("SELECT * FROM cuisines");
        $cuisines = array();
        foreach($returned_cuisines as $cuisine){
            $type = $cuisine['type'];
            $id = $cuisine['id'];
            $new_cuisine = new Cuisine($id, $type);
            array_push($cuisines, $new_cuisine);
        }

        return $cuisines;
    }

    function editCuisine($new_type)
    {
      $GLOBALS['DB']->exec("UPDATE cuisines SET type = '{$new_type}' WHERE id = {$this->getId()};");
      $this->setType($new_type);
    }

    static function find($search_id)
    {
        $found_cuisine = null;
        $cuisines = Cuisine::getAll();
        foreach($cuisines as $cuisine){
            $cuisine_id = $cuisine->getId();
            if($cuisine_id == $search_id){
                $found_cuisine = $cuisine;
            }
        }
        return $found_cuisine;

    }

    function deleteCuisine()
    {
        $GLOBALS['DB']->exec("DELETE FROM cuisines WHERE id = {$this->getId()};");
        $GLOBALS['DB']->exec("DELETE FROM restaurants WHERE cuisine_id={$this->getid()};");
    }

    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM cuisines;");
    }
    function getRestaurants()
    {
        $returned_restaurants= $GLOBALS['DB']->query("SELECT * FROM restaurants WHERE cuisine_id= {$this->getId()};");
        $restaurants=  array();
        foreach ($returned_restaurants as $restaurant) {
            $id = $restaurant['id'];
            $name = $restaurant['name'];
            $cuisine_id= $restaurant['cuisine_id'];
            $new_restaurant= new Restaurant($id, $name, $cuisine_id);
            array_push($restaurants, $new_restaurant);
        }
        return $restaurants;
    }

  }

?>
