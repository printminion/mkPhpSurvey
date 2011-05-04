{*
   $Id: UserRegisterDefault.tpl 158 2008-01-22 11:00:03Z mimait04 $
*}

{*$componentName}

{if $componentObj}
	{$componentObj->getComponentInstanceName()}
{/if}

{if $this}
	{$this->getComponentInstanceName()}
	{$this->getComponentID()}
{/if*}

<script type="text/javascript">
<!--{literal}
	function onPreCreateAccountSubmit(){
	
		return true;
	}
	{/literal}
//-->
</script>

<h3>{t}Konto erstellen{/t}</h3>
<table width="700">
	<tr>
		<td>
   			<font size="-1">{t PRODUCT_NAME="PRODUCT_NAME"}Über Ihr %PRODUCT_NAME%-Konto erhalten Sie Zugriff auf %PRODUCT_NAME% und{/t} <a target="_blank" href="{$PATHS.LIVE_SITE_URL}/help/de/faq_accounts.html">{t PRODUCT_NAME="PRODUCT_NAME"}andere %PRODUCT_NAME%-Services{/t}</a>.</font>
   			<font size="-1">{t PRODUCT_NAME="PRODUCT_NAME"}Falls Sie bereits über ein %PRODUCT_NAME%-Konto verfügen, können Sie sich{/t} <a href="{$PATHS.LIVE_SITE_URL}">{t}hier anmelden{/t}</a>.</font>
   		</td>
	</tr>
</table>
<br />
<form method="post" name="createaccount" id="createaccount" onsubmit="return(onPreCreateAccountSubmit());"  action="{$PATHS.CURRENT_REQUEST_URL}">
<input type="hidden" name="continue" value="{$PATHS.LIVE_SITE_URL}"/>
<input type="hidden" name="cid" value="{$this->getComponentID()}"/>
<table width="1%" cellspacing="0" cellpadding="2" border="0" bgcolor="white"><tr><td>
<table width="1%" cellspacing="0" cellpadding="2" border="0" bgcolor="#cbdced"><tr><td>
<table width="100%" cellspacing="0" cellpadding="2" border="0" bgcolor="#eeeeee"><tr>
<td valign="top" bgcolor="#ffffff">
<div align="left" id="cookieWarning1">{component class="ErrorMessageComponent" name="ErrorMessageComponent1" errors=$ERRORS_ARRAY}</div>
<table width="100%" cellspacing="0" cellpadding="5" border="0" bgcolor="#ffffff"><tr>
<td valign="top" colspan="2"><span class="gaia ops gsl">{t PRODUCT_NAME="PRODUCT_NAME"}Erste Schritte für %PRODUCT_NAME%{/t}<br /></span></td></tr>

{*
<tr id="AttrRowFirstName">
<td valign="top" nowrap="nowrap" id="AttrLabelCellFirstName">
<span class="gaia cca al">{t}Vorname{/t}:</span></td>
<td id="AttrValueCellFirstName">
	<div class="errorbox-good"><input type="text" size="30" id="FirstName" value="{$this->getFormValue('FirstName')}" name="FirstName" /></div>
</td></tr>
*}
{*
<tr id="AttrRowLastName">
<td valign="top" nowrap="nowrap" id="AttrLabelCellLastName">
<span class="gaia cca al">{t}Nachname{/t}:</span></td>
<td id="AttrValueCellLastName">
<div class="errorbox-good">
<input type="text" size="30" id="LastName" value="{$this->getFormValue('LastName')}" name="LastName" />
</div></td></tr>
*}
<tr>
	<td valign="top" nowrap="nowrap"><font size="-1"  face="Arial, sans-serif"><b>{t}Ihre E-Mail{/t}:</b></font></td>
	<td nowrap="nowrap">
<table border="0">
	<tr>
		<td>
		<div class="errorbox-good">
			<div id="IdTextfield" style="display: block;">
				<input type="text" size="30" id="Email" value="{$this->getFormValue('Email')}" name="Email" />
			</div>
		</div>
		<div id="IdExampleTextDiv" style="display: block;"><font size="-1" face="Arial, sans-serif" color="#6f6f6f">{t}Beispiel{/t}: name@host.de</font></div>
		<div id="IdCheckAvailDiv" style="display: block;">
		<div id="errorDIV"><font size="-1" face="Arial, sans-serif"><br /></font></div>
</div></td>
<td valign="top" nowrap="nowrap" align="left"></td></tr>
</table></td></tr>
<tr>
<td width="1%" valign="top" nowrap="nowrap">
	<font size="-1" face="Arial, sans-serif"><b>{t}Passwort wahlen{/t}:</b></font>
