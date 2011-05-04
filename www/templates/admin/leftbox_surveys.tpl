{* 
/** 
 * 
 * Body template 
 * 
 * @version $Id: leftbox_surveys.tpl 133 2007-11-25 01:49:43Z mimait04 $ 
 * @copyright 
 * @author 
 * 
 */ 
*}


<style type="text/css">
{literal}

.fs{
	border-left-width: 9px;
	border-left-style: solid;
	border-left-color: -moz-use-text-color;
	border-left-color: #c3d9ff;
}

.sd {
	border-left-color: #c3d9ff;
}
.tlc {
	cursor:pointer;
	table-layout:fixed;
	text-align:left;
}
.tlc col {
	font-size:80%;
}
.cc {
	text-align:right;
	width:31px;
}
.sr {
	background:#FFFFCC none repeat scroll 0%;
}
.rr {
	background:#E8EEF7 none repeat scroll 0%;
}

.tlc td {
	overflow:hidden;
	white-space:nowrap;
	width:100%;
	border-bottom:1px solid #BBBBBB;
	empty-cells:show;
	font-size:80%;
}

.v {
	background-image:url(images/star_off_2.gif);
}

.v2 {
	background-image:url(images/star_on_sm_2.gif);
}

.sc {
	background-position:1px 3px;
	background-repeat:no-repeat;
}
.p {
	color:#777777;
}
.sr {
	background:#FFFFCC none repeat scroll 0%;
}
{/literal}
</style>

<div class="lhcl_prettybox lhcl_albums">
<div class="lhcl_header">
<table style="width: 100%;" class="lhcl_tableheader">
		<tr>
			<td style="text-align: left;width:70px">{$STRINGS.CAPTION_SORT_SURVEYS}</td>
			<td style="text-align: left;">

			{if $STRINGS.SURVEYS}
			<a class="lhcl_nounderline" href="void(0);" onclick="javascript:deleteSurveys();return false;">
			<div style="float: left;" class="lhcl_cbbox">
			<p class="lhcl_cbdesc" />
			<p class="lhcl_cblink"><em><img src="img/delete_icon.gif" />{t}Löschen{/t}</em></p>
			</div>
			</a>
			{/if}


{*
	INFO:removed survey for next release
*}			

{*			
			
			<div id="lhid_albumsort"><span class="lhcl_notbold">{$STRINGS.CAPTION_SORT_SURVEYS_BY}</span> 

			{if $STRINGS.CAPTION_SORT_SURVEYS_BY_DATE_HREF}
				<a href="{$STRINGS.CAPTION_SORT_SURVEYS_BY_DATE_HREF}">{$STRINGS.CAPTION_SORT_SURVEYS_BY_DATE}</a>
			{else}
				{$STRINGS.CAPTION_SORT_SURVEYS_BY_DATE}
			{/if}
 | 
			{if $STRINGS.CAPTION_SORT_SURVEYS_BY_CREATION_HREF}
				<a href="{$STRINGS.CAPTION_SORT_SURVEYS_BY_CREATION_HREF}">{$STRINGS.CAPTION_SORT_SURVEYS_BY_CREATION}</a>
			{else}
				{$STRINGS.CAPTION_SORT_SURVEYS_BY_CREATION}
			{/if}
			</div>
*}
			</td>
			<td nowrap="nowrap" style="text-align: right;">
			<a class="lhcl_nounderline" href="javascript:LH_createDialog()">
			<div style="float: right;" class="lhcl_cbbox">
			<p class="lhcl_cbdesc" />
			<p class="lhcl_cblink"><em><img src="img/newalbum_icon.gif" />
			{$STRINGS.CAPTION_BUTTON_ADD_SURVEY}</em></p>
			</div>
			</a></td>
		</tr>
</table>
</div>
<!-- #################################### -->

