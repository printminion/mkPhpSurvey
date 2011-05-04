{*

$Id:$

*}
<script type="text/javascript" src="{$PATHS.LIVE_SITE_URL}/surveys/{$SURVEY_ID}/js/survey.js"></script>

{literal}
<script type="text/javascript">

	var oldValue = null;
	var oldValueDefaultText = 'Klick hier um den Text hinzufügen';
	
    function _d(func, id){
    	
      switch(func){
        case "doNext":

          if (!validatePage(id-1)){
            return false;
          }

          currentPageObj = document.getElementById('page_' + (id-1));
          nextPageObj = document.getElementById('page_' + id);
          if (currentPageObj && nextPageObj){
            currentPageObj.style.display = 'none';
            nextPageObj.style.display = 'block';
          }

        break;
        case "doBack":
          currentPageObj = document.getElementById('page_' + (id+1));
          nextPageObj = document.getElementById('page_' + id);
          if (currentPageObj && nextPageObj){
            currentPageObj.style.display = 'none';
            nextPageObj.style.display = 'block';
          }
        break;
        case "doFinish":

          if (!validatePage(id-1)){
            return false;
          }

          if(validateAll()){
          	//alert('finishing');
            xajax_doSetValue({"id": "finished", "value": 1});
          }
          return false;


//          nextPageObj = document.getElementById('page_' + id);
//          if (nextPageObj){
//            currentPageObj.style.display = 'none';
//          }
//          alert('Thanks');
        break;
        case "func_1":
			//alert(func + ', ' + id);
          elementId = getControlId(id);
          statusElementId = 'status_' + elementId;

          if (id.substring(0,2) == 'rd' || id.substring(0,2) == 'ra'){
	          //alert("func_1:" + func + ':' + id + ' statusElementId:' + statusElementId);
	          
	          xajax.$(statusElementId).innerHTML = "speichere...";
	          xajax.$(statusElementId).style.display='block';
	          //xajax.$(statusElementId).style.border='1px solid #ff0000';
	          
	
	          xajax_doSetValue({"id": elementId, "value": elementValue});
          }else{
          	oldValue = xajax.$(id).value;
          	if (xajax.$(id).value == oldValueDefaultText){
          		xajax.$(id).value = "";
          	}
          }
          
          return false;
        case "func_2":
        	
        	
            elementId = getControlId(id);
			statusElementId = 'status_' + elementId;
			
            elementObj = document.getElementById(elementId);
			
			if (oldValue == oldValueDefaultText && elementObj.value == ''){
				elementObj.value = oldValueDefaultText;
				break;
			}
			
			if(oldValue == elementObj.value){
				break;
			}

			xajax.$(statusElementId).innerHTML = "speichere...";
            xajax.$(statusElementId).style.display='block';            
            //xajax.$(statusElementId).style.border='1px solid #ff0000';
            
            if (elementObj){
              xajax_doSetValue({"id": id, "value": elementObj.value});
            }

          return false;
        case "func_3":
			//alert(func + ', ' + id);
          return false;
        case "func_4":
			//alert(func + ', ' + id);
          return false;

        break;
        default:
          //alert(func + ':' + id);
          return false;
        break;
      }
      window.status = func + ':' + id;
    }

	function getControlId(id){
	     
	     if (id.substring(0,2) == 'rd' || id.substring(0,2) == 'ra'){
            elementId = id.split('__');
            //elementId = elementId[elementId.length-1];
            elementId    = elementId[0] + '_';
            elementValue =  id.split('_');
            elementValue = elementValue[elementValue.length-1];
          }else{
            elementId = id;
          }

		return elementId;
	}
	
		
    function _d2(func){
      window.status = func + ':' + id;
    }

    function validateAll(){

      /* TODO Add iteration via page validation
      validatePage(1);
      validatePage(1);
      ...
      */
      //TODO Select page +Error message

      return true;
    }

</script>
<style type="text/css">
<!--
#page_0 {
  display:block;
  page-break-after:always;
}
#page_1 {
  display:none;
  page-break-after:always;
}
#page_2 {
  display:none;
  page-break-after:always;
}
#page_3 {
  display:none;
  page-break-after:always;
}
#page_4 {
  display:none;
  page-break-after:always;
}
#page_5 {
  display:none;
  page-break-after:always;
}
#page_6 {
  display:none;
  page-break-after:always;
}
#page_7 {
  display:none;
  page-break-after:always;
}
#page_8 {
  display:none;
  page-break-after:always;
}


-->
</style>
{/literal}

<div class="lhcl_editcontrols">
<!--
<table>
  <tbody>
    <tr>
      <td class="lhcl_title">{$STRINGS.SURVEY_STRINGS.CAPTION_SURVEY}<span class="lhcl_albumname">{$STRINGS.SURVEY_STRINGS.CAPTION_SURVEY_NAME}:
      {$STRINGS.SURVEY_STRINGS.CAPTION_SURVEY_SECTION_NAME}</span></td>
    </tr>
  </tbody>
</table> -->
<div id="page_0">
<table>
  <tr>
    <td>
    <div class="lhcl_captionsnav">
    <table class="lhcl_batchtools">
      <tbody>
        <tr>
          <td class="lhcl_title2">{$STRINGS.SURVEY_STRINGS.CAPTION_SURVEY} <span class="lhcl_albumname">{$STRINGS.SURVEY_STRINGS.CAPTION_SURVEY_NAME} : {$STRINGS.SURVEY_STRINGS.PAGE_TITLE_1_}</span></td>
          <td class="lhcl_title3">[1/9]</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div id="lhid_edit_frame">
    <div id="lhid_batchcaptionbox">
    <div id="lhid_captions">
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_txt_1_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_txt_1_}</div>{/if}
    <div>
    <table class="lhcl_onebatchcaption" width="800">
      <tbody>
        <tr>
          <td class="lhcl_left" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_txt_1_}</td>
          <td class="lhcl_center" width="33%">
{*<input type="text"
            name="txt_1_" id="txt_1_" value="{$SURVEY_DATA.txt_1_.data}"
            onkeyup="_d('func_4', 'txt_1_')" onblur="_d('func_2', 'txt_1_')"
            onfocus="_d('func_1', 'txt_1_')"
            onkeydown="_d('func_4', 'txt_1_')">*}

<input type="text" name="txt_1_" id="txt_1_" value="{$SURVEY_DATA.txt_1_.data}" disabled="disabled">
            
          <div class="lhcl_statusbox" id="status_txt_1_"></div>
          </td>
          <td class="lhcl_right" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_txt_1__END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_txt_2_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_txt_2_}</div>{/if}
    <div>
    <table class="lhcl_onebatchcaption" width="800">
      <tbody>
        <tr>
          <td class="lhcl_left" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_txt_2_}</td>
          <td class="lhcl_center" width="33%">
{*<input type="text"
            name="txt_2_" id="txt_2_" value="{$SURVEY_DATA.txt_2_.data}"
            onkeyup="_d('func_4', 'txt_2_')" onblur="_d('func_2', 'txt_2_')"
            onfocus="_d('func_1', 'txt_2_')"
            onkeydown="_d('func_4', 'txt_2_')">'*}

<input type="text" name="txt_2_" id="txt_2_" value="{$SURVEY_DATA.txt_2_.data}" disabled="disabled">
            
          <div class="lhcl_statusbox" id="status_txt_2_"></div>
          </td>
          <td class="lhcl_right" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_txt_2__END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_txt_3_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_txt_3_}</div>{/if}
    <div>
    <table class="lhcl_onebatchcaption" width="800">
      <tbody>
        <tr>
          <td class="lhcl_left" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_txt_3_}</td>
          <td class="lhcl_center" width="33%">
{*<input type="text"
            name="txt_3_" id="txt_3_" value="{$SURVEY_DATA.txt_3_.data}"
            onkeyup="_d('func_4', 'txt_3_')" onblur="_d('func_2', 'txt_3_')"
            onfocus="_d('func_1', 'txt_3_')"
            onkeydown="_d('func_4', 'txt_3_')">*}

<input type="text" name="txt_3_" id="txt_3_" value="{$SURVEY_DATA.txt_3_.data}" disabled="disabled">
            
          <div class="lhcl_statusbox" id="status_txt_3_"></div>
          </td>
          <td class="lhcl_right" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_txt_3__END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_txt_4_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_txt_4_}</div>{/if}
    <div>
    <table class="lhcl_onebatchcaption" width="800">
      <tbody>
        <tr>
          <td class="lhcl_left" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_txt_4_}</td>
          <td class="lhcl_center" width="33%">
{*<input type="text"
            name="txt_4_" id="txt_4_" value="{$SURVEY_DATA.txt_4_.data}"
            onkeyup="_d('func_4', 'txt_4_')" onblur="_d('func_2', 'txt_4_')"
            onfocus="_d('func_1', 'txt_4_')"
            onkeydown="_d('func_4', 'txt_4_')">*}
<input type="text" name="txt_4_" id="txt_4_" value="{$SURVEY_DATA.txt_4_.data}" disabled="disabled">
          <div class="lhcl_statusbox" id="status_txt_4_"></div>
          </td>
          <td class="lhcl_right" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_txt_4__END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_txd_5_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_txd_5_}</div>{/if}
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_txd_5_}</td>
          <td class="lhcl_center" width="33%">
<input type="text" class="lhcl_editcontrols" name="txd_5_" id="txd_5_" value="{$SURVEY_DATA.txd_5_.data}"
            onkeyup="_d('func_4', 'txd_5_')"
            onblur="_d('func_2', 'txd_5_')"
            onfocus="_d('func_1', 'txd_5_')"
            onkeydown="_d('func_4', 'txd_5_')">
            <div class="lhcl_statusbox" id="status_txd_5_"></div>
            </td>


          <td class="lhcl_right" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_txd_5__END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_txd_6_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_txd_6_}</div>{/if}
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_txd_6_}</td>
          <td class="lhcl_center" width="33%">
<input type="text" class="lhcl_editcontrols" name="txd_6_" id="txd_6_" value="{$SURVEY_DATA.txd_6_.data}"
            onkeyup="_d('func_4', 'txd_6_')"
            onblur="_d('func_2', 'txd_6_')"
            onfocus="_d('func_1', 'txd_6_')"
            onkeydown="_d('func_4', 'txd_6_')">
            <div class="lhcl_statusbox" id="status_txd_6_"></div>
            </td>
          <td class="lhcl_right" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_txd_6__END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_rd7_7_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_rd7_7_}</div>{/if}
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_7_BEGIN}</td>
          <td class="lhcl_center" width="33%">
<input {if $SURVEY_DATA.rd7_7_.data == '1'} checked {/if} type="radio" name="rd7_7_" id="rd7_7__1" value="1" onclick="_d('func_1', 'rd7_7__1')">
<input {if $SURVEY_DATA.rd7_7_.data == '2'} checked {/if} type="radio" name="rd7_7_" id="rd7_7__2" value="2" onclick="_d('func_1', 'rd7_7__2')">
<input {if $SURVEY_DATA.rd7_7_.data == '3'} checked {/if} type="radio" name="rd7_7_" id="rd7_7__3" value="3" onclick="_d('func_1', 'rd7_7__3')">
<input {if $SURVEY_DATA.rd7_7_.data == '4'} checked {/if} type="radio" name="rd7_7_" id="rd7_7__4" value="4" onclick="_d('func_1', 'rd7_7__4')">
<input {if $SURVEY_DATA.rd7_7_.data == '5'} checked {/if} type="radio" name="rd7_7_" id="rd7_7__5" value="5" onclick="_d('func_1', 'rd7_7__5')">
<input {if $SURVEY_DATA.rd7_7_.data == '6'} checked {/if} type="radio" name="rd7_7_" id="rd7_7__6" value="6" onclick="_d('func_1', 'rd7_7__6')">
<input {if $SURVEY_DATA.rd7_7_.data == '7'} checked {/if} type="radio" name="rd7_7_" id="rd7_7__7" value="7" onclick="_d('func_1', 'rd7_7__7')">
<div class="lhcl_statusbox" id="status_rd7_7_"></div></td>
          <td class="lhcl_right" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_7_END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    </div>
    </div>
    </div>
    <div class="lhcl_captionsnav">
    <table class="lhcl_batchtools">
      <tbody>
        <tr>
          <td></td>
          <td class="lhcl_batchnav" id="lhid_batchnav_top" />
          <td align="right">
<input type="button"
            onclick="_d('doNext',1)" value="{$STRINGS.SURVEY_STRINGS.PAGE_BUTTON_CAPTION_NEXT}" class="lhcl_default"></td>
        </tr>
      </tbody>
    </table>
    </div>
    </td>
  </tr>
</table>
</div>
<div id="page_1">
<table>
  <tr>
    <td>
    <div class="lhcl_captionsnav">
    <table class="lhcl_batchtools">
      <tbody>
        <tr>
          <td class="lhcl_title2">{$STRINGS.SURVEY_STRINGS.CAPTION_SURVEY} <span class="lhcl_albumname">{$STRINGS.SURVEY_STRINGS.CAPTION_SURVEY_NAME} : {$STRINGS.SURVEY_STRINGS.PAGE_TITLE_2_}</span></td>
          <td class="lhcl_batchnav">[2/9]</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div id="lhid_edit_frame">
    <div id="lhid_batchcaptionbox">
    <div id="lhid_captions">
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_rd7_8_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_rd7_8_}</div>{/if}
    <div class="lhcl_captionspacer"></div>
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left b" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_VALUE_BEGIN}</td>
          <td class="lhcl_center nobr" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_VALUE_VALUES}</td>
          <td class="lhcl_right b" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_VALUE_END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="lhcl_captionspacer"></div>
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_8_BEGIN}</td>
          <td class="lhcl_center" width="33%">
<input {if $SURVEY_DATA.rd7_8_.data == '1'} checked {/if} type="radio" name="rd7_8_" id="rd7_8__1" value="1" onclick="_d('func_1', 'rd7_8__1')">
<input {if $SURVEY_DATA.rd7_8_.data == '2'} checked {/if} type="radio" name="rd7_8_" id="rd7_8__2" value="2" onclick="_d('func_1', 'rd7_8__2')">
<input {if $SURVEY_DATA.rd7_8_.data == '3'} checked {/if} type="radio" name="rd7_8_" id="rd7_8__3" value="3" onclick="_d('func_1', 'rd7_8__3')">
<input {if $SURVEY_DATA.rd7_8_.data == '4'} checked {/if} type="radio" name="rd7_8_" id="rd7_8__4" value="4" onclick="_d('func_1', 'rd7_8__4')">
<input {if $SURVEY_DATA.rd7_8_.data == '5'} checked {/if} type="radio" name="rd7_8_" id="rd7_8__5" value="5" onclick="_d('func_1', 'rd7_8__5')">
<input {if $SURVEY_DATA.rd7_8_.data == '6'} checked {/if} type="radio" name="rd7_8_" id="rd7_8__6" value="6" onclick="_d('func_1', 'rd7_8__6')">
<input {if $SURVEY_DATA.rd7_8_.data == '7'} checked {/if} type="radio" name="rd7_8_" id="rd7_8__7" value="7" onclick="_d('func_1', 'rd7_8__7')">
<div class="lhcl_statusbox" id="status_rd7_8_"></div></td>
          <td class="lhcl_right" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_8_END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_rd7_9_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_rd7_9_}</div>{/if}
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_9_BEGIN}</td>
          <td class="lhcl_center" width="33%">
