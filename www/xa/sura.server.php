<?php
/**
 * @version $Id:$
 * mkSurvey Admin
 */


require_once(LANGUAGE_PATH.'/lang_sura.php');

function doSetValue($inputArr = null){
   //   echo "doSetValue($inputArr = null)";
   global $surveySessionObj;

   $objResponse = new xajaxResponse();

   if ($inputArr['id'] == ''){
      $objResponse->alert(ERROR_REQUIRED_PARAMETER_IS_NULL);
      return $objResponse;
   }
   
   //mk: workaround to server wich does not hold object in session
   //$surveySessionObj = new SurveySession($_GET['dosurvey']);
   $surveyOfficerObj = new SurveyOfficer();
   
   //$surveySessionObj = null;
   
   $surveyOfficerObj->getSurveySession($_SESSION['tokenID'],&$surveySessionObj);
   
   //echo 'getId:'.$surveySessionObj->getId();
   
   
   if ($surveySessionObj->getFinished()){
      $objResponse->alert(ERROR_SURVEY_ALREADY_COMPLETE);
      $objResponse->redirect(LIVE_SITE);
      return $objResponse;
   }

   if(!isset($surveySessionObj)){
      $objResponse->alert("Failed to initialize Survey Sesssion");
      return $objResponse;
   }

   if(!$surveySessionObj->setValue($inputArr['id'],$inputArr['value'])){
      $objResponse->alert(ERROR_FAILED_TO_SAVE_VALUE.':'.$surveySessionObj->getLastError());
   }else{
      $controlType = substr($inputArr['id'],0,3);
      if ($controlType == 'txt' || $controlType == 'txd'){

      }else{
         /*
          * parse rd und co id's
          */
         $controlType = explode('__',$inputArr['id']);
         $controlType = $controlType[0].'_';
      }

      //$objResponse->assign($inputArr['id'],'style.border','1px dotted #ff0000');//Loader
      $objResponse->assign('status_'.$inputArr['id'],'style.display','block');
      $objResponse->assign('status_'.$inputArr['id'],'innerHTML',SURVEY_SAVED);


      if ($inputArr['id'] == 'finished'){
         $objResponse->alert(INFO_THANKS_FOR_YOUR_PARTICIPATION);
         //$objResponse->redirect(LIVE_SITE.'/admin/');
         $objResponse->redirect(LIVE_SITE);
         return $objResponse;
      }
   }

   return $objResponse;
}

/**
 * Enter description here...
 *
 * @param array $inputArr
 * @return Object
 */
