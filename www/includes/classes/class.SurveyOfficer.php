<?php
/**
 * @version $Id:$
 * @package mkSurvey
 */
include_once(CLASSES_PATH."/class.ObjectLogger.php");
/**
 * Enter description here...
 * @version $Id:$
 */
class SurveyOfficer extends ObjectLogger{
   /**
    * Last error holder
    *
    * @var string
    */
   //var $_lastError;

   function SurveyOfficer(){

   }

   /**
    * Get Available survey types
    *
    * @return array
    */
   function getSurveyTypes(){
      global $database;

      $sqlQuery = "SELECT survey_type_id,
							    name
						FROM ".DB_PREFIX."survey_types";


      $sqlQueryResult = $database->openConnectionWithReturn($sqlQuery);
       
      while($result = mysql_fetch_array($sqlQueryResult)){

         $surveyTypesArr[$result['survey_type_id']] = array('VALUE'   => $result['survey_type_id'],
         'CAPTION' => $result['name']
         );
         //         $this->description = $result['description'];
         //         $this->languages    = $result['languages'];
      }

      return $surveyTypesArr;

   }


   /**
    * Create new Survey
    *
    * @param Logger $oLogger
    * @param Survey $surveyObj
    * @param array $_POST
    * @return bool
    */
   function createSurvey($oLogger,&$surveyObj, $_POST){
      global $database;
      $this->_lastError = null;
      if ($oLogger == null){
         $this->_lastError = ERROR_REQUIRED_LOGGEROBJ_IS_NULL;
         return false;
      }
       
      if ($surveyObj == null){
         $this->_lastError = ERROR_REQUIRED_SURVEYOBJ_IS_NULL;
         return false;
      }

      if (count($_POST) == 0){
         $this->_lastError = ERROR_REQUIRED_INPUT_IS_NULL;
         return false;
      }

      //      if(!class_exists('Survey')){
      //         include_once(CLASSES_PATH.'/class.Survey.php');
      //      }

      //   debug_obj($_GET,'$_GET');
      //   debug_obj($_POST,'$_POST');
      //   debug_obj($surveyObj,'$surveyObj');


      $_POST['template']    = strip_tags($_POST['template']);
      $_POST['title']       = strip_tags($_POST['title']);
      $_POST['description'] = strip_tags($_POST['description']);

      //   #######################################################################################
      //   # Chceck Constant values
      //   $surveyConstansArr = null; //survex constants datta array
      //   if(!$surveyOfficerObj->getSurveyConstants($inputArr['template'],$surveyConstansArr)){
      //      return $objResponse;
      //   }
      //
      //   //print_r($inputArr['Id']);
      //   $languageFile = ABSOLUTE_PATH.'/surveys/'.$_POST['template'].'/language/'.SITE_LANG.'/survey_constants.php';
      //
      //   if (file_exists($languageFile)){
      //      include_once($languageFile);
      //   }else{
      //      #ERROR TODO: Add error while file not exists
      //   }
      //
      //   if ($_POST['title'] == ''){
      //      $errorsArr[] = ' * '.SURVEY_TITLE;
      //   }
      //
      //   $surveySessionObj = new SurveySession();
      //
      //   foreach((array)$surveyConstansArr as $surveyConstant){
      //      $captionConstant = $surveyConstant['survey_type_id'].'_'.$surveyConstant['field_name'];
      //
      //      if (defined($captionConstant)){
      //         $caption = constant($captionConstant);
      //      }else{
      //         $caption = $captionConstant;
      //      }
      //
      //      $responseArr[$surveyConstant['field_name']] = array(
      //												      'uc_type_id' => $surveyConstant['uc_type_id'],
      //												      'required'   => $surveyConstant['required'],
      //												      'static'     => $surveyConstant['static'],
      //												      'validate'   => $surveyConstant['validate'],
      //                                                      'caption'    => $caption
      //      );
      //
      //      if ($surveyConstant['required'] == 1 && $_POST[$surveyConstant['field_name']] == ''){
      //         $errorsArr[] = ' * '.$caption;
      //      }
      //
      //      $_POST[$surveyConstant['field_name']] = strip_tags($_POST[$surveyConstant['field_name']]);
      //      /*
      //       * TODO: Validate length of data
      //       */
      //
      //   }
      //   #
      //   #######################################################################################





      /*
       * validate request data
       */
      if($_POST['template'] == ''){
         //$oLogger->relocate(LIVE_SITE."/admin/?msg="._FAILED_TO_ADD_SURVEY_REQUIRED_VALUE_IS_NULL1);
         //die('DIE: _FAILED_TO_ADD_SURVEY_REQUIRED_VALUE_IS_NULL');
         $this->_addError(_FAILED_TO_ADD_SURVEY_REQUIRED_VALUE_IS_NULL1);
         return false;
      }
      if($_POST['title'] == ''){
         //$oLogger->relocate(LIVE_SITE."/admin/?msg="._FAILED_TO_ADD_SURVEY_REQUIRED_VALUE_IS_NULL2);
         ///die('DIE: _FAILED_TO_ADD_SURVEY_REQUIRED_VALUE_IS_NULL');
         $this->_addError(_FAILED_TO_ADD_SURVEY_REQUIRED_VALUE_IS_NULL2);
         return false;

      }
      if(!$oLogger->getUserId()){
         //$oLogger->relocate(LIVE_SITE."/admin/?msg="._FAILED_TO_ADD_SURVEY_REQUIRED_VALUE_IS_NULL3);
         //die('DIE: _FAILED_TO_ADD_SURVEY_REQUIRED_VALUE_IS_NULL');
         $this->_addError(_FAILED_TO_ADD_SURVEY_REQUIRED_VALUE_IS_NULL3);
         return false;

      }

      /*
       * Set Date to Survey object
       */
      $surveyObj->setSurveyTypeId($_POST['template']);//required
      $surveyObj->setTitle($_POST['title']);//required
      $surveyObj->setDescription($_POST['description']);
      $surveyObj->setDateCreated($database->getNowMySqlDateTime());//required
      $surveyObj->setUserId($oLogger->getUserId());//required

      //   debug_obj($surveyObj,'$surveyObj');

      #################################################################
      # create SurveyDataTable
      if(!class_exists('SurveyStructure')){
         include_once(CLASSES_PATH.'/class.SurveyStructure.php');
      }
      //      debug_obj($surveyObj,'$surveyObj');
      $surveyStructureObj = new SurveyStructure();
      $sqlQuery = $surveyStructureObj->getCreateQueryBySurveyType($surveyObj->getSurveyTypeId());

      if ($sqlQuery!=''){
         $database->openConnectionNoReturn($sqlQuery);
         //         $this->_lastError = ERROR_FAILED_TO_CREATE_DATATABLE;
         //         return false;
      }

      //      debug_obj($sqlQuery,'$sqlQuery');
      //      debug_obj($surveyStructureObj,'$surveyStructureObj');
      //      die();
      #
      #################################################################


      if(!$surveyObj->_insert()){
         //         $oLogger->relocate(LIVE_SITE."/admin/?msg="._FAILED_TO_ADD_SURVEY);
         //die('DIE: Error while making query');
         $this->_addError(_FAILED_TO_ADD_SURVEY_DATABASE_ERROR_ONINSERT);
         return false;
      }else{
         //         $oLogger->relocate(LIVE_SITE."/admin/?addsurvivors&sid=".$surveyObj->getSurveyId());
         return true;
      }
      return true;
   }

