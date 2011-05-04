<?php
include_once(CLASSES_PATH."/class.ObjectLogger.php");
include_once(CLASSES_PATH."/class.Database.php");
include_once(ABSOLUTE_PATH.'/includes/database_wrapper.php');
include_once(CLASSES_PATH."/class.Logger.php");

include_once(CLASSES_PATH."/class.UserOfficer.php");

include_once(CLASSES_PATH."/class.ComponentManager.php");


##############################
# load required component classes
$componentManagerObj = new ComponentManager();
$componentManagerObj->loadComponents();
#
##############################

########################################################################
# SESSION STRATS HERE
/**
 * INFO: SESSION_STARTs HERE ALL CLASSES saved in session should be required before this line
 */
//debug_obj($_SESSION,'$_SESSION');
//include_once(ABSOLUTE_PATH."/xsmarty/libs/Smarty.class.php");
//$smarty = new Smarty();

include_once(ABSOLUTE_PATH.'/includes/regglobals.php');

//debug_obj($_SESSION,'$_SESSION');
/**
 * initialize database
 */
//include_once (CLASSES_PATH."/database.php");

//session_register('database');

if($_SESSION['database']==null){
   $database = new database();
   $_SESSION['database'] = $database;
}else{
   $database = $_SESSION['database'];
}


/**
 * initialize logger
 */
//include_once(CLASSES_PATH."/class.Logger.php");
//session_register('oLogger');
if($_SESSION['oLogger']==null){
   $oLogger = new Logger();
   $_SESSION['oLogger'] = $oLogger;
}else{
   $oLogger = $_SESSION['oLogger'];
}


if(!class_exists('SurveySession')){
   include_once(CLASSES_PATH.'/class.SurveySession.php');
}

if($_SESSION['surveySessionObj']==null){
   $surveySessionObj = new SurveySession();
   $_SESSION['surveySessionObj'] = $surveySessionObj;
}else{
   $surveySessionObj = $_SESSION['surveySessionObj'];
}


//if($_SESSION['componentManagerObj']==null){
//   $componentManagerObj = new ComponentManager();
//   $_SESSION['componentManagerObj'] = $componentManagerObj;
//}else{
//   $componentManagerObj = $_SESSION['componentManagerObj'];
//}

/**
 * initialize userofficer
 */
//include_once(CLASSES_PATH."/class.UserOfficer.php");
//session_register('userOfficerObj');
//if($_SESSION['userOfficerObj']==null){
//   $userOfficerObj = new UserOfficer();
//   $_SESSION['userOfficerObj'] = $userOfficerObj;
//}else{
//   $userOfficerObj = $_SESSION['userOfficerObj'];
//}

//session_register('database');
//session_register('oLogger');
//session_register('userOfficerObj');

//debug_obj($_SESSION,'$_SESSION');
include_once(ABSOLUTE_PATH.'/includes/accesscheck.php');

?>