<?php
/**
 * @version $Id: lang_register.php 141 2007-12-07 04:23:36Z mimait04 $
 */

define('_ERROR_PASS','Es tut uns leid, kein entsprechender Benutzer wurde gefunden');
define('_NEWPASS_MSG','Dem Benutzerkonto $checkusername ist diese E-mail zugewiesen.\n'
.'Ein Web-Benutzer von $live_site verlangte die Zusendung eines neuen Passwortes.\n\n'
.' Dein neues Passwort ist: $newpass\n\nFalls du das nicht verlangt hattest, mach dir keine Sorgen.'
.' Nur du kannst diese Nachricht sehen. Falls dies ein Fehler war, melde dich einfach mit deinem'
.' neuen Passwort an und дndere das Passwort dann beliebig.');
define('_NEWPASS_SUB','Benutzer Passwort für $checkusername');
define('_NEWPASS_SENT','Neues Benutzer Passwort generiert und gesendet!');
define('_REGWARN_NAME','Bitte deinen Namen eingeben.');
define('_REGWARN_UNAME','Bitte einen Benutzernamen eingeben.');
define('_REGWARN_MAIL','Bitte deine E-mail eingeben.');
define('_REGWARN_PASS','Bitte ein gültiges Passwort eingeben.  Keine Leerzeichen, mehr als 6 Zeichen, die 0-9,a-z,A-Z enthalten.');
define('_REGWARN_VPASS1','Bitte Passwort wiederholen.');
define('_REGWARN_VPASS2','Passwort und Wiederholung stimmen nicht überein, bitte versuche es nocheinmal.');
define('_REGWARN_INUSE','Dieser Benutzername/Passwort ist schon in Verwendung. Bitte versuche etwas anderes.');
//define('_SEND_SUB','Neue Benutzer Details');
//define('_USEND_MSG','Hallo $yourname,\n\n Du wurdest als Benutzer von $live_site hinzugefügt.\n'
//.'Diese E-mail enthдlt deinen Benutzernamen und dein Passwort, um dich auf $live_site anzumelden:\n\n'
//.'Benutzername - $username1\n'
//.'Passwort  - $newpass\n\n\n'
//.'Bitte nicht auf diese Nachricht antworten, da sie automatisch generiert wurde und nur deiner Information dient\n');

//define('_USEND_OPTIN_SUBJECT',PRODUCT_NAME.' bestätigungslink');
//define('_USEND_OPTIN_BODY',"Hallo %USERNAME%,\n\n Du oder eine andere Person wollte dich als Benutzer von %LIVE_SITE% registrieren.\n"
//."Bitte gehe auf folgende Url um die Registrierung abzuschliessen:\n\n"
//." %OPTIN_URL%\n\n\n"
//."Bitte nicht auf diese Nachricht antworten, da sie automatisch generiert wurde und nur deiner Information dient\n");


define('_USEND_OPTIN_SUBJECT',PRODUCT_NAME.' bestätigungslink');
define('_USEND_OPTIN_BODY',"bestätigungslink für %USERNAME%\n"
."-----\n"
."\n"
."bitte klicke auf untenstehenden link, um\n" 
."fortzufahren und deine eingaben zu bestätigen.\n"
."\n"
."%OPTIN_URL%\n"
."\n"
."info:\n" 
."sollte es nicht funktionieren, dann kopiere den\n" 
."link, gib ihn in deinem browser adressfenster ein\n" 
."und drücke 'enter'.\n"
."\n"
.PRODUCT_NAME);

define('_USEND_OPTIN_SUBJECT_HTML',PRODUCT_NAME.' bestätigungslink');
define('_USEND_OPTIN_BODY_HTML',"bestätigungslink für %USERNAME%\n"
."-----\n"
."\n"
."bitte klicke auf untenstehenden link, um\n" 
."fortzufahren und deine eingaben zu bestätigen.\n"
."\n"
."<a href='%OPTIN_URL%' target='_blank'>%OPTIN_URL%</a>\n"
."\n"
."info:\n" 
."sollte es nicht funktionieren, dann kopiere den\n" 
."link, gib ihn in deinem browser adressfenster ein\n" 
."und drücke 'enter'.\n"
."\n"
.PRODUCT_NAME);
 


