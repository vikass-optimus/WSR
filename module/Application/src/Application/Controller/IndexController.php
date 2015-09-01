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
    public function indexAction()
    { 
          $form = new LoginForm();
        
           $request = $this->getServiceLocator()->get('request');
           if ($request->isPost()) 
           {
            $login = new Login();
            $inputfilter = $login->getInputFilter();
            $form->setInputFilter($inputfilter);
            $data = $request->getPost()->toArray();
            echo "<pre>";print_r($data);die;
            $a = $form->setData($data);
          }
            //echo "<pre>";print_r($a);die;
         //if ($form->isValid()) {
          //echo "vikas";die;
          // $loginTable = new LoginTable();
          // $data=$login->exchangeArray($form->getData());
          // echo "<pre>";print_r($data);die;
          // $loginTable->getUser(array('p_user_email_id' => $data['useremail']));
       // }
        //return $this->renderView(array('form' => $form));
     
          return array('form' => $form);

    }

}