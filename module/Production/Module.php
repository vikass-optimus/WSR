<?php
namespace Production;
use Production\Model\Project;
use Production\Model\ProjectTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Production\Model\User;
use Production\Model\UserTable;
use Production\Model\ProductionIssue;
use Production\Model\ProductionIssueTable;
use Production\Model\TimeEntry;
use Production\Model\TimeEntryTable;
use Production\Model\Tracker;
use Production\Model\TrackerTable;
use Production\Model\ProductionStatus;
use Production\Model\ProductionStatusTable;
use Production\Model\ProductionRoleTable;
use Production\Model\ProductionRole;
use Production\Model\ProductionActivityTable;
use Production\Model\ProductionActivity;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
 use Zend\ModuleManager\Feature\ConfigProviderInterface;

 class Module implements AutoloaderProviderInterface, ConfigProviderInterface
 {

     public function getAutoloaderConfig()
     {
         return array(
             'Zend\Loader\ClassMapAutoloader' => array(
                 __DIR__ . '/autoload_classmap.php',
             ),
             'Zend\Loader\StandardAutoloader' => array(
                 'namespaces' => array(
                     __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                 ),
             ),
         );
     }

     public function getConfig()
     {
         return include __DIR__ . '/config/module.config.php';
     }


     public function getServiceConfig()
     {

         return array(
            'factories' => array(
                 'Production\Model\ProjectTable' =>  function($sm) {
                     $tableGateway = $sm->get('ProjectTableGateway');
                     $table = new ProjectTable($tableGateway);
                     return $table;
                 },
                 'ProjectTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('productionDB');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Project());
                     return new TableGateway('r_project', $dbAdapter, null, $resultSetPrototype);
                 },
                 'Production\Model\ProductionIssueTable' =>  function($sm) {
                     $tableGateway = $sm->get('ProductionIssueTableGateway');
                     $table = new ProductionIssueTable($tableGateway);
                     return $table;
                 },
                 'ProductionIssueTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('productionDB');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new ProductionIssue());
                     return new TableGateway('r_issue', $dbAdapter, null, $resultSetPrototype);
                 },
                 'Production\Model\UserTable' =>  function($sm) {
                     $tableGateway = $sm->get('UserTableGateway');
                     $table = new  UserTable($tableGateway);
                     return $table;
                 },
                 'UserTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('productionDB');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new User());
                     return new TableGateway('r_user_detail', $dbAdapter, null, $resultSetPrototype);
                 },
                  'Production\Model\TimeEntryTable' =>  function($sm) {
                     $tableGateway = $sm->get('timeEntryTableGateway');
                     $table = new  TimeEntryTable($tableGateway);
                     return $table;
                 },
                 'timeEntryTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('productionDB');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new TimeEntry());
                     return new TableGateway('r_issue_timelog', $dbAdapter, null, $resultSetPrototype);
                 },
                 'Production\Model\TrackerTable' =>  function($sm) {
                     $tableGateway = $sm->get('TrackerTableGateway');
                     $table = new TrackerTable($tableGateway);
                     return $table;
                 },
                 'TrackerTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('productionDB');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Tracker());
                     return new TableGateway('r_issue_tracker', $dbAdapter, null, $resultSetPrototype);
                 },
                 'Production\Model\ProductionStatusTable' =>  function($sm) {
                     $tableGateway = $sm->get('ProductionStatusTableGateway');
                     $table = new ProductionStatusTable($tableGateway);
                     return $table;
                 },
                 'ProductionStatusTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('productionDB');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new ProductionStatus());
                     return new TableGateway('r_ticket_status', $dbAdapter, null, $resultSetPrototype);
                 },

                 'Production\Model\ProductionRoleTable' =>  function($sm) {
                     $tableGateway = $sm->get('ProductionRoleTableGateway');
                     $table = new ProductionRoleTable($tableGateway);
                     return $table;
                 },
                 'ProductionRoleTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('productionDB');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new ProductionRole());
                     return new TableGateway('r_project_user_role', $dbAdapter, null, $resultSetPrototype);
                 },
                 'Production\Model\ProductionActivityTable' =>  function($sm) {
                     $tableGateway = $sm->get('ProductionActivityTableGateway');
                     $table = new ProductionActivityTable($tableGateway);
                     return $table;
                 },
                 'ProductionActivityTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('productionDB');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new ProductionActivity());
                     return new TableGateway('r_time_log_activity', $dbAdapter, null, $resultSetPrototype);
                 },

            ),
         );
     }

 }
