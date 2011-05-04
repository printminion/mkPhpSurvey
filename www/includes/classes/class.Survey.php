<?php
//error_reporting(E_ALL);
/**
 * de.mksurvey - classes\class.Survey.php
 *
 * @version $Id: class.Survey.php 143 2007-12-07 09:39:45Z mimait04 $
 *
 *
 * Copyright (c) 2007 M.Kupriyanov
 * @author M.M-Kupriyanov, <m@kupriyanov.com>
 * @date 26.06.2007 01:13:59
 * @package mkSurvey
 *
 */

define('TABLE_SURVEYS',DB_PREFIX.'surveys');

class Survey{

   var $surveyId;        // KEY ATTR. WITH AUTOINCREMENT
   var $_lastError;   // Last Error in the Class

   var $userId;                 //int(10)
   var $surveyTypeId;                 //char(10)
   var $title;                 //char(80)
   var $dateCreated;                 //datetime
   var $dateFinish;                 //datetime
   var $dateBegin;                 //datetime
   var $description;                 //char(255)
   var $finished;                 //tinyint(1)
   var $token;                 //char(50)
   
   var $_constantValuesDataArr;



   function Survey($surveyId = null){
      
      if ($surveyId==null){

      }else{
         $this->_loadDataById($surveyId);
      }

   }

   /**
    * array of constant values
    *
    * @return array
    */

   function getConstantDataValues(){
      $this->_loadConstantDataValues();
      return $this->_constantValuesDataArr;
   }

   function setConstantDataValues($surveyConstantDataArr){
      $this->_constantValuesDataArr = $surveyConstantDataArr;
   }

   function _loadConstantDataValues(){
      global $database;
      $this->_constantValuesDataArr = null;


      if ($this->getSurveyId() == null){
         //$this->_lastError = ERROR_REQUIRED_TOKENID_IS_NULL;
         $this->_addError(ERROR_REQUIRED_SURVEYID_IS_NULL);
         return false;
      }

      $sqlQuery = "SELECT *
					 FROM ".DB_PREFIX."sdata_".$this->getSurveyTypeId()."
					WHERE tid = '".$this->getSurveyId()."'
					  AND config = 1";
      $resultRes = $database->openConnectionWithReturn($sqlQuery);
      $constantValuesDataArr = mysql_fetch_assoc($resultRes);

      //print_r($constantValuesDataArr);
      //debug_obj($constantValuesDataArr);
       
      //debug_sql($sqlQuery);
      //echo $sqlQuery;

      $resultRes = $database->openConnectionWithReturn($sqlQuery);

      $sqlQuery = "SELECT *
					 FROM ".DB_PREFIX."survey_structure
					WHERE survey_type_id = '".$this->getSurveyTypeId()."'
					  AND static = 1
				 ORDER BY ".DB_PREFIX."survey_structure.order ASC";

      //debug_sql($sqlQuery);
      //echo $sqlQuery;

      $resultRes = $database->openConnectionWithReturn($sqlQuery);

      while($result = mysql_fetch_array($resultRes)){
         //$this->_constantValuesDataArr[$result['field_name']] = $constantValuesDataArr[$result['field_name']];

         $this->_constantValuesDataArr[$result['field_name']] = array(
                  'id'               => $result['id'],
                  'survey_type_id'	 => $result['survey_type_id'],
                  'field_name'       => $result['field_name'],
                  'uc_type_id'       => $result['uc_type_id'],
                  'required'         => $result['required'],
                  'page'             => $result['page'],
                  'order'            => $result['order'],
                  'validate'         => $result['validate'],
                  'value'            => $constantValuesDataArr[$result['field_name']],
         	      'caption'          => $result['field_name']
         );
      }

      //print_r($this->_constantValuesDataArr);

   }
   
   function getSurveyConstants(){
      global $database;
      $surveyConstansArr = null;

      if ($surveyID == null){
         //$this->_lastError = ERROR_REQUIRED_TOKENID_IS_NULL;
         $this->_addError(ERROR_REQUIRED_SURVEYID_IS_NULL);
         return false;
      }

      $sqlQuery = "SELECT *
					 FROM ".DB_PREFIX."survey_structure
					WHERE survey_type_id = '".$this->getSurveyId()."'
					  AND static = 1
				 ORDER BY ".DB_PREFIX."survey_structure.order ASC";

      //debug_sql($sqlQuery);
      //echo $sqlQuery;

      $resultRes = $database->openConnectionWithReturn($sqlQuery);

      while($result = mysql_fetch_array($resultRes)){
         $surveyConstansArr[$result['id']] = array(
         'id'               => $result['id'],
         'survey_type_id'	=> $result['survey_type_id'],
         'field_name'       => $result['field_name'],
         'uc_type_id'       => $result['uc_type_id'],
         'required'         => $result['required'],
         'page'             => $result['page'],
         'order'            => $result['order'],
         'validate'         => $result['validate']
         );
      }


      return $surveyConstansArr;
   }

