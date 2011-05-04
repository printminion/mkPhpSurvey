<?php
/*
 * @version $Id: class.UserOfficer.php 142 2007-12-07 04:36:06Z mimait04 $
 * @package mkSurvey
 */

include_once(CLASSES_PATH."/class.User.php");
include_once(CLASSES_PATH."/class.Database.php");

define('USER_MIN_PASSWORD_LENGTH',8);
define('TABLE_USERS',DB_PREFIX.'users');

class UserOfficer extends ObjectLogger {

   function UserOfficer(){
      global $database;
      if($database==null){
         $database = new database();
      }

      $this->setRequiredDefinitions(array('USER_MIN_PASSWORD_LENGTH','DB_PREFIX'));

      parent::_validateRequiredDefinitions();

   }

   /**
    * get minimal Password length
    *
    * @return int
    */
   function getUserMinPasswordLength(){
      return USER_MIN_PASSWORD_LENGTH;
   }

   /**
    * Get user by Id
    *
    * @param long $userId
    * @return User
    */
   function &getUserById($userId = null){
      global $userCacheObj;

      $this->lastError = null;

      if($userId == null){
         $this->lastError = ERROR_REQUIRED_INPUT_USERID_IS_NULL;
         return null;
      }

      $userObj =& new User($userId);
      if($userObj == null){
         return null;
      }else{
         return $userObj;
      }

   }

   /**
    * Register user
    *
    * @param User $userObj
    * @return bool
    */
   function registerUser(&$userObj){

      //debug_obj($userObj);

      if ($this->ifUserRegistered($userObj->getUsername())){
         $this->_addError(ERROR_USERID_IS_ALREADY_TAKEN);
         return false;
      }

      $userObj->setInitPassword($userObj->getPassword());
      $userObj->setPassword(md5($userObj->getPassword()));

      $userObj->_insert(TABLE_USERS_INCOMING);

      $this->_sendOptinEmail($userObj);

      return true;
   }
    
   /**
    * Optin user
    *
    * @param string $optin
    * @return bool
    */
   function optinUser($optin){
      global $database;
      if ($optin==''){
         $this->_addError(ERROR_REQUIRED_VALUE_OPTIN_IS_NULL);
         return false;
      }

      $sqlQuery = "SELECT id
      				 FROM ".TABLE_USERS_INCOMING." 
      			    WHERE optin 
      			     LIKE '$optin'";

      $result = $database->openConnectionWithReturn($sqlQuery);
      if (mysql_num_rows($result)==0){
         $this->_addError(ERROR_UNKNOWN_OPTIN_VALUE);
         return false;
      }
      
      $resultArr = mysql_fetch_array($result);
      $userId = $resultArr['id'];

      //debug_sql($userId,'$userId');
      
      $userObj = new User($userId,TABLE_USERS_INCOMING);
      $userObj->setGid(2);//set user type to admin
      $userObj->_insert();
      
      $sqlQuery = "DELETE 
      				 FROM ".TABLE_USERS_INCOMING."
      				WHERE email LIKE '".$userObj->getEmail()."'";
      
      $database->openConnectionNoReturn($sqlQuery);

      return true;
   }

