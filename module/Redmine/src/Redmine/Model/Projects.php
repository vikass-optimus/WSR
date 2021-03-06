<?php
  namespace Redmine\Model;

class Projects 
 {
     
      public $id;
      public $identifier;
      public $name;
      public $created_on;
      public $updated_on;
      public $description;

     public function exchangeArray($data)

     {   
         $this->id     = (isset($data['id'])) ? $data['id'] : null ;
         $this->identifier = (isset($data['identifier'])) ? $data['identifier'] : null;
         $this->name  = (isset($data['name']))  ? $data['name']  : null;
         $this->created_on     = (isset($data['created_on']))     ? $data['created_on']     : null;
         $this->updated_on = (isset($data['updated_on'])) ? $data['updated_on'] : null;
         $this->description  = (isset($data['description']))  ? $data['description']  : null;
     }


      public function getArrayCopy()
     {
         return get_object_vars($this);
     }

}