define('_SEND_SUB',"Neue Benutzer Details");
define('_USEND_MSG',"Hallo %USERNAME%,\n\n Du wurdest als Benutzer von %LIVE_SITE% hinzugefügt.\n"
."Diese E-mail enthдlt deinen Benutzernamen und dein Passwort, um dich auf %LIVE_SITE% anzumelden:\n\n"
."Benutzername:%USERNAME%\n"
."    Passwort:%PASSWORD%\n\n\n"
."Bitte nicht auf diese Nachricht antworten, da sie automatisch generiert wurde und nur deiner Information dient\n");

define('_ASEND_SUB','Ein neuer Benutzer');
define('_ASEND_MSG','Hallo $adminName,\n\nEin neuer Benutzer wurde auf $live_site registriert.\n'
.'Diese E-mail enthдlt seine Details:\n\n'
.'        Name: $yourname\n'
.'      E-Mail: $email\n'
.'Benutzername: $username1\n\n\n'
.'Bitte nicht auf diese Nachricht antworten, da sie automatisch generiert wurde und nur deiner Information dient\n');
define('_REG_COMPLETE','<B>Registration abgeschlossen!</B><br />&nbsp;&nbsp;Du kannst dich jetzt mit deinem Benutzernamen und Passwort anmelden.');

// classes/html/registration.php
define('_PROMPT_PASSWORD','Passwort vergessen?');
define('_NEW_PASS_DESC','Kein problem. Gib nur deinen Benutzernamen ein und drücke auf den \'Senden\' - Button.<br />'
.'Du erhдltst einen Bestдtigungs-Code per E-mail, komm bitte hierher zurück und gib erneut Benutzernamen und Code ein,'
.' danach erhдltst du ein neues Passwort per E-mail.');
define('_PROMPT_UNAME','Benutzername:');
define('_PROMPT_EMAIL','E-Mail Adresse:');
define('_BUTTON_SEND_PASS','Passwort senden');
define('_REGISTER_TITLE','Anmeldung als Gast-Autor');
define('_REGISTER_NAME','Name:');
define('_REGISTER_UNAME','Benutzername:');
define('_REGISTER_EMAIL','E-Mail:');
define('_REGISTER_PASS','Passwort:');
define('_REGISTER_VPASS','Passwort wiederholen:');
define('_BUTTON_SEND_REG','Registration senden');
define('_SENDING_PASSWORD','Dein Passwort wird an die angegebene E-mail Adresse gesendet.<br />Sobald du dein neues Passwort erhalten hast,'
.' kannst du dich anmelden und danach das Passwort beliebig дndern.');

