<?php
/**
 * @version $Id: survey_doadmin.php 155 2008-01-13 20:01:44Z mimait04 $
 */

include_once(LANGUAGE_PATH.'/lang_admin.php');
include_once(ABSOLUTE_PATH.'/includes/functions/doadmin.php');
$HTML_XAJAX = $xajax->getJavascript(LIVE_SITE_URL.'/includes/xajax/');
//      debug_obj($TPL_STRINGS,'$TPL_STRINGS');

//      debug_sql('DOING:doadmin');
//      debug_obj($oLogger,'$oLogger');
//      debug_obj($_GET,'$_GET');
##########################
# map language variables
$TPL_STRINGS['TPL_LOGO_URL_ALT']  = 'mkSurvey Admin';
$TPL_STRINGS['TPL_LOGO_URL_HREF'] = LIVE_SITE.'/admin';//no trailing slash?
//debug_obj($TPL_STRINGS);
#
##########################

##########################
# set tamplates 
$HTML_TPL_TOPNAV   = PATH_TEMPLATES.'/admin/topnav.tpl';
$HTML_TPL_BODY     = PATH_TEMPLATES.'/admin/body.tpl';

$HTML_STYLEURLS['SITE_CSS'] = array('href' => PATH_DESIGN_STYLES.'/'.SITE_CSS);
$HTML_STYLEURLS['MAIN_CSS'] = array('href' => PATH_DESIGN_STYLES.'/lh.css');
//$HTML_STYLEURLS['PRINT_CSS'] = array('href' => PATH_DESIGN_STYLES.'/lh_print.css');
   

if(!$oLogger->IsAdmin() && !(isset($_GET['surveyReport']) || isset($_GET['surveyReportControl']))){
   $oLogger->relocate(LIVE_SITE."/?msg=_MSG_403");
   die('DIE: You are not admin');
}


if (!class_exists('SurveyOfficer')){
   require_once(CLASSES_PATH.'/class.SurveyOfficer.php');
}
$surveyOfficerObj = new SurveyOfficer();

$SELECTBOX_SURVEY_TYPES = $surveyOfficerObj->getSurveyTypes();
$smarty->assign('SELECTBOX_SURVEY_TYPES',$SELECTBOX_SURVEY_TYPES);


//$HTML_SCRIPTURLS[] = array('href' => PATH_DESIGN_STYLES.'/lh_en_US.js');

//      debug_sql(isset($_GET['settings']),'isset($_GET[settings])');


if(isset($_GET['settings'])) {
   $adminAction = 'settings';
}elseif(isset($_GET['addsurvivors'])) {
   $adminAction = 'addsurvivors';
}elseif(isset($_GET['running'])) {
   $adminAction = 'running';
}elseif(isset($_GET['finished'])) {
   $adminAction = 'finished';
}elseif(isset($_GET['surveyReport'])) {
   $adminAction = 'surveyReport';
}elseif(isset($_GET['surveyReportControl'])) {
   $adminAction = 'surveyReportControl';
}

