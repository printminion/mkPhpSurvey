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
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-top-style: solid;
	border-right-style: solid;
	border-bottom-style: solid;
	border-left-style: solid;
	border-top-color: #6486c3;
	border-right-color: #6486c3;
	border-bottom-color: #6486c3;
	border-left-color: #6486c3;
	padding-top: 7px;
	padding-right: 7px;
	padding-bottom: 4px;
	padding-left: 7px;
	background-color: #c3d9ff;
	background-image: none;
	background-repeat: repeat;
	background-attachment: scroll;
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
{/literal}
</style>
<div class="lhcl_dialog" id="dialog_create" style="display: none">
<form id="createSurveyForm" method="post" action="{$STRINGS.FORMS_ACTION_URL}?createSurvey&tok=-Ll2IZZJQhB2yl4x1ICaXkrEEAY">{* onsubmit="return _d('func_4');">*}
<input name="uname" value="admin" type="hidden"/>
<div class="lhcl_dialog_body">
<h1>Neue Umfrage erstellen</h1>
<div style="display: none;" id="toggle"></div>
<div id="dlg">
	<div>
		<h2>Titel</h2>
			<input class="lhcl_input" id="input_3" name="title" value="Unbenannte Umfrage" maxlength="100" type="text"/>
		<h2>Template</h2>
			<select class="lhcl_input" id="input_2" name="template" onchange="return loadSurveyOptions(this.value);">
			<option value="none">{t}Wählen Sie ein Template{/t}</option>
			{foreach from="$SELECTBOX_SURVEY_TYPES" key='key' item='options'}
			  <option value="{$options.VALUE}">{$options.CAPTION}</option>
			{/foreach} 
			</select>
<span  style="display: none;" id="survey_new_values">survey_values</span>
<span  style="display: none;" id="survey_new_description">
<h2>Beschreibung <em>(optional)</em></h2>
<textarea class="lhcl_input" name="description" id="input_4"></textarea>
</span>
<span  class="lhcl_dialog_load" style="display: inherit;" id="survey_new_loading"></span>
</div>
</div>
</div>
<div class="lhcl_buttons">
<input value="Erstellen" class="lhcl_default" id="input" type="submit" onclick="createSurvey(this);return false;"/>
<input id="input_1" value="Abbrechen" onclick="_d('func_5')" type="button"/>
</div>
</form>
</div>

<!--  ######################################################### -->