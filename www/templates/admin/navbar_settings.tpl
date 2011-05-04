{*

	$Id: navbar_settings.tpl 155 2008-01-13 20:01:44Z mimait04 $
	
*}
{*<table width="100%" id="lhid_navbar_nz">
<tbody><tr>
<td>*}
<span id="lhid_navbarlinks_nz">
{if $APP_DATA.IS_ADMIN}
<a href="{$PATHS.LIVE_SITE_URL}/admin">Meine Umfragen</a>
{/if}
<a href="{$PATHS.LIVE_SITE_URL}/admin/?surveyReport&sid={$SURVEY_DATA.SURVEY_ID}&output=print" target="_blank">Druckansicht</a>
{*
<a href="{$PATHS.LIVE_SITE_URL}/admin">Meine Favoriten</a>
<a href="{$PATHS.LIVE_SITE_URL}/admin">Meine öffentliche Galerie</a>
*}
</span>
</td>
<td width="100%"/>
<td>


{*
</td>
</tr>
</table>*}