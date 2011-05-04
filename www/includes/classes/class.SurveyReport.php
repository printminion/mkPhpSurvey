<?
/**
 * @version $Id:$
 * @package mkSurvey
 */

include_once(CLASSES_PATH.'/class.SurveyReportAbstract.php');
include_once(CLASSES_PATH.'/class.Survey.php');

class SurveyReport extends SurveyReportAbstract{
   var $surveyTypeId;

   function SurveyReport($surveyID = null){
      global $database;
      //      debug_sql("SurveyReport($surveyID = null)");

      if ($surveyID == ''){
         $this->_lastError = ERROR_REQUIRED_PARAMETER_SURVEYID_IS_NULL;
         return false;
      }

      //      //TODO load data
      //		$sqlQuery = "SELECT *
      //					   FROM `".DB_PREFIX."survey_survivors`
      //					  WHERE `tid` LIKE '$surveyID'";
      //
      //         #$sqlQueryResult = tep_db_reader_query($sqlQuery);
      //      $sqlQueryResult = $database->openConnectionWithReturn($sqlQuery);
      //
      //      #if($result = tep_db_fetch_array($sqlQueryResult)){
      //      if($result = mysql_fetch_array($sqlQueryResult)){
      //         $this->survivorId    = $result['survivor_id'];
      //         $this->surveyId      = $result['survey_id'];
      //         $this->survivorEmail = $result['survivor_email'];
      //         $this->emailSent     = $result['email_sent'];
      //         $this->tid           = $result['tid'];
      //
      ////         return true;
      //      }
       
      $this->surveyId = $surveyID;
      $surveyObj = new Survey($this->surveyId);



      $this->_TABLE_SDATA = DB_PREFIX.'sdata_'.$surveyObj->getSurveyTypeId();
      $this->surveyTypeId = $surveyObj->getSurveyTypeId();

      //      $this->_loadDataByTid($this->tid);
      #$this->_loadDataById($this->survivorId);
      $this->_loadDataBySurveyId($this->surveyId);

      //      debug_obj($surveyObj,'$surveyObj');

      define('TABLE_SDATA',$this->_TABLE_SDATA);

   }

   function getSurveyTypeId(){
      return $this->surveyTypeId;
   }

}
?>