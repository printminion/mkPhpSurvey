<?
/**
 *
 * Index file
 *
 * @version $Id:$ 
 * @copyright
 * @author
 *
 */
error_reporting(E_ERROR | E_WARNING | E_PARSE);

include_once('configuration.php');

include_once(ABSOLUTE_PATH.'/require_all.php');
include_once(ABSOLUTE_PATH.'/includes/SessionCookie.php');

#include XAJAX functions
require_once(ABSOLUTE_PATH.'/xa/sur.common.php');
require_once(ABSOLUTE_PATH.'/includes/smarty/libs/Smarty.class.php');

//echo 'action:'.$_GET['action'];

$database->setDebugOn(SMARTY_DEBUG);

$smarty = new Smarty();

if (defined('SMARTY_PLUGINS_DIR')){
   $smarty->plugins_dir = array('plugins',SMARTY_PLUGINS_DIR);
}
$smarty->caching = SMARTY_CACHING;//turn on caching
$smarty->cache_dir = SMARTY_CACHE_DIR;


##########################
# add scripts to html header
$HTML_SCRIPTURLS[] = array('href' => LIVE_SITE.'/includes/jquery/'.FILE_JQUERY);
#
##########################

##########################
# map language variables
$TPL_STRINGS['TPL_LOGO_URL_ALT']  = 'mkSurvey';
$TPL_STRINGS['TPL_LOGO_URL_HREF'] = LIVE_SITE;
#
##########################


//debug_obj($oLogger,'oLogger');
//debug_obj($_SESSION,'_SESSION');
include_once(LANGUAGE_PATH.'/lang_box_login.php');
include_once(LANGUAGE_PATH.'/lang_login.php');
include_once(ABSOLUTE_PATH.'/includes/functions/dologin.php');

$database->setDebugOn(true);
$smarty->compile_check = true;
$smarty->debugging = SMARTY_DEBUG;
$smarty->template_dir = PATH_TEMPLATES;

$HTML_TPL_INNER    = PATH_TEMPLATES.'/admin/login.tpl';
//$HTML_TPL_TOPNAV   = PATH_TEMPLATES.'/admin/topnav.tpl';
#$HTML_TPL_NAVBAR   = PATH_TEMPLATES.'/admin/navbar.tpl';
#$HTML_TPL_LEFTBOX  = PATH_TEMPLATES.'/admin/leftbox.tpl';
#$HTML_TPL_RIGHTBOX = PATH_TEMPLATES.'/admin/rightbox.tpl';
#$HTML_TPL_BODY     = PATH_TEMPLATES.'/admin/body.tpl';
#$HTML_TPL_FOOTER   = PATH_TEMPLATES.'/admin/footer.tpl';

//echo '$currentStage:'.$currentStage;

//get current server protocol
if (stristr($_SERVER['SERVER_PROTOCOL'],'HTTP/')){
   $SERVER_PROTOCOL_PREFIX = 'http://';
}else{
   $SERVER_PROTOCOL_PREFIX = 'https://';
}

$smarty->assign('PATH_TEMPLATES',PATH_TEMPLATES);
$TPL_PATHS['PATH_TEMPLATES']      = PATH_TEMPLATES;
$TPL_PATHS['LIVE_SITE_URL']       = LIVE_SITE_URL;
$TPL_PATHS['CURRENT_URL']         = $SERVER_PROTOCOL_PREFIX.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
$TPL_PATHS['CURRENT_REQUEST_URL'] = $SERVER_PROTOCOL_PREFIX.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];

//print_r($GLOBALS);


$smarty->assign('PATHS',$TPL_PATHS);

if($_GET['action'] != ''){
   $currentStage = $_GET['action'];
}

//debug_sql($currentStage,'currentStage');
//debug_sql($_GET['action'],'action');

//debug_obj($oLogger,'oLogger');
//die('action:'.$currentStage);

//   if($currentStage == '' && $oLogger->IsAdmin()){
//      $oLogger->relocate(LIVE_SITE_URL.'/admin');
//   }