function updateSurvey($inputArr = null){
   global $oLogger;

   $objResponse = new xajaxResponse();

   //$objResponse->alert('Not yet Implemented\nupdateSurvey:'.dumpPrintRToString2($inputArr));

   if ($inputArr['survey_id'] == ''){
      $objResponse->alert(ERROR_REQUIRED_PARAMETER_SURVEYID_IS_NULL);
      return $objResponse;
   }


   if ($inputArr['template'] == ''){
      $objResponse->alert(ERROR_REQUIRED_PARAMETER_IS_NULL);
      return $objResponse;
   }

   $surveyOfficerObj = new SurveyOfficer();
   ###############################################################
   # TODO:Move this check to SurveyOfficer
   $surveyConstansArr = null; //survex constants datta array
   if(!$surveyOfficerObj->getSurveyConstants($inputArr['template'],$surveyConstansArr)){
      return $objResponse;
   }

   //   //print_r($inputArr['Id']);
   //   $languageFile = ABSOLUTE_PATH.'/surveys/'.$inputArr['template'].'/language/'.SITE_LANG.'/survey_constants.php';
   //
   //   if (file_exists($languageFile)){
   //      include_once($languageFile);
   //   }else{
   //      #ERROR TODO: Add error while file not exists
   //   }

      if ($inputArr['title'] == ''){
         $errorsArr[] = ' * '.SURVEY_TITLE;
      }

      foreach((array)$surveyConstansArr as $surveyConstant){
//         $captionConstant = $surveyConstant['survey_type_id'].'_'.$surveyConstant['field_name'];
//
//         if (defined($captionConstant)){
//            $caption = constant($captionConstant);
//         }else{
//            $caption = $captionConstant;
//         }
//
//         $responseArr[$surveyConstant['field_name']] = array(
//												      'uc_type_id' => $surveyConstant['uc_type_id'],
//												      'required'   => $surveyConstant['required'],
//												      'static'     => $surveyConstant['static'],
//												      'validate'   => $surveyConstant['validate'],
//                                                      'caption'    => $caption 
//         );


         if ($surveyConstant['required'] == 1 && $inputArr[$surveyConstant['field_name']] == ''){
            $errorsArr[] = ' * '.$caption;
         }
         /*
          * TODO: Validate length of data
          */

         /*
          * prepare array with constant data
          */
         $surveyConstantDataArr[$surveyConstant['field_name']] = $inputArr[$surveyConstant['field_name']];

      }
      #
      ###############################################################

      if (count($errorsArr) > 0){
         $errors  = ERROR_FILL_REQUIRED_DATA." \n";
         $errors .= join($errorsArr,"\n");

         //$objResponse->alert(dumpPrintRToString2($inputArr));
         $objResponse->alert($errors);
         return $objResponse;
      }

      //$objResponse->alert(dumpPrintRToString2($inputArr));
      //return $objResponse;


      /**
       * TODO: Add amarty redender suff here
       */


      //   debug_obj($oLogger,'$oLogger');
      if(!$oLogger->IsAdmin()){
         //die('ERROR:You are not admin');
         $objResponse->alert(ERROR_YOU_ARE_NOT_ADMIN);
         return $objResponse;
      }

      if(!class_exists('SurveyOfficer')){
         include_once(CLASSES_PATH.'/class.SurveyOfficer.php');
      }

      if(!class_exists('Survey')){
         include_once(CLASSES_PATH.'/class.Survey.php');
      }

      $surveyObj = new Survey($inputArr['survey_id']);
      $surveyObj->setConstantDataValues($surveyConstantDataArr);
      $surveyOfficerObj = new SurveyOfficer();


      if(!$surveyOfficerObj->updateSurvey($oLogger, &$surveyObj, $inputArr)){
         //$oLogger->relocate(LIVE_SITE."/admin/?msg=".$surveyOfficerObj->getLastError());
         //$objResponse->redirect(LIVE_SITE."/admin/?msg=".$surveyOfficerObj->getLastError());
         //$objResponse->alert('redirect:'.LIVE_SITE."/admin/?msg=".$surveyOfficerObj->getLastError());
         $objResponse->alert('error while updating\n'.$surveyOfficerObj->getLastError());
      }else{
         //$oLogger->relocate(LIVE_SITE."/admin/?addsurvivors&sid=".$surveyObj->getSurveyId());
         //$objResponse->redirect(LIVE_SITE."/admin/?addsurvivors&sid=".$surveyObj->getSurveyId());
         //$objResponse->alert('redirect:'.LIVE_SITE."/admin/?addsurvivors&sid=".$surveyObj->getSurveyId());
         $objResponse->alert('gespeichert');
         $objResponse->redirect(LIVE_SITE.'/admin/');
      }

      //$objResponse->alert(dumpPrintRToString2($inputArr));
      //$objResponse->alert(dumpPrintRToString2($responseArr));

      //   $objResponse->assign('survey_new_loading','style.display','none');
      //   $objResponse->assign('survey_new_values','innerHTML',$outputHtml);
      //   $objResponse->assign('survey_new_values','style.display','inherit');
      //   $objResponse->assign('survey_new_description','style.display','inherit');

      //$surveyOfficerObj->createSurvey()
      return $objResponse;
}


/**
 * Load Survey config data
 *
 * @param array $inputArr
 * @return Object
 */
