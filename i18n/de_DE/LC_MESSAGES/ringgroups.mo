��    ]           �      �     �  �   �     �     �  
   �  *   �     �     �     �     	  !   	     7	  =  E	     �
     �
     �
  $   �
  	   �
     �
    �
             �        �     �     �     �  �   �     �     �     �     �     �  �  �  �   �  �   �  �     �   �     x     }     �     �  j   �     �  O        d  &   w     �  0   �  #   �            
        )     9     O     a     q     �     �     �  	   �     �  	   �  7   �       	   $     .  }   E  
   �  Q   �           -     =  +   D  <   p  @   �     �  �   �  �   �  &        :  2   L          �     �     �     �     �     �     �     �  �  �     �  �   �     K     T  
   n  5   y     �     �  !   �     �  0   �     0  �  C     �     �     �  2   �     "  !   1  Z  S     �     �  �   �  	   �      �      �      �   �   �      f!     l!  1   �!     �!     �!  %  �!  *  $  �   8%  �   �%  �   �&     �'     �'     �'     �'  �   �'  (   U(  T   ~(     �(  >   �(  +   0)  D   \)  2   �)     �)     �)     �)     �)     *     **     >*     U*     g*     ~*     �*     �*      �*  
   �*  B   �*     +     3+      A+  �   b+     �+  f   ,     n,  '   {,     �,  2   �,  4   �,  ^   -     s-  �   �-  �   .  ,   �.     �.  [   �.     I/     d/     y/     |/     �/      �/     �/  	   �/     �/                    X   ]   +   K         !       U   T      E   Z       D   W       ;           [   -   =       I      P   ?   2                M          7   9          <   H           )       ,   R   0   #   S          \          4   F       @   $   V   "   '      6       *       G      O   Y      (       .                              >   /   A       8               L   3      C       N         B      Q             &       5   	   :          %       J   1       
           *-prim <strong>Simultaneous:</strong> Rings all extensions at once.</br><strong>Sequential:</strong> Rings each extension separately in the order defined in the list Actions Add Ring Group Alert Info Always transmit the Fixed CID Value below. Announcement Applications CID Name Prefix Call Recording Change External CID Configuration Confirm Calls Creates a group of extensions that all ring together. Extensions can be rung all at once, or in various 'hunt' configurations. Additionally, external numbers are supported, and there is a call confirmation option where the callee has to confirm if they actually want to take the call before the caller is transferred. Default Delete Description Display Extension Ring Group Members Dont Care Enable Call Pickup Enable this if you're calling external numbers that need confirmation - eg, a mobile phone may go to voicemail which will pick up the call. Enabling this requires the remote side push 1 on their phone before the call is put through. This feature only works with the ringall ring strategy Extension List Fixed CID Value Fixed value to replace the CID with used with some of the modes above. Should be in a format of digits only with an option of E164 format using a leading '+'. Force Force Dialed Number Group Description INUSE If you select a Music on Hold class to play, instead of 'Ring', they will hear that instead of Ringing while they are waiting for someone to pick up. Inherit Invalid CID Invalid Group Number specified Invalid time specified List Ring Groups List extensions to ring, one per line, or use the Extension Quick Select insert them here.<br><br>You can include an extension on a remote system, or an external number by suffixing a number with a '#'.  ex:  2448089# would dial 2448089 on the appropriate trunk (see Outbound Routing)<br><br>Extensions without a '#' will not ring a user's Follow-Me. To dial Follow-Me, Queues and other numbers that are not extensions, put a '#' at the end. List extensions to ring, one per line, or use the Extension Quick Select to insert them here.<br><br>You can include an extension on a remote system, or an external number by suffixing a number with a '#'.  ex:  2448089# would dial 2448089 Message to be played to the caller before dialing this group.<br><br>To add additional recordings please use the "System Recordings" MENU above Message to be played to the person RECEIVING the call, if 'Confirm Calls' is enabled.<br><br>To add additional recordings use the "System Recordings" MENU above Message to be played to the person RECEIVING the call, if the call has already been accepted before they push 1.<br><br>To add additional recordings use the "System Recordings" MENU above Mode Never No None Only ringall, ringallv2, hunt and the respective -prim versions are supported when confirmation is checked Outside Calls Fixed CID Value Override the ringer volume. Note: This is only valid for %s phones at this time Play Music On Hold Please enter a valid Group Description Please enter an extension list. Provide a descriptive title for this Ring Group. Provide a name for this Ring Group. Reset Ring Ring Group Ring Group %s:  Ring Group Membership Ring Group Module Ring Group Name Ring Group: %s Ring Group: %s (%s) Ring Groups Ring Strategy Ring Time Ring Time (max 300 sec) Ring Tone Ring all available channels until one answers (default) Ring-Group Number RingGroup Ringer Volume Override Select a Ring Tone from the list of options above. This will determine how your phone sounds when it is rung from this group. Sequential Should this ringgroup indicate call progress to digital channels where supported. Simultaneous Skip Busy Agent Submit Take turns ringing each available extension The group list can only contain a maximum of 255 characters. The number users will dial to ring extensions in this ring group This ringgroup Time in seconds that the phones will ring. For all hunt style ring strategies, this is the time for each iteration of phone(s) that are rung Time in seconds that the phones will ring. For sequential ring strategies, this is the time for each iteration of phone(s) that are rung Time must be between 1 and 300 seconds Too-Late Announce Transmits the Callers CID if allowed by the trunk. Use Dialed Number Warning! Extension Yes default is already in use is not allowed for your account none random ringall Project-Id-Version: PACKAGE VERSION
Report-Msgid-Bugs-To: 
PO-Revision-Date: 2018-07-27 15:00+0000
Last-Translator: Bastian Mertgen <b.mertgen@bastian-mertgen.de>
Language-Team: German <http://*/projects/freepbx/ringgroups/de/>
Language: de_DE
MIME-Version: 1.0
Content-Type: text/plain; charset=UTF-8
Content-Transfer-Encoding: 8bit
Plural-Forms: nplurals=2; plural=n != 1;
X-Generator: Weblate 3.0.1
 *-prim <strong>Gleichzeitig:</strong> Läutet alle Nebenstellen auf einmal an. <br /><strong>Aufeinanderfolgend:</strong>Läutet die Nebenstellen nacheinander in der vorgegebenen Reihenfolge an Aktionen Klingelgruppe hinzufügen Alarm-Info Immer die unten stehende Anruferkennung übermitteln. Ankündigung Anwendungen Namenspräfix für Anruferkennung Anfrufaufzeichnungen Externe Konfiguration der Anurferkennung ändern Anrufe bestätigen Erzeugt eine Gruppe von Nebenstellen, die gemeinsam klingeln. Die Nebenstellen können alle auf einmal oder in verschiedenen „Jagd“-Konfigurationen angeläutet werden. Zusätzlich werden externe Rufnummern unterstützt und es existiert eine Option, Anrufe zu bestätigen, wobei der Angerufene bestätigen muss, ob er den Anruf tatsächlich annehmen will, bevor der Anrufer durchgestellt wird. Standard Löschen Beschreibung Mitglieder der Nebenstellen-Klingelgruppe anzeigen Nicht beachten Heranholen von Anrufen aktivieren Aktivieren Sie dies, wenn Sie externe Nummern anrufen, die eine Bestätigung erfordern - ein Mobiltelefon könnte z.B. auf die Mailbox schalten, die dann den Anruf annimmt. Wird dies aktiviert, muss an der Gegenstelle eine '1' gewählt werden, bevor der Anruf durchgestellt wird. Dieses Merkmal funktioniert nur mit der Klingelstrategie 'ringall' Nebenstellenliste Feste Anruferkennung Fester Wert, der die Anruferkennung in einigen der obigen Modi ersetzt. Darf nur aus Ziffern bestehen, optional kann ein führendes '+' für das E164-Format verwendet werden. Erzwingen Gewählte Nummer erzwingen Beschreibung der Gruppe INUSE Wählen Sie statt „Klingeln“ eine Warteschleifenmusik, die gespielt werden soll, so hört der Anrufer diese während er darauf wartet, dass jemand abhebt. Erben Ungültige Anruferkennung Sie haben eine ungültige Gruppennummer angegeben Ungültige Zeitangabe Klingelgruppen auflisten Listen Sie die Nebenstellen (eine pro Zeile) auf, die angeläutet werden sollen, oder verwenden Sie die Schnellauswahl.<br /><br />Sie können auch Nebenstellen auf einem entfernten System oder eine externe Nummern eintragen, wenn Sie ein '#' anhängen. 08154711# würde z.B. die 08154711 über die entsprechende Hauptleitung anwählen (sh. Ausgehende Routen).<br /><br />Nebenstellen ohne '#' werden keine „Folge-mir“-Ziele von Benutzern anläuten. Um Nummern anzuwählen, die keine Nebenstellen sind, setzen Sie ein '#' an das Ende der Nummer. Listen Sie die Nebenstellen (eine pro Zeile) auf, die angeläutet werden sollen, oder verwenden Sie die Schnellauswahl.<br /><br />Sie können auch Nebenstellen auf einem entfernten System oder eine externe Nummern eintragen, wenn Sie ein '#' anhängen. 08154711# würde z.B. die 08154711 anwählen Nachricht, die dem Anrufer vorgespielt wird, bevor diese Gruppe angewählt wird.<br /><br />Um weitere Aufnahmen hinzuzufügen, nutzen Sie bitte das Menü „Systemaufnahmen“ oben Nachricht, die der Person vorgespielt wird, die den Anruf erhält, falls die Option „Anrufe bestätigen“ aktiviert ist.<br /><br />Um weitere Aufnahmen hinzuzufügen, nutzen Sie bitte das Menü „Systemaufnahmen“ oben Nachricht, die der Person vorgespielt wird, die den Anruf erhält, falls der Anruf bereits angenommen wurde, bevor sie die '1' drückt.<br /><br />Um weitere Aufnahmen hinzuzufügen, nutzen Sie bitte das Menü „Systemaufnahmen“ oben Modus Nie Nein Keine Wenn die Bestätigung aktiviert ist, werden nur 'ringall','ringallv2', 'hunt' und die entsprechenden '-prim'-Versionen unterstützt Feste Anruferkennung für externe Anrufe Ruftonlautstärke übersteuern. Hinweis: Dies gilt zur Zeit nur für Telefone von %s Warteschleifenmusik abspielen Bitte geben Sie eine gültige Beschreibung für die Gruppe ein Bitte geben Sie eine Nebenstellenliste ein. Geben Sie einen aussagekräftigen Titel für diese Klingelgruppe an. Geben Sie einen Namen für diese Klingelgruppe an. Zurücksetzen Klingeln Klingelgruppe Klingelgruppe %s:  Klingelgruppen-Mitgliedschaft Klingelgruppenmodul Name der Klingelgruppe Klingelgruppe: %s Klingelgruppe: %s (%s) Klingelgruppen Klingelstrategie Klingeldauer Klingeldauer (max. 300 Sekunden) Klingelton Alle verfügbaren Kanäle anläuten bis einer antwortet (Standard) Nummer der Klingelgruppe Klingelgruppe Ruftonlautstärke überschreiben Wählen Sie aus der obigen Liste einen Klingelton. Hierdurch wird festgelegt, wie Ihr Telefon klingt, wenn es aus dieser Gruppe angeläutet wird. Aufeinanderfolgend Soll diese Klingelgruppe den Anruffortschritt an digitale Kanäle melden, wenn dies unterstützt wird. Gleichzeitig Beschäftigten Bearbeiter überspringen Absenden Jede verfügbare Nebenstelle abwechselnd anläuten Die Gruppenliste kann maximal 255 Zeichen enthalten. Die Nummer, die Benutzer anwählen werden, um Nebenstellen in dieser Klingelgruppe anzuläuten Diese Klingelgruppe Zeit in Sekunden für die die Telefone klingeln werden. Für alle jagdartigen Klingelstrategien ist dies die Dauer für jeden Wähl-Durchgang Zeit in Sekunden für die die Telefone klingeln werden. Für alle sequentielle Klingelstrategien ist dies die Dauer für jeden Wähl-Durchgang Zeit muss zwischen 1 und 300 Sekunden liegen „Zu spät“-Ankündigung Übermittelt die Anruferkennung des Anrufers, wenn dies auf der Hauptleitung zulässig ist. Gewählte Nummer verwenden Warnung! Nebenstelle Ja Standard wird bereits verwendet ist für Ihr Konto nicht erlaubt keine zufällig ringall 