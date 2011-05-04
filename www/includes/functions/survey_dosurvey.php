<?php
/**
 * @version $Id: survey_dosurvey.php 135 2007-11-25 04:56:26Z mimait04 $
 */

$HTML_STYLEURLS[] = array('href' => PATH_DESIGN_STYLES.'/'.SITE_CSS);
$HTML_STYLEURLS[] = array('href' => PATH_DESIGN_STYLES.'/lh.css');

if(isset($_GET['dosurvey'])) {
   $adminAction = 'dosurvey';
}elseif(isset($_GET['set'])) {
   $adminAction = 'set';
}


//debug_sql($adminAction,'$adminAction');

switch($adminAction){
   case 'dosurvey':{

      //debug_sql($_GET['dosurvey'],'dosurvey');

      if(!class_exists('SurveySession')){
         include_once(CLASSES_PATH.'/class.SurveySession.php');
      }

      if(!class_exists('Survey')){
         include_once(CLASSES_PATH.'/class.Survey.php');
      }

      if(!class_exists('SurveyOfficer')){
         include_once(CLASSES_PATH.'/class.SurveyOfficer.php');
      }

      $surveyOfficerObj = new SurveyOfficer();
      $surveySessionObj = null;//instance holder
      session_register('surveyOfficerObj');
      
      if($surveyOfficerObj->getSurveySession($_GET['dosurvey'],&$surveySessionObj)){
         
         $_SESSION['tokenID'] = $_GET['dosurvey'];

         //            define('SURVEY_ID','iso_9241_10');
         //            define('SURVEY_LANGUAGE','dei');

         if(!$surveySessionObj->getFinished()){
            define('SURVEY_ID',$surveySessionObj->getSurveyTypeId());
            define('SURVEY_LANGUAGE',$surveySessionObj->getSurveyLanguage());
            $HTML_XAJAX = $xajax->getJavascript(LIVE_SITE_URL.'/includes/xajax/');
         }else{
            define('SURVEY_ID','error');
            define('SURVEY_LANGUAGE','dei');
            $SURVEY_ERROR  = ERROR_SURVEY_ALREADY_COMPLETE;
         }

         $_SESSION['surveySessionObj'] = $surveySessionObj;

      }else{
         //            $_SESSION['tokenID'] = '';
         unset($_SESSION['tokenID']);
         unset($_SESSION['surveySessionObj']);

         define('SURVEY_ID','error');
         define('SURVEY_LANGUAGE','dei');
         $SURVEY_ERROR  = 'Error:'.$surveyOfficerObj->getLastError();
         //            debug_sql('Error:'.$surveyOfficerObj->getLastError());
         //            die();
      }

      //debug_obj($surveySessionObj);

      if ($surveySessionObj!=null){
         $smarty->assign('SURVEY_DATA',$surveySessionObj->getSurveyData());
      }

   }
   case 'set':{
      /**
       * INFO Debug setter - uncomment
       */
      //         debug_obj($_GET['set'],'$_GET[set]');
      //         $setKeys = array_keys($_GET['set']);
      //         $surveySessionObj->setValue($setKeys[0],$_GET['set'][$setKeys[0]]);
   }
   default:
      break;
}

//debug_obj($surveySessionObj,'$surveySessionObj');

if(!defined('SURVEY_ID')){
   die('Error:SURVEY_ID - is not defined');
}

include_once(PATH_SURVEYS.SURVEY_ID.'/survey.php');
//debug_obj($SURVEY_ERROR,'$SURVEY_ERROR');
//debug_obj($SURVEY_STRINGS,'$SURVEY_STRINGS');

if (defined($SURVEY_ERROR)){
   $SURVEY_STRINGS['SURVEY_ERROR'] = constant($SURVEY_ERROR);
}

$smarty->assign('STRINGS',$SURVEY_STRINGS);
?>