{*
<div class="tbc"><div class="tbcb"><button style="font-weight: bold;" id="ac_rc_i" class="ab" type="button">Archivieren</button><button id="ac_sp" class="ab" type="button">Spam melden</button><button id="ac_tr" class="ab" type="button">Löschen</button></div><div class="tbcm"><select id="tam" onchange="top.js._TL_OnActionMenuChange(window,this)" onfocus="return top.js._TL_MaybeUpdateActionMenus(window,this)" onmouseover="return top.js._TL_MaybeUpdateActionMenus(window,this)" style="vertical-align: middle; width: 37ex;"><option style="color: rgb(119, 119, 119);" id="mac">Weitere Aktionen...</option><option id="" disabled="" value="rd">   Als gelesen markieren</option><option id="" disabled="" value="ur">   Als ungelesen markieren</option><option id="" disabled="" value="st">   Markierung hinzufügen</option><option id="" disabled="" value="xst">   Markierung entfernen</option><option style="color: rgb(119, 119, 119);" disabled="" id="nm">--------</option><option style="color: rgb(119, 119, 119);" disabled="" id="al">Label anwenden:</option><option id="" value="ac_SW7-Verteiler">   SW7-Verteiler</option><option value="new" id="nl">   Neues Label...</option></select></div><div class="tbcr"><span id="rfr" class="lk">Aktualisieren</span></div><div class="tbcp"> <span style="white-space: nowrap;"><b>1</b> - <b>50</b> von <b>82</b></span> <span id="odr" class="lk">Ältere ›</span></div><div class="tbcs">Auswahl: <span id="sl_a" class="l">Alle</span>, <span id="sl_n" class="l">Keine</span>, <span id="sl_r" class="l">Gelesen</span>, <span id="sl_u" class="l">Ungelesen</span>, <span id="sl_s" class="l">Markiert</span>, <span id="sl_t" class="l">Nicht markiert</span></div></div>
*}

<div class="fs">
<div id="tbd">
{*<form target="hst" method="post" name="af" action="?ik=a3a65110d2&search=inbox&view=tl&start=0">*}
<form id="surveysForm" name="surveysForm">
<span id="ttw" />
<table width="100%" cellspacing="0" cellpadding="1" id="tb" class="tlc">
	<col class="cc" />
	<col style="width: 20px;" />
	<col style="width: 15ex;" />
	<col style="width: 2ex;" />
	<col />
	<col style="width: 30px;" />
	<col style="width: 20px;" />
	<col style="width: 110px;" />
	{foreach from=$STRINGS.SURVEYS item=SURVEY key=SURVEY_KEY}
		<tr id="w_{$SURVEY.survey_id}" class="rr">
			<td align="right"><input type="checkbox" id="survey" name="survey[{$SURVEY.survey_id}]"/></td>
			<td class="sc {if $SURVEY.survivors_finished_count == $SURVEY.survivors_count && $SURVEY.survivors_count != 0}v2{else}v{/if}"></td>
			<td onclick="javascript:LH_iSv('{$SURVEY.survey_id}')"><span id="{$SURVEY.survey_type_id}">{$SURVEY.survey_type_title}</span></td>
			<td></td>
			<td onclick="javascript:LH_iSv('{$SURVEY.survey_id}')">{$SURVEY.title}<span class="p"> - {$SURVEY.description}</span></td>
			<td>({$SURVEY.survivors_finished_count}/{$SURVEY.survivors_count})</td>
			<td>{if $SURVEY.href_survey_report && $SURVEY.survivors_finished_count > 0 }
				<a href="{$SURVEY.href_survey_report}"><img width="15" height="15" src="images/report2.gif"/></a>
				{/if}
			</td>
			<td><span id="_date_{$SURVEY.date_created}">{$SURVEY.date_created_short}</span></td>
		</tr>
	{/foreach}
</table>
<span id="btw" />
</form>
</div>
</div>

{*
<div class="lhcl_body">
<table width="100%">
		<tr>
			<td><!-- #################################### -->

			<div class="lhcl_rsslink"><a
				href="/data/feed/base/user/m.k?kind=album&alt=rss&hl=en_US">RSS</a>
			</div>
			</td>
		</tr>
</table>
</div>
*}</div>