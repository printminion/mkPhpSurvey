<?php
/**
 * Build output for component
 */


include_once(CLASSES_PATH.'/class.GraphOfficer.php');
include_once(CLASSES_PATH.'/class.ReportDataOfficer.php');

//debug_obj($_GET,'$_GET');

if ($_GET['sid']==''){
   die('ERROR_REQUIRED_PARAMETER_SID_IS_NULL');
}

if (!is_numeric($_GET['sid'])){
   die('ERROR_REQUIRED_PARAMETER_SID_IS_NOT_NUMERIC');
}

if ($_GET['controlID']==''){
   die('ERROR_REQUIRED_PARAMETER_CONTROLID_IS_NULL');
}

$controlId = $_GET['controlID'];


$controlArr = explode('_',$controlId);

if (count($controlArr)>0){
   $controlTypeId = $controlArr[0];
}

#get Graph object
$graphOfficerObj = new GraphOfficer();
$graphObj = $graphOfficerObj->getGraphById($controlTypeId);

# populate data object
$reportDataOfficerObj = new ReportDataOfficer();
$reportDataObj = $reportDataOfficerObj->loadGraphData($controlId,$_GET['sid']);
//debug_sql($controlId,'$controlId');

//debug_sql($_GET['sid'],'sid');
//debug_obj($graphObj,'$graphObj');
//debug_obj($graphDataObj,'$graphDataObj');


if($graphDataObj == null){
   #data object is null
}

# redender graph with data
if ($graphObj != null){
   $graphObj->redenderData(&$reportDataObj);
}else{
   echo "Control $controlTypeId is not defined";
}
die();
?>