<?php


namespace Production\Model;

 use Zend\Db\TableGateway\TableGateway;
 use Zend\Db\Sql\Sql;
 use Zend\Db\Adapter\Adapter;
 use Zend\Db\Sql\Select;
 use Zend\Server\Method\Prototype;
 use Zend\Db\Sql\Expression;

 class ProjectTable
 {
    const TABLE_NAME = 'r_project';
     protected $tableGateway;

     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }

    
    public function getProjectDetail($id)
     {  
         
         $rowset = $this->tableGateway->select(array('r_project_id' => $id));
         
         $row = $rowset->current();
         
         
         
         return $row;
     }
     public function saveProjects(Project $projects)
     {   

         $data = array(
        
             'r_project_id' => $projects->id,
             'r_project_name' => $projects->name,
             'r_project_created_on'  => $projects->created_on,
             'r_project_description'  => $projects->description,
         );
    
        
        if ($this->getProjectDetail($projects->id)) 
        {
        $this->tableGateway->update($data, array('r_project_id' => $projects->id));
        }
        else
        {
            $this->tableGateway->insert($data);
        }
     }

    public function getProjectList() {
        $select = new Select(self::TABLE_NAME);
        $columns = array(
            'projectName'     =>  'r_project_name',
             'quality'        =>  'r_project_quality',
             'schedule'       => 'r_project_schedule',
             'process'        => 'r_project_process',
             'effortVariance' => 'r_project_effort_variance',
             'comment'        =>  'r_project_description',
        );
        $select->columns($columns);
        $select->join(array(
            'issue' => ProductionIssueTable::TABLE_NAME
                ), 'issue.r_project_id=r_project.r_project_id', 
        array(
            'owner' =>'r_user_name',
         'estimatedHours' => new Expression('SUM(r_issue_estimated_hours)'),
            'percentRemain'  => 'r_issue_completion_ratio',
             'completionDate' => 'r_issue_due_date',
            ),Select::JOIN_INNER);

         // $select->join(array(
             
         //   'timeEntry' => TimeEntryTable::TABLE_NAME
         //       ), 'timeEntry.r_project_id=r_project.r_project_id', 
         //  array(
         //        'totalConsumeHrs'  => new Expression('SUM(r_issue_timelog_logged_hours)'),
         //        ),Select::JOIN_INNER);
        
          $select->where(array(
            //between('r_issue_due_date', $dateStart, $dateEnd)
            //'r_issue_due_date' => '2015-08-31',
               'r_issue_tracker_code' => 26 
        ));
          $select->group('r_project.r_project_name','issue.r_user_name');
        $sql = new Sql($this->tableGateway->getAdapter());
        $db = $this->tableGateway->getAdapter()->getDriver()->getConnection()->getResource();
        
        return $this->getSqlContent($db, $sql, $select);
    }
    


      protected function getSqlContent($db, $sql, $select) 
      {
        $stmt = $db->query($sql->getSqlStringForSqlObject($select));
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }



 }



