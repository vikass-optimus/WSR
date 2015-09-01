<?php
  namespace Production\Model;

class Tracker 
 {
     public $trackerId;
     public $trackerName;
     

     public function exchangeArray($data)
     {    
        //echo "<pre>";print_r($data);die;
         $this->trackerId     = (isset($data['tracker_id'])) ? $data['tracker_id'] : null ;
         $this->trackerName = (isset($data['tracker_name'])) ? $data['tracker_name'] : null;
         
     }


      public function getArrayCopy()
     {
         return get_object_vars($this);
     }

}