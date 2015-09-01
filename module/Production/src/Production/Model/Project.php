<?php
  namespace Production\Model;

class Project
 {
     
      public $id;
      public $name;
      public $created_on;
      public $description;
      // public $status_code;
      // public $user_id;
      // public $quality;
      // public $schedule;
      // public $process;
      // public $effort_variance;

     public function exchangeArray($data)

     {  //echo "<pre>";print_r($data);die;
         $this->id     = (isset($data['project_id'])) ? $data['project_id'] : null ;
         $this->name  = (isset($data['project_name']))  ? $data['project_name']  : null;
         $this->created_on     = (isset($data['project_created_on']))     ? $data['project_created_on'] : null;
         $this->description  = (isset($data['project_description']))  ? $data['project_description']  : null;
         // $this->status_code     = (isset($data['status_code'])) ? $data['status_code'] : null ;
         // $this->user_id  = (isset($data['user_id']))  ? $data['user_id']  : null;
         // $this->quality     = (isset($data['quality']))     ? $data['quality'] : null;
         // $this->schedule  = (isset($data['schedule']))  ? $data['schedule']  : null;
         // $this->process     = (isset($data['process']))     ? $data['process'] : null;
         // $this->effort_variance     = (isset($data['effort_variance']))     ? $data['effort_variance'] : null;

     }


      public function getArrayCopy()
     {
         return get_object_vars($this);
     }

}