switch($currentStage){
   case 'dosignup':
      require_once(ABSOLUTE_PATH.'/includes/functions/survey_dosignup.php');
      break;
   case 'doadmin':
      require_once(ABSOLUTE_PATH.'/includes/functions/survey_doadmin.php');
      break;
   case 'dosurvey':
      require_once(ABSOLUTE_PATH.'/includes/functions/survey_dosurvey.php');
      break;
   default:{
      
      //if logged relocate to admin 
      if ($oLogger->IsLogged()){
         header('Location:'.LIVE_SITE.'/admin');
         //debug_sql('Location:'.LIVE_SITE.'/admin');
         die();
      }

      $HTML_STYLEURLS[] = array('href' => PATH_DESIGN_STYLES.'/'.SITE_CSS);
      $HTML_STYLEURLS[] = array('href' => PATH_DESIGN_STYLES.'/lh.css');

      //      $smarty->assign('HTMLOUT_BOX_LOGIN',$HTMLOUT_BOX_LOGIN);
      //$HTML_TPL_NAVBAR   = PATH_TEMPLATES.'/login/box_login.tpl';
      //$HTML_TPL_NAVBAR   = PATH_TEMPLATES.'/login/box_login.tpl';

      //      $HTML_TPL_NAVBAR   = PATH_TEMPLATES.'/login/topnav.tpl';
      //
      //      $HTML_TPL_BODY     = PATH_TEMPLATES.'/login/body.tpl';
      //      $HTML_TPL_LEFTBOX  = PATH_TEMPLATES.'/login/leftbox.tpl';
      //      $HTML_TPL_RIGHTBOX = PATH_TEMPLATES.'/login/rightbox.tpl';

      $HTML_TPL_TOPNAV   = PATH_TEMPLATES.'/login/topnav.tpl';
      $HTML_TPL_NAVBAR   = PATH_TEMPLATES.'/login/navbar.tpl';
      $HTML_TPL_BODY     = PATH_TEMPLATES.'/login/body.tpl';
      $HTML_TPL_LEFTBOX  = PATH_TEMPLATES.'/login/leftbox.tpl';
      $HTML_TPL_RIGHTBOX = PATH_TEMPLATES.'/login/rightbox.tpl';
   }
   break;
}



##########################################################
# Load template data
/*
 * load html template meta
 */

if (count($SURVEY_STRINGS)>0){
   $TPL_STRINGS['SURVEY_STRINGS'] = $SURVEY_STRINGS;
}
$smarty->assign('STRINGS',$TPL_STRINGS);

$HTML_TITLE     = PRODUCT_NAME.' v.'.APP_VERSION.' BETA';
//$HTML_ENCODING  = 'windows-1251';
$HTML_ENCODING  = 'UTF-8';
$HTML_BASE_HREF = BASE_URL_DESIGN;

$HTML_SHORTCUT_ICON_URL = PATH_DESIGN_IMG.'/favicon.ico';

$HTML_METAS[] = array('name'    => 'description',
                      'content' => "mkSurvey"
);
$HTML_METAS[] = array('name'    => 'keywords',
                      'content' => "mkSurvey, survey, iso"
);
$HTML_METAS[] = array('name'    => 'Generator',
                      'content' => "mkSurvey - Copyright (C) 2007 - 2006 Open Source Matters. All rights reserved."
);
$HTML_METAS[] = array('name'    => 'robots',
                      'content' => "index, follow"
);

/*
 * load template css's
 */
//$HTML_STYLEURLS[] = array('href' => PATH_DESIGN_STYLES.'/'.SITE_CSS);
//$HTML_STYLEURLS[] = array('href' => PATH_DESIGN_STYLES.'/lh.css');

$HTMLOUT = array('TITLE'     	 	 => $HTML_TITLE,
'BASE_HREF'         => $HTML_BASE_HREF,
'ENCODING'  	 	 => $HTML_ENCODING,
'METAS'     	 	 => $HTML_METAS,
'SHORTCUT_ICON_URL' => $HTML_SHORTCUT_ICON_URL,
'STYLEURLS' 	 	 => $HTML_STYLEURLS,
'SCRIPTURLS' 	 	 => $HTML_SCRIPTURLS,
'XAJAX' 	 	    => $HTML_XAJAX,
'TPLS' => array('INNER' 	     => $HTML_TPL_INNER,
'TOPNAV' 	     => $HTML_TPL_TOPNAV,
'NAVBAR' 	     => $HTML_TPL_NAVBAR,
'LEFTBOX' 	     => $HTML_TPL_LEFTBOX,
'RIGHTBOX' 	 => $HTML_TPL_RIGHTBOX,
'BODY' 	     => $HTML_TPL_BODY,
'FOOTER' 	     => $HTML_TPL_FOOTER)
);

//      debug_obj($HTMLOUT,'TPL_HTMLOUT');

$smarty->assign('HTMLOUT',$HTMLOUT);
#
##########################################################

if ($_GET['msg']!=''){
   $errorKey = strip_tags($_GET['msg'],'<p><i><b>');
   if (defined($errorKey)){
      $smarty->assign('MESSAGE',constant($errorKey));
   }else{
      $smarty->assign('MESSAGE',$errorKey);
   }
}

$APP_DATA['IS_ADMIN'] = $oLogger->IsAdmin();
$smarty->assign('APP_DATA',$APP_DATA);

$smarty->display(PATH_TEMPLATES.'/index.tpl');

//debug_obj($_SESSION,'_SESSION');
//debug_obj($oLogger,'$oLogger');
//debug_obj($_COOKIE,'_COOKIE');
?>