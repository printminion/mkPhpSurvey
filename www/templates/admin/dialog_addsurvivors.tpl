<!--  ######################################################### -->
<div class="lhcl_dialog" id="dialog_addsurvivors" style="display: none">
<form onsubmit="_d('func_4'); return false" action="/lh/createAlbum?tok=-Ll2IZZJQhB2yl4x1ICaXkrEEAY" method="post" id="form">
<input type="hidden" value="user" name="uname"/>
<div class="lhcl_dialog_body">
<h1>
Fotos hochladen: Album erstellen oder auswählen</h1>
<div id="toggle">
<p>
Geben Sie nachfolgend die Details für ein neues Album an oder <a href="javascript:_d('func_1')">
wählen Sie ein vorhandenes Album aus</a>
.</p>
</div>
<div id="dlg">
<div>
<h2>Titel</h2>
<input type="hidden" value="" name="aid"/>
<input type="hidden" value="" name="albumop"/>
<input type="text" maxlength="100" value="Unbenanntes Album" name="title" id="input_3" class="lhcl_input"/>
<h2>Datum</h2>
<div style="position: relative;">
<div>
<input type="text" autocomplete="off" class="lhcl_input" id="lhid_date"/>
</div>
<div style="position: absolute; width: 20em;" id="lhid_dp"/>
<input type="hidden" name="date" id="lhid_datefield" value="6/25/2007"/>
<input type="hidden" name="dateDay" id="select" value="25"/>
<input type="hidden" name="dateMonth" id="select_1" value="5"/>
<input type="hidden" name="dateYear" id="select_2" value="2007"/>
</div>
<h2>Beschreibung <em>(optional)</em></h2>
<textarea id="input_4" name="description" class="lhcl_input"></textarea>
<h2>Ort <em>(optional)</em></h2>
<input type="text" maxlength="100" value="" id="input_5" name="location" class="lhcl_input"/>
<div id="lhid_access">
<p>
<input type="radio" checked="" id="lhid_publicaccess" value="public" name="access"/>
 <label for="lhid_publicaccess"><span class="lhcl_public_searchable_label">Öffentlich</span></label>
 <em>(Standardeinstellung)</em> – Für Alben, die Sie veröffentlichen möchten.</p>
<p class="lhcl_mini_text">
Dieses Product ist für alle Nutzer sichtbar unter <a href="http://domain.ru/user">
http://domain.com/user</a>
. Den Voreinstellungen gemäß wird es bei der Suche in der Product-Community mit einbezogen (Sucheinstellungen können auf der Seite "Einstellungen" geändert werden).</p>
<p>
<input type="radio" id="lhid_unlistedaccess" value="private" name="access"/>
 <label for="lhid_unlistedaccess">
<span class="lhcl_unlisted_label">
Nicht öffentlich</span>
</label>
 – Für Alben, die Sie nur bestimmten Leuten zeigen möchten.</p>
</div>
</div>
</div>
</div>
<div class="lhcl_buttons">
<input type="submit" id="input" class="lhcl_default" value="Weiter"/>
<input type="button" onclick="_d('func_6')" value="Abbrechen" id="input_1"/>
</div>
</form>
</div>
</div>
<!--  ######################################################### -->