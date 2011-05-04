<!--  ######################################################### -->
<style type="text/css">
{literal}
.lhcl_dialog2 {
	background:#C3D9FF none repeat scroll 0%;
	border:1px solid #6486C3;
	color:#333333;
	left:100px;
	padding:7px 7px 4px;
	position:absolute;
	top:16px;
	z-index:1001;
}
.lhcl_dialog{
	position: absolute;
	top: 16px;
	left: 100px;
	z-index: 1001;
	border:1px solid #6486C3;
	padding:7px 7px 4px;
	background:#C3D9FF none repeat scroll 0%;
	
	background-x-position: 0%;
	background-y-position: 0%;
	color: #333333;
}

.lhcl_dialog_body {
	background:#FFFFFF none repeat scroll 0% 50%;
	padding:0.5em;
}
.lhcl_dialog h1 {
	color:#F5951A;
	font-size:1.3em;
	margin:0pt;
}
.lhcl_dialog h2 {
	font-size:1em;
	font-weight:normal;
	margin:0.5em 0pt 0.1em;
}
.lhcl_dialog .lhcl_input {
	border:1px solid #7E9DB9;
	padding:0.1em;
	width:32em;
}
.lhcl_dialog em {
	color:#808080;
	font-size:0.9em;
	font-style:normal;
}
.lhcl_dialog p {
	margin:0.3em 0pt;
	padding-left:2em;
	text-indent:-2em;
	width:32em;
}
.lhcl_dialog_load{
   width:21px;
   height:5px;
   background:url(images/dots-white.gif);
   background-repeat: repeat-x;
}
{/literal}
</style>
<script type="text/javascript">
{literal}
<!--
function gotoAddSurvivors(){
	oInput = document.getElementById('survey_id');
	if (oInput){
	{/literal}
		document.location = '{$PATHS.LIVE_SITE_URL}/admin/?addsurvivors&sid=' + oInput.value;
	{literal}
	}
} 
//-->
{/literal}
</script>
<div class="lhcl_dialog" id="dialog_survey" style="display: none">
<form id="updateSurveyForm" method="post" action="{$STRINGS.FORMS_ACTION_URL}?createSurveyReport&tok=">{* onsubmit="return _d('func_4');">*}
<div class="lhcl_dialog_body">
<h1>Umfrage Info</h1>
<div style="display: none;" id="toggle">
</div>
<div id="dlg">
	<div>
		<h2>Titel</h2>
			<input class="lhcl_input" id="sinfo_3" name="title" value="Unbenannte Umfrage" maxlength="100" type="text"/>
		<h2>Template</h2>
      		<input class="lhcl_input" style="border-style:dotted;" id="sinfo_2" name="template" value="{$SELECTBOX_SURVEY_TYPE}" readonly maxlength="100" type="text"/>

<span  style="display: none;" id="survey_values">survey_values</span>

<h2>Perma-Link Umfrage</h2>
	<input class="lhcl_input" id="survey_permalink" name="title" value="" maxlength="100" type="text" onclick="javascript:this.focus();this.select();"/>

<h2>Perma-Link Auswertung</h2>
	<input class="lhcl_input" id="survey_permalink_results" name="title" value="" maxlength="100" type="text" onclick="javascript:this.focus();this.select();"/>

<span  style="display: none;" id="survey_description">		
<h2>Beschreibung <em>(optional)</em></h2>
<textarea class="lhcl_input" name="description" id="survey_description_value"></textarea>
</span>
<div class="lhcl_dialog_load" id="dialog_survey_load" style="display: none"></div>
</div>
</div>
</div>
<div class="lhcl_buttons">

<!--  input value="0" class="lhcl_default" id="survey_id" type="hidden"/ -->
<input id="survey_id" name="survey_id" value="0" type="hidden"/>

<input value="Tester Hinzufügen" class="lhcl_default" id="btnAddSurvivor" type="button" onclick="gotoAddSurvivors()"/>

{*<input value="Umfragende Hinzufügen" class="lhcl_default" id="btnAddSurvivor" type="button" onclick="document.location = '{$PATHS.LIVE_SITE_URL}/admin/?addsurvivors&sid=0'"/>*}

<script type="text/javascript">
document.write('<input value="&Uuml;bernehmen" class="lhcl_default" id="input" type="button" onclick="return updateSurvey(this);"/>');
</script>
<noscript>
	<input value="&Uuml;bernehmen" class="lhcl_default" id="input" type="submit" onclick="return updateSurvey(this);"/>
</noscript>
<input id="sinfo_1" value="Abbrechen" onclick="_d('func_7')" type="button"/>
</div>
</form>
</div>

<!--  ######################################################### -->