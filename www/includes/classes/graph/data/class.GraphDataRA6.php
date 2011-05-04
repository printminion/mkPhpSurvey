<?php
/**
 *
 * @version $Id: class.GraphDataRA6.php 134 2007-11-25 04:10:22Z mimait04 $
 * @package mkSurvey.Graph.Data
 */

class GraphDataRA6 extends GraphDataAbstract {

   function GraphDataRA6($controlId,$sid){
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

      $sqlQuery = "SELECT ".$graphDataObj->controlId.", count(".$graphDataObj->controlId.") as total
       		      FROM `".DB_PREFIX."survey_survivors` mss LEFT JOIN `".$graphDataObj->surveyId."` ms
				    ON mss.tid = ms.tid
				 WHERE mss.survey_id = '".$graphDataObj->_sid."' AND ms.finished = 1
              GROUP BY ".$graphDataObj->controlId."";

      //debug_sql($sqlQuery);

      //define control values
      $controlDataArr = array('0' => 0,
      						  '1' => 0,
						      '2' => 0,
						      '3' => 0,
						      '4' => 0,
						      '5' => 0,
							  '6' => 0);
/*
      $graphDataObj->graphTitlesArr = array('0' => 'bis 20 Jahre',
		 							        '1' => '21 - 30 Jahre',
										    '2' => '31 - 40 Jahre',
										    '3' => '41 - 50 Jahre',
										    '4' => '51 - 60 Jahre',
										    '5' => 'über 60 Jahre');
*/
      $graphDataObj->graphTitlesArr = array('1' => 'bis 20 Jahre',
		 							        '2' => '21 - 30 Jahre',
										    '3' => '31 - 40 Jahre',
										    '4' => '41 - 50 Jahre',
										    '5' => '51 - 60 Jahre',
										    '6' => 'über 60 Jahre');
      $sqlQueryResult = $database->openConnectionWithReturn($sqlQuery);

      $valuesCount = 0;
      while ($row = mysql_fetch_array($sqlQueryResult)) {
         //      debug_obj($row,'$row');
         $controlDataArr[$row[0]] = $row[1];
         $valuesCount += $row[1];
      }

      //debug_obj($controlDataArr,'$controlDataArr');

      $graphDataObj->valuesCount    = $valuesCount;
      $graphDataObj->graphDataArr   = $controlDataArr;
      return true;
   }

}
?>