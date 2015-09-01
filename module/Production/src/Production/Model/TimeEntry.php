<?php
  namespace Production\Model;

class TimeEntry 
 {
     

 public $entry_id;
 public $comments;
 public $activity_id;
public $issue_id;
public $user_id;
public $hours;
public $spent_on;
public $updated_on;
public $project_id;

     public function exchangeArray($data)
     {    
         $this->entry_id = (isset($data['time_log_id'])) ? $data['time_log_id'] : null ;
    
         $this->comments  = (isset($data['time_log_comments']))  ? $data['time_log_comments']  : null;
         //$this->activity_id     = (isset($data['activity_id']))     ? $data['activity_id']     : null;
         //$this->issue_id = (isset($data['issue_id'])) ? $data['issue_id'] : null;
        
         //$this->user_id = (isset($data['user_id'])) ? $data['user_id'] : null;
         $this->hours  = (isset($data['time_log_hours']))  ? $data['time_log_hours']  : null;
         $this->spent_on = (isset($data['time_log_spent_on'])) ? $data['time_log_spent_on'] : null;
         $this->updated_on  = (isset($data['time_log_updated_on']))  ? $data['time_log_updated_on']  : null;
        $this->project_id = (isset($data['project_id'])) ? $data['project_id'] : 0;

     }


      public function getArrayCopy()
     {
         return get_object_vars($this);
     }

}