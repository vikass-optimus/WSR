<?php

return array(
  
    'db' => array(
        'adapters'=>array(
            'productionDB' => array(
                    'driver'  => 'pdo',
                    'dsn'     => 'mysql:dbname=Redmine_Production_DB;host=localhost',        
                    'driver_options' => array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"),
                    'username' => 'root',
                    'password' => 'optimus@123'
                ),
            'stagingDB' => array(
                    'driver'  => 'pdo',
                    'dsn'     => 'mysql:dbname=php;host=localhost',        
                    'driver_options' => array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"),
                    'username' => 'root',
                    'password' => 'optimus@123'
                ),
             )  
    ),
    'service_manager' => array(
   'abstract_factories' => array(
            'Zend\Db\Adapter\AdapterAbstractServiceFactory',
        ),
 
        'factories' => array(
            'Zend\Db\Adapter\Adapter'
                    => 'Zend\Db\Adapter\AdapterServiceFactory',
        ),
    ),
);