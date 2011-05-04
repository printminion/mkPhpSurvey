<?php
/*
 * @version $Id: class.ObjectLogger.php 133 2007-11-25 01:49:43Z mimait04 $
 * @package mkSurvey.objects
 */

class ObjectLogger{

//   /**
//    * Last error
//    *
//    * @var string
//    */
//   var $_lastError;

   /**
    * Errors Array
    *
    * @var array
    */
   var $_errorArray;
   
   /**
    * Array of String keys of required definitions
    *
    * @var string
    */
   var $_requiredDefinitionsArr;

   function ObjectLogger(){

   }

   /**
    * set array of required definitions
    *
    * @param array $array
    */
   function setRequiredDefinitions($array){
      $this->_requiredDefinitionsArr = $array;
   }
   
   /**
    * Validate required definitions. Set it before with $this->setRequiredDefinitions(array('DENITION1','DENITION2'));
    *
    * @return bool
    */
   function _validateRequiredDefinitions(){
      $error = false;
      foreach((array)$this->_requiredDefinitionsArr as $definition){
         if (!defined($definition)){
            $error = true;
            trigger_error( get_class($this).": definition $definition is not defined");
         }
      }
      return $error;
   }


   /**
    * Reset error stack
    * @access private
    */
   function _resetErrors(){
      //$this->_lastError = null;
      unset($this->_errorArray);
   }

   /**
    * Check if function has errors
    * @access public
    * @return bool
    */
   function hasErrors(){
      if (count($this->_errorArray)){
         return true;
      }else{
         return false;
      }
   }

   /**
    * adds error to error stack
    *
    * @access private
    * @param string $error
    * @param string $valueName
    */
   function _addError($error,$valueName = null){
      //$this->_lastError = $error;
      if ($error!=''){
         $this->_errorArray[] = array('error'     => $error,
         							  'valueName' => $valueName);
      }
   }

   /**
    * returns array of errors
    *
    * @access public
    * @return array
    */
   function getErrors(){
      $errorsArr = $this->_errorArray;
      $this->_resetErrors();
      return $errorsArr;
   }

   /**
    * Gives lastError as text if accuiried
    *
    * @access public
    * @author Mischa Kupriyanov, <m@kupriyanov.com>
    * @return string
    */
   function getLastError() {
      $returnValue = (string) '';

      
      if (count($this->_errorArray)>0){
         //TODO get last element
         $returnValue = $this->_errorArray[count($this->_errorArray)-1];
         $returnValue = $returnValue['error'];
      }
      
      $this->_resetErrors();
      
      return (string) $returnValue;
   }

}
?>