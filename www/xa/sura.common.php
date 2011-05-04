<?php
/**
 * @version $Id:$
 */
require_once(LANGUAGE_PATH.'/lang_sura.php');


#report stuff
//if (array_key_exists('surveyReport',$_GET) || array_key_exists($_POST['xjxfun'],array('doGetReportValue','doGetReportValues'))){
   $xajax->registerFunction('doGetReportValue');
   $xajax->registerFunction('doGetReportValues');
//}else{
   $xajax->registerFunction('loadSurveyData');
   $xajax->registerFunction('loadSurveyConfigData');
   $xajax->registerFunction('createSurvey');
   $xajax->registerFunction('updateSurvey');
   $xajax->registerFunction('deleteSurvey');
   
//}

//if (array_key_exists('dosurvey',$_GET)){
   $xajax->registerFunction('doSetValue');
//}

?>