<input {if $SURVEY_DATA.rd7_9_.data == '1'} checked {/if} type="radio" name="rd7_9_" id="rd7_9__1" value="1" onclick="_d('func_1', 'rd7_9__1')">
<input {if $SURVEY_DATA.rd7_9_.data == '2'} checked {/if} type="radio" name="rd7_9_" id="rd7_9__2" value="2" onclick="_d('func_1', 'rd7_9__2')">
<input {if $SURVEY_DATA.rd7_9_.data == '3'} checked {/if} type="radio" name="rd7_9_" id="rd7_9__3" value="3" onclick="_d('func_1', 'rd7_9__3')">
<input {if $SURVEY_DATA.rd7_9_.data == '4'} checked {/if} type="radio" name="rd7_9_" id="rd7_9__4" value="4" onclick="_d('func_1', 'rd7_9__4')">
<input {if $SURVEY_DATA.rd7_9_.data == '5'} checked {/if} type="radio" name="rd7_9_" id="rd7_9__5" value="5" onclick="_d('func_1', 'rd7_9__5')">
<input {if $SURVEY_DATA.rd7_9_.data == '6'} checked {/if} type="radio" name="rd7_9_" id="rd7_9__6" value="6" onclick="_d('func_1', 'rd7_9__6')">
<input {if $SURVEY_DATA.rd7_9_.data == '7'} checked {/if} type="radio" name="rd7_9_" id="rd7_9__7" value="7" onclick="_d('func_1', 'rd7_9__7')">
<div class="lhcl_statusbox" id="status_rd7_9_"></div></td>
          <td class="lhcl_right" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_9_END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_rd7_10_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_rd7_10_}</div>{/if}
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_10_BEGIN}</td>
          <td class="lhcl_center" width="33%">
<input {if $SURVEY_DATA.rd7_10_.data == '1'} checked {/if} type="radio" name="rd7_10_" id="rd7_10__1" value="1" onclick="_d('func_1', 'rd7_10__1')">
<input {if $SURVEY_DATA.rd7_10_.data == '2'} checked {/if} type="radio" name="rd7_10_" id="rd7_10__2" value="2" onclick="_d('func_1', 'rd7_10__2')">
<input {if $SURVEY_DATA.rd7_10_.data == '3'} checked {/if} type="radio" name="rd7_10_" id="rd7_10__3" value="3" onclick="_d('func_1', 'rd7_10__3')">
<input {if $SURVEY_DATA.rd7_10_.data == '4'} checked {/if} type="radio" name="rd7_10_" id="rd7_10__4" value="4" onclick="_d('func_1', 'rd7_10__4')">
<input {if $SURVEY_DATA.rd7_10_.data == '5'} checked {/if} type="radio" name="rd7_10_" id="rd7_10__5" value="5" onclick="_d('func_1', 'rd7_10__5')">
<input {if $SURVEY_DATA.rd7_10_.data == '6'} checked {/if} type="radio" name="rd7_10_" id="rd7_10__6" value="6" onclick="_d('func_1', 'rd7_10__6')">
<input {if $SURVEY_DATA.rd7_10_.data == '7'} checked {/if} type="radio" name="rd7_10_" id="rd7_10__7" value="7" onclick="_d('func_1', 'rd7_10__7')">
<div class="lhcl_statusbox" id="status_rd7_10_"></div></td>
          <td class="lhcl_right" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_10_END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_rd7_11_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_rd7_11_}</div>{/if}
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_11_BEGIN}</td>
          <td class="lhcl_center" width="33%">
<input {if $SURVEY_DATA.rd7_11_.data == '1'} checked {/if} type="radio" name="rd7_11_" id="rd7_11__1" value="1" onclick="_d('func_1', 'rd7_11__1')">
<input {if $SURVEY_DATA.rd7_11_.data == '2'} checked {/if} type="radio" name="rd7_11_" id="rd7_11__2" value="2" onclick="_d('func_1', 'rd7_11__2')">
<input {if $SURVEY_DATA.rd7_11_.data == '3'} checked {/if} type="radio" name="rd7_11_" id="rd7_11__3" value="3" onclick="_d('func_1', 'rd7_11__3')">
<input {if $SURVEY_DATA.rd7_11_.data == '4'} checked {/if} type="radio" name="rd7_11_" id="rd7_11__4" value="4" onclick="_d('func_1', 'rd7_11__4')">
<input {if $SURVEY_DATA.rd7_11_.data == '5'} checked {/if} type="radio" name="rd7_11_" id="rd7_11__5" value="5" onclick="_d('func_1', 'rd7_11__5')">
<input {if $SURVEY_DATA.rd7_11_.data == '6'} checked {/if} type="radio" name="rd7_11_" id="rd7_11__6" value="6" onclick="_d('func_1', 'rd7_11__6')">
<input {if $SURVEY_DATA.rd7_11_.data == '7'} checked {/if} type="radio" name="rd7_11_" id="rd7_11__7" value="7" onclick="_d('func_1', 'rd7_11__7')">
<div class="lhcl_statusbox" id="status_rd7_11_"></div></td>
          <td class="lhcl_right" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_11_END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_rd7_12_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_rd7_12_}</div>{/if}
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_12_BEGIN}</td>
          <td class="lhcl_center" width="33%">
<input {if $SURVEY_DATA.rd7_12_.data == '1'} checked {/if} type="radio" name="rd7_12_" id="rd7_12__1" value="1" onclick="_d('func_1', 'rd7_12__1')">
<input {if $SURVEY_DATA.rd7_12_.data == '2'} checked {/if} type="radio" name="rd7_12_" id="rd7_12__2" value="2" onclick="_d('func_1', 'rd7_12__2')">
<input {if $SURVEY_DATA.rd7_12_.data == '3'} checked {/if} type="radio" name="rd7_12_" id="rd7_12__3" value="3" onclick="_d('func_1', 'rd7_12__3')">
<input {if $SURVEY_DATA.rd7_12_.data == '4'} checked {/if} type="radio" name="rd7_12_" id="rd7_12__4" value="4" onclick="_d('func_1', 'rd7_12__4')">
<input {if $SURVEY_DATA.rd7_12_.data == '5'} checked {/if} type="radio" name="rd7_12_" id="rd7_12__5" value="5" onclick="_d('func_1', 'rd7_12__5')">
<input {if $SURVEY_DATA.rd7_12_.data == '6'} checked {/if} type="radio" name="rd7_12_" id="rd7_12__6" value="6" onclick="_d('func_1', 'rd7_12__6')">
<input {if $SURVEY_DATA.rd7_12_.data == '7'} checked {/if} type="radio" name="rd7_12_" id="rd7_12__7" value="7" onclick="_d('func_1', 'rd7_12__7')">
<div class="lhcl_statusbox" id="status_rd7_12_"></div></td>
          <td class="lhcl_right" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_12_END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_rd7_13_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_rd7_13_}</div>{/if}
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left" width="33%">...{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_13_BEGIN}</td>
          <td class="lhcl_center" width="33%">
<input {if $SURVEY_DATA.rd7_13_.data == '1'} checked {/if} type="radio" name="rd7_13_" id="rd7_13__1" value="1" onclick="_d('func_1', 'rd7_13__1')">
<input {if $SURVEY_DATA.rd7_13_.data == '2'} checked {/if} type="radio" name="rd7_13_" id="rd7_13__2" value="2" onclick="_d('func_1', 'rd7_13__2')">
<input {if $SURVEY_DATA.rd7_13_.data == '3'} checked {/if} type="radio" name="rd7_13_" id="rd7_13__3" value="3" onclick="_d('func_1', 'rd7_13__3')">
<input {if $SURVEY_DATA.rd7_13_.data == '4'} checked {/if} type="radio" name="rd7_13_" id="rd7_13__4" value="4" onclick="_d('func_1', 'rd7_13__4')">
<input {if $SURVEY_DATA.rd7_13_.data == '5'} checked {/if} type="radio" name="rd7_13_" id="rd7_13__5" value="5" onclick="_d('func_1', 'rd7_13__5')">
<input {if $SURVEY_DATA.rd7_13_.data == '6'} checked {/if} type="radio" name="rd7_13_" id="rd7_13__6" value="6" onclick="_d('func_1', 'rd7_13__6')">
<input {if $SURVEY_DATA.rd7_13_.data == '7'} checked {/if} type="radio" name="rd7_13_" id="rd7_13__7" value="7" onclick="_d('func_1', 'rd7_13__7')">
<div class="lhcl_statusbox" id="status_rd7_13_"></div></td>
          <td class="lhcl_right" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_13_END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_txa_14_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_txa_14_}</div>{/if}
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left">{$STRINGS.SURVEY_STRINGS.CAPTION_txa_14_}</td>
        </tr>
        <tr>
          <td class="lhcl_center"><textarea tabindex="19" class=""
            onkeyup="_d('func_4', 'txa_14_')" onblur="_d('func_2', 'txa_14_')"
            onfocus="_d('func_1', 'txa_14_')"
            onkeydown="_d('func_4', 'txa_14_')" name="txa_14_"
            id="txa_14_">{if $SURVEY_DATA.txa_14_.data}{$SURVEY_DATA.txa_14_.data}{else}{$STRINGS.SURVEY_STRINGS.TEXTAREA_HINT_EDIT}{/if}</textarea>
          <div class="lhcl_statusbox" id="status_txa_14_"></div>
          {* <br/>
          <div class="lhcl_statusbox" id="status_txa_14_"
            style="color: rgb(102, 102, 102);">
          <table>
            <tbody>
              <tr>
                <td class="lhcl_status"><img class="lhcl_statusimg" src="img/check.gif"></td>
                <td class="lhcl_status">This caption has been saved.</td>
                <td class="lhcl_undo"><a href="javascript:_d('func_3', '0')">Undo</a></td>
              </tr>
            </tbody>
          </table>
          </div>
          <br/>
          <div class="lhcl_statusbox" id="status_txa_14_"
            style="color: rgb(102, 102, 102);"><span
            class="lhcl_statusdefault">Changes to captions are
          automatically saved.</span></div>
          <br/>
          <div class="lhcl_statusbox" id="status_txa_14_"
            style="color: rgb(102, 102, 102);">
          <table>
            <tbody>
              <tr>
                <td class="lhcl_status"><img class="lhcl_statusimg"
                  src="img/saving.gif"></td>
                <td class="lhcl_status">saving</td>
              </tr>
            </tbody>
          </table>
          </div>
          *}</td>
        </tr>
      </tbody>
    </table>
    </div>
    </div>
    </div>
    </div>
    <div class="lhcl_captionsnav">
    <table class="lhcl_batchtools">
      <tbody>
        <tr>
          <td>
<input type="button" onclick="_d('doBack',0)"
            value="{$STRINGS.SURVEY_STRINGS.PAGE_BUTTON_CAPTION_BACK}" class="lhcl_default"></td>
          <td class="lhcl_batchnav" id="lhid_batchnav_top" />
          <td align="right">
<input type="button"
            onclick="_d('doNext',2)" value="{$STRINGS.SURVEY_STRINGS.PAGE_BUTTON_CAPTION_NEXT}" class="lhcl_default"></td>
        </tr>
      </tbody>
    </table>
    </div>
    </td>
  </tr>
</table>
</div>
<div id="page_2">
<table>
  <tr>
    <td>
    <div class="lhcl_captionsnav">
    <table class="lhcl_batchtools">
      <tbody>
        <tr>
          <td class="lhcl_title2">{$STRINGS.SURVEY_STRINGS.CAPTION_SURVEY} <span class="lhcl_albumname">{$STRINGS.SURVEY_STRINGS.CAPTION_SURVEY_NAME} : {$STRINGS.SURVEY_STRINGS.PAGE_TITLE_3_}</span></td>
          <td class="lhcl_batchnav">[3/9]</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div id="lhid_edit_frame">
    <div id="lhid_batchcaptionbox">
    <div id="lhid_captions">
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_rd7_15_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_rd7_15_}</div>{/if}
    <div class="lhcl_captionspacer"></div>
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left b" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_VALUE_BEGIN}</td>
          <td class="lhcl_center nobr" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_VALUE_VALUES}</td>
          <td class="lhcl_right b" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_VALUE_END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_15_BEGIN}</td>
          <td class="lhcl_center" width="33%">
<input {if $SURVEY_DATA.rd7_15_.data == '1'} checked {/if} type="radio" name="rd7_15_" id="rd7_15__1" value="1" onclick="_d('func_1', 'rd7_15__1')">
<input {if $SURVEY_DATA.rd7_15_.data == '2'} checked {/if} type="radio" name="rd7_15_" id="rd7_15__2" value="2" onclick="_d('func_1', 'rd7_15__2')">
<input {if $SURVEY_DATA.rd7_15_.data == '3'} checked {/if} type="radio" name="rd7_15_" id="rd7_15__3" value="3" onclick="_d('func_1', 'rd7_15__3')">
<input {if $SURVEY_DATA.rd7_15_.data == '4'} checked {/if} type="radio" name="rd7_15_" id="rd7_15__4" value="4" onclick="_d('func_1', 'rd7_15__4')">
<input {if $SURVEY_DATA.rd7_15_.data == '5'} checked {/if} type="radio" name="rd7_15_" id="rd7_15__5" value="5" onclick="_d('func_1', 'rd7_15__5')">
<input {if $SURVEY_DATA.rd7_15_.data == '6'} checked {/if} type="radio" name="rd7_15_" id="rd7_15__6" value="6" onclick="_d('func_1', 'rd7_15__6')">
<input {if $SURVEY_DATA.rd7_15_.data == '7'} checked {/if} type="radio" name="rd7_15_" id="rd7_15__7" value="7" onclick="_d('func_1', 'rd7_15__7')">
<div class="lhcl_statusbox" id="status_rd7_15_"></div></td>
          <td class="lhcl_right" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_15_END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_rd7_16_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_rd7_16_}</div>{/if}
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_16_BEGIN}</td>
          <td class="lhcl_center" width="33%">
<input {if $SURVEY_DATA.rd7_16_.data == '1'} checked {/if} type="radio" name="rd7_16_" id="rd7_16__1" value="1" onclick="_d('func_1', 'rd7_16__1')">
<input {if $SURVEY_DATA.rd7_16_.data == '2'} checked {/if} type="radio" name="rd7_16_" id="rd7_16__2" value="2" onclick="_d('func_1', 'rd7_16__2')">
<input {if $SURVEY_DATA.rd7_16_.data == '3'} checked {/if} type="radio" name="rd7_16_" id="rd7_16__3" value="3" onclick="_d('func_1', 'rd7_16__3')">
<input {if $SURVEY_DATA.rd7_16_.data == '4'} checked {/if} type="radio" name="rd7_16_" id="rd7_16__4" value="4" onclick="_d('func_1', 'rd7_16__4')">
<input {if $SURVEY_DATA.rd7_16_.data == '5'} checked {/if} type="radio" name="rd7_16_" id="rd7_16__5" value="5" onclick="_d('func_1', 'rd7_16__5')">
<input {if $SURVEY_DATA.rd7_16_.data == '6'} checked {/if} type="radio" name="rd7_16_" id="rd7_16__6" value="6" onclick="_d('func_1', 'rd7_16__6')">
<input {if $SURVEY_DATA.rd7_16_.data == '7'} checked {/if} type="radio" name="rd7_16_" id="rd7_16__7" value="7" onclick="_d('func_1', 'rd7_16__7')">
<div class="lhcl_statusbox" id="status_rd7_16_"></div></td>
          <td class="lhcl_right" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_16_END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_rd7_17_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_rd7_17_}</div>{/if}
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_17_BEGIN}</td>
          <td class="lhcl_center" width="33%">
