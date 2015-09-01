<?php
namespace Redmine\Model;

 use Zend\Db\TableGateway\TableGateway;

 class TrackersTable
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

     public function getTrackerDetail($id)
     {  

         
         $rowset = $this->tableGateway->select(array('tracker_id' => $id));
         
         $row = $rowset->current();
         
         
         
         return $row;

     }

     public function saveTrackers(Trackers $trackers)
     {
         $data = array(

             'tracker_id' => $trackers->trackerId,
             'tracker_name'  => $trackers->trackerName,
            

         );
        
        if ($this->getTrackerDetail($trackers->trackerId)) 
        {
        $this->tableGateway->update($data, array('tracker_id' => $trackers->trackerId));
        }
        else
        {
            $this->tableGateway->insert($data);
        }
         
     }

 }
