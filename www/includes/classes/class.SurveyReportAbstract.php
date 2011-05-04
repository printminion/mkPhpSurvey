<?php
//error_reporting(E_ALL);
/**
 * de.mksurvey - classes\class.SurveyReportAbstract.php
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

class SurveyReportAbstract{
   //   var $id;        // KEY ATTR. WITH AUTOINCREMENT
   var $_lastError;   // Last Error in the Class
   var $_TABLE_SDATA;

   //   var $token;
   //   var $survivorId;
   var $surveyId;
   //   var $emailSent;
   //   var $survivorEmail;                 //char(50)
   //   var $surveyId;                 //char(50)

   var $finished;                 //tinyint(1)


   function SurveyReportAbstract($id = null){


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

   //   function getSurvivorEmail(){
   //      return $this->survivorEmail;
   //   }


   function getTid(){
      return $this->tid;
   }

   /**
    * get 1 if survey is finished
    *
    * @return bool
    */
   function getFinished(){
      return $this->finished;
   }

   /*
    function getValue($key){

    }*/

   function getSurveyId(){
      return $this->surveyId;
   }

   function getSurveyLanguage(){
      return 'dei';
   }

   /**
    * get Survey Data Array
    *
    * @return array
    */
   function getSurveyData(){
      return $this->surveyData;
   }

   #######################################################################
   # SETTER
   function setDataSource($sourceName = null){
      $this->_TABLE_SDATA = $sourceName;
   }

   function setValue($key, $value){
      //debug_sql("setValue($key, $value)");

      if($key == '') {
         $this->_lastError = ERROR_REQUIRED_PARAMETER_KEY_IS_NULL;
         return false;
      }

      if(!$this->_validateInput($key, $value)){
         $this->_lastError = ERROR_VALIDATION_ERROR;
         return false;
      }

      //debug_obj($this->surveyData);

      if($this->surveyData['id']['data'] == ''){

         //         $this->surveyData['survivor_email']['data'] = $this->survivorEmail;
         $this->surveyData['finished']['data']       = $this->finished;
         $this->surveyData['tid']['data']            = $this->tid;

         $this->surveyData[$key]['data']             = $value;

         return $this->_insertSurveyData($key);

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

      //      debug_sql("_loadDataById($id)");

      if($id == "") {
         $this->_lastError = ERROR_REQUIRED_PARAMETER_IS_NULL;
         return false;
      }

      $sqlQuery = "SELECT *
      				 FROM ".$this->_TABLE_SDATA."
                    WHERE id = $id;";

      #$sqlQueryResult = tep_db_reader_query($sqlQuery);
      $sqlQueryResult = $database->openConnectionWithReturn($sqlQuery);
       
      #if($result = tep_db_fetch_array($sqlQueryResult)){
      if($result = mysql_fetch_array($sqlQueryResult)){
         $this->id            = $result['id'];
         //         $this->survivorEmail = $result['survivor_email'];
         $this->tid           = $result['tid'];
         $this->finished      = $result['finished'];

         //         debug_obj($result,'result');

         //         return true;
      }

      # get default/constant values

      $surveyObj = new Survey($this->getSurveyId());
      $constantDataValuesArr = $surveyObj->getConstantDataValues();
      //debug_obj($constantDataValuesArr);

      # go trough columns of data table
      $sqlQuery = "SHOW COLUMNS
      			   FROM ".$this->_TABLE_SDATA.";";
      $sqlQueryResult = $database->openConnectionWithReturn($sqlQuery);

      
      $this->surveyData['SURVEY_ID'] = $this->getSurveyId();
      
      while ($row = mysql_fetch_row($sqlQueryResult)) {
         //debug_obj($row,'$row');

         //         $this->surveyData[$row[0]] = array('type' => $row[1],
         //                                            'data' => $result[$row[0]]
         //                                           );

         # set constant values
         if (key_exists($row[0],$constantDataValuesArr)){
            $outputValue = $constantDataValuesArr[$row[0]]['value'];
         }else{
            $outputValue = $this->_getOutputControlAsHtml($row[0]);
         }

         //skip field marked as finished
         if($row[0] != 'finished'){
            $this->surveyData[$row[0]] = array('uc_type'     => $row[0],
											   'type'        => $row[1],
											   'output_html' => $outputValue);
         }

      }

      return false;

   }

   /**
    * Get HTML Representation of OutputControl
    *
    * TODO: Move logic to database
    * @param string $controlId
    */
   function _getOutputControlAsHtml($controlId){
      //     	txt char(50)
      //	Edit 	Delete 	txd 	Int(10)
      //	Edit 	Delete 	txa 	TINYTEXT
      //	Edit 	Delete 	rd7 	enum('1','2','3','4','5','6','7')
      //	Edit 	Delete 	ra6 	enum('1','2','3','4','5','6')
      //	Edit 	Delete 	ra2

      $controlArr = explode('_',$controlId);

      if (count($controlArr)>0){
         $controlTypeId = $controlArr[0];
      }

      //debug_obj($this,$controlTypeId);

      switch ($controlTypeId){
         case 'txt':
            //$controlHtml = WARNING_CONTROL_IS_NOT_YET_DEFINED1;
            //$controlHtml = "<div id=".$controlId." class='$controlTypeId'>WARNING_CONTROL_IS_NOT_YET_DEFINED1</div>";
             
            $controlHtml  = "<div id='".$controlId."' class='$controlTypeId'>loading...</div>";
            $controlHtml .= '<script type="text/javascript">xajax_doGetReportValue({"sid": "'.$this->surveyId.'", "id": "'.$controlId.'"});</script>';
            $controlHtml = '<div style="position: static;" class="bag-wrap"><div class="bag-head folded clickable">'.$controlHtml.'</div><div style="display: none;" id="'.$controlId.'_body" class="bag-body">lade...</div></div>';
            //debug_obj($this);
            break;
         case 'txd':
            $controlHtml = "<img src='".LIVE_SITE."/admin/?surveyReportControl&sid=".$this->surveyId."&controlID=$controlId&rmd=".mktime()."' border='0' id='".$controlId."' class='$controlTypeId graph_loading' alt=''/>";
            break;
         case 'txa':
            //$controlHtml = "<div id=".$controlId." class='txa'>WARNING_CONTROL_IS_NOT_YET_DEFINED2</div>";
            $controlHtml = "<div id='".$controlId."' class='txa'>lade...</div>";
            $controlHtml .= '<script type="text/javascript">xajax_doGetReportValue({"sid": "'.$this->surveyId.'", "id": "'.$controlId.'"});</script>';
            
            $controlHtml = '<div style="position: static;" class="bag-wrap"><div class="bag-head folded clickable">'.$controlHtml.'</div><div style="display: none;" id="'.$controlId.'_body" class="bag-body">lade...</div></div>';
            
            //$controlHtml = WARNING_CONTROL_IS_NOT_YET_DEFINED2;
            break;
         case 'rd7':
            $controlHtml = "<img src='".LIVE_SITE."/admin/?surveyReportControl&sid=".$this->surveyId."&controlID=$controlId&rmd=".mktime()."' border='0' id='".$controlId."' class='$controlTypeId graph_loading' alt=''/>";
            break;
         case 'ra6':
            $controlHtml = "<img src='".LIVE_SITE."/admin/?surveyReportControl&sid=".$this->surveyId."&controlID=$controlId&rmd=".mktime()."' border='0' id='".$controlId."' class='$controlTypeId graph_loading' alt=''/>";
            break;
         case 'ra2':
            $controlHtml = "<img src='".LIVE_SITE."/admin/?surveyReportControl&sid=".$this->surveyId."&controlID=$controlId&rmd=".mktime()."' border='0' id='".$controlId."' class='$controlTypeId graph_loading' alt=''/>";
            break;
         default:
            $controlHtml = WARNING_NO_CONTROL_TEMPLATE_DEFINED3;
            break;
      }

      return $controlHtml;

   }

   function _loadDataBySurveyId($surveyId){
      global $database;
      $this->_lastError = null;

      //      debug_sql("_loadDataBySurveyId($surveyId)");

      if($surveyId == "") {
         $this->_lastError = ERROR_REQUIRED_PARAMETER_IS_NULL;
         return false;
      }

      //      $sqlQuery = "SELECT *
      //				     FROM ".$this->_TABLE_SDATA."
      //                    WHERE tid LIKE '$tid';";
      //
      //      $sqlQueryResult = $database->openConnectionWithReturn($sqlQuery);
      //
      //
      //      if($result = mysql_fetch_array($sqlQueryResult)){
      //         debug_obj($result);
      //         return $this->_loadDataById($result['id']);
      //      }

      return $this->_loadDataById($surveyId);

      //      $this->_lastError = ERROR_FAILED_TO_LOAD_DATA_BY_TID;
      //      return false;
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
    * Insert new Item to DB
    *
    * @return boolean
    */
   function _insertSurveyData($key){
      global $database;
      $this->id = ""; // clear key for autoincrement

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

							   //debug_sql($sqlQuery);

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
      //debug_sql("_updateSurveyData($id,$key,$value)");

      global $database;
      $this->_lastError = null;

      if($id == "") {
         $this->_lastError = ERROR_REQUIRED_PARAMETER_IS_NULL;
         return false;
      }

      $sqlQuery = " UPDATE ".$this->_TABLE_SDATA." SET
      $key 		  = '$value'
                     WHERE id = ".$this->surveyData['id']['data'];

      $result = $database->openConnectionNoReturn($sqlQuery);

      //debug_sql($sqlQuery);


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