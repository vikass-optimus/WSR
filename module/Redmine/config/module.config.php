<?php
 return array(
     'controllers' => array(
         'invokables' => array(
             'Redmine\Controller\Api' => 'Redmine\Controller\ApiController',
         ),
     ),

    
     'router' => array(
         'routes' => array(
             'api' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/api[/:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Redmine\Controller\Api',
                         'action'     => 'index',
                     ),
                 ),
             ),
             
         ),
     ),

      'view_manager' => array(
         'template_path_stack' => array(
             'redmine' => __DIR__ . '/../view',
         ),
     ),
     // edit begin  
    'template_map' => array(  
    'layout/blank' => __DIR__ . '/../view/layout/blank.phtml',  
),  
// edit end  
    'service_manager' => array(
   'factories' => array(
      'MyAdapterFactory' => 'Redmine\Factory\MyAdapterFactory',
   ),
   ),
 

);


 ?>