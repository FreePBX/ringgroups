��    o      �  �         `	     a	     r	  =   y	     �	  
   �	  *   �	     �	     

     
     '
  !   6
  '   X
  >  �
  E   �               *     2     ?  $   X     }     �    �     �     �     �  �   �     �     �     �  �   �     U     h     �  �   �  �   4  �   �  �   p     2     7     =  j   B     �     �  &   �       0   &     W     d     u  
   z     �     �     �     �     �  7   �          �     �     �  +   �  @   �  �   )     &  �   5     �  �   �    q    �  2   �     �     �    �  �   �  �   �  �   a  (   )  '   R  (   z  )   �     �     �               /     7     ?     W     t     �     �     �     �     �     �  
   �     �          0     I  	   ]     g     z     �     �     �  %   �  <   �              0   "  
   K"    V"  *   ]#  1   �#  t   �#     /$     G$     \$  !   {$  V   �$  Q   �$    F%  ]   `'  )   �'  4   �'     (     5(  =   Q(  Y   �(  4   �(  8   )    W)  ,   g+     �+  5   �+  S  �+  4   :-     o-     �-  �   �-  P   �.  5   �.  *   '/  *  R/  E  }0  E  �1  [  	3  
   e4     p4     4  �   �4  Z   k5  :   �5  G   6  ?   I6  a   �6  )   �6  *   7     @7     M7     g7     �7  "   �7     �7  "   �7  q   8  �   u8  $   F9  8   k9  %   �9  b   �9  �   -:  �  �:      _=  2  �=  '   �>    �>    �?  �  B  O   �C  6   7D  1   nD  z  �D  �  G  a  �H  �  0J  A   �K  @   �K  A   8L  C   zL  +   �L  0   �L  ,   M     HM     dM     |M  -   �M  !   �M     �M  %   �M     N  "   ?N     bN     �N  +   �N  0   �N     �N  $   O      DO  &   eO     �O     �O     �O     �O     �O     �O  7   P  x   9P     �P     O   X   @   g       R   V          .       3       >   	      k   !   *   J       
   U             5   "   &               B   h           l          )             D   2   d       6   ?      %                  L   P          a          e       =   [               ;   \   F      C   j   T       M   ^                 1             7   8   K          S          i      n       G                 f                  /   -      Y   m   '   Z      <       $   W       o   Q   I       (   9   b             `   A   H      ,   +   _   E   0   4   #   :   N      ]   c    (pick extension) *-prim ALERT_INFO can be used for distinctive ring with SIP devices. Add Ring Group Alert Info Always transmit the Fixed CID Value below. Announcement: Applications CID Name Prefix Call Recording Change External CID Configuration Checking if recordings need migration.. Checking this will allow calls to the Ring Group to be picked up with the directed call pickup feature using the group number. When not checked, individual extensions that are part of the group can still be picked up by doing a directed call pickup to the ringing extension, which works whether or not this is checked. Choose an extension to append to the end of the extension list above. Confirm Calls Conflicting Extensions Default Delete Group Destination if no answer Display Extension Ring Group Members Edit Ring Group Enable Call Pickup Enable this if you're calling external numbers that need confirmation - eg, a mobile phone may go to voicemail which will pick up the call. Enabling this requires the remote side push 1 on their phone before the call is put through. This feature only works with the ringall ring strategy Extension List Extension Quick Pick Fixed CID Value Fixed value to replace the CID with used with some of the modes above. Should be in a format of digits only with an option of E164 format using a leading "+". Force Dialed Number Group Description INUSE If you select a Music on Hold class to play, instead of 'Ring', they will hear that instead of Ringing while they are waiting for someone to pick up. Ignore CF Settings Invalid Group Number specified Invalid time specified Message to be played to the caller before dialing this group.<br><br>To add additional recordings please use the "System Recordings" MENU to the left Message to be played to the caller before dialing this group.<br><br>You must install and enable the "Systems Recordings" Module to edit this option Message to be played to the person RECEIVING the call, if 'Confirm Calls' is enabled.<br><br>To add additional recordings use the "System Recordings" MENU to the left Message to be played to the person RECEIVING the call, if the call has already been accepted before they push 1.<br><br>To add additional recordings use the "System Recordings" MENU to the left Mode Never None Only ringall, ringallv2, hunt and the respective -prim versions are supported when confirmation is checked Outside Calls Fixed CID Value Play Music On Hold? Please enter a valid Group Description Please enter an extension list. Provide a descriptive title for this Ring Group. Record Calls Remote Announce: Ring Ring Group Ring Group %s:  Ring Group: %s Ring Group: %s (%s) Ring Groups Ring Strategy: Ring all available channels until one answers (default) Ring first extension in the list, then ring the 1st and 2nd extension, then ring 1st 2nd and 3rd extension in the list.... etc. Ring-Group Number Skip Busy Agent Submit Changes Take turns ringing each available extension The number users will dial to ring extensions in this ring group These modes act as described above. However, if the primary extension (first in list) is occupied, the other extensions will not be rung. If the primary is FreePBX DND, it won't be rung. If the primary is FreePBX CF unconditional, then all will be rung This ringgroup Time in seconds that the phones will ring. For all hunt style ring strategies, this is the time for each iteration of phone(s) that are rung Too-Late Announce: Transmit the Fixed CID Value below on calls that come in from outside only. Internal extension to extension calls will continue to operate in default mode. Transmit the number that was dialed as the CID for calls coming from outside. Internal extension to extension calls will continue to operate in default mode. There must be a DID on the inbound route for this. This WILL be transmitted on trunks that block foreign CallerID Transmit the number that was dialed as the CID for calls coming from outside. Internal extension to extension calls will continue to operate in default mode. There must be a DID on the inbound route for this. This will be BLOCKED on trunks that block foreign CallerID Transmits the Callers CID if allowed by the trunk. Use Dialed Number Warning! Extension When checked, agents who are on an occupied phone will be skipped as if the line were returning busy. This means that Call Waiting or multi-line phones will not be presented with the call and in the various hunt style ring strategies, the next agent will be attempted. When checked, agents who attempt to Call Forward will be ignored, this applies to CF, CFU and CFB. Extensions entered with '#' at the end, for example to access the extension's Follow-Me, might not honor this setting . When set to true extensions that belong to one or more Ring Groups will have a Ring Group section and link back to each group they are a member of. You can optionally prefix the CallerID name when ringing extensions in this group. ie: If you prefix with "Sales:", a call from John Doe would display as "Sales:John Doe" on the extensions that ring. added field cfignore to ringgroups table added field cpickup to ringgroups table added field cwignore to ringgroups table added field recording to ringgroups table adding annmsg_id field.. adding remotealert_id field.. adding toolate_id field.. already migrated default deleted dropping annmsg field.. dropping remotealert field.. dropping toolate field.. fatal error firstavailable firstnotonphone hunt is already in use is not allowed for your account memoryhunt migrate annmsg to ids.. migrate remotealert to  ids.. migrate toolate to ids.. migrated %s entries migrating no annmsg field??? no remotealert field??? no toolate field??? none ok ring only the first available channel ring only the first channel which is not offhook - ignore CW ringall Project-Id-Version: 1.3