   /**
    * Do stuff after register
    *
    * @param User $userObj
    * @return bool
    */
   function _sendOptinEmail(&$userObj){
      global $database;

      include_once(CLASSES_PATH.'/class.ComposeMail.php');
      include_once(LANGUAGE_PATH.'/lang_register.php');

      if (!class_exists('ComposeMail')){
         $this->_addError(ERROR_REQUIRED_CLASS_COMPOSEMAIL_NOT_FOUND);
         return false;
      }
       
      $query2 = "SELECT name, email
      			   FROM ".TABLE_USERS."
      		      WHERE usertype='superadministrator'";

      $result2 = $database->openConnectionWithReturn($query2);
      if (mysql_num_rows($result2)!=0){
         list($adminName, $adminEmail) = mysql_fetch_array($result2);
      }

      $email = $userObj->getEmail();
      $yourname = 'ADMIN';
      $subject = _USEND_OPTIN_SUBJECT;
      $mailSaveRegistrationFrom = MAILER_RETURN_PATH;

      //eval ("\$subject = \"$subject\";");
      $message = _USEND_OPTIN_BODY;
      $message = str_replace('%LIVE_SITE%',LIVE_SITE,$message);
      $message = str_replace('%OPTIN_URL%',LIVE_SITE.'/signup/?optin='.$userObj->getOptin(),$message);
      $message = str_replace('%USERNAME%',$userObj->getUsername(),$message);

      //      debug_sql("$adminName, $adminEmail");
      //      debug_sql("$email,$subject");
      //      debug_sql($yourname,'$yourname');
      //debug_sql($message,'$message');

      //eval ("\$message = \"$message\";");

      $messageHTML = _USEND_OPTIN_BODY_HTML;
      $messageHTML = str_replace('%LIVE_SITE%',LIVE_SITE,$messageHTML);
      $messageHTML = str_replace('%OPTIN_URL%',LIVE_SITE.'/signup/?optin='.$userObj->getOptin(),$messageHTML);
      $messageHTML = str_replace('%USERNAME%',$userObj->getUsername(),$messageHTML);
      
      $messageHTML = 
      
      $messageHTML = nl2br($messageHTML);
      //debug_sql($messageHTML,'$messageHTML');
       
      #######################################
      # send mail
      $composeMailObj = new ComposeMail($email,$subject);
      $composeMailObj->emailEncoding = 'UTF-8';
      $composeMailObj->SH_fromName($yourname);
      $composeMailObj->SH_ReturnPath(MAILER_RETURN_PATH);
      //$composeMailObj->sh_fromAddr("\"$yourname\" $youremail");
      $composeMailObj->SH_fromAddr($mailSaveRegistrationFrom);
      $composeMailObj->addTextPlainBodyPart($message);
      #$composeMailObj->addAttachFromFile("$datei",$anhang_content_type,"attachment","","",$dateiname);
      $composeMailObj->addHTMLBodyPart($messageHTML);
      $composeMailObj->BuildAndSendMessage();
      #
      #######################################


      //      $query2 = "SELECT name, email
      //				   FROM ".TABLE_USERS."
      //                  WHERE usertype='superadministrator'
      //            		AND sendEmail=1";
      //      $result2 = $database->openConnectionWithReturn($query2);
      //      $yourname = $userObj->getName();
      //      $email    = $userObj->getEmail();
      //      $username1 = $userObj->getUsername();
      //
      //      if (mysql_num_rows($result2) != 0){
      //         list($adminName, $adminEmail)=mysql_fetch_array($result2);
      //         //$subject2 = _SEND_SUB;
      //         $subject2 = _ASEND_SUB;
      //         eval ("\$subject2 = \"$subject2\";");
      //         $message2 = _ASEND_MSG;
      //         eval ("\$message2 = \"$message2\";");
      //         $message2HTML = nl2br($message2);
      //
      //         #######################################
      //         # send mail
      ////         debug_sql("$adminEmail,$subject2");
      ////         debug_sql($adminName,'$adminName');
      ////         debug_sql(MAILER_RETURN_PATH,'MAILER_RETURN_PATH');
      ////         debug_sql($adminEmail,'$adminEmail');
      ////         debug_sql($message2,'$message2');
      ////         debug_sql($message2HTML,'$message2HTML');
      //
      //         $composeMailObj = new ComposeMail($adminEmail,$subject2);
      //         $composeMailObj->SH_fromName($adminName);
      //         $composeMailObj->SH_ReturnPath(MAILER_RETURN_PATH);
      //         $composeMailObj->sh_fromAddr($adminEmail);
      //         #$composeMailObj->SH_fromAddr($mailSaveRegistrationFrom);
      //         $composeMailObj->addTextPlainBodyPart($message2);
      //         #$composeMailObj->addAttachFromFile("$datei",$anhang_content_type,"attachment","","",$dateiname);
      //         $composeMailObj->addHTMLBodyPart($message2HTML);
      //         $composeMailObj->BuildAndSendMessage();
      //         #
      //         #######################################
      //      }

      return true;
   }