   #######################################################################
   # GETTER

   /**
    * Get Survey Id
    *
    * @return long
    */
   function getSurveyId(){
      return $this->surveyId;
   }


   function getUserId(){
      return $this->userId;
   }

   /**
    * Gets Type of Survey
    *
    * @return string
    */
   function getSurveyTypeId(){
      return $this->surveyTypeId;
   }

   /**
    * Gets Title of Survey
    *
    * @return string
    */
   function getTitle(){
      return $this->title;
   }


   function getDateCreated(){
      return $this->dateCreated;
   }


   function getDateFinish(){
      return $this->dateFinish;
   }


   function getDateBegin(){
      return $this->dateBegin;
   }


   /**
    * Gets Descrioption of Survey
    *
    * @return string
    */
   function getDescription(){
      return $this->description;
   }

   /**
    * Gets if Survey is Finished
    *
    * @return int
    */
   function getFinished(){
      return $this->finished;
   }

   /**
    * Get Survey Token
    *
    * @return string
    */
   function getToken(){
      return $this->token;
   }
   
   #######################################################################
   # SETTER


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

   function setUserId($userId){
      $this->_lastError = null;

      /*
       //add your validation here
       if($userId == "") {
       $this->_lastError = ERROR_REQUIRED_SETPARAMETER_IS_NULL;
       return false;
       }*/

      $this->userId = $userId;

      return true;
   }

   function setSurveyTypeId($surveyTypeId){
      $this->_lastError = null;

      /*
       //add your validation here
       if($surveyTypeId == "") {
       $this->_lastError = ERROR_REQUIRED_SETPARAMETER_IS_NULL;
       return false;
       }*/

      $this->surveyTypeId = $surveyTypeId;

      return true;
   }

   function setTitle($title){
      $this->_lastError = null;

      /*
       //add your validation here
       if($title == "") {
       $this->_lastError = ERROR_REQUIRED_SETPARAMETER_IS_NULL;
       return false;
       }*/

      $this->title = $title;

      return true;
   }

   function setDateCreated($dateCreated){
      $this->_lastError = null;

      /*
       //add your validation here
       if($dateCreated == "") {
       $this->_lastError = ERROR_REQUIRED_SETPARAMETER_IS_NULL;
       return false;
       }*/

      $this->dateCreated = $dateCreated;

      return true;
   }

   function setDateFinish($dateFinish){
      $this->_lastError = null;

      /*
       //add your validation here
       if($dateFinish == "") {
       $this->_lastError = ERROR_REQUIRED_SETPARAMETER_IS_NULL;
       return false;
       }*/

      $this->dateFinish = $dateFinish;

      return true;
   }

   function setDateBegin($dateBegin){
      $this->_lastError = null;

      /*
       //add your validation here
       if($dateBegin == "") {
       $this->_lastError = ERROR_REQUIRED_SETPARAMETER_IS_NULL;
       return false;
       }*/

      $this->dateBegin = $dateBegin;

      return true;
   }

   function setDescription($description){
      $this->_lastError = null;

      /*
       //add your validation here
       if($description == "") {
       $this->_lastError = ERROR_REQUIRED_SETPARAMETER_IS_NULL;
       return false;
       }*/

      $this->description = $description;

      return true;
   }

   function setFinished($finished){
      $this->_lastError = null;

      /*
       //add your validation here
       if($finished == "") {
       $this->_lastError = ERROR_REQUIRED_SETPARAMETER_IS_NULL;
       return false;
       }*/

      $this->finished = $finished;

      return true;
   }
   
   