   /**
    * Create new Survey
    *
    * @param Logger $oLogger
    * @param Survey $surveyObj
    * @param array $_POST
    * @return bool
    */
   function updateSurvey($oLogger,&$surveyObj, $_POST){
      global $database;
      $this->_lastError = null;
      if ($oLogger == null){
         $this->_lastError = ERROR_REQUIRED_LOGGEROBJ_IS_NULL;
         return false;
      }
       
      if ($surveyObj == null){
         $this->_lastError = ERROR_REQUIRED_SURVEYOBJ_IS_NULL;
         return false;
      }

      if (count($_POST) == 0){
         $this->_lastError = ERROR_REQUIRED_INPUT_IS_NULL;
         return false;
      }

      //      if(!class_exists('Survey')){
      //         include_once(CLASSES_PATH.'/class.Survey.php');
      //      }

      //   debug_obj($_GET,'$_GET');
      //   debug_obj($_POST,'$_POST');
      //   debug_obj($surveyObj,'$surveyObj');


      $_POST['template']    = strip_tags($_POST['template']);
      $_POST['title']       = strip_tags($_POST['title']);
      $_POST['description'] = strip_tags($_POST['description']);

      //   #######################################################################################
      //   # Chceck Constant values
      //   $surveyConstansArr = null; //survex constants datta array
      //   if(!$surveyOfficerObj->getSurveyConstants($inputArr['template'],$surveyConstansArr)){
      //      return $objResponse;
      //   }
      //
      //   //print_r($inputArr['Id']);
      //   $languageFile = ABSOLUTE_PATH.'/surveys/'.$_POST['template'].'/language/'.SITE_LANG.'/survey_constants.php';
      //
      //   if (file_exists($languageFile)){
      //      include_once($languageFile);
      //   }else{
      //      #ERROR TODO: Add error while file not exists
      //   }
      //
      //   if ($_POST['title'] == ''){
      //      $errorsArr[] = ' * '.SURVEY_TITLE;
      //   }
      //
      //   $surveySessionObj = new SurveySession();
      //
      //   foreach((array)$surveyConstansArr as $surveyConstant){
      //      $captionConstant = $surveyConstant['survey_type_id'].'_'.$surveyConstant['field_name'];
      //
      //      if (defined($captionConstant)){
      //         $caption = constant($captionConstant);
      //      }else{
      //         $caption = $captionConstant;
      //      }
      //
      //      $responseArr[$surveyConstant['field_name']] = array(
      //												      'uc_type_id' => $surveyConstant['uc_type_id'],
      //												      'required'   => $surveyConstant['required'],
      //												      'static'     => $surveyConstant['static'],
      //												      'validate'   => $surveyConstant['validate'],
      //                                                      'caption'    => $caption
      //      );
      //
      //      if ($surveyConstant['required'] == 1 && $_POST[$surveyConstant['field_name']] == ''){
      //         $errorsArr[] = ' * '.$caption;
      //      }
      //
      //      $_POST[$surveyConstant['field_name']] = strip_tags($_POST[$surveyConstant['field_name']]);
      //      /*
      //       * TODO: Validate length of data
      //       */
      //
      //   }
      //   #
      //   #######################################################################################





      /*
       * validate request data
       */
      if($_POST['template'] == ''){
         //$oLogger->relocate(LIVE_SITE."/admin/?msg="._FAILED_TO_ADD_SURVEY_REQUIRED_VALUE_IS_NULL1);
         //die('DIE: _FAILED_TO_ADD_SURVEY_REQUIRED_VALUE_IS_NULL');
         $this->_addError(_FAILED_TO_ADD_SURVEY_REQUIRED_VALUE_IS_NULL1);
         return false;
      }
      if($_POST['title'] == ''){
         //$oLogger->relocate(LIVE_SITE."/admin/?msg="._FAILED_TO_ADD_SURVEY_REQUIRED_VALUE_IS_NULL2);
         ///die('DIE: _FAILED_TO_ADD_SURVEY_REQUIRED_VALUE_IS_NULL');
         $this->_addError(_FAILED_TO_ADD_SURVEY_REQUIRED_VALUE_IS_NULL2);
         return false;

      }
      if(!$oLogger->getUserId()){
         //$oLogger->relocate(LIVE_SITE."/admin/?msg="._FAILED_TO_ADD_SURVEY_REQUIRED_VALUE_IS_NULL3);
         //die('DIE: _FAILED_TO_ADD_SURVEY_REQUIRED_VALUE_IS_NULL');
         $this->_addError(_FAILED_TO_ADD_SURVEY_REQUIRED_VALUE_IS_NULL3);
         return false;

      }

      /*
       * Set Date to Survey object
       */
      $surveyObj->setSurveyTypeId($_POST['template']);//required
      $surveyObj->setTitle($_POST['title']);//required
      $surveyObj->setDescription($_POST['description']);
      $surveyObj->setDateCreated($database->getNowMySqlDateTime());//required
      $surveyObj->setUserId($oLogger->getUserId());//required

      //   debug_obj($surveyObj,'$surveyObj');

      #################################################################
      # create SurveyDataTable
      if(!class_exists('SurveyStructure')){
         include_once(CLASSES_PATH.'/class.SurveyStructure.php');
      }
      //      debug_obj($surveyObj,'$surveyObj');
      $surveyStructureObj = new SurveyStructure();
      $sqlQuery = $surveyStructureObj->getCreateQueryBySurveyType($surveyObj->getSurveyTypeId());

      if ($sqlQuery!=''){
         $database->openConnectionNoReturn($sqlQuery);
         //         $this->_lastError = ERROR_FAILED_TO_CREATE_DATATABLE;
         //         return false;
      }

      //      debug_obj($sqlQuery,'$sqlQuery');
      //      debug_obj($surveyStructureObj,'$surveyStructureObj');
      //      die();
      #
      #################################################################


      if(!$surveyObj->_update($surveyObj->getSurveyId())){
         //         $oLogger->relocate(LIVE_SITE."/admin/?msg="._FAILED_TO_ADD_SURVEY);
         //die('DIE: Error while making query');
         $this->_addError(_FAILED_TO_ADD_SURVEY_DATABASE_ERROR_ONINSERT);
         return false;
      }else{
         //         $oLogger->relocate(LIVE_SITE."/admin/?addsurvivors&sid=".$surveyObj->getSurveyId());
         return true;
      }
      return true;
   }

