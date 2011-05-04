{*
/**
 * 
 * Top Navigation 
 * 
 * @version $Id: topnav.tpl 108 2007-11-15 23:53:12Z mimait04 $
 * @copyright 
 * @author 
 *  
 */
?>
*}
<table style="width: 100%;">
<tr>
<td id="lhid_userinfo">
<b>{$TPL_LOGIN.LOGGED_USER}</b>
{* //TODO:do settings
	| <a href="{$TPL_LOGIN.URL_SETTINGS}">{$TPL_LOGIN.URL_SETTINGS_CAPTION}</a>
*}
| <a target="_blank" href="{$TPL_LOGIN.URL_HELP}">{$TPL_LOGIN.URL_HELP_CAPTION}</a>
| <a href="{$TPL_LOGIN.URL_LOGIN}">{$TPL_LOGIN.URL_LOGIN_CAPTION}</a>
</td>
</tr>
<tr>
<td style="padding-top: 0.5em; padding-right: 0.5em; font-size: 0.8em;" class="lhcl_align_right">
</td>
</tr></table>