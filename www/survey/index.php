<?
/**
 *
 * Admin Gate
 *
 * @version $Id: index.php 143 2007-12-07 09:39:45Z mimait04 $
 * @copyright
 * @author
 *
 */
chdir('..');
$_GET['action'] = 'dosurvey';

include_once('configuration.php');
include_once('require_all.php');

if(isset($_GET['dosurvey'])){
   $currentStage = 'dosurvey';
}

##########################################################
# workaround to do public surveys
# TODO: replace with coded values
if(isset($_GET['token'])){
   $currentStage = 'survey';
   $email = md5(mktime()).'@unknown.net';
   

   if (!class_exists('SurveyOfficer')){
      include_once(CLASSES_PATH.'/class.SurveyOfficer.php');
   }
   $surveyOfficerObj = new SurveyOfficer();
   $surveyId = $surveyOfficerObj->getSurveyIdByToken($_GET['token']);
   
   if ($surveyId == ''){
      die('ERROR: Failed to get SurveyId');   
   }
   
   if (!class_exists('Survivor')){
      include_once(CLASSES_PATH.'/class.Survivor.php');
   }
   $survivorObj = new Survivor();

   //debug_sql($survivorObj->ifSurvivorExist($surveyId,$email),"ifSurvivorExist($surveyId,$email)");
   if($survivorObj->ifSurvivorExist($surveyId,$email)){
      //debug_sql('survivor exist');
      continue;
   }

   $survivorObj->setSurveyId($surveyId);
   $survivorObj->setSurvivorEmail($email);
   $survivorObj->setEmailSent(0);
   $survivorObj->setTid(md5($survivorObj->getSurveyId().":".$survivorObj->getSurvivorEmail()));

   if($survivorObj->_insert()){
      //debug_obj($survivorObj,'$survivorObj');
   }else{
      //die('ERROR:'.$database->getLastError());
      //return false;
   }
    
   header("Location: ".LIVE_SITE_URL."/survey/?dosurvey=".$survivorObj->getTid());
}
#
#########################################################


include_once("index.php");

?>