   /**
    * Do stuff after register
    *
    * @param User $userObj
    * @return bool
    */
   function _sendRegisteredEmail(&$userObj){
      global $database;

      include_once(CLASSES_PATH.'/class.ComposeMail.php');
      include_once(LANGUAGE_PATH.'/lang_register.php');

      if (!class_exists('ComposeMail')){
         $this->_addError(ERROR_REQUIRED_CLASS_COMPOSEMAIL_NOT_FOUND);
         return false;
      }

      $query2 = "SELECT name, email
      			   FROM ".TABLE_USERS."
      		      WHERE usertype='superadministrator'";

      $result2 = $database->openConnectionWithReturn($query2);
      if (mysql_num_rows($result2)!=0){
         list($adminName, $adminEmail) = mysql_fetch_array($result2);
      }



      $email = $userObj->getEmail();
      $yourname = 'ADMIN';
      $subject = _SEND_SUB;
      $mailSaveRegistrationFrom = MAILER_RETURN_PATH;

      //eval ("\$subject = \"$subject\";");
      $message = _USEND_MSG;
      $message = str_replace('%LIVE_SITE%',LIVE_SITE,$message);
      $message = str_replace('%USERNAME%',$userObj->getUsername(),$message);
      $message = str_replace('%PASSWORD%',$userObj->getInitPassword(),$message);

      //      debug_sql("$adminName, $adminEmail");
      //      debug_sql("$email,$subject");
      //      debug_sql($yourname,'$yourname');
      //      debug_sql($message,'$message');

      //eval ("\$message = \"$message\";");

      $messageHTML = nl2br($message);
      //      debug_sql($messageHTML,'$messageHTML');

      #######################################
      # send mail
      $composeMailObj = new ComposeMail($email,$subject);
      $composeMailObj->SH_fromName($yourname);
      $composeMailObj->SH_ReturnPath(MAILER_RETURN_PATH);
      //$composeMailObj->sh_fromAddr("\"$yourname\" $youremail");
      $composeMailObj->SH_fromAddr($mailSaveRegistrationFrom);
      $composeMailObj->addTextPlainBodyPart($message);
      #$composeMailObj->addAttachFromFile("$datei",$anhang_content_type,"attachment","","",$dateiname);
      $composeMailObj->addHTMLBodyPart($messageHTML);
      $composeMailObj->BuildAndSendMessage();
      #
      #######################################


      $query2 = "SELECT name, email
				   FROM ".TABLE_USERS."
                  WHERE usertype='superadministrator'
            		AND sendEmail=1";
      $result2 = $database->openConnectionWithReturn($query2);
      $yourname = $userObj->getName();
      $email    = $userObj->getEmail();
      $username1 = $userObj->getUsername();

      if (mysql_num_rows($result2) != 0){
         list($adminName, $adminEmail)=mysql_fetch_array($result2);
         //$subject2 = _SEND_SUB;
         $subject2 = _ASEND_SUB;
         eval ("\$subject2 = \"$subject2\";");
         $message2 = _ASEND_MSG;
         eval ("\$message2 = \"$message2\";");
         $message2HTML = nl2br($message2);

         #######################################
         # send mail
         //         debug_sql("$adminEmail,$subject2");
         //         debug_sql($adminName,'$adminName');
         //         debug_sql(MAILER_RETURN_PATH,'MAILER_RETURN_PATH');
         //         debug_sql($adminEmail,'$adminEmail');
         //         debug_sql($message2,'$message2');
         //         debug_sql($message2HTML,'$message2HTML');

         $composeMailObj = new ComposeMail($adminEmail,$subject2);
         $composeMailObj->SH_fromName($adminName);
         $composeMailObj->SH_ReturnPath(MAILER_RETURN_PATH);
         $composeMailObj->sh_fromAddr($adminEmail);
         #$composeMailObj->SH_fromAddr($mailSaveRegistrationFrom);
         $composeMailObj->addTextPlainBodyPart($message2);
         #$composeMailObj->addAttachFromFile("$datei",$anhang_content_type,"attachment","","",$dateiname);
         $composeMailObj->addHTMLBodyPart($message2HTML);
         $composeMailObj->BuildAndSendMessage();
         #
         #######################################
      }

      return true;
   }

