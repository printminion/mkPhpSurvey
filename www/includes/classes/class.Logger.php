<?
/**
 *
 *
 * @version $Id:$
 * @package mkSurvey
 *
 **/
include_once(LANGUAGE_PATH.'/lang_usermenu.php');
define('USERTYPEID_NONE',0);
define('USERTYPEID_USER',1);
define('USERTYPEID_ADMIN',2);
define('USERTYPEID_SUPERADMIN',3);

class Logger {
   /**
    * Flag to indicate if user is logged
    *
    * @var bool
    */
   var $bLogged;
   var $lUserId = 0;
   //         var $strUserType;

   /**
    * Flag to indicate if user is admin
    *
    * @var bool
    */
   var $bAdmin;
   var $lUserType = 0;
   var $strUserNick;

   /**
    * Reference to database object
    *
    * @var Database
    */
   var $database;
   /**
    * Just logged flag
    *
    * @var bool
    */
   var $_bJustLogged = false;

//   var $_UserTypeString;


   /**
    * Logger constructor
    *
    * @return Logger
    */
   function Logger() {
      global $db, $host, $user, $password,$dbprefix,$_COOKIE,$database,$absolute_path,$usercookie,$_SESSION;

      //      print_r($_SESSION);

      if ($_SESSION["oLogger"]!=""){
         $oLogger = $_SESSION["oLogger"];
      }else{
         $_SESSION["oLogger"] = $oLogger;
      }

      $this->bLogged = 0;

      //      include_once ("configuration.php");
      //      $link=mysql_connect($host, $user, $password);
      //      mysql_select_db($db) or die("Query failed with error: ".$query.mysql_error());

      //      $list=mysql_connect($host, $user, $password);
      //      mysql_select_db($db) or die("Query failed with error: ".mysql_error());

      //      $gidType = $this->checkaccess($_COOKIE["usercookie"], $db, $dbprefix);
      //      $gid     = $this->checkaccess_uid($_COOKIE["usercookie"], $db, $dbprefix);

      $gidType = $this->checkaccess($_SESSION["usercookie"], $db, $dbprefix);
      $gid     = $this->checkaccess_uid($_SESSION["usercookie"], $db, $dbprefix);


      //      echo "usercookie:".$_SESSION["usercookie"]."<br>";
      //      $gidType = $this->checkaccess($_SESSION["usercookie"], $db, $dbprefix);
      //      $gid     = $this->checkaccess_uid($_SESSION["usercookie"], $db, $dbprefix);


      //
      //         echo "<pre>";
      //         print_r($_COOKIE);
      //      echo "gid:".$gid."<br>";
      //      echo "i_uid:".$i_uid."<br>";
      //      debug_sql("$gid : $gidType ");

      if ($database == null){
         if(!class_exists("database")){
            include_once(CLASSES_PATH."/database.php");
         }

         $database = new database();
         $this->database =& $database;
      }

      if ($gid != 0){
         $this->bLogged = true;
         $this->lUserId = $gid;
         $this->lUserType = $gidType;

         ###################
         # get User Info
         $query="SELECT u.*
                   FROM ".$dbprefix."users u
                  WHERE u.id='$gid'";
         $result=$database->openConnectionWithReturn($query);
         if (mysql_num_rows($result)!=0){
            $resUser = mysql_fetch_array($result);
            //            print_r($resUser);
            $this->strUserNick = $resUser['username'];
         }
         if ($this->lUserType == 2) {
            $this->bAdmin = true;
         }
         #
         ##################
      }

      //      print_r($_SESSION["oLogger"]);
      $_SESSION["oLogger"] = $oLogger;
      //      print_r($_SESSION["oLogger"]);
   }