Report-Msgid-Bugs-To: 
POT-Creation-Date: 2015-02-20 19:59-0500
PO-Revision-Date: 2015-04-25 18:55+0200
Last-Translator: Yuriy <alliancesko@gmail.com>
Language-Team: Russian <http://weblate.freepbx.org/projects/freepbx/ringgroups/ru_RU/>
Language: ru_RU
MIME-Version: 1.0
Content-Type: text/plain; charset=UTF-8
Content-Transfer-Encoding: 8bit
Plural-Forms: nplurals=3; plural=n%10==1 && n%100!=11 ? 0 : n%10>=2 && n%10<=4 && (n%100<10 || n%100>=20) ? 1 : 2;
X-Generator: Weblate 2.2-dev
 (выбрать внутренний номер) *-прим Дополнительная информация ALERT_INFO может быть использования для распознавания адресата чтобы присвоить различный тип звонков на SIP устройствах. Добавить группу вызова Дополнительная информация Всегда передавать фиксированное значение Caller ID указанное ниже. Приветствие: Приложения Префикс ИД имени Запись соединений Изменить кофигурацию Caller ID для внешних вызовов Проверка нуждаются ли записи в перемещении.. Это даёт возможность прямого перехвата входящего вызова используя номер группы. Если не отмечено, то отдельные внутренние номера, являющиеся членами группы, могут перехватывать вызовы, используя сервисный код прямого перехвата, который будет работать вне зависимости отмечено здесь или нет. Выберите внутренний номер для добавления в список. Подтверждение звонков Конфликт внутренних номеров По умолчанию Удалить группу Назначение, если никто не ответил Отображает внутренние номера членов ринг-группы Редактировать группу вызова Задействовать перехват звонка Используйте это, если звонок идёт на внешний номер, который нуждается в подтверждении. Например, мобильный телефон может включить голосовую почту, которая перехватит этот вызов. Нажатием на 1 можно заблокировать такие действия. Опция действительна только при стратегии вызова звонят-все Лист внутренних номеров Выбрать номера Фиксированное значение Caller ID Фиксированное значение для замены Caller ID в зависимости от одного из режимов выше. Должен быть только в цифровом формате, или опционально - в формате Е164 с использованием "+" впереди номера. Форсировать набранный номер Описание группы ИСПОЛБЗУЕТСЯ Если выбран класс Музыки в ожидании вместо простого сигнала вызова, то позвонивший будет слушать музыку, пока кто-то не поднимет трубку. Игнорировать установки форварда звонков (CF) Указан неверный номер группы Указано неверное время Сообщение, которое воспроизводится позвонившему прежде, чем звонок перейдёт в группу.<br><br>Для создания такого сообщения используйте раздел меню Запись сообщений Сообщение, которое воспроизводится позвонившему прежде, чем звонок перейдёт в группу.<br><br>Необходимо инсталлировать модуль "Запись сообщений" чтобы менять что-либо в этой опции Сообщение, которое будет воспроизведено для принявшего звонок, если задействована опция Подтверждение вызова.<br><br>Добавить запись можно в секции "Запись сообщений" в меню слева Сообщение воспроизводится для принявшего этот звонок, если звонок уже принят прежде чем он успел нажать 1.<br><br>Для создания такого сообщения используйте раздел меню "Запись сообщений" слева Режим Никогда Нет Если отмечено, поддерживаются только сценарии звонят-все, звонят-все-v2, серийное искание и соответствующие им -прим варианты Фиксированное значение Caller ID для внешних вызовов Использовать Музыку в ожидании? Укажите разрешённое названание группы Укажите список внутренних номеров Предложите понятное название для этой группы вызова. Записывать соединения Удалённое приветствие: Звонок Группа вызова Группа вызова %s:  Группа вызова %s Группа вызова: %s (%s) Группы вызова Стратегия дозвона: Звонят все каналы, пока один кто либо не ответит (по умолчанию) Звонит первый внутренний номер в списке, затем первый и второй, затем первый, второй и третий в списке, и так далее. Номер группы вызова Пропускать занятого оператора Применить изменения Звонок поступает на любой доступный внутренний номер Этот номер используется для того, чтобы можно было позвонить в э ту группу Этот режим работает так же, как вышеописанные, за исключением того, что если первый внутренний номер из списка занят, следующие по списку не будут звонить. Также зависит от установок 'Не беспокоить' и 'Перенаправление' на первом внутреннем номере списка. Если DND, то поиск в группе на этом заканчивается. Если CF (перенаправление) не перенаправит, то поиск в группе продолжится Эта группа вызова Время в секундах в течение которого телефоны будут звонить. Для всех типов серийного искания в стратегиях звонков, это время звонка для каждого шага стратегий звонков Сообщение Уже-поздно: Передавать фиксированное значение Caller ID указанное ниже только в случае исходящих внешних звонков. Внутренние соединения не будут использовать этот Caller ID. Передаёт номер, который был набран как назначение (DID) в качестве Номера ИД, для звонков пришедших снаружи. Внутренние соединения будут передавать Caller ID в обычном режиме. Для этого предполагается входящий маршрут по DID. Он будет передаваться через транк, где провайдеры блокируют чужие Caller ID Передавать набранный Caller ID для перенаправленных звонков, пришедших снаружи. Внутренние соединения будут передавать Caller ID в обычном режиме. Для этого предполагается входящий маршрут по DID. Он будет блокироваться на транке, где провайдеры блокируют чужие Caller ID Передавать Callers ID, если транк это разрешает. Использовать набранный номер Внимание! Внутренний номер Если отмечено, оператор на вызове будет пропущен и линия возвратит статус Занято. Это служит для тех случаев, когда используются мультиканальные телефоны и телефоны с опцией ожидания второго звонка, которые не верно отрабатывают в различных стратегиях звонков с серийным исканием, таким образом звонок перейдёт следующему члену группы дозвона. Если отмечено, форвардинг звонка будет игнорироваться. Это относится к общим установкам CF, форвардингу на Занято и на Неответе. Внутренний номер, набранный с '#' на конце, например для доступа к опции Следуйте сюда, может быть не сработать. Если установлено в True, внутренние номера, которые принадлежат к одной или более ринг-группе будут отображаться как в секции Ринг-группы, так и в каждой ринг-группе, членами которой они являются. Опционально, можно использовать какой-то префикс для звонка в эту группу. Например, если это группа "Sales:", то, установив такой префикс для этой группы, можно видеть, если звонит John Doe, то мы увидим на дисплее Sales:John Doe. добавлено поле cfignore в таблицу ringgroups добавлено поле cpickup в таблицу ringgroups добавлено поле cwignore в таблицу ringgroups добавлено поле recordings в таблицу ringgroups добавляется поле annmsg_id.. добавляется поле remotealert_id.. добавляется поле toolate_id.. уже перенесено По умолчанию удалено сброс значений поля annmsg.. сброс поля remotealert.. сброс поля toolate.. неустранимая ошибка первый-доступный первый-на-телефоне серийное-искание уже используется отказан в вашем доступе прогресс-серийное-искание перенос annmsg в ИД.. перенос remotealert в ИД.. перенос toolate в ИД.. перемещено %s записей перемещение нет поля annmsg??? нет поля remotealert??? нет поля toolate??? Нет ok звонит первый доступный канал звонит первый телефон, у которого не снята трубка - игнорировать CW звонят-все 