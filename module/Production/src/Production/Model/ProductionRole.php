<?php
  namespace Production\Model;

class ProductionRole
 {
     


 public $role_name;

 

     public function exchangeArray($data)
     {    
         $this->role_name = (isset($data['user_role_name'])) ? $data['user_role_name'] : null;
        
     }


      public function getArrayCopy()
     {
         return get_object_vars($this);
     }

}