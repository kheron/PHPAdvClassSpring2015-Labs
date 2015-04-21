<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EmailTypeService
 *
 * @author User
 */
class EmailTypeService {
   
    private $_errors = array();
    private $_Util;
    private $_DB;
    private $_Validator;
    private $_EmailTypeDAO;
    private $_EmailTypeModel;


    public function __construct($db, $util, $validator, $emailTypeDAO, $emailtypeModel) {
        $this->_DB = $db;    
        $this->_Util = $util;
        $this->_Validator = $validator;
        $this->_EmailTypeDAO = $emailTypeDAO;
        $this->_EmailTypeModel = $emailtypeModel;
    }


    public function saveForm() {        
        if ( !$this->_Util->isPostRequest() ) {
            return false;
        }
        
        $this->validateForm();
        
        if ( $this->hasErrors() ) {
            $this->displayErrors();
        } else {
            
            if (  $this->_EmailTypeDAO->save($this->_EmailTypeModel) ) {
                echo 'Email Added/Updated';
            } else {
                echo 'Email could not be added Added';
            }
           
        }
        
    }
    public function validateForm() {
       
        if ( $this->_Util->isPostRequest() ) {                
            $this->_errors = array();
            if( !$this->_Validator->emailTypeIsValid($this->_EmailTypeModel->getEmailtype()) ) {
                 $this->_errors[] = 'Email Type is invalid';
            } 
            if( !$this->_Validator->activeIsValid($this->_EmailTypeModel->getActive()) ) {
                 $this->_errors[] = 'Active is invalid';
            } 
        }
         
    }
    
    
    public function displayErrors() {
       
        foreach ($this->_errors as $value) {
            echo '<p>',$value,'</p>';
            
        }
         
    }
    
    public function hasErrors() {        
        return ( count($this->_errors) > 0 );        
    }


    public function displayEmails() {        
       
        $emailTypes = $this->_EmailTypeDAO->getAllRows();
        
           if ( count($emailTypes) < 0 ) {
            echo '<p>No Data</p>';
        } else {
           
           echo "<table border='1'>";
           echo "<tr><th>Email ID</th><th>Email Type</th><th>IsActive</th><th>Update Entry</th><th>Delete Entry</th></tr>";
           
            foreach ($emailTypes as $value) {
                 
                echo "<tr><td>", $value->getEmailtypeid(), "</td>", 
                     "<td>", $value->getEmailtype(), "</td>",
                     "<td>", ( $value->getActive() == 1 ? 'Yes' : 'No'), "</td>",
                     "<td> <a href=EmailTypeUpdate.php?emailtypeid=",$value->getEmailtypeid(),"'>Update</a></td>",
                     "<td> <a href=EmailTypeDelete.php?emailtypeid=",$value->getEmailtypeid(),"'>Delete</a></td>, ",
                     "</tr>";
            }
            echo "</table>";    
        } 
        
    }
    
    
}
