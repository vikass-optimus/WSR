<?php
  namespace Production\Model;

class ProductionStatus 
 {
     


    public $status_name;
 
 

     public function exchangeArray($data)
     {    
        
         $this->status_name = (isset($data['status_name'])) ? $data['status_name'] : null;
        
         
     }


      public function getArrayCopy()
     {
         return get_object_vars($this);
     }

}