<input {if $SURVEY_DATA.rd7_17_.data == '1'} checked {/if} type="radio" name="rd7_17_" id="rd7_17__1" value="1" onclick="_d('func_1', 'rd7_17__1')">
<input {if $SURVEY_DATA.rd7_17_.data == '2'} checked {/if} type="radio" name="rd7_17_" id="rd7_17__2" value="2" onclick="_d('func_1', 'rd7_17__2')">
<input {if $SURVEY_DATA.rd7_17_.data == '3'} checked {/if} type="radio" name="rd7_17_" id="rd7_17__3" value="3" onclick="_d('func_1', 'rd7_17__3')">
<input {if $SURVEY_DATA.rd7_17_.data == '4'} checked {/if} type="radio" name="rd7_17_" id="rd7_17__4" value="4" onclick="_d('func_1', 'rd7_17__4')">
<input {if $SURVEY_DATA.rd7_17_.data == '5'} checked {/if} type="radio" name="rd7_17_" id="rd7_17__5" value="5" onclick="_d('func_1', 'rd7_17__5')">
<input {if $SURVEY_DATA.rd7_17_.data == '6'} checked {/if} type="radio" name="rd7_17_" id="rd7_17__6" value="6" onclick="_d('func_1', 'rd7_17__6')">
<input {if $SURVEY_DATA.rd7_17_.data == '7'} checked {/if} type="radio" name="rd7_17_" id="rd7_17__7" value="7" onclick="_d('func_1', 'rd7_17__7')">
<div class="lhcl_statusbox" id="status_rd7_17_"></div></td>
          <td class="lhcl_right" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_17_END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_rd7_18_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_rd7_18_}</div>{/if}
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_18_BEGIN}</td>
          <td class="lhcl_center" width="33%">
<input {if $SURVEY_DATA.rd7_18_.data == '1'} checked {/if} type="radio" name="rd7_18_" id="rd7_18__1" value="1" onclick="_d('func_1', 'rd7_18__1')">
<input {if $SURVEY_DATA.rd7_18_.data == '2'} checked {/if} type="radio" name="rd7_18_" id="rd7_18__2" value="2" onclick="_d('func_1', 'rd7_18__2')">
<input {if $SURVEY_DATA.rd7_18_.data == '3'} checked {/if} type="radio" name="rd7_18_" id="rd7_18__3" value="3" onclick="_d('func_1', 'rd7_18__3')">
<input {if $SURVEY_DATA.rd7_18_.data == '4'} checked {/if} type="radio" name="rd7_18_" id="rd7_18__4" value="4" onclick="_d('func_1', 'rd7_18__4')">
<input {if $SURVEY_DATA.rd7_18_.data == '5'} checked {/if} type="radio" name="rd7_18_" id="rd7_18__5" value="5" onclick="_d('func_1', 'rd7_18__5')">
<input {if $SURVEY_DATA.rd7_18_.data == '6'} checked {/if} type="radio" name="rd7_18_" id="rd7_18__6" value="6" onclick="_d('func_1', 'rd7_18__6')">
<input {if $SURVEY_DATA.rd7_18_.data == '7'} checked {/if} type="radio" name="rd7_18_" id="rd7_18__7" value="7" onclick="_d('func_1', 'rd7_18__7')">
<div class="lhcl_statusbox" id="status_rd7_18_"></div></td>
          <td class="lhcl_right" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_18_END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_rd7_19_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_rd7_19_}</div>{/if}
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_19_BEGIN}</td>
          <td class="lhcl_center" width="33%">
<input {if $SURVEY_DATA.rd7_19_.data == '1'} checked {/if} type="radio" name="rd7_19_" id="rd7_19__1" value="1" onclick="_d('func_1', 'rd7_19__1')">
<input {if $SURVEY_DATA.rd7_19_.data == '2'} checked {/if} type="radio" name="rd7_19_" id="rd7_19__2" value="2" onclick="_d('func_1', 'rd7_19__2')">
<input {if $SURVEY_DATA.rd7_19_.data == '3'} checked {/if} type="radio" name="rd7_19_" id="rd7_19__3" value="3" onclick="_d('func_1', 'rd7_19__3')">
<input {if $SURVEY_DATA.rd7_19_.data == '4'} checked {/if} type="radio" name="rd7_19_" id="rd7_19__4" value="4" onclick="_d('func_1', 'rd7_19__4')">
<input {if $SURVEY_DATA.rd7_19_.data == '5'} checked {/if} type="radio" name="rd7_19_" id="rd7_19__5" value="5" onclick="_d('func_1', 'rd7_19__5')">
<input {if $SURVEY_DATA.rd7_19_.data == '6'} checked {/if} type="radio" name="rd7_19_" id="rd7_19__6" value="6" onclick="_d('func_1', 'rd7_19__6')">
<input {if $SURVEY_DATA.rd7_19_.data == '7'} checked {/if} type="radio" name="rd7_19_" id="rd7_19__7" value="7" onclick="_d('func_1', 'rd7_19__7')">
<div class="lhcl_statusbox" id="status_rd7_19_"></div></td>
          <td class="lhcl_right" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_19_END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_rd7_20_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_rd7_20_}</div>{/if}
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_20_BEGIN}</td>
          <td class="lhcl_center" width="33%">
<input {if $SURVEY_DATA.rd7_20_.data == '1'} checked {/if} type="radio" name="rd7_20_" id="rd7_20__1" value="1" onclick="_d('func_1', 'rd7_20__1')">
<input {if $SURVEY_DATA.rd7_20_.data == '2'} checked {/if} type="radio" name="rd7_20_" id="rd7_20__2" value="2" onclick="_d('func_1', 'rd7_20__2')">
<input {if $SURVEY_DATA.rd7_20_.data == '3'} checked {/if} type="radio" name="rd7_20_" id="rd7_20__3" value="3" onclick="_d('func_1', 'rd7_20__3')">
<input {if $SURVEY_DATA.rd7_20_.data == '4'} checked {/if} type="radio" name="rd7_20_" id="rd7_20__4" value="4" onclick="_d('func_1', 'rd7_20__4')">
<input {if $SURVEY_DATA.rd7_20_.data == '5'} checked {/if} type="radio" name="rd7_20_" id="rd7_20__5" value="5" onclick="_d('func_1', 'rd7_20__5')">
<input {if $SURVEY_DATA.rd7_20_.data == '6'} checked {/if} type="radio" name="rd7_20_" id="rd7_20__6" value="6" onclick="_d('func_1', 'rd7_20__6')">
<input {if $SURVEY_DATA.rd7_20_.data == '7'} checked {/if} type="radio" name="rd7_20_" id="rd7_20__7" value="7" onclick="_d('func_1', 'rd7_20__7')">
<div class="lhcl_statusbox" id="status_rd7_20_"></div></td>
          <td class="lhcl_right" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_20_END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_txa_21_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_txa_21_}</div>{/if}
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left">{$STRINGS.SURVEY_STRINGS.CAPTION_txa_21_}</td>
        </tr>
        <tr>
          <td class="lhcl_center"><textarea tabindex="19" class=""
            onkeyup="_d('func_4', 'txa_21_')" onblur="_d('func_2', 'txa_21_')"
            onfocus="_d('func_1', 'txa_21_')"
            onkeydown="_d('func_4', 'txa_21_')" name="txa_21_"
            id="txa_21_">{if $SURVEY_DATA.txa_21_.data}{$SURVEY_DATA.txa_21_.data}{else}{$STRINGS.SURVEY_STRINGS.TEXTAREA_HINT_EDIT}{/if}</textarea>
          <div class="lhcl_statusbox" id="status_txa_21_"></div>
          {* <br/>
          <div class="lhcl_statusbox" id="status_txa_21_" style="color: rgb(102, 102, 102);">
          <table>
            <tbody>
              <tr>
                <td class="lhcl_status"><img class="lhcl_statusimg"
                  src="img/check.gif"></td>
                <td class="lhcl_status">This caption has been saved.</td>
                <td class="lhcl_undo"><a href="javascript:_d('func_3', '0')">Undo</a></td>
              </tr>
            </tbody>
          </table>
          </div>
          <br/>
          <div class="lhcl_statusbox" id="status_txa_21_"
            style="color: rgb(102, 102, 102);"><span
            class="lhcl_statusdefault">Changes to captions are automatically saved.</span></div>
          <br/>
          <div class="lhcl_statusbox" id="status_txa_21_"
            style="color: rgb(102, 102, 102);">
          <table>
            <tbody>
              <tr>
                <td class="lhcl_status"><img class="lhcl_statusimg"
                  src="img/saving.gif"></td>
                <td class="lhcl_status">saving</td>
              </tr>
            </tbody>
          </table>
          </div>
          *}</td>
        </tr>
      </tbody>
    </table>
    </div>
    </div>
    </div>
    </div>
    <div class="lhcl_captionsnav">
    <table class="lhcl_batchtools">
      <tbody>
        <tr>
          <td>
<input type="button" onclick="_d('doBack',1)"
            value="{$STRINGS.SURVEY_STRINGS.PAGE_BUTTON_CAPTION_BACK}" class="lhcl_default"></td>
          <td class="lhcl_batchnav" id="lhid_batchnav_top" />
          <td align="right">
<input type="button" onclick="_d('doNext',3)" value="{$STRINGS.SURVEY_STRINGS.PAGE_BUTTON_CAPTION_NEXT}" class="lhcl_default"></td>
        </tr>
      </tbody>
    </table>
    </div>
    </td>
  </tr>
</table>
</div>
<div id="page_3">
<table>
  <tr>
    <td>
    <div class="lhcl_captionsnav">
    <table class="lhcl_batchtools">
      <tbody>
        <tr>
          <td class="lhcl_title2">{$STRINGS.SURVEY_STRINGS.CAPTION_SURVEY} <span class="lhcl_albumname">{$STRINGS.SURVEY_STRINGS.CAPTION_SURVEY_NAME} : {$STRINGS.SURVEY_STRINGS.PAGE_TITLE_4_}</span></td>
          <td class="lhcl_batchnav">[4/9]</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div id="lhid_edit_frame">
    <div id="lhid_batchcaptionbox">
    <div id="lhid_captions">
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_rd7_22_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_rd7_22_}</div>{/if}
    <div class="lhcl_captionspacer"></div>
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left b" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_VALUE_BEGIN}</td>
          <td class="lhcl_center nobr" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_VALUE_VALUES}</td>
          <td class="lhcl_right b" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_VALUE_END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_22_BEGIN}</td>
          <td class="lhcl_center" width="33%">
<input {if $SURVEY_DATA.rd7_22_.data == '1'} checked {/if} type="radio" name="rd7_22_" id="rd7_22__1" value="1" onclick="_d('func_1', 'rd7_22__1')">
<input {if $SURVEY_DATA.rd7_22_.data == '2'} checked {/if} type="radio" name="rd7_22_" id="rd7_22__2" value="2" onclick="_d('func_1', 'rd7_22__2')">
<input {if $SURVEY_DATA.rd7_22_.data == '3'} checked {/if} type="radio" name="rd7_22_" id="rd7_22__3" value="3" onclick="_d('func_1', 'rd7_22__3')">
<input {if $SURVEY_DATA.rd7_22_.data == '4'} checked {/if} type="radio" name="rd7_22_" id="rd7_22__4" value="4" onclick="_d('func_1', 'rd7_22__4')">
<input {if $SURVEY_DATA.rd7_22_.data == '5'} checked {/if} type="radio" name="rd7_22_" id="rd7_22__5" value="5" onclick="_d('func_1', 'rd7_22__5')">
<input {if $SURVEY_DATA.rd7_22_.data == '6'} checked {/if} type="radio" name="rd7_22_" id="rd7_22__6" value="6" onclick="_d('func_1', 'rd7_22__6')">
<input {if $SURVEY_DATA.rd7_22_.data == '7'} checked {/if} type="radio" name="rd7_22_" id="rd7_22__7" value="7" onclick="_d('func_1', 'rd7_22__7')">
<div class="lhcl_statusbox" id="status_rd7_22_"></div></td>
          <td class="lhcl_right" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_22_END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_rd7_23_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_rd7_23_}</div>{/if}
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_23_BEGIN}</td>
          <td class="lhcl_center" width="33%">
<input {if $SURVEY_DATA.rd7_23_.data == '1'} checked {/if} type="radio" name="rd7_23_" id="rd7_23__1" value="1" onclick="_d('func_1', 'rd7_23__1')">
<input {if $SURVEY_DATA.rd7_23_.data == '2'} checked {/if} type="radio" name="rd7_23_" id="rd7_23__2" value="2" onclick="_d('func_1', 'rd7_23__2')">
<input {if $SURVEY_DATA.rd7_23_.data == '3'} checked {/if} type="radio" name="rd7_23_" id="rd7_23__3" value="3" onclick="_d('func_1', 'rd7_23__3')">
<input {if $SURVEY_DATA.rd7_23_.data == '4'} checked {/if} type="radio" name="rd7_23_" id="rd7_23__4" value="4" onclick="_d('func_1', 'rd7_23__4')">
<input {if $SURVEY_DATA.rd7_23_.data == '5'} checked {/if} type="radio" name="rd7_23_" id="rd7_23__5" value="5" onclick="_d('func_1', 'rd7_23__5')">
<input {if $SURVEY_DATA.rd7_23_.data == '6'} checked {/if} type="radio" name="rd7_23_" id="rd7_23__6" value="6" onclick="_d('func_1', 'rd7_23__6')">
<input {if $SURVEY_DATA.rd7_23_.data == '7'} checked {/if} type="radio" name="rd7_23_" id="rd7_23__7" value="7" onclick="_d('func_1', 'rd7_23__7')">
<div class="lhcl_statusbox" id="status_rd7_23_"></div></td>
          <td class="lhcl_right" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_23_END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_rd7_24_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_rd7_24_}</div>{/if}
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_24_BEGIN}</td>
          <td class="lhcl_center" width="33%">
