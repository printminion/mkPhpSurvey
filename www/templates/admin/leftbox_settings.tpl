{*

	$Id: leftbox_settings.tpl 116 2007-11-20 02:32:04Z mimait04 $
	
*}
{*<div class="lhcl_body">
<table width="100%">
<tr>
<td id="lhid_leftbox">*}
<div class="lhcl_prettybox">
<div class="lhcl_header">
<table width="100%" class="lhcl_tableheader">
<tr>
<td>mkSurvey-Einstellungen</td>
<td align="right">
{*<a target="_blank" href="https://domin.com/accounts/ManageAccount?hl=de&hl=de" style="font-weight: normal;">domain-Kontoeinstellungen</a>*}
</td>
</tr>
</table>
</div>
<form onsubmit="return _userSettingsForm(this)" method="post" action="/admin/?settingsUpdate" id="lhid_settingsform">
<div class="lhcl_body">
<table width="100%">
<tr>
<td class="lhcl_settings">
	<h1>Pseudonym</h1>
	<table>
		<tr>
{*		<td>
<table>
<tr>
<td>
	<a href="javascript:_d('SettingsPicker');"><img width="48" height="48" alt="" src="http://domain.ru/image/user/user.jpg?imgmax=48&crop=1" id="lhcl_portrait_id" class="lhcl_portrait"/></a>
</td>
</tr>
<tr>
<td><a href="javascript:_d('SettingsPicker');" style="color: rgb(0, 0, 204); text-decoration: underline; font-weight: normal;">Foto wählen</a>
</td>
</tr>
</table>
</td>*}
<td class="lhcl_settings">
<div class="lhcl_settingitem">
<div class="lhcl_title">Ihr Pseudonym ändern:</div>
<input type="text" value="" name="nick" style="margin-left: 5px;"/>
</div>
</td>
</tr>
</table>
</td>
<td class="lhcl_settingsinfo">
<div class="lhcl_title">Wer sieht Ihr Pseudonym?</div>
Ihr mkSurvey-Pseudonym erscheint in Einladungsemail auf eine Umfrage.
</td>
</tr>
{*<tr><td colspan="2" class="lhcl_settingshr"><div class="lhcl_pseudo_hr"> </div></td></tr>
<tr>
<td class="lhcl_settings">
<h1>URL der öffentlichen Galerie</h1>
<div class="lhcl_settingitem">
<div class="lhcl_blueinfobox">http://domain.com/<b id="lhid_personaurl">user</b></div>
<div class="lhcl_title">Ihre URL ändern:</div>
<ul>
<li><input type="radio" onclick="_d('updateGalleryUrl', this);" checked="" value="user" name="urlnick" id="lhid_radiom.user"/>
<label for="lhid_radiom.user">
user</label></li>
</ul>
<div style="padding: 5px; font-size: 0.8em;">Hinweis: Wenn Sie einen neuen Nutzernamen hinzugefügt haben, diesen aber nicht in der Liste sehen, müssen Sie möglicherweise die Seite in Ihrem Browser neu laden.</div>
</div>
<input type="hidden" value="ChgIARIGTWlzY2hhGgxtLmt1cHJpeWFub3Y=" name="cond"/>
</td>
<td class="lhcl_settingsinfo">
<div class="lhcl_title">Wie lautet die URL Ihrer öffentlichen Galerie?</div>
Die standardmäßige URL Ihrer öffentlichen Galerie ist Ihr primärer domain-Nutzername. Sie können diese URL ändern, indem Sie einen Ihrer anderen domain-Nutzernamen wählen.
<br/><br/>
<a href="/lh/addIdentity">Möchten Sie einen neuen domain-Nutzernamen hinzufügen?</a>
</td>
</tr>
*}
{*
<tr><td colspan="2" class="lhcl_settingshr"><div class="lhcl_pseudo_hr"> </div></td></tr>
<tr>
<td class="lhcl_settings">
<h1>Suche in der mkSurvey-Webalben-Community</h1>
<div class="lhcl_settingitem">
<div style="padding-left: 5px;" id="lhid_publicalbumindexing_set">
<input type="checkbox" value="true" name="pai" id="lhid_publicalbumindexing"/>
<label for="lhid_publicalbumindexing">Meine öffentlichen Alben in die Community-Suche einbeziehen.</label>
</div>
</div>
</td>
<td class="lhcl_settingsinfo">
<div class="lhcl_title">Was ist die Suche in der mkSurvey-Webalben-Community?</div>
Wenn diese Einstellung aktiviert ist, können Ihre öffentlichen Alben in der mkSurvey-Webalben-Community gefunden werden. Nicht aufgelistete Alben erscheinen niemals in den Suchergebnissen von öffentlichen mkSurvey-Webalben-Suchvorgängen.
<p><a href="/lh/searchLearnMore">Erfahren Sie mehr</a></p>
</td>
</tr>
*}
<tr><td colspan="2" class="lhcl_settingshr"><div class="lhcl_pseudo_hr"> </div></td></tr>