function loadSurveyData($inputArr = null){
   $objResponse = new xajaxResponse();

   if ($inputArr['id'] == ''){
      $objResponse->alert(ERROR_REQUIRED_PARAMETER_IS_NULL);
      return $objResponse;
   }

   //$objResponse->alert(dumpPrintRToString2($inputArr));


   $surveyObj = new Survey($inputArr['id']);

   if($surveyObj->getSurveyId() != $inputArr['id']){
      $objResponse->alert(ERROR_SURVEY_DOESNT_EXIST);
      return $objResponse;
   }


   $objResponse->assign('sinfo_3','value',$surveyObj->getTitle());//Name
   $objResponse->assign('sinfo_2','value',$surveyObj->getSurveyTypeId());//Template
   $objResponse->assign('dialog_survey_load','style.display','none');//Loader


   ################################################################
   # Load Constant data of Survey
   # TODO: Move it to object
   $surveyOfficerObj = new SurveyOfficer();

   //   $surveyConstansArr = null; //survex constants datta array
   //   if(!$surveyOfficerObj->getSurveyConstants($surveyObj->getSurveyTypeId(),$surveyConstansArr)){
   //      return $objResponse;
   //   }

   //print_r($inputArr['Id']);
   $languageFile = ABSOLUTE_PATH.'/surveys/'.$surveyObj->getSurveyTypeId().'/language/'.SITE_LANG.'/survey_constants.php';

   if (file_exists($languageFile)){
      include_once($languageFile);
   }else{
      #ERROR TODO: Add error while file not exists
   }

   $surveyConstansArr = $surveyObj->getConstantDataValues();

   //print_r($surveyConstansArr);

   foreach((array)$surveyConstansArr as $key => $surveyConstant){
      $captionConstant = $surveyConstant['survey_type_id'].'_'.$surveyConstant['field_name'];

      if (defined($captionConstant)){
         $caption = constant($captionConstant);
      }else{
         $caption = $captionConstant;
      }

      //         $responseArr[$surveyConstant['field_name']] = array(
      //												      'uc_type_id' => $surveyConstant['uc_type_id'],
      //												      'required'   => $surveyConstant['required'],
      //												      'static'     => $surveyConstant['static'],
      //												      'validate'   => $surveyConstant['validate'],
      //                                                      'caption'    => $caption
      //         );

      $outputHtml .= '<h2>'.$caption.'</h2>';
      $outputHtml .= '<input class="lhcl_input" id="'.$surveyConstant['uc_type_id'].'" name="'.$surveyConstant['field_name'].'" value="'.$surveyConstant['value'].'" maxlength="100" type="text"/>';

   }

   /**
    * TODO: Add amarty redender suff here
    */


   //$objResponse->alert(dumpPrintRToString2($inputArr));
   //$objResponse->alert(dumpPrintRToString2($responseArr));

   //$objResponse->assign('survey_loading','style.display','none');
   $objResponse->assign('survey_values','innerHTML',$outputHtml);
   $objResponse->assign('survey_values','style.display','block');
   $objResponse->assign('survey_description_value','value',$surveyObj->getDescription());//Description
   $objResponse->assign('survey_description','style.display','block');
   $objResponse->assign('survey_id','value',$surveyObj->getSurveyId());
   
   $objResponse->assign('survey_permalink','value',LIVE_SITE_URL.'/survey/?token='.$surveyObj->getToken());
   $objResponse->assign('survey_permalink_results','value',LIVE_SITE_URL.'/admin/?surveyReport&sid='.$surveyObj->getSurveyId());

   //$objResponse->assign('sid','value',$surveyObj->getSurveyId());
   //$objResponse->assign('survey_id','value',$surveyObj->getSurveyId());



   //$objResponse->addHandler('btnAddSurvivor','onover','alert('.LIVE_SITE_URL.'/admin/?addsurvivors&sid='.$surveyObj->getSurveyId().')');
   //$objResponse->addHandler('btnAddSurvivor','onclick',LIVE_SITE_URL.'/admin/?addsurvivors&sid='.$surveyObj->getSurveyId());
   //$objResponse->removeHandler('btnAddSurvivor','onclick','return false;');
   //$objResponse->addEvent('btnAddSurvivor','onclick','return false;');

   //$objResponse->alert(LIVE_SITE_URL.'/admin/?addsurvivors&sid='.$surveyObj->getSurveyId());

   #
   ################################################################


   //   $objResponse->alert(INFO_THANKS_FOR_YOUR_PARTICIPATION);
   //   $objResponse->redirect(LIVE_SITE.'/admin/');
   return $objResponse;

}

/**
 * Load constants for new Survey
 *
 * @param array $inputArr
 * @return Object
 */