switch($adminAction){
   case 'settings':{
      //debug_sql('admin_settings');
      $HTML_TPL_NAVBAR  = PATH_TEMPLATES.'/admin/navbar_settings.tpl';
      $HTML_TPL_LEFTBOX  = PATH_TEMPLATES.'/admin/leftbox_settings.tpl';
      #$HTML_TPL_RIGHTBOX = PATH_TEMPLATES.'/admin/rightbox.tpl';
   }
   break;
   case 'addsurvivors':{
      
      
      //INFO: Hotfix to pass &amp; value 
      if (isset($_GET['amp;sid'])){
         $_GET['sid'] = $_GET['amp;sid'];
      }
      
      if ($_GET['sid']==''){
         die('Error: Unknown SurveyId');
      }
      $surveyObj = new Survey($_GET['sid']);
      
      //debug_obj($surveyObj);
      
      
      $TPL_STRINGS['ADDSURVIVORS_SURVEY_NAME'] = $surveyObj->getTitle();
      $TPL_STRINGS['FORM_SID'] = $surveyObj->getSurveyId();
       
       
      $HTML_TPL_NAVBAR  = PATH_TEMPLATES.'/admin/navbar_addsurvivors.tpl';
      $HTML_TPL_LEFTBOX  = PATH_TEMPLATES.'/admin/leftbox_addsurvivors.tpl';
      #$HTML_TPL_RIGHTBOX = PATH_TEMPLATES.'/admin/rightbox.tpl';
   }
   break;
   case 'finished':{
      $TPL_STRINGS['DIALOG_NEWSURVEY'] = true;
      $TPL_STRINGS['ADD_SURVIVORS']    = true;
      $TPL_STRINGS['DIALOG_SURVEY']    = true;

      $SURVEYS = $surveyOfficerObj->getSurveysByUserId($oLogger->getUserId(),'finished');
      //         debug_obj($SURVEYS,'$SURVEYS');
      $TPL_STRINGS['SURVEYS'] = $SURVEYS;
      $TPL_STRINGS['CAPTION_MYSURVEYS_FINISHED_URL'] = '';

      $HTML_TPL_NAVBAR   = PATH_TEMPLATES.'/admin/navbar_surveys.tpl';
      $HTML_TPL_LEFTBOX  = PATH_TEMPLATES.'/admin/leftbox_surveys.tpl';
      $HTML_TPL_RIGHTBOX = PATH_TEMPLATES.'/admin/rightbox.tpl';
   }
   break;
   case 'running':{
      $TPL_STRINGS['DIALOG_NEWSURVEY'] = true;
      $TPL_STRINGS['ADD_SURVIVORS']    = true;
      $TPL_STRINGS['DIALOG_SURVEY']    = true;

      $SURVEYS = $surveyOfficerObj->getSurveysByUserId($oLogger->getUserId(),'running');
      //         debug_obj($SURVEYS,'$SURVEYS');
      //$STRINGS.CAPTION_SORT_SURVEYS_BY_DATE_HREF
      $TPL_STRINGS['SURVEYS'] = $SURVEYS;
      $TPL_STRINGS['CAPTION_MYSURVEYS_RUNNING_URL'] = '';


      $HTML_TPL_NAVBAR   = PATH_TEMPLATES.'/admin/navbar_surveys.tpl';
      $HTML_TPL_LEFTBOX  = PATH_TEMPLATES.'/admin/leftbox_surveys.tpl';
      $HTML_TPL_RIGHTBOX = PATH_TEMPLATES.'/admin/rightbox.tpl';
   }
   break;
   case 'finished':{
   }
   break;
   case 'surveyReport':{
      $TPL_STRINGS['DIALOG_NEWSURVEY'] = true;
      $TPL_STRINGS['ADD_SURVIVORS']    = true;
      $TPL_STRINGS['DIALOG_SURVEY']    = true;

      //         debug_sql($_GET['dosurvey'],'dosurvey');

      if(!class_exists('SurveyReport')){
         include_once(CLASSES_PATH.'/class.SurveyReport.php');
      }
       
      if(!class_exists('Survey')){
         include_once(CLASSES_PATH.'/class.Survey.php');
      }
       
      if(!class_exists('SurveyOfficer')){
         include_once(CLASSES_PATH.'/class.SurveyOfficer.php');
      }
       
      $surveyOfficerObj = new SurveyOfficer();
      $surveyReportObj  = null;
       
      //         debug_obj($_GET,'$_GET');
       
      if($surveyOfficerObj->getSurveyReport($_GET['sid'],&$surveyReportObj)){
         $_SESSION['tokenID'] = $_GET['dosurvey'];
         $_SESSION['surveyReportObj'] = $surveyReportObj;
      }else{
         //debug_sql('getSurveyReport - ko');
         //            $_SESSION['tokenID'] = '';
         unset($_SESSION['tokenID']);
         unset($_SESSION['surveyReportObj']);

         //define('SURVEY_ID','error');
         //define('SURVEY_LANGUAGE','dei');
         $SURVEY_ERROR  = 'Error:'.$surveyOfficerObj->getLastError();
         //            debug_sql('Error:'.$surveyOfficerObj->getLastError());
         //            die();
      }
       
       
       
      if ($surveyReportObj!=null){
         $SURVEY_DATA = $surveyReportObj->getSurveyData();
         $smarty->assign('SURVEY_DATA',$SURVEY_DATA);
      }
       
      //         debug_obj($surveyReportObj,'$surveyReportObj');
      //         debug_obj($SURVEY_DATA,'$SURVEY_DATA');
       
      //            $SURVEYS = $surveyOfficerObj->getSurveysByUserId($oLogger->getUserId());
      //            debug_obj($SURVEYS,'$SURVEYS');
      //            $TPL_STRINGS['SURVEYS'] = $SURVEYS;
      //            #$smarty->assign('SURVEYS',$SURVEYS);


      //TODO: Remove next two lines
      if (!defined('SURVEY_ID')||SURVEY_ID==''||SURVEY_ID=='SURVEY_ID'){
         //TODO:ERROR NOTIFICATION
         define('SURVEY_ID','iso_9241_10');
      }
      if (!defined('SURVEY_LANGUAGE')||SURVEY_LANGUAGE==''||SURVEY_LANGUAGE=='SURVEY_ID'){
         //TODO:ERROR NOTIFICATION
         define('SURVEY_LANGUAGE','dei');
      }
      
      /*
       * Show print view
       */
      if ($_GET['output'] == 'print'){      
         //$HTML_TPL_NAVBAR  = PATH_TEMPLATES.'/admin/navbar_settings.tpl';
         #$HTML_TPL_RIGHTBOX = PATH_TEMPLATES.'/admin/rightbox.tpl';
         $HTML_TPL_TOPNAV   = '';
         //$HTML_TPL_BODY     = PATH_TEMPLATES.'/admin/body.tpl';
         
         $HTML_STYLEURLS['SITE_CSS'] = '';//array('href' => PATH_DESIGN_STYLES.'/'.SITE_CSS);
         $HTML_STYLEURLS['MAIN_CSS'] = array('href' => PATH_DESIGN_STYLES.'/lh_print.css');
         $HTML_STYLEURLS['PRINT_CSS'] = array('href' => PATH_DESIGN_STYLES.'/lh_print.css');

         include_once(PATH_SURVEYS.SURVEY_ID.'/survey_report.php');
      }else{
         $HTML_TPL_NAVBAR  = PATH_TEMPLATES.'/admin/navbar_settings.tpl';
         #$HTML_TPL_RIGHTBOX = PATH_TEMPLATES.'/admin/rightbox.tpl';

         include_once(PATH_SURVEYS.SURVEY_ID.'/survey_report.php');
      }


      if (defined($SURVEY_ERROR)){
         $SURVEY_STRINGS['SURVEY_ERROR'] = constant($SURVEY_ERROR);
      }

      //            debug_obj($SURVEY_STRINGS,'SURVEY_STRINGS');
      $TPL_STRINGS = array_merge($TPL_STRINGS,$SURVEY_STRINGS);
      //            $smarty->assign('STRINGS',$SURVEY_STRINGS);

   }
   break;
   case 'surveyReportControl':

      include_once(ABSOLUTE_PATH.'/includes/report_image_output.php');

      die();
   default;
   default:{
      $TPL_STRINGS['DIALOG_NEWSURVEY'] = true;
      $TPL_STRINGS['ADD_SURVIVORS']    = true;
      $TPL_STRINGS['DIALOG_SURVEY']    = true;

       
      $SURVEYS = $surveyOfficerObj->getSurveysByUserId($oLogger->getUserId());
      //            debug_obj($SURVEYS,'$SURVEYS');
      $TPL_STRINGS['SURVEYS'] = $SURVEYS;
      #$smarty->assign('SURVEYS',$SURVEYS);
       
      $HTML_TPL_NAVBAR   = PATH_TEMPLATES.'/admin/navbar_surveys.tpl';
      $HTML_TPL_LEFTBOX  = PATH_TEMPLATES.'/admin/leftbox_surveys.tpl';
      $HTML_TPL_RIGHTBOX = PATH_TEMPLATES.'/admin/rightbox.tpl';
   }
   break;
}


//$HTML_TPL_TOPNAV   = PATH_TEMPLATES.'/admin/topnav.tpl';
//$HTML_TPL_BODY     = PATH_TEMPLATES.'/admin/body.tpl';


//$HTML_TPL_FOOTER   = PATH_TEMPLATES.'/admin/footer.tpl';
//debug_obj($TPL_STRINGS,'$TPL_STRINGS');
$smarty->assign('STRINGS',$TPL_STRINGS);

?>