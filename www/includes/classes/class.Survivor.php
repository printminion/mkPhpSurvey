<?php
//error_reporting(E_ALL);
/**
 * de.mksurvey - classes\class.Survivor.php
 *
 * @version $Id: class.Survivor.php 143 2007-12-07 09:39:45Z mimait04 $
 *
 *
 * Copyright (c) 2007 M.Kupriyanov
 * @author M.M-Kupriyanov, <m@kupriyanov.com>
 * @date 26.06.2007 02:56:38
 * @package mkSurvey
 *
 */

define('TABLE_SURVEY_SURVIVORS',DB_PREFIX.'survey_survivors');

class Survivor{

   var $survivorId;        // KEY ATTR. WITH AUTOINCREMENT
   var $_lastError;   // Last Error in the Class

   var $surveyId;                 //int(10)
   var $survivorEmail;                 //char(50)
   var $emailSent;                 //varchar(1)
   var $tid;                 //char(50)



   function Survivor($survivorId = null){

      if ($survivorId==null){

      }else{
         $this->_loadDataById($survivorId);
      }

   }

   /**
    * check if Survivor already in database
    *
    * @param long $surveyId
    * @param string $survivorEmail
    * @return boolean
    */
   function ifSurvivorExist($surveyId,$survivorEmail){
      global $database;
      $this->_lastError = null;

      if($surveyId == '') {
         $this->_lastError = ERROR_REQUIRED_PARAMETER_SURVEYID_IS_NULL;
         return false;
      }
      
      if($survivorEmail == '') {
         $this->_lastError = ERROR_REQUIRED_PARAMETER_SURVIVOREMAIL_IS_NULL;
         return false;
      }
      
      
      $sqlQuery = "SELECT *
      				 FROM ".TABLE_SURVEY_SURVIVORS."
                    WHERE survey_id = '$surveyId' 
                      AND survivor_email LIKE '$survivorEmail';";
      
      //debug_sql($sqlQuery);
      
      #$sqlQueryResult = tep_db_reader_query($sqlQuery);
      $sqlQueryResult = $database->openConnectionWithReturn($sqlQuery);
       
      #if($result = tep_db_fetch_array($sqlQueryResult)){
      if($result = mysql_fetch_array($sqlQueryResult)){
         return true;
      }

      return false;
   }

   #######################################################################
   # GETTER


   function getSurvivorId(){
      return $this->survivorId;
   }


   function getSurveyId(){
      return $this->surveyId;
   }


   function getSurvivorEmail(){
      return $this->survivorEmail;
   }


   function getEmailSent(){
      return $this->emailSent;
   }


   /**
    * get Survivor Token
    *
    * @return string
    */
   function getTid(){
      return $this->tid;
   }


   #######################################################################
   # SETTER


   function setSurvivorId($survivorId){
      $this->_lastError = null;

      /*
       //add your validation here
       if($survivorId == "") {
       $this->_lastError = ERROR_REQUIRED_SETPARAMETER_IS_NULL;
       return false;
       }*/

      $this->survivorId = $survivorId;

      return true;
   }

   function setSurveyId($surveyId){
      $this->_lastError = null;

      /*
       //add your validation here
       if($surveyId == "") {
       $this->_lastError = ERROR_REQUIRED_SETPARAMETER_IS_NULL;
       return false;
       }*/

      $this->surveyId = $surveyId;

      return true;
   }

   function setSurvivorEmail($survivorEmail){
      $this->_lastError = null;

      /*
       //add your validation here
       if($survivorEmail == "") {
       $this->_lastError = ERROR_REQUIRED_SETPARAMETER_IS_NULL;
       return false;
       }*/

      $this->survivorEmail = $survivorEmail;

      return true;
   }

   function setEmailSent($emailSent){
      $this->_lastError = null;

      /*
       //add your validation here
       if($emailSent == "") {
       $this->_lastError = ERROR_REQUIRED_SETPARAMETER_IS_NULL;
       return false;
       }*/

      $this->emailSent = $emailSent;

      return true;
   }

