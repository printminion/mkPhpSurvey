<?php

if(!class_exists('SurveyOfficer')){
   include_once(CLASSES_PATH.'/class.SurveyOfficer.php');
}
if(!class_exists('Survey')){
   include_once(CLASSES_PATH.'/class.Survey.php');
}

$TPL_STRINGS['FORMS_ACTION_URL']           = LIVE_SITE_URL.'/admin/';
$TPL_STRINGS['CAPTION_MYSURVEYS']          = TPL_ADMIN_CAPTION_MYSURVEYS;
$TPL_STRINGS['CAPTION_MYSURVEYS_RUNNING']  = TPL_ADMIN_CAPTION_MYSURVEYS_RUNNING;
$TPL_STRINGS['CAPTION_MYSURVEYS_FINISHED'] = TPL_ADMIN_CAPTION_MYSURVEYS_FINISHED;


$TPL_STRINGS['CAPTION_BUTTON_ADD_SURVEY'] = TPL_ADMIN_CAPTION_BUTTON_ADD_SURVEY;

$TPL_STRINGS['CAPTION_SORT_SURVEYS']             = TPL_ADMIN_CAPTION_SORT_SURVEYS;
$TPL_STRINGS['CAPTION_SORT_SURVEYS_BY']          = TPL_ADMIN_CAPTION_SORT_SURVEYS_BY;
$TPL_STRINGS['CAPTION_SORT_SURVEYS_BY_DATE']     = TPL_ADMIN_CAPTION_SORT_SURVEYS_BY_DATE;
$TPL_STRINGS['CAPTION_SORT_SURVEYS_BY_CREATION'] = TPL_ADMIN_CAPTION_SORT_SURVEYS_BY_CREATION;


$TPL_STRINGS['CAPTION_SORT_SURVEYS_BY_DATE_HREF']     = '';
$TPL_STRINGS['CAPTION_SORT_SURVEYS_BY_CREATION_HREF'] = "javascript:_d('sortSurvey', 'creation');";



$TPL_STRINGS['CAPTION_MYSURVEYS_RUNNING_URL']  = TPL_ADMIN_CAPTION_MYSURVEYS_RUNNING_URL;
$TPL_STRINGS['CAPTION_MYSURVEYS_FINISHED_URL'] = TPL_ADMIN_CAPTION_MYSURVEYS_FINISHED_URL;


$TPL_STRINGS['CAPTION_BUTTON_ADD_SURVIVORS']       = TPL_ADMIN_CAPTION_BUTTON_ADD_SURVIVORS;
$TPL_STRINGS['CAPTION_BUTTON_ADD_SURVIVORS_TITLE'] = TPL_ADMIN_CAPTION_BUTTON_ADD_SURVIVORS_TITLE;

$TPL_STRINGS['BOXES']['INFOBOX'] = array('TITLE' => TPL_ADMIN_SIDEBOX_TITLE,
'BODY' => TPL_ADMIN_SIDEBOX_BODY);
$TPL_STRINGS['BOXES']['INFOBOX2'] = array('TITLE' => TPL_ADMIN_SIDEBOX_TITLE,
'BODY' => TPL_ADMIN_SIDEBOX_BODY);


if(isset($_GET['finished'])){

}

if(isset($_GET['running'])){

}

if(!isset($_GET['running'])&&!isset($_GET['finished'])){
}

##################################################################################################
#
/**
 * Use-Case Create Survey
 */
if(isset($_GET['createSurvey'])){
   //TODO Check values ad query

   //   debug_obj($oLogger,'$oLogger');
   if(!$oLogger->IsAdmin()){
      die('ERROR:You are not admin');
   }

   if(!class_exists('SurveyOfficer')){
      include_once(CLASSES_PATH.'/class.SurveyOfficer.php');
   }
   
   if(!class_exists('Survey')){
      include_once(CLASSES_PATH.'/class.Survey.php');
   }

   $surveyObj = new Survey();
   $surveyOfficerObj = new SurveyOfficer();
   
   if(!$surveyOfficerObj->createSurvey($oLogger, &$surveyObj, $_POST)){
      $oLogger->relocate(LIVE_SITE."/admin/?msg=".$surveyOfficerObj->getLastError());
      die('DIE: Error while making query');
   }else{
      $oLogger->relocate(LIVE_SITE."/admin/?addsurvivors&sid=".$surveyObj->getSurveyId());
   }

   die('createSurvey - finished');
}
#
##################################################################################################

##################################################################################################
#
/**
 * Add survivors to survey
 */
if(isset($_GET['addSurvivors']) && $_POST['sid'] != ''){
   //   debug_obj($oLogger,'$oLogger');
   if(!$oLogger->IsAdmin()){
      die('ERROR:You are not admin');
   }

   if(!class_exists('SurveyOfficer')){
      include_once(CLASSES_PATH.'/class.SurveyOfficer.php');
   }
    
   $surveyOfficerObj = new SurveyOfficer();
    
   $emailsArr = explode("\n",$_POST['emails']);
   
   
//   debug_obj($oLogger);
//   debug_obj($emailsArr);
//   debug_sql($_POST['sid'],'sid');
//   debug_obj($surveyOfficerObj);
   
   if(!$surveyOfficerObj->addSurvivors($oLogger,$_POST['sid'],$emailsArr)){
      //die('addSurvivors1');
      $oLogger->relocate(LIVE_SITE."/admin/?msg=".$surveyOfficerObj->getLastError());
      die('DIE: Error while making query');
   }else{
      //die('addSurvivors2');
      $oLogger->relocate(LIVE_SITE.'/admin/');
   }
   die('try');
}
#
##################################################################################################

?>