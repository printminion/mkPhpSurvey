{* @version $Id: navbar_surveys.tpl 134 2007-11-25 04:10:22Z mimait04 $ *}
<script type="text/javascript">
{literal}
<!--
var dialog_;
function _d(func){
	switch(func){
	case 'func_4':/* create survey action */
		/*TODO:add validation */
		return true;
	break;
	case 'func_5':/* dialog create survey  */
		hideElement('dialog_create',true);
		hideElement('lhcl_cover',true);
	break;
	case 'func_6':/* dialog add survivors */
		hideElement('dialog_addsurvivors',true);
		hideElement('lhcl_cover',true);
	break;
	case 'func_7':/* dialog add survivors */
		hideElement('dialog_survey',true);
		hideElement('dialog_survey_load',true);
		hideElement('lhcl_cover',true);
	break;
	
	default:
	
	break;
	}

}
function LH_createDialog() {
  dialog_ = new LH_Dialog('DIALOG_CREATE');
}

function LH_uploadDialog() {
  dialog_ = new LH_Dialog('DIALOG_ADDSURVIVORS');
}
function LH_iSv(svId) {
  dialog_ = new LH_Dialog('DIALOG_SURVEY');
  xajax_loadSurveyData({"id":svId});
}

 $(document).ready(function() {
 	//$('#dialog_create').show();
 });

function loadSurveyConfigData(objResponse, objOptions){
	$("#survey_new_loading").hide();
	//alert('loadSurveyConfigData:' + objResponse.responseXML.documentElement.nodeName);
	//alert('loadSurveyConfigData:' + objResponse.responseText);
	
	xajax.$('survey_new_values').innerHTML = objResponse.responseText;
	xajax.$('survey_new_values').style.display = 'inherit';
	//$("#survey_new_values").show();
	$("#survey_new_description").show();
	
	xajax.completeResponse(objOptions);
}

function deleteSurveys(){
	var deleteArr = new Array();
	var bReturnVal = false;
	 
	//<input type="checkbox" id="survey[29]"/>
	
	//alert($('input[@type=checkbox]'));
	
		
		$('input[@type=checkbox]').each( function(i){
			if (this.checked && this.id == 'survey'){
				//alert(this.name + ':' + this.id);
 				deleteArr.push(this.name)
			}	
		});
		
		//alert('deleteSurveys:not yet implemented\n' + deleteStr);
		
		if (deleteArr.length > 0){
			bReturnVal = confirm('Wollen Sie ' + deleteArr.length + ' Umfragen löschen\n Alle Daten werden gelöscht!'); 
		}else{
			alert('Keine Umfragen würden ausgewählt');
		}
		
		if (bReturnVal){
			xajax_deleteSurvey(xajax.getFormValues('surveysForm'));
		}
		
		return false;
}

function createSurvey(oForm){
	/*
		TODO:Add input validation
	*/
	$("#survey_loading").show();
	xajax_createSurvey(xajax.getFormValues('createSurveyForm'));
}

function updateSurvey(oForm){
	/*
		TODO:Add input validation
	*/
	$("#survey_loading").show();
	xajax_updateSurvey(xajax.getFormValues('updateSurveyForm'));
	return false;
}

function loadSurveyOptions(surveyId){
		//alert('loadSurveyOptions(' + surveyId + ')');

		//$('input_2').value = 'none';
		
		$("#survey_new_loading").hide();
		$("#survey_new_values").hide();
		$("#survey_new_description").hide();
		
		
		
		//select default value
		if (surveyId == 'none'){
			var oSelect = document.getElementById('input_2');
			if(oSelect){
				oSelect.selectedIndex = 0;
			}
			return true;
		}
		
		$("#survey_new_loading").show();
		
		
//		xajax.call('loadSurveyConfigData', {responseProcessor: loadSurveyConfigData, parameters: arguments });
		//xajax.request( { xjxfun: 'loadSurveyConfigData' }, { parameters: arguments } );	

		//$("#survey_new_loading").show();
		xajax_loadSurveyConfigData({"Id":surveyId});
		//alert('loadSurveyOptions(' + surveyId + ')');
		
}

function LH_Dialog(dialog){
//	alert(dialog);
	switch(dialog){
	case 'DIALOG_CREATE':
		loadSurveyOptions('none');
		hideElement('lhcl_cover',false);
		hideElement('dialog_create',false);	
	break;
	case 'DIALOG_ADDSURVIVORS':
		hideElement('lhcl_cover',false);
		hideElement('dialog_addsurvivors',false);	
	break;
	case 'DIALOG_SURVEY':

		$("#survey_loading").hide();
		$("#survey_values").hide();
		$("#survey_description").hide();
	
		hideElement('lhcl_cover',false);
		hideElement('dialog_survey',false);	
		hideElement('dialog_survey_load',false);
	break;
	default:
		alert('Warning: Dialog doent exist - ' + dialog);
	break;
	}
}

function hideElement(elementId,bHide){

	oElement = document.getElementById(elementId);
	
	if (!oElement){
		return false;
	}
	
	if (bHide){
		oElement.style.display = 'none';
	}else{
		oElement.style.display = 'block';
	}

}
-->
{/literal}
</script>
<span id="lhid_navbarlinks_nz"><span class="lhcl_deadnavlink">{$STRINGS.CAPTION_MYSURVEYS}</span>
{if $STRINGS.CAPTION_MYSURVEYS_RUNNING_URL} <a
	href="{$STRINGS.CAPTION_MYSURVEYS_RUNNING_URL}">{$STRINGS.CAPTION_MYSURVEYS_RUNNING}</a>
{else} {$STRINGS.CAPTION_MYSURVEYS_RUNNING} {/if} {if
$STRINGS.CAPTION_MYSURVEYS_FINISHED_URL} <a
	href="{$STRINGS.CAPTION_MYSURVEYS_FINISHED_URL}">{$STRINGS.CAPTION_MYSURVEYS_FINISHED}</a>
{else} {$STRINGS.CAPTION_MYSURVEYS_FINISHED} {/if}
</span>
