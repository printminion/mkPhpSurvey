{*
/**
 * 
 * login box 
 * 
 * @version $Id: box_login.tpl 116 2007-11-20 02:32:04Z mimait04 $
 * @copyright 
 * @author 
 *  
 */
*}
<div style="display: block;" id="GM54display">
<table width="100%" cellspacing="3" cellpadding="5" bgcolor="#ffffff" class="form-noindent">
		<tr>
			<td valign="top" nowrap="nowrap" bgcolor="#e8eefa"
				style="text-align: center;">
			<div id="login"><!-- ServiceLoginElements.nui=logo -->
			<div class="body" id="gaia_loginbox">
			<form method="post" id="gaia_loginform" action="{$TPL_LOGIN_BOX.TPL_BOX_LOGIN_FORM_ACTION}">
			<input type="hidden" name="action" value="login"/>
			<table cellspacing="0" cellpadding="1" border="0" align="center"
				id="gaia_table">
				<!-- LoginBoxLogoText.quaddamage=VERSION2 -->
					<tr>
						<td align="center" colspan="2"><font size="-1">{$TPL_LOGIN_BOX.TPL_BOX_LOGIN_CAPTION_LOGIN}</font>
						<!-- LoginBoxDomainAccountLogo.retro=false -->
						<table>
								<tr>
									<td valign="top">{*<img alt="Domain" src="domain_transparent.gif" />*}
									</td>
									<td valign="middle">{*<font size="-0"><b>Konto</b></font>*}</td>
								</tr>
						</table>
						</td>
					</tr>
					<tr>
						<td align="center" colspan="2">
						<div class="errorbox-good"></div>
						</td>
					</tr>
					<tr>
						<td nowrap="nowrap">
						<div align="right"><span class="gaia le lbl">{$TPL_LOGIN_BOX.TPL_BOX_LOGIN_CAPTION_USERNAME}</span>
						</div>
						</td>
						<td><input type="hidden" name="login[url_success]" value="{$TPL_LOGIN_BOX.TPL_BOX_LOGIN_URL_SUCCESS}" /> 
							<input type="hidden" name="hl" value="de"  />
							<input type="text" size="18" id="Email" class="gaia le val" value="" name="login[u]" />
						</td>
					</tr>
					<tr>
						<td />
						
						
						<td align="left"></td>
					</tr>
					<tr>
						<td align="right"><span class="gaia le lbl">{$TPL_LOGIN_BOX.TPL_BOX_LOGIN_CAPTION_PASSWORD}</span></td>
						<td><input type="password" size="18" id="Passwd" class="gaia le val" name="login[p]" /></td>
					</tr>
					<tr>
						<td />
						
						
						<td align="left"></td>
					</tr>
					<tr>
						<td valign="top" align="right">{*<input type="checkbox" value="yes" name="PersistentCookie" />*}</td>
						<td><span class="gaia le rem">{$TPL_LOGIN_BOX.TPL_BOX_LOGIN_CAPTION_SAVEONTHISPC}</span>
						</td>
					</tr>
					<!-- LoginElementsSubmitButton.nui=default -->
					<tr>
						<td />
						<td align="left"><input type="submit" class="gaia le button"
							value="{$TPL_LOGIN_BOX.TPL_BOX_LOGIN_CAPTION_LOGIN_BUTTON}" name="null" /></td>
					</tr>
					<tr id="ga-fprow">
						<td valign="bottom" nowrap="nowrap" height="33" align="center"
							class="gaia le fpwd" colspan="2"><a target="_top"
							href="{$TPL_LOGIN_BOX.TPL_BOX_LOGIN_URL_LOGIN_SUPPORT}">
						{$TPL_LOGIN_BOX.TPL_BOX_LOGIN_CAPTION_LOGIN_SUPPORT}</a></td>
					</tr>
			</table>
			</form>
			</div>
			</div>
			</td>
		</tr>
</table>
</div>
