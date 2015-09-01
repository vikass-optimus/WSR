<?php
namespace Production\Model;

 use Zend\Db\TableGateway\TableGateway;


 class ProductionStatusTable
 {
     protected $tableGateway;

     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }




     public function saveStatus(ProductionStatus $status)
     {
         $code = str_replace(' ', '_',$status->status_name); 
         $status_code = strtoupper(preg_replace('/[^A-Za-z\_]/', '', $code));  
         $data = array(
             'r_ticket_status_code' => $status_code,
             'r_ticket_status_name'  => $status->status_name,
             
 

         );
        
       
            $this->tableGateway->insert($data);
        
     }

     
 }