<input {if $SURVEY_DATA.rd7_24_.data == '1'} checked {/if} type="radio" name="rd7_24_" id="rd7_24__1" value="1" onclick="_d('func_1', 'rd7_24__1')">
<input {if $SURVEY_DATA.rd7_24_.data == '2'} checked {/if} type="radio" name="rd7_24_" id="rd7_24__2" value="2" onclick="_d('func_1', 'rd7_24__2')">
<input {if $SURVEY_DATA.rd7_24_.data == '3'} checked {/if} type="radio" name="rd7_24_" id="rd7_24__3" value="3" onclick="_d('func_1', 'rd7_24__3')">
<input {if $SURVEY_DATA.rd7_24_.data == '4'} checked {/if} type="radio" name="rd7_24_" id="rd7_24__4" value="4" onclick="_d('func_1', 'rd7_24__4')">
<input {if $SURVEY_DATA.rd7_24_.data == '5'} checked {/if} type="radio" name="rd7_24_" id="rd7_24__5" value="5" onclick="_d('func_1', 'rd7_24__5')">
<input {if $SURVEY_DATA.rd7_24_.data == '6'} checked {/if} type="radio" name="rd7_24_" id="rd7_24__6" value="6" onclick="_d('func_1', 'rd7_24__6')">
<input {if $SURVEY_DATA.rd7_24_.data == '7'} checked {/if} type="radio" name="rd7_24_" id="rd7_24__7" value="7" onclick="_d('func_1', 'rd7_24__7')">
<div class="lhcl_statusbox" id="status_rd7_24_"></div></td>
          <td class="lhcl_right" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_24_END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_rd7_25_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_rd7_25_}</div>{/if}
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_25_BEGIN}</td>
          <td class="lhcl_center" width="33%">
<input {if $SURVEY_DATA.rd7_25_.data == '1'} checked {/if} type="radio" name="rd7_25_" id="rd7_25__1" value="1" onclick="_d('func_1', 'rd7_25__1')">
<input {if $SURVEY_DATA.rd7_25_.data == '2'} checked {/if} type="radio" name="rd7_25_" id="rd7_25__2" value="2" onclick="_d('func_1', 'rd7_25__2')">
<input {if $SURVEY_DATA.rd7_25_.data == '3'} checked {/if} type="radio" name="rd7_25_" id="rd7_25__3" value="3" onclick="_d('func_1', 'rd7_25__3')">
<input {if $SURVEY_DATA.rd7_25_.data == '4'} checked {/if} type="radio" name="rd7_25_" id="rd7_25__4" value="4" onclick="_d('func_1', 'rd7_25__4')">
<input {if $SURVEY_DATA.rd7_25_.data == '5'} checked {/if} type="radio" name="rd7_25_" id="rd7_25__5" value="5" onclick="_d('func_1', 'rd7_25__5')">
<input {if $SURVEY_DATA.rd7_25_.data == '6'} checked {/if} type="radio" name="rd7_25_" id="rd7_25__6" value="6" onclick="_d('func_1', 'rd7_25__6')">
<input {if $SURVEY_DATA.rd7_25_.data == '7'} checked {/if} type="radio" name="rd7_25_" id="rd7_25__7" value="7" onclick="_d('func_1', 'rd7_25__7')">
<div class="lhcl_statusbox" id="status_rd7_25_"></div></td>
          <td class="lhcl_right" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_25_END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_rd7_26_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_rd7_26_}</div>{/if}
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_26_BEGIN}</td>
          <td class="lhcl_center" width="33%">
<input {if $SURVEY_DATA.rd7_26_.data == '1'} checked {/if} type="radio" name="rd7_26_" id="rd7_26__1" value="1" onclick="_d('func_1', 'rd7_26__1')">
<input {if $SURVEY_DATA.rd7_26_.data == '2'} checked {/if} type="radio" name="rd7_26_" id="rd7_26__2" value="2" onclick="_d('func_1', 'rd7_26__2')">
<input {if $SURVEY_DATA.rd7_26_.data == '3'} checked {/if} type="radio" name="rd7_26_" id="rd7_26__3" value="3" onclick="_d('func_1', 'rd7_26__3')">
<input {if $SURVEY_DATA.rd7_26_.data == '4'} checked {/if} type="radio" name="rd7_26_" id="rd7_26__4" value="4" onclick="_d('func_1', 'rd7_26__4')">
<input {if $SURVEY_DATA.rd7_26_.data == '5'} checked {/if} type="radio" name="rd7_26_" id="rd7_26__5" value="5" onclick="_d('func_1', 'rd7_26__5')">
<input {if $SURVEY_DATA.rd7_26_.data == '6'} checked {/if} type="radio" name="rd7_26_" id="rd7_26__6" value="6" onclick="_d('func_1', 'rd7_26__6')">
<input {if $SURVEY_DATA.rd7_26_.data == '7'} checked {/if} type="radio" name="rd7_26_" id="rd7_26__7" value="7" onclick="_d('func_1', 'rd7_26__7')">
<div class="lhcl_statusbox" id="status_rd7_26_"></div></td>
          <td class="lhcl_right" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_26_END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_rd7_27_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_rd7_27_}</div>{/if}
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_27_BEGIN}</td>
          <td class="lhcl_center" width="33%">
<input {if $SURVEY_DATA.rd7_27_.data == '1'} checked {/if} type="radio" name="rd7_27_" id="rd7_27__1" value="1" onclick="_d('func_1', 'rd7_27__1')">
<input {if $SURVEY_DATA.rd7_27_.data == '2'} checked {/if} type="radio" name="rd7_27_" id="rd7_27__2" value="2" onclick="_d('func_1', 'rd7_27__2')">
<input {if $SURVEY_DATA.rd7_27_.data == '3'} checked {/if} type="radio" name="rd7_27_" id="rd7_27__3" value="3" onclick="_d('func_1', 'rd7_27__3')">
<input {if $SURVEY_DATA.rd7_27_.data == '4'} checked {/if} type="radio" name="rd7_27_" id="rd7_27__4" value="4" onclick="_d('func_1', 'rd7_27__4')">
<input {if $SURVEY_DATA.rd7_27_.data == '5'} checked {/if} type="radio" name="rd7_27_" id="rd7_27__5" value="5" onclick="_d('func_1', 'rd7_27__5')">
<input {if $SURVEY_DATA.rd7_27_.data == '6'} checked {/if} type="radio" name="rd7_27_" id="rd7_27__6" value="6" onclick="_d('func_1', 'rd7_27__6')">
<input {if $SURVEY_DATA.rd7_27_.data == '7'} checked {/if} type="radio" name="rd7_27_" id="rd7_27__7" value="7" onclick="_d('func_1', 'rd7_27__7')">
<div class="lhcl_statusbox" id="status_rd7_27_"></div></td>
          <td class="lhcl_right" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_27_END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_txa_28_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_txa_28_}</div>{/if}
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left">{$STRINGS.SURVEY_STRINGS.CAPTION_txa_28_}</td>
        </tr>
        <tr>
          <td class="lhcl_center"><textarea tabindex="19" class=""
            onkeyup="_d('func_4', 'txa_28_')" onblur="_d('func_2', 'txa_28_')"
            onfocus="_d('func_1', 'txa_28_')"
            onkeydown="_d('func_4', 'txa_28_')" name="txa_28_"
            id="txa_28_">{if $SURVEY_DATA.txa_28_.data}{$SURVEY_DATA.txa_28_.data}{else}{$STRINGS.SURVEY_STRINGS.TEXTAREA_HINT_EDIT}{/if}</textarea>
          <div class="lhcl_statusbox" id="status_txa_28_"></div>
          {* <br/>
          <div class="lhcl_statusbox" id="status_txa_28_"
            style="color: rgb(102, 102, 102);">
          <table>
            <tbody>
              <tr>
                <td class="lhcl_status"><img class="lhcl_statusimg"
                  src="img/check.gif"></td>
                <td class="lhcl_status">This caption has been saved.</td>
                <td class="lhcl_undo"><a
                  href="javascript:_d('func_3', '0')">Undo</a></td>
              </tr>
            </tbody>
          </table>
          </div>
          <br/>
          <div class="lhcl_statusbox" id="status_txa_28_"
            style="color: rgb(102, 102, 102);"><span
            class="lhcl_statusdefault">Changes to captions are
          automatically saved.</span></div>
          <br/>
          <div class="lhcl_statusbox" id="status_txa_28_"
            style="color: rgb(102, 102, 102);">
          <table>
            <tbody>
              <tr>
                <td class="lhcl_status"><img class="lhcl_statusimg"
                  src="img/saving.gif"></td>
                <td class="lhcl_status">saving</td>
              </tr>
            </tbody>
          </table>
          </div>
          *}</td>
        </tr>
      </tbody>
    </table>
    </div>
    </div>
    </div>
    </div>
    <div class="lhcl_captionsnav">
    <table class="lhcl_batchtools">
      <tbody>
        <tr>
          <td>
<input type="button" onclick="_d('doBack',2)"
            value="{$STRINGS.SURVEY_STRINGS.PAGE_BUTTON_CAPTION_BACK}" class="lhcl_default"></td>
          <td class="lhcl_batchnav" id="lhid_batchnav_top" />
          <td align="right">
<input type="button"
            onclick="_d('doNext',4)" value="{$STRINGS.SURVEY_STRINGS.PAGE_BUTTON_CAPTION_NEXT}" class="lhcl_default"></td>
        </tr>
      </tbody>
    </table>
    </div>
    </td>
  </tr>
</table>
</div>
<div id="page_4">
<table>
  <tr>
    <td>
    <div class="lhcl_captionsnav">
    <table class="lhcl_batchtools">
      <tbody>
        <tr>
          <td class="lhcl_title2">{$STRINGS.SURVEY_STRINGS.CAPTION_SURVEY} <span class="lhcl_albumname">{$STRINGS.SURVEY_STRINGS.CAPTION_SURVEY_NAME} : {$STRINGS.SURVEY_STRINGS.PAGE_TITLE_5_}</span></td>
          <td class="lhcl_batchnav">[5/9]</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div id="lhid_edit_frame">
    <div id="lhid_batchcaptionbox">
    <div id="lhid_captions">
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_rd7_29_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_rd7_29_}</div>{/if}
    <div class="lhcl_captionspacer"></div>
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left b" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_VALUE_BEGIN}</td>
          <td class="lhcl_center nobr" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_VALUE_VALUES}</td>
          <td class="lhcl_right b" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_VALUE_END}</td>
        </tr>
      </tbody>
    </table>
    </div>

    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_29_BEGIN}</td>
          <td class="lhcl_center" width="33%">
<input {if $SURVEY_DATA.rd7_29_.data == '1'} checked {/if} type="radio" name="rd7_29_" id="rd7_29__1" value="1" onclick="_d('func_1', 'rd7_29__1')">
<input {if $SURVEY_DATA.rd7_29_.data == '2'} checked {/if} type="radio" name="rd7_29_" id="rd7_29__2" value="2" onclick="_d('func_1', 'rd7_29__2')">
<input {if $SURVEY_DATA.rd7_29_.data == '3'} checked {/if} type="radio" name="rd7_29_" id="rd7_29__3" value="3" onclick="_d('func_1', 'rd7_29__3')">
<input {if $SURVEY_DATA.rd7_29_.data == '4'} checked {/if} type="radio" name="rd7_29_" id="rd7_29__4" value="4" onclick="_d('func_1', 'rd7_29__4')">
<input {if $SURVEY_DATA.rd7_29_.data == '5'} checked {/if} type="radio" name="rd7_29_" id="rd7_29__5" value="5" onclick="_d('func_1', 'rd7_29__5')">
<input {if $SURVEY_DATA.rd7_29_.data == '6'} checked {/if} type="radio" name="rd7_29_" id="rd7_29__6" value="6" onclick="_d('func_1', 'rd7_29__6')">
<input {if $SURVEY_DATA.rd7_29_.data == '7'} checked {/if} type="radio" name="rd7_29_" id="rd7_29__7" value="7" onclick="_d('func_1', 'rd7_29__7')">
<div class="lhcl_statusbox" id="status_rd7_29_"></div></td>
          <td class="lhcl_right" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_29_END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_rd7_30_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_rd7_30_}</div>{/if}
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_30_BEGIN}</td>
          <td class="lhcl_center" width="33%">
<input {if $SURVEY_DATA.rd7_30_.data == '1'} checked {/if} type="radio" name="rd7_30_" id="rd7_30__1" value="1" onclick="_d('func_1', 'rd7_30__1')">
<input {if $SURVEY_DATA.rd7_30_.data == '2'} checked {/if} type="radio" name="rd7_30_" id="rd7_30__2" value="2" onclick="_d('func_1', 'rd7_30__2')">
<input {if $SURVEY_DATA.rd7_30_.data == '3'} checked {/if} type="radio" name="rd7_30_" id="rd7_30__3" value="3" onclick="_d('func_1', 'rd7_30__3')">
<input {if $SURVEY_DATA.rd7_30_.data == '4'} checked {/if} type="radio" name="rd7_30_" id="rd7_30__4" value="4" onclick="_d('func_1', 'rd7_30__4')">
<input {if $SURVEY_DATA.rd7_30_.data == '5'} checked {/if} type="radio" name="rd7_30_" id="rd7_30__5" value="5" onclick="_d('func_1', 'rd7_30__5')">
<input {if $SURVEY_DATA.rd7_30_.data == '6'} checked {/if} type="radio" name="rd7_30_" id="rd7_30__6" value="6" onclick="_d('func_1', 'rd7_30__6')">
<input {if $SURVEY_DATA.rd7_30_.data == '7'} checked {/if} type="radio" name="rd7_30_" id="rd7_30__7" value="7" onclick="_d('func_1', 'rd7_30__7')">
<div class="lhcl_statusbox" id="status_rd7_30_"></div></td>
          <td class="lhcl_right" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_30_END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_rd7_31_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_rd7_31_}</div>{/if}
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_31_BEGIN}</td>
          <td class="lhcl_center" width="33%">
<input {if $SURVEY_DATA.rd7_30_.data == '1'} checked {/if} type="radio" name="rd7_31_" id="rd7_31__1" value="1" onclick="_d('func_1', 'rd7_31__1')">
<input {if $SURVEY_DATA.rd7_30_.data == '2'} checked {/if} type="radio" name="rd7_31_" id="rd7_31__2" value="2" onclick="_d('func_1', 'rd7_31__2')">
<input {if $SURVEY_DATA.rd7_30_.data == '3'} checked {/if} type="radio" name="rd7_31_" id="rd7_31__3" value="3" onclick="_d('func_1', 'rd7_31__3')">
<input {if $SURVEY_DATA.rd7_30_.data == '4'} checked {/if} type="radio" name="rd7_31_" id="rd7_31__4" value="4" onclick="_d('func_1', 'rd7_31__4')">
<input {if $SURVEY_DATA.rd7_30_.data == '5'} checked {/if} type="radio" name="rd7_31_" id="rd7_31__5" value="5" onclick="_d('func_1', 'rd7_31__5')">
<input {if $SURVEY_DATA.rd7_30_.data == '6'} checked {/if} type="radio" name="rd7_31_" id="rd7_31__6" value="6" onclick="_d('func_1', 'rd7_31__6')">
<input {if $SURVEY_DATA.rd7_30_.data == '7'} checked {/if} type="radio" name="rd7_31_" id="rd7_31__7" value="7" onclick="_d('func_1', 'rd7_31__7')">
<div class="lhcl_statusbox" id="status_rd7_31_"></div></td>
          <td class="lhcl_right" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_31_END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_rd7_32_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_rd7_32_}</div>{/if}
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_32_BEGIN}</td>
          <td class="lhcl_center" width="33%">
