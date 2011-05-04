{*

	$Id: rightbox.tpl 100 2007-10-13 05:48:52Z root $
	
*}
{*
<div id="lhid_uploadbox">
<div align="center" id="lhid_button">
<table>
<tr>
<td>
<a href="javascript:LH_uploadDialog()" class="lhcl_btn lhcl_onbtn lhcl_dropdn" title="{$STRINGS.CAPTION_BUTTON_ADD_SURVIVORS_TITLE}"><b><b><b>{$STRINGS.CAPTION_BUTTON_ADD_SURVIVORS}</b></b></b></a>
</td>
</tr>
</table>
</div>
</div>
*}
{if $STRINGS.BOXES.INFOBOX}
	{assign var=BOX_SIDEBOX value=$STRINGS.BOXES.INFOBOX}  
	{include file="admin/box_sidebox.tpl"}
{/if}