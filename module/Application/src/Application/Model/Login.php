<?php

namespace Application\Model;


class Login 
 {
     public $useremail; 
     public $password;

     public function exchangeArray()
     {
      }
      public function getArrayCopy()
     {
         return get_object_vars($this);
     }

    }