function loadSurveyConfigData($inputArr = null){
   $objResponse = new xajaxResponse();

   if ($inputArr['Id'] == ''){
      $objResponse->alert(ERROR_REQUIRED_PARAMETER_IS_NULL);
      return $objResponse;
   }

   $surveyOfficerObj = new SurveyOfficer();

   $surveyConstansArr = null; //survex constants datta array
   if(!$surveyOfficerObj->getSurveyConstants($inputArr['Id'],$surveyConstansArr)){
      return $objResponse;
   }

   //print_r($inputArr['Id']);
   $languageFile = ABSOLUTE_PATH.'/surveys/'.$inputArr['Id'].'/language/'.SITE_LANG.'/survey_constants.php';

   if (file_exists($languageFile)){
      include_once($languageFile);
   }else{
      #ERROR TODO: Add error while file not exists
   }

   foreach((array)$surveyConstansArr as $surveyConstant){
      $captionConstant = $surveyConstant['survey_type_id'].'_'.$surveyConstant['field_name'];

      if (defined($captionConstant)){
         $caption = constant($captionConstant);
      }else{
         $caption = $captionConstant;
      }

      $responseArr[$surveyConstant['field_name']] = array(
												      'uc_type_id' => $surveyConstant['uc_type_id'],
												      'required'   => $surveyConstant['required'],
												      'static'     => $surveyConstant['static'],
												      'validate'   => $surveyConstant['validate'],
                                                      'caption'    => $caption 
      );

      $outputHtml .= '<h2>'.$caption.'</h2>';
      $outputHtml .= '<input class="lhcl_input" id="'.$surveyConstant['uc_type_id'].'" name="'.$surveyConstant['field_name'].'" value="" maxlength="100" type="text"/>';

   }

   /**
    * TODO: Add amarty redender suff here
    */


   //$objResponse->alert(dumpPrintRToString2($inputArr));
   //$objResponse->alert(dumpPrintRToString2($responseArr));

   $objResponse->assign('survey_new_loading','style.display','none');
   $objResponse->assign('survey_new_values','innerHTML',$outputHtml);
   $objResponse->assign('survey_new_values','style.display','block');
   $objResponse->assign('survey_new_description','style.display','block');

   return $objResponse;

}



/**
 * Create Survey
 *
 * @param array $inputArr
 * @return Response
 */
function createSurvey($inputArr = null){
   global $oLogger;

   $objResponse = new xajaxResponse();

   //$objResponse->alert(dumpPrintRToString2($inputArr));
   //return $objResponse;


   if ($inputArr['template'] == '' || $inputArr['template'] == 'none'){
      //$objResponse->alert(ERROR_REQUIRED_PARAMETER_IS_NULL);
      $objResponse->alert('Wahlen Sie einen Umfragentemplate aus.');
      return $objResponse;
   }

   $surveyOfficerObj = new SurveyOfficer();
   ###############################################################
   # TODO:Move this check to SurveyOfficer
   $surveyConstansArr = null; //survex constants datta array
   if(!$surveyOfficerObj->getSurveyConstants($inputArr['template'],$surveyConstansArr)){
      return $objResponse;
   }

   //print_r($inputArr['Id']);
   $languageFile = ABSOLUTE_PATH.'/surveys/'.$inputArr['template'].'/language/'.SITE_LANG.'/survey_constants.php';

   if (file_exists($languageFile)){
      include_once($languageFile);
   }else{
      #ERROR TODO: Add error while file not exists
   }

   if ($inputArr['title'] == ''){
      $errorsArr[] = ' * '.SURVEY_TITLE;
   }

   foreach((array)$surveyConstansArr as $surveyConstant){
      $captionConstant = $surveyConstant['survey_type_id'].'_'.$surveyConstant['field_name'];

      if (defined($captionConstant)){
         $caption = constant($captionConstant);
      }else{
         $caption = $captionConstant;
      }

      $responseArr[$surveyConstant['field_name']] = array(
												      'uc_type_id' => $surveyConstant['uc_type_id'],
												      'required'   => $surveyConstant['required'],
												      'static'     => $surveyConstant['static'],
												      'validate'   => $surveyConstant['validate'],
                                                      'caption'    => $caption 
      );


      if ($surveyConstant['required'] == 1 && $inputArr[$surveyConstant['field_name']] == ''){
         $errorsArr[] = ' * '.$caption;
      }
      /*
       * TODO: Validate length of data
       */

      /*
       * prepare array with constant data
       */
      $surveyConstantDataArr[$surveyConstant['field_name']] = $inputArr[$surveyConstant['field_name']];

   }
   #
   ###############################################################

   if (count($errorsArr) > 0){
      $errors  = ERROR_FILL_REQUIRED_DATA." \n";
      $errors .= join($errorsArr,"\n");

      //$objResponse->alert(dumpPrintRToString2($inputArr));
      $objResponse->alert($errors);
      return $objResponse;
   }

   //$objResponse->alert(dumpPrintRToString2($inputArr));
   //return $objResponse;


   /**
    * TODO: Add smarty redender suff here
    */


   //   debug_obj($oLogger,'$oLogger');
   if(!$oLogger->IsAdmin()){
      //die('ERROR:You are not admin');
      $objResponse->alert(ERROR_YOU_ARE_NOT_ADMIN);
      return $objResponse;
   }

   if(!class_exists('SurveyOfficer')){
      include_once(CLASSES_PATH.'/class.SurveyOfficer.php');
   }

   if(!class_exists('Survey')){
      include_once(CLASSES_PATH.'/class.Survey.php');
   }

   $surveyObj = new Survey();
   $surveyObj->setConstantDataValues($surveyConstantDataArr);
   $surveyOfficerObj = new SurveyOfficer();

   if(!$surveyOfficerObj->createSurvey($oLogger, &$surveyObj, $inputArr)){
      //$oLogger->relocate(LIVE_SITE."/admin/?msg=".$surveyOfficerObj->getLastError());
      $objResponse->redirect(LIVE_SITE."/admin/?msg=".$surveyOfficerObj->getLastError());
      //$objResponse->alert('redirect:'.LIVE_SITE."/admin/?msg=".$surveyOfficerObj->getLastError());
   }else{
      //$objResponse->alert(LIVE_SITE."/admin/?addsurvivors&sid=".$surveyObj->getSurveyId());
      $objResponse->redirect(LIVE_SITE."/admin/?addsurvivors&sid=".$surveyObj->getSurveyId());
   }

   return $objResponse;

}


