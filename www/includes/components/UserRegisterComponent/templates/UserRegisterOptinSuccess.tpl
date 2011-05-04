{*
   $Id: UserRegisterOptinSuccess.tpl 100 2007-10-13 05:48:52Z root $
*}
{*$componentName}
{if $componentObj}
	{$componentObj->getComponentInstanceName()}
{/if}

{if $this}
	{$this->getComponentInstanceName()}
{/if*}

<h3>{t}Opt-In war erfolgreich{/t}</h3>
<table width="700">
	<tr>
		<td>
   			{t}Jetzt darfst du gleich loslegen{/t} 
   			<br /><br />
   			<a href="{$PATHS.LIVE_SITE_URL}">{t}Weiter zum Login{/t}</a>.
   		</td>
	</tr>
</table>
