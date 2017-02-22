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
    }


 ?>