/**
 * delete Survey or surveys
 *
 * @param array $inputArr
 * @return Response
 */
function deleteSurvey($inputArr = null){
   global $oLogger;

   $objResponse = new xajaxResponse();

   //$objResponse->alert("Not yet implemented \n deleteSurvey\n".dumpPrintRToString2($inputArr));


   if (count($inputArr['survey']) == 0){
      $objResponse->alert(WARNING_REQUIRED_PARAMETER_SURVEY_IS_EMPTY);
      return $objResponse;
   }


   //   debug_obj($oLogger,'$oLogger');
   if(!$oLogger->IsAdmin()){
      //die('ERROR:You are not admin');
      $objResponse->alert(ERROR_YOU_ARE_NOT_ADMIN);
      return $objResponse;
   }

   if(!class_exists('SurveyOfficer')){
      include_once(CLASSES_PATH.'/class.SurveyOfficer.php');
   }


   $surveyOfficerObj = new SurveyOfficer();

   $bDeleteError = false;

   foreach($inputArr['survey'] as $key => $value){
      if(!$surveyOfficerObj->deleteSurveyById($key)){
         $bDeleteError = true;
      }
   }

   if($bDeleteError){
      $objResponse->alert("error while deleting\n".$surveyOfficerObj->getLastError());
   }else{

      if(count($inputArr['survey']) == 1){
         $objResponse->alert('Umfrage wurde geloscht');
      }else{
         $objResponse->alert('Umfragen wurden geloscht');
      }

      $objResponse->redirect(LIVE_SITE.'/admin/');
   }


   return $objResponse;
}

/**
 * Create Survey
 *
 * @param array $inputArr
 * @return Response
 */
