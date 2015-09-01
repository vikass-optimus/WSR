<?php
namespace Redmine\Model;

 use Zend\Db\TableGateway\TableGateway;


 class StatusTable
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

     public function getStatusDetail($id)
     {  

         
         $rowset = $this->tableGateway->select(array('status_id' => $id));
         
         $row = $rowset->current();
         
         
         
         return $row;

     }

     public function saveStatus(Status $status)
     {

         $data = array(
             'status_id' => $status->status_id,
             'status_name'  => $status->status_name,
             
 

         );
        
        if ($this->getStatusDetail($status->status_id)) 
        {
        $this->tableGateway->update($data, array('status_id' => $status->status_id));
        }
        else
        {
            $this->tableGateway->insert($data);
        }
     }

     
 }
