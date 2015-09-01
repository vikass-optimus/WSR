<?php
  namespace Redmine\Model;

class Status 
 {
     

 public $status_id;
 public $status_name;
 
 

     public function exchangeArray($data)
     {    
         $this->status_id = (isset($data['id'])) ? $data['id'] : null ;
         $this->status_name = (isset($data['name'])) ? $data['name'] : null;
        
         
     }


      public function getArrayCopy()
     {
         return get_object_vars($this);
     }

}