   /**
    * Add survivor to Survey
    *
    * @param Logger $oLogger
    * @param long $surveyId
    * @param array $survivorsArr
    * @return bool
    */
   function addSurvivors($oLogger,$surveyId,$survivorsArr){
      global $database;
      $this->_lastError = null;
      //debug_sql("addSurvivors(\$oLogger,$surveyId,\$survivorsArr)");

      if ($oLogger == null){
         $this->_lastError = ERROR_REQUIRED_LOGGEROBJ_IS_NULL;
         return false;
      }

      if ($surveyId == ''){
         $this->_lastError = ERROR_REQUIRED_SURVEYID_IS_NULL;
         return false;
      }

      if (count($survivorsArr) == 0){
         $this->_lastError = ERROR_REQUIRED_SURVIVORSEMAILS_IS_NULL;
         return false;
      }

      if(!class_exists('Survey')){
         include_once(CLASSES_PATH.'/class.Survey.php');
      }

      $surveyObj = new Survey($surveyId);

      if ($surveyObj->getSurveyId() != $surveyId){
         $this->_lastError = ERROR_FAILED_TO_FIND_SURVEY_BY_ID;
         return false;
      }

      if(!class_exists('Survivor')){
         include_once(CLASSES_PATH.'/class.Survivor.php');
      }

      if(!class_exists('ComposeMail')){
         include_once(CLASSES_PATH.'/class.ComposeMail.php');
      }

      //      debug_obj($survivorsArr);

      ########################################
      #Build survey info
      $this->getSurveyConstants($surveyObj->getSurveyTypeId(),&$surveyConstants);
      $surveyConstantsData = $surveyObj->getConstantDataValues();

      foreach((array)$surveyConstantsData as $key => $value){
         if ($value['value'] != ''){
            $surveyInfo .= $surveyConstants[$key]['caption'].': '.$value['value']."\n";
            $surveyInfoHtml .= '<b>'.$surveyConstants[$key]['caption'].':</b> '.$value['value']."\n";
         }
      }
      #
      ########################################
       
      //TODO add survivor
      foreach($survivorsArr as $email){
         $email = trim($email);

         //TODO validate @
         if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)) {
            #debug_sql($email,'adding survivor');
            //            debug_obj($email,'wrong email');
            continue;
         }


