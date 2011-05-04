<?php

#require_once(LANGUAGE_PATH."/lang_rrm.php");
require_once (ABSOLUTE_PATH."/includes/xajax/xajax_core/xajax.inc.php");

//debug_sql(LIVE_SITE_URL);
$xajax = new xajax(LIVE_SITE_URL."/xa/sur.server.php");

//debug_obj($xajax);

//old version
//$xajax->debugOn();
//$xajax->waitCursorOn();
//$xajax->statusMessagesOn();
//$xajax->setCharEncoding(_SURA_DEFAULT_ENCODING);

//$xajax->configure('debug', true);
$xajax->configure("characterEncoding", _SURA_DEFAULT_ENCODING);

#include xAjax for admin
include_once(ABSOLUTE_PATH."/xa/sura.common.php");

?>