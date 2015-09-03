<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use Application\Form\LoginForm;
use Application\Model\Login;
use Application\Model\LoginTable;

class IndexController extends AbstractActionController
{    
     protected $LoginTable;
    public function indexAction()
    { 
          $form = new LoginForm();
        
           $request = $this->getServiceLocator()->get('request');
           if ($request->isPost()) 
           {
             $data = $request->getPost()->toArray();
            $form->setData($data);
          if ($form->isValid()) 
          {
            $userTable = $this->getLoginTable()->getLoginUser();
                   

       }
        
      }
          return array('form' => $form);

    }

    public function getLoginTable()
     { 
        if (!$this->LoginTable) {
             $sm = $this->getServiceLocator();
             $this->loginTable = $sm->get('Application\Model\LoginTable');
         }
        
        
         return $this->loginTable;
     }

}