<?php
 return array(
     'controllers' => array(
         'invokables' => array(
             'Production\Controller\Index' => 'Production\Controller\IndexController'
         ),
     ),

     // The following section is new and should be added to your file
     'router' => array(
         'routes' => array(
             'production' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/production[/:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Production\Controller\Index',
                         'action'     => 'index',
                     ),
                 ),
             ),
             
         ),
     ),

     'view_manager' => array(
         'template_path_stack' => array(
             'production' => __DIR__ . '/../view',
         ),
     ),
//      // edit begin  
//     'template_map' => array(  
//     'layout/blank' => __DIR__ . '/../view/layout/blank.phtml',  
// ),  
// // edit end  
);


 ?>