<input {if $SURVEY_DATA.rd7_32_.data == '1'} checked {/if} type="radio" name="rd7_32_" id="rd7_32__1" value="1" onclick="_d('func_1', 'rd7_32__1')">
<input {if $SURVEY_DATA.rd7_32_.data == '2'} checked {/if} type="radio" name="rd7_32_" id="rd7_32__2" value="2" onclick="_d('func_1', 'rd7_32__2')">
<input {if $SURVEY_DATA.rd7_32_.data == '3'} checked {/if} type="radio" name="rd7_32_" id="rd7_32__3" value="3" onclick="_d('func_1', 'rd7_32__3')">
<input {if $SURVEY_DATA.rd7_32_.data == '4'} checked {/if} type="radio" name="rd7_32_" id="rd7_32__4" value="4" onclick="_d('func_1', 'rd7_32__4')">
<input {if $SURVEY_DATA.rd7_32_.data == '5'} checked {/if} type="radio" name="rd7_32_" id="rd7_32__5" value="5" onclick="_d('func_1', 'rd7_32__5')">
<input {if $SURVEY_DATA.rd7_32_.data == '6'} checked {/if} type="radio" name="rd7_32_" id="rd7_32__6" value="6" onclick="_d('func_1', 'rd7_32__6')">
<input {if $SURVEY_DATA.rd7_32_.data == '7'} checked {/if} type="radio" name="rd7_32_" id="rd7_32__7" value="7" onclick="_d('func_1', 'rd7_32__7')">
<div class="lhcl_statusbox" id="status_rd7_32_"></div></td>
          <td class="lhcl_right" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_32_END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_rd7_33_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_rd7_33_}</div>{/if}
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_33_BEGIN}</td>
          <td class="lhcl_center" width="33%">
<input {if $SURVEY_DATA.rd7_33_.data == '1'} checked {/if} type="radio" name="rd7_33_" id="rd7_33__1" value="1" onclick="_d('func_1', 'rd7_33__1')">
<input {if $SURVEY_DATA.rd7_33_.data == '2'} checked {/if} type="radio" name="rd7_33_" id="rd7_33__2" value="2" onclick="_d('func_1', 'rd7_33__2')">
<input {if $SURVEY_DATA.rd7_33_.data == '3'} checked {/if} type="radio" name="rd7_33_" id="rd7_33__3" value="3" onclick="_d('func_1', 'rd7_33__3')">
<input {if $SURVEY_DATA.rd7_33_.data == '4'} checked {/if} type="radio" name="rd7_33_" id="rd7_33__4" value="4" onclick="_d('func_1', 'rd7_33__4')">
<input {if $SURVEY_DATA.rd7_33_.data == '5'} checked {/if} type="radio" name="rd7_33_" id="rd7_33__5" value="5" onclick="_d('func_1', 'rd7_33__5')">
<input {if $SURVEY_DATA.rd7_33_.data == '6'} checked {/if} type="radio" name="rd7_33_" id="rd7_33__6" value="6" onclick="_d('func_1', 'rd7_33__6')">
<input {if $SURVEY_DATA.rd7_33_.data == '7'} checked {/if} type="radio" name="rd7_33_" id="rd7_33__7" value="7" onclick="_d('func_1', 'rd7_33__7')">
<div class="lhcl_statusbox" id="status_rd7_33_"></div></td>
          <td class="lhcl_right" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_33_END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_rd7_34_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_rd7_34_}</div>{/if}
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_34_BEGIN}</td>
          <td class="lhcl_center" width="33%">
<input {if $SURVEY_DATA.rd7_34_.data == '1'} checked {/if} type="radio" name="rd7_34_" id="rd7_34__1" value="1" onclick="_d('func_1', 'rd7_34__1')">
<input {if $SURVEY_DATA.rd7_34_.data == '2'} checked {/if} type="radio" name="rd7_34_" id="rd7_34__2" value="2" onclick="_d('func_1', 'rd7_34__2')">
<input {if $SURVEY_DATA.rd7_34_.data == '3'} checked {/if} type="radio" name="rd7_34_" id="rd7_34__3" value="3" onclick="_d('func_1', 'rd7_34__3')">
<input {if $SURVEY_DATA.rd7_34_.data == '4'} checked {/if} type="radio" name="rd7_34_" id="rd7_34__4" value="4" onclick="_d('func_1', 'rd7_34__4')">
<input {if $SURVEY_DATA.rd7_34_.data == '5'} checked {/if} type="radio" name="rd7_34_" id="rd7_34__5" value="5" onclick="_d('func_1', 'rd7_34__5')">
<input {if $SURVEY_DATA.rd7_34_.data == '6'} checked {/if} type="radio" name="rd7_34_" id="rd7_34__6" value="6" onclick="_d('func_1', 'rd7_34__6')">
<input {if $SURVEY_DATA.rd7_34_.data == '7'} checked {/if} type="radio" name="rd7_34_" id="rd7_34__7" value="7" onclick="_d('func_1', 'rd7_34__7')">
<div class="lhcl_statusbox" id="status_rd7_34_"></div></td>
          <td class="lhcl_right" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_34_END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_txa_35_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_txa_35_}</div>{/if}
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left">{$STRINGS.SURVEY_STRINGS.CAPTION_txa_35_}</td>
        </tr>
        <tr>
          <td class="lhcl_center"><textarea tabindex="19" class=""
            onkeyup="_d('func_4', 'txa_35_')" onblur="_d('func_2', 'txa_35_')"
            onfocus="_d('func_1', 'txa_35_')"
            onkeydown="_d('func_4', 'txa_35_')" name="txa_35_"
            id="txa_35_">{if $SURVEY_DATA.txa_35_.data}{$SURVEY_DATA.txa_35_.data}{else}{$STRINGS.SURVEY_STRINGS.TEXTAREA_HINT_EDIT}{/if}</textarea>
          <div class="lhcl_statusbox" id="status_txa_35_"></div>
          {* <br/>
          <div class="lhcl_statusbox" id="status_txa_35_"
            style="color: rgb(102, 102, 102);">
          <table>
            <tbody>
              <tr>
                <td class="lhcl_status"><img class="lhcl_statusimg"
                  src="img/check.gif"></td>
                <td class="lhcl_status">This caption has been saved.</td>
                <td class="lhcl_undo"><a
                  href="javascript:_d('func_3', '0')">Undo</a></td>
              </tr>
            </tbody>
          </table>
          </div>
          <br/>
          <div class="lhcl_statusbox" id="status_txa_35_"
            style="color: rgb(102, 102, 102);"><span
            class="lhcl_statusdefault">Changes to captions are automatically saved.</span></div>
          <br/>
          <div class="lhcl_statusbox" id="status_txa_35_"
            style="color: rgb(102, 102, 102);">
          <table>
            <tbody>
              <tr>
                <td class="lhcl_status"><img class="lhcl_statusimg" src="img/saving.gif"></td>
                <td class="lhcl_status">saving</td>
              </tr>
            </tbody>
          </table>
          </div>
          *}</td>
        </tr>
      </tbody>
    </table>
    </div>
    </div>
    </div>
    </div>
    <div class="lhcl_captionsnav">
    <table class="lhcl_batchtools">
      <tbody>
        <tr>
          <td><input type="button" onclick="_d('doBack',3)" value="{$STRINGS.SURVEY_STRINGS.PAGE_BUTTON_CAPTION_BACK}" class="lhcl_default"></td>
          <td class="lhcl_batchnav" id="lhid_batchnav_top" />
          <td align="right"><input type="button" onclick="_d('doNext',5)" value="{$STRINGS.SURVEY_STRINGS.PAGE_BUTTON_CAPTION_NEXT}" class="lhcl_default"></td>
        </tr>
      </tbody>
    </table>
    </div>
    </td>
  </tr>
</table>
</div>
<div id="page_5">
<table>
  <tr>
    <td>
    <div class="lhcl_captionsnav">
    <table class="lhcl_batchtools">
      <tbody>
        <tr>
          <td class="lhcl_title2">{$STRINGS.SURVEY_STRINGS.CAPTION_SURVEY} <span class="lhcl_albumname">{$STRINGS.SURVEY_STRINGS.CAPTION_SURVEY_NAME} : {$STRINGS.SURVEY_STRINGS.PAGE_TITLE_6_}</span></td>
          <td class="lhcl_batchnav">[6/9]</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div id="lhid_edit_frame">
    <div id="lhid_batchcaptionbox">
    <div id="lhid_captions">
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_rd7_36_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_rd7_36_}</div>{/if}
    <div class="lhcl_captionspacer"></div>
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left b" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_VALUE_BEGIN}</td>
          <td class="lhcl_center nobr" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_VALUE_VALUES}</td>
          <td class="lhcl_right b" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_VALUE_END}</td>
        </tr>
      </tbody>
    </table>
    </div>

    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_36_BEGIN}</td>
          <td class="lhcl_center" width="33%">
<input {if $SURVEY_DATA.rd7_36_.data == '1'} checked {/if} type="radio" name="rd7_36_" id="rd7_36__1" value="1" onclick="_d('func_1', 'rd7_36__1')">
<input {if $SURVEY_DATA.rd7_36_.data == '2'} checked {/if} type="radio" name="rd7_36_" id="rd7_36__2" value="2" onclick="_d('func_1', 'rd7_36__2')">
<input {if $SURVEY_DATA.rd7_36_.data == '3'} checked {/if} type="radio" name="rd7_36_" id="rd7_36__3" value="3" onclick="_d('func_1', 'rd7_36__3')">
<input {if $SURVEY_DATA.rd7_36_.data == '4'} checked {/if} type="radio" name="rd7_36_" id="rd7_36__4" value="4" onclick="_d('func_1', 'rd7_36__4')">
<input {if $SURVEY_DATA.rd7_36_.data == '5'} checked {/if} type="radio" name="rd7_36_" id="rd7_36__5" value="5" onclick="_d('func_1', 'rd7_36__5')">
<input {if $SURVEY_DATA.rd7_36_.data == '6'} checked {/if} type="radio" name="rd7_36_" id="rd7_36__6" value="6" onclick="_d('func_1', 'rd7_36__6')">
<input {if $SURVEY_DATA.rd7_36_.data == '7'} checked {/if} type="radio" name="rd7_36_" id="rd7_36__7" value="7" onclick="_d('func_1', 'rd7_36__7')">
<div class="lhcl_statusbox" id="status_rd7_36_"></div></td>
          <td class="lhcl_right" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_36_END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_rd7_37_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_rd7_37_}</div>{/if}
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_37_BEGIN}</td>
          <td class="lhcl_center" width="33%">
<input {if $SURVEY_DATA.rd7_37_.data == '1'} checked {/if} type="radio" name="rd7_37_" id="rd7_37__1" value="1" onclick="_d('func_1', 'rd7_37__1')">
<input {if $SURVEY_DATA.rd7_37_.data == '2'} checked {/if} type="radio" name="rd7_37_" id="rd7_37__2" value="2" onclick="_d('func_1', 'rd7_37__2')">
<input {if $SURVEY_DATA.rd7_37_.data == '3'} checked {/if} type="radio" name="rd7_37_" id="rd7_37__3" value="3" onclick="_d('func_1', 'rd7_37__3')">
<input {if $SURVEY_DATA.rd7_37_.data == '4'} checked {/if} type="radio" name="rd7_37_" id="rd7_37__4" value="4" onclick="_d('func_1', 'rd7_37__4')">
<input {if $SURVEY_DATA.rd7_37_.data == '5'} checked {/if} type="radio" name="rd7_37_" id="rd7_37__5" value="5" onclick="_d('func_1', 'rd7_37__5')">
<input {if $SURVEY_DATA.rd7_37_.data == '6'} checked {/if} type="radio" name="rd7_37_" id="rd7_37__6" value="6" onclick="_d('func_1', 'rd7_37__6')">
<input {if $SURVEY_DATA.rd7_37_.data == '7'} checked {/if} type="radio" name="rd7_37_" id="rd7_37__7" value="7" onclick="_d('func_1', 'rd7_37__7')">
<div class="lhcl_statusbox" id="status_rd7_37_"></div></td>
          <td class="lhcl_right" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_37_END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_rd7_38_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_rd7_38_}</div>{/if}
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_38_BEGIN}</td>
          <td class="lhcl_center" width="33%">
<input {if $SURVEY_DATA.rd7_38_.data == '1'} checked {/if} type="radio" name="rd7_38_" id="rd7_38__1" value="1" onclick="_d('func_1', 'rd7_38__1')">
<input {if $SURVEY_DATA.rd7_38_.data == '2'} checked {/if} type="radio" name="rd7_38_" id="rd7_38__2" value="2" onclick="_d('func_1', 'rd7_38__2')">
<input {if $SURVEY_DATA.rd7_38_.data == '3'} checked {/if} type="radio" name="rd7_38_" id="rd7_38__3" value="3" onclick="_d('func_1', 'rd7_38__3')">
<input {if $SURVEY_DATA.rd7_38_.data == '4'} checked {/if} type="radio" name="rd7_38_" id="rd7_38__4" value="4" onclick="_d('func_1', 'rd7_38__4')">
<input {if $SURVEY_DATA.rd7_38_.data == '5'} checked {/if} type="radio" name="rd7_38_" id="rd7_38__5" value="5" onclick="_d('func_1', 'rd7_38__5')">
<input {if $SURVEY_DATA.rd7_38_.data == '6'} checked {/if} type="radio" name="rd7_38_" id="rd7_38__6" value="6" onclick="_d('func_1', 'rd7_38__6')">
<input {if $SURVEY_DATA.rd7_38_.data == '7'} checked {/if} type="radio" name="rd7_38_" id="rd7_38__7" value="7" onclick="_d('func_1', 'rd7_38__7')">
<div class="lhcl_statusbox" id="status_rd7_38_"></div></td>
          <td class="lhcl_right" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_38_END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_rd7_39_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_rd7_39_}</div>{/if}
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_39_BEGIN}</td>
          <td class="lhcl_center" width="33%">
<input {if $SURVEY_DATA.rd7_39_.data == '1'} checked {/if} type="radio" name="rd7_39_" id="rd7_39__1" value="1" onclick="_d('func_1', 'rd7_39__1')">
<input {if $SURVEY_DATA.rd7_39_.data == '2'} checked {/if} type="radio" name="rd7_39_" id="rd7_39__2" value="2" onclick="_d('func_1', 'rd7_39__2')">
<input {if $SURVEY_DATA.rd7_39_.data == '3'} checked {/if} type="radio" name="rd7_39_" id="rd7_39__3" value="3" onclick="_d('func_1', 'rd7_39__3')">
<input {if $SURVEY_DATA.rd7_39_.data == '4'} checked {/if} type="radio" name="rd7_39_" id="rd7_39__4" value="4" onclick="_d('func_1', 'rd7_39__4')">
<input {if $SURVEY_DATA.rd7_39_.data == '5'} checked {/if} type="radio" name="rd7_39_" id="rd7_39__5" value="5" onclick="_d('func_1', 'rd7_39__5')">
<input {if $SURVEY_DATA.rd7_39_.data == '6'} checked {/if} type="radio" name="rd7_39_" id="rd7_39__6" value="6" onclick="_d('func_1', 'rd7_39__6')">
<input {if $SURVEY_DATA.rd7_39_.data == '7'} checked {/if} type="radio" name="rd7_39_" id="rd7_39__7" value="7" onclick="_d('func_1', 'rd7_39__7')">
<div class="lhcl_statusbox" id="status_rd7_39_"></div></td>
          <td class="lhcl_right" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_39_END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_rd7_40_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_rd7_40_}</div>{/if}
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_40_BEGIN}</td>
          <td class="lhcl_center" width="33%">
