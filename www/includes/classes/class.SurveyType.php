<?php
//error_reporting(E_ALL);
/**
 * de.mksurvey - classes\class.SurveyType.php
 *
 * @version $Id: class.SurveyType.php 134 2007-11-25 04:10:22Z mimait04 $
 *
 *
 * Copyright (c) 2007 M.Kupriyanov
 * @author M.M-Kupriyanov, <m@kupriyanov.com>
 * @date 25.06.2007 23:03:56
 * @package mkSurvey
 *
 */

define('TABLE_SURVEY_TYPES',DB_PREFIX.'survey_types');

class SurveyType{

   var $surveyTypeId;        // KEY ATTR. WITH AUTOINCREMENT
   var $_lastError;   // Last Error in the Class

   var $name;                 //char(10)
   var $description;                 //char(255)
   var $languages;                 //char(100)



   function SurveyType($surveyTypeId = null){

      if ($surveyTypeId==null){

      }else{
         $this->_loadDataById($surveyTypeId);
      }

   }

   #######################################################################
   # GETTER


   function getSurveyTypeId(){
      return $this->surveyTypeId;
   }


   function getName(){
      return $this->name;
   }


   function getDescription(){
      return $this->description;
   }


   function getLanguages(){
      return $this->languages;
   }


   #######################################################################
   # SETTER


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

   function setName($name){
      $this->_lastError = null;

      /*
       //add your validation here
       if($name == "") {
       $this->_lastError = ERROR_REQUIRED_SETPARAMETER_IS_NULL;
       return false;
       }*/

      $this->name = $name;

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

   function setLanguages($languages){
      $this->_lastError = null;

      /*
       //add your validation here
       if($languages == "") {
       $this->_lastError = ERROR_REQUIRED_SETPARAMETER_IS_NULL;
       return false;
       }*/

      $this->languages = $languages;

      return true;
   }

   #######################################################################
   # SELECT

   function _loadDataById($id){
      $this->_lastError = null;

      if($id == "") {
         $this->_lastError = ERROR_REQUIRED_PARAMETER_IS_NULL;
         return false;
      }

      $sqlQuery = "SELECT * FROM ".TABLE_SURVEY_TYPES."
                            WHERE survey_type_id = $id;";

      $sqlQueryResult = tep_db_reader_query($sqlQuery);
       
      if($result = tep_db_fetch_array($sqlQueryResult)){
         $this->surveyTypeId = $result['survey_type_id'];
         $this->name = $result['name'];
         $this->description = $result['description'];
         $this->languages = $result['languages'];

         return true;
      }
   }

   #######################################################################
   # DELETE

   function _delete($id){
      $this->_lastError = null;

      if($id == "") {
         $this->_lastError = ERROR_REQUIRED_PARAMETER_IS_NULL;
         return false;
      }


      $sqlQuery = "DELETE FROM ".TABLE_SURVEY_TYPES."
                                    WHERE survey_type_id = $id;";
      $sqlQueryResult = tep_db_reader_query($sqlQuery);

      return true;

   }

   #######################################################################
   # INSERT

   function _insert(){
      $this->surveyTypeId = ""; // clear key for autoincrement

      $sqlQuery = "INSERT INTO ".TABLE_SURVEY_TYPES." (
                               survey_type_id,
                               name,
                               description,
                               languages 
                               )
                               VALUES ( 
                               '$this->surveyTypeId',
                               '$this->name',
                               '$this->description',
                               '$this->languages' 
             )";
      tep_db_writer_query($sqlQuery);
      $this->surveyTypeId = tep_db_insert_id();

      return true;
   }

   #######################################################################
   # UPDATE

   function _update($id){
      $this->_lastError = null;

      if($id == "") {
         $this->_lastError = ERROR_REQUIRED_PARAMETER_IS_NULL;
         return false;
      }

      $sqlQuery = " UPDATE ".TABLE_SURVEY_TYPES." SET
                           survey_type_id = '$this->surveyTypeId',
                           name = '$this->name',
                           description = '$this->description',
                           languages = '$this->languages'
                     WHERE survey_type_id = $id ";

      $result = tep_db_writer_query($sqlQuery);



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