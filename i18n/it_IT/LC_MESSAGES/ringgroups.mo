��    q      �  �   ,      �	     �	  �   �	     /
     7
  
   F
  *   Q
     |
     �
     �
     �
  !   �
     �
  =  �
     #     +     2     >  $   W  	   |     �    �     �     �  �   �     w     }     �     �  �   �     ?     R     Z     f     �     �  �  �  �   g  �   W  �   %  �   �  �   V                       j   %     �  O   �     �  &        8  0   X  #   �     �     �     �  
   �     �     �     �               *     >     J  	   X     b  	   z  7   �     �  	   �     �  }   �     m  
   {  Q   �     �     �     �  +   �  <   (  @   e  �   �     �  �   �  �   ?  &   �     �  �       �    �  2   �     �     �      �     �   �!  �   �"  ,   K#     x#  ,  |#  �   �$     q%     y%     �%     �%     �%     �%  
   �%     �%     �%     �%  �  �%     �'  �   �'     �(     �(     �(  0   �(     �(     )     )     %)  #   <)     `)  j  r)     �*     �*     �*      �*  5   +     T+     e+  i  y+     �,     �,  �   -     �-     �-     �-     �-  �   �-  #   |.  	   �.     �.  $   �.     �.     �.  �  /  #  1  �   32  �   3  �   �3  �   �4  	   p5     z5     ~5     �5  �   �5      6  d   -6     �6  1   �6  $   �6  '   7  .   ,7     [7     k7  	   t7     ~7     �7  "   �7     �7     �7     8     8     88     K8     \8     i8     �8  @   �8     �8  	   �8  &   �8  �   9     �9     �9  h   �9  
   0:     ;:     Q:  .   ]:  D   �:      �:  N  �:     A<  �   [<  �   �<  1   �=     �=  �   �=  .  >  )  �?  7   �@     A     $A  ;  :A  5  vB  �   �D  �   �E  .   SF     �F  n  �F    �G      I     I     I     +I     0I  $   >I  
   cI     nI     vI     ~I     f   
   b   	           5                 1   p                    -   [      I   Z      a                 8       q   )   l          (   ,   &   Y       d             h   !             A   W   @           *   $   `   M   _          3   n   ^   E   ;   o          e   j       D           G             ]   H   K       F   7          #   >   0   T   6             C   R   '       "       /   S   m   V      2   <          .   P             J   :   g   =               Q   4              \   N   c   O                  %   B   U   9       ?      i       X   L       +   k    *-prim <strong>Simultaneous:</strong> Rings all extensions at once.</br><strong>Sequential:</strong> Rings each extension separately in the order defined in the list Actions Add Ring Group Alert Info Always transmit the Fixed CID Value below. Announcement Applications CID Name Prefix Call Recording Change External CID Configuration Confirm Calls Creates a group of extensions that all ring together. Extensions can be rung all at once, or in various 'hunt' configurations. Additionally, external numbers are supported, and there is a call confirmation option where the callee has to confirm if they actually want to take the call before the caller is transferred. Default Delete Description Destination if no answer Display Extension Ring Group Members Dont Care Enable Call Pickup Enable this if you're calling external numbers that need confirmation - eg, a mobile phone may go to voicemail which will pick up the call. Enabling this requires the remote side push 1 on their phone before the call is put through. This feature only works with the ringall ring strategy Extension List Fixed CID Value Fixed value to replace the CID with used with some of the modes above. Should be in a format of digits only with an option of E164 format using a leading '+'. Force Force Dialed Number Group Description INUSE If you select a Music on Hold class to play, instead of 'Ring', they will hear that instead of Ringing while they are waiting for someone to pick up. Ignore CF Settings Inherit Invalid CID Invalid Group Number specified Invalid time specified List Ring Groups List extensions to ring, one per line, or use the Extension Quick Select insert them here.<br><br>You can include an extension on a remote system, or an external number by suffixing a number with a '#'.  ex:  2448089# would dial 2448089 on the appropriate trunk (see Outbound Routing)<br><br>Extensions without a '#' will not ring a user's Follow-Me. To dial Follow-Me, Queues and other numbers that are not extensions, put a '#' at the end. List extensions to ring, one per line, or use the Extension Quick Select to insert them here.<br><br>You can include an extension on a remote system, or an external number by suffixing a number with a '#'.  ex:  2448089# would dial 2448089 Makes a call could hop between the included extensions without a predefined priority to ensure that calls in the groups are (almost) evenly spread. Simulates a Queue when a Queue can not otherwise be used. Message to be played to the caller before dialing this group.<br><br>To add additional recordings please use the "System Recordings" MENU above Message to be played to the person RECEIVING the call, if 'Confirm Calls' is enabled.<br><br>To add additional recordings use the "System Recordings" MENU above Message to be played to the person RECEIVING the call, if the call has already been accepted before they push 1.<br><br>To add additional recordings use the "System Recordings" MENU above Mode Never No None Only ringall, ringallv2, hunt and the respective -prim versions are supported when confirmation is checked Outside Calls Fixed CID Value Override the ringer volume. Note: This is only valid for %s phones at this time Play Music On Hold Please enter a valid Group Description Please enter an extension list. Provide a descriptive title for this Ring Group. Provide a name for this Ring Group. Remote Announce Reset Ring Ring Group Ring Group %s:  Ring Group Membership Ring Group Module Ring Group Name Ring Group: %s Ring Group: %s (%s) Ring Groups Ring Strategy Ring Time Ring Time (max 300 sec) Ring Tone Ring all available channels until one answers (default) Ring-Group Number RingGroup Ringer Volume Override Select a Ring Tone from the list of options above. This will determine how your phone sounds when it is rung from this group. Send Progress Sequential Should this ringgroup indicate call progress to digital channels where supported. Simultaneous Skip Busy Agent Submit Take turns ringing each available extension The group list can only contain a maximum of 255 characters. The number users will dial to ring extensions in this ring group These modes act as described above. However, if the primary extension (first in list) is occupied, the other extensions will not be rung. If the primary is FreePBX DND, it won't be rung. If the primary is FreePBX CF unconditional, then all will be rung This ringgroup Time in seconds that the phones will ring. For all hunt style ring strategies, this is the time for each iteration of phone(s) that are rung Time in seconds that the phones will ring. For sequential ring strategies, this is the time for each iteration of phone(s) that are rung Time must be between 1 and 300 seconds Too-Late Announce Transmit the Fixed CID Value below on calls that come in from outside only. Internal extension to extension calls will continue to operate in default mode. Transmit the number that was dialed as the CID for calls coming from outside. Internal extension to extension calls will continue to operate in default mode. There must be a DID on the inbound route for this. This WILL be transmitted on trunks that block foreign CallerID Transmit the number that was dialed as the CID for calls coming from outside. Internal extension to extension calls will continue to operate in default mode. There must be a DID on the inbound route for this. This will be BLOCKED on trunks that block foreign CallerID Transmits the Callers CID if allowed by the trunk. Use Dialed Number Warning! Extension When enabled, agents who are on an occupied phone will be skipped as if the line were returning busy. This means that Call Waiting or multi-line phones will not be presented with the call and in the various hunt style ring strategies, the next agent will be attempted. When enabled, this will allow calls to the Ring Group to be picked up with the directed call pickup feature using the group number from any extension. When not checked, individual extensions that are part of the group can still be picked up by doing a directed call pickup by dialing the group number. Any extensions can still be picked up by doing a directed call pickup to the ringing extension , which works whether or not this is checked. When set to Yes, agents who attempt to Call Forward will be ignored, this applies to CF, CFU and CFB. Extensions entered with '#' at the end, for example to access the extension's Follow-Me, might not honor this setting . When set to true extensions that belong to one or more Ring Groups will have a Ring Group section and link back to each group they are a member of. Where to send callers if there is no answer. Yes You can always record calls that come into this ring group (Force), never record them (Never), or allow the extension that answers to do on-demand recording (Dont Care). If recording is denied then one-touch on demand recording will be blocked, unless they have the "Override" call recording setting. You can optionally prefix the CallerID name when ringing extensions in this group. ie: If you prefix with "Sales:", a call from John Doe would display as "Sales:John Doe" on the extensions that ring. default firstavailable firstnotonphone hunt is already in use is not allowed for your account memoryhunt none random ringall Project-Id-Version: 2.5
Report-Msgid-Bugs-To: 
POT-Creation-Date: 2021-11-11 10:50+0000
PO-Revision-Date: 2018-07-18 19:18+0000
Last-Translator: Stell0 <stefano.fancello@nethesis.it>
Language-Team: Italian <http://*/projects/freepbx/ringgroups/it/>
Language: it_IT
MIME-Version: 1.0
Content-Type: text/plain; charset=UTF-8
Content-Transfer-Encoding: 8bit
Plural-Forms: nplurals=2; plural=n != 1;
X-Generator: Weblate 2.19.1
X-Poedit-Language: Italian
X-Poedit-Country: ITALY
 *-prim <strong> Simultaneo: </ strong> squilla tutte le estensioni contemporaneamente. </br> <strong> Sequenziale: </strong> squilla ciascuna estensione separatamente nell'ordine definito nell'elenco Azioni Aggiungi Gruppo di Chiamata Informazioni di avviso Trasmetti sempre il valore CID fisso di seguito. Annuncio Applicazioni Prefisso Nome CID Registrazione chiamata Modifica configurazione CID esterna Conferma Chiamate Crea un gruppo di estensioni che suonano tutte insieme. Le estensioni possono essere suonate tutte contemporaneamente o in varie configurazioni di "caccia". Inoltre, sono supportati numeri esterni e c'è un'opzione di conferma della chiamata in cui il destinatario deve confermare se in realtà vuole prendere la chiamata prima che il chiamante venga trasferito. Predefinito Elimina Descrizione Destinazione se nessuna risposta Visualizza membri del gruppo di squilli di estensione Non preoccuparti Abilita Call Pickup Abilita questa opzione se chiami numeri esterni che necessitano di conferma, ad esempio un telefono cellulare può passare alla casella vocale che risponde alla chiamata. Per abilitare questa funzione è necessario premere sul lato remoto 1 sul proprio telefono prima che la chiamata venga trasferita. Questa funzione funziona solo con la strategia ringall ring Lista Interni Risolto valore CID Valore fisso per sostituire il CID con utilizzato con alcune delle modalità sopra. Dovrebbe essere in un formato di cifre solo con un'opzione del formato E164 utilizzando un "+" iniziale. Forza Forza numero composto Descrizione Gruppo INUSO Se si seleziona una classe di Musica di Attesa, invece che 'Squillo', l'utente ascolterà questa mentre è in attesa di una risposta. Ignora Impostazioni Trasf. Chiamata Ereditare CID non valido Numero Gruppo specificato non valido Tempo specificato non valido Elenco Gruppi di Chiamata Elenca le estensioni da squillare, una per riga o utilizza l'estensione rapida Seleziona inseriscile qui. <br> <br> È possibile includere un'estensione su un sistema remoto o un numero esterno mediante il suffisso di un numero con un '#'. ex: 2448089 # comporterà la chiamata 2448089 sul trunk appropriato (vedere Routing in uscita) <br> <br> Le estensioni senza "#" non squilleranno il Follow-Me di un utente. Per comporre Follow-Me, Code e altri numeri che non sono estensioni, metti un '#' alla fine. Elenca le estensioni da squillare, una per riga o utilizza la Selezione rapida estensione per inserirle qui. <br> <br> È possibile includere un'estensione su un sistema remoto o un numero esterno mediante il suffisso di un numero con un '#'. ad esempio: 2448089 # comporre il numero 2448089 Effettua una chiamata tra le estensioni incluse senza una priorità predefinita per garantire che le chiamate nei gruppi siano (quasi) distribuite uniformemente. Simula una coda quando una coda non può essere utilizzata in altro modo. Messaggio da riprodurre al chiamante prima di comporre questo gruppo. <br> <br> Per aggiungere ulteriori registrazioni, utilizzare il menu "System Recordings" sopra Messaggio da riprodurre alla persona RICEVERE la chiamata, se è abilitata la funzione "Conferma chiamate". <br> <br> Per aggiungere ulteriori registrazioni utilizzare il menu "Registrazioni di sistema" sopra Messaggio da riprodurre alla persona RICEVERE la chiamata, se la chiamata è già stata accettata prima di premere 1. <br> <br> Per aggiungere ulteriori registrazioni utilizzare il menu "Registrazioni di sistema" sopra Modalità Mai No Nessuno Quando si seleziona la conferma, solo le strategie di squillo ringall, ringallv2, hunt e rispettive versioni -prim sono supportate Chiamate esterne Fixed CID Value Sostituisci il volume della suoneria. Nota: questo è valido solo per %s1 telefono in questo momento Riproduci musica in attesa Prego immettere una Descrizione del Gruppo valida Prego immettere un lista di interni. Il titolo descrittivo per questo gruppo Fornire un nome per questo gruppo di suoneria. Annuncio remoto Azzerare Squillare Gruppo di Chiamata Gruppo di Chiamata %s: Appartenenza al gruppo di suoneria Modulo del gruppo di suoneria nome del gruppo di suoneria Gruppo di Chiamata: %s Gruppo di Chiamata: %s (%s) Gruppi di chiamata strategia Anello Tempo anello Durata squilli (max 300 sec) Suoneria chiama tutti fino a quando un interno non risponde (predefinito) Gruppo di Chiamata Numero ringGroup Sostituzione del volume della suoneria Seleziona un tono suoneria dall'elenco di opzioni sopra. Questo determinerà come suona il tuo telefono quando viene chiamato da questo gruppo. progresso invio Sequenziale Questo gruppo di suoneria dovrebbe indicare l'avanzamento della chiamata sui canali digitali supportati. simultaneo Salta Agenti Occupati Sottoscrivi chiama a circolo tutti gli interni disponibili L'elenco dei gruppi può contenere solo un massimo di 255 caratteri. Il numero del Gruppo di Chiamata queste modalità sono attuate come descritto sopra. Però, se l'interno primario (il primo della lista è occupato, gli altri interni non saranno chiamati. Se il primario ha attivato il Non Disturbare di FreePBX, non andrà avanti. Se il primario è un Trasferimento di Chiamata incondizionato attivato su FreePBX, tutti squilleranno. Questo Gruppo di Chiamata Il tempo in secondi che un telefono squilla. Per i gruppi di chiamata con strategia hunt, equivale allo squillo di ogni singolo interno Tempo in secondi che i telefoni squilleranno. Per le strategie ad anello sequenziali, questo è il tempo per ogni iterazione di telefono (i) che viene chiamato Il tempo deve essere compreso tra 1 e 300 secondi Annuncio tardivo Trasmetti il valore CID fisso di seguito per le chiamate provenienti solo dall'esterno. L'estensione interna alle chiamate di interno continuerà a funzionare in modalità predefinita. Trasmetti il numero chiamato come CID per le chiamate provenienti dall'esterno. L'estensione interna alle chiamate di interno continuerà a funzionare in modalità predefinita. Ci deve essere un DID sulla rotta in entrata per questo. Questo sarà trasmesso su tronchi che bloccano il CallerID straniero Trasmetti il numero chiamato come CID per le chiamate provenienti dall'esterno. L'estensione interna alle chiamate di interno continuerà a funzionare in modalità predefinita. Ci deve essere un DID sulla rotta in entrata per questo. Questo sarà BLOCCATO su trunk che bloccano il CallerID esterno Trasmette il CID del chiamante se consentito dal trunk. Usa numero composto Attenzione! L'interno Se abilitato, gli agenti che si trovano su un telefono occupato verranno saltati come se la linea fosse tornata occupata. Ciò significa che i telefoni di chiamata in attesa o multilinea non saranno presentati con la chiamata e nelle varie strategie di anello di stile di ricerca, verrà tentato il prossimo agente. Se abilitato, questo consentirà alle chiamate al gruppo suoneria di essere rilevate con la funzione di risposta alle chiamate indirizzate utilizzando il numero di gruppo da qualsiasi estensione. Se non selezionato, le singole estensioni che fanno parte del gruppo possono essere ancora prelevate effettuando una raccolta diretta delle chiamate componendo il numero del gruppo. Eventuali estensioni possono ancora essere recuperate effettuando una chiamata diretta verso l'interno della suoneria, che funziona indipendentemente dal fatto che sia selezionata o meno. Se impostato su Sì, gli agenti che tentano di inoltrare la chiamata saranno ignorati, ciò vale per CF, CFU e CFB. Le estensioni inserite con "#" alla fine, ad esempio per accedere al Follow-Me dell'interno, potrebbero non rispettare questa impostazione. Se impostato su estensioni reali che appartengono a uno o più gruppi di suoneria, avrà una sezione Gruppi suoneria e ricollegherà a ciascun gruppo di cui fa parte. Dove inviare i chiamanti se non c'è risposta. Si È sempre possibile registrare le chiamate che entrano in questo gruppo di suoneria (Forza), non registrarle mai (Mai) o consentire l'estensione che risponde alla registrazione su richiesta (Dont Care). Se la registrazione viene negata, la registrazione one-touch on demand verrà bloccata, a meno che non abbiano l'impostazione di registrazione chiamata "Override". È possibile opzionalmente aggiungere il prefisso al nome dell'ID chiamante quando si squillano le estensioni in questo gruppo. Ad esempio: se si prefissa "Vendite:", una chiamata di John Doe viene visualizzata come "Vendite: John Doe" nelle estensioni che squillano. predefinito firstavailable firstnotonphone hunt è gia in uso non ha i permessi per il tuo account memoryhunt nessuna casuale ringall 