��    g      T  �   �      �     �  �   �  =   W	     �	     �	  
   �	  *   �	     �	     �	     �	     
  !   
     =
  =  K
     �     �     �     �  $   �  	   �     �    �          .  �   >     �     �     �     	  �        �     �     �     �     �       �    �   �  �   �  �   �  �     �   �     x     }     �     �  j   �     �  O        d  &   w     �  0   �  #   �            
        )     9     O     a     q     �     �     �  	   �     �  	   �  7   �  �        �  	   �     �  }        �  
   �  Q   �     �     �       +     <   ;  @   x     �  �   �  �   U  &   �       �       �    �  2   �            ,   '     T     X     `     r     �     �     �  �  �     [   �   b   Y   !     w!     �!  	   �!  5   �!     �!     �!  !   �!     "  1    "     R"  �  e"     �#     �#     $  +   $  .   =$     l$  !   {$  Z  �$     �%     
&  �   &     �&     �&     �&     
'  �   '  -   �'     �'     �'  1   �'     /(     E(  %  Z(  *  �*    �+  �   �,  �   u-  �   V.     C/     I/     M/     R/  �   Y/  (   �/  T   0     [0  >   y0  +   �0  D   �0  .   )1     X1     f1  	   o1     y1     �1     �1     �1     �1     �1  
   �1     �1     2      2  
   02  B   ;2  �   ~2     B3  	   W3      a3  �   �3     4     4  a   24     �4  '   �4     �4  2   �4  4   5  Z   :5     �5  �   �5  �   36  ,   �6     �6  �   7  D  �7  A  �8  [   9:     �:     �:  K   �:     ;     ;     ;      4;     U;  	   \;     f;         e       /   C               I   )   P       (              [   V   8   Q   3       7          :   O           _   R   `   ^      <   E   -   N   G   ,      T             6   >       B   F      1             L      9       5                  ?       a   2   Z   "             c   ]      
   @   W      4      %          X          f           !   +   D   J      A   K              S   U                 g   ;   $   '   &                       #   *       =   Y   0   \      b       	   M   H          d       .    *-prim <strong>Simultaneous:</strong> Rings all extensions at once.</br><strong>Sequential:</strong> Rings each extension separately in the order defined in the list ALERT_INFO can be used for distinctive ring with SIP devices. Actions Add Ring Group Alert Info Always transmit the Fixed CID Value below. Announcement Applications CID Name Prefix Call Recording Change External CID Configuration Confirm Calls Creates a group of extensions that all ring together. Extensions can be rung all at once, or in various 'hunt' configurations. Additionally, external numbers are supported, and there is a call confirmation option where the callee has to confirm if they actually want to take the call before the caller is transferred. Default Delete Description Destination if no answer Display Extension Ring Group Members Dont Care Enable Call Pickup Enable this if you're calling external numbers that need confirmation - eg, a mobile phone may go to voicemail which will pick up the call. Enabling this requires the remote side push 1 on their phone before the call is put through. This feature only works with the ringall ring strategy Extension List Fixed CID Value Fixed value to replace the CID with used with some of the modes above. Should be in a format of digits only with an option of E164 format using a leading '+'. Force Force Dialed Number Group Description INUSE If you select a Music on Hold class to play, instead of 'Ring', they will hear that instead of Ringing while they are waiting for someone to pick up. Ignore CF Settings Inherit Invalid CID Invalid Group Number specified Invalid time specified List Ring Groups List extensions to ring, one per line, or use the Extension Quick Select insert them here.<br><br>You can include an extension on a remote system, or an external number by suffixing a number with a '#'.  ex:  2448089# would dial 2448089 on the appropriate trunk (see Outbound Routing)<br><br>Extensions without a '#' will not ring a user's Follow-Me. To dial Follow-Me, Queues and other numbers that are not extensions, put a '#' at the end. List extensions to ring, one per line, or use the Extension Quick Select to insert them here.<br><br>You can include an extension on a remote system, or an external number by suffixing a number with a '#'.  ex:  2448089# would dial 2448089 Makes a call could hop between the included extensions without a predefined priority to ensure that calls in the groups are (almost) evenly spread. Simulates a Queue when a Queue can not otherwise be used. Message to be played to the caller before dialing this group.<br><br>To add additional recordings please use the "System Recordings" MENU above Message to be played to the person RECEIVING the call, if 'Confirm Calls' is enabled.<br><br>To add additional recordings use the "System Recordings" MENU above Message to be played to the person RECEIVING the call, if the call has already been accepted before they push 1.<br><br>To add additional recordings use the "System Recordings" MENU above Mode Never No None Only ringall, ringallv2, hunt and the respective -prim versions are supported when confirmation is checked Outside Calls Fixed CID Value Override the ringer volume. Note: This is only valid for %s phones at this time Play Music On Hold Please enter a valid Group Description Please enter an extension list. Provide a descriptive title for this Ring Group. Provide a name for this Ring Group. Reset Ring Ring Group Ring Group %s:  Ring Group Membership Ring Group Module Ring Group Name Ring Group: %s Ring Group: %s (%s) Ring Groups Ring Strategy Ring Time Ring Time (max 300 sec) Ring Tone Ring all available channels until one answers (default) Ring first extension in the list, then ring the 1st and 2nd extension, then ring 1st 2nd and 3rd extension in the list.... etc. This strategy will work only when Confirm Calls is disabled. Ring-Group Number RingGroup Ringer Volume Override Select a Ring Tone from the list of options above. This will determine how your phone sounds when it is rung from this group. Send Progress Sequential Should this ringgroup indicate call progress to digital channels where supported. Simultaneous Skip Busy Agent Submit Take turns ringing each available extension The group list can only contain a maximum of 255 characters. The number users will dial to ring extensions in this ring group This ringgroup Time in seconds that the phones will ring. For all hunt style ring strategies, this is the time for each iteration of phone(s) that are rung Time in seconds that the phones will ring. For sequential ring strategies, this is the time for each iteration of phone(s) that are rung Time must be between 1 and 300 seconds Too-Late Announce Transmit the Fixed CID Value below on calls that come in from outside only. Internal extension to extension calls will continue to operate in default mode. Transmit the number that was dialed as the CID for calls coming from outside. Internal extension to extension calls will continue to operate in default mode. There must be a DID on the inbound route for this. This WILL be transmitted on trunks that block foreign CallerID Transmit the number that was dialed as the CID for calls coming from outside. Internal extension to extension calls will continue to operate in default mode. There must be a DID on the inbound route for this. This will be BLOCKED on trunks that block foreign CallerID Transmits the Callers CID if allowed by the trunk. Use Dialed Number Warning! Extension Where to send callers if there is no answer. Yes default is already in use is not allowed for your account none random ringall Project-Id-Version: PACKAGE VERSION
Report-Msgid-Bugs-To: 
POT-Creation-Date: 2019-01-31 14:20+0530
PO-Revision-Date: 2019-05-30 12:00+0000
Last-Translator: florian alberts <alberts@ar-systems.de>
Language-Team: German <http://*/projects/freepbx/ringgroups/de/>
Language: de_DE
MIME-Version: 1.0
Content-Type: text/plain; charset=UTF-8
Content-Transfer-Encoding: 8bit
Plural-Forms: nplurals=2; plural=n != 1;
X-Generator: Weblate 3.0.1
 *-prim <strong>Gleichzeitig:</strong> Läutet alle Nebenstellen auf einmal an. <br /><strong>Aufeinanderfolgend:</strong>Läutet die Nebenstellen nacheinander in der vorgegebenen Reihenfolge an ALERT_INFO kann für einen charakteristischen Klingelton auf SIP-Geräten genutzt werden. Aktionen Rufgruppe hinzufügen Alarminfo Immer die unten stehende Anruferkennung übermitteln. Ansage Anwendungen Namenspräfix für Anruferkennung Anfrufaufzeichnungen Konfiguration der externen Anruferkennung ändern Anrufe bestätigen Erzeugt eine Gruppe von Nebenstellen, die gemeinsam klingeln. Die Nebenstellen können alle auf einmal oder in verschiedenen „Jagd“-Konfigurationen angeläutet werden. Zusätzlich werden externe Rufnummern unterstützt und es existiert eine Option, Anrufe zu bestätigen, wobei der Angerufene bestätigen muss, ob er den Anruf tatsächlich annehmen will, bevor der Anrufer durchgestellt wird. Standard Löschen Beschreibung Ziel, falls der Anruf nicht angenommen wird Mitglieder der Nebenstellen-Rufgruppe anzeigen Nicht beachten Heranholen von Anrufen aktivieren Aktivieren Sie dies, wenn Sie externe Nummern anrufen, die eine Bestätigung erfordern - ein Mobiltelefon könnte z.B. auf die Mailbox schalten, die dann den Anruf annimmt. Wird dies aktiviert, muss an der Gegenstelle eine '1' gewählt werden, bevor der Anruf durchgestellt wird. Dieses Merkmal funktioniert nur mit der Klingelstrategie 'ringall' Nebenstellenliste Feste Anruferkennung Fester Wert, der die Anruferkennung in einigen der obigen Modi ersetzt. Darf nur aus Ziffern bestehen, optional kann ein führendes '+' für das E164-Format verwendet werden. Erzwinge Gewählte Nummer erzwingen Beschreibung der Gruppe INUSE Wählen Sie statt „Klingeln“ eine Warteschleifenmusik, die gespielt werden soll, so hört der Anrufer diese während er darauf wartet, dass jemand abhebt. Einstellungen zur Rufweiterleitung ignorieren Erben Ungültige Anruferkennung Sie haben eine ungültige Gruppennummer angegeben Ungültige Zeitangabe Rufgruppen auflisten Listen Sie die Nebenstellen (eine pro Zeile) auf, die angeläutet werden sollen, oder verwenden Sie die Schnellauswahl.<br /><br />Sie können auch Nebenstellen auf einem entfernten System oder eine externe Nummern eintragen, wenn Sie ein '#' anhängen. 08154711# würde z.B. die 08154711 über die entsprechende Hauptleitung anwählen (sh. Ausgehende Routen).<br /><br />Nebenstellen ohne '#' werden keine „Folge-mir“-Ziele von Benutzern anläuten. Um Nummern anzuwählen, die keine Nebenstellen sind, setzen Sie ein '#' an das Ende der Nummer. Listen Sie die Nebenstellen (eine pro Zeile) auf, die angeläutet werden sollen, oder verwenden Sie die Schnellauswahl.<br /><br />Sie können auch Nebenstellen auf einem entfernten System oder eine externe Nummern eintragen, wenn Sie ein '#' anhängen. 08154711# würde z.B. die 08154711 anwählen Sorgt dafür, dass ein Anruf zwischen den enthaltenen Nebenstellen ohne vorgegebene Priorität springt, um sicherzustellen, dasss Anrufen in den Gruppen (beinahe) gleichmäßig verteilt werden. Simuliert eine Warteschlange, wenn sonst keine Warteschlange genutzt werden kann. Nachricht, die dem Anrufer vorgespielt wird, bevor diese Gruppe angewählt wird.<br /><br />Um weitere Aufnahmen hinzuzufügen, nutzen Sie bitte das Menü „Systemaufnahmen“ oben Nachricht, die der Person vorgespielt wird, die den Anruf erhält, falls die Option „Anrufe bestätigen“ aktiviert ist.<br /><br />Um weitere Aufnahmen hinzuzufügen, nutzen Sie bitte das Menü „Systemaufnahmen“ oben Nachricht, die der Person vorgespielt wird, die den Anruf erhält, falls der Anruf bereits angenommen wurde, bevor sie die '1' drückt.<br /><br />Um weitere Aufnahmen hinzuzufügen, nutzen Sie bitte das Menü „Systemaufnahmen“ oben Modus Nie Nein Kein*e Wenn die Bestätigung aktiviert ist, werden nur 'ringall','ringallv2', 'hunt' und die entsprechenden '-prim'-Versionen unterstützt Feste Anruferkennung für externe Anrufe Überschreibe die Klingeltonlautstärke. BEACHTE: Das gilt hier nur für %s Telefone Warteschleifenmusik abspielen Bitte geben Sie eine gültige Beschreibung für die Gruppe ein Bitte geben Sie eine Nebenstellenliste ein. Geben Sie einen aussagekräftigen Titel für diese Klingelgruppe an. Geben Sie einen Namen für diese Rufgruppe an. Zurücksetzen Klingeln Rufgruppe Rufgruppe %s:  Rufgruppen-Mitgliedschaft Rufgruppenmodul Name der Rufgruppe Rufgruppe: %s Rufgruppe: %s (%s) Rufgruppen Klingelstrategie Klingeldauer Klingeldauer (max. 300 Sekunden) Klingelton Alle verfügbaren Kanäle anläuten bis einer antwortet (Standard) Bei erster Durchwahl klingeln, dann bei 1. und 2. Durchwahl klingeln, dann bei 1., 2. und 3. Durchwahl klingeln ... usw. Diese Strategie funktioniert nur, wenn Anrufe bestätigen deaktiviert ist. Nummer der Rufgruppe Rufgruppe Ruftonlautstärke überschreiben Wählen Sie einen Klingelton aus der Liste hier drüber. So klingelt dann Ihr Telefon, wenn Sie von dieser Gruppe angerufen werden. Fortschritt übermitteln Aufeinanderfolgend Soll diese Rufruppe den Anruffortschritt an digitale Kanäle melden, wenn dies unterstützt wird. Gleichzeitig Beschäftigten Bearbeiter überspringen Absenden Jede verfügbare Nebenstelle abwechselnd anläuten Die Gruppenliste kann maximal 255 Zeichen enthalten. Die Nummer, die Benutzer anwählen werden, um Nebenstellen in dieser Rufgruppe anzuläuten Diese Rufgruppe Zeit in Sekunden für die die Telefone klingeln werden. Für alle jagdartigen Klingelstrategien ist dies die Dauer für jeden Wähl-Durchgang Zeit in Sekunden für die die Telefone klingeln werden. Für alle sequentielle Klingelstrategien ist dies die Dauer für jeden Wähl-Durchgang Zeit muss zwischen 1 und 300 Sekunden liegen „Zu spät“-Ankündigung Die unten stehende feste Anruferkennung nur für Anrufe von außerhalb verwenden. Interne Anrufe von Nebenstelle zu Nebenstelle verwenden weiterhin den Standardmodus. Für Anrufe von außerhalb die gewählte Nummer als Anruferkennung übermitteln. Interne Anrufe von Nebenstelle zu Nebenstelle verwenden weiterhin den Standardmodus. Hierfür ist eine Durchwahl aus der eingehenden Route erforderlich. Diese Kennung WIRD auf Hauptleitungen übermittelt, die fremde Anruferkennungen blockieren Für Anrufe von außerhalb die gewählte Nummer als Anruferkennung übermitteln. Interne Anrufe von Nebenstelle zu Nebenstelle verwenden weiterhin den Standardmodus. Hierfür ist eine Durchwahl aus der eingehenden Route erforderlich. Diese Kennung wird auf Hauptleitungen BLOCKIERT, die fremde Anruferkennungen blockieren Übermittelt die Anruferkennung des Anrufers, wenn dies auf der Hauptleitung zulässig ist. Gewählte Nummer verwenden Warnung! Nebenstelle Wohin Anrufer vermittelt werden sollen, wenn der Ruf nicht angenommen wird. Ja Standard wird bereits verwendet ist für Ihr Konto nicht erlaubt nichts zufällig ringall 