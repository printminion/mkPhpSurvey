<?php
/**
 * @version $Id:$
 *
 */
 
/*
chmod 777 templates_c/
chmod 777 _tmp/
chmod 777 cache_s/
*/
if (file_exists(getcwd()."/configuration.local.php")){
   include_once(getcwd()."/configuration.local.php");
}



define('IS_ONLINE',true); //switch between local and online mode
define('SITE_LANG','dei');

include_once("configuration.db.php");

setlocale (LC_TIME, "de_DE"); // Country locale
define('LANG','dei');// Site language

define('SITE_CSS','admin.css');
define('LIVE_SITE_ADMIN_EMAIL','cr@russenreaktor.de');

##############################
# set values for class UserOfficer
define('MAILER_RETURN_PATH','noreply@russenreaktor.de');
#
##############################

define('PRODUCT_NAME','mkSurvey');
define('APP_VERSION', '0.4');
define('APP_DESIGN_VERSION', '0.1');

if (IS_ONLINE){
   session_save_path('/tmp');
   //cookie stuff
   define('LIVE_SITE','http://www.hs-esslingen.de/~mimait04/semar'); // No trailing slash
   define('LIVE_SITE_URL',"http://www.hs-esslingen.de/~mimait04/semar"); // No trailing slash
   define('DIR_WS_ICONS', LIVE_SITE_URL."/images/icons/");
   define('LIVE_SITE_COOKIE_PATH','/');
   define('LIVE_SITE_COOKIE','.hs-esslingen.de');
   define('SITE_SESSION_NAME','mkurvey');
   define('UPLOADDIR',"/tmp/"); // No trailing slash

}else{
   define('LIVE_SITE','http://dev2.RussenReaktor.de/semar/www'); // No trailing slash
   define('LIVE_SITE_URL','http://dev2.RussenReaktor.de/semar/www'); // No trailing slash
   define('DIR_WS_ICONS', LIVE_SITE_URL."/images/icons/");
   //cookie stuff
   define('LIVE_SITE_COOKIE_PATH','/');
   define('LIVE_SITE_COOKIE','dev2.russenreaktor.de');
   define('SITE_SESSION_NAME','mkurvey');
   define('UPLOADDIR',ABSOLUTE_PATH.'/_uploads'); // No trailing slash      
}


//   ini_set("browscap","/srv/www/vhosts/russenreaktor.de/conf/php_browscap.ini");
//define('ABSOLUTE_PATH',getcwd()); // No trailing slash
define('ABSOLUTE_PATH',dirname(__FILE__)); // No trailing slash

#captcha ttf folder
define('TTF_PATH',ABSOLUTE_PATH.'/includes/ttfs/');//with trailing slash
#captcha temp folder
define('TEMP_PATH',ABSOLUTE_PATH."/_tmp/");//with trailing slash

define('CLASSES_PATH',ABSOLUTE_PATH."/includes/classes");// No trailing slash
define('COM_PATH',ABSOLUTE_PATH."/com/");

define('PATH_TEMPLATES',ABSOLUTE_PATH."/templates");// No trailing slash
define('PATH_SURVEYS',ABSOLUTE_PATH."/surveys/");
define('COMPONENTS_PATH',ABSOLUTE_PATH.'/includes/components');// No trailing slash

define('LANGUAGE_PATH',ABSOLUTE_PATH.'/includes/language/'.SITE_LANG);// No trailing slash

##################################
# Jpgraph
define('TTF_DIR',ABSOLUTE_PATH.'/includes/ttfs/');#jpgraph ttf folder with trailing slash
define('JPGRAPH_CLASS_PATH',CLASSES_PATH.'/jpgraph/');
#
##################################


#########################################
# Captcha
define('CAPTCHA_PREFIX','captcha_');
define('CAPTCHA_SECRETSTRING',PRODUCT_NAME);
#
#########################################

define('BASE_URL_DESIGN', LIVE_SITE_URL.'/s/v/'.APP_DESIGN_VERSION.'');
define('PATH_DESIGN_IMG', LIVE_SITE_URL.'/s/v/'.APP_DESIGN_VERSION.'');
define('PATH_DESIGN_STYLES', LIVE_SITE_URL.'/s/v/'.APP_DESIGN_VERSION.'/styles'); // No trailing slash

##########################################
# Smarty Configuration
define('SMARTY_CACHING',false);
define('SMARTY_CACHE_DIR',ABSOLUTE_PATH.'/cache_c');
define('SMARTY_PLUGINS_DIR',ABSOLUTE_PATH.'/includes/smarty_plugins');
#
##########################################


##########################################
# debug stuff
define('SMARTY_DEBUG',false);
define('DIR_DEBUG_PATH',LIVE_SITE_URL."/");

if(SMARTY_DEBUG){
   #if already set dont override
   //   echo "mk_debug_on:".$mk_debug_on;
   if (!$mk_debug_on){
      $mk_debug_on = true; //enable to see debug output
   }
   include_once(ABSOLUTE_PATH."/mk_tools/includes/mk_debug.php");
}else{
   $mk_debug_on = false; //enable to see debug output
   include_once(ABSOLUTE_PATH."/mk_tools/includes/mk_debug.php");
}



if ($_SERVER['REMOTE_ADDR'] == "127.0.0.1" ||
$_SERVER['REMOTE_ADDR'] == "62.96.72.66" ||
$_SERVER['REMOTE_ADDR'] == "134.108.34.9"){
   $mk_debug_on = true; //enable to see debug output
}

#
##########################################


##########################################
#xajaxs configuration
define('_SURA_DEFAULT_ENCODING',"UTF-8");
#
##########################################
##########################################
#xajaxs configuration
define('FILE_JQUERY','jquery-1.2.1.pack.js');
#
##########################################





//*************************************************************************
//*              Do not change ANYTHING below this line !!!               *
//*************************************************************************
define('DOCTYPE_TRANSITIONAL','EN');
define('CFG_META_CONTENT_TYPE', "text/html; charset=UTF-8");
define('CFG_META_AUTHOR', "m@kupriyanov.com - mkSuvey");
define('CFG_META_KEYWORDS', "iso, survey, test, usability");
define('CFG_META_DESCRIPTION', "ISO Tests");

//*************************************************************************
//*              Do not change ANYTHING below this line !!!               *
//*************************************************************************
$local_backup_path   = ABSOLUTE_PATH.'/administrator/backups';
$pdf_path            = ABSOLUTE_PATH.'/pdf/';

include_once(ABSOLUTE_PATH."/version.php");

?>