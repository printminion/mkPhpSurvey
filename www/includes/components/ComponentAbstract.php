<?php
/*
 * @version $Id: ComponentAbstract.php 133 2007-11-25 01:49:43Z mimait04 $
 * @package mkSurvey.UIComponents
 */

class ComponentAbstract{
   /**
    * name of current component
    * @access private
    * @var string
    */
   var $_name;
   /**
    * name of current component instance
    * @access private
    * @var string
    */
   var $_instanceName;

   /**
    * id of current component
    * @access private
    * @var string
    */
   var $_instanceId;

   /**
    * component vars array
    * @access private
    * @var array
    */
   var $_componentVarsArr;

   /**
    * Name of template
    * @access private
    * @var string
    */
   var $_template;

   /**
    * Array with values
    * @access private
    * @var array
    */
   var $_valuesArr;

   /**
    * Array with Form values
    * @access private
    *
    * @var array
    */
   var $_formValuesArr = null;

   /**
    * Array with Form Error values
    * @access private
    * @var array
    */
   var $_errorValuesArr = null;


   /**
    * Local reference to Smarty object. Will be removed after calling getOutput function
    *
    * @var Smarty
    */
   var $_smartyRef = null;

   /**
    * Construnctor
    *
    * @param string $instanceID
    * @param string $instanceName
    * @param Smarty $smartyObj
    * @return IComponent
    */
   function ComponentAbstract($instanceID,$instanceName, &$smartyObj){//$name, $instanceName){
      $this->_instanceId = $instanceID;
      $this->_instanceName = $instanceName;
      $this->_name = get_class($this);
      $this->_smartyRef = $smartyObj;
   }

   /**
    * Set class name - workaround for php4
    *
    * @param string $className
    */   
   function setClassName($className){
      $this->_name = $className;
      $this->_template = str_replace('Component','Default.tpl',$className);//set default template name
   }

   /**
    * Get component name
    *
    * @return string
    */
   function getComponentName(){
      return $this->_name;
   }

   /**
    * Gets Instance name
    *
    * @return string
    */
   function getComponentInstanceName(){
      return $this->_instanceName;
   }

   /**
    * gets componentID
    *
    * @return string
    */
   function getComponentID(){
      return $this->_instanceId;
   }

   /**
    * Set parameters
    *
    * @param array $params
    */
   function setVars(&$params){
      $this->_componentVarsArr = $params;
   }

   /**
    * Set parameters
    *
    * @return array
    */
   function getVars(){
      return $this->_componentVarsArr;
   }

   /**
    * Set parameters
    *
    * @return array
    */
   function getVar($key){
      return $this->_componentVarsArr[$key];
   }

   /**
    * Set parameters
    *
    * @param string $key
    * @param string $value
    */
   function setValue($key,$value){
      $this->_valuesArr[$key] = $value;
   }


   /**
    * Set Form parameters
    *
    * @param string $key
    * @param string $value
    */
   function setFormValue($key,$value){
      $this->_formValuesArr[$key] = $value;
   }

   /**
    * Set Form Error parameters
    *
    * @param string $key
    * @param string $value
    */
   function setErrorValue($key,$value){
      $this->_errorValuesArr[$key] = $value;
   }

   /**
    * get internal value
    *
    * @param string $key
    * @return string
    */
   function getValue($key){
      return $this->_valuesArr[$key];
   }

   /**
    * get form value
    *
    * @param string $key
    * @return string
    */
   function getFormValue($key){
      return $this->_formValuesArr[$key];
   }

   /**
    * get form values
    *
    * @return array
    */
   function getFormValues(){
      return $this->_formValuesArr;
   }
   /**
    * get error value
    *
    * @param string $key
    * @return string
    */
   function getErrorValue($key){
      return $this->_errorValuesArr[$key];
   }

   /**
    * get error values
    *
    * @return array
    */
   function getErrorValues(){
      return $this->_errorValuesArr;
   }


   /**
    * Redender component
    *
    */
   function redender(){

   }

   /**
    * Set Smarty Reference
    *
    * @param Smarty $smartyObj
    */
   function setSmartyRef(&$smartyObj){
      $this->_smartyRef = &$smartyObj;
   }
   /**
    * return string of redendered component
    *
    * @return string
    */
   function getOutput(){
      
      //debug_obj($this);
      
      if (is_a($this->_smartyRef,'Smarty')){
         $templatePath = COMPONENTS_PATH.'/'.$this->_name.'/templates/'.$this->_template;
         //debug_obj($this,$templatePath);
         if(!$this->_smartyRef->template_exists($templatePath)){
            $this->_smartyRef->trigger_error(get_class($this).": failed to locate template file '".$templatePath."'");
         }else{

            $smartyObj = &$this->_smartyRef;
            unset($this->_smartyRef);


            if (is_a($_SESSION['componentManagerObj'],'ComponentManager')){
               //$componentManagerObj = &$_SESSION['componentManagerObj'];
               //$componentManagerObj = (object)$componentManagerObj;
               //$smartyObj->assign_by_ref('componentManager',$componentManagerObj);
            }

            //$smartyObj->assign_by_ref($this->_name,&$this);
            //$smartyObj->assign_by_ref($this->_name.'["'.$this->_instanceId.'"]',&$this);
            $smartyObj->assign_by_ref($this->_instanceName,$this);
            $smartyObj->assign_by_ref('componentName',$this->_instanceName);
            $smartyObj->assign_by_ref('componentObj',$this);


            #prevent override ot "this" smarty control reference
            if (isset($smartyObj->_tpl_vars['this'])){
               //trigger_error(get_class($this).': Smarty->_tpl_vars["this"] is already set by '.get_class($smartyObj->_tpl_vars['this']));

               $parentThisObj = $smartyObj->_tpl_vars['this'];//save old $this value
               $smartyObj->assign_by_ref('this',$this);//assign current $this value
               $output = $smartyObj->fetch($templatePath);//fetsch smarty template
               $smartyObj->assign_by_ref('this',$parentThisObj);//return old $this reference
            }else{
               $smartyObj->assign_by_ref('this',$this);
               $output = $smartyObj->fetch($templatePath);
            }

            return $output;
         }
      }else{
         trigger_error(get_class($this).': lost Smarty reference');
      }
   }
}
?>