   /**
    * Do login of user
    *
    * @param string $userNick
    * @param string $userPasswort
    * @param string $urlLoginSuccess
    * @param string $urlLoginFailed
    */
   function doLogin($userNick, $userPasswort, $urlLoginSuccess = null, $urlLoginFailed = null){
      global $database, $dbprefix, $_COOKIE, $_SESSION;

//      debug_sql("doLogin($userNick, $userPasswort, $urlLoginSuccess, $urlLoginFailed)");

      $username = $userNick;
      $passwd   = $userPasswort;

      if ($database == null){
         if(!class_exists("database")){
            include_once(CLASSES_PATH."/database.php");
         }
         $database = new database();
         $this->database =& $database;
      }

      if ((trim($username)=="") || (trim($passwd)=="")){
         //echo "<SCRIPT> alert(\""._LOGIN_INCOMPLETE."\"); window.history.go(-1); </SCRIPT>\n";
         $this->relocate($urlLoginFailed."&msg="._LOGIN_INCOMPLETE);
      }else{
         $passwd   = md5($passwd);
         //         debug_sql($passwd,'$passwd');
         $sqlQuery = "SELECT id,
                             gid,
                             block,
                             usertype
                        FROM ".$dbprefix."users
                       WHERE username='$username'
                         AND password='$passwd'";

//            debug_sql($sqlQuery);

         $result=$database->openConnectionWithReturn($sqlQuery);
         if (mysql_num_rows($result)!=0){

            list($uid, $gid, $block, $usertype)=mysql_fetch_array($result);

//               debug_sql("$uid, $gid, $block, $usertype",'user found');

            if ($block == 1){
               //               $this->recordLogin($uid, $username, "blocked", $database, $dbprefix); //Added by fnacer 4/27/03
               //echo "<SCRIPT>alert(\""._LOGIN_BLOCKED."\"); window.history.go(-1); </SCRIPT>\n";
               $this->relocate($urlLoginFailed."&msg=_LOGIN_BLOCKED");
            }else{
               //recordLogin($uid, $username, "login", $database, $dbprefix); //Added by fnacer 4/27/03
               //               $firstLogin=$this->recordLogin($uid, $username, "login", $database, $dbprefix); //Added by fnacer 4/27/03

               //               debug_sql('user is not blocked');
               //               debug_obj($_SESSION,'$_SESSION');

               //session exist
               if ($_SESSION["sessioncookie"]!=""){
                  //                  debug_sql('sessioncookie is NOT null');
                  //if ($_COOKIE["sessioncookie"]!=""){
                  //        if ($_SESSION["sessioncookie"]!=""){

                  $sessionID=$_SESSION["sessioncookie"];
                  //                  $sessionID=$_COOKIE["sessioncookie"];
                  //$sessionID=$_SESSION["sessioncookie"];


                  $query="SELECT session_id
                            FROM ".$dbprefix."session
                           WHERE session_id='$cryptSessionID'";

                  $result=$database->openConnectionWithReturn($query);
                  if (mysql_num_rows($result)==0){
                     //No session Exist Create new
                     //                     debug_sql('No DB session Exist Create new');
                     $existSessionID=0;
                     while ($existSessionID==0){
                        $sessionID=$this->getSessionID();
                        if ($sessionID!=""){
                           $cryptSessionID=md5($sessionID);
                           $query="SELECT session_id
                                     FROM ".$dbprefix."session
                                    WHERE session_id='$cryptSessionID'";
                           $result=$database->openConnectionWithReturn($query);
                           if (mysql_num_rows($result)==0){
                              $existSessionID=1;
                           }
                        }

                        if ($existSessionID==1){
                           $query="INSERT into ".$dbprefix."session
                      SET session_id='$cryptSessionID',
                            guest='',
                        userid='$uid',
                          usertype='$usertype',
                      gid='$gid',
                      username='$username'";
                           $database->openConnectionNoReturn($query);

                           //                           setcookie("sessioncookie", "$sessionID");
                           //setcookie("sessioncookie", "$sessionID",0,LIVE_SITE_COOKIE_PATH,LIVE_SITE_COOKIE);
                           $_SESSION['sessioncookie'] = $sessionID;
                           $sessioncookie=$sessionID;
                        }
                     }

                  }else{
                     $cryptSessionID=md5($sessionID);
                     $query="UPDATE ".$dbprefix."session
                        SET guest=0,
                      username='$username',
                      userid='$uid',
                      usertype='$usertype' ,
                      gid='$gid'
                      WHERE session_id='$cryptSessionID'";
                     $database->openConnectionWithReturn($query);
                  }

               }else{
                  $existSessionID=0;
                  while ($existSessionID==0){
                     $sessionID=$this->getSessionID();
                     if ($sessionID!=""){
                        $cryptSessionID=md5($sessionID);
                        $query="SELECT session_id
                    FROM ".$dbprefix."session
                   where session_id='$cryptSessionID'";
                        $result=$database->openConnectionWithReturn($query);
                        if (mysql_num_rows($result)==0){
                           $existSessionID=1;
                        }
                     }
                  }

                  if ($existSessionID==1){
                     $query="INSERT into ".$dbprefix."session
                  set session_id='$cryptSessionID',
                      guest='',
                      userid='$uid',
                      usertype='$usertype',
                      gid='$gid',
                      username='$username'";
                     $database->openConnectionNoReturn($query);

                     $_SESSION['sessioncookie'] = $sessionID;
                     $sessioncookie = $sessionID;
                  }

               }

               $lifetime= (time() + 43200);

               $_SESSION["usercookie"] = $sessionID;
               $usercookie=$sessionID;

               $this->bLogged           = true;
               $this->lUserId           = $uid;
               $this->lUserType         = $gid;
               $this->_UserTypeString   = $usertype;

               $this->strUserNick = $username;
               if ($this->lUserType == 2) {
                  $this->bAdmin = true;
               }

               $this->_bJustLogged = true;

               $_SESSION['oLogger'] = $this;
               //print "<SCRIPT>document.location.href='index.php?option=$option'</SCRIPT>\n";

               //echo "firstLogin:".$firstLogin;
               //die;
               //kupriyanov.de
               if ($firstLogin==1){
                  //echo "<SCRIPT>document.location.href = 'index.php?option=user&op=ud_ab'; </SCRIPT>\n";
                  //$this->relocate(LIVE_SITE_URL."/index.php?option=user&op=ud_ab");
                  $this->relocate($urlLoginSuccess."&info=firstLogin");
               }else{
                  //print "<SCRIPT>document.location.href='index.php?option=$option'</SCRIPT>\n";
                  $this->relocate($urlLoginSuccess);
               }
               //-----------------------

            }
         }else{
            //            $this->recordLogin(0, $username, "failed", $database, $dbprefix); //Added by fnacer 4/27/03
            //echo "<SCRIPT>alert(\""._LOGIN_INCORRECT."\"); window.history.go(-1); </SCRIPT>\n";
            $this->relocate($urlLoginFailed."&msg=_LOGIN_INCORRECT");
         }
      }
   }


