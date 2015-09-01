<?php
namespace Redmine\Model;

 use Zend\Db\TableGateway\TableGateway;

 class ProjectsTable
 {
     protected $tableGateway;

     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }

    
    public function getProjectDetail($id)
     {  
         
         $rowset = $this->tableGateway->select(array('project_id' => $id));
         
         $row = $rowset->current();
         
         
         
         return $row;
     }
     public function saveProjects(Projects $projects)
     {   

         $data = array(
        
             'project_id' => $projects->id,
             'project_identifier'  => $projects->identifier,
             'project_name' => $projects->name,
             'project_created_on'  => $projects->created_on,
             'project_updated_on' => $projects->created_on,
             'project_description'  => $projects->description,
         );
    
        
        if ($this->getProjectDetail($projects->id)) 
        {
        $this->tableGateway->update($data, array('project_id' => $projects->id));
        }
        else
        {
            $this->tableGateway->insert($data);
        }
     }
 }
