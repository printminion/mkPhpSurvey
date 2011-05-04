<?
/**
 * @version $Id:$
 * @package mkSurvey
 */
include_once(CLASSES_PATH.'/class.SurveySesionAbstract.php');
include_once(CLASSES_PATH.'/class.Survey.php');

class SurveySession extends SurveySessionAbstract{
   var $surveyTypeId;

   function SurveySession($tokenID = null){
      global $database;
       
      if ($tokenID == null){
         return false;
      }

      //debug_sql("SurveySession($tokenID = null)");

      //TODO load data
      $sqlQuery = "SELECT *
                   FROM `".DB_PREFIX."survey_survivors`
                  WHERE `tid` 
                   LIKE '$tokenID'";

      #$sqlQueryResult = tep_db_reader_query($sqlQuery);
      $sqlQueryResult = $database->openConnectionWithReturn($sqlQuery);

      #if($result = tep_db_fetch_array($sqlQueryResult)){
      if($result = mysql_fetch_array($sqlQueryResult)){
         $this->survivorId    = $result['survivor_id'];
         $this->surveyId      = $result['survey_id'];
         $this->survivorEmail = $result['survivor_email'];
         $this->emailSent     = $result['email_sent'];
         $this->tid           = $result['tid'];

         //         return true;
      }


      $surveyObj = new Survey($this->surveyId);

      //debug_obj($surveyObj,$this->surveyId);

      if ($surveyObj->getSurveyTypeId() == ''){
         $this->_lastError = ERROR_FAILED_TOGET_SURVEYTYPEID;
         return false;
      }

      $this->_TABLE_SDATA = DB_PREFIX.'sdata_'.$surveyObj->getSurveyTypeId();
      $this->surveyTypeId = $surveyObj->getSurveyTypeId();

      /*
       *
       */
      if(!$this->_loadDataByTid($this->tid)){
         // set default constant values values
         //debug_sql('_loadDataByTid - failed');
         $constanValuesArr = $surveyObj->getConstantDataValues();
         //debug_obj($constanValuesArr);
         foreach($constanValuesArr as $key => $values){
            $this->surveyData[$values['field_name']] = array('data' => $values['value']);
         }
      }

      #$this->_loadDataById($this->survivorId);

      //      debug_obj($surveyObj,'$surveyObj');

      define('TABLE_SDATA',$this->_TABLE_SDATA);

   }

   function getSurveyTypeId(){
      return $this->surveyTypeId;
   }

}
?>