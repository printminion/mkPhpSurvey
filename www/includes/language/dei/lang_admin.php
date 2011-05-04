<?php


define('TPL_ADMIN_CAPTION_MYSURVEYS','Meine Umfragen:');//My Surveys:
define('TPL_ADMIN_CAPTION_MYSURVEYS_RUNNING','Am Laufen');//Running
define('TPL_ADMIN_CAPTION_MYSURVEYS_FINISHED','Beendet');//Finished

define('TPL_ADMIN_CAPTION_MYSURVEYS_RUNNING_URL',LIVE_SITE.'/admin/?running');//Running
define('TPL_ADMIN_CAPTION_MYSURVEYS_FINISHED_URL',LIVE_SITE.'/admin/?finished');//Finished

define('TPL_ADMIN_CAPTION_BUTTON_ADD_SURVEY','Neue Umfrage');// New Survey

define('TPL_ADMIN_CAPTION_SORT_SURVEYS','Umfragen');//Surveys
define('TPL_ADMIN_CAPTION_SORT_SURVEYS_BY','Sortierung');//Sort by:
define('TPL_ADMIN_CAPTION_SORT_SURVEYS_BY_DATE','Anzahl');//Survey date
define('TPL_ADMIN_CAPTION_SORT_SURVEYS_BY_CREATION','Datum');//Upload date


define('TPL_ADMIN_CAPTION_BUTTON_ADD_SURVIVORS','Umfragenden');//Upload Photos
define('TPL_ADMIN_CAPTION_BUTTON_ADD_SURVIVORS_TITLE','Zu umfragende Personen Hinzufügen');//Upload Photos

define('TPL_ADMIN_SIDEBOX_TITLE','Neue Feature');
define('TPL_ADMIN_SIDEBOX_BODY','<div class="lhcl_promo_header">Umfragelisten</div>
<div>Jetzt kann man Umfragen via Umfragelisten führen</div>');

//define('TPL_ADMIN_SIDEBOX_TITLE','New Feature');
//define('TPL_ADMIN_SIDEBOX_BODY','<div class="lhcl_promo_header">More free storage</div>
//<div>You now have 1GB (and counting!) of free storage.</div>
//<div class="lhcl_pseudo_hr"/>
//<div class="lhcl_promo_header">Search</div>
//<div>Discover and explore photos from other Domain users with this new search feature.</div>
//<a href="/lh/searchLearnMore">Learn more</a>');

define('TPL_EMAIL_NEW_SURVIVOR_SUBJECT',"Survey-Einladung:%SURVEY_TITLE%.");
define('TPL_EMAIL_NEW_SURVIVOR_BODY',"Sie sind zu einer Umfrage eingeladen worden.
%SURVEY_INFO%
Um an der Umfrage teilzunehmen klicken Sie bitte auf den folgenden Link. 
%SURVEY_URL%");

define('TPL_EMAIL_NEW_SURVIVOR_SUBJECT_HTML',"Survey-Einladung:%SURVEY_TITLE%.");
define('TPL_EMAIL_NEW_SURVIVOR_BODY_HTML',"Sie sind zu einer Umfrage eingeladen worden.<br/><br/>
%SURVEY_INFO%<br/>
Um an der Umfrage teilzunehmen klicken Sie bitte auf den folgenden Link.<br/> 
<a href=\"%SURVEY_URL%\" target=\"_blank\">%SURVEY_URL%</a>");

?>