   //Start of code Added by fnacer 4/27/03 ----------------------------------------------------------------
   /**
   * record of user login
   *
   * @param long $uid
   * @param string $username
   * @param string $logintype login, blocked, failed
   * @param database $database
   * @param string $dbprefix
   * @return bool
   */
   function recordLogin($uid, $username, $logintype, $database, $dbprefix){
      $firstLogin=0;

      define(DEFAULT_CREATED,'1/1/1980');

      if ($database == null){
         if(!class_exists("database")){
            include_once(CLASSES_PATH."/database.php");
         }
         $database = new database();
         $this->database =& $database;
      }

      if ($uid==0){
         $query="SELECT id from ".$dbprefix."users where username='$username'";
         $result=$database->openConnectionWithReturn($query);
         if (mysql_num_rows($result)!=0) list($uid)=mysql_fetch_array($result);
      } else {
         //$query="SELECT id from ".$dbprefix."users2 where uid=$uid";
         $query="SELECT id, logincount from ".$dbprefix."users2 where uid=$uid";
         $result=$database->openConnectionWithReturn($query);
         list($id,$logincount)=mysql_fetch_array($result);
         if (mysql_num_rows($result)==0){
            $query="INSERT INTO ".$dbprefix."users2 (uid, created) VALUES ($uid,0)";
            $database->openConnectionNoReturn($query);
         }else{
            if ($logincount==0) $firstLogin=1;
         }

         //   echo "logincount:".$logincount;
         //   echo "firstLogin:".$firstLogin;
         //die;
      }
      $query = "";
      switch ($logintype){
         case "blocked":
            $query="UPDATE ".$dbprefix."users2 SET lastblockedlogin=now(), blockedlogincount=blockedlogincount+1 WHERE uid=$uid";
            break;
         case "login":
            $query="UPDATE ".$dbprefix."users2 SET lastlogin=now(), logincount=logincount+1 WHERE uid=$uid";
            break;
         case "failed":
            if ($uid!=0) $query="UPDATE ".$dbprefix."users2 SET lastfailedlogin=now(), failedlogincount=failedlogincount+1 WHERE uid=$uid";
            break;
         default:
      }
      if ($query!="") $database->openConnectionNoReturn($query);

      return $firstLogin;
   }
   //End of code Added by fnacer 4/27/03 -----------------------------------------------------------------


