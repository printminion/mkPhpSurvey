<?php
//error_reporting(E_ALL);
/**
 * de.mksurvey - classes\class.SurveySessionAbstract.php
 *
 * @version $Id:$
 *
 *
 * Copyright (c) 2007 M.Kupriyanov
 * @author Mikhaylo Matiyenko-Kupriyanov, <m@kupriyanov.de>
 * @date 15.07.2007 18:15:58
 * @package mkSurvey
 *
 */

class SurveySessionAbstract{
   //   var $id;        // KEY ATTR. WITH AUTOINCREMENT
   var $_lastError;   // Last Error in the Class
   var $_TABLE_SDATA;

   //   var $token;
   var $survivorId;
   var $surveyId;
   var $emailSent;
   var $survivorEmail;                 //char(50)
   var $tid;                 //char(50)

   var $finished;                 //tinyint(1)


   function SurveySessionAbstract($id = null){


      if ($id==null){

      }else{
         $this->_loadDataById($id);
      }

   }

   #######################################################################
   # GETTER
   function getId(){
      return $this->id;
   }

   function getSurvivorEmail(){
      return $this->survivorEmail;
   }

   function getTid(){
      return $this->tid;
   }

   function getFinished(){
      return $this->finished;
   }

   function getValue($key){

   }

   function getSurveyId(){
      return $this->surveyId;
   }

   function getSurveyLanguage(){
      return 'dei';
   }

   function getSurveyData(){
      return $this->surveyData;
   }

   #######################################################################
   # SETTER
   function setDataSource($sourceName = null){
      $this->_TABLE_SDATA = $sourceName;
   }

   function setValue($key, $value){
//      debug_sql("setValue($key, $value)");

      if($key == '') {
         $this->_lastError = ERROR_REQUIRED_PARAMETER_KEY_IS_NULL;
         return false;
      }

      if(!$this->_validateInput($key, $value)){
         $this->_lastError = ERROR_VALIDATION_ERROR;
         return false;
      }

//      debug_obj($this->surveyData);

      if($this->surveyData['id']['data'] == '' && $key != 'finished'){

         $this->surveyData['survivor_email']['data'] = $this->survivorEmail;
         $this->surveyData['finished']['data']       = $this->finished;
         $this->surveyData['tid']['data']            = $this->tid;

         $this->surveyData[$key]['data']             = $value;

         //echo dumpPrintRToString2($this->surveyData);
         
         $this->_insertSurveyData($key);
         
         //echo dumpPrintRToString2($this->surveyData);
         
         return true;

      }else{
         $this->surveyData[$key]['data']             = $value;
         return $this->_updateSurveyData($this->id, $key, $value);
      }

      if($key == 'finished' && $value == 1){
         $this->finished = true;
      }
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

      //debug_sql("_loadDataById($id)");

      if($id == "") {
         $this->_lastError = ERROR_REQUIRED_PARAMETER_IS_NULL;
         return false;
      }

      $sqlQuery = "SELECT *
                     FROM ".$this->_TABLE_SDATA."
                    WHERE id = $id;";

//      debug_sql($sqlQuery);

      #$sqlQueryResult = tep_db_reader_query($sqlQuery);
      $sqlQueryResult = $database->openConnectionWithReturn($sqlQuery);

      #if($result = tep_db_fetch_array($sqlQueryResult)){
      if($result = mysql_fetch_array($sqlQueryResult)){
         $this->id            = $result['id'];
         $this->survivorEmail = $result['survivor_email'];
         $this->tid           = $result['tid'];
         $this->finished      = $result['finished'];

//         debug_obj($result);

         //         return true;
      }

      $sqlQuery = "SHOW COLUMNS FROM ".$this->_TABLE_SDATA.";";
      $sqlQueryResult = $database->openConnectionWithReturn($sqlQuery);

      while ($row = mysql_fetch_row($sqlQueryResult)) {
         //debug_obj($row,'$row');

         $this->surveyData[$row[0]] = array('type' => $row[1],
                                            'data' => $result[$row[0]]
                                           );
      }

      return false;

   }

   function _loadDataByTid($tid){
      global $database;
      $this->_lastError = null;

//      debug_sql("_loadDataByTid($tid)");

      if($tid == "") {
         $this->_lastError = ERROR_REQUIRED_PARAMETER_IS_NULL;
         return false;
      }

      $sqlQuery = "SELECT *
                     FROM ".$this->_TABLE_SDATA."
                    WHERE tid LIKE '$tid';";
      
//      debug_sql($sqlQuery);
      $sqlQueryResult = $database->openConnectionWithReturn($sqlQuery);


      if($result = mysql_fetch_array($sqlQueryResult)){
//         debug_obj($result);
         return $this->_loadDataById($result['id']);
      }

      $this->_lastError = ERROR_FAILED_TO_LOAD_DATA_BY_TID;
      return false;
   }

   function _validateInput($key,$value){

      return true;
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

      if($id == '') {
         $this->_lastError = ERROR_REQUIRED_PARAMETER_IS_NULL;
         return false;
      }


      $sqlQuery = "DELETE FROM ".$this->_TABLE_SDATA."
                          WHERE id = $id;";
      $sqlQueryResult = $database->openConnectionNoReturn($sqlQuery);

      return true;

   }

   #######################################################################
   # INSERT
   /**
    * Insert new/first Item to DB
    *
    * @return boolean
    */
   function _insertSurveyData($key){
      global $database;
      $this->id = ""; // clear key for autoincrement

      if ($key == 'survivor_email' || $key == 'tid' ||$key == 'finished') {
          $this->_lastError = ERROR_FORBIDDEN_KEY_VALUE_IS_SET;
         return false;
      }
      
      $sqlQuery = "INSERT INTO ".$this->_TABLE_SDATA." (
                               survivor_email,
                               tid,
                 			         finished,
                               $key
                               )
                               VALUES (
                               '".$this->surveyData['survivor_email']['data']."',
                               '".$this->surveyData['tid']['data']."',
                 				       false,
                               '".$this->surveyData[$key]['data']."'
                       )";

//      debug_sql($sqlQuery);

      $result = $database->openConnectionNoReturn($sqlQuery);
      //      $this->id = mysql_insert_id();
      $this->surveyData['id']['data'] = mysql_insert_id();
      $this->id = $this->surveyData['id']['data'];

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
   function _updateSurveyData($id,$key,$value){
//      debug_sql("_updateSurveyData($id,$key,$value)");

      global $database;
      $this->_lastError = null;

      if($id == "") {
         $this->_lastError = ERROR_REQUIRED_PARAMETER_IS_NULL;
         return false;
      }

      $sqlQuery = " UPDATE ".$this->_TABLE_SDATA." SET
                           $key       = '$value'
                     WHERE id = ".$this->surveyData['id']['data'];

      $result = $database->openConnectionNoReturn($sqlQuery);

//      debug_sql($sqlQuery);


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