         $survivorObj = new Survivor();

         //debug_sql($survivorObj->ifSurvivorExist($surveyId,$email),"ifSurvivorExist($surveyId,$email)");

         if($survivorObj->ifSurvivorExist($surveyId,$email)){
            //debug_sql('survivor exist');
            continue;
         }

         $survivorObj->setSurveyId($surveyId);
         $survivorObj->setSurvivorEmail($email);
         $survivorObj->setTid(md5($survivorObj->getSurveyId().":".$survivorObj->getSurvivorEmail()));
          
         if($survivorObj->_insert()){
            //debug_obj($survivorObj,'$survivorObj');
         }else{
            //die('ERROR:'.$database->getLastError());
            //return false;
         }

         //debug_obj($survivorObj,'$survivorObj');
         #######################################
         #

         $mailerObj = new ComposeMail($email,'Umfrage:'.$surveyObj->getTitle());
         $composeMailObj->emailEncoding = 'UTF-8';
         $mailerObj->sh_fromName(PRODUCT_NAME.' '.APP_VERSION);
         $mailerObj->sh_fromAddr(LIVE_SITE_ADMIN_EMAIL);
         $surveyUrl = LIVE_SITE_URL.'/survey?dosurvey='.$survivorObj->getTid();


         $TPL_EMAIL_NEW_SURVIVOR_SUBJECT = TPL_EMAIL_NEW_SURVIVOR_SUBJECT;
         $TPL_EMAIL_NEW_SURVIVOR_SUBJECT = str_replace('%SURVEY_TITLE%',$surveyObj->getTitle(),$TPL_EMAIL_NEW_SURVIVOR_SUBJECT);