<input {if $SURVEY_DATA.rd7_40_.data == '1'} checked {/if} type="radio" name="rd7_40_" id="rd7_40__1" value="1" onclick="_d('func_1', 'rd7_40__1')">
<input {if $SURVEY_DATA.rd7_40_.data == '2'} checked {/if} type="radio" name="rd7_40_" id="rd7_40__2" value="2" onclick="_d('func_1', 'rd7_40__2')">
<input {if $SURVEY_DATA.rd7_40_.data == '3'} checked {/if} type="radio" name="rd7_40_" id="rd7_40__3" value="3" onclick="_d('func_1', 'rd7_40__3')">
<input {if $SURVEY_DATA.rd7_40_.data == '4'} checked {/if} type="radio" name="rd7_40_" id="rd7_40__4" value="4" onclick="_d('func_1', 'rd7_40__4')">
<input {if $SURVEY_DATA.rd7_40_.data == '5'} checked {/if} type="radio" name="rd7_40_" id="rd7_40__5" value="5" onclick="_d('func_1', 'rd7_40__5')">
<input {if $SURVEY_DATA.rd7_40_.data == '6'} checked {/if} type="radio" name="rd7_40_" id="rd7_40__6" value="6" onclick="_d('func_1', 'rd7_40__6')">
<input {if $SURVEY_DATA.rd7_40_.data == '7'} checked {/if} type="radio" name="rd7_40_" id="rd7_40__7" value="7" onclick="_d('func_1', 'rd7_40__7')">
<div class="lhcl_statusbox" id="status_rd7_40_"></div></td>
          <td class="lhcl_right" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_40_END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_rd7_41_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_rd7_41_}</div>{/if}
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_41_BEGIN}</td>
          <td class="lhcl_center" width="33%">
<input {if $SURVEY_DATA.rd7_41_.data == '1'} checked {/if} type="radio" name="rd7_41_" id="rd7_41__1" value="1" onclick="_d('func_1', 'rd7_41__1')">
<input {if $SURVEY_DATA.rd7_41_.data == '2'} checked {/if} type="radio" name="rd7_41_" id="rd7_41__2" value="2" onclick="_d('func_1', 'rd7_41__2')">
<input {if $SURVEY_DATA.rd7_41_.data == '3'} checked {/if} type="radio" name="rd7_41_" id="rd7_41__3" value="3" onclick="_d('func_1', 'rd7_41__3')">
<input {if $SURVEY_DATA.rd7_41_.data == '4'} checked {/if} type="radio" name="rd7_41_" id="rd7_41__4" value="4" onclick="_d('func_1', 'rd7_41__4')">
<input {if $SURVEY_DATA.rd7_41_.data == '5'} checked {/if} type="radio" name="rd7_41_" id="rd7_41__5" value="5" onclick="_d('func_1', 'rd7_41__5')">
<input {if $SURVEY_DATA.rd7_41_.data == '6'} checked {/if} type="radio" name="rd7_41_" id="rd7_41__6" value="6" onclick="_d('func_1', 'rd7_41__6')">
<input {if $SURVEY_DATA.rd7_41_.data == '7'} checked {/if} type="radio" name="rd7_41_" id="rd7_41__7" value="7" onclick="_d('func_1', 'rd7_41__7')">
<div class="lhcl_statusbox" id="status_rd7_41_"></div></td>
          <td class="lhcl_right" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_41_END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_txa_42_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_txa_42_}</div>{/if}
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left">{$STRINGS.SURVEY_STRINGS.CAPTION_txa_42_}</td>
        </tr>
        <tr>
          <td class="lhcl_center"><textarea tabindex="19" class=""
            onkeyup="_d('func_4', 'txa_42_')" onblur="_d('func_2', 'txa_42_')"
            onfocus="_d('func_1', 'txa_42_')"
            onkeydown="_d('func_4', 'txa_42_')" name="txa_42_"
            id="txa_42_">{if $SURVEY_DATA.txa_42_.data}{$SURVEY_DATA.txa_42_.data}{else}{$STRINGS.SURVEY_STRINGS.TEXTAREA_HINT_EDIT}{/if}</textarea>
          <div class="lhcl_statusbox" id="status_txa_42_"></div>
          {* <br/>
          <div class="lhcl_statusbox" id="status_txa_42_"
            style="color: rgb(102, 102, 102);">
          <table>
            <tbody>
              <tr>
                <td class="lhcl_status"><img class="lhcl_statusimg" src="img/check.gif"></td>
                <td class="lhcl_status">This caption has been saved.</td>
                <td class="lhcl_undo"><a href="javascript:_d('func_3', '0')">Undo</a></td>
              </tr>
            </tbody>
          </table>
          </div>
          <br/>
          <div class="lhcl_statusbox" id="status_txa_42_"
            style="color: rgb(102, 102, 102);"><span class="lhcl_statusdefault">Changes to captions are automatically saved.</span></div>
          <br/>
          <div class="lhcl_statusbox" id="status_txa_42_" style="color: rgb(102, 102, 102);">
          <table>
            <tbody>
              <tr>
                <td class="lhcl_status"><img class="lhcl_statusimg" src="img/saving.gif"></td>
                <td class="lhcl_status">saving</td>
              </tr>
            </tbody>
          </table>
          </div>
          *}</td>
        </tr>
      </tbody>
    </table>
    </div>
    </div>
    </div>
    </div>
    <div class="lhcl_captionsnav">
    <table class="lhcl_batchtools">
      <tbody>
        <tr>
          <td><input type="button" onclick="_d('doBack',4)" value="{$STRINGS.SURVEY_STRINGS.PAGE_BUTTON_CAPTION_BACK}" class="lhcl_default"></td>
          <td class="lhcl_batchnav" id="lhid_batchnav_top" />
          <td align="right"><input type="button" onclick="_d('doNext',6)" value="{$STRINGS.SURVEY_STRINGS.PAGE_BUTTON_CAPTION_NEXT}" class="lhcl_default"></td>
        </tr>
      </tbody>
    </table>
    </div>
    </td>
  </tr>
</table>
</div>
<div id="page_6">
<table>
  <tr>
    <td>
    <div class="lhcl_captionsnav">
    <table class="lhcl_batchtools">
      <tbody>
        <tr>
          <td class="lhcl_title2">{$STRINGS.SURVEY_STRINGS.CAPTION_SURVEY} <span class="lhcl_albumname">{$STRINGS.SURVEY_STRINGS.CAPTION_SURVEY_NAME} : {$STRINGS.SURVEY_STRINGS.PAGE_TITLE_7_}</span></td>
          <td class="lhcl_batchnav">[7/9]</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div id="lhid_edit_frame">
    <div id="lhid_batchcaptionbox">
    <div id="lhid_captions">
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_rd7_43_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_rd7_43_}</div>{/if}
    <div class="lhcl_captionspacer"></div>
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left b" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_VALUE_BEGIN}</td>
          <td class="lhcl_center nobr" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_VALUE_VALUES}</td>
          <td class="lhcl_right b" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_VALUE_END}</td>
        </tr>
      </tbody>
    </table>
    </div>

    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_43_BEGIN}</td>
          <td class="lhcl_center" width="33%">
<input {if $SURVEY_DATA.rd7_43_.data == '1'} checked {/if} type="radio" name="rd7_43_" id="rd7_43__1" value="1" onclick="_d('func_1', 'rd7_43__1')">
<input {if $SURVEY_DATA.rd7_43_.data == '2'} checked {/if} type="radio" name="rd7_43_" id="rd7_43__2" value="2" onclick="_d('func_1', 'rd7_43__2')">
<input {if $SURVEY_DATA.rd7_43_.data == '3'} checked {/if} type="radio" name="rd7_43_" id="rd7_43__3" value="3" onclick="_d('func_1', 'rd7_43__3')">
<input {if $SURVEY_DATA.rd7_43_.data == '4'} checked {/if} type="radio" name="rd7_43_" id="rd7_43__4" value="4" onclick="_d('func_1', 'rd7_43__4')">
<input {if $SURVEY_DATA.rd7_43_.data == '5'} checked {/if} type="radio" name="rd7_43_" id="rd7_43__5" value="5" onclick="_d('func_1', 'rd7_43__5')">
<input {if $SURVEY_DATA.rd7_43_.data == '6'} checked {/if} type="radio" name="rd7_43_" id="rd7_43__6" value="6" onclick="_d('func_1', 'rd7_43__6')">
<input {if $SURVEY_DATA.rd7_43_.data == '7'} checked {/if} type="radio" name="rd7_43_" id="rd7_43__7" value="7" onclick="_d('func_1', 'rd7_43__7')">
<div class="lhcl_statusbox" id="status_rd7_43_"></div></td>
          <td class="lhcl_right" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_43_END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_rd7_44_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_rd7_44_}</div>{/if}
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_44_BEGIN}</td>
          <td class="lhcl_center" width="33%">
<input {if $SURVEY_DATA.rd7_44_.data == '1'} checked {/if} type="radio" name="rd7_44_" id="rd7_44__1" value="1" onclick="_d('func_1', 'rd7_44__1')">
<input {if $SURVEY_DATA.rd7_44_.data == '2'} checked {/if} type="radio" name="rd7_44_" id="rd7_44__2" value="2" onclick="_d('func_1', 'rd7_44__2')">
<input {if $SURVEY_DATA.rd7_44_.data == '3'} checked {/if} type="radio" name="rd7_44_" id="rd7_44__3" value="3" onclick="_d('func_1', 'rd7_44__3')">
<input {if $SURVEY_DATA.rd7_44_.data == '4'} checked {/if} type="radio" name="rd7_44_" id="rd7_44__4" value="4" onclick="_d('func_1', 'rd7_44__4')">
<input {if $SURVEY_DATA.rd7_44_.data == '5'} checked {/if} type="radio" name="rd7_44_" id="rd7_44__5" value="5" onclick="_d('func_1', 'rd7_44__5')">
<input {if $SURVEY_DATA.rd7_44_.data == '6'} checked {/if} type="radio" name="rd7_44_" id="rd7_44__6" value="6" onclick="_d('func_1', 'rd7_44__6')">
<input {if $SURVEY_DATA.rd7_44_.data == '7'} checked {/if} type="radio" name="rd7_44_" id="rd7_44__7" value="7" onclick="_d('func_1', 'rd7_44__7')">
<div class="lhcl_statusbox" id="status_rd7_44_"></div></td>
          <td class="lhcl_right" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_44_END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_rd7_45_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_rd7_45_}</div>{/if}
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_45_BEGIN}</td>
          <td class="lhcl_center" width="33%">
<input {if $SURVEY_DATA.rd7_45_.data == '1'} checked {/if} type="radio" name="rd7_45_" id="rd7_45__1" value="1" onclick="_d('func_1', 'rd7_45__1')">
<input {if $SURVEY_DATA.rd7_45_.data == '2'} checked {/if} type="radio" name="rd7_45_" id="rd7_45__2" value="2" onclick="_d('func_1', 'rd7_45__2')">
<input {if $SURVEY_DATA.rd7_45_.data == '3'} checked {/if} type="radio" name="rd7_45_" id="rd7_45__3" value="3" onclick="_d('func_1', 'rd7_45__3')">
<input {if $SURVEY_DATA.rd7_45_.data == '4'} checked {/if} type="radio" name="rd7_45_" id="rd7_45__4" value="4" onclick="_d('func_1', 'rd7_45__4')">
<input {if $SURVEY_DATA.rd7_45_.data == '5'} checked {/if} type="radio" name="rd7_45_" id="rd7_45__5" value="5" onclick="_d('func_1', 'rd7_45__5')">
<input {if $SURVEY_DATA.rd7_45_.data == '6'} checked {/if} type="radio" name="rd7_45_" id="rd7_45__6" value="6" onclick="_d('func_1', 'rd7_45__6')">
<input {if $SURVEY_DATA.rd7_45_.data == '7'} checked {/if} type="radio" name="rd7_45_" id="rd7_45__7" value="7" onclick="_d('func_1', 'rd7_45__7')">
<div class="lhcl_statusbox" id="status_rd7_45_"></div></td>
          <td class="lhcl_right" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_45_END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_rd7_46_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_rd7_46_}</div>{/if}
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_46_BEGIN}</td>
          <td class="lhcl_center" width="33%">
<input {if $SURVEY_DATA.rd7_46_.data == '1'} checked {/if} type="radio" name="rd7_46_" id="rd7_46__1" value="1" onclick="_d('func_1', 'rd7_46__1')">
<input {if $SURVEY_DATA.rd7_46_.data == '2'} checked {/if} type="radio" name="rd7_46_" id="rd7_46__2" value="2" onclick="_d('func_1', 'rd7_46__2')">
<input {if $SURVEY_DATA.rd7_46_.data == '3'} checked {/if} type="radio" name="rd7_46_" id="rd7_46__3" value="3" onclick="_d('func_1', 'rd7_46__3')">
<input {if $SURVEY_DATA.rd7_46_.data == '4'} checked {/if} type="radio" name="rd7_46_" id="rd7_46__4" value="4" onclick="_d('func_1', 'rd7_46__4')">
<input {if $SURVEY_DATA.rd7_46_.data == '5'} checked {/if} type="radio" name="rd7_46_" id="rd7_46__5" value="5" onclick="_d('func_1', 'rd7_46__5')">
<input {if $SURVEY_DATA.rd7_46_.data == '6'} checked {/if} type="radio" name="rd7_46_" id="rd7_46__6" value="6" onclick="_d('func_1', 'rd7_46__6')">
<input {if $SURVEY_DATA.rd7_46_.data == '7'} checked {/if} type="radio" name="rd7_46_" id="rd7_46__7" value="7" onclick="_d('func_1', 'rd7_46__7')">
<div class="lhcl_statusbox" id="status_rd7_46_"></div></td>
          <td class="lhcl_right" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_46_END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_rd7_47_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_rd7_47_}</div>{/if}
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_47_BEGIN}</td>
          <td class="lhcl_center" width="33%">
