<?php 
/**
*       Mambo Open Source Version 4.0.12
*       Dynamic portal server and Content managment engine
*       03-02-2003
*
*       Copyright (C) 2000 - 2003 Miro International Pty. Limited
*       Distributed under the terms of the GNU General Public License
*       This software may be used without warranty provided these statements are left
*       intact and a "Powered By Mambo" appears at the bottom of each HTML page.
*       This code is Available at http://sourceforge.net/projects/mambo
*
*       Site Name: Mambo Open Source Version 4.0.12
*       File Name: regglobals.php
*	Developer : Emir Sakic
*       Date: 09-02-2003
*       Version #: 4.0.12
*       Comments: Support for register_globals Off in php.ini 
**/

//phpinfo();
//debug_sql(ini_get('register_globals'),'register_globals');

if (!ini_get('register_globals')) {
    session_name (SITE_SESSION_NAME);
    session_set_cookie_params(0 , LIVE_SITE_COOKIE_PATH, LIVE_SITE_COOKIE);
    session_start();
    $raw = phpversion();
    list($v_Upper,$v_Major,$v_Minor) = explode(".",$raw);
    //check if its php version 4.1
    if(($v_Upper <= 4 && $v_major < 1) || $v_Upper < 4){
        $_FILES = $HTTP_POST_FILES;
        $_ENV = $HTTP_ENV_VARS;
        $_GET = $HTTP_GET_VARS;
        $_POST = $HTTP_POST_VARS;
        $_COOKIE = $HTTP_COOKIE_VARS;
        $_SERVER = $HTTP_SERVER_VARS;
        $_SESSION = $HTTP_SESSION_VARS;
        $_FILES = $HTTP_POST_FILES;
    }
    while(list($key,$value)=each($_FILES)) $GLOBALS[$key]=$value;
    while(list($key,$value)=each($_ENV)) $GLOBALS[$key]=$value;
    while(list($key,$value)=each($_GET)) $GLOBALS[$key]=$value;
    while(list($key,$value)=each($_POST)) $GLOBALS[$key]=$value;
    while(list($key,$value)=each($_COOKIE)) $GLOBALS[$key]=$value;
    while(list($key,$value)=each($_SERVER)) $GLOBALS[$key]=$value;
    while(list($key,$value)=each($_SESSION)) $GLOBALS[$key]=$value;
	foreach((array)$_FILES as $key => $value) {
		$GLOBALS[$key]=$_FILES[$key]['tmp_name'];
		foreach((array)$value as $ext => $value2) {
			$key2 = $key."_".$ext;
			$GLOBALS[$key2]=$value2;
		}
	}
}else{
    session_name(SITE_SESSION_NAME);
    session_set_cookie_params(0 , LIVE_SITE_COOKIE_PATH, LIVE_SITE_COOKIE);
    session_start();
}
?>