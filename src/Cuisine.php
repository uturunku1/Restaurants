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

    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM cuisines;");
    }

  }

?>
