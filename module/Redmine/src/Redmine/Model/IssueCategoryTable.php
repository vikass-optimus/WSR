<?php
namespace Redmine\Model;

 use Zend\Db\TableGateway\TableGateway;

 class IssueCategoryTable
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

    public function getIssueCategorytDetail($id)
     {  

         
         $rowset = $this->tableGateway->select(array('issue_category_id' => $id));
         $row = $rowset->current();
         return $row;

     }

     public function saveIssueCategory(IssueCategory $issueCategory)
     {
         $data = array(

             'issue_category_id' => $issueCategory->issueCategoryId,
             'issue_category_name'  => $issueCategory->issueCategoryName,
             'project_id'  =>  $issueCategory->projectId,
            

         );
        
        if ($this->getIssueCategorytDetail($issueCategory->issueCategoryId)) 
        {
        $this->tableGateway->update($data, array('issue_category_id' => $issueCategory->issueCategoryId));
        }
        else
        {
            $this->tableGateway->insert($data);
        }
         
     }

 }
