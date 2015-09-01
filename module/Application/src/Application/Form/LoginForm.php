<?php
namespace Application\Form;
use Zend\Form\Form;

class LoginForm extends Form
{
    public function __construct($name = null)
    {

        parent::__construct('login');
        $this->setAttribute('method', 'POST');
        $this->add(array(
            'name' => 'usr_email_id',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control',
                'Placeholder' => 'Enter Email'
            ),
            'options' => array(
                'label' => 'Email Address',
            ),
        ));

        $this->add(array(
            'name' => 'usr_password',
            'attributes' => array(
                'type'  => 'password',
                'class' => 'form-control',
                'Placeholder' => 'Enter Password'
            ),
            'options' => array(
                'label' => 'Password',
            ),
        ));
        $this->add(array(
            'name' => 'rememberme',
			'type' => 'checkbox', 
            'attributes' => array(
                'class' => 'checkbox',
            ),
            'options' => array(
                'label' => 'Remember Me?',

            ),
        ));			
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Sumbit',
                'id' => 'submitbutton',
                'class' => 'btn btn-success pull-right'
            ),
        )); 
    }
}