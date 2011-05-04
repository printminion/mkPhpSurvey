<?

include_once("configuration.php");
include_once("require_all.php");


#include XAJAX functions
require_once(ABSOLUTE_PATH.'/xa/sur.common.php');
require_once(ABSOLUTE_PATH.'/smarty/libs/Smarty.class.php');

$smarty = new Smarty();

$smarty->compile_check = true;
$smarty->debugging = SMARTY_DEBUG;


##########################################################
# Load template data
/*
 * load html template meta
*/

$HTML_TPL_INNER    = PATH_TEMPLATES.'/admin/login.tpl';
$HTML_TPL_TOPNAV   = PATH_TEMPLATES.'/admin/topnav.tpl';
$HTML_TPL_NAVBAR   = PATH_TEMPLATES.'/admin/navbar.tpl';
$HTML_TPL_LEFTBOX  = PATH_TEMPLATES.'/admin/leftbox.tpl';
$HTML_TPL_RIGHTBOX = PATH_TEMPLATES.'/admin/rightbox.tpl';
$HTML_TPL_BODY     = PATH_TEMPLATES.'/admin/body.tpl';
$HTML_TPL_FOOTER   = PATH_TEMPLATES.'/admin/footer.tpl';


$HTML_TITLE     = 'mkSurvey v.'.APP_VERSION.' BETA';
$HTML_ENCODING  = 'windows-1251';
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
$HTML_STYLEURLS[] = array('href' => PATH_DESIGN_STYLES.'/'.SITE_CSS);
$HTML_STYLEURLS[] = array('href' => PATH_DESIGN_STYLES.'/lh.css');


$HTMLOUT = array('TITLE'     	 	 => $HTML_TITLE,
                 'BASE_HREF'         => $HTML_BASE_HREF,
                 'ENCODING'  	 	 => $HTML_ENCODING,
                 'METAS'     	 	 => $HTML_METAS,
                 'SHORTCUT_ICON_URL' => $HTML_SHORTCUT_ICON_URL,
				 'STYLEURLS' 	 	 => $HTML_STYLEURLS,
				 'TPLS' => array('INNER' 	     => $HTML_TPL_INNER,
				                 'TOPNAV' 	     => $HTML_TPL_TOPNAV,
				                 'NAVBAR' 	     => $HTML_TPL_NAVBAR,
				                 'LEFTBOX' 	     => $HTML_TPL_LEFTBOX,
				                 'RIGHTBOX' 	 => $HTML_TPL_RIGHTBOX,
				                 'BODY' 	     => $HTML_TPL_BODY,
				                 'FOOTER' 	     => $HTML_TPL_FOOTER)
				 );

$smarty->assign('HTMLOUT',$HTMLOUT);
#
##########################################################

$smarty->display(PATH_TEMPLATES.'/index.tpl');


?>