   /**
    * Set survey token
    *
    * @param string $token
    * @return bool
    */
   function setToken($token){
      $this->_lastError = null;

      /*
       //add your validation here
       if($finished == "") {
       $this->_lastError = ERROR_REQUIRED_SETPARAMETER_IS_NULL;
       return false;
       }*/

      $this->token = token;

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

      $sqlQuery = "SELECT * FROM ".TABLE_SURVEYS."
                            WHERE survey_id = $id;";

      #$sqlQueryResult = tep_db_reader_query($sqlQuery);
      $sqlQueryResult = $database->openConnectionWithReturn($sqlQuery);
       
      #if($result = tep_db_fetch_array($sqlQueryResult)){
      if($result = mysql_fetch_array($sqlQueryResult)){
         $this->surveyId       = $result['survey_id'];
         $this->userId         = $result['user_id'];
         $this->surveyTypeId   = $result['survey_type_id'];
         $this->surveyTypeName = $result['name'];
         $this->title          = $result['title'];
         $this->dateCreated    = $result['date_created'];
         $this->dateFinish     = $result['date_finish'];
         $this->dateBegin      = $result['date_begin'];
         $this->description    = $result['description'];
         $this->finished       = $result['finished'];
         $this->token          = $result['token'];
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


      $sqlQuery = "DELETE FROM ".TABLE_SURVEYS."
                         WHERE survey_id = $id;";
      $sqlQueryResult = $database->openConnectionNoReturn($sqlQuery);
      
      $this->_deleteDurveyData();
      
      return true;

   }

   function _deleteDurveyData(){
      global $database;
      $this->_lastError = null;

      /*
      if($id == "") {
         $this->_lastError = ERROR_REQUIRED_PARAMETER_IS_NULL;
         return false;
      }*/


      $sqlQuery = "DELETE 
      				 FROM ".DB_PREFIX."sdata_".$this->surveyTypeId."
                    WHERE tid = ".$this->getSurveyId();
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
      $this->surveyId = ""; // clear key for autoincrement
      
      if ($this->token == ''){
         $this->token = md5(mktime() + rand(1,10));
      }
      
      $sqlQuery = "INSERT INTO ".TABLE_SURVEYS." (
                               survey_id,
                               user_id,
                               survey_type_id,
                               title,
                               date_created,
                               date_finish,
                               date_begin,
                               description,
                               finished,
                               token 
                               )
                               VALUES ( 
                               '$this->surveyId',
                               '$this->userId',
                               '$this->surveyTypeId',
                               '$this->title',
                               '$this->dateCreated',
                               '$this->dateFinish',
                               '$this->dateBegin',
                               '$this->description',
                               '$this->finished',
                               '$this->token' 
             )";
      //      debug_sql($sqlQuery);
      //      die();
      $result = $database->openConnectionNoReturn($sqlQuery);
      $this->surveyId = mysql_insert_id();

      //insert static data
      $this->_insertStaticData();
      return true;
   }

   /**
    * Insert Static data
    *
    * @return bool
    */
   function _insertStaticData(){
      global $database;


      $sqlQuery = "INSERT INTO ".DB_PREFIX."sdata_".$this->surveyTypeId." (";
      $sqlQueryKeys   = 'config,tid';
      $sqlQueryValues = '1,'.$this->surveyId;
       
      foreach((array)$this->_constantValuesDataArr as $key => $value){
         $sqlQueryKeys   .= ",$key";
         $sqlQueryValues .= ",'$value'";
      }
       
      $sqlQuery .= "$sqlQueryKeys )VALUES ($sqlQueryValues)";
      $result = $database->openConnectionNoReturn($sqlQuery);

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

      $sqlQuery = " UPDATE ".TABLE_SURVEYS." SET
                           survey_id = '$this->surveyId',
                           user_id = '$this->userId',
                           survey_type_id = '$this->surveyTypeId',
                           title = '$this->title',
                           date_created = '$this->dateCreated',
                           date_finish = '$this->dateFinish',
                           date_begin = '$this->dateBegin',
                           description = '$this->description',
                           finished = '$this->finished',
                           token = '$this->token'
                     WHERE survey_id = $id ";

      $result = $database->openConnectionNoReturn($sqlQuery);

      $this->_updateStaticData();
       
      return true;
   }

   /**
    * update Static data
    *
    * @return bool
    */
   function _updateStaticData(){
      global $database;

      $sqlQuery = " UPDATE ".TABLE_SURVEYS." SET
                           survey_id = '$this->surveyId',
                           user_id = '$this->userId',
                           survey_type_id = '$this->surveyTypeId',
                           title = '$this->title',
                           date_created = '$this->dateCreated',
                           date_finish = '$this->dateFinish',
                           date_begin = '$this->dateBegin',
                           description = '$this->description',
                           finished = '$this->finished',
                           token = '$this->token'
                     WHERE survey_id = $id ";

      $sqlQuery  = "UPDATE ".DB_PREFIX."sdata_".$this->surveyTypeId." SET ";
      $sqlQuery .= 'config=1';

       
      foreach($this->_constantValuesDataArr as $key => $value){
         $sqlQuery .= ", $key = '$value' ";
      }
       
      $sqlQuery .= " WHERE tid=".$this->surveyId;
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