         # make email body - plain part
         $TPL_EMAIL_NEW_SURVIVOR_BODY = TPL_EMAIL_NEW_SURVIVOR_BODY;
         $TPL_EMAIL_NEW_SURVIVOR_BODY = str_replace('%SURVEY_URL%',$surveyUrl,$TPL_EMAIL_NEW_SURVIVOR_BODY);
         $TPL_EMAIL_NEW_SURVIVOR_BODY = str_replace('%SURVEY_TITLE%',$surveyObj->getTitle(),$TPL_EMAIL_NEW_SURVIVOR_BODY);
         $TPL_EMAIL_NEW_SURVIVOR_BODY = str_replace('%SURVEY_INFO%',$surveyInfo,$TPL_EMAIL_NEW_SURVIVOR_BODY);

         # make email body - html part
         $TPL_EMAIL_NEW_SURVIVOR_BODY_HTML = TPL_EMAIL_NEW_SURVIVOR_BODY_HTML;
         $TPL_EMAIL_NEW_SURVIVOR_BODY_HTML = str_replace('%SURVEY_URL%',$surveyUrl,$TPL_EMAIL_NEW_SURVIVOR_BODY_HTML);
         $TPL_EMAIL_NEW_SURVIVOR_BODY_HTML = str_replace('%SURVEY_TITLE%',$surveyObj->getTitle(),$TPL_EMAIL_NEW_SURVIVOR_BODY_HTML);
         $TPL_EMAIL_NEW_SURVIVOR_BODY_HTML = str_replace('%SURVEY_INFO%',nl2br($surveyInfoHtml),$TPL_EMAIL_NEW_SURVIVOR_BODY_HTML);

