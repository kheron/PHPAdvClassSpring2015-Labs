<?php namespace week2\kheron;

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


class EmailService {
   
    private $_errors = array();
    private $_Util;
    private $_DB;
    private $_Validator;
    private $_EmailDAO;
    private $_EmailModel;


    public function __construct($db, $util, $validator, $emailDAO, $emailModel) {
        $this->_DB = $db;    
        $this->_Util = $util;
        $this->_Validator = $validator;
        $this->_EmailDAO = $emailDAO;
        $this->_EmailModel = $emailModel;
    }


    public function saveForm() {        
        if ( !$this->_Util->isPostRequest() ) {
            return false;
        }
        
        $this->validateForm();
        
        if ( $this->hasErrors() ) {
            $this->displayErrors();
        } else {
            
            if (  $this->_EmailDAO->save($this->_EmailModel) ) {
                echo 'Email Added/Updated';
            } else {
                echo 'Email could not be added Added';
            }
           
        }
        
    }
    public function validateForm() {
       
        if ( $this->_Util->isPostRequest() ) {                
            $this->_errors = array();
            if( !$this->_Validator->emailIsValid($this->_EmailModel->getEmail()) ) {
                 $this->_errors[] = 'Email is invalid';
            } 
            if( !$this->_Validator->activeIsValid($this->_EmailModel->getActive()) ) {
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
       
        $emails = $this->_EmailDAO->getAllRows();
        
           if ( count($emails) < 0 ) {
            echo '<p>No Data</p>';
        } else {
           
           echo "<table border='1'>";
           echo "<tr><th>Email</th><th>Email Type</th><th>Last updated</th>"
           . "<th>Logged</th><th>Active</th><th>Update Entry</th><th>Delete Entry</th></tr>";
           
           
           
            foreach ($emails as $value) {
                echo '<tr><td>',$value->getEmail(),'</td><td>',$value->getEmailtype(),'</td><td>',date("F j, Y g:i(s) a", strtotime($value->getLastupdated())),'</td><td>',date("F j, Y g:i(s) a", strtotime($value->getLogged())),'</td>';
                echo  '<td>', ( $value->getActive() == 1 ? 'Yes' : 'No') ,'</td>';
                echo  '<td><a href=EmailUpdate.php?emailid=', $value->getEmailid() , '>Update</a></td>';
                echo  '<td><a href=Delete.php?emailid=', $value->getEmailid() , '>Delete</a></td></tr>';
            }
            }
            echo "</table>";
               
    }
 
}
