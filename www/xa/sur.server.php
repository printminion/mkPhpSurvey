<?php
/**
 *
 * @version $Id: sur.server.php 117 2007-11-21 00:24:47Z mimait04 $
 *
 * mkSurvey xAjax definitoin
 *
 *
 */

//echo 'DOCUMENT_ROOT;'.$_SERVER['DOCUMENT_ROOT'];
//print_r($_SERVER);

$pathFileArr = explode('/',$_SERVER['SCRIPT_FILENAME']);
//print_r($pathFileArr);
unset($pathFileArr[count($pathFileArr)-1]);

//echo 'count:'.count($pathFileArr);

$pathFile = join('/',$pathFileArr);
//echo 'pathFile:'.$pathFile;

//chdir($_SERVER['DOCUMENT_ROOT']);
chdir($pathFile.'/../');
include_once ("configuration.php");

if(!class_exists('SurveySession')){
   include_once(CLASSES_PATH.'/class.SurveySession.php');
}
 
if(!class_exists('Survey')){
   include_once(CLASSES_PATH.'/class.Survey.php');
}
 
if(!class_exists('SurveyOfficer')){
   include_once(CLASSES_PATH.'/class.SurveyOfficer.php');
}

include_once ("require_all.php");

#include xajax server - Admin
include_once (ABSOLUTE_PATH."/xa/sura.server.php");
include_once (ABSOLUTE_PATH."/xa/sur.common.php");
//print_r($xajax);
$xajax->processRequest();
?>