function doGetReportValue($inputArr = null){
   global $oLogger;

   $objResponse = new xajaxResponse();

   //   //$objResponse->alert(dumpPrintRToString2($inputArr));
   //   //return $objResponse;
   //
   //

   if ($inputArr['id'] == ''){
      //$objResponse->alert(ERROR_REQUIRED_PARAMETER_IS_NULL);
      //$objResponse->assign('survey_new_values','innerHTML',$outputHtml);
      return $objResponse;
   }

   if ($inputArr['sid'] == ''){
      //$objResponse->alert(ERROR_REQUIRED_PARAMETER_IS_NULL);
      $objResponse->assign($inputArr['id'],'innerHTML',ERROR_REQUIRED_PARAMETER_SID_IS_NULL);
      return $objResponse;
   }


   $objResponse->assign($inputArr['id'],'innerHTML','loaded');

   if(!class_exists('ReportDataOfficer')){
      include_once(CLASSES_PATH.'/class.ReportDataOfficer.php');
   }

   $reportDataOfficerObj = new ReportDataOfficer();


   $reportDataObj = $reportDataOfficerObj->loadGraphData($inputArr['id'],$inputArr['sid']);

   //print_r($reportDataObj);

   if ($reportDataObj == null){
      $objResponse->assign($inputArr['id'],'innerHTML',ERROR_FAILED_TO_LOAD_DATA);
      return $objResponse;
   }

   //echo 'getValuesCount:'.$reportDataObj->getValuesCount();
   //print_r($reportDataObj);
   //$reportDataObj = new GraphDataTXA();
   if ($reportDataObj->getValuesCount() == 0){
      $objResponse->assign($inputArr['id'],'innerHTML','');
      return $objResponse;
   }

   if ($reportDataObj->getValuesCount() == 1){
      $value = $reportDataObj->graphDataArr[key($reportDataObj->graphDataArr)];

      $objResponse->assign($inputArr['id'],'innerHTML',$value);
      return $objResponse;
   }


   if ($inputArr['nr'] == 1 || !isset($inputArr['nr'])){

      $value = $reportDataObj->graphDataArr[key($reportDataObj->graphDataArr)];

      //print_r($reportDataObj->graphDataArr);
      //echo $value;

      $objResponse->assign($inputArr['id'],'innerHTML',$value);
      return $objResponse;
   }

   return $objResponse;

}


function doGetReportValues($inputArr = null){
   global $oLogger;

   $objResponse = new xajaxResponse();

   //   //$objResponse->alert(dumpPrintRToString2($inputArr));
   //   //return $objResponse;
   //
   //

   if ($inputArr['id'] == ''){
      //$objResponse->alert(ERROR_REQUIRED_PARAMETER_IS_NULL);
      //$objResponse->assign('survey_new_values','innerHTML',$outputHtml);
      return $objResponse;
   }

   if ($inputArr['sid'] == ''){
      //$objResponse->alert(ERROR_REQUIRED_PARAMETER_IS_NULL);
      $objResponse->assign($inputArr['id'],'innerHTML',ERROR_REQUIRED_PARAMETER_SID_IS_NULL);
      return $objResponse;
   }


   $objResponse->assign($inputArr['id'],'innerHTML','loaded');

   if(!class_exists('ReportDataOfficer')){
      include_once(CLASSES_PATH.'/class.ReportDataOfficer.php');
   }

   $reportDataOfficerObj = new ReportDataOfficer();

   $controlId = str_replace('_body','',$inputArr['id']);

   $reportDataObj = $reportDataOfficerObj->loadGraphData($controlId,$inputArr['sid']);

   //print_r($reportDataObj);

   if ($reportDataObj == null){
      $objResponse->assign($inputArr['id'],'innerHTML',ERROR_FAILED_TO_LOAD_DATA);
      return $objResponse;
   }

   //echo 'getValuesCount:'.$reportDataObj->getValuesCount();
   //print_r($reportDataObj);
   //$reportDataObj = new GraphDataTXA();
   if ($reportDataObj->getValuesCount() == 0 || $reportDataObj->getValuesCount() == 1){
      $objResponse->assign($inputArr['id'],'innerHTML','');
      return $objResponse;
   }

   /*
    if ($reportDataObj->getValuesCount() == 1){
    $value = $reportDataObj->graphDataArr[key($reportDataObj->graphDataArr)];

    $objResponse->assign($inputArr['id'],'innerHTML',$value);
    return $objResponse;
    }*/


   if ($inputArr['nr'] == 1 || !isset($inputArr['nr'])){

      $valuesArr = $reportDataObj->graphDataArr;
      array_shift($valuesArr);

      //print_r($reportDataObj->graphDataArr);
      //print_r($valuesArr);

      foreach($valuesArr as $key => $value){
         if ($value != ''){
            $values = "<li>$value</li>";
         }
      }
      if ($value != ''){
         $values = "<ul>$values</ul>";
      }

      $objResponse->assign($inputArr['id'],'innerHTML',$values);
      return $objResponse;
   }

   //$value = 'loaded';
   //$objResponse->assign($inputArr['id'],'innerHTML',$value);

   return $objResponse;
}


?>