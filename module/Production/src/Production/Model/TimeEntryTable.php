<?php
namespace Production\Model;

 use Zend\Db\TableGateway\TableGateway;

 class TimeEntryTable
 {   
    const TABLE_NAME = 'r_issue_timelog';
      protected $tableGateway;

     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }


     public function getTimeLoggedDetail($id)
     {  

         
         $rowset = $this->tableGateway->select(array('r_issue_timelog_id' => $id));
         $row = $rowset->current();
         return $row;

     }

     public function saveTimeEntry(TimeEntry $timeEntry)
     {

         $data = array(
             'r_issue_timelog_id' => $timeEntry->entry_id,
             'r_issue_timelog_comments' => $timeEntry->comments,
            // 'r_time_log_activity_code'  => $timeEntry->activity_id,
            //'r_issue_id' => $timeEntry->issue_id,
             //'r_user_id' => $timeEntry->user_id,
             'r_issue_timelog_logged_hours'  => $timeEntry->hours,
             'r_issue_timelog_date' => $timeEntry->spent_on,
             'r_issue_timelog_updated_on'  => $timeEntry->updated_on,
             'r_project_id' => $timeEntry->project_id,
 

         );
        
        if ($this->getTimeLoggedDetail($timeEntry->entry_id)) 
        {
        $this->tableGateway->update($data, array('r_issue_timelog_id' => $timeEntry->entry_id));
        }
        else
        {
            $this->tableGateway->insert($data);
        }
         
     }

 }
