{*
   $Id: UserRegisterOptinFailed.tpl 100 2007-10-13 05:48:52Z root $
*}
{*$componentName}
{if $componentObj}
	{$componentObj->getComponentInstanceName()}
{/if}

{if $this}
	{$this->getComponentInstanceName()}
{/if*}

<h3>{t}Opt-In ist fehlgeschlagen{/t}</h3>
<table width="700">
	<tr>
		<td>
   			<div align="left" id="cookieWarning1">{component class="ErrorMessageComponent" name="ErrorMessageComponent1" errors=$ERRORS_ARRAY}</div>
   			<br />
   			<br />
   			<a href="{$PATHS.LIVE_SITE_URL}/signup">{t}Weiter zur Registrierung{/t}</a>.
   		</td>
	</tr>
</table>
