{*

$Id:$

*}
<script type="text/javascript">

var sid = {$SURVEY_DATA.SURVEY_ID};

{literal}
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
						xajax_doSetValue({"id": "finished", "value": 1});
					}
					return false;


//					nextPageObj = document.getElementById('page_' + id);
//					if (nextPageObj){
//						currentPageObj.style.display = 'none';
//					}
//					alert('Thanks');
				break;
				case "func_1":
//					alert("func_1:" + func + ':' + id);
					/*
					   parse radiobutton id
					*/
					if (id.substring(0,2) == 'rd' || id.substring(0,2) == 'ra'){
						elementId =	id.split('__');
						//elementId = elementId[elementId.length-1];
						elementId    = elementId[0] + '_';
						elementValue =	id.split('_');
						elementValue = elementValue[elementValue.length-1];
						xajax_doSetValue({"id": sid, "value": elementValue});
					}else{
//						elementId = id;
//						elementObj = document.getElementById(elementId);
//						if (elementObj){
//							xajax_doSetValue({"id": id, "value": elementObj.value});
//						}
					}
					return false;
				case "func_2":
						elementId = id;
						elementObj = document.getElementById(elementId);
						if (elementObj){
							xajax_doSetValue({"id": id, "value": elementObj.value});
						}

					return false;
				case "func_3":

					return false;
				case "func_4":

					return false;

				break;
				default:
					//alert(func + ':' + id);
					return false;
				break;
			}
			window.status = func + ':' + id;
		}

		function _d2(func){
			window.status = func + ':' + id;
		}

		function validatePage(nr){
			return true;
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


<!--
$(document).ready(function(){
			$('div.bag-body').each( function() {  
				var code = $(this).find('textarea').text(); 
				if(code) $(this).html(code); 
			}); 
			var context = context || 'body';
        $('div.bag-head', $(context))
                .click(function(){
                	//xajax_doGetValue({"id": "finished", "value": 1});
					var code = $(this).next('div.bag-body').find('textarea').text(); 
					if(code) $(this).next('div.bag-body').html(code);
					
					if ($(this).next('div.bag-body').attr('innerHTML') == 'lade...'){
              			xajax_doGetReportValues({"sid": sid, "id": $(this).next('div.bag-body').attr('id')});
					}
					
					$(this).toggleClass('unfolded');
					$(this).next('div.bag-body').slideToggle('fast');					
                });

});
//-->
</script>
{/literal}

{literal}
<style type="text/css">
<!--
.txt {
	/*border:dotted 1px #E1ECFE;*/
	width:350px;
	text-align: left;
	padding: 5px;
}

.txa {
	/*
	border:dotted 1px #E1ECFE;
	width:800px;
	height:200px;
	*/
	text-align: left;
}
.rd7 {
	border:dotted 1px #E1ECFE;
	width:350px;
	height:200px;
	/*background-image:url(../img/graph.png);*/
}

.txd {
	border:dotted 1px #E1ECFE;
	width:350px;
	height:200px;
}

.ra6 {
	border:dotted 1px #E1ECFE;
	width:350px;
	height:200px;
}

.ra2 {
	border:dotted 1px #E1ECFE;
	width:350px;
	height:200px;
}

-->
</style>
{/literal}
{* copiled data *}
{literal}
<style type="text/css">
<!--
@media print {
#page_0 {
	display: block;;
}

#page_1 {
	display: block;;
	page-break-before:always;;
}

#page_2 {
	display: block;;
	page-break-before:always;;
}

#page_3 {
	display: block;;
	page-break-before:always;;
}

#page_4 {
	display: block;;
	page-break-before:always;;
}

#page_5 {
	display: block;;
	page-break-before:always;;
}

#page_6 {
	display: block;;
	page-break-before:always;;
}

#page_7 {
	display: block;;
	page-break-before:always;;
}

#page_8 {
	display: block;;
	page-break-before:always;;
}
}

#page_0 {
	display: block;;
}

#page_1 {
	display: block;;
	page-break-before:always;;
}

#page_2 {
	display: block;;
	page-break-before:always;;
}

#page_3 {
	display: block;;
	page-break-before:always;;
}

#page_4 {
	display: block;;
	page-break-before:always;;
}

#page_5 {
	display: block;;
	page-break-before:always;;
}

#page_6 {
	display: block;;
	page-break-before:always;;
}

#page_7 {
	display: block;;
	page-break-before:always;;
}

#page_8 {
	display: block;;
	page-break-before:always;;
}
-->
</style>
{/literal}

{* load display loader *}
<img src="img/loading.gif" style="display: none;">