</td>
<td valign="top">
	<table cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff">
	<tr>
	<td valign="top">
		<div class="errorbox-good">
			<input type="password" size="30" name="Passwd" />
		</div>
		<font size="-1" face="arial,sans-serif" color="#6f6f6f">{t}Muss mindestens 8 Zeichen umfassen.{/t}</font>
	</td>
	<td width="10" />
	<td width="180" valign="top" nowrap="nowrap" id="passwdBarDiv" style="display: block;"></td>
	</tr>
	</table>
</td>
</tr>

<tr>
	<td valign="top" nowrap="nowrap"><font size="-1"  face="Arial, sans-serif"><b>{t}Passwort nochmals eingeben:{/t}</b></font></td>
	<td>
		<div class="errorbox-good">
		<input type="password" size="30"  name="PasswdAgain" />
		</div>
	</td>
</tr>

<tr>
   <td valign="top"> <span class="gaia cud cl">{t}Wortbestatigung:{/t}</span> </td>
   <td>
   <table>
      <tr>
         <td valign="top"/>
         <td valign="top">
            <span class="gaia captchahtml desc"><font size="-1" face="Arial, sans-serif">Geben Sie die Zeichen aus dem unten angezeigten Bild ein.</font></span>
            <div>
               <img width="198" height="72" src="{$PATHS.LIVE_SITE_URL}/includes/captcha.php?ctoken={$this->getFormValue('ctoken')}" alt="Visuelle Bestatigung"/>
               <input type="hidden" name="ctoken" value="{$this->getFormValue('ctoken')}"/>
            </div>
         </td>
      </tr>
      <tr>
         <td/>
         <td><div class="errorbox-good">
               <input type="text" size="22" id="newaccountcaptcha" value="{$this->getFormValue('newaccountcaptcha')}" title="{t}Geben Sie die angezeigten Zeichen oder die Zahlen{/t}" name="newaccountcaptcha"/>
         </td>
      </tr>
    </table>
    </td>
</tr>

<tr>
	<td valign="top" nowrap="nowrap">
		<font size="-1" face="Arial, sans-serif"><b>{t}Allgemeine Nutzungsbedingungen{/t}:</b></font>
	</td>
	<td valign="top">
		<font size="-1" face="Arial, sans-serif">{t PRODUCT_NAME="PRODUCT_NAME"}überprufen Sie die von Ihnen oben eingegebenen %PRODUCT_NAME%-Kontodaten (und nehmen Sie bei Bedarf noch Anderungen vor) und lesen Sie die nachstehenden allgemeinen Nutzungsbedingungen durch.{/t}</font>
	</td>
</tr>
<tr>
	<td></td>
	<td valign="top">
	<div class="errorbox-good">
		<div id="tos_div" style="display: inline;">
			<table cellspacing="0" cellpadding="0" border="0">
			<tr>
				<td valign="top" align="right">
					{*<font size="-1"><a target="_blank" href="TOS?loc=DE&hl=en">{t}Druckversion{/t}</a></font>*}
				</td>
			</tr>
			<tr>
				<td><textarea readonly="readonly" cols="80" rows="5" style="width: 100%; text-align: left;" onfocus="this.rows=10" title="">{$this->getValue('DISCLAIMER')}</textarea></td>
			</tr>
			<tr><td></td></tr>
			<tr>
				<td>
					<font size="-1">{t}Klicken Sie nachfolgend auf "Akzeptieren", um die oben genannten {/t}<a target="_blank" href="{$PATHS.LIVE_SITE_URL}/help/de/terms_of_use.html">{t}allgemeinen Nutzungsbedingungen{/t}</a> {t}anzunehmen und die{/t} <a target="_blank" href="{$PATHS.LIVE_SITE_URL}/help/de/program_policies.html">{t}Programmrichtlinien{/t}</a>  {t}und die{/t} <a target="_blank" href="{$PATHS.LIVE_SITE_URL}/help/de/privacy.html">{t}Datenschutzbestimmungen{/t}</a> {t}zu akzeptieren{/t}.</font>
				</td>
			</tr>
			</table>
		</div>
</div></td></tr>
<tr>
<td colspan="1"></td>
<td align="center" colspan="1">
<input type="submit"  name="submitbutton" value="Ich stimme zu. Mein Konto einrichten."  id="submitbutton" style="width: 19em;" /></td></tr>
<tr>
<td /><td>
<div id="cookieWarning2"></div></td></tr>
</table></td></tr>
</table></td></tr>
</table></td></tr>
</table></form>