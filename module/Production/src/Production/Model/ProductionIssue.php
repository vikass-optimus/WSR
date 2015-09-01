<?php
  namespace Production\Model;

class ProductionIssue 
 {
     public $issue_id;
     public $estimated_hours;
    public $subject;
public $created_on;
public $start_date;
public $updated_on;
public $ratio_done;
public $due_date;
public $description;
public $tracker_id;
public $status_id;
public $project_id;
public $user_id;
public $priority_id;
public $parent_id;
public $author_id;
public $author_name;
public $user_name;



     public function exchangeArray($data)
     {    
        //echo "<pre>";print_r($data);die;
         $this->issue_id     = (isset($data['issue_id'])) ? $data['issue_id'] : 0 ;
        $this->estimated_hours  = (isset($data['issue_estimated_hours']))  ? $data['issue_estimated_hours']  : 0;
         $this->subject     = (isset($data['issue_subject']))     ? $data['issue_subject']     : null;
         $this->created_on  = (isset($data['issue_created_on']))  ? $data['issue_created_on']  : null;
         $this->start_date     = (isset($data['issue_start_date'])) ? $data['issue_start_date'] : null ;
         $this->updated_on = (isset($data['issue_updated_on'])) ? $data['issue_updated_on'] : null;
         $this->ratio_done  = (isset($data['issue_ratio_done']))  ? $data['issue_ratio_done']  : null;
         $this->due_date     = (isset($data['issue_due_date']))     ? $data['issue_due_date']     : null;
         $this->description = (isset($data['issue_description'])) ? $data['issue_description'] : null;
         $this->tracker_id  = (isset($data['tracker_id']))  ? $data['tracker_id']  : 1;
         // $this->status_id     = (isset($data['status_id'])) ? $data['status_id'] : 1 ;
         $this->project_id = (isset($data['project_id'])) ? $data['project_id'] : 0;
         //$this->user_id  = (isset($data['user_id']))  ? $data['user_id']  : 0;
         //$this->priority_id     = (isset($data['priority_id']))     ? $data['priority_id']     : 0;
         //$this->parent_id = (isset($data['parent_id'])) ? $data['parent_id'] : 1;
         //$this->author_id  = (isset($data['author_id']))  ? $data['author_id']  : 0;
        $this->author_name  = (isset($data['author_name']))  ? $data['author_name']  : null;
       $this->user_name  = (isset($data['user_name']))  ? $data['user_name']  : null;

     }


      public function getArrayCopy()
     {
         return get_object_vars($this);
     }

}