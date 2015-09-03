<?php
 namespace Production\Controller;
 
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSet;
use Production\Model\Project;
use Production\Model\ProductionIssue;
use Production\Model\TimeEntry;
use Production\Model\Tracker;
use Production\Model\ProductionStatus;
use Production\Model\ProductionRole;
use Production\Model\ProductionActivity;

 
class IndexController extends AbstractActionController
{

     protected $ProjectTable;
     protected $IssueTable;
     protected $TimeEntryTable;
     protected $TrackersTable;
     protected $StatusTable;
     protected $RolesTable;
     protected $ActivityTable;

    public function indexAction()
    { //$this->getStagingProject();
        //$this->getStagingIssue();
        //$this->getStagingTimeEntry();
        //$this->getStagingTracker();
        //$this->getStagingActivity();
        //$this->getStagingStatus();
        //$this->getStagingRole();
        
         $data = $this->getProjectTable()->getProjectList();

            return new ViewModel(array(
             'projects' =>$data
         ));
    }

    public function getStagingProject()
    {
    $projects = new Project();
$adapter = $this->getServiceLocator()->get('stagingDB');
$query = "SELECT * FROM projects";
 $statement = $adapter->createStatement($query);
 
$result = $statement->execute();

if ($result instanceof ResultInterface && $result->isQueryResult()) 
{
 $resultSet = new ResultSet;
 $resultSet->initialize($result);
 $projectList = $resultSet->toArray();
 foreach ($projectList as $key=>$project){
$projects->exchangeArray($project);
$projectInfo = $this->getProjectTable()->saveProjects($projects);
             }
         }
     }


      public function getStagingIssue()
    {
    $proIssues = new ProductionIssue();
$adapter = $this->getServiceLocator()->get('stagingDB');
$query = "SELECT * FROM issue";

 $statement = $adapter->createStatement($query);
$result = $statement->execute();

if ($result instanceof ResultInterface && $result->isQueryResult()) 
{
 $resultSet = new ResultSet;
 $resultSet->initialize($result);
 $issueList = $resultSet->toArray();
 foreach ($issueList as $key=>$issue){
$proIssues->exchangeArray($issue);
$issueInfo = $this->getIssueTable()->saveIssue($proIssues);
             }
         }
     }


      public function getStagingTimeEntry()
    {
    $proTimeEntry = new TimeEntry();
$adapter = $this->getServiceLocator()->get('stagingDB');
$query = "SELECT * FROM timeLogged";
 $statement = $adapter->createStatement($query);
 
$result = $statement->execute();

if ($result instanceof ResultInterface && $result->isQueryResult()) 
{
 $resultSet = new ResultSet;
 $resultSet->initialize($result);
 $timeEntryList = $resultSet->toArray();
 foreach ($timeEntryList as $key=>$timeEntry){
$proTimeEntry->exchangeArray($timeEntry);
$timeEntryInfo = $this->getTimeEntryTable()->saveTimeEntry($proTimeEntry);
             }
         }
     }
      

    public function getStagingTracker()
    {
    $proTracker = new Tracker();
$adapter = $this->getServiceLocator()->get('stagingDB');
$query = "SELECT * FROM trackersTable";
 $statement = $adapter->createStatement($query);
 
$result = $statement->execute();

if ($result instanceof ResultInterface && $result->isQueryResult()) 
{
 $resultSet = new ResultSet;
 $resultSet->initialize($result);
 $trackersList = $resultSet->toArray();
 foreach ($trackersList as $key=>$tracker){
$proTracker->exchangeArray($tracker);
$trackerInfo = $this->getTrackerTable()->saveTracker($proTracker);
             }
         }
     }

     public function getStagingStatus()
    {
    $proStatus = new ProductionStatus();
$adapter = $this->getServiceLocator()->get('stagingDB');
$query = "SELECT * FROM status";
 $statement = $adapter->createStatement($query);
 
$result = $statement->execute();

if ($result instanceof ResultInterface && $result->isQueryResult()) 
{
 $resultSet = new ResultSet;
 $resultSet->initialize($result);
 $statusList = $resultSet->toArray();
 foreach ($statusList as $key=>$status){
$proStatus->exchangeArray($status);
$trackerInfo = $this->getStatusTable()->saveStatus($proStatus);
             }
         }
     }

      public function getStagingRole()
    {
    $proRole = new ProductionRole();
$adapter = $this->getServiceLocator()->get('stagingDB');
$query = "SELECT * FROM roles";
 $statement = $adapter->createStatement($query);
 
$result = $statement->execute();

if ($result instanceof ResultInterface && $result->isQueryResult()) 
{
 $resultSet = new ResultSet;
 $resultSet->initialize($result);
 $roleList = $resultSet->toArray();
 foreach ($roleList as $key=>$roles){
$proRole->exchangeArray($roles);
$trackerInfo = $this->getRolesTable()->saveRoles($proRole);
             }
         }
     }


 public function getStagingActivity()
    {
    $proActivity = new ProductionActivity();
$adapter = $this->getServiceLocator()->get('stagingDB');
$query = "SELECT * FROM activities";
 $statement = $adapter->createStatement($query);
 
$result = $statement->execute();

if ($result instanceof ResultInterface && $result->isQueryResult()) 
{
 $resultSet = new ResultSet;
 $resultSet->initialize($result);
 $activityList = $resultSet->toArray();
 foreach ($activityList as $key=>$activity){
$proActivity->exchangeArray($activity);
$trackerInfo = $this->getActivityTable()->saveActivity($proActivity);
             }
         }
     }
     public function getProjectTable()
     { 
        if (!$this->ProjectTable) {
             $sm = $this->getServiceLocator();
             $this->projectTable = $sm->get('Production\Model\ProjectTable');
         }
        
        
         return $this->projectTable;
     }

     //get IssueTable
    public function getIssueTable()
     {
         if (!$this->IssueTable) {
             $sm = $this->getServiceLocator();
             $this->issueTable = $sm->get('Production\Model\ProductionIssueTable');
         }
         return $this->issueTable;
     }
    //get TimeEntryTable
    public function getTimeEntryTable()
     { 
         if (!$this->TimeEntryTable) {
             $sm = $this->getServiceLocator();
             $this->timeEntryTable = $sm->get('Production\Model\TimeEntryTable');
         }
         return $this->timeEntryTable;
     }

     //get TrackersTable
    public function getTrackerTable()
     {
         if (!$this->TrackersTable) {
             $sm = $this->getServiceLocator();
             $this->trackersTable = $sm->get('Production\Model\TrackerTable');
         }
         return $this->trackersTable;
     }

     //get StatusTable
    public function getStatusTable()
     {
         if (!$this->StatusTable) {
             $sm = $this->getServiceLocator();
             $this->statusTable = $sm->get('Production\Model\ProductionStatusTable');
         }
         return $this->statusTable;
     }

       //get RolesTable
    public function getRolesTable()
     {
         if (!$this->RolesTable) {
             $sm = $this->getServiceLocator();
             $this->rolesTable = $sm->get('Production\Model\ProductionRoleTable');
         }
         return $this->rolesTable;
     }

       //get ActivityTable
    public function getActivityTable()
     {
         if (!$this->ActivityTable) {
             $sm = $this->getServiceLocator();
             $this->activityTable = $sm->get('Production\Model\ProductionActivityTable');
         }
         return $this->activityTable;
     }
    
 }