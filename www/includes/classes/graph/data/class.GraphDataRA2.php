<?php
/**
 *
 * @version $Id: class.GraphDataRA2.php 134 2007-11-25 04:10:22Z mimait04 $
 * @package mkSurvey.Graph.Data
 *
 */


class GraphDataRA2 extends GraphDataAbstract {

   function GraphDataRA2($controlId,$sid){
      $this->_sid = $sid;
      $this->_loadGraphData($controlId,$this);

//      $this->graphTitlesArr = array_reverse($this->graphTitlesArr);
//      $this->graphDataArr   = array_reverse($this->graphDataArr);
//
//
//      $this->_arrayRotateLeft($this->graphTitlesArr);
//      $this->_arrayRotateLeft($this->graphDataArr);
//
//      $this->_arrayRotateLeft($this->graphTitlesArr);
//      $this->_arrayRotateLeft($this->graphDataArr);
//
//      $this->_arrayRotateLeft($this->graphTitlesArr);
//      $this->_arrayRotateLeft($this->graphDataArr);
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
      $controlDataArr = array('1' => 0,
							  '2' => 0);


      $sqlQueryResult = $database->openConnectionWithReturn($sqlQuery);

      $valuesCount = 0;
      while ($row = mysql_fetch_array($sqlQueryResult)) {
         //      debug_obj($row,'$row');
         $controlDataArr[$row[0]] = $row[1];
         $valuesCount += $row[1];
      }

      //   debug_obj($controlDataArr,'$controlDataArr');

      $graphDataObj->graphTitlesArr = array('0' => 'Mann ('.$controlDataArr['1'].')',
										    '1' => 'Frau ('.$controlDataArr['2'].')');
      
      $graphDataObj->valuesCount    = $valuesCount;
      $graphDataObj->graphDataArr   = $controlDataArr;
      return true;
   }

}
?>