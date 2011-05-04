{*

	$Id:$
	
*}

<script type="text/javascript">
{literal}
function validateForm(oThis){
	/*
		TODO: add validation
	*/
	return true;
}

function validateInput(textfield){

	oButton = document.getElementById("startbutton");

	if (oButton){
		oButton.disabled = false;
	}
	
	oButton = document.getElementById("clearall");

	if (oButton){
		oButton.disabled = false;
	}	
	
}

function resetForm(){

}
{/literal}

</script>
<div id="webUpload">
<div id="htmlupload">

{*<form onsubmit="return validateForm(this);" enctype="multipart/form-data" method="post" action="{$STRINGS.FORMS_ACTION_URL}?addSurvivors&tok=J-8sGqxVGSZuUlHeYyCu9usAdD8&uname=user&aid=5079841504145939857" name="survivorscontent" id="survivorscontent">*}
<form onsubmit="return validateForm(this);" enctype="multipart/form-data" method="post" action="{$STRINGS.FORMS_ACTION_URL}?addSurvivors" name="survivorscontent" id="survivorscontent">
<table cellspacing="0" cellpadding="0"><tr>
<td valign="top" style="padding-left: 8px;">
<div id="lhid_uploaderbox">
<div class="lhcl_buttons">
	<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td align="left"><span style="font-size: 1em;" id="uploadnextstep">E-Mail Adressen zur Umfrage hinzufügen. </span></td>
		<td align="right">
			<input type="reset" onclick="resetForm();" id="clearall" value="Alles löschen" disabled=""/>
			<input type="button" onclick="document.location.href='{$PATHS.LIVE_SITE_URL}/admin'" value="Abbrechen" id="cancel"/>
		</td>
	</tr>
	</table>
</div>
<div style="margin: 1em; text-align: left;">
	<input type="hidden" name="sid" value="{$STRINGS.FORM_SID}"/>
	<div id="lhid_files">
		<textarea class="lhcl_input" name="emails" onchange="validateInput(this);" rows="20" cols="50"></textarea>
	</div>
</div>
<div style="padding: 8px; text-align: left;" class="lhcl_buttons">
	<input type="submit" style="font-weight: bold;" value="Umfrage-Einladungen versenden" id="startbutton" disabled=""/>
</div>
</div>
</td>
<td valign="top" style="padding-left: 8px;">

<div class="lhcl_infobox" id="lhid_uploadinfo">
Geben Sie hier die E-Mail-Adressen der Personen ein, die an der Umfrage teilnehmen sollen. <br/><br/>
<span class="color: #ff0000;font-weight:bold;">Die Adressen kommen ins ensprechende Textfeld je E-Mail Adresse pro Zeile</span>.
</div>

</td>
</tr>
</table>
</form>
</div>
</div>