   /**
    * Get random session id
    *
    * @return string
    */
   function getSessionID(){
      mt_srand ((double) microtime() * 1000000);
      $pass_len = mt_rand (20,40);
      $allchar = "abcdefghijklnmopqrstuvwxyzABCDEFGHIJKLNMOPQRSTUVWXYZ0123456789";
      $str = "" ;
      for ( $i = 0; $i<$pass_len ; $i++ ){
         $str .= substr( $allchar, mt_rand (0,62), 1 ) ;
      }
      $timestamp= time();
      $str=$str.$timestamp;
      return($str);
   }

   /**
    * Return Relocation header
    *
    * @param string $url
    */
   function relocate($url){
      //      debug_sql(SMARTY_DEBUG,'SMARTY_DEBUG');
      if (SMARTY_DEBUG){
         if(headers_sent()){
            echo "WARNING: Headers has been already sent [<a href='$url'>$url</a>]";
            print_r('<pre>');
            print_r(debug_backtrace());
         }else{
            header("Location: ".$url);
         }
         die();
      }else{
         if(headers_sent()){
            echo "WARNING: Headers has been already sent. Try to click here [<a href='$url'>$url</a>]";
         }else{
            header("Location: ".$url);
         }
      }
      //echo "Location: ".$url;
//      header("Location: ".$url);
//      die();
   }

   /**
    * procees with logout
    *
    * @param string $urlSuccess
    */
   function doLogout($urlSuccess = null){
      global $_COOKIE,$dbprefix,$database,$_SESSION;

      if ($database == null){
         if(!class_exists("database")){
            include_once(CLASSES_PATH."/database.php");
         }
         $database = new database();
         $this->database =& $database;
      }

      //      $cryptSessionCookie=md5($_COOKIE["sessioncookie"]);
      $cryptSessionCookie=md5($_SESSION["sessioncookie"]);
      //      $cryptSessionCookie=md5($_SESSION["sessioncookie"]);

      if ($database==null){
         $database = new database();
      }

      $query="UPDATE ".$dbprefix."session
             SET guest=1, username='', userid='', usertype='', gid=''
           WHERE session_id='$cryptSessionCookie'";
      $database->openConnectionNoReturn($query);

      //      setcookie("usercookie", "");
      //      setcookie("sessioncookie", "");

      //      setcookie("usercookie", "",0,LIVE_SITE_COOKIE_PATH,LIVE_SITE_COOKIE);
      //      setcookie("sessioncookie", "",0,LIVE_SITE_COOKIE_PATH,LIVE_SITE_COOKIE);
      //
      //      $_SESSION["usercookie"] = "expired";

      $_SESSION['usercookie']    = '';
      //$_SESSION['sessioncookie'] = '';

      $this->bLogged   = false;
      $this->lUserId   = 0;
      $this->lUserType = 0;
      $this->_UserTypeString = '';

      //      unset($this->lUserId);
      //      unset($this->lUserType);
      unset($this->bAdmin);
      unset($this->strUserNick);
      $_SESSION["oLogger"] = $this;

      if ($urlSuccess!=""){
         //echo "Location: ".$urlSuccess;
         $this->relocate($urlSuccess);
      }

   }

   /**
    * Flag to check tf its first page after user logged
    *
    * @return bool
    */
   function IsJustLogged(){
      if($this->_bJustLogged){
         $this->_bJustLogged = false;
         return true;
      }else{
         return false;
      }
   }

