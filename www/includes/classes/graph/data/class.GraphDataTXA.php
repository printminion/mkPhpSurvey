<?php
/**
 *
 * @version $Id: class.GraphDataTXA.php 134 2007-11-25 04:10:22Z mimait04 $
 * @package mkSurvey.Graph.Data
 */

class GraphDataTXA extends GraphDataAbstract {

   function GraphDataTXA($controlId,$sid){
      $this->_sid = $sid;
      $this->_loadGraphData($controlId,$this);
   }

   /**
    * Load GraphData
    *
    * @param long $controlId
    * @param GraphDataAbstract $graphDataObj
    * @return bool
    */
   function _loadGraphData($controlId,&$graphDataObj){
      global $database;
      $controlArr = explode('_',$controlId);

      if (count($controlArr)>0){
         $controlTypeId = $controlArr[0];
      }

      if ($graphDataObj == null){
         //Error no reference to GraphData Object
         return false;
      }

      $graphDataObj->controlId = $controlId;
      $graphDataObj->_sid = $this->_sid;
      $graphDataObj->controlTypeId = $controlTypeId;
      $graphDataObj->surveyId = DB_PREFIX.'sdata_iso_9241_10';

      $sqlQuery = "SELECT id, count(".$graphDataObj->controlId.") as total, ".$graphDataObj->controlId." as value
       		         FROM `".DB_PREFIX."survey_survivors` mss LEFT JOIN `".$graphDataObj->surveyId."` ms
				       ON mss.tid = ms.tid
				    WHERE mss.survey_id = '".$graphDataObj->_sid."' AND ms.finished = 1
                 GROUP BY ".$graphDataObj->controlId." 
                 ORDER BY id ASC";

      //debug_sql($sqlQuery);


      $sqlQueryResult = $database->openConnectionWithReturn($sqlQuery);

      $valuesCount = 0;
      while ($row = mysql_fetch_array($sqlQueryResult)) {
         //      debug_obj($row,'$row');
         $controlDataArr[$row['id']] = $row['value'];
         //$valuesCount += $row[1];
         $valuesCount = $row['total'];
      }

      //debug_obj($controlDataArr,'$controlDataArr');

      $graphDataObj->valuesCount    = $valuesCount;
      $graphDataObj->graphDataArr   = $controlDataArr;
      return true;
   }

}
?>