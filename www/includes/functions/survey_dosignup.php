<?php
/**
 * @version $Id: survey_dosignup.php 133 2007-11-25 01:49:43Z mimait04 $
 */

include_once(LANGUAGE_PATH.'/lang_register.php');
include_once(ABSOLUTE_PATH.'/includes/functions/dosignup.php');
$HTML_XAJAX = $xajax->getJavascript(LIVE_SITE_URL.'/includes/xajax/');

##########################
# map language variables
$TPL_STRINGS['TPL_LOGO_URL_ALT']  = 'mkSurvey';
$TPL_STRINGS['TPL_LOGO_URL_HREF'] = LIVE_SITE.'';//no trailing slash?
#
##########################

$HTML_STYLEURLS[] = array('href' => PATH_DESIGN_STYLES.'/'.SITE_CSS);
$HTML_STYLEURLS[] = array('href' => PATH_DESIGN_STYLES.'/lh.css');


$HTML_TPL_TOPNAV   = PATH_TEMPLATES.'/signup/topnav.tpl';
$HTML_TPL_NAVBAR   = PATH_TEMPLATES.'/signup/navbar.tpl';
$HTML_TPL_BODY     = PATH_TEMPLATES.'/signup/body.tpl';
$HTML_TPL_LEFTBOX  = PATH_TEMPLATES.'/signup/leftbox.tpl';
$HTML_TPL_RIGHTBOX = PATH_TEMPLATES.'/signup/rightbox.tpl';

?>