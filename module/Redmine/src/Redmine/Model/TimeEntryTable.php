<?php
namespace Redmine\Model;

 use Zend\Db\TableGateway\TableGateway;

 class TimeEntryTable
 {   
      protected $tableGateway;

     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }

     public function fetchAll()
     {
         $resultSet = $this->tableGateway->select();
         return $resultSet;
     }

     public function getTimeLoggedDetail($id)
     {  

         
         $rowset = $this->tableGateway->select(array('time_log_id' => $id));
         $row = $rowset->current();
         return $row;

     }

     public function saveTimeEntry(TimeEntry $timeEntry)
     {

         $data = array(
             'time_log_id' => $timeEntry->entry_id,
             'project_id'  => $timeEntry->project_id,
             'time_log_comments' => $timeEntry->comments,
             'activity_id'  => $timeEntry->activity_id,
             'issue_id' => $timeEntry->issue_id,
             'time_log_created_on'  => $timeEntry->created_on,
             'user_id' => $timeEntry->user_id,
             'time_log_hours'  => $timeEntry->hours,
             'time_log_spent_on' => $timeEntry->spent_on,
             'time_log_updated_on'  => $timeEntry->updated_on,
 

         );
        
        if ($this->getTimeLoggedDetail($timeEntry->entry_id)) 
        {
        $this->tableGateway->update($data, array('time_log_id' => $timeEntry->entry_id));
        }
        else
        {
            $this->tableGateway->insert($data);
        }
         
     }

 }
