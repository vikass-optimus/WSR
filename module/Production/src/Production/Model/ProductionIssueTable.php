<?php
namespace Production\Model;

  use Zend\Db\TableGateway\TableGateway;
 use Zend\Db\Sql\Sql;
 use Zend\Db\Adapter\Adapter;
 use Zend\Db\Sql\Select;
 use Zend\Server\Method\Prototype;
 use Zend\Db\Sql\Expression;

 class ProductionIssueTable
 {   
     const TABLE_NAME = 'r_issue';
     protected $tableGateway;

     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }
     

     public function getIssueDetail($id)
     {  

         
         $rowset = $this->tableGateway->select(array('r_issue_id' => $id));
         
         $row = $rowset->current();
         
         
         
         return $row;

     }

     public function saveIssue(ProductionIssue $issue)
     {
         $data = array(

             'r_issue_id' => $issue->issue_id,
             'r_issue_estimated_hours'  => $issue->estimated_hours,
             'r_issue_subject' => $issue->subject,
             'r_issue_created_on' => $issue->created_on,
             'r_issue_start_date'  => $issue->start_date,
             'r_issue_updated_on' => $issue->updated_on,
             'r_issue_completion_ratio'  => $issue->ratio_done,
             'r_issue_due_date' => $issue->due_date,
             'r_issue_description'  => $issue->description,
             'r_issue_tracker_code' => $issue->tracker_id,
             //'r_ticket_status_code'  => $issue->status_id,
             'r_project_id' => $issue->project_id,
             //'r_assignee_id'  => $issue->user_id,
            // 'r_issue_priority_code' => $issue->priority_id,
             //'r_issue_parent_issue_id'  => $issue->parent_id,
             //'r_issue_created_by' => $issue->author_id,
             'r_author_name' => $issue->author_name,
             'r_user_name'  => $issue->user_name,
  

         );
       if ($this->getIssueDetail($issue->issue_id)) 
        {
        $this->tableGateway->update($data, array('r_issue_id' => $issue->issue_id));
        }
        else
        {
            $this->tableGateway->insert($data);
        }
     }
}


 
