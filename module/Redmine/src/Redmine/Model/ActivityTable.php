<?php
namespace Redmine\Model;

 use Zend\Db\TableGateway\TableGateway;

 class ActivityTable
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


     public function getActivityDetail($id)
     {  

         
         $rowset = $this->tableGateway->select(array('activity_id' => $id));
         
         $row = $rowset->current();
         
         
         
         return $row;

     }



     public function saveActivity(Activity $activity)
     {

 
         $data = array(
             'activity_id' => $activity->activity_id,
             'activity_name'  => $activity->activity_name
 

         );
        
        if ($this->getActivityDetail($activity->activity_id)) 
        {
        $this->tableGateway->update($data, array('activity_id' => $activity->activity_id));
        }
        else
        {
            $this->tableGateway->insert($data);
        }
         
     }

 }
