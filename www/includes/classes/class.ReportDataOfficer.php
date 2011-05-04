<?php
/*
 * @version $Id: class.ReportDataOfficer.php 133 2007-11-25 01:49:43Z mimait04 $
 * @package mkSurvey
 */

include_once(CLASSES_PATH.'/graph/data/class.GraphDataAbstract.php');

class ReportDataOfficer{

   function ReportDataOfficer(){


   }

   /**
    * Load grapth data object
    *
    * @param string $controlId
    * @param GraphData $graphDataObj
    */
   function loadGraphData($controlId,$sid){

      $controlArr = explode('_',$controlId);

      if (count($controlArr)>0){
         $graphId = $controlArr[0];
      }

      $graphId = strtoupper($graphId);

      $ClassName = 'GraphData'.$graphId;
      $graphClassPath = CLASSES_PATH.'/graph/data/class.'.$ClassName.'.php';

      //debug_sql($graphClassPath);

      if (!file_exists($graphClassPath)){
         return new GraphDataAbstract($graphId);
      }

      include_once($graphClassPath);

      //echo "$ClassName($controlId,$sid)";
      
      return new $ClassName($controlId,$sid);

   }

}
?>