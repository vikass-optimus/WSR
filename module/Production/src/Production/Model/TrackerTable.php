<?php
namespace Production\Model;

 use Zend\Db\TableGateway\TableGateway;

 class TrackerTable
 {
     protected $tableGateway;

     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }


     public function getTrackerDetail($id)
     {  

         
         $rowset = $this->tableGateway->select(array('r_issue_tracker_code' => $id));
         
         $row = $rowset->current();
         
         
         
         return $row;

     }

     public function saveTracker(Tracker $trackers)
     {

         $data = array(

             'r_issue_tracker_code' => $trackers->trackerId,
             'r_issue_tracker_name'  => $trackers->trackerName,
            

         );
        
        if ($this->getTrackerDetail($trackers->trackerId)) 
        {

        $this->tableGateway->update($data, array('r_issue_tracker_code' => $trackers->trackerId));
        
        }
        else
        {
            $this->tableGateway->insert($data);
        }
         
     }

 }
