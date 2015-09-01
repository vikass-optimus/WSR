<?php

//Redmine ApiController
namespace Redmine\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Cache\Storage\Adapter;
use Redmine\Model\Helper\Client;
use Redmine\Model\Projects;
use Redmine\Model\Issue;
use Redmine\Model\TimeEntry;
use Redmine\Model\User;
use Redmine\Model\Trackers;
use Redmine\Model\Roles;
use Redmine\Model\Status;
use Redmine\Model\IssueCategory;
use Redmine\Model\BillingCategory;
use Redmine\Model\Activity;



//Redmine ApiController class 
 class ApiController extends AbstractActionController
 {  protected $projectsTable;
    protected $TrackersTable;
    protected $IssueCategoryTable;
    protected $IssueTable;
    protected $UserTable;
    protected $TimeEntryTable;
    protected $RolesTable;
    protected $StatusTable;
    protected $ActivityTable;
    protected $BillingCategoryTable;


     // Main action for view
    public function indexAction()
     {   
         
     $client = new Client("https://portal.optimusinfo.com/redmine/", 'redmine.admin', 'optimus123');
     
     // Insert Data into Transaction table
         $this->allProjects($client); 
         // $this->allUser($client);

     // Insert Data into Master Table
         // $this->billingCategory($client);
         //$this->allActivity($client);
         // $this->allIssueCategory($client); 
         // $this->allStatus($client); 
         // $this->allRoles($client); 
         // $this->allTrackers($client);  
    }



  
    //get all Projects details 
    public function allProjects($client)
    {  
    $allProject = $client->api('project')->all();
    try {
        $projects = new Projects();
        foreach ($allProject['projects'] as $key=>$project)
         {   
           // set values into class level variable to insert or update into database
           $projects->exchangeArray($project);
           $projectInfo = $this->getProjectsTable()->saveProjects($projects);

           // GET all Issue detail related to Projects
           $this->allIssue($client,$project['id']);
         }
        
        }
         catch (\Exception $ex) {
             //send mail if any error occur during CRON JOB
         }
       
    }
     
     //get all issues detail against project_id 
    public function allIssue($client,$projectId)
    { 
      $issueList= $client->api('issue')->all(array('project_id' => $projectId,'limit'=>10000));  
       try{
           $issue = new Issue();
            foreach($issueList['issues'] as $key=>$value)
             {  
              $issue->exchangeArray($value);
              $issueInfo = $this->getIssueTable()->saveIssue($issue);
              
              // GET all Time Entry detail related to Issue
              $this->timeEntry($client,$value['id']);
             }
         }
         catch (\Exception $ex) 
         {
             //send mail if any error occur during CRON JOB
         }
    }
 
//get all time logged entries against issue_id   
    public function timeEntry($client,$issueId)
    {  
        
    $timeEntries = $client->api('time_entry')->all(array('issue_id' => $issueId,'limit'=>10000));
        try{
             $timeEntry = new TimeEntry();
             foreach($timeEntries['time_entries'] as $key=>$entry)
            {
            $timeEntry->exchangeArray($entry);
            $this->getTimeEntryTable()->saveTimeEntry($timeEntry);
            }
        }
    
        catch (\Exception $ex) 
        {
           //send mail if any error occur during CRON JOB  
         }
    }
   

    //get the current user    
    public function allUser($client)
    {
        
    $userInfo = $client->api('user')->getCurrentUser();

    try{
     $user = new User();
    foreach ($userInfo as $key=>$users)
       {
        $user->exchangeArray($users);
       $this->getUserTable()->saveUser($user);
        }
      }
    catch (\Exception $ex) 
         {
           //send mail if any error occur during CRON JOB  
       
         }
    }

      
//get  all trackers details
    public function allTrackers($client)
    {
     $allTracker = $client->api('tracker')->all(array('limit'=>1000));
     try{
     $trackers = new Trackers();
     foreach ($allTracker['trackers'] as $key=>$tracker)
      {
     $trackers->exchangeArray($tracker);
       $this->getTrackersTable()->saveTrackers($trackers);
      } 
    }
  catch (\Exception $ex) 
         {
           //send mail if any error occur during CRON JOB  
         }
    }

//show all user roles detail

    public function allRoles($client)
    { 
    $allRole = $client->api('role')->all(array(
    'limit' => 1000,)); 

    try{
    $roles = new Roles();
    foreach ($allRole['roles'] as $key=>$role)
       {
        $roles->exchangeArray($role);
       $this->getRolesTable()->saveRoles($roles);
        }
        
       }
      catch (\Exception $ex) 
         {
         //send mail if any error occur during CRON JOB
       
         }
   }

//Show all issue status detail
   public function allStatus($client)
    {
       $allStatus = $client->api('issue_status')->all();
    try{
        $status = new Status();
         foreach($allStatus['issue_statuses'] as $key=>$value)
        {
        $status->exchangeArray($value);
        $this->getStatusTable()->saveStatus($status);
        }
    
    }
    catch (\Exception $ex) 
         {
        //send mail if any error occur during CRON JOB
         }
    }

//get all issues category against project_id 

    public function allIssueCategory($client)
    {
        $allProject = $client->api('project')->all();
        foreach ($allProject['projects'] as $key=>$project)
         { 
     $issueCategories = $client->api('issue_category')->all( $project['id']);
     try{
     $issueCategory = new IssueCategory();
     foreach($issueCategories['issue_categories'] as $key=>$value)
       { 
        
       $issueCategory->exchangeArray($value);
       $this->getIssueCategoryTable()->saveIssueCategory($issueCategory);
        }
       }
        catch (\Exception $ex) 
         {
           //send mail if any error occur during CRON JOB 
         }
    }
  }

//get all billing category in time logged entries against issue_id
   public function billingCategory($client)
    {  
    $allProject = $client->api('project')->all();
        foreach ($allProject['projects'] as $key=>$project)
         { 
    $issueList= $client->api('issue')->all(array('project_id' => $project['id']));
            foreach($issueList['issues'] as $key=>$value)
             {   
        
    $timeEntries = $client->api('time_entry')->all(array('issue_id' => $value['id']));
    try{
    $billingCategory = new BillingCategory();
    foreach($timeEntries['time_entries'] as $key=>$entry)
     {
        foreach ($entry['custom_fields'] as $key=>$value)
        {    
        $billingCategory->exchangeArray($value);
       $this->getBillingCategoryTable()->saveBillingCategory($billingCategory);
        }
     }
    }
    catch (\Exception $ex) 
         {
             //send mail if any error occur during CRON JOB
         }
    }}
}

//get all activity 
 public function allActivity($client)
    { 
    $allProject = $client->api('project')->all();
        foreach ($allProject['projects'] as $key=>$project)
         { 
    $issueList= $client->api('issue')->all(array('project_id' => $project['id']));
            foreach($issueList['issues'] as $key=>$value)
             {   
        
    $timeEntries = $client->api('time_entry')->all(array('issue_id' => $value['id']));
    try{
         $activity = new Activity();
        foreach($timeEntries['time_entries'] as $key=>$entry)
         { 
    
        $activity->exchangeArray($entry);
        $this->getActivityTable()->saveActivity($activity);
        }
    
    }
    catch (\Exception $ex) 
         {
             
           //send mail if any error occur during CRON JOB
         }
    }
}}
    
    
  
   //get ProjectsTable
    public function getProjectsTable()
     {
         if (!$this->projectsTable) {
             $sm = $this->getServiceLocator();
             $this->projectsTable = $sm->get('Redmine\Model\ProjectsTable');
         }
         return $this->projectsTable;
     }
    
    //get TrackersTable
    public function getTrackersTable()
     {
         if (!$this->TrackersTable) {
             $sm = $this->getServiceLocator();
             $this->trackersTable = $sm->get('Redmine\Model\TrackersTable');
         }
         return $this->trackersTable;
     }
    //get IssueCategoryTable
    public function getIssueCategoryTable()
     {
         if (!$this->IssueCategoryTable) {
             $sm = $this->getServiceLocator();
             $this->issueCategoryTable = $sm->get('Redmine\Model\IssueCategoryTable');
         }
         return $this->issueCategoryTable;
     }
     //get UserTable
    public function getUserTable()
     {
         if (!$this->UserTable) {
             $sm = $this->getServiceLocator();
             $this->userTable = $sm->get('Redmine\Model\UserTable');
         }
         return $this->userTable;
     }
     //get RolesTable
    public function getRolesTable()
     {
         if (!$this->RolesTable) {
             $sm = $this->getServiceLocator();
             $this->rolesTable = $sm->get('Redmine\Model\RolesTable');
         }
         return $this->rolesTable;
     }
     //get IssueTable
    public function getIssueTable()
     {
         if (!$this->IssueTable) {
             $sm = $this->getServiceLocator();
             $this->issueTable = $sm->get('Redmine\Model\IssueTable');
         }
         return $this->issueTable;
     }
     //get StatusTable
    public function getStatusTable()
     {
         if (!$this->StatusTable) {
             $sm = $this->getServiceLocator();
             $this->statusTable = $sm->get('Redmine\Model\StatusTable');
         }
         return $this->statusTable;
     }
     //get TimeEntryTable
    public function getTimeEntryTable()
     { 
         if (!$this->TimeEntryTable) {
             $sm = $this->getServiceLocator();
             $this->timeEntryTable = $sm->get('Redmine\Model\TimeEntryTable');
         }
         return $this->timeEntryTable;
     }
    //get ActivityTable
    public function getActivityTable()
     {
         if (!$this->ActivityTable) {
             $sm = $this->getServiceLocator();
             $this->activityTable = $sm->get('Redmine\Model\ActivityTable');
         }
         return $this->activityTable;
     }
    //get BillingCategoryTable
    public function getBillingCategoryTable()
     {
         if (!$this->BillingCategoryTable) {
             $sm = $this->getServiceLocator();
             $this->billingCategoryTable = $sm->get('Redmine\Model\BillingCategoryTable');
         }
         return $this->billingCategoryTable;
     }
 }