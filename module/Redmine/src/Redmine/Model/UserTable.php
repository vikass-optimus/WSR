<?php
namespace Redmine\Model;

 use Zend\Db\TableGateway\TableGateway;

 class UserTable
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
     


     public function getUserDetail($id)
     {  

         
         $rowset = $this->tableGateway->select(array('user_id' => $id));
         
         $row = $rowset->current();
         
         
         
         return $row;

     }

     public function saveUser(User $user)
     {

         $data = array(
             'user_id' => $user->user_id,
             'user_last_name'  => $user->last_name,
             'user_last_login_on' => $user->last_login_on,
             'user_created_on'  => $user->created_on,
             'user_mail_id' => $user->mail,
             'user_first_name'  => $user->first_name,
 

         );
        
        if ($this->getUserDetail($user->user_id)) 
        {
        $this->tableGateway->update($data, array('user_id' => $user->user_id));
        }
        else
        {
            $this->tableGateway->insert($data);
        }
         
     }

 }
