<?php
namespace Redmine\Model;

 use Zend\Db\TableGateway\TableGateway;

 class IssueTable
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
     

     public function getIssueDetail($id)
     {  

         
         $rowset = $this->tableGateway->select(array('issue_id' => $id));
         
         $row = $rowset->current();
         
         
         
         return $row;

     }


     public function saveIssue(Issue $issue)
     {
         $data = array(

             'issue_id' => $issue->issue_id,
             'issue_estimated_hours'  => $issue->estimated_hours,
             'issue_subject' => $issue->subject,
             'issue_created_on' => $issue->created_on,
             'issue_start_date'  => $issue->start_date,
             'issue_updated_on' => $issue->updated_on,
             'issue_ratio_done'  => $issue->ratio_done,
             'issue_due_date' => $issue->due_date,
             'issue_description'  => $issue->description,
             'tracker_id' => $issue->tracker_id,
             'status_id'  => $issue->status_id,
             'project_id' => $issue->project_id,
             'user_id'  => $issue->assigneeId,
             'user_name' => $issue->assigneeName,
             'priority_id' => $issue->priority_id,
             'parent_id'  => $issue->parent_id,
             'author_id' => $issue->author_id,
             'author_name' => $issue->author_name,
             'remain_effort_to_completion' => $issue->hoursNeed_toFinish,


         );
       if ($this->getIssueDetail($issue->issue_id)) 
        {
        $this->tableGateway->update($data, array('issue_id' => $issue->issue_id));
        }
        else
        {
            $this->tableGateway->insert($data);
        }
     }
}


 