<div class="lhcl_editcontrols">
<!--
<table>
	<tbody>
		<tr>
			<td class="lhcl_title">{$STRINGS.CAPTION_SURVEY}<span class="lhcl_albumname">{$STRINGS.CAPTION_SURVEY_NAME}:
			{$STRINGS.CAPTION_SURVEY_SECTION_NAME}</span></td>
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
					<td class="lhcl_title2">{$STRINGS.CAPTION_SURVEY} <span class="lhcl_albumname">{$STRINGS.CAPTION_SURVEY_NAME} : {$STRINGS.PAGE_TITLE_1_}</span></td>
					<td class="lhcl_title3">[1/9]</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div id="lhid_edit_frame">
		<div id="lhid_batchcaptionbox">
		<div id="lhid_captions">
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_txt_1_}<div class="lhcl_question">{$STRINGS.QUESTION_txt_1_}</div>{/if}
		<div>
		<table class="lhcl_onebatchcaption" width="800">
			<tbody>
				<tr>
					<td class="lhcl_left" width="33%">{$STRINGS.CAPTION_txt_1_}</td>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.txt_1_.output_html}</td>
					<td class="lhcl_right2" width="33%">{$STRINGS.CAPTION_txt_1__END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_txt_2_}<div class="lhcl_question">{$STRINGS.QUESTION_txt_2_}</div>{/if}
		<div>
		<table class="lhcl_onebatchcaption" width="800">
			<tbody>
				<tr>
					<td class="lhcl_left" width="33%">{$STRINGS.CAPTION_txt_2_}</td>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.txt_2_.output_html}</td>
					<td class="lhcl_right2" width="33%">{$STRINGS.CAPTION_txt_2__END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_txt_3_}<div class="lhcl_question">{$STRINGS.QUESTION_txt_3_}</div>{/if}
		<div>
		<table class="lhcl_onebatchcaption" width="800">
			<tbody>
				<tr>
					<td class="lhcl_left" width="33%">{$STRINGS.CAPTION_txt_3_}</td>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.txt_3_.output_html}</td>
					<td class="lhcl_right2" width="33%">{$STRINGS.CAPTION_txt_3__END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_txt_4_}<div class="lhcl_question">{$STRINGS.QUESTION_txt_4_}</div>{/if}
		<div>
		<table class="lhcl_onebatchcaption" width="800">
			<tbody>
				<tr>
					<td class="lhcl_left" width="33%">{$STRINGS.CAPTION_txt_4_}</td>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.txt_4_.output_html}</td>
					<td class="lhcl_right2" width="33%">{$STRINGS.CAPTION_txt_4__END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_txd_5_}<div class="lhcl_question">{$STRINGS.QUESTION_txd_5_}</div>{/if}
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left" width="33%">{$STRINGS.CAPTION_txd_5_}</td>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.txd_5_.output_html}</td>
					<td class="lhcl_right2" width="33%">{$STRINGS.CAPTION_txd_5__END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_txd_6_}<div class="lhcl_question">{$STRINGS.QUESTION_txd_6_}</div>{/if}
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left" width="33%">{$STRINGS.CAPTION_txd_6_}</td>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.txd_6_.output_html}</td>
					<td class="lhcl_right2" width="33%">{$STRINGS.CAPTION_txd_6__END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_rd7_7_}<div class="lhcl_question">{$STRINGS.QUESTION_rd7_7_}</div>{/if}
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left" width="33%">{$STRINGS.CAPTION_rd7_7_BEGIN}</td>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.rd7_7_.output_html}</td>
					<td class="lhcl_right2" width="33%">{$STRINGS.CAPTION_rd7_7_END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		</div>
		</div>
		</div>
		<div class="lhcl_captionsnav_">
		<!--table class="lhcl_batchtools">
			<tbody>
				<tr>
					<td></td>
					<td class="lhcl_batchnav" id="lhid_batchnav_top" />
					<td align="right">{*<input type="button" onclick="_d('doNext',1)" value="{$STRINGS.PAGE_BUTTON_CAPTION_NEXT}" class="lhcl_default">*}</td>
				</tr>
			</tbody>
		</table-->
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
					<td class="lhcl_title2">{$STRINGS.CAPTION_SURVEY} <span class="lhcl_albumname">{$STRINGS.CAPTION_SURVEY_NAME} : {$STRINGS.PAGE_TITLE_2_}</span></td>
					<td class="lhcl_batchnav">[2/9]</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div id="lhid_edit_frame">
		<div id="lhid_batchcaptionbox">
		<div id="lhid_captions">
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_rd7_8_}<div class="lhcl_question">{$STRINGS.QUESTION_rd7_8_}</div>{/if}
		<div class="lhcl_captionspacer"></div>
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left b" width="33%">{$STRINGS.CAPTION_VALUE_BEGIN}</td>
					<td class="lhcl_center nobr" width="33%">{$STRINGS.CAPTION_VALUE_VALUES}</td>
					<td class="lhcl_right2 b" width="33%">{$STRINGS.CAPTION_VALUE_END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div class="lhcl_captionspacer"></div>
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left" width="33%">{$STRINGS.CAPTION_rd7_8_BEGIN}</td>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.rd7_8_.output_html}</td>
					<td class="lhcl_right2" width="33%">{$STRINGS.CAPTION_rd7_8_END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_rd7_9_}<div class="lhcl_question">{$STRINGS.QUESTION_rd7_9_}</div>{/if}
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left" width="33%">{$STRINGS.CAPTION_rd7_9_BEGIN}</td>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.rd7_9_.output_html}</td>
					<td class="lhcl_right2" width="33%">{$STRINGS.CAPTION_rd7_9_END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_rd7_10_}<div class="lhcl_question">{$STRINGS.QUESTION_rd7_10_}</div>{/if}
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left" width="33%">{$STRINGS.CAPTION_rd7_10_BEGIN}</td>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.rd7_10_.output_html}</td>
					<td class="lhcl_right2" width="33%">{$STRINGS.CAPTION_rd7_10_END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_rd7_11_}<div class="lhcl_question">{$STRINGS.QUESTION_rd7_11_}</div>{/if}
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left" width="33%">{$STRINGS.CAPTION_rd7_11_BEGIN}</td>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.rd7_11_.output_html}</td>
					<td class="lhcl_right2" width="33%">{$STRINGS.CAPTION_rd7_11_END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_rd7_12_}<div class="lhcl_question">{$STRINGS.QUESTION_rd7_12_}</div>{/if}
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left" width="33%">{$STRINGS.CAPTION_rd7_12_BEGIN}</td>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.rd7_12_.output_html}</td>
					<td class="lhcl_right2" width="33%">{$STRINGS.CAPTION_rd7_12_END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_rd7_13_}<div class="lhcl_question">{$STRINGS.QUESTION_rd7_13_}</div>{/if}
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left" width="33%">{$STRINGS.CAPTION_rd7_13_BEGIN}</td>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.rd7_13_.output_html}</td>
					<td class="lhcl_right2" width="33%">{$STRINGS.CAPTION_rd7_13_END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_txa_14_}<div class="lhcl_question">{$STRINGS.QUESTION_txa_14_}</div>{/if}
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left">{$STRINGS.CAPTION_txa_14_}</td>
				</tr>
				<tr>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.txa_14_.output_html}</td>
				</tr>
			</tbody>
		</table>
		</div>
		</div>
		</div>
		{*</div>*}
		<div class="lhcl_captionsnav_">
		<!--table class="lhcl_batchtools">
			<tbody>
				<tr>
					<td>{*<input type="button" onclick="_d('doBack',0)" value="{$STRINGS.PAGE_BUTTON_CAPTION_BACK}" class="lhcl_default">*}</td>
					<td class="lhcl_batchnav" id="lhid_batchnav_top" />
					<td align="right">{*<input type="button" onclick="_d('doNext',2)" value="{$STRINGS.PAGE_BUTTON_CAPTION_NEXT}" class="lhcl_default">*}</td>
				</tr>
			</tbody>
		</table -->
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
					<td class="lhcl_title2">{$STRINGS.CAPTION_SURVEY} <span class="lhcl_albumname">{$STRINGS.CAPTION_SURVEY_NAME} : {$STRINGS.PAGE_TITLE_3_}</span></td>
					<td class="lhcl_batchnav">[3/9]</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div id="lhid_edit_frame">
		<div id="lhid_batchcaptionbox">
		<div id="lhid_captions">
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_rd7_15_}<div class="lhcl_question">{$STRINGS.QUESTION_rd7_15_}</div>{/if}
		<div class="lhcl_captionspacer"></div>
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left b" width="33%">{$STRINGS.CAPTION_VALUE_BEGIN}</td>
					<td class="lhcl_center nobr" width="33%">{$STRINGS.CAPTION_VALUE_VALUES}</td>
					<td class="lhcl_right2 b" width="33%">{$STRINGS.CAPTION_VALUE_END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left" width="33%">{$STRINGS.CAPTION_rd7_15_BEGIN}</td>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.rd7_15_.output_html}</td>
					<td class="lhcl_right2" width="33%">{$STRINGS.CAPTION_rd7_15_END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_rd7_16_}<div class="lhcl_question">{$STRINGS.QUESTION_rd7_16_}</div>{/if}
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left" width="33%">{$STRINGS.CAPTION_rd7_16_BEGIN}</td>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.rd7_16_.output_html}</td>
					<td class="lhcl_right2" width="33%">{$STRINGS.CAPTION_rd7_16_END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_rd7_17_}<div class="lhcl_question">{$STRINGS.QUESTION_rd7_17_}</div>{/if}
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left" width="33%">{$STRINGS.CAPTION_rd7_17_BEGIN}</td>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.rd7_17_.output_html}</td>
					<td class="lhcl_right2" width="33%">{$STRINGS.CAPTION_rd7_17_END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_rd7_18_}<div class="lhcl_question">{$STRINGS.QUESTION_rd7_18_}</div>{/if}
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left" width="33%">{$STRINGS.CAPTION_rd7_18_BEGIN}</td>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.rd7_18_.output_html}</td>
					<td class="lhcl_right2" width="33%">{$STRINGS.CAPTION_rd7_18_END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_rd7_19_}<div class="lhcl_question">{$STRINGS.QUESTION_rd7_19_}</div>{/if}
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left" width="33%">{$STRINGS.CAPTION_rd7_19_BEGIN}</td>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.rd7_19_.output_html}</td>
					<td class="lhcl_right2" width="33%">{$STRINGS.CAPTION_rd7_19_END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_rd7_20_}<div class="lhcl_question">{$STRINGS.QUESTION_rd7_20_}</div>{/if}
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left" width="33%">{$STRINGS.CAPTION_rd7_20_BEGIN}</td>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.rd7_20_.output_html}</td>
					<td class="lhcl_right2" width="33%">{$STRINGS.CAPTION_rd7_20_END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_txa_21_}<div class="lhcl_question">{$STRINGS.QUESTION_txa_21_}</div>{/if}
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left">{$STRINGS.CAPTION_txa_21_}</td>
				</tr>
				<tr>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.txa_21_.output_html}</td>
				</tr>
			</tbody>
		</table>
		</div>
		</div>
		</div>
		</div>
		<div class="lhcl_captionsnav_">
		<!--table class="lhcl_batchtools">
			<tbody>
				<tr>
					<td>{*<input type="button" onclick="_d('doBack',1)" value="{$STRINGS.PAGE_BUTTON_CAPTION_BACK}" class="lhcl_default">*}</td>
					<td class="lhcl_batchnav" id="lhid_batchnav_top" />
					<td align="right">{*<input type="button" onclick="_d('doNext',3)" value="{$STRINGS.PAGE_BUTTON_CAPTION_NEXT}" class="lhcl_default">*}</td>
				</tr>
			</tbody>
		</table -->
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
					<td class="lhcl_title2">{$STRINGS.CAPTION_SURVEY} <span class="lhcl_albumname">{$STRINGS.CAPTION_SURVEY_NAME} : {$STRINGS.PAGE_TITLE_4_}</span></td>
					<td class="lhcl_batchnav">[4/9]</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div id="lhid_edit_frame">
		<div id="lhid_batchcaptionbox">
		<div id="lhid_captions">
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_rd7_22_}<div class="lhcl_question">{$STRINGS.QUESTION_rd7_22_}</div>{/if}
		<div class="lhcl_captionspacer"></div>
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left b" width="33%">{$STRINGS.CAPTION_VALUE_BEGIN}</td>
					<td class="lhcl_center nobr" width="33%">{$STRINGS.CAPTION_VALUE_VALUES}</td>
					<td class="lhcl_right2 b" width="33%">{$STRINGS.CAPTION_VALUE_END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left" width="33%">{$STRINGS.CAPTION_rd7_22_BEGIN}</td>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.rd7_22_.output_html}</td>
					<td class="lhcl_right2" width="33%">{$STRINGS.CAPTION_rd7_22_END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_rd7_23_}<div class="lhcl_question">{$STRINGS.QUESTION_rd7_23_}</div>{/if}
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left" width="33%">{$STRINGS.CAPTION_rd7_23_BEGIN}</td>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.rd7_23_.output_html}</td>
					<td class="lhcl_right2" width="33%">{$STRINGS.CAPTION_rd7_23_END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_rd7_24_}<div class="lhcl_question">{$STRINGS.QUESTION_rd7_24_}</div>{/if}
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left" width="33%">{$STRINGS.CAPTION_rd7_24_BEGIN}</td>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.rd7_24_.output_html}</td>
					<td class="lhcl_right2" width="33%">{$STRINGS.CAPTION_rd7_24_END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_rd7_25_}<div class="lhcl_question">{$STRINGS.QUESTION_rd7_25_}</div>{/if}
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left" width="33%">{$STRINGS.CAPTION_rd7_25_BEGIN}</td>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.rd7_25_.output_html}</td>
					<td class="lhcl_right2" width="33%">{$STRINGS.CAPTION_rd7_25_END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_rd7_26_}<div class="lhcl_question">{$STRINGS.QUESTION_rd7_26_}</div>{/if}
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left" width="33%">{$STRINGS.CAPTION_rd7_26_BEGIN}</td>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.rd7_26_.output_html}</td>
					<td class="lhcl_right2" width="33%">{$STRINGS.CAPTION_rd7_26_END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_rd7_27_}<div class="lhcl_question">{$STRINGS.QUESTION_rd7_27_}</div>{/if}
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left" width="33%">{$STRINGS.CAPTION_rd7_27_BEGIN}</td>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.rd7_27_.output_html}</td>
					<td class="lhcl_right2" width="33%">{$STRINGS.CAPTION_rd7_27_END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_txa_28_}<div class="lhcl_question">{$STRINGS.QUESTION_txa_28_}</div>{/if}
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left">{$STRINGS.CAPTION_txa_28_}</td>
				</tr>
				<tr>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.txa_28_.output_html}</td>
				</tr>
			</tbody>
		</table>
		</div>
		</div>
		</div>
		</div>
		<div class="lhcl_captionsnav_">
		<!-- table class="lhcl_batchtools">
			<tbody>
				<tr>
					<td>{*<input type="button" onclick="_d('doBack',2)" value="{$STRINGS.PAGE_BUTTON_CAPTION_BACK}" class="lhcl_default">*}</td>
					<td class="lhcl_batchnav" id="lhid_batchnav_top" />
					<td align="right">{*<input type="button" onclick="_d('doNext',4)" value="{$STRINGS.PAGE_BUTTON_CAPTION_NEXT}" class="lhcl_default">*}</td>
				</tr>
			</tbody>
		</table -->
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
					<td class="lhcl_title2">{$STRINGS.CAPTION_SURVEY} <span class="lhcl_albumname">{$STRINGS.CAPTION_SURVEY_NAME} : {$STRINGS.PAGE_TITLE_5_}</span></td>
					<td class="lhcl_batchnav">[5/9]</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div id="lhid_edit_frame">
		<div id="lhid_batchcaptionbox">
		<div id="lhid_captions">
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_rd7_29_}<div class="lhcl_question">{$STRINGS.QUESTION_rd7_29_}</div>{/if}
		<div class="lhcl_captionspacer"></div>
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left b" width="33%">{$STRINGS.CAPTION_VALUE_BEGIN}</td>
					<td class="lhcl_center nobr" width="33%">{$STRINGS.CAPTION_VALUE_VALUES}</td>
					<td class="lhcl_right2 b" width="33%">{$STRINGS.CAPTION_VALUE_END}</td>
				</tr>
			</tbody>
		</table>
		</div>

		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left" width="33%">{$STRINGS.CAPTION_rd7_29_BEGIN}</td>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.rd7_29_.output_html}</td>
					<td class="lhcl_right2" width="33%">{$STRINGS.CAPTION_rd7_29_END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_rd7_30_}<div class="lhcl_question">{$STRINGS.QUESTION_rd7_30_}</div>{/if}
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left" width="33%">{$STRINGS.CAPTION_rd7_30_BEGIN}</td>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.rd7_30_.output_html}</td>
					<td class="lhcl_right2" width="33%">{$STRINGS.CAPTION_rd7_30_END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_rd7_31_}<div class="lhcl_question">{$STRINGS.QUESTION_rd7_31_}</div>{/if}
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left" width="33%">{$STRINGS.CAPTION_rd7_31_BEGIN}</td>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.rd7_31_.output_html}</td>
					<td class="lhcl_right2" width="33%">{$STRINGS.CAPTION_rd7_31_END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_rd7_32_}<div class="lhcl_question">{$STRINGS.QUESTION_rd7_32_}</div>{/if}
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left" width="33%">{$STRINGS.CAPTION_rd7_32_BEGIN}</td>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.rd7_32_.output_html}</td>
					<td class="lhcl_right2" width="33%">{$STRINGS.CAPTION_rd7_32_END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_rd7_33_}<div class="lhcl_question">{$STRINGS.QUESTION_rd7_33_}</div>{/if}
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left" width="33%">{$STRINGS.CAPTION_rd7_33_BEGIN}</td>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.rd7_33_.output_html}</td>
					<td class="lhcl_right2" width="33%">{$STRINGS.CAPTION_rd7_33_END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_rd7_34_}<div class="lhcl_question">{$STRINGS.QUESTION_rd7_34_}</div>{/if}
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left" width="33%">{$STRINGS.CAPTION_rd7_34_BEGIN}</td>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.rd7_34_.output_html}</td>
					<td class="lhcl_right2" width="33%">{$STRINGS.CAPTION_rd7_34_END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_txa_35_}<div class="lhcl_question">{$STRINGS.QUESTION_txa_35_}</div>{/if}
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left">{$STRINGS.CAPTION_txa_35_}</td>
				</tr>
				<tr>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.txa_35_.output_html}</td>
				</tr>
			</tbody>
		</table>
		</div>
		</div>
		</div>
		</div>
		<div class="lhcl_captionsnav_">
		<!-- table class="lhcl_batchtools">
			<tbody>
				<tr>
					<td>{*<input type="button" onclick="_d('doBack',3)" value="{$STRINGS.PAGE_BUTTON_CAPTION_BACK}" class="lhcl_default">*}</td>
					<td class="lhcl_batchnav" id="lhid_batchnav_top" />
					<td align="right">{*<input type="button" onclick="_d('doNext',5)" value="{$STRINGS.PAGE_BUTTON_CAPTION_NEXT}" class="lhcl_default">*}</td>
				</tr>
			</tbody>
		</table -->
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
					<td class="lhcl_title2">{$STRINGS.CAPTION_SURVEY} <span class="lhcl_albumname">{$STRINGS.CAPTION_SURVEY_NAME} : {$STRINGS.PAGE_TITLE_6_}</span></td>
					<td class="lhcl_batchnav">[6/9]</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div id="lhid_edit_frame">
		<div id="lhid_batchcaptionbox">
		<div id="lhid_captions">
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_rd7_36_}<div class="lhcl_question">{$STRINGS.QUESTION_rd7_36_}</div>{/if}
		<div class="lhcl_captionspacer"></div>
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left b" width="33%">{$STRINGS.CAPTION_VALUE_BEGIN}</td>
					<td class="lhcl_center nobr" width="33%">{$STRINGS.CAPTION_VALUE_VALUES}</td>
					<td class="lhcl_right2 b" width="33%">{$STRINGS.CAPTION_VALUE_END}</td>
				</tr>
			</tbody>
		</table>
		</div>

		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left" width="33%">{$STRINGS.CAPTION_rd7_36_BEGIN}</td>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.rd7_36_.output_html}</td>
					<td class="lhcl_right2" width="33%">{$STRINGS.CAPTION_rd7_36_END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_rd7_37_}<div class="lhcl_question">{$STRINGS.QUESTION_rd7_37_}</div>{/if}
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left" width="33%">{$STRINGS.CAPTION_rd7_37_BEGIN}</td>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.rd7_37_.output_html}</td>
					<td class="lhcl_right2" width="33%">{$STRINGS.CAPTION_rd7_37_END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_rd7_38_}<div class="lhcl_question">{$STRINGS.QUESTION_rd7_38_}</div>{/if}
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left" width="33%">{$STRINGS.CAPTION_rd7_38_BEGIN}</td>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.rd7_38_.output_html}</td>
					<td class="lhcl_right2" width="33%">{$STRINGS.CAPTION_rd7_38_END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_rd7_39_}<div class="lhcl_question">{$STRINGS.QUESTION_rd7_39_}</div>{/if}
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left" width="33%">{$STRINGS.CAPTION_rd7_39_BEGIN}</td>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.rd7_39_.output_html}</td>
					<td class="lhcl_right2" width="33%">{$STRINGS.CAPTION_rd7_39_END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_rd7_40_}<div class="lhcl_question">{$STRINGS.QUESTION_rd7_40_}</div>{/if}
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left" width="33%">{$STRINGS.CAPTION_rd7_40_BEGIN}</td>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.rd7_40_.output_html}</td>
					<td class="lhcl_right2" width="33%">{$STRINGS.CAPTION_rd7_40_END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_rd7_41_}<div class="lhcl_question">{$STRINGS.QUESTION_rd7_41_}</div>{/if}
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left" width="33%">{$STRINGS.CAPTION_rd7_41_BEGIN}</td>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.rd7_41_.output_html}</td>
					<td class="lhcl_right2" width="33%">{$STRINGS.CAPTION_rd7_41_END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_txa_42_}<div class="lhcl_question">{$STRINGS.QUESTION_txa_42_}</div>{/if}
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left">{$STRINGS.CAPTION_txa_42_}</td>
				</tr>
				<tr>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.txa_42_.output_html}</td>
				</tr>
			</tbody>
		</table>
		</div>
		</div>
		</div>
		</div>
		<div class="lhcl_captionsnav_">
		<!-- table class="lhcl_batchtools">
			<tbody>
				<tr>
					<td>{*<input type="button" onclick="_d('doBack',4)" value="{$STRINGS.PAGE_BUTTON_CAPTION_BACK}" class="lhcl_default">*}</td>
					<td class="lhcl_batchnav" id="lhid_batchnav_top" />
					<td align="right">{*<input type="button" onclick="_d('doNext',6)" value="{$STRINGS.PAGE_BUTTON_CAPTION_NEXT}" class="lhcl_default">*}</td>
				</tr>
			</tbody>
		</table -->
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
					<td class="lhcl_title2">{$STRINGS.CAPTION_SURVEY} <span class="lhcl_albumname">{$STRINGS.CAPTION_SURVEY_NAME} : {$STRINGS.PAGE_TITLE_7_}</span></td>
					<td class="lhcl_batchnav">[7/9]</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div id="lhid_edit_frame">
		<div id="lhid_batchcaptionbox">
		<div id="lhid_captions">
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_rd7_43_}<div class="lhcl_question">{$STRINGS.QUESTION_rd7_43_}</div>{/if}
		<div class="lhcl_captionspacer"></div>
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left b" width="33%">{$STRINGS.CAPTION_VALUE_BEGIN}</td>
					<td class="lhcl_center nobr" width="33%">{$STRINGS.CAPTION_VALUE_VALUES}</td>
					<td class="lhcl_right2 b" width="33%">{$STRINGS.CAPTION_VALUE_END}</td>
				</tr>
			</tbody>
		</table>
		</div>

		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left" width="33%">{$STRINGS.CAPTION_rd7_43_BEGIN}</td>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.rd7_43_.output_html}</td>
					<td class="lhcl_right2" width="33%">{$STRINGS.CAPTION_rd7_43_END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_rd7_44_}<div class="lhcl_question">{$STRINGS.QUESTION_rd7_44_}</div>{/if}
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left" width="33%">{$STRINGS.CAPTION_rd7_44_BEGIN}</td>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.rd7_44_.output_html}</td>
					<td class="lhcl_right2" width="33%">{$STRINGS.CAPTION_rd7_44_END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_rd7_45_}<div class="lhcl_question">{$STRINGS.QUESTION_rd7_45_}</div>{/if}
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left" width="33%">{$STRINGS.CAPTION_rd7_45_BEGIN}</td>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.rd7_45_.output_html}</td>
					<td class="lhcl_right2" width="33%">{$STRINGS.CAPTION_rd7_45_END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_rd7_46_}<div class="lhcl_question">{$STRINGS.QUESTION_rd7_46_}</div>{/if}
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left" width="33%">{$STRINGS.CAPTION_rd7_46_BEGIN}</td>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.rd7_46_.output_html}</td>
					<td class="lhcl_right2" width="33%">{$STRINGS.CAPTION_rd7_46_END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_rd7_47_}<div class="lhcl_question">{$STRINGS.QUESTION_rd7_47_}</div>{/if}
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left" width="33%">{$STRINGS.CAPTION_rd7_47_BEGIN}</td>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.rd7_47_.output_html}</td>
					<td class="lhcl_right2" width="33%">{$STRINGS.CAPTION_rd7_47_END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_rd7_48_}<div class="lhcl_question">{$STRINGS.QUESTION_rd7_48_}</div>{/if}
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left" width="33%">{$STRINGS.CAPTION_rd7_48_BEGIN}</td>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.rd7_48_.output_html}</td>
					<td class="lhcl_right2" width="33%">{$STRINGS.CAPTION_rd7_48_END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_txa_49_}<div class="lhcl_question">{$STRINGS.QUESTION_txa_49_}</div>{/if}
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left">{$STRINGS.CAPTION_txa_49_}</td>
				</tr>
				<tr>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.txa_49_.output_html}</td>
				</tr>
			</tbody>
		</table>
		</div>
		</div>
		</div>
		</div>
		<div class="lhcl_captionsnav_">
		<!-- table class="lhcl_batchtools">
			<tbody>
				<tr>
					<td>{*<input type="button" onclick="_d('doBack',5)" value="{$STRINGS.PAGE_BUTTON_CAPTION_BACK}" class="lhcl_default">*}</td>
					<td class="lhcl_batchnav" id="lhid_batchnav_top" />
					<td align="right">{*<input type="button" onclick="_d('doNext',7)" value="{$STRINGS.PAGE_BUTTON_CAPTION_NEXT}" class="lhcl_default">*}</td>
				</tr>
			</tbody>
		</table -->
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
					<td class="lhcl_title2">{$STRINGS.CAPTION_SURVEY} <span class="lhcl_albumname">{$STRINGS.CAPTION_SURVEY_NAME} : {$STRINGS.PAGE_TITLE_8_}</span></td>
					<td class="lhcl_batchnav">[8/9]</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div id="lhid_edit_frame">
		<div id="lhid_batchcaptionbox">
		<div id="lhid_captions">
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_rd7_50_}<div class="lhcl_question">{$STRINGS.QUESTION_rd7_50_}</div>{/if}
		<div class="lhcl_captionspacer"></div>
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left b" width="33%">{$STRINGS.CAPTION_VALUE_BEGIN}</td>
					<td class="lhcl_center nobr" width="33%">{$STRINGS.CAPTION_VALUE_VALUES}</td>
					<td class="lhcl_right2 b" width="33%">{$STRINGS.CAPTION_VALUE_END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left" width="33%">{$STRINGS.CAPTION_rd7_50_BEGIN}</td>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.rd7_50_.output_html}</td>
					<td class="lhcl_right2" width="33%">{$STRINGS.CAPTION_rd7_50_END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_rd7_51_}<div class="lhcl_question">{$STRINGS.QUESTION_rd7_51_}</div>{/if}
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left" width="33%">{$STRINGS.CAPTION_rd7_51_BEGIN}</td>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.rd7_51_.output_html}</td>
					<td class="lhcl_right2" width="33%">{$STRINGS.CAPTION_rd7_51_END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_rd7_52_}<div class="lhcl_question">{$STRINGS.QUESTION_rd7_52_}</div>{/if}
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left" width="33%">{$STRINGS.CAPTION_rd7_52_BEGIN}</td>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.rd7_52_.output_html}</td>
					<td class="lhcl_right2" width="33%">{$STRINGS.CAPTION_rd7_52_END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_rd7_53_}<div class="lhcl_question">{$STRINGS.QUESTION_rd7_53_}</div>{/if}
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left" width="33%">{$STRINGS.CAPTION_rd7_53_BEGIN}</td>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.rd7_53_.output_html}</td>
					<td class="lhcl_right2" width="33%">{$STRINGS.CAPTION_rd7_53_END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_rd7_54_}<div class="lhcl_question">{$STRINGS.QUESTION_rd7_54_}</div>{/if}
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left" width="33%">{$STRINGS.CAPTION_rd7_54_BEGIN}</td>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.rd7_54_.output_html}</td>
					<td class="lhcl_right2" width="33%">{$STRINGS.CAPTION_rd7_54_END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_rd7_55_}<div class="lhcl_question">{$STRINGS.QUESTION_rd7_55_}</div>{/if}
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left" width="33%">{$STRINGS.CAPTION_rd7_55_BEGIN}</td>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.rd7_55_.output_html}</td>
					<td class="lhcl_right2" width="33%">{$STRINGS.CAPTION_rd7_55_END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_txa_56_}<div class="lhcl_question">{$STRINGS.QUESTION_txa_56_}</div>{/if}
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left">{$STRINGS.CAPTION_txa_56_}</td>
				</tr>
				<tr>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.txa_56_.output_html}</td>
				</tr>
			</tbody>
		</table>
		</div>
		</div>
		</div>
		</div>
		<div class="lhcl_captionsnav_">
		<!-- table class="lhcl_batchtools">
			<tbody>
				<tr>
					<td>{*<input type="button" onclick="_d('doBack',6)" value="{$STRINGS.PAGE_BUTTON_CAPTION_BACK}" class="lhcl_default">*}</td>
					<td class="lhcl_batchnav" id="lhid_batchnav_top" />
					<td align="right">{*<input type="button" onclick="_d('doNext',8)" value="{$STRINGS.PAGE_BUTTON_CAPTION_NEXT}" class="lhcl_default">*}</td>
				</tr>
			</tbody>
		</table -->
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
					<td class="lhcl_title2">{$STRINGS.CAPTION_SURVEY} <span class="lhcl_albumname">{$STRINGS.CAPTION_SURVEY_NAME} : {$STRINGS.PAGE_TITLE_9_}</span></td>
					<td class="lhcl_batchnav">[9/9]</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div id="lhid_edit_frame">
		<div id="lhid_batchcaptionbox">
		<div id="lhid_captions">
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_txd_57_}<div class="lhcl_question">{$STRINGS.QUESTION_txd_57_}</div>{/if}

		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left" width="33%">{$STRINGS.CAPTION_txd_57_}</td>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.txd_57_.output_html}</td>
					<td class="lhcl_right2" width="33%">{$STRINGS.CAPTION_txd_57__END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_txd_58_}<div class="lhcl_question">{$STRINGS.QUESTION_txd_58_}</div>{/if}
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left" width="33%">{$STRINGS.CAPTION_txd_58_}</td>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.txd_58_.output_html}</td>
					<td class="lhcl_right2" width="33%">{$STRINGS.CAPTION_txd_58__END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_txd_59_}<div class="lhcl_question">{$STRINGS.QUESTION_txd_59_}</div>{/if}
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left" width="33%">{$STRINGS.CAPTION_txd_59_}</td>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.txd_59_.output_html}</td>
					<td class="lhcl_right2" width="33%">{$STRINGS.CAPTION_txd_59__END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_txd_60_}<div class="lhcl_question">{$STRINGS.QUESTION_txd_60_}</div>{/if}
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left" width="33%">{$STRINGS.CAPTION_txd_60_}</td>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.txd_60_.output_html}</td>
					<td class="lhcl_right2" width="33%">{$STRINGS.CAPTION_txd_60__END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<!-- -->
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_txd_61_}<div class="lhcl_question">{$STRINGS.QUESTION_txd_61_}</div>{/if}
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left" width="33%">{$STRINGS.CAPTION_txd_61_}</td>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.txd_61_.output_html}</td>
					<td class="lhcl_right2" width="33%">{$STRINGS.CAPTION_txd_61__END}</td>
				</tr>
			</tbody>
		</table>
		</div>

		<!-- -->
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_ra6_62_}<div class="lhcl_question">{$STRINGS.QUESTION_ra6_62_}</div>{/if}
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left" width="33%">{$STRINGS.CAPTION_ra6_62_}</td>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.ra6_62_.output_html}</td>
					<td class="lhcl_right2" width="33%">{$STRINGS.CAPTION_ra6_62__END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<!-- -->
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_ra2_63_}<div class="lhcl_question">{$STRINGS.QUESTION_ra2_63_}</div>{/if}
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left" width="33%">{$STRINGS.CAPTION_ra2_63_}</td>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.ra2_63_.output_html}</td>
					<td class="lhcl_right2" width="33%">{$STRINGS.CAPTION_ra2_63__END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<!-- -->
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_txt_64_}<div class="lhcl_question">{$STRINGS.QUESTION_txt_64_}</div>{/if}
		<div>
		<table class="lhcl_onebatchcaption" width="800">
			<tbody>
				<tr>
					<td class="lhcl_left" width="33%">{$STRINGS.CAPTION_txt_64_}</td>
					<td class="lhcl_center" width="33%">{$SURVEY_DATA.txt_64_.output_html}</td>
					<td class="lhcl_right2" width="33%">{$STRINGS.CAPTION_txt_64__END}</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div class="lhcl_captionspacer"></div>
		{if $STRINGS.QUESTION_txa_65_}<div class="lhcl_question">{$STRINGS.QUESTION_txa_65_}</div>{/if}
		<div>
		<table class="lhcl_onebatchcaption">
			<tbody>
				<tr>
					<td class="lhcl_left">{$STRINGS.CAPTION_txa_65_}</td>
				</tr>
				<tr>
					<td class="lhcl_center" width="33%">
					{$SURVEY_DATA.txa_65_.output_html}
					</td>
				</tr>
			</tbody>
		</table>
		</div>
		</div>
		</div>
		</div>
		<div class="lhcl_captionsnav_">
		<!-- table class="lhcl_batchtools">
			<tbody>
				<tr>
					<td>{*<input type="button" onclick="_d('doBack',7)" value="{$STRINGS.PAGE_BUTTON_CAPTION_BACK}" class="lhcl_default">*}</td>
					<td class="lhcl_batchnav" id="lhid_batchnav_top" />
					<td align="right">{*<input type="button" onclick="_d('doFinish',8)" value="{$STRINGS.PAGE_BUTTON_CAPTION_FINISH}" class="lhcl_default">*}</td>
				</tr>
			</tbody>
		</table -->
		</div>
		</td>
	</tr>
</table>
</div>
</div>
