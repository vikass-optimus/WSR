<?php
namespace Production\Model;

 use Zend\Db\TableGateway\TableGateway;

 class ProductionRoleTable
 {
     protected $tableGateway;

     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }

     

     public function saveRoles(ProductionRole $role)
     {
         $code = str_replace(' ', '_',$role->role_name); 
         $role_code = strtoupper(preg_replace('/[^A-Za-z\_]/', '', $code));  
         $data = array(
            
             'r_project_user_role_code' => $role_code,
             'r_project_user_role_name'  => $role->role_name, 

         );
       
         $this->tableGateway->insert($data);
      }

 }
