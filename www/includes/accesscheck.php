<?php
/**
 *	Mambo Open Source Version 4.0.12
 *	Dynamic portal server and Content managment engine
 *
 *	Copyright (C) 2000 - 2003 Miro International Pty. Limited
 *	Distributed under the terms of the GNU General Public License
 *	This software may be used without warranty provided these statements are left
 *	intact and a "Powered By Mambo" appears at the bottom of each HTML page.
 *	This code is Available at http://sourceforge.net/projects/mambo
 *
 *	Site Name: Mambo Open Source Version 4.0.12
 *	File Name: accesscheck.php
 *	Date: 10-12-2002
 * 	@version $Id:$
 *	Comments:
 **/



#######################################
#  mk:Logger
//if (!class_exists('Logger')){
//   include_once ($absolute_path."/classes/class.Logger.php");
//}
//
//if ($oLogger==null){
//   $oLogger = new Logger();
//}
//debug_obj($oLogger);


//if($_GET['cookie']['usercookie'] != ""){
//   //   setcookie("sessioncookie", $_GET['cookie']['usercookie']);
//   //   setcookie("usercookie", $_GET['cookie']['usercookie']);
//   //   setcookie("sessioncookie", $_GET['cookie']['usercookie'],0,LIVE_SITE_COOKIE_PATH,LIVE_SITE_COOKIE);
//   //   setcookie("usercookie", $_GET['cookie']['usercookie'],0,LIVE_SITE_COOKIE_PATH,LIVE_SITE_COOKIE);
//
//   $_SESSION['sessioncookie'] = $_GET['cookie']['usercookie'];
//   $_SESSION['usercookie']    = $_GET['cookie']['usercookie'];
//
//   $strRelocate = str_replace("&cookie[usercookie]=".$_GET['cookie']['usercookie'], "", $SCRIPT_URI."?".$QUERY_STRING);
//   $oLogger->relocate($strRelocate);
//}

if($_GET['logout']!="" || $_GET['action']=="logout"){
   //echo "logout";
   
   if($_GET['logout']['url_success'] != ''){
      $urlSuccess = $_GET['logout']['url_success'];
   }
   
   if($_GET['continue'] != ''){
      $urlSuccess = $_GET['continue'];
   }
   
   $oLogger->doLogout($urlSuccess);
}

//debug_obj($_POST,'POST-accesscheck',true);
//debug_obj($_GET,'GET-accesscheck',true);

if($_POST['action']=="login"){
   //echo "logout";
   if($_POST['login']['url_success']==''){
      $_POST['login']['url_success'] = LIVE_SITE_URL.'/index.php?option=doadmin';
   }

   if($_POST['login']['url_failed']==''){
      $_POST['login']['url_failed'] = LIVE_SITE_URL.'/index.php?';
   }
    
   
//   debug_obj($oLogger,'$oLogger');
   
   $oLogger->doLogin($_POST['login']['u'],
   $_POST['login']['p'],
   $_POST['login']['url_success'],
   $_POST['login']['url_failed']);

//   debug_obj($oLogger,'$oLogger');
   
}
//debug_obj($_POST,'$_POST');

//if($oLogger->IfLogged()){
//   $oLogger->doLogout($_GET['logout']['url_success']);
//}
#  /mk:Logger
#######################################

function checkaccess($cook, $db, $dbprefix){
   global $oLogger;
    
   if ($oLogger == null){
      return false;
   }
    
      return $oLogger->checkaccess($cook, $db, $dbprefix);
    
//   if ($oLogger->IsLogged()){
//      return $oLogger->getUserType();
//   }
   
   return 0;

   //   /* Get the visitor's GroupID */
   //   $gidf = 0;
   //   if ($cook<>""){
   //      $cryptSessionID=md5($cook);
   //      $queryg = "SELECT gid FROM ".$dbprefix."session WHERE session_ID='$cryptSessionID'";
   //      $resultg = mysql_db_query($db, $queryg) or die("Did not execute query");
   //      while ($rowg = mysql_fetch_object($resultg)){
   //         $gidf = $rowg->gid;
   //      }
   //   }
   //   return $gidf;
}

function checkaccess_uid($cook, $db, $dbprefix){

   global $oLogger;
    
   if ($oLogger == null){
      return false;
   }
    
   return $oLogger->checkaccess_uid($cook, $db, $dbprefix);
    
//   if ($oLogger->IsLogged()){
//      return $oLogger->getUserId();
//   }
   
   return 0;
    
    
   //   /* Get the visitor's GroupID */
   //   $useridf = 0;
   //   if ($cook<>""){
   //      $cryptSessionID=md5($cook);
   //      $queryg = "SELECT gid,userid FROM ".$dbprefix."session WHERE session_ID='$cryptSessionID'";
   //      $resultg = mysql_db_query($db, $queryg) or die("Did not execute query");
   //      while ($rowg = mysql_fetch_object($resultg)){
   //         $gidf = $rowg->gid;
   //         $useridf = $rowg->userid;
   //      }
   //   }
   //   return $useridf;
}

?>