<?php
namespace Application\Model;

 use Zend\Db\TableGateway\TableGateway;

 class LoginTable
 {
     protected $tableGateway;
       const TABLE_NAME = 'p_user_detail';

     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }

     public function fetchAll()
     {
         $resultSet = $this->tableGateway->select();
         return $resultSet;
     }

   

    public function getUser($where = array()) {
        $row = $this->tableGateway->select($where)->current();
        if (!$row) {
            return null;
        }
        return $row;
    }

 }
 ?>