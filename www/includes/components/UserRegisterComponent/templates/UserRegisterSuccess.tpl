{*
   $Id: UserRegisterSuccess.tpl 100 2007-10-13 05:48:52Z root $
*}
{*$componentName*}
{*if $componentObj}
	{$componentObj->getComponentInstanceName()}
{/if*}

{*if $this}
	{$this->getComponentInstanceName()}
{/if*}

<h3>{t}Konto erstellt{/t}</h3>
<table width="700">
	<tr>
		<td>
   			{t}Wir haben gerade eine Aktivirungs-E-Mail an dich geschickt. Bitte lese Sie und bestätige deine Registrierung.<br/>
   			   Das E-Mail muss innrehalb 10 Minuten zugestellt werden. Wenn du keinen E-Mail bekommen hast - überprüfe deinen Spam-Ordner{/t} 
   			<br />
   			<br />
   			<a href="{$PATHS.LIVE_SITE_URL}">{t}Weiter zum Login{/t}</a>.
   		</td>
	</tr>
</table>