         $mailerObj->addTextPlainBodyPart($TPL_EMAIL_NEW_SURVIVOR_BODY);
         $mailerObj->addHTMLBodyPart($TPL_EMAIL_NEW_SURVIVOR_BODY_HTML);

         //         debug_sql("$email<br><b>Das ist eine Einladung zur Survey</b><br><a href='$surveyUrl' target=_blank>$surveyUrl</a>");

         //         debug_obj($TPL_EMAIL_NEW_SURVIVOR_BODY_HTML,$TPL_EMAIL_NEW_SURVIVOR_SUBJECT,true);
         //         debug_obj($surveyObj);
         //         debug_obj($surveyConstantsData,'$surveyConstantsData');
         //         debug_obj($surveyConstants,'$surveyConstants');
         //         debug_obj($surveyConstants,'$surveyConstants');

         //die('die');
         //         TODO entcomment next line
         $mailerObj->BuildAndSendMessage();
         $survivorObj->setEmailSent(true);
         $survivorObj->_update($survivorObj->getSurvivorId());

         #
         #######################################

      }


      //      die('addSurvivors - finished');
      return true;
   }

   /**
    * get Survey Session object by token
    *
    * @param string $tokenID
    * @param SurveySession $surveySessionObj
    * @return bool
    */
   function getSurveySession($tokenID,&$surveySessionObj){
      //      debug_sql("getSurveySession($tokenID,&surveySessionObj)");

      $this->$tokenID = null;
      if ($tokenID == null){
         $this->_lastError = ERROR_REQUIRED_TOKENID_IS_NULL;
         return false;
      }

      $surveySessionObj = new SurveySession($tokenID);
       
      //debug_obj($surveySessionObj);
       
      if($surveySessionObj){
         if ($surveySessionObj->getSurveyId() != null){
            return true;
         }
      }

      $this->_lastError = ERROR_LOAD_SURVEY_SESSION;

      return false;
   }

   /**
    * get Survey Constants
    *
    * @param string $surveyID
    * @param array $surveyConstansArr
    * @return bool
    */
   function getSurveyConstants($surveyID,&$surveyConstansArr){
      global $database;
      $surveyConstansArr = null;

      if ($surveyID == null){
         //$this->_lastError = ERROR_REQUIRED_TOKENID_IS_NULL;
         $this->_addError(ERROR_REQUIRED_SURVEYID_IS_NULL);
         return false;
      }

      $sqlQuery = "SELECT *
					 FROM ".DB_PREFIX."survey_structure
					WHERE survey_type_id = '$surveyID'
					  AND static = 1
				 ORDER BY ".DB_PREFIX."survey_structure.order ASC";

      //debug_sql($sqlQuery);
      //echo $sqlQuery;

      $resultRes = $database->openConnectionWithReturn($sqlQuery);


      ##########################################
      # include language file
      //print_r($inputArr['Id']);
      $languageFile = ABSOLUTE_PATH.'/surveys/'.$surveyID.'/language/'.SITE_LANG.'/survey_constants.php';

      if (file_exists($languageFile)){
         include_once($languageFile);
      }else{
         #ERROR TODO: Add error while file not exists
      }
      #
      ###########################################

      while($result = mysql_fetch_array($resultRes)){
         //get captions fot Survey constants
         $captionConstant = $result['survey_type_id'].'_'.$result['field_name'];

         if (defined($captionConstant)){
            $caption = constant($captionConstant);
         }else{
            $caption = $captionConstant;
         }


         //$surveyConstansArr[$result['id']] = array(
         $surveyConstansArr[$result['field_name']] = array(
         'id'               => $result['id'],
         'survey_type_id'	=> $result['survey_type_id'],
         'field_name'       => $result['field_name'],
         'uc_type_id'       => $result['uc_type_id'],
         'required'         => $result['required'],
         'page'             => $result['page'],
         'order'            => $result['order'],
         'validate'         => $result['validate'],
         'caption' 			=> $caption
         );
      }

      return true;
   }

   /**
    * get Survey Report
    *
    * @param long $surveyID
    * @param SurveyReport $surveyReportObj
    * @return bool
    */
   function getSurveyReport($surveyID,&$surveyReportObj){
      //      debug_sql("getSurveyReport($surveyID,&surveySessionObj)");

      //      $this->$tokenID = null;
      if ($surveyID == null){
         $this->_lastError = ERROR_REQUIRED_SURVEYID_IS_NULL;
         return false;
      }

      $surveyReportObj = new SurveyReport($surveyID);

      if($surveyReportObj){
         if ($surveyReportObj->getSurveyId() != null){
            return true;
         }
      }

      $this->_lastError = ERROR_LOAD_SURVEY_REPORT;

      return false;
   }

   /**
    * Get Survey by UserId
    *
    * @param long $userId
    * @param string $type
    * @param string $sortBy
    * @return bool
    */
   function getSurveysByUserId($userId,$type = 'all',$sortBy = 'dateUp'){
      global $database;
      $this->_lastError = null;
      if ($userId == null){
         $this->_lastError = ERROR_REQUIRED_USERID_IS_NULL;
         return false;
      }

      switch($type){
         case 'finished':
            $sqlAnd = ' AND s.finished = 1 ';
            break;
         case 'running':
            $sqlAnd = ' AND s.finished = 0 ';
            break;
         default:

            break;
      }

      switch($sortBy){
         case 'dateUp':
            //$sqlSortBy = ' ORDER BY `s`.`date_created` DESC ';
            $sqlSortBy = ' ORDER BY `s`.`survey_id` DESC ';
            break;
         case 'dateDown':
            //$sqlSortBy = ' ORDER BY `s`.`date_created` ASC ';
            $sqlSortBy = ' ORDER BY `s`.`survey_id` ASC ';
            break;
         default:
            //$sqlSortBy = ' ORDER BY `s`.`date_created` DESC ';
            $sqlSortBy = ' ORDER BY `s`.`survey_id` DESC ';
            break;
      }

      $sqlQuery = "SELECT s.*,
						  mt.name
					 FROM ".DB_PREFIX."surveys s, ".DB_PREFIX."survey_types mt
					WHERE user_id = $userId
                      AND s.survey_type_id = mt.survey_type_id
                      ".
      $sqlAnd. ' '.
      $sqlSortBy;

      //debug_sql($sqlQuery);

      $resultRes = $database->openConnectionWithReturn($sqlQuery);

      while($result = mysql_fetch_array($resultRes)){
         $surveysArr[$result['survey_id']] = array(
         'survey_id'                => $result['survey_id'],
         'survey_type_id'           => $result['survey_type_id'],
         'survey_type_title'        => $result['name'],

         'title' 	                => $result['title'],
         'description' 	            => $result['description'],
         'date_created'             => $result['date_created'],
         'date_created_short'       => $result['date_created'],
         'finished' 				=> $result['finished'],
         'survivors_count' 		    => $this->getSurvivorsBySurveyId($result['survey_id']),
         'survivors_finished_count' => $this->getSurvivorsDoneBySurveyId($result['survey_id'],$result['survey_type_id']),
         'href_survey_report'       => LIVE_SITE.'/admin/?surveyReport&sid='.$result['survey_id']
         );
      }

      return $surveysArr;

   }

   /**
    * Gets Survivors count for Survey by survey ID
    *
    * @param int $surveyId
    * @return int
    */
   function getSurvivorsBySurveyId($surveyId){
      global $database;
      $this->_lastError = null;
      if ($surveyId == null){
         $this->_lastError = ERROR_REQUIRED_SURVEYID_IS_NULL;
         return false;
      }

      $sqlQuery = "SELECT count(s.survivor_id) as survivors_count
 					 FROM ".DB_PREFIX."survey_survivors s
				    WHERE survey_id = $surveyId";

      //      debug_sql($sqlQuery);

      $resultRes = $database->openConnectionWithReturn($sqlQuery);

      if($result = mysql_fetch_array($resultRes)){
         return $result['survivors_count'];
      }

      return false;
   }

   /**
    * Gets Survivors count wich has been done with Survey by survey ID
    *
    * @param int $surveyId
    * @param string $surveyId
    * @return int
    */
   function getSurvivorsDoneBySurveyId($surveyId,$surveyTypeId){
      global $database;
      $this->_lastError = null;
      if ($surveyId == null){
         $this->_lastError = ERROR_REQUIRED_SURVEYID_IS_NULL;
         return false;
      }
      if ($surveyTypeId == null){
         $this->_lastError = ERROR_REQUIRED_SURVEYTYPEID_IS_NULL;
         return false;
      }

      $sqlQuery = "SELECT count(s.survey_id) as survivors_count
 					 FROM ".DB_PREFIX."survey_survivors s, ".DB_PREFIX."sdata_$surveyTypeId d
				    WHERE s.survey_id = $surveyId
      				  AND d.finished = 1
      				  AND s.tid = d.tid";

      //      debug_sql($sqlQuery);

      $resultRes = $database->openConnectionWithReturn($sqlQuery);

      if($result = mysql_fetch_array($resultRes)){
         return $result['survivors_count'];
      }

      return false;
   }


   /**
    * remove survey
    *
    * @param long $surveyId
    * @return bool
    */
   function deleteSurveyById($surveyId){
      global $database;
      $this->_lastError = null;

      if ($surveyId == null){
         $this->_lastError = ERROR_REQUIRED_SURVEYID_IS_NULL;
         return false;
      }

      $surveyObj = new Survey($surveyId);

      if ($surveyObj->getSurveyId() == $surveyId){

         ###########################################
         #drop survey config data
         //         $sqlQuery = "DELETE FROM `".DB_PREFIX."sdata_".$surveyObj->getSurveyTypeId()."`
         //         			   WHERE tid  =".$surveyObj->getSurveyId();
         //
         //         $database->openConnectionNoReturn($sqlQuery);

         ###########################################
         #drop survivors data
         $sqlQuery = "DELETE FROM `".DB_PREFIX."sdata_".$surveyObj->getSurveyTypeId()."`
         			   WHERE tid IN (
					  				SELECT `tid` 
									  FROM `".DB_PREFIX."survey_survivors` 
									 WHERE `survey_id` =".$surveyObj->getSurveyId()."
					  				)";				 

         $database->openConnectionNoReturn($sqlQuery);

         ###########################################
         #drop survivors
         $sqlQuery = "DELETE FROM `".DB_PREFIX."survey_survivors`
					   WHERE `survey_id` =".$surveyObj->getSurveyId();				 

         $database->openConnectionNoReturn($sqlQuery);

         ###########################################
         #drop survey
         $surveyObj->_delete($surveyObj->getSurveyId());

         #
         ###########################################



         return true;
      }else{
         return false;
      }

      return true;
   }

   /**
    * get Survey Id by token
    *
    * @param string $token
    * @return long
    */
   function getSurveyIdByToken($token){
      global $database;
      $this->_lastError = null;

      if ($token == null){
         $this->_lastError = ERROR_REQUIRED_TOKEN_IS_NULL;
         return false;
      }

       $sqlQuery = "SELECT survey_id
 					 FROM ".DB_PREFIX."surveys
				    WHERE `token` LIKE '$token'";

      //      debug_sql($sqlQuery);

      $resultRes = $database->openConnectionWithReturn($sqlQuery);

      if($result = mysql_fetch_array($resultRes)){
         return $result['survey_id'];
      }
      
      return false;
   }
}
?>