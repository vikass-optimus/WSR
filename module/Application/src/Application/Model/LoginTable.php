<?php
namespace Application\Model;

 use Zend\Db\TableGateway\TableGateway;
 use Zend\Db\Sql\Sql;
 use Zend\Db\Adapter\Adapter;
 use Zend\Db\Sql\Select;
 use Zend\Server\Method\Prototype;
 use Zend\Db\Sql\Expression;

 class LoginTable
 {
     protected $tableGateway;
       const TABLE_NAME = 'p_user_detail';

     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }
    public function getLoginUser() {
    
        
        $select = new Select(self::TABLE_NAME);
        $columns = array(
            'emailId'     =>  'p_user_email_id',
             'password'        =>  'p_user_password',
        );
        $select->columns($columns);
      
        $sql = new Sql($this->tableGateway->getAdapter());
        $db = $this->tableGateway->getAdapter()->getDriver()->getConnection()->getResource();

        return $this->getSqlContent($db, $sql, $select);
    }
    


      protected function getSqlContent($db, $sql, $select) 
      {
        $stmt = $db->query($sql->getSqlStringForSqlObject($select));
          //echo "<pre>";print_r($stmt);die;
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

}