<tr>
<td class="lhcl_settings">
<a name="emaildigest"/>
<h1>E-Mail-Benachrichtigung</h1>
<div class="lhcl_settingitem">

<ul>
<li><input type="radio" value="NEVER" checked name="dfreq" id="digestfreq_never"/>
<label for="digestfreq_never">Keine Benachrichtigung senden</label></li>
<li><input type="radio" value="DAILY" name="dfreq" id="digestfreq_daily"/>
<label for="digestfreq_daily">tägliche Benachrichtigung</label></li>
</ul>

{*
<ul>
<li><input type="radio" value="NEVER" name="dfreq" id="digestfreq_never"/>
<label for="digestfreq_never">Keine Benachrichtigung senden</label></li>
<li><input type="radio" value="DAILY" name="dfreq" id="digestfreq_daily"/>
<label for="digestfreq_daily">tägliche Benachrichtigung</label></li>
<li><input type="radio" checked="" value="WEEKLY" name="dfreq" id="digestfreq_weekly"/>
<label for="digestfreq_weekly">wöchentliche Benachrichtigung</label></li>
<li><input type="radio" value="MONTHLY" name="dfreq" id="digestfreq_monthly"/>
<label for="digestfreq_monthly">Monatliche Benachrichtigung</label></li>
</ul>
*}
</div>
</td>
<td class="lhcl_settingsinfo">
<div class="lhcl_title">Was ist eine E-Mail-Benachrichtigung?</div>
Wenn ein Umfragende seine Umfrage beendet wird ein Bestätigungs-E-Mail versickt<br/><br/>
Wenn Sie nicht per E-Mail benachrichtigt werden möchten, wählen Sie links "Keine Benachrichtigung senden".
</td>
</tr>
<tr><td colspan="2" class="lhcl_settingshr"><div class="lhcl_pseudo_hr"> </div></td></tr>
<tr>
<td class="lhcl_settings">
<h1>Spracheinstellung</h1>
<div class="lhcl_settingitem">
<div style="padding-left: 5px;">
<select name="langPref">
	<option selected="" value="de">Deutsch</option>
	<option value="en_GB">English (UK)</option>
	<option value="en_US">English (United States)</option>
</select>
</div>
</div>
</td>
<td class="lhcl_settingsinfo">
<div class="lhcl_title"/>
</td>
</tr>
<tr><td colspan="2" class="lhcl_settingshr"><div class="lhcl_pseudo_hr"> </div></td></tr>
{*<tr>
<td class="lhcl_settings">
<h1>Inhaltssteuerelemente</h1>
<div class="lhcl_settingitem">
<div style="padding-left: 5px;">
<input type="checkbox" value="true" checked="" name="dl" id="lhid_enable_download"/>
<label for="lhid_enable_download">Personen, die meine Alben betrachten, dürfen diese mithilfe von mkSurvey herunterladen.</label>
</div>
<div style="padding-left: 5px;">
<input type="checkbox" value="true" checked="" name="rss" id="lhid_enable_rss"/>
<label for="lhid_enable_rss">RSS-Feed-Links in meiner öffentlichen Galerie und auf meinen Albumseiten anzeigen.</label>
</div>
</div>
</td>
<td class="lhcl_settingsinfo">
<div class="lhcl_title">Was sind Inhaltssteuerelemente?</div>Sie können auf Albumseiten den Link zum Herunterladen Ihrer Fotos nach mkSurvey für andere Personen verbergen. Für Sie bleibt er immer sichtbar. Außerdem dürfen Sie in Ihrer Fotogalerie und Ihren Albumseiten den Link zum RSS-Feed des Inhalts verbergen.
</td>
</tr>
<tr><td colspan="2" class="lhcl_settingshr"><div class="lhcl_pseudo_hr"> </div></td></tr>
*}
<tr>
<td colspan="2" class="lhcl_settings">
<div style="padding-top: 15px;">
<input type="submit" value="Einstellungen speichern" class="lhcl_save" id="save"/>
<input type="button" onclick="history.go(-1)" value="Abbrechen" class="lhcl_cancel" id="cancel"/>
</div>
</td>
</tr>
</table>
</div>
</form>
</div>
</td>
</tr>
</table>
<table width="100%">
<tr>
<td id="lhid_leftbox">
{*
<div class="lhcl_prettybox">
<div class="lhcl_header">
<table style="width: 100%;" class="lhcl_tableheader">
<tr>
<td>Speicher</td>
</tr>
</table>
</div>
<div class="lhcl_body">
<a href="/lh/upgradeStorage">Benötigen Sie mehr Platz? Erhöhen Sie Ihren Speicherplatz!</a>
</div>
</div>
*}

{*
</td>
</tr>
</table>
</div>*}