��    _                      	            
   '     2  *   9     d     q     ~     �  !   �     �  =  �     
     
     
     &
  $   ?
  	   d
     n
    �
     �     �  �   �     _     e     y     �  �   �     '     :     B     a     x  �   �  �   W  �   �  �   �     D     I     O     R  j   W     �     �  &   �       0   :     k     {     �  
   �     �     �     �     �     �     �     �       7        V  	   h     r     �  +   �  @   �  �   �     �  &        )  �   ;    �    �  2   �     &     8    K  �   X  �   6  ,   �     �  ,  �  �   (     �     �                    .  
   N     Y     ^     e  �  m  
   H     S  *   d  1   �     �  t   �     C     Z     o  !   �  V   �  )      �  1      #     +#     :#  =   K#  Y   �#     �#  8   �#  �  .$  ,   �&  5   �&    +'     :(  4   G(     |(     �(  �   �(  P   �)     �)  5   *  *   K*  $   v*  o  �*  W  ,  e  c-  k  �.  
   50     @0     O0     V0  �   ]0  Z   B1  C   �1  G   �1  ?   )2  a   i2  )   �2  
   �2      3     3     '3  -   F3  &   t3     �3  "   �3     �3     �3  /   4  q   E4  $   �4     �4  8   �4     /5  b   F5  �   �5  �  16      �8  G   �8  9   D9    ~9    �:  �  �<  F   �>  6   �>  1   ?    :?  F  UA  a  �C  P   �D     OE    TE  �  \G     �H     �H  "   I     <I     \I  +   |I  0   �I     �I     �I     �I     T   2   W              +   B          "       M              [           S       9          ]   -   ;   J   V          N   1      O              Y      6             :   L   \       )       ,   G   /   D   H   _              R   3           =   @       #   '      5       *       E      F   Z      (       ^   K   <                      	   .       I   7           !   C          ?   $   Q         >      U             &   P   4      8          %       A   0       
      X    *-prim Actions Add Ring Group Alert Info Always Always transmit the Fixed CID Value below. Announcement Applications CID Name Prefix Call Recording Change External CID Configuration Confirm Calls Creates a group of extensions that all ring together. Extensions can be rung all at once, or in various 'hunt' configurations. Additionally, external numbers are supported, and there is a call confirmation option where the callee has to confirm if they actually want to take the call before the caller is transferred. Default Delete Description Destination if no answer Display Extension Ring Group Members Dont Care Enable Call Pickup Enable this if you're calling external numbers that need confirmation - eg, a mobile phone may go to voicemail which will pick up the call. Enabling this requires the remote side push 1 on their phone before the call is put through. This feature only works with the ringall ring strategy Extension List Fixed CID Value Fixed value to replace the CID with used with some of the modes above. Should be in a format of digits only with an option of E164 format using a leading '+'. Force Force Dialed Number Group Description INUSE If you select a Music on Hold class to play, instead of 'Ring', they will hear that instead of Ringing while they are waiting for someone to pick up. Ignore CF Settings Inherit Invalid Group Number specified Invalid time specified List Ring Groups Makes a call could hop between the included extensions without a predefined priority to ensure that calls in the groups are (almost) evenly spread. Simulates a Queue when a Queue can not otherwise be used. Message to be played to the caller before dialing this group.<br><br>To add additional recordings please use the "System Recordings" MENU above Message to be played to the person RECEIVING the call, if 'Confirm Calls' is enabled.<br><br>To add additional recordings use the "System Recordings" MENU above Message to be played to the person RECEIVING the call, if the call has already been accepted before they push 1.<br><br>To add additional recordings use the "System Recordings" MENU above Mode Never No None Only ringall, ringallv2, hunt and the respective -prim versions are supported when confirmation is checked Outside Calls Fixed CID Value Play Music On Hold Please enter a valid Group Description Please enter an extension list. Provide a descriptive title for this Ring Group. Remote Announce Reset Ring Ring Group Ring Group %s:  Ring Group Membership Ring Group Module Ring Group: %s Ring Group: %s (%s) Ring Groups Ring Strategy Ring Time (max 300 sec) Ring all available channels until one answers (default) Ring-Group Number RingGroup Skip Busy Agent Submit Take turns ringing each available extension The number users will dial to ring extensions in this ring group These modes act as described above. However, if the primary extension (first in list) is occupied, the other extensions will not be rung. If the primary is FreePBX DND, it won't be rung. If the primary is FreePBX CF unconditional, then all will be rung This ringgroup Time must be between 1 and 300 seconds Too-Late Announce Transmit the Fixed CID Value below on calls that come in from outside only. Internal extension to extension calls will continue to operate in default mode. Transmit the number that was dialed as the CID for calls coming from outside. Internal extension to extension calls will continue to operate in default mode. There must be a DID on the inbound route for this. This WILL be transmitted on trunks that block foreign CallerID Transmit the number that was dialed as the CID for calls coming from outside. Internal extension to extension calls will continue to operate in default mode. There must be a DID on the inbound route for this. This will be BLOCKED on trunks that block foreign CallerID Transmits the Callers CID if allowed by the trunk. Use Dialed Number Warning! Extension When enabled, agents who are on an occupied phone will be skipped as if the line were returning busy. This means that Call Waiting or multi-line phones will not be presented with the call and in the various hunt style ring strategies, the next agent will be attempted. When set to Yes, agents who attempt to Call Forward will be ignored, this applies to CF, CFU and CFB. Extensions entered with '#' at the end, for example to access the extension's Follow-Me, might not honor this setting . When set to true extensions that belong to one or more Ring Groups will have a Ring Group section and link back to each group they are a member of. Where to send callers if there is no answer. Yes You can always record calls that come into this ring group (Force), never record them (Never), or allow the extension that answers to do on-demand recording (Dont Care). If recording is denied then one-touch on demand recording will be blocked, unless they have the "Override" call recording setting. You can optionally prefix the CallerID name when ringing extensions in this group. ie: If you prefix with "Sales:", a call from John Doe would display as "Sales:John Doe" on the extensions that ring. default firstavailable firstnotonphone hunt is already in use is not allowed for your account memoryhunt none random ringall Project-Id-Version: 1.3
Report-Msgid-Bugs-To: 
PO-Revision-Date: 2016-07-07 11:27+0100
Last-Translator: Alexander Kozyrev <ceo@postmet.com.com>
Language-Team: Russian <http://weblate.postmet.com/freepbx/trunkbalance/ru_RU/>
Language: ru_RU
MIME-Version: 1.0
Content-Type: text/plain; charset=UTF-8
Content-Transfer-Encoding: 8bit
Plural-Forms: nplurals=3; plural=n%10==1 && n%100!=11 ? 0 : n%10>=2 && n%10<=4 && (n%100<10 || n%100>=20) ? 1 : 2;
X-Generator: Weblate 2.2-dev
 *-прим Действия Добавить группу вызова Дополнительная информация Всегда Всегда передавать фиксированное значение Caller ID указанное ниже. Приветствие Приложения Префикс ИД имени Запись соединений Изменить кофигурацию Caller ID для внешних вызовов Подтверждение звонков Создаёт группу внутренних номеров, которые будут звонить одновременно. Сценарии групповых вызовов различны: все вместе, или различные варианты серийных исканий. Дополнительно в группе могут быть так же использованы внешние номера, и здесь можно указать опцию подтверждения для внешнего номера. Которая даёт возможность подтвердить желание принять звонок прежде, чем звонок будет туда перенаправлен. По умолчанию Удалить Описание Назначение, если никто не ответил Отображает внутренние номера членов ринг-группы Все равно Задействовать перехват звонка Включить это если  вызов идёт на внешние номера и тебуется подтверждение - например, когда мобильный телефон может быть переадресован на номер голосовой почты. Включение этой опции требует,чтобы  на удалённой стороне нажали "1" прежде чем вызов пойдёт далее. Эта возможность работает только если стратегия звонка в группе вызова установлена в значение "Звонят все" Лист внутренних номеров Фиксированное значение Caller ID Фикcированное значение для замены CID  в некоторых режимах. Должно быть  в числовом формате с опцией стандарта  Е164 с использованием  знака "+" в начале. Всегда Форсировать набранный номер Описание группы ИСПОЛБЗУЕТСЯ Если выбран класс Музыки в ожидании вместо простого сигнала вызова, то позвонивший будет слушать музыку, пока кто-то не поднимет трубку. Игнорировать установки форварда звонков (CF) Наследовать Указан неверный номер группы Указано неверное время Список Групп Вызова Создание звонков на членов группы без определенного приоритета позволяет гарантировать, что вызовы в группе будут распределены равномерно. Моделирует Очередь, когда Очередь не может использоваться. Сообщение может быть воспроизведено вызывающей стороне перед набором номера этой группы.<br><br>Для добавления дополнительных записей пожалуйста используйте пункт меню  "Системные записи" Воспроизводимое сообщение персоне, ПРИНИМАЮЩЕЙ звонок, если 'Подтвердить вызовы' включено.<br><br> Для добавления дополнительных записей пожалуйста используйте пункт меню  "Системные записи" рядом Воспроизводимое сообщение персоне,ПРИНИМАЮЩЕЙ звонок, если  вызов уже принят перед нажатием 1.<br><br> Для добавления дополнительных записей пожалуйста используйте пункт меню  "Системные записи" рядом Режим Никогда Нет Нет Если отмечено, поддерживаются только сценарии звонят-все, звонят-все-v2, серийное искание и соответствующие им -прим варианты Фиксированное значение Caller ID для внешних вызовов Воспроизводить мелодию на удержании Укажите разрешённое названание группы Укажите список внутренних номеров Предложите понятное название для этой группы вызова. Удаленное приветствие Сброс Звонок Группа вызова Группа вызова %s:  Членство в группе вызова Модуль группы вызова Группа вызова %s Группа вызова: %s (%s) Группы вызова Стратегия вызова Время звонка (макс. 300 сек.) Звонят все каналы, пока один кто либо не ответит (по умолчанию) Номер группы вызова Группа Вызова Пропускать занятого оператора Подтвердить Звонок поступает на любой доступный внутренний номер Этот номер используется для того, чтобы можно было позвонить в э ту группу Этот режим работает так же, как вышеописанные, за исключением того, что если первый внутренний номер из списка занят, следующие по списку не будут звонить. Также зависит от установок 'Не беспокоить' и 'Перенаправление' на первом внутреннем номере списка. Если DND, то поиск в группе на этом заканчивается. Если CF (перенаправление) не перенаправит, то поиск в группе продолжится Эта группа вызова Время должно быть между 1 и 300 секундами Приветствие для Слишком поздно Передавать фиксированное значение Caller ID указанное ниже только в случае исходящих внешних звонков. Внутренние соединения не будут использовать этот Caller ID. Передаёт номер, который был набран как назначение (DID) в качестве Номера ИД, для звонков пришедших снаружи. Внутренние соединения будут передавать Caller ID в обычном режиме. Для этого предполагается входящий маршрут по DID. Он будет передаваться через транк, где провайдеры блокируют чужие Caller ID Передавать набранный Caller ID для перенаправленных звонков, пришедших снаружи. Внутренние соединения будут передавать Caller ID в обычном режиме. Для этого предполагается входящий маршрут по DID. Он будет блокироваться на транке, где провайдеры блокируют чужие Caller ID Передавать Caller ID если позволяет транк. Использовать набранный номер Внимание! Внутренний номер Когда эта опция включена, агенты которые в момент вызова используют телефон будут пропущены так, как будто линия занята. Это означает что CW (ожидание вызова) или телефоны с несколькими линиями не будут учитываться в этот момент времени в любых стратегиях обзвона и будет выбран следующий агент. Если установлено в Да, то попытки перенаправления для агентов будут игнорироваться. Это относится ко всем вариантам Call forward, также и к перенаправлениям по Занято и по неответу. Для номеров, терминированных решёткой '#' на конце, как например - для внешних номеров в опциях Следуйте сюда, эта опция не будет иметь значения. Если установлено в True, внутренние номера, которые принадлежат к одной или более ринг-группе будут отображаться как в секции Ринг-группы, так и в каждой ринг-группе, членами которой они являются. Куда отправлять вызывающих если нет ответа. Да Вы всегда можете записывать вызовы, поступающие в Группу вызова (Всегда), никогда не записывать их (Никогда), или разрешить запись по требованию (Все равно). Если запись отключена, то запись по требованию будет заблокирована, если в настройках записи вызова не выбрано "Переопределить". Опционально, можно использовать какой-то префикс для звонка в эту группу. Например, если это группа "Sales:", то, установив такой префикс для этой группы, можно видеть, если звонит John Doe, то мы увидим на дисплее Sales:John Doe. По умолчанию первый-доступный первый-на-телефоне серийное-искание уже используется отказан в вашем доступе прогресс-серийное-искание Нет случайный-выбор звонят-все 