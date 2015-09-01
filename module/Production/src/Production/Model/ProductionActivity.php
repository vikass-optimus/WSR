<?php
  namespace Production\Model;

class ProductionActivity 
 {
     

 public $activity_id;
 public $activity_name;
 

     public function exchangeArray($data)
     {    
          
         $this->activity_id = (isset($data['activity_id'])) ? $data['activity_id'] : null ;
         $this->activity_name = (isset($data['activity_name'])) ? $data['activity_name'] : null;
         
     }


      public function getArrayCopy()
     {
         return get_object_vars($this);
     }

}