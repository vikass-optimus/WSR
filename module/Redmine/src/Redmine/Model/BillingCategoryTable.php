<?php
namespace Redmine\Model;

 use Zend\Db\TableGateway\TableGateway;

 class BillingCategoryTable
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
    
    public function getBillingCategoryDetail($id)
     {  

         
         $rowset = $this->tableGateway->select(array('billing_category_id' => $id));
         
         $row = $rowset->current();
         
         
         
         return $row;

     }


     public function saveBillingCategory(BillingCategory $billingCategory)
     {

 
         $data = array(
             'billing_category_id' => $billingCategory->billing_id,
             'billing_category_name'  => $billingCategory->billing_name,
             'billing_category_type'  => $billingCategory->billing_value
 
 

         );
        
        if ($this->getBillingCategoryDetail($billingCategory->billing_id)) 
        {
        $this->tableGateway->update($data, array('billing_category_id' => $billingCategory->billing_id));
        }
        else
        {
            $this->tableGateway->insert($data);
        }
         
     }

 }