<input {if $SURVEY_DATA.rd7_47_.data == '1'} checked {/if} type="radio" name="rd7_47_" id="rd7_47__1" value="1" onclick="_d('func_1', 'rd7_47__1')">
<input {if $SURVEY_DATA.rd7_47_.data == '2'} checked {/if} type="radio" name="rd7_47_" id="rd7_47__2" value="2" onclick="_d('func_1', 'rd7_47__2')">
<input {if $SURVEY_DATA.rd7_47_.data == '3'} checked {/if} type="radio" name="rd7_47_" id="rd7_47__3" value="3" onclick="_d('func_1', 'rd7_47__3')">
<input {if $SURVEY_DATA.rd7_47_.data == '4'} checked {/if} type="radio" name="rd7_47_" id="rd7_47__4" value="4" onclick="_d('func_1', 'rd7_47__4')">
<input {if $SURVEY_DATA.rd7_47_.data == '5'} checked {/if} type="radio" name="rd7_47_" id="rd7_47__5" value="5" onclick="_d('func_1', 'rd7_47__5')">
<input {if $SURVEY_DATA.rd7_47_.data == '6'} checked {/if} type="radio" name="rd7_47_" id="rd7_47__6" value="6" onclick="_d('func_1', 'rd7_47__6')">
<input {if $SURVEY_DATA.rd7_47_.data == '7'} checked {/if} type="radio" name="rd7_47_" id="rd7_47__7" value="7" onclick="_d('func_1', 'rd7_47__7')">
<div class="lhcl_statusbox" id="status_rd7_47_"></div></td>
          <td class="lhcl_right" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_47_END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_rd7_48_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_rd7_48_}</div>{/if}
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_48_BEGIN}</td>
          <td class="lhcl_center" width="33%">
<input {if $SURVEY_DATA.rd7_48_.data == '1'} checked {/if} type="radio" name="rd7_48_" id="rd7_48__1" value="1" onclick="_d('func_1', 'rd7_48__1')">
<input {if $SURVEY_DATA.rd7_48_.data == '2'} checked {/if} type="radio" name="rd7_48_" id="rd7_48__2" value="2" onclick="_d('func_1', 'rd7_48__2')">
<input {if $SURVEY_DATA.rd7_48_.data == '3'} checked {/if} type="radio" name="rd7_48_" id="rd7_48__3" value="3" onclick="_d('func_1', 'rd7_48__3')">
<input {if $SURVEY_DATA.rd7_48_.data == '4'} checked {/if} type="radio" name="rd7_48_" id="rd7_48__4" value="4" onclick="_d('func_1', 'rd7_48__4')">
<input {if $SURVEY_DATA.rd7_48_.data == '5'} checked {/if} type="radio" name="rd7_48_" id="rd7_48__5" value="5" onclick="_d('func_1', 'rd7_48__5')">
<input {if $SURVEY_DATA.rd7_48_.data == '6'} checked {/if} type="radio" name="rd7_48_" id="rd7_48__6" value="6" onclick="_d('func_1', 'rd7_48__6')">
<input {if $SURVEY_DATA.rd7_48_.data == '7'} checked {/if} type="radio" name="rd7_48_" id="rd7_48__7" value="7" onclick="_d('func_1', 'rd7_48__7')">
<div class="lhcl_statusbox" id="status_rd7_48_"></div></td>
          <td class="lhcl_right" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_48_END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_txa_49_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_txa_49_}</div>{/if}
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left">{$STRINGS.SURVEY_STRINGS.CAPTION_txa_49_}</td>
        </tr>
        <tr>
          <td class="lhcl_center"><textarea tabindex="19" class=""
            onkeyup="_d('func_4', 'txa_49_')" onblur="_d('func_2', 'txa_49_')"
            onfocus="_d('func_1', 'txa_49_')"
            onkeydown="_d('func_4', 'txa_49_')" name="txa_49_"
            id="txa_49_">{if $SURVEY_DATA.txa_49_.data}{$SURVEY_DATA.txa_49_.data}{else}{$STRINGS.SURVEY_STRINGS.TEXTAREA_HINT_EDIT}{/if}</textarea>
          <div class="lhcl_statusbox" id="status_txa_49_"></div>
          {* <br/>
          <div class="lhcl_statusbox" id="status_txa_49_" style="color: rgb(102, 102, 102);">
          <table>
            <tbody>
              <tr>
                <td class="lhcl_status"><img class="lhcl_statusimg" src="img/check.gif"></td>
                <td class="lhcl_status">This caption has been saved.</td>
                <td class="lhcl_undo"><a href="javascript:_d('func_3', '0')">Undo</a></td>
              </tr>
            </tbody>
          </table>
          </div>
          <br/>
          <div class="lhcl_statusbox" id="status_txa_49_" style="color: rgb(102, 102, 102);"><span class="lhcl_statusdefault">Changes to captions are automatically saved.</span></div>
          <br/>
          <div class="lhcl_statusbox" id="status_txa_49_" style="color: rgb(102, 102, 102);">
          <table>
            <tbody>
              <tr>
                <td class="lhcl_status"><img class="lhcl_statusimg" src="img/saving.gif"></td>
                <td class="lhcl_status">saving</td>
              </tr>
            </tbody>
          </table>
          </div>
          *}</td>
        </tr>
      </tbody>
    </table>
    </div>
    </div>
    </div>
    </div>
    <div class="lhcl_captionsnav">
    <table class="lhcl_batchtools">
      <tbody>
        <tr>
          <td>
<input type="button" onclick="_d('doBack',5)" value="{$STRINGS.SURVEY_STRINGS.PAGE_BUTTON_CAPTION_BACK}" class="lhcl_default"></td>
          <td class="lhcl_batchnav" id="lhid_batchnav_top" />
          <td align="right">
<input type="button" onclick="_d('doNext',7)" value="{$STRINGS.SURVEY_STRINGS.PAGE_BUTTON_CAPTION_NEXT}" class="lhcl_default"></td>
        </tr>
      </tbody>
    </table>
    </div>
    </td>
  </tr>
</table>
</div>
<div id="page_7">
<table>
  <tr>
    <td>
    <div class="lhcl_captionsnav">
    <table class="lhcl_batchtools">
      <tbody>
        <tr>
          <td class="lhcl_title2">{$STRINGS.SURVEY_STRINGS.CAPTION_SURVEY} <span class="lhcl_albumname">{$STRINGS.SURVEY_STRINGS.CAPTION_SURVEY_NAME} : {$STRINGS.SURVEY_STRINGS.PAGE_TITLE_8_}</span></td>
          <td class="lhcl_batchnav">[8/9]</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div id="lhid_edit_frame">
    <div id="lhid_batchcaptionbox">
    <div id="lhid_captions">
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_rd7_50_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_rd7_50_}</div>{/if}
    <div class="lhcl_captionspacer"></div>
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left b" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_VALUE_BEGIN}</td>
          <td class="lhcl_center nobr" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_VALUE_VALUES}</td>
          <td class="lhcl_right b" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_VALUE_END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_50_BEGIN}</td>
          <td class="lhcl_center" width="33%">
<input {if $SURVEY_DATA.rd7_50_.data == '1'} checked {/if} type="radio" name="rd7_50_" id="rd7_50__1" value="1" onclick="_d('func_1', 'rd7_50__1')">
<input {if $SURVEY_DATA.rd7_50_.data == '2'} checked {/if} type="radio" name="rd7_50_" id="rd7_50__2" value="2" onclick="_d('func_1', 'rd7_50__2')">
<input {if $SURVEY_DATA.rd7_50_.data == '3'} checked {/if} type="radio" name="rd7_50_" id="rd7_50__3" value="3" onclick="_d('func_1', 'rd7_50__3')">
<input {if $SURVEY_DATA.rd7_50_.data == '4'} checked {/if} type="radio" name="rd7_50_" id="rd7_50__4" value="4" onclick="_d('func_1', 'rd7_50__4')">
<input {if $SURVEY_DATA.rd7_50_.data == '5'} checked {/if} type="radio" name="rd7_50_" id="rd7_50__5" value="5" onclick="_d('func_1', 'rd7_50__5')">
<input {if $SURVEY_DATA.rd7_50_.data == '6'} checked {/if} type="radio" name="rd7_50_" id="rd7_50__6" value="6" onclick="_d('func_1', 'rd7_50__6')">
<input {if $SURVEY_DATA.rd7_50_.data == '7'} checked {/if} type="radio" name="rd7_50_" id="rd7_50__7" value="7" onclick="_d('func_1', 'rd7_50__7')">
<div class="lhcl_statusbox" id="status_rd7_50_"></div></td>
          <td class="lhcl_right" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_50_END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_rd7_51_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_rd7_51_}</div>{/if}
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_51_BEGIN}</td>
          <td class="lhcl_center" width="33%">
<input {if $SURVEY_DATA.rd7_51_.data == '1'} checked {/if} type="radio" name="rd7_51_" id="rd7_51__1" value="1" onclick="_d('func_1', 'rd7_51__1')">
<input {if $SURVEY_DATA.rd7_51_.data == '2'} checked {/if} type="radio" name="rd7_51_" id="rd7_51__2" value="2" onclick="_d('func_1', 'rd7_51__2')">
<input {if $SURVEY_DATA.rd7_51_.data == '3'} checked {/if} type="radio" name="rd7_51_" id="rd7_51__3" value="3" onclick="_d('func_1', 'rd7_51__3')">
<input {if $SURVEY_DATA.rd7_51_.data == '4'} checked {/if} type="radio" name="rd7_51_" id="rd7_51__4" value="4" onclick="_d('func_1', 'rd7_51__4')">
<input {if $SURVEY_DATA.rd7_51_.data == '5'} checked {/if} type="radio" name="rd7_51_" id="rd7_51__5" value="5" onclick="_d('func_1', 'rd7_51__5')">
<input {if $SURVEY_DATA.rd7_51_.data == '6'} checked {/if} type="radio" name="rd7_51_" id="rd7_51__6" value="6" onclick="_d('func_1', 'rd7_51__6')">
<input {if $SURVEY_DATA.rd7_51_.data == '7'} checked {/if} type="radio" name="rd7_51_" id="rd7_51__7" value="7" onclick="_d('func_1', 'rd7_51__7')">
<div class="lhcl_statusbox" id="status_rd7_51_"></div></td>
          <td class="lhcl_right" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_51_END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_rd7_52_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_rd7_52_}</div>{/if}
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_52_BEGIN}</td>
          <td class="lhcl_center" width="33%">
<input {if $SURVEY_DATA.rd7_52_.data == '1'} checked {/if} type="radio" name="rd7_52_" id="rd7_52__1" value="1" onclick="_d('func_1', 'rd7_52__1')">
<input {if $SURVEY_DATA.rd7_52_.data == '2'} checked {/if} type="radio" name="rd7_52_" id="rd7_52__2" value="2" onclick="_d('func_1', 'rd7_52__2')">
<input {if $SURVEY_DATA.rd7_52_.data == '3'} checked {/if} type="radio" name="rd7_52_" id="rd7_52__3" value="3" onclick="_d('func_1', 'rd7_52__3')">
<input {if $SURVEY_DATA.rd7_52_.data == '4'} checked {/if} type="radio" name="rd7_52_" id="rd7_52__4" value="4" onclick="_d('func_1', 'rd7_52__4')">
<input {if $SURVEY_DATA.rd7_52_.data == '5'} checked {/if} type="radio" name="rd7_52_" id="rd7_52__5" value="5" onclick="_d('func_1', 'rd7_52__5')">
<input {if $SURVEY_DATA.rd7_52_.data == '6'} checked {/if} type="radio" name="rd7_52_" id="rd7_52__6" value="6" onclick="_d('func_1', 'rd7_52__6')">
<input {if $SURVEY_DATA.rd7_52_.data == '7'} checked {/if} type="radio" name="rd7_52_" id="rd7_52__7" value="7" onclick="_d('func_1', 'rd7_52__7')">
<div class="lhcl_statusbox" id="status_rd7_52_"></div></td>
          <td class="lhcl_right" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_52_END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_rd7_53_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_rd7_53_}</div>{/if}
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_53_BEGIN}</td>
          <td class="lhcl_center" width="33%">
<input {if $SURVEY_DATA.rd7_53_.data == '1'} checked {/if} type="radio" name="rd7_53_" id="rd7_53__1" value="1" onclick="_d('func_1', 'rd7_53__1')">
<input {if $SURVEY_DATA.rd7_53_.data == '2'} checked {/if} type="radio" name="rd7_53_" id="rd7_53__2" value="2" onclick="_d('func_1', 'rd7_53__2')">
<input {if $SURVEY_DATA.rd7_53_.data == '3'} checked {/if} type="radio" name="rd7_53_" id="rd7_53__3" value="3" onclick="_d('func_1', 'rd7_53__3')">
<input {if $SURVEY_DATA.rd7_53_.data == '4'} checked {/if} type="radio" name="rd7_53_" id="rd7_53__4" value="4" onclick="_d('func_1', 'rd7_53__4')">
<input {if $SURVEY_DATA.rd7_53_.data == '5'} checked {/if} type="radio" name="rd7_53_" id="rd7_53__5" value="5" onclick="_d('func_1', 'rd7_53__5')">
<input {if $SURVEY_DATA.rd7_53_.data == '6'} checked {/if} type="radio" name="rd7_53_" id="rd7_53__6" value="6" onclick="_d('func_1', 'rd7_53__6')">
<input {if $SURVEY_DATA.rd7_53_.data == '7'} checked {/if} type="radio" name="rd7_53_" id="rd7_53__7" value="7" onclick="_d('func_1', 'rd7_53__7')">
<div class="lhcl_statusbox" id="status_rd7_53_"></div></td>
          <td class="lhcl_right" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_53_END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_rd7_54_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_rd7_54_}</div>{/if}
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_54_BEGIN}</td>
          <td class="lhcl_center" width="33%">
<input {if $SURVEY_DATA.rd7_54_.data == '1'} checked {/if} type="radio" name="rd7_54_" id="rd7_54__1" value="1" onclick="_d('func_1', 'rd7_54__1')">
<input {if $SURVEY_DATA.rd7_54_.data == '2'} checked {/if} type="radio" name="rd7_54_" id="rd7_54__2" value="2" onclick="_d('func_1', 'rd7_54__2')">
<input {if $SURVEY_DATA.rd7_54_.data == '3'} checked {/if} type="radio" name="rd7_54_" id="rd7_54__3" value="3" onclick="_d('func_1', 'rd7_54__3')">
<input {if $SURVEY_DATA.rd7_54_.data == '4'} checked {/if} type="radio" name="rd7_54_" id="rd7_54__4" value="4" onclick="_d('func_1', 'rd7_54__4')">
<input {if $SURVEY_DATA.rd7_54_.data == '5'} checked {/if} type="radio" name="rd7_54_" id="rd7_54__5" value="5" onclick="_d('func_1', 'rd7_54__5')">
<input {if $SURVEY_DATA.rd7_54_.data == '6'} checked {/if} type="radio" name="rd7_54_" id="rd7_54__6" value="6" onclick="_d('func_1', 'rd7_54__6')">
<input {if $SURVEY_DATA.rd7_54_.data == '7'} checked {/if} type="radio" name="rd7_54_" id="rd7_54__7" value="7" onclick="_d('func_1', 'rd7_54__7')">
<div class="lhcl_statusbox" id="status_rd7_54_"></div></td>
          <td class="lhcl_right" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_54_END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_rd7_55_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_rd7_55_}</div>{/if}
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_55_BEGIN}</td>
          <td class="lhcl_center" width="33%">