#TODO:Add PRODUCT_DISCLAIMER_TEXT
define('PRODUCT_DISCLAIMER_TEXT','Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Suspendisse tellus. Sed malesuada porta velit. Nulla hendrerit. Mauris posuere, pede eget aliquet aliquet, massa enim fringilla lorem, eu feugiat nisl leo in turpis. Duis adipiscing magna nec elit. In eros pede, euismod sit amet, porta id, rhoncus vitae, justo. Donec fermentum blandit nunc. Ut urna ligula, egestas et, elementum et, tristique eget, purus. Proin vestibulum nisl. Nam scelerisque, magna in viverra malesuada, orci massa placerat eros, sit amet laoreet lectus velit non nisi. Nunc quis lectus sit amet magna congue nonummy. Quisque urna lectus, vehicula in, auctor a, pulvinar in, purus. Quisque congue lectus vel libero. Suspendisse convallis nisl eu eros.

Vestibulum ipsum magna, condimentum eget, lacinia sit amet, luctus eget, neque. Proin adipiscing. Proin pede eros, dictum nec, pretium eget, ornare non, orci. Cras pellentesque tellus. Praesent arcu leo, imperdiet vel, luctus nec, posuere quis, neque. Phasellus ac enim vitae dolor aliquet tempus. Praesent pulvinar augue sit amet elit. Aenean felis magna, viverra vel, imperdiet convallis, suscipit quis, elit. Nam vestibulum est et magna. Ut ligula eros, pellentesque tempor, tempor nec, accumsan vitae, ante. Morbi commodo. Praesent nibh erat, ultrices sed, laoreet non, iaculis et, quam. Cras pulvinar, diam eu consectetuer adipiscing, odio dui vestibulum nisi, nec blandit sapien lorem ut sapien. Maecenas mollis ligula at nunc. Duis hendrerit purus sit amet sem. Mauris eu nisl. Sed turpis dolor, fermentum in, molestie a, eleifend sed, turpis. Nam vitae neque. Duis mollis laoreet lectus.

Suspendisse potenti. Praesent eu odio. Maecenas quis justo sit amet ipsum tempus commodo. Vestibulum fringilla nonummy nibh. Mauris mollis massa in orci. Cras tempus ultricies purus. Etiam a massa. Nunc blandit neque ut arcu. Mauris placerat. Nunc ac lectus at quam egestas condimentum.

Curabitur volutpat, lorem nec luctus tincidunt, metus dolor dapibus dui, sed pulvinar turpis velit ac urna. Aenean lacus arcu, condimentum eu, lacinia et, porttitor nec, sem. Quisque tortor eros, sollicitudin nec, euismod eu, eleifend sed, risus. Phasellus mi ipsum, venenatis eu, auctor a, aliquet non, neque. Aliquam sed mauris sed orci interdum pharetra. Phasellus dignissim odio sed dui. Proin consectetuer placerat arcu. Nulla magna velit, tempor quis, imperdiet et, tempor ornare, orci. Sed venenatis justo vel pede. In vel sem. Nullam congue enim sed odio. Nulla cursus, pede vel tincidunt eleifend, augue sapien molestie erat, in viverra sapien eros vel neque. Cras ligula nibh, luctus quis, tincidunt ac, tristique at, sem. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam sed quam. Phasellus imperdiet condimentum ligula. Morbi at odio.

Sed egestas, purus et mattis varius, tellus sem placerat eros, quis luctus justo nunc id pede. In est neque, ullamcorper ac, cursus vitae, luctus eu, velit. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Sed sodales metus vel enim. Morbi ac libero. Pellentesque imperdiet tellus nec lectus imperdiet consectetuer. Phasellus at metus sed turpis facilisis sagittis. Sed mollis lorem at purus. Proin sed nunc vitae diam vehicula cursus. Quisque augue turpis, vestibulum sed, vestibulum sed, aliquet a, felis. Cras velit eros, eleifend sit amet, vehicula eu, feugiat a, eros. Etiam a risus.

Vestibulum turpis tortor, cursus sed, vehicula ut, elementum non, enim. Pellentesque vehicula libero euismod nulla blandit porta. Ut vel risus a justo lacinia porta. Sed condimentum lorem et ligula. Maecenas feugiat. Vestibulum in ante. Etiam mattis lobortis turpis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Curabitur elementum, dui vitae eleifend fringilla, metus sem consequat felis, eget fermentum augue orci in dolor. Aliquam erat volutpat. Mauris sed est. Morbi erat sapien, mollis id, mollis sed, feugiat sed, libero. Suspendisse a est.

Suspendisse elementum. Integer libero metus, imperdiet sit amet, tempus nec, malesuada ut, risus. Nulla facilisi. Integer ornare dictum magna. Praesent fermentum massa quis ipsum. Nullam eleifend elementum lorem. Cras enim tortor, nonummy in, facilisis pretium, ultrices et, ante. Proin tincidunt auctor diam. Nulla nulla massa, iaculis blandit, dictum et, vehicula bibendum, elit. Etiam neque leo, commodo eu, porttitor vel, sodales tempor, magna. Phasellus sed tellus. Mauris sit amet sapien. Phasellus sit amet felis ac nisl fermentum tempor.

Sed faucibus dictum tellus. Donec fringilla. Aliquam in ligula. Nulla ipsum velit, venenatis at, dignissim in, tincidunt in, nisi. Donec imperdiet hendrerit neque. Donec mollis risus vel pede. Vivamus mauris turpis, dictum blandit, adipiscing vel, aliquam id, mi. Aenean nulla lorem, sollicitudin vitae, tempus eu, euismod non, erat. Sed feugiat condimentum leo. Donec risus augue, adipiscing nec, cursus et, feugiat ut, justo. Cras luctus lacus at purus. Duis egestas leo a dui. Integer interdum scelerisque mi. Quisque purus velit, mattis sed, semper a, lobortis ultrices, risus. Cras mi. Donec eget purus. Maecenas nibh libero, nonummy at, tincidunt in, pretium at, elit. Aliquam sapien dui, lobortis malesuada, ornare sit amet, congue in, magna.

Vivamus ac ligula vitae purus posuere imperdiet. Pellentesque pulvinar pharetra massa. Nulla facilisi. Curabitur id odio ut elit varius luctus. Praesent dapibus placerat nisl. Cras non orci vel nisl tempus cursus. Proin tincidunt. Vivamus turpis. Pellentesque sollicitudin feugiat pede. Aliquam erat volutpat. Vivamus varius. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Sed pulvinar fringilla est. Ut urna libero, fringilla sagittis, tincidunt non, imperdiet ut, libero. Nulla felis. Mauris fringilla mattis erat. Nunc venenatis enim sit amet justo rutrum consequat. Phasellus eget urna vitae libero gravida faucibus. Suspendisse sed metus vitae nunc sodales vulputate.

Proin feugiat. Duis tristique nisi vitae pede. Vestibulum vulputate porta dui. Etiam ipsum. In gravida, ligula vitae lacinia mattis, sem est commodo est, ac dapibus nisi ipsum at nulla. In porta vulputate nunc. Duis iaculis. Etiam risus sapien, tempor in, suscipit at, viverra a, nibh. Quisque vestibulum, est sit amet auctor iaculis, est arcu malesuada tellus, sit amet consequat ipsum urna ac felis. Pellentesque massa massa, dictum ac, ultricies nec, rhoncus vitae, augue. Etiam ultricies felis vel eros.

Sed dapibus, nulla nec malesuada condimentum, mi felis tristique mi, a commodo mi ligula in neque. Quisque lectus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Nunc hendrerit. Donec eget felis. Duis urna nisl, varius nec, semper nec, tempor sed, eros. Aenean odio libero, dapibus varius, consequat quis, suscipit vel, tellus. Aenean sed tellus. Curabitur id turpis. Morbi et odio sed neque consequat cursus. Duis laoreet, tortor vitae lacinia posuere, metus metus facilisis nisi, eu lacinia justo pede ut quam.

Phasellus pulvinar aliquet metus. Cras iaculis, ante vel facilisis volutpat, mi ante iaculis orci, et tristique massa mi vel velit. In blandit sollicitudin sem. Suspendisse sodales. Donec et sem. Donec egestas pede vel tortor. Integer aliquet dolor in ipsum. Pellentesque non velit. Etiam vehicula varius massa. Proin a mauris non felis fringilla dictum. Phasellus interdum lorem nec risus. Aenean id risus. Cras eget mauris quis tellus lacinia dapibus. Phasellus et sem. Etiam elit. Nullam vulputate viverra orci. Fusce semper magna.

Proin sodales. Mauris mi urna, bibendum ac, placerat dignissim, sollicitudin gravida, nibh. Aliquam vel purus nec sapien elementum ornare. Aenean lacinia risus. Mauris bibendum nunc ac sem. Nulla congue ornare diam. Aliquam tincidunt. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Nulla facilisi. Nulla eleifend sem in magna. Ut luctus, ipsum sit amet ultrices ultricies, lectus nibh nonummy nulla, ut volutpat quam turpis quis augue.

Praesent iaculis massa vestibulum lacus. Integer vel tortor a erat congue auctor. Pellentesque lorem felis, hendrerit in, dapibus eget, laoreet vel, nunc. Nam et nulla et massa tristique hendrerit. Integer hendrerit cursus mauris. Aliquam rhoncus turpis at dolor. Praesent sed magna ut ipsum scelerisque pellentesque. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Cras erat est, euismod at, hendrerit nec, venenatis quis, nulla. In condimentum mauris vitae ipsum. Phasellus nulla quam, egestas vitae, sollicitudin sed, euismod eget, dui. Integer erat justo, rutrum quis, luctus ac, tincidunt a, nibh. Nullam accumsan, turpis ac viverra consequat, eros orci eleifend nisl, a pretium arcu dui eu sapien. Vivamus ante leo, vestibulum at, aliquet at, tempus at, pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Nulla massa. Maecenas eget turpis. Quisque eget quam. Praesent non urna pellentesque pede dignissim viverra. Donec commodo pede.

Mauris mi. Vivamus scelerisque magna ut enim. Aenean justo metus, semper id, porttitor quis, sodales eu, arcu. Etiam orci. Cras justo ante, imperdiet et, laoreet nec, congue sit amet, lectus. Sed in purus. Cras hendrerit eleifend arcu. Nam ullamcorper aliquam neque. Suspendisse sed pede. Integer at lacus ullamcorper leo lobortis mollis. Donec tincidunt mollis purus. Proin vitae diam eget lorem rutrum vestibulum. Ut luctus turpis quis neque. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Integer laoreet arcu laoreet turpis mattis egestas. Nulla facilisi. Morbi tempus bibendum dui.

Vestibulum nec urna ut nunc lobortis dictum. Duis tortor nisi, tincidunt vel, mollis ut, bibendum in, ipsum. Phasellus vel metus. Phasellus vel quam. Donec tempus hendrerit lorem. Sed tellus. Vestibulum arcu. Integer tempus facilisis sapien. Duis faucibus. Sed erat dui, nonummy sed, pretium eu, porta ullamcorper, nibh. Aliquam hendrerit. Quisque ipsum augue, vulputate id, iaculis quis, pellentesque sed, neque. Quisque semper. Maecenas ac lacus vitae nunc congue auctor. Sed id sapien. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;

Etiam tristique magna id elit. Cras facilisis est in lectus. Nullam sagittis vulputate justo. Suspendisse cursus. Nam gravida. In congue odio eget purus semper vulputate. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Vivamus rutrum interdum mauris. Ut et sem. Vestibulum cursus nisl ut leo.

Nulla facilisi. Etiam pharetra, neque a viverra condimentum, ante mi volutpat elit, vel sodales turpis est non erat. Praesent posuere. Vivamus eget arcu. Ut tincidunt pharetra odio. Maecenas vitae sem. Nullam sed urna a erat condimentum suscipit. Proin viverra sapien ut risus. Praesent ut nulla. Ut rutrum. Aliquam venenatis, lectus vel blandit lacinia, nisl massa porttitor magna, a laoreet nibh magna in massa.

Vivamus cursus nibh et dolor. Etiam orci. Donec hendrerit arcu at eros. Integer facilisis, est nec eleifend imperdiet, nunc sem vulputate lacus, in dapibus turpis diam id justo. In eget justo. Duis risus diam, iaculis eget, dapibus semper, ultrices vel, urna. Integer urna mauris, convallis vitae, tempus eu, scelerisque nec, leo. Duis pulvinar iaculis ipsum. Suspendisse porttitor risus non dui. Pellentesque venenatis ornare odio. Nulla sapien mi, dignissim in, bibendum vitae, posuere at, risus. Nam nibh. Nunc a justo. In id metus. Vivamus pellentesque nibh sed tortor. Etiam arcu tellus, mattis at, gravida dictum, lobortis quis, felis. Suspendisse luctus, dui nec ornare aliquam, justo tortor convallis sem, tristique lacinia arcu nulla eu pede. Etiam arcu.

Aliquam congue lorem eu nisi. Suspendisse sed sem. Maecenas at urna. Maecenas dictum est at elit. Nunc mi. Mauris convallis facilisis lacus. Vivamus ultricies tristique mi. Praesent vel velit ut urna venenatis rhoncus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nullam at ipsum posuere turpis ultricies fringilla.

Donec eu velit sit amet arcu ultricies pretium. Nam gravida tempus augue. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur tincidunt condimentum lectus. Ut rhoncus lobortis pede. Aliquam faucibus. Fusce at ligula eget elit scelerisque rhoncus. Nulla pretium molestie libero. Vestibulum bibendum, nisi et viverra pharetra, tortor mi hendrerit nisl, eu consectetuer tortor ligula et urna. Cras interdum ultricies metus. Etiam eget augue ut velit elementum porttitor. Integer molestie augue nec sem. Pellentesque consectetuer lacinia ligula. Quisque consectetuer, nisi sit amet faucibus condimentum, quam libero egestas mauris, a condimentum libero purus sit amet dui. Integer et diam. Phasellus iaculis ullamcorper magna. Maecenas placerat libero. Sed odio ipsum, interdum quis, faucibus ut, venenatis id, tellus.

Phasellus sed massa at libero sodales varius. Etiam elementum urna accumsan purus. Suspendisse at est. Sed feugiat. Nam placerat, arcu id tempus fermentum, lectus mi congue dui, et suscipit nunc eros luctus justo. Vestibulum id lacus a erat cursus ultrices. Donec sit amet nisi in nunc nonummy faucibus. Sed fringilla, eros non hendrerit sodales, nisl metus pellentesque dui, eu blandit mauris nulla eget justo. Nam ultrices, diam quis euismod vulputate, turpis orci ultricies dui, scelerisque consectetuer orci risus rhoncus turpis. Donec augue.

Aenean lorem justo, consectetuer ut, aliquam ut, pretium vulputate, mi. Integer lacus. In arcu turpis, interdum ac, laoreet ut, tincidunt ac, enim. Nunc id arcu id elit pellentesque accumsan. Aenean eu lorem. Praesent mollis faucibus mauris. Sed lectus. Quisque ullamcorper fermentum ligula. Nam aliquet viverra dolor. Duis eu purus in libero ultricies rhoncus. Donec at ipsum. Sed a augue. Ut porttitor orci in diam. Fusce pharetra lacus at justo. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.

Cras vulputate pharetra diam. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nunc sit amet risus at sem hendrerit vehicula. Ut molestie neque sit amet nunc. Sed congue, erat eu mollis auctor, lorem lorem vulputate neque, quis laoreet erat ipsum vitae odio. Suspendisse rutrum metus sit amet turpis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aliquam sit amet ipsum quis sapien tincidunt viverra. Nulla euismod egestas lorem. Nam leo pede, tincidunt in, pharetra et, ullamcorper vel, diam.

Maecenas sagittis eleifend ante. Aenean leo ligula, gravida vitae, hendrerit eu, consequat commodo, diam. Pellentesque ut lorem vitae elit euismod euismod. Ut felis orci, sagittis id, pharetra non, euismod eu, leo. Donec porttitor odio id purus. Proin vehicula felis ac felis. Quisque dolor. Proin felis. Nunc vulputate. Donec porttitor risus non mauris. Etiam adipiscing adipiscing neque. Vivamus in erat. Phasellus nec magna vel metus gravida ultrices. Integer vestibulum vulputate arcu. Donec vel ante. Pellentesque leo quam, hendrerit vulputate, condimentum a, fringilla ut, ligula. Aenean congue dictum eros.
');


define('ERROR_CAPTCHA_VALUE_IS_WRONG','Wortbestätigung ist fehlgeschlagen.');
define('ERROR_PASSWORD_IS_TOO_SHORT','Passwort ist zu kurz.');
define('ERROR_PASSWORD_PAIRS_ARE_NOT_EQUAL','Passworter sind nicht identisch.');
define('ERROR_USERID_IS_ALREADY_TAKEN','Dieses E-Mail wurde bereits registriert.');

define('ERROR_UNKNOWN_OPTIN_VALUE','Unbekannte Opt-In Token');
define('ERROR_REQUIRED_SETPARAMETER_EMAIL_IS_NULL','Geben Sie bitte eine E-Mail ein');

?>