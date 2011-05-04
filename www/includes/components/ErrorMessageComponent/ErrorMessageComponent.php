<?php
/*
 * @version $Id: ErrorMessageComponent.php 133 2007-11-25 01:49:43Z mimait04 $
 * @package mkSurvey.UIComponents
 */

class ErrorMessageComponent extends ComponentAbstract {

   function ErrorMessageComponent($instanceID,$instanceName, &$smartyObj){
      parent::ComponentAbstract($instanceID,$instanceName, &$smartyObj);
   }

   /**
    * Redender component
    *
    */
   function redender(){

      unset($this->_formValuesArr);
      unset($this->_errorValuesArr);

      //debug_obj($this->getVars(),'$this->getVars()');

      $this->_template = 'ErrorMessageDefault.tpl';

   }

   /**
    * return string of redendered component
    *
    * @return string
    */
   function getOutput(){
      //      debug_obj($this->getErrorValues(),'getErrorValues');
      //      debug_obj($this->getVars(),'$this->getVars()');
      //      debug_obj($this->getVar('errors'));

      $this->_smartyRef->assign('ERRORS_ARRAY',$this->getVar('errors'));


      return parent::getOutput();
   }
}
?>