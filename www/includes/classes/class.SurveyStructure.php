<?php
//error_reporting(E_ALL);
/**
 * de.mksurvey - classes\class.SurveyStructure.php
 *
 * @version $Id: class.SurveyStructure.php 134 2007-11-25 04:10:22Z mimait04 $
 *
 *
 * Copyright (c) 2007 M.Kupriyanov
 * @author M.M-Kupriyanov, <m@kupriyanov.com>
 * @date 26.06.2007 04:09:02
 * @package mkSurvey
 *
 */

define('TABLE_SURVEY_STRUCTURE',DB_PREFIX.'survey_structure');

class SurveyStructure{

   var $id;        // KEY ATTR. WITH AUTOINCREMENT
   var $_lastError;   // Last Error in the Class

   var $surveyTypeId;   //char(10)
   var $fieldName;      //char(10)
   var $ucTypeId;       //char(10)
   var $required;       //tinyint(1)
   var $page;           //int(2)
   var $order;          //int(3)
   var $static;         //int(1)
   var $validate;       //char(50)
   
//   var $_recuiredValuesArr; //array with static values
//   var $_staticValuesArr; //array with static values
//   var $_validateRulesArr; //array with validation rules


   function SurveyStructure($id = null){

      if ($id==null){

      }else{
         $this->_loadDataById($id);
      }

   }

   /**
    * Check if datatable exists and giveback sql qurey to create it
    *
    * @param string $surveyTypeId
    * @return bool
    */
   function getCreateQueryBySurveyType($surveyTypeId){
      global $database;
      $this->_lastError = null;

      if($surveyTypeId==''){
         $this->_lastError = ERROR_REQUIRED_SURVEYTYPEID_IS_NULL;
         return false;
      }

      //check if table exist
      
      $sqlQuery = "SHOW tables LIKE '".DB_PREFIX."sdata_$surveyTypeId';";
      $sqlQueryResult = $database->openConnectionWithReturn($sqlQuery);
      if($result = mysql_fetch_array($sqlQueryResult)){
         return $sqlQuery;
      }
      
      $sqlQuery = "SELECT ss.id,
						  ss.field_name,
						  ss.uc_type_id,
						  ss.required,
						  ss.page,
						  ss.order,
						  ss.uc_type_id,
						  uc.sql_type
				     FROM ".DB_PREFIX."survey_structure ss JOIN ".DB_PREFIX."user_controls uc 
					   ON ss.uc_type_id = uc.uc_type_id
					WHERE survey_type_id = '$surveyTypeId'
				 ORDER BY ss.order ASC ";

//      debug_sql($sqlQuery,'$sqlQuery');

      $sqlQueryResult = $database->openConnectionWithReturn($sqlQuery);

      /*
       * Create data table
       */
      $sqlQueryCreate  = "CREATE TABLE `".DB_PREFIX."sdata_$surveyTypeId`  (";
      $sqlQueryCreate .= "`id` int(11) NOT NULL auto_increment,";
      $sqlQueryCreate .= "`finished` tinyint(1) NOT NULL default '0',";
      $sqlQueryCreate .= "`config` tinyint(1) NOT NULL default '0',";
      $sqlQueryCreate .= "`survivor_email` char(50) collate utf8_bin NOT NULL,";
      $sqlQueryCreate .= "`tid` char(50) collate utf8_bin NOT NULL,";
      

      while($result = mysql_fetch_array($sqlQueryResult)){
         #$sqlQueryCreate .= "`".$result['survey_type_id']."` ".$result['sql_type']." NOT NULL default '',";
         $sqlQueryCreate .= "`".$result['field_name']."` ".$result['sql_type'].",";
      }

      
      $sqlQueryCreate .= "PRIMARY KEY  (`id`)";
      #$sqlQueryCreate .= "KEY `usertype` (`usertype`)";
      $sqlQueryCreate .= ") ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";

      //      debug_sql($sqlQueryCreate,'$sqlQueryCreate');
      //      die();
      return $sqlQueryCreate;


   }
   #######################################################################
   # GETTER


   function getId(){
      return $this->id;
   }