   /**
    * Check if user logged
    *
    * @param string $cook
    * @param stringe $db database object
    * @param string $dbprefix prefix of database tables "mos_"
    * @return bool
    */
   function checkaccess($cook, $db, $dbprefix){
      global $database,$dbprefix;

      /* Get the visitor's GroupID */
      $gidf = 0;
      if ($cook<>""){
         $cryptSessionID=md5($cook);
         $queryg = "SELECT gid
            FROM ".$dbprefix."session
           WHERE session_ID='$cryptSessionID'";

         //$resultg = mysql_db_query($db, $queryg) or die("Did not execute query");
         $resultg = $database->openConnectionWithReturn($queryg);
         while ($rowg = mysql_fetch_object($resultg)){
            $gidf = $rowg->gid;
         }
      }


      if ($this->IsLogged() && $gidf==0){
         $this->doLogout();
      }

      //      debug_sql($gidf,'$gidf');
      return $gidf;
   }



   /**
    * check if user logged
    *
    * @param string $cook
    * @param string $db
    * @param string $dbprefix
    * @return int
    */
   function checkaccess_uid($cook, $db, $dbprefix){
      global $database,$dbprefix;
      /* Get the visitor's GroupID */
      $useridf = 0;
      if ($cook<>""){
         $cryptSessionID=md5($cook);
         $queryg = "SELECT gid,
                 userid
            FROM ".$dbprefix."session
             WHERE session_ID='$cryptSessionID'";
         //         $resultg = mysql_db_query($db, $queryg) or die("Did not execute query");
         $resultg = $database->openConnectionWithReturn($queryg);

         while ($rowg = mysql_fetch_object($resultg)){
            $gidf    = $rowg->gid;
            $useridf = $rowg->userid;
         }
      }

      if ($this->IsLogged() && $useridf==0){
         $this->doLogout();
      }

      //      debug_sql($useridf,'$useridf');
      return $useridf;
   }

   /**
    * Check if user logged
    *
    * @param string $userNick
    * @param long $userId
    * @return boolean
    */
   function checkIfUserLoggedByNick($userNick = null,&$userId){
      global $dbprefix, $database;

      $this->lastError = null;
      $userId = null;

      if($userNick == null){
         $this->lastError = ERROR_REQUIRED_INPUT_USERNICK_IS_NULL;
         return null;
      }


      //      echo "1156112240<br>";
      //      echo time()."<br>";
      //      echo (time()+30*60)."<br>";
      //      $nextWeek = time() + (7 * 24 * 60 * 60);
      //                   // 7 days; 24 hours; 60 mins; 60secs
      //
      //      echo 'Next Week: '. date('Y-m-d H:i:s', "1156112240") ."<br>\n";
      //      echo 'Next Week: '. date('Y-m-d H:i:s', (1156112240+30*60)) ."<br>\n";
      //      echo 'Next Week: '. date('Y-m-d H:i:s', time()) ."<br>\n";
      //      die();

      $sqlQuery = "SELECT userid
                     FROM ".$dbprefix."session
                     WHERE username LIKE '".$userNick."'
                       AND time > ".(time()-30*60);

      //      debug_sql($sqlQuery);

      $result = $database->openConnectionWithReturn($sqlQuery);

      if ($userInfo = mysql_fetch_array($result)){
         $userId = $userInfo['userid'];
         return true;
      }

      return false;

   }

   /**
    * Check if user logged
    *
    * @return boolean
    */
   function IsLogged(){
      return $this->bLogged;
   }

   /**
    * Check if logged user is Admin
    *
    * @return bool
    */
   function IsAdmin(){
      return $this->bAdmin;
   }

   /**
    * @return long
    */
   function getUserId(){
      return $this->lUserId;
   }

   /**
    * Gets nich of logged user
    *
    * @return string
    */
   function getUserNick(){
      return $this->strUserNick;
   }

   /**
    * Get type of logged user
    *
    * @return long
    */
   function getUserType(){
      return $this->lUserType;
   }
}
?>