   function setTid($tid){
      $this->_lastError = null;

      /*
       //add your validation here
       if($tid == "") {
       $this->_lastError = ERROR_REQUIRED_SETPARAMETER_IS_NULL;
       return false;
       }*/

      $this->tid = $tid;

      return true;
   }

   #######################################################################
   # SELECT
   /**
    * Load data from DB by ID
    *
    * @param string $id
    * @return bool
    */
   function _loadDataById($id){
      global $database;
      $this->_lastError = null;

      if($id == "") {
         $this->_lastError = ERROR_REQUIRED_PARAMETER_IS_NULL;
         return false;
      }

      $sqlQuery = "SELECT *
      				 FROM ".TABLE_SURVEY_SURVIVORS."
                    WHERE survivor_id = $id;";

      #$sqlQueryResult = tep_db_reader_query($sqlQuery);
      $sqlQueryResult = $database->openConnectionWithReturn($sqlQuery);
       
      #if($result = tep_db_fetch_array($sqlQueryResult)){
      if($result = mysql_fetch_array($sqlQueryResult)){
         $this->survivorId = $result['survivor_id'];
         $this->surveyId = $result['survey_id'];
         $this->survivorEmail = $result['survivor_email'];
         $this->emailSent = $result['email_sent'];
         $this->tid = $result['tid'];

         return true;
      }
   }

   #######################################################################
   # DELETE
   /**
    * Remove Item from DB By Primary Key
    *
    * @param String $id
    * @return boolean
    */
   function _delete($id){
      global $database;
      $this->_lastError = null;

      if($id == "") {
         $this->_lastError = ERROR_REQUIRED_PARAMETER_IS_NULL;
         return false;
      }


      $sqlQuery = "DELETE FROM ".TABLE_SURVEY_SURVIVORS."
                                    WHERE survivor_id = $id;";
      $sqlQueryResult = $database->openConnectionNoReturn($sqlQuery);

      return true;

   }

   #######################################################################
   # INSERT
   /**
    * Insert new Item to DB
    *
    * @return boolean
    */
   function _insert(){
      global $database;
      $this->survivorId = ""; // clear key for autoincrement

      $sqlQuery = "INSERT INTO ".TABLE_SURVEY_SURVIVORS." (
                               survivor_id,
                               survey_id,
                               survivor_email,
                               email_sent,
                               tid 
                               )
                               VALUES ( 
                               '$this->survivorId',
                               '$this->surveyId',
                               '$this->survivorEmail',
                               '$this->emailSent',
                               '$this->tid' 
             )";
      $result = $database->openConnectionNoReturn($sqlQuery);
      $this->survivorId = mysql_insert_id();

      return true;
   }

   #######################################################################
   # UPDATE
   /**
    * Update item values in DB by PrimaryKey
    *
    * @param string $id
    * @return bool
    */
   function _update($id){
      global $database;
      $this->_lastError = null;

      if($id == "") {
         $this->_lastError = ERROR_REQUIRED_PARAMETER_IS_NULL;
         return false;
      }

      $sqlQuery = " UPDATE ".TABLE_SURVEY_SURVIVORS." SET
                           survivor_id = '$this->survivorId',
                           survey_id = '$this->surveyId',
                           survivor_email = '$this->survivorEmail',
                           email_sent = '$this->emailSent',
                           tid = '$this->tid'
                     WHERE survivor_id = $id ";

      $result = $database->openConnectionNoReturn($sqlQuery);



      return true;
   }

   /**
    * gives back getLastError
    *
    * @access public
    * @author Mischa Kupriyanov, <m@kupriyanov.com>
    * @return string
    */
   function getLastError(){
      $returnValue = (string) '';

      $returnValue = $this->_lastError;
      $this->_lastError = null;

      return (string) $returnValue;
   }

}

?>