   /**
    * Check if user is registered
    *
    * @param string $userName
    * @return bool
    */
   function ifUserRegistered($userName){
      global $database;

      $strQuery = "SELECT email
      				 FROM ".TABLE_USERS." 
      				WHERE email LIKE '$userName';";

      $resultRes = $database->openConnectionWithReturn($strQuery);


      while($result = mysql_fetch_array($resultRes)){
         return true;
      }

      return false;
   }

   function _sendNewPass($checkusername, $confirmEmail, $option, $database, $dbprefix, $live_site){
      global $mailNewPassFrom, $mailNewPassTo;

      $query="select email from ".$dbprefix."users where username='$checkusername' and email='$confirmEmail' and usertype='user'";
      $result=$database->openConnectionWithReturn($query);
      if (mysql_num_rows($result)==0){
         print "<SCRIPT> alert(\""._ERROR_PASS."\"); window.history.go(-1); </SCRIPT>\n";
      }else{
         $newpass=$this->_makePass();
         $message=_NEWPASS_MSG;
         eval ("\$message = \"$message\";");
         $subject=_NEWPASS_SUB;
         eval ("\$subject = \"$subject\";");
         //mail($confirmEmail, $subject, $message, "From: RussenReaktor.de");
         $headers="";
         //$headers .= "From: ".$adminName." <".$adminEmail.">\r\n";
         //$headers .= "Reply-To: ".$adminName." <".$adminEmail.">\r\n";
         //		$headers .= "From: RussenReaktor.de - Novij Parol'<admin@russenreaktor.de>\r\n";
         //$headers .= "Reply-To: RussenReaktor.de - Novij Parol'<admin@russenreaktor.de>\r\n";

         $headers .= "From: ".$mailNewPassFrom."\r\n";
         $headers .= "Reply-To: ".$mailNewPassTo."\r\n";
         $headers .= "X-Priority: 1\r\n";
         $headers .= "Return-Path: <".$adminEmail.">\r\n";  // Return path for errors
         $headers .= "X-MSMail-Priority: High\r\n";
         $headers .= "X-Mailer: PHP\n";
         @mail($confirmEmail, $subject, $message, $headers) or die("<span class=err>"._REGISTER_EMAIL_FAILED."</span>");
         $newpass=md5($newpass);
         $query="update ".$dbprefix."users set password='$newpass' where username='$checkusername' and usertype='user'";
         $database->openConnectionNoReturn($query);
         echo '&nbsp;&nbsp;<BR><BR><B>'._NEWPASS_SENT.'</B>';
      }
   }

   function _makePass() {
      $makepass="";
      $syllables="er,in,tia,wol,fe,pre,vet,jo,nes,al,len,son,cha,ir,ler,bo,ok,tio,nar,sim,ple,bla,ten,toe,cho,co,lat,spe,ak,er,po,co,lor,pen,cil,li,ght,wh,at,the,he,ck,is,mam,bo,no,fi,ve,any,way,pol,iti,cs,ra,dio,sou,rce,sea,rch,pa,per,com,bo,sp,eak,st,fi,rst,gr,oup,boy,ea,gle,tr,ail,bi,ble,brb,pri,dee,kay,en,be,se";
      $syllable_array=explode(",", $syllables);
      mt_srand((double)microtime()*1000000);
      for ($count=1;$count<=4;$count++) {
         if (mt_rand()%10 == 1) {
            $makepass .= sprintf("%0.0f",(mt_rand()%50)+1);
         } else {
            $makepass .= sprintf("%s",$syllable_array[mt_rand()%62]);
         }
      }
      return($makepass);
   }

}
?>