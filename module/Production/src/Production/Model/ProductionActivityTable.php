<?php
namespace Production\Model;

 use Zend\Db\TableGateway\TableGateway;

 class ProductionActivityTable
 {
     protected $tableGateway;

     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }


     public function getActivityDetail($id)
     {  

         
         $rowset = $this->tableGateway->select(array('r_time_log_activity_code' => $id));
         
         $row = $rowset->current();
         
         
         
         return $row;

     }



     public function saveActivity(ProductionActivity $activity)
     {

 
         $data = array(
             'r_time_log_activity_code' => $activity->activity_id,
             'r_time_log_activity_name'  => $activity->activity_name
 

         );
        
        if ($this->getActivityDetail($activity->activity_id)) 
        {
        $this->tableGateway->update($data, array('r_time_log_activity_code' => $activity->activity_id));
        }
        else
        {
            $this->tableGateway->insert($data);
        }
         
     }

 }
