{* 
	$Id: ErrorMessageDefault.tpl 100 2007-10-13 05:48:52Z root $ 
*}
{if $ERRORS_ARRAY}
<div id="lhid_error">
<div class="lhcl_errorbody2">
<ul>
	{foreach from=$ERRORS_ARRAY item=error}
	<li>{t}{$error}{/t}</li>
	{/foreach}
</ul>
</div>
</div>
{/if}