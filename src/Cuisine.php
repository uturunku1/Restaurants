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

  }

?>