   function getSurveyTypeId(){
      return $this->surveyTypeId;
   }


   function getFieldName(){
      return $this->fieldName;
   }


   function getUcTypeId(){
      return $this->ucTypeId;
   }


   function getRequired(){
      return $this->required;
   }


   function getPage(){
      return $this->page;
   }


   function getOrder(){
      return $this->order;
   }


   #######################################################################
   # SETTER


   function setId($id){
      $this->_lastError = null;

      /*
       //add your validation here
       if($id == "") {
       $this->_lastError = ERROR_REQUIRED_SETPARAMETER_IS_NULL;
       return false;
       }*/

      $this->id = $id;

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

   function setFieldName($fieldName){
      $this->_lastError = null;

      /*
       //add your validation here
       if($fieldName == "") {
       $this->_lastError = ERROR_REQUIRED_SETPARAMETER_IS_NULL;
       return false;
       }*/

      $this->fieldName = $fieldName;

      return true;
   }

   function setUcTypeId($ucTypeId){
      $this->_lastError = null;

      /*
       //add your validation here
       if($ucTypeId == "") {
       $this->_lastError = ERROR_REQUIRED_SETPARAMETER_IS_NULL;
       return false;
       }*/

      $this->ucTypeId = $ucTypeId;

      return true;
   }

   function setRequired($required){
      $this->_lastError = null;

      /*
       //add your validation here
       if($required == "") {
       $this->_lastError = ERROR_REQUIRED_SETPARAMETER_IS_NULL;
       return false;
       }*/

      $this->required = $required;

      return true;
   }

   function setPage($page){
      $this->_lastError = null;

      /*
       //add your validation here
       if($page == "") {
       $this->_lastError = ERROR_REQUIRED_SETPARAMETER_IS_NULL;
       return false;
       }*/

      $this->page = $page;

      return true;
   }

   function setOrder($order){
      $this->_lastError = null;

      /*
       //add your validation here
       if($order == "") {
       $this->_lastError = ERROR_REQUIRED_SETPARAMETER_IS_NULL;
       return false;
       }*/

      $this->order = $order;

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
				     FROM ".TABLE_SURVEY_STRUCTURE."
                    WHERE id = $id;";

      #$sqlQueryResult = tep_db_reader_query($sqlQuery);
      $sqlQueryResult = $database->openConnectionWithReturn($sqlQuery);
       
      #if($result = tep_db_fetch_array($sqlQueryResult)){
      if($result = mysql_fetch_array($sqlQueryResult)){
         $this->id = $result['id'];
         $this->surveyTypeId = $result['survey_type_id'];
         $this->fieldName = $result['field_name'];
         $this->ucTypeId = $result['uc_type_id'];
         $this->required = $result['required'];
         $this->page     = $result['page'];
         $this->order    = $result['order'];
         $this->static   = $result['static'];
         $this->validate = $result['validate'];

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


      $sqlQuery = "DELETE FROM ".TABLE_SURVEY_STRUCTURE."
                                    WHERE id = $id;";
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
      $this->id = ""; // clear key for autoincrement

      $sqlQuery = "INSERT INTO ".TABLE_SURVEY_STRUCTURE." (
                               id,
                               survey_type_id,
                               field_name,
                               uc_type_id,
                               required,
                               page,
                               order,
                               static,
                               validate 
                               )
                               VALUES ( 
                               '$this->id',
                               '$this->surveyTypeId',
                               '$this->fieldName',
                               '$this->ucTypeId',
                               '$this->required',
                               '$this->page',
                               '$this->order',
                               '$this->static',
                               '$this->validate' 
             )";
      $result = $database->openConnectionNoReturn($sqlQuery);
      $this->id = mysql_insert_id();

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

      $sqlQuery = " UPDATE ".TABLE_SURVEY_STRUCTURE." SET
                           id = '$this->id',
                           survey_type_id = '$this->surveyTypeId',
                           field_name = '$this->fieldName',
                           uc_type_id = '$this->ucTypeId',
                           required = '$this->required',
                           page = '$this->page',
                           order = '$this->order',
                           static = '$this->static',
                           validate = '$this->validate'
                     WHERE id = $id ";

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