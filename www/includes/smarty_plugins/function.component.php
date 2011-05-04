<?php
/*
 * @version $Id: function.component.php 133 2007-11-25 01:49:43Z mimait04 $
 */

/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     function.component.php
 * Type:     function
 * Name:     component
 * Purpose:  assign a value to a template variable
 * -------------------------------------------------------------
 */
/**
 * Function to implement {component} functionality
 *
 * @param array $params
 * @param Smarty $smarty
 */


function smarty_function_component($params, &$smarty){
   if (empty($params['class'])) {
      $smarty->trigger_error("component: missing 'class' parameter");
      return;
   }

   if (empty($params['name'])) {
      $smarty->trigger_error("component: missing 'name' parameter");
      return;
   }

   if (!class_exists('ComponentManager')){
      $smarty->trigger_error("component: missing required class 'ComponentManager'");
   }
    
   //debug_obj($params,'smarty_function_component');
    
   $bClassExists = false;

   /*
    * try to load class
    */
   if (!class_exists($params['class'])){
      //$smarty->trigger_error("component: missing required component class '".$params['class']."'");
      if (!file_exists(COMPONENTS_PATH.'/'.$params['class'])){
         $smarty->trigger_error("component: failed to locate class folder '".COMPONENTS_PATH.'/'.$params['class']."'");
      }else{
         if (!file_exists(COMPONENTS_PATH.'/'.$params['class'].'/'.$params['class'].'.php')){
            $smarty->trigger_error("component: failed to locate class file '".COMPONENTS_PATH.'/'.$params['class'].'/'.$params['class'].'.php'."'");
         }else{
            require_once(COMPONENTS_PATH.'/'.$params['class'].'/'.$params['class'].'.php');
         }
      }
   }else{
      $bClassExists = true;
   }

   if (class_exists($params['class'])){
      $bClassExists = true;
   }

   if ($bClassExists){
      #get componentManager from Session
      if (empty($_SESSION['componentManagerObj'])){
         $componentManagerObj = new ComponentManager();
         session_register('componentManagerObj');
         $_SESSION['componentManagerObj'] = &$componentManagerObj;
      }else{
         $componentManagerObj = $_SESSION['componentManagerObj'];
      }



      #create component
      $componentObj = &$componentManagerObj->getComponent($params['class'],$params['name'], &$smarty);

      if ($componentObj == null){
         $smarty->trigger_error("component: failed to create inctance of '".$params['class']."'\n".'componentManagerError:'.$componentManagerObj->getLastError());
      }else{
         $componentObj->setVars($params);
         $componentObj->redender();
         return $componentObj->getOutput();
      }

   }

   //    if (!in_array('value', array_keys($params))) {
   //        $smarty->trigger_error("component: missing 'value' parameter");
   //        return;
   //    }

   $smarty->assign($params['class'], $params['name'], $params['value']);
}
?>