��    r      �  �   <      �	     �	  �   �	     W
     _
  
   n
     y
  *   �
     �
     �
     �
     �
  !   �
       =       R     Z     a     m  $   �  	   �     �    �     �     �  �        �     �     �     �  �   �     n     �     �     �     �     �  �  �  �   �  �   �  �   T  �   �  �   �     A     F     L     O  j   T     �  O   �     -  &   @     g  0   �  #   �     �     �     �  
   �               (     :     J     Y     m     y  	   �     �  	   �  7   �     �  	   �       }        �  
   �  Q   �               $  +   +  <   W  @   �  �   �     �  �   �  �   n  &   �       �   0    �    �  2   �          -    @  �  M   �   "  �   �"  ,   z#     �#  ,  �#  �   �$     �%     �%     �%     �%     �%     �%  
   �%     	&     &     &  	  &     '(  .  8(     g)  +   x)  &   �)     �)  R   �)     +*     >*     S*      r*  <   �*  '   �*  M  �*     F-     d-     q-  :   �-  p   �-     ..  7   F.  6  ~.  +   �0     �0    �0     2  G   2  $   e2     �2    �2  1   �3     �3     �3  /   4  0   64  .   g4  a  �4  �  �7  �  �9  .  �;  S  �<  t  %>  
   �?     �?     �?     �?  �   �?  =   r@  �   �@  :   EA  O   �A  H   �A  F   B  E   `B  ?   �B     �B     �B     C  #   #C  6   GC  )   ~C  *   �C  "   �C  '   �C     D  &   =D     dD  7   �D     �D  z   �D  .   QE     �E  0   �E  �   �E  !   �F     �F  �   �F     �G  $   �G     �G  ^   	H  \   hH  �   �H  �  aI  '   K  *  4K    _L  F   sM  (   �M    �M  �  �N  �  �P  n   TR  .   �R  -   �R  �   S  �  U  �  �X  5  �Z  X   �[     \  �  \  �  �^     +`     I`  '   g`     �`     �`  7   �`  ,   �`     *a     3a     Ba     I   p          A   7   L   ^       0           S           %   c   3   [      &   T   f             G   F   ?      \                         U      '           j       @       r   O       >   h   8   N   +   /                  J          i   q             1   $          :   k           b   R   C   ;   M   m       Q   	   E   9      #   !   V   (       a   o      H      l   2       )   g   .   
   D           X   ,       K       -   ]         4              e   P       Y         6       <   d   W       `   _   Z                5   "      *           n                  =          B           *-prim <strong>Simultaneous:</strong> Rings all extensions at once.</br><strong>Sequential:</strong> Rings each extension separately in the order defined in the list Actions Add Ring Group Alert Info Always Always transmit the Fixed CID Value below. Announcement Applications CID Name Prefix Call Recording Change External CID Configuration Confirm Calls Creates a group of extensions that all ring together. Extensions can be rung all at once, or in various 'hunt' configurations. Additionally, external numbers are supported, and there is a call confirmation option where the callee has to confirm if they actually want to take the call before the caller is transferred. Default Delete Description Destination if no answer Display Extension Ring Group Members Dont Care Enable Call Pickup Enable this if you're calling external numbers that need confirmation - eg, a mobile phone may go to voicemail which will pick up the call. Enabling this requires the remote side push 1 on their phone before the call is put through. This feature only works with the ringall ring strategy Extension List Fixed CID Value Fixed value to replace the CID with used with some of the modes above. Should be in a format of digits only with an option of E164 format using a leading '+'. Force Force Dialed Number Group Description INUSE If you select a Music on Hold class to play, instead of 'Ring', they will hear that instead of Ringing while they are waiting for someone to pick up. Ignore CF Settings Inherit Invalid CID Invalid Group Number specified Invalid time specified List Ring Groups List extensions to ring, one per line, or use the Extension Quick Select insert them here.<br><br>You can include an extension on a remote system, or an external number by suffixing a number with a '#'.  ex:  2448089# would dial 2448089 on the appropriate trunk (see Outbound Routing)<br><br>Extensions without a '#' will not ring a user's Follow-Me. To dial Follow-Me, Queues and other numbers that are not extensions, put a '#' at the end. List extensions to ring, one per line, or use the Extension Quick Select to insert them here.<br><br>You can include an extension on a remote system, or an external number by suffixing a number with a '#'.  ex:  2448089# would dial 2448089 Makes a call could hop between the included extensions without a predefined priority to ensure that calls in the groups are (almost) evenly spread. Simulates a Queue when a Queue can not otherwise be used. Message to be played to the caller before dialing this group.<br><br>To add additional recordings please use the "System Recordings" MENU above Message to be played to the person RECEIVING the call, if 'Confirm Calls' is enabled.<br><br>To add additional recordings use the "System Recordings" MENU above Message to be played to the person RECEIVING the call, if the call has already been accepted before they push 1.<br><br>To add additional recordings use the "System Recordings" MENU above Mode Never No None Only ringall, ringallv2, hunt and the respective -prim versions are supported when confirmation is checked Outside Calls Fixed CID Value Override the ringer volume. Note: This is only valid for %s phones at this time Play Music On Hold Please enter a valid Group Description Please enter an extension list. Provide a descriptive title for this Ring Group. Provide a name for this Ring Group. Remote Announce Reset Ring Ring Group Ring Group %s:  Ring Group Membership Ring Group Module Ring Group Name Ring Group: %s Ring Group: %s (%s) Ring Groups Ring Strategy Ring Time Ring Time (max 300 sec) Ring Tone Ring all available channels until one answers (default) Ring-Group Number RingGroup Ringer Volume Override Select a Ring Tone from the list of options above. This will determine how your phone sounds when it is rung from this group. Send Progress Sequential Should this ringgroup indicate call progress to digital channels where supported. Simultaneous Skip Busy Agent Submit Take turns ringing each available extension The group list can only contain a maximum of 255 characters. The number users will dial to ring extensions in this ring group These modes act as described above. However, if the primary extension (first in list) is occupied, the other extensions will not be rung. If the primary is FreePBX DND, it won't be rung. If the primary is FreePBX CF unconditional, then all will be rung This ringgroup Time in seconds that the phones will ring. For all hunt style ring strategies, this is the time for each iteration of phone(s) that are rung Time in seconds that the phones will ring. For sequential ring strategies, this is the time for each iteration of phone(s) that are rung Time must be between 1 and 300 seconds Too-Late Announce Transmit the Fixed CID Value below on calls that come in from outside only. Internal extension to extension calls will continue to operate in default mode. Transmit the number that was dialed as the CID for calls coming from outside. Internal extension to extension calls will continue to operate in default mode. There must be a DID on the inbound route for this. This WILL be transmitted on trunks that block foreign CallerID Transmit the number that was dialed as the CID for calls coming from outside. Internal extension to extension calls will continue to operate in default mode. There must be a DID on the inbound route for this. This will be BLOCKED on trunks that block foreign CallerID Transmits the Callers CID if allowed by the trunk. Use Dialed Number Warning! Extension When enabled, agents who are on an occupied phone will be skipped as if the line were returning busy. This means that Call Waiting or multi-line phones will not be presented with the call and in the various hunt style ring strategies, the next agent will be attempted. When enabled, this will allow calls to the Ring Group to be picked up with the directed call pickup feature using the group number from any extension. When not checked, individual extensions that are part of the group can still be picked up by doing a directed call pickup by dialing the group number. Any extensions can still be picked up by doing a directed call pickup to the ringing extension , which works whether or not this is checked. When set to Yes, agents who attempt to Call Forward will be ignored, this applies to CF, CFU and CFB. Extensions entered with '#' at the end, for example to access the extension's Follow-Me, might not honor this setting . When set to true extensions that belong to one or more Ring Groups will have a Ring Group section and link back to each group they are a member of. Where to send callers if there is no answer. Yes You can always record calls that come into this ring group (Force), never record them (Never), or allow the extension that answers to do on-demand recording (Dont Care). If recording is denied then one-touch on demand recording will be blocked, unless they have the "Override" call recording setting. You can optionally prefix the CallerID name when ringing extensions in this group. ie: If you prefix with "Sales:", a call from John Doe would display as "Sales:John Doe" on the extensions that ring. default firstavailable firstnotonphone hunt is already in use is not allowed for your account memoryhunt none random ringall Project-Id-Version: FreePBX
Report-Msgid-Bugs-To: 
POT-Creation-Date: 2022-04-03 15:35+0000
PO-Revision-Date: 2018-07-18 19:11+0000
Last-Translator: Chavdar Shtiliyanov <chavdar_75@yahoo.com>
Language-Team: Bulgarian <http://*/projects/freepbx/ringgroups/bg/>
Language: bg_BG
MIME-Version: 1.0
Content-Type: text/plain; charset=UTF-8
Content-Transfer-Encoding: 8bit
Plural-Forms: nplurals=2; plural=n != 1;
X-Generator: Weblate 2.19.1
X-Poedit-Language: Bulgarian
X-Poedit-Country: BULGARIA
X-Poedit-SourceCharset: utf-8
 *-основна <strong>Едновременно:</strong> Звъни на всички вътрешни линии едновременно. </br> <strong>Последователно:</strong> Звъни на всяка вътрешна линия поотделно в реда, определен в списъка Действия Добави Група на Звънене Информация за Сигнал Винаги Винаги предава Фиксиран CID определен по-долу. Съобщение Приложения Префикс на CID Име Запис на Разговор Промяна на Настройки за Външен CID Потвърди Обажданията Създава групи от вътрешни линии които да звънят заедно. Вътрешните линии могат да звънят едновременно или в различни конфигурации на 'преследване'. Допълнително се поддържат и външни номера, а също и опция за потвърждение на обаждането където трябва да се потвърди че искате да поемете обаждането преди да ви се прехвърли. По-Подразбиране Изтрий Описание Направление ако не е отговорено Покажи Вътрешните Номера на Потребителите в Група на Звънене Без Значение Разреши Изтегляне на Обаждане Разрешете ако ви се обаждат външни номера които се нуждаят от потвърждение - например мобилен телефон може да отиде към гласовата поща която да отговори на обаждането. Разрешаването изисква от отсрещната страна да наберат 1 преди обаждането да се достави. Тази услуга работи само със звъни на всички стратегия Списък с Вътрешни Линии Фиксиран CID Фиксирана стойност за замяна на CID с използването на някой от режимите по-горе. Трябва да е само от цифри с възможност за E164 формат с използване на водещ "+". Винаги Принудително Използвай Избрания Номер Описание на Групата ИЗПОЛЗВА СЕ Ако изберете категория на Музика При Задържане за възпроизвеждане вместо Звънене, те ще чуват това вместо Звънене докато чакат някой да отговори. Игнорирай настройките за CF Наследи Неправилен CID Неправилен Номер на Група Неправилно въведено време Списък с Групи на Звънене Въведете вътрешни линии за звънене, една на ред, или използвайте Бързо Избиране на Вътрешни Линии за да ги добавите тук.<br><br>Можете да включите вътрешна линия от отдалечена система, или външен номер чрез добавяне на наставка '#'. Например:  2448089# ще избира 2448089 от съответната външна линия (виж Изходящи Маршрути)<br><br>Вътрешни номера без '#' няма да звънят на потребителски Следвай Ме. За да избирате Следвай Ме, Опашки и други номера които не са вътрешни линии, поставете '#' в края. Въведете вътрешни линии за звънене, една на ред, или използвайте Бързо Избиране на Вътрешни Линии за да ги добавите тук.<br><br>Можете да включите вътрешна линия от отдалечена система, или външен номер чрез добавяне на наставка '#'. Например:  2448089# ще избира 2448089 Обажданията могат да прескачат между включените вътрешни линии без предварително определен приоритет, за да се гарантира, че обажданията в групите са (почти) равномерно разпределени. Симулира опашка, когато опашка не може да бъде използвана по друг начин. Съобщение което ще се възпроизведе на обаждащия се преди да се набере групата.<br><br>За да добавите допълнителни записи, моля използвайте Меню "Системни Записи" отгоре Съобщение което ще се възпроизведе на ПРИЕМАЩИЯ обаждането, ако е маркирано Потвърди Обажданията.<br><br>За да добавите допълнителни записи, моля използвайте Меню "Системни Записи" отгоре Съобщение което ще се възпроизведе на ПРИЕМАЩИЯ обаждането, ако обаждането вече е било прието преди те да натиснат 1.<br><br>За да добавите допълнителни записи, моля използвайте Меню "Системни Записи" отгоре Режим Никога Не Няма Само ringall, ringallv2, hunt и съответните - основна версии се поддържат когато е маркирано потвърждението Фиксиран CID за Изходящи Разговори Променете силата на звънене. Забележка: За момента това работи само за %s телефони Пускане на Музика при Задържане Моля въведете правилно Описание за Групата Моля въведете списъка с вътрешни линии. Наименование за тази Група на Звънене. Въведете име за тази Група на Звънене. Съобщение за Приемащия Обаждането Изчисти Звънене Група на Звънене Група на Звънене %s:  Потребител в Група на Звънене Модул Групи на Звънене Име на Група на Звънене Група на Звънене: %s Група на Звънене: %s (%s) Групи на Звънене Стратегия на Звънене Време на Звънене Време на Звънене (max 300 секунди) Тон на Звънене Звъни на всички достъпни канали докато отговорят (по-подразбиране) Номер на Група на Звънене Група на Звънене Промяна на Сила на Звънене Изберете Тон на Звънене от списъка с опции по-горе. Това ще определи как телефона ще звъни, когато получава обаждане от тази група. Изпрати Състояние Последователно Дали тази група на звънене да обяви прогреса на обаждането към цифрови канали които поддържат функцията. Едновременно Пропусни Зает Агент Приеми Редува звъненето по всички достъпни вътрешни линии Списъкът с групи може да съдържа максимум 255 знака. Номерът който потребителите ще набират за да звънят на вътрешните линии в тази група Този режим е като описания по-горе. Само че ако основната вътрешна линия (първата в списъка) е заета, другите вътрешни линии няма да звънят. Ако основната е FreePBX DND, няма да звъни. Ако основната е безусловен FreePBX CF, тогава всички ще звънят Тази група на звънене Времето в секунди за което телефона ще звъни. Това е времето за всяко повторение на телефона(ите) които звънят при всички типове стратегии на звънене с преследване Времето в секунди за което телефона ще звъни. Това е времето за всяко повторение на телефона(ите) които звънят при стратегия на звънене последователно Времето трябва да е между 1 и 300 секунди Съобщение Много-Късно Предава Фиксиран CID определен по-долу само за входящи външни обаждания. Вътрешните обаждания ще продължат да се извършват в режима по-подразбиране. Предава набрания номер като CID за входящи външни обаждания. Вътрешните обаждания ще продължат да се извършват в режима по-подразбиране. Трябва да има DID на входящ маршрут за това. Ще се ПРЕДАДЕ за външни линии които блокират външен CallerID Предава набрания номер като CID за входящи външни обаждания. Вътрешните обаждания ще продължат да се извършват в режима по-подразбиране. Трябва да има DID на входящ маршрут за това. Ще бъде БЛОКИРАН за външни линии които блокират външен CallerID Предава CID на обаждащия се ако се поддържа от външната линия. Използвай Избрания Номер Внимание! Вътрешна Линия Когато е маркирано, агентите които говорят ще бъдат пропуснати като заета линия. Това означава че Чакащо Повикване или телефони с няклоко линии няма да се представят в обаждането и в различните стратегии на звънене с преследване, следващия агент ще бъде повикан. Когато е активирано, ще позволи обажданията към Групата на Звънене да бъдат изтегляни от всяка вътрешна линия с функцията директно изтегляне на разговор, като се използва номерът на групата. Когато не е маркирано, отделните вътрешни линии, които са част от групата, все още могат да бъдат изтегляни чрез извършване на директно изтегляне на разговор посредством набиране на номера на групата. Всяка вътрешна линия все още може да бъде изтегляна чрез извършване на директно изтегляне на обаждане, което работи независимо дали е маркирано или не. Когато е зададено Да, агентите които опитват Пренасочване на Обаждането ще бъдат игнорирани, това важи за CF, CF Общ и CF Заето. Вътрешните Номера въведени с '#' в края, например за достъп до Следвай Ме, може да не зачетат тези настройки. Когато е установено вярно вътрешните линии които принадлежат на една или повече Групи на Звънене ще имат секция Група на Звънене и линк към всяка група в която участват. Къде да изпратите повикващите, ако няма отговор. Да Можете винаги да записвате разговори, които влизат в тази група на звънене (Винаги), никога да не ги записвате (Никога) или позволете на вътрешната линия която отговори да направи запис ръчно (Без Значение). Ако записването на разговори е забранено тогава ръчния запис ще бъда блокиран, освен ако нямат включен "Отмени" в настройките за запис на разговор. Можете да добавите префикс на CallerID името когато звъните на вътрешните линии в тази група. Например: Префикс "Продажби:", обаждането от Иван Иванов ще се показва "Продажби:Иван Иванов" на вътрешните линии които звънят. по-подразбиране първия свободен първия не на телефона преследване вече се използва не е разрешена за вашия акаунт преследване с запомняне няма случаен звъни на всички 