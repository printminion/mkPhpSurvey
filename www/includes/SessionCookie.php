<?php
/**
 * 
 * 
 * @version  $Id:$
 * 
 * 
 **/

$past = time()-1800;
//debug_sql($dbprefix);

$query="DELETE FROM ".$dbprefix."session
			  WHERE (time < $past)";

$database->openConnectionNoReturn($query);
$current_time = time();
//if ($HTTP_COOKIE_VARS["sessioncookie"]==""){
if ($_SESSION["sessioncookie"]==""){
   while (true){
      $randnum=getSessionID1();
      if ($randnum!=""){
         $cryptrandnum=md5($randnum);
         $query = "SELECT session_id
						FROM ".$dbprefix."session 
					   WHERE session_id='$cryptrandnum'";
         $result=$database->openConnectionWithReturn($query);
         if (mysql_num_rows($result)==0){
            break;
         }
      }
   }
   $lifetime = (time() + 43200);
   //	setcookie("sessioncookie", "$randnum");
   //setcookie("sessioncookie", "$randnum",0,LIVE_SITE_COOKIE_PATH,LIVE_SITE_COOKIE);
   $_SESSION['sessioncookie'] = $randnum;

   $guest=1;
   $query = "INSERT into ".$dbprefix."session
				 SET username = '', 
				     time = $current_time, 
  					 session_id = '$cryptrandnum', 
					 guest = $guest";
   $database->openConnectionNoReturn($query);
} else {
   //$cryptSessionCookie=md5($HTTP_COOKIE_VARS["sessioncookie"]);
   $cryptSessionCookie=md5($_SESSION["sessioncookie"]);

   if ($option=="logout"){
      $query = "UPDATE ".$dbprefix."session
				     SET guest=1, 
						 username='', 
						 userid='', 
						 usertype='', 
						 gid='' 
				   where session_id = '$cryptSessionCookie'";
      $database->openConnectionNoReturn($query);
   } else {
      $query = "SELECT username
				    FROM ".$dbprefix."session 
				   WHERE session_id='$cryptSessionCookie'";

      $result=$database->openConnectionWithReturn($query);
      if (mysql_num_rows($result)> 0){
         list ($username)=mysql_fetch_array($result);
         if ($username != ''){
            //$sessionID=$HTTP_COOKIE_VARS["sessioncookie"];
            $sessionID = $_SESSION["sessioncookie"];
            //				setcookie("usercookie", "$sessionID");
            //				setcookie("usercookie", "$sessionID",0,LIVE_SITE_COOKIE_PATH,LIVE_SITE_COOKIE);
            //				$HTTP_COOKIE_VARS["usercookie"]=$sessionID;
            $_SESSION["usercookie"] = $sessionID;
         }
         $query = "UPDATE ".$dbprefix."session
					     SET username='$username', 
							 time=$current_time 
					   WHERE session_id='$cryptSessionCookie'";
         $database->openConnectionNoReturn($query);
      } else {
         $option=="";
         while (true){
            $randnum=getSessionID1();
            if ($randnum!=""){
               $cryptrandnum=md5($randnum);
               $query = "SELECT session_id
								FROM ".$dbprefix."session 
							   WHERE session_id='$cryptrandnum'";
               $result=$database->openConnectionWithReturn($query);
               if (mysql_num_rows($result)==0){
                  break;
               }
            }
         }
         $lifetime = (time() + 43200);
         //			setcookie("sessioncookie", "$randnum");
         //			setcookie("sessioncookie", "$randnum",0,LIVE_SITE_COOKIE_PATH,LIVE_SITE_COOKIE);
         $_SESSION['sessioncookie'] = $randnum;
         $guest=1;
         $query="INSERT into ".$dbprefix."session
					   SET username = '', 
						   time = $current_time, 
						   session_id = '$cryptrandnum', 
						   guest = $guest";
         $database->openConnectionNoReturn($query);
      }
   }
}

function getSessionID1(){
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
?>
