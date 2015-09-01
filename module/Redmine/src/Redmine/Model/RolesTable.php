<?php
namespace Redmine\Model;

 use Zend\Db\TableGateway\TableGateway;

 class RolesTable
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

     public function getRoleDetail($id)
     {
        $rowset = $this->tableGateway->select(array('user_role_id' => $id));
         $row = $rowset->current();
         return $row;
     
     }
     

     public function saveRoles(ROles $role)
     {

         $data = array(
             'user_role_id' => $role->role_id,
             'user_role_name'  => $role->role_name
 

         );
        if($this->getRoleDetail($role->role_id))
        {
            $this->tableGateway->update($data,array('user_role_id' => $role->role_id));

        }
        else
        {
         $this->tableGateway->insert($data);
        }
         
     }

 }