<input {if $SURVEY_DATA.rd7_55_.data == '1'} checked {/if} type="radio" name="rd7_55_" id="rd7_55__1" value="1" onclick="_d('func_1', 'rd7_55__1')">
<input {if $SURVEY_DATA.rd7_55_.data == '2'} checked {/if} type="radio" name="rd7_55_" id="rd7_55__2" value="2" onclick="_d('func_1', 'rd7_55__2')">
<input {if $SURVEY_DATA.rd7_55_.data == '3'} checked {/if} type="radio" name="rd7_55_" id="rd7_55__3" value="3" onclick="_d('func_1', 'rd7_55__3')">
<input {if $SURVEY_DATA.rd7_55_.data == '4'} checked {/if} type="radio" name="rd7_55_" id="rd7_55__4" value="4" onclick="_d('func_1', 'rd7_55__4')">
<input {if $SURVEY_DATA.rd7_55_.data == '5'} checked {/if} type="radio" name="rd7_55_" id="rd7_55__5" value="5" onclick="_d('func_1', 'rd7_55__5')">
<input {if $SURVEY_DATA.rd7_55_.data == '6'} checked {/if} type="radio" name="rd7_55_" id="rd7_55__6" value="6" onclick="_d('func_1', 'rd7_55__6')">
<input {if $SURVEY_DATA.rd7_55_.data == '7'} checked {/if} type="radio" name="rd7_55_" id="rd7_55__7" value="7" onclick="_d('func_1', 'rd7_55__7')">
<div class="lhcl_statusbox" id="status_rd7_55_"></div></td>
          <td class="lhcl_right" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_rd7_55_END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_txa_56_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_txa_56_}</div>{/if}
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left">{$STRINGS.SURVEY_STRINGS.CAPTION_txa_56_}</td>
        </tr>
        <tr>
          <td class="lhcl_center"><textarea tabindex="19" class=""
            onkeyup="_d('func_4', 'txa_56_')" onblur="_d('func_2', 'txa_56_')"
            onfocus="_d('func_1', 'txa_56_')"
            onkeydown="_d('func_4', 'txa_56_')" name="txa_56_"
            id="txa_56_">{if $SURVEY_DATA.txa_56_.data}{$SURVEY_DATA.txa_56_.data}{else}{$STRINGS.SURVEY_STRINGS.TEXTAREA_HINT_EDIT}{/if}</textarea>
          <div class="lhcl_statusbox" id="status_txa_56_"></div>
          {* <br/>
          <div class="lhcl_statusbox" id="status_txa_56_" style="color: rgb(102, 102, 102);">
          <table>
            <tbody>
              <tr>
                <td class="lhcl_status"><img class="lhcl_statusimg" src="img/check.gif"></td>
                <td class="lhcl_status">This caption has been saved.</td>
                <td class="lhcl_undo"><a href="javascript:_d('func_3', '0')">Undo</a></td>
              </tr>
            </tbody>
          </table>
          </div>
          <br/>
          <div class="lhcl_statusbox" id="status_txa_56_" style="color: rgb(102, 102, 102);"><span class="lhcl_statusdefault">Changes to captions are automatically saved.</span></div>
          <br/>
          <div class="lhcl_statusbox" id="status_txa_56_" style="color: rgb(102, 102, 102);">
          <table>
            <tbody>
              <tr>
                <td class="lhcl_status"><img class="lhcl_statusimg" src="img/saving.gif"></td>
                <td class="lhcl_status">saving</td>
              </tr>
            </tbody>
          </table>
          </div>
          *}</td>
        </tr>
      </tbody>
    </table>
    </div>
    </div>
    </div>
    </div>
    <div class="lhcl_captionsnav">
    <table class="lhcl_batchtools">
      <tbody>
        <tr>
          <td>
<input type="button" onclick="_d('doBack',6)" value="{$STRINGS.SURVEY_STRINGS.PAGE_BUTTON_CAPTION_BACK}" class="lhcl_default"></td>
          <td class="lhcl_batchnav" id="lhid_batchnav_top" />
          <td align="right">
<input type="button" onclick="_d('doNext',8)" value="{$STRINGS.SURVEY_STRINGS.PAGE_BUTTON_CAPTION_NEXT}" class="lhcl_default"></td>
        </tr>
      </tbody>
    </table>
    </div>
    </td>
  </tr>
</table>
</div>
<div id="page_8">
<table>
  <tr>
    <td>
    <div class="lhcl_captionsnav">
    <table class="lhcl_batchtools">
      <tbody>
        <tr>
          <td class="lhcl_title2">{$STRINGS.SURVEY_STRINGS.CAPTION_SURVEY} <span class="lhcl_albumname">{$STRINGS.SURVEY_STRINGS.CAPTION_SURVEY_NAME} : {$STRINGS.SURVEY_STRINGS.PAGE_TITLE_9_}</span></td>
          <td class="lhcl_batchnav">[9/9]</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div id="lhid_edit_frame">
    <div id="lhid_batchcaptionbox">
    <div id="lhid_captions">
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_txd_57_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_txd_57_}</div>{/if}

    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_txd_57_}</td>
          <td class="lhcl_center" width="33%">
<input type="text" class="lhcl_editcontrols" name="txd_57_" id="txd_57_" value="{$SURVEY_DATA.txd_57_.data}"
            onkeyup="_d('func_4', 'txd_57_')"
            onblur="_d('func_2', 'txd_57_')"
            onfocus="_d('func_1', 'txd_57_')"
            onkeydown="_d('func_4', 'txd_57_')">
            <div class="lhcl_statusbox" id="status_txd_57_"></div>
            </td>
          <td class="lhcl_right" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_txd_57__END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_txd_58_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_txd_58_}</div>{/if}
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_txd_58_}</td>
          <td class="lhcl_center" width="33%">
<input type="text" class="lhcl_editcontrols" name="txd_58_" id="txd_58_" value="{$SURVEY_DATA.txd_58_.data}"
            onkeyup="_d('func_4', 'txd_58_')"
            onblur="_d('func_2', 'txd_58_')"
            onfocus="_d('func_1', 'txd_58_')"
            onkeydown="_d('func_4', 'txd_58_')">
            <div class="lhcl_statusbox" id="status_txd_58_"></div></td>
          <td class="lhcl_right" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_txd_58__END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_txd_59_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_txd_59_}</div>{/if}
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_txd_59_}</td>
          <td class="lhcl_center" width="33%">
<input type="text" class="lhcl_editcontrols" name="txd_59_" id="txd_59_" value="{$SURVEY_DATA.txd_59_.data}"
            onkeyup="_d('func_4', 'txd_59_')"
            onblur="_d('func_2', 'txd_59_')"
            onfocus="_d('func_1', 'txd_59_')"
            onkeydown="_d('func_4', 'txd_59_')">
            <div class="lhcl_statusbox" id="status_txd_59_"></div></td>
          <td class="lhcl_right" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_txd_59__END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_txd_60_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_txd_60_}</div>{/if}
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_txd_60_}</td>
          <td class="lhcl_center" width="33%">
<input type="text" class="lhcl_editcontrols" name="txd_60_" id="txd_60_" value="{$SURVEY_DATA.txd_60_.data}"
            onkeyup="_d('func_4', 'txd_60_')"
            onblur="_d('func_2', 'txd_60_')"
            onfocus="_d('func_1', 'txd_60_')"
            onkeydown="_d('func_4', 'txd_60_')">
            <div class="lhcl_statusbox" id="status_txd_60_"></div></td>
          <td class="lhcl_right" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_txd_60__END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_txd_61_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_txd_61_}</div>{/if}
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_txd_61_}</td>
          <td class="lhcl_center" width="33%">
<input type="text" class="lhcl_editcontrols" name="txd_61_" id="txd_61_" value="{$SURVEY_DATA.txd_61_.data}"
            onkeyup="_d('func_4', 'txd_61_')"
            onblur="_d('func_2', 'txd_61_')"
            onfocus="_d('func_1', 'txd_61_')"
            onkeydown="_d('func_4', 'txd_61_')">
            <div class="lhcl_statusbox" id="status_txd_61_"></div></td>
          <td class="lhcl_right" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_txd_61__END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_ra6_62_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_ra6_62_}</div>{/if}
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left">{$STRINGS.SURVEY_STRINGS.CAPTION_ra6_62_}</td>
          <td class="lhcl_center">
          <table class="lhcl_ra">
            <tr>
              <td>
<input {if $SURVEY_DATA.ra6_62_.data == '1'} checked {/if} type="radio" name="ra6_62_" id="ra6_62__1" value="1" onclick="_d('func_1', 'ra6_62__1')"></td>
              <td>{$STRINGS.SURVEY_STRINGS.CAPTION_ra6_62__1}</td>
            </tr>
            <tr>
              <td>
<input {if $SURVEY_DATA.ra6_62_.data == '2'} checked {/if} type="radio" name="ra6_62_" id="ra6_62__2" value="2" onclick="_d('func_1', 'ra6_62__2')"></td>
              <td>{$STRINGS.SURVEY_STRINGS.CAPTION_ra6_62__2}</td>
            </tr>
            <tr>
              <td>
<input {if $SURVEY_DATA.ra6_62_.data == '3'} checked {/if} type="radio" name="ra6_62_" id="ra6_62__3" value="3" onclick="_d('func_1', 'ra6_62__3')"></td>
              <td>{$STRINGS.SURVEY_STRINGS.CAPTION_ra6_62__3}</td>
            </tr>
            <tr>
              <td>
<input {if $SURVEY_DATA.ra6_62_.data == '4'} checked {/if} type="radio" name="ra6_62_" id="ra6_62__4" value="4" onclick="_d('func_1', 'ra6_62__4')"></td>
              <td>{$STRINGS.SURVEY_STRINGS.CAPTION_ra6_62__4}</td>
            </tr>
            <tr>
              <td>
<input {if $SURVEY_DATA.ra6_62_.data == '5'} checked {/if} type="radio" name="ra6_62_" id="ra6_62__5" value="5" onclick="_d('func_1', 'ra6_62__5')"></td>
              <td>{$STRINGS.SURVEY_STRINGS.CAPTION_ra6_62__5}</td>
            </tr>
            <tr>
              <td>
<input {if $SURVEY_DATA.ra6_62_.data == '6'} checked {/if} type="radio" name="ra6_62_" id="ra6_62__6" value="6" onclick="_d('func_1', 'ra6_62__6')"></td>
              <td>{$STRINGS.SURVEY_STRINGS.CAPTION_ra6_62__6}
              <div class="lhcl_statusbox" id="status_ra6_62_"></td>
            </tr>
          </table>
          </div>
          </td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_ra2_63_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_ra2_63_}</div>{/if}
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left" width="30%">{$STRINGS.SURVEY_STRINGS.CAPTION_ra2_63_}</td>
          <td class="lhcl_center"  width="30%">
          <table>
            <tr>
              <td>
<input {if $SURVEY_DATA.ra2_63_.data == '1'} checked {/if} type="radio" name="ra2_63_" id="ra2_63__1" value="1" onclick="_d('func_1', 'ra2_63__1')"></td>
              <td>{$STRINGS.SURVEY_STRINGS.CAPTION_ra2_63__1}</td>
            </tr>
            <tr>
              <td>
<input {if $SURVEY_DATA.ra2_63_.data == '2'} checked {/if} type="radio" name="ra2_63_" id="ra2_63__2" value="2" onclick="_d('func_1', 'ra2_63__2')"></td>
              <td>{$STRINGS.SURVEY_STRINGS.CAPTION_ra2_63__2}
              <div class="lhcl_statusbox" id="status_ra2_63_"></td>
            </tr>
          </table>
          </div>
        </td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_txt_64_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_txt_64_}</div>{/if}
    <div>
    <table class="lhcl_onebatchcaption" width="800">
      <tbody>
        <tr>
          <td class="lhcl_left" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_txt_64_}</td>
          <td class="lhcl_center" width="33%">
<input type="text"
            name="txt_64_" id="txt_64_" value="{$SURVEY_DATA.txt_64_.data}"
            onkeyup="_d('func_4', 'txt_64_')" onblur="_d('func_2', 'txt_64_')"
            onfocus="_d('func_1', 'txt_64_')"
            onkeydown="_d('func_4', 'txt_64_')">
          <div class="lhcl_statusbox" id="status_txt_64_"></div>
          </td>
          <td class="lhcl_right" width="33%">{$STRINGS.SURVEY_STRINGS.CAPTION_txt_64__END}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="lhcl_captionspacer"></div>
    {if $STRINGS.SURVEY_STRINGS.QUESTION_txa_65_}<div class="lhcl_question">{$STRINGS.SURVEY_STRINGS.QUESTION_txa_65_}</div>{/if}
    <div>
    <table class="lhcl_onebatchcaption">
      <tbody>
        <tr>
          <td class="lhcl_left">{$STRINGS.SURVEY_STRINGS.CAPTION_txa_65_}</td>
        </tr>
        <tr>
          <td class="lhcl_center"><textarea tabindex="19" class=""
            onkeyup="_d('func_4', 'txa_65_')" onblur="_d('func_2', 'txa_65_')"
            onfocus="_d('func_1', 'txa_65_')"
            onkeydown="_d('func_4', 'txa_65_')" name="txa_65_"
            id="txa_65_">{if $SURVEY_DATA.txa_65_.data}{$SURVEY_DATA.txa_65_.data}{else}{$STRINGS.SURVEY_STRINGS.TEXTAREA_HINT_EDIT}{/if}</textarea>
          <div class="lhcl_statusbox" id="status_txa_65_"></div>
          {* <br/>
          <div class="lhcl_statusbox" id="status_txa_65_"
            style="color: rgb(102, 102, 102);">
          <table>
            <tbody>
              <tr>
                <td class="lhcl_status"><img class="lhcl_statusimg"
                  src="img/check.gif"></td>
                <td class="lhcl_status">This caption has been saved.</td>
                <td class="lhcl_undo"><a
                  href="javascript:_d('func_3', '0')">Undo</a></td>
              </tr>
            </tbody>
          </table>
          </div>
          <br/>
          <div class="lhcl_statusbox" id="status_txa_65_"
            style="color: rgb(102, 102, 102);"><span
            class="lhcl_statusdefault">Changes to captions are
          automatically saved.</span></div>
          <br/>
          <div class="lhcl_statusbox" id="status_txa_65_"
            style="color: rgb(102, 102, 102);">
          <table>
            <tbody>
              <tr>
                <td class="lhcl_status"><img class="lhcl_statusimg"
                  src="img/saving.gif"></td>
                <td class="lhcl_status">saving</td>
              </tr>
            </tbody>
          </table>
          </div>
          *}</td>
        </tr>
      </tbody>
    </table>
    </div>
    </div>
    </div>
    </div>
    <div class="lhcl_captionsnav">
    <table class="lhcl_batchtools">
      <tbody>
        <tr>
          <td>
			<input type="button" onclick="_d('doBack',7)" value="{$STRINGS.SURVEY_STRINGS.PAGE_BUTTON_CAPTION_BACK}" class="lhcl_default"></td>
          <td class="lhcl_batchnav" id="lhid_batchnav_top" />
          <td align="right">
			<input type="button" onclick="_d('doFinish',9)" value="{$STRINGS.SURVEY_STRINGS.PAGE_BUTTON_CAPTION_FINISH}" class="lhcl_default"></td>
        </tr>
      </tbody>
    </table>
    </div>
    </td>
  </tr>
</table>
</div>
</div>
