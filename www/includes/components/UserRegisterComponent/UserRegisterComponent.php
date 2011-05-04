<?php
/*
 * @version $Id: UserRegisterComponent.php 133 2007-11-25 01:49:43Z mimait04 $
 * @package mkSurvey.UIComponents
 */
include_once(CLASSES_PATH.'/class.Captcha.php');


class UserRegisterComponent extends ComponentAbstract {

   function UserRegisterComponent($instanceID,$instanceName, &$smartyObj){
      parent::ComponentAbstract($instanceID,$instanceName, &$smartyObj);
   }

   /**
    * Redender component
    *
    */
   function redender(){
      $captchaObj = new Captcha();

      unset($this->_formValuesArr);
      unset($this->_errorValuesArr);

      #load DISCLAIMER text here
      $this->setValue('DISCLAIMER',PRODUCT_DISCLAIMER_TEXT);
      if(isset($_GET['optin'])){
          
         //debug_sql($_GET['optin'],'optin');
         $userOfficerObj = new UserOfficer();
         if($userOfficerObj->optinUser($_GET['optin'])){
            //debug_sql('optin - ok');
            $this->_template = 'UserRegisterOptinSuccess.tpl';
         }else{
            //debug_sql('optin - ko');
            $this->_errorValuesArr = $userOfficerObj->getLastError();
            $this->_template = 'UserRegisterOptinFailed.tpl';
         }
          
      }elseif ($_POST['cid'] == $this->getComponentID()){
         //debug_obj($_POST,'$_POST');
         $this->setValue('Email',$_POST['Email']);
         $this->setFormValue('Email',$_POST['Email']);
         //          [cid] => gwyq
         //          [Email] =>
         //          [Passwd] =>
         //          [PasswdAgain] =>
         //          [ctoken] =>
         //          [newaccountcaptcha] =>


         $userOfficerObj = new UserOfficer();
         $userObj = new User();

         if(!$userObj->setEmail($_POST['Email'])){
            $this->setErrorValue('Email',$userObj->getLastError());

         }else{
            $userObj->setUsername($_POST['Email']);
            //$userObj->setName($_POST['Email']);
         }

         if (strlen($_POST['Passwd']) < $userOfficerObj->getUserMinPasswordLength()){
            $this->setErrorValue('Passwd',ERROR_PASSWORD_IS_TOO_SHORT);
         }else{
            if ($_POST['Passwd'] != $_POST['PasswdAgain']){
               $this->setErrorValue('Passwd',ERROR_PASSWORD_PAIRS_ARE_NOT_EQUAL);
            }else{
               $userObj->setPassword($_POST['Passwd']);
            }
         }

         #check catcha value
         if (!$captchaObj->validateToken($_POST['ctoken'],$_POST['newaccountcaptcha'])){
            $this->setErrorValue('ctoken',ERROR_CAPTCHA_VALUE_IS_WRONG);
            $this->setFormValue('ctoken',$captchaObj->getNewCaptchaPublicKey());
         }else{

            if(!$userOfficerObj->registerUser(&$userObj)){
               $this->setErrorValue('error',$userOfficerObj->getLastError());
               $this->setFormValue('ctoken',$captchaObj->getNewCaptchaPublicKey());
               //debug_sql('register - ko');
               return false;
            }else{
               //debug_sql('register - ok');
               $this->_template = 'UserRegisterSuccess.tpl';
               return true;
            }

         }

      }else{
         $this->_template = 'UserRegisterDefault.tpl';
         $this->setFormValue('ctoken',$captchaObj->getNewCaptchaPublicKey());
      }
   }

   /**
    * return string of redendered component
    *
    * @return string
    */
   function getOutput(){
      //debug_obj($this,"getFormValue($key)");

      //debug_obj($this->getErrorValues(),'getErrorValues');

      //ErrorMessageComponent
      $this->_smartyRef->assign('ERRORS_ARRAY',$this->getErrorValues());

      return parent::getOutput();
   }
}
?>
