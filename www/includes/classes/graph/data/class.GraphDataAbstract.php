<?php
/**
 * Abstract implementation of DataGraph
 *
 * @version $Id: class.GraphDataAbstract.php 137 2007-11-25 05:03:34Z mimait04 $
 * @package mkSurvey.Graph.Data
 */

class GraphDataAbstract extends ObjectLogger{
   /**
    * current Survey id
    *
    * @var long
    */
   var $_sid;
   var $controlTypeId;
   var $controlId;
   var $surveyId;



   var $valuesCount;

   var $graphDataArr; //key-value data array
   //var $graphDataSimplyArr; //simply data array

   var $graphTitlesArr;

   function GraphDataAbstract() {

   }

   /**
    * Load GraphData
    *
    * @param long $controlId
    * @param GraphDataAbstract $graphDataObj
    * @return bool
    */
   function _loadGraphData($controlId,&$graphDataObj){
       $this->_addError(ERROR_CLASS_GRAPHDATA_NOT_YET_IMPLEMENTED);
       return false;
   }
   
   /**
    * Get ammount of Values
    *
    * @return integer
    */
   function getValuesCount(){
      return count($this->graphDataArr);//$this->valuesCount;
   }

   /**
    * get array values
    *
    * @return array
    */
   function getDataArray(){
      return array_values($this->graphDataArr);
   }



   /**
    * Enter description here...
    *
    * @return array
    */
   function getKeysArray(){
      return array_keys($this->graphDataArr);
   }

   /**
    * Get max value from array
    *
    * @return float
    */
   function getMaxDataValue(){
      //debug_obj($this->getDataArray(),'getDataArray');
      return $this->_getMaxArrayValue($this->getDataArray());
   }

   /**
    * Enter description here...
    *
    * @return float
    */
   function getMaxKeyValue(){
      //debug_obj($this->getKeysArray(),'getKeysArray');
      $dataMaxKeyValue = $this->_getMaxArrayValue($this->getKeysArray());
      //TODO: fix of Allowed memory size of 33554432 bytes exhausted (tried to allocate 35 bytes)
      if ($dataMaxKeyValue > 1024) {
          $dataMaxKeyValue = 1024; //25 Bytes
      }
      return $dataMaxKeyValue;
   }

   function _getMaxArrayValue(&$array){
      $bGotFirstValue = false;
       
      foreach((array)$array as $key => $value){
         if(!$bGotFirstValue){
            $maxValue = $value;
            $bGotFirstValue = true;
            continue;
         }

         if ($maxValue < $value){
            $maxValue = $value;
         }
      }
      return $maxValue;
   }
   /**
    * rotate array to Left
    *
    * @param array $array
    */
   function _arrayRotateLeft(&$array){
      $arrayElement = array_shift($array);
      array_push($array, $arrayElement);
   }


   /**
    * rotate array to Right
    *
    * @param array $array
    */
   function _arrayRotateRight(&$array){
      $arrayElement = array_pop($array);
      array_unshift($array, $arrayElement);
   }

}
?>