��    p      �  �         p	     q	  �   x	     
     
  
   .
  *   9
     d
     q
     ~
     �
  !   �
     �
  =  �
                    &  $   ?  	   d     n    �     �     �  �   �     _     e     y     �  �   �     '     :     B     N     m     �  �  �  �   O  �   ?  �     �   �  �   >     �     �            j        x  O   �     �  &   �        0   @  #   q     �     �     �  
   �     �     �     �     �               &     2  	   @     J  	   b  7   l     �  	   �     �  }   �     U  
   c  Q   n     �     �     �  +   �  <     @   M  �   �     �  �   �  �   '  &   �     �  �   �    �    �  2   �     �     �    �  �      �   �   ,   x!     �!  ,  �!  �   �"     �#     �#     �#     �#     �#     �#  
   �#     $     $     $  �  $     �%  �   �%     }&  3   �&     �&  /   �&     '     '     &'     B'  &   W'     ~'  �  �'     O)     ])     b)  '   k)  \   �)     �)  ;   *  �  =*     ,     0,  �   L,     7-  +   E-     q-     �-  �   �-     P.     m.  !   y.  B   �.  8   �.     /  �  -/  ~  �1  D  b3  �   �4    ~5  �   �6     7     �7     �7  
   �7  �   �7  ?   88  �   x8     �8  0   9  .   @9  :   o9      �9     �9     �9     �9  ,   �9  %   ,:     R:     p:     �:     �:     �:     �:     �:     ;  0   ;     P;  g   _;     �;      �;     �;  �   <     �<     �<  s   �<     U=  '   d=  	   �=  >   �=  B   �=  P   >  �  i>     �?  �   	@  �   �@  2   �A     �A  �   B  x  �B  x  tD  =   �E  #   +F     OF  �  hF  _  	H  �   iI  B   BJ     �J  y  �J    L     M     )M  )   AM     kM     pM  2   �M     �M  
   �M     �M     �M             S           i   I          3       9       Y   	   _   n      e   c       
      &      <   ;   "   /       ^   W   U       l                 ,             M   R   L   7   ?                         -   H   h          N   )          (   O   J           a   g       8      G   `   \       b   d          1   6   j              @   A   2   Q               V   K      D       B             E       %   [   P      4   !              .            $      X   '   p   k   >       +      m          C       T   ]   =   0   *   o   Z   5   :   #   F   f              *-prim <strong>Simultaneous:</strong> Rings all extensions at once.</br><strong>Sequential:</strong> Rings each extension separately in the order defined in the list Actions Add Ring Group Alert Info Always transmit the Fixed CID Value below. Announcement Applications CID Name Prefix Call Recording Change External CID Configuration Confirm Calls Creates a group of extensions that all ring together. Extensions can be rung all at once, or in various 'hunt' configurations. Additionally, external numbers are supported, and there is a call confirmation option where the callee has to confirm if they actually want to take the call before the caller is transferred. Default Delete Description Destination if no answer Display Extension Ring Group Members Dont Care Enable Call Pickup Enable this if you're calling external numbers that need confirmation - eg, a mobile phone may go to voicemail which will pick up the call. Enabling this requires the remote side push 1 on their phone before the call is put through. This feature only works with the ringall ring strategy Extension List Fixed CID Value Fixed value to replace the CID with used with some of the modes above. Should be in a format of digits only with an option of E164 format using a leading '+'. Force Force Dialed Number Group Description INUSE If you select a Music on Hold class to play, instead of 'Ring', they will hear that instead of Ringing while they are waiting for someone to pick up. Ignore CF Settings Inherit Invalid CID Invalid Group Number specified Invalid time specified List Ring Groups List extensions to ring, one per line, or use the Extension Quick Select insert them here.<br><br>You can include an extension on a remote system, or an external number by suffixing a number with a '#'.  ex:  2448089# would dial 2448089 on the appropriate trunk (see Outbound Routing)<br><br>Extensions without a '#' will not ring a user's Follow-Me. To dial Follow-Me, Queues and other numbers that are not extensions, put a '#' at the end. List extensions to ring, one per line, or use the Extension Quick Select to insert them here.<br><br>You can include an extension on a remote system, or an external number by suffixing a number with a '#'.  ex:  2448089# would dial 2448089 Makes a call could hop between the included extensions without a predefined priority to ensure that calls in the groups are (almost) evenly spread. Simulates a Queue when a Queue can not otherwise be used. Message to be played to the caller before dialing this group.<br><br>To add additional recordings please use the "System Recordings" MENU above Message to be played to the person RECEIVING the call, if 'Confirm Calls' is enabled.<br><br>To add additional recordings use the "System Recordings" MENU above Message to be played to the person RECEIVING the call, if the call has already been accepted before they push 1.<br><br>To add additional recordings use the "System Recordings" MENU above Mode Never No None Only ringall, ringallv2, hunt and the respective -prim versions are supported when confirmation is checked Outside Calls Fixed CID Value Override the ringer volume. Note: This is only valid for %s phones at this time Play Music On Hold Please enter a valid Group Description Please enter an extension list. Provide a descriptive title for this Ring Group. Provide a name for this Ring Group. Remote Announce Reset Ring Ring Group Ring Group %s:  Ring Group Membership Ring Group Module Ring Group Name Ring Group: %s Ring Group: %s (%s) Ring Groups Ring Strategy Ring Time Ring Time (max 300 sec) Ring Tone Ring all available channels until one answers (default) Ring-Group Number RingGroup Ringer Volume Override Select a Ring Tone from the list of options above. This will determine how your phone sounds when it is rung from this group. Send Progress Sequential Should this ringgroup indicate call progress to digital channels where supported. Simultaneous Skip Busy Agent Submit Take turns ringing each available extension The group list can only contain a maximum of 255 characters. The number users will dial to ring extensions in this ring group These modes act as described above. However, if the primary extension (first in list) is occupied, the other extensions will not be rung. If the primary is FreePBX DND, it won't be rung. If the primary is FreePBX CF unconditional, then all will be rung This ringgroup Time in seconds that the phones will ring. For all hunt style ring strategies, this is the time for each iteration of phone(s) that are rung Time in seconds that the phones will ring. For sequential ring strategies, this is the time for each iteration of phone(s) that are rung Time must be between 1 and 300 seconds Too-Late Announce Transmit the Fixed CID Value below on calls that come in from outside only. Internal extension to extension calls will continue to operate in default mode. Transmit the number that was dialed as the CID for calls coming from outside. Internal extension to extension calls will continue to operate in default mode. There must be a DID on the inbound route for this. This WILL be transmitted on trunks that block foreign CallerID Transmit the number that was dialed as the CID for calls coming from outside. Internal extension to extension calls will continue to operate in default mode. There must be a DID on the inbound route for this. This will be BLOCKED on trunks that block foreign CallerID Transmits the Callers CID if allowed by the trunk. Use Dialed Number Warning! Extension When enabled, agents who are on an occupied phone will be skipped as if the line were returning busy. This means that Call Waiting or multi-line phones will not be presented with the call and in the various hunt style ring strategies, the next agent will be attempted. When set to Yes, agents who attempt to Call Forward will be ignored, this applies to CF, CFU and CFB. Extensions entered with '#' at the end, for example to access the extension's Follow-Me, might not honor this setting . When set to true extensions that belong to one or more Ring Groups will have a Ring Group section and link back to each group they are a member of. Where to send callers if there is no answer. Yes You can always record calls that come into this ring group (Force), never record them (Never), or allow the extension that answers to do on-demand recording (Dont Care). If recording is denied then one-touch on demand recording will be blocked, unless they have the "Override" call recording setting. You can optionally prefix the CallerID name when ringing extensions in this group. ie: If you prefix with "Sales:", a call from John Doe would display as "Sales:John Doe" on the extensions that ring. default firstavailable firstnotonphone hunt is already in use is not allowed for your account memoryhunt none random ringall Project-Id-Version: PACKAGE VERSION
Report-Msgid-Bugs-To: 
PO-Revision-Date: 2017-07-20 14:33+0200
Last-Translator: PETER <ftek@ymail.com>
Language-Team: Vietnamese <http://weblate.freepbx.org/projects/freepbx/ringgroups/vi/>
Language: vi
MIME-Version: 1.0
Content-Type: text/plain; charset=UTF-8
Content-Transfer-Encoding: 8bit
Plural-Forms: nplurals=1; plural=0;
X-Generator: Weblate 2.4
 *-prim <strong>Simultaneous:</strong> Đổ chuông tất cả các máy nhánh cùng một lúc.</br><strong>Sequential:</strong> Đổ chuông từng máy nhánh theo thứ tứ được xác định trong danh sách Các tháo tác Thêm tính năng Nhóm đổ chuông ( Ring group) Thông tin cảnh báo Luôn truyền giá trị CID cố định sau. Thông báo Các ứng dụng Tiền ngữ của tên CID Ghi âm cuộc gọi Thay đổi cấu hình CID nội bộ Xác nhận các cuộc gọi Tạo một nhóm các máy nhánh đổ chuông cùng nhau. Các máy nhánh có thể đổ chuông cùng một thời điểm hay trong các cấu hình 'hunt' khác nhau. Ngoài ra, các số điện thoại bên ngoài được hỗ trợ và có thêm một tùy chọn xác nhận cuộc gọi, theo đó người được gọi phải xác nhận nếu họ muốn nhận cuộc gọi trước khi người gọi gọi đến. Mặc định Xóa Mô tả Điểm đích nếu không trả lời Hiển thị các thành viên của Extension Ring Group ( Nhóm đổ chuông máy nhánh) Không quan tâm Kích cuộc tính năng Nhấc cuộc gọi ( Call Pickup) Bật tính năng này nếu đang gọi cho các số bên ngoài mà cần phải xác nhận.  - ví dụ: điện thoại di động có thể truy cập vào hộp thư thoại để nhận cuộc gọi. Kích hoạt tính năng này đòi hỏi người đầu dây kia phải nhấn phím 1 trên điện thoại của họ trước khi cuộc gọi được thực hiện. Tính năng này chỉ hoạt động với chiến thuật đổ chuông tất cả (ringall) Danh sách máy nhánh Gía trị CID cố định Giá trị cố định để thay thế CID được sử dụng cùng với các chế độ trên. Định dạng của giá trị này nên chỉ ở dạng chữ số với tùy chọn định dạng E164 bắt đầu bằng '+'. Buộc phải Bắt buộc số điện thoại đã quay Mô tả nhóm INUSE Nếu bạn chọn lớp nhạc chờ để phát thay vì cho đổ chuông, thì trong khi họ chờ ai đó nhấc máy họ sẽ nghe thấy tiếng nhạc chứ không phải tiếng chuông reo. Bỏ qua các cài đặt CF Kế thừa Caller ID (CID) không hợp lệ Số điện thoại nhóm không hợp lễ được xác định Thời gian không hợp lệ đã được xác định Danh sách Ring Group Danh sách máy nhánh đổ chuông, 1 dòng 1 máy, hoặc sử dụng chức  năng chọn nhanh máy nhánh Extension Quick Select để chèn chúng tại đây.<br><br>bạn có thể bao gồm một máy nhánh trên hệ thống từ xa, hoặc một số điện thoại bên ngoài bằng cách thêm vào cuối số đó dấu #. Ví dụ 2448089# sẽ quay số 2448089 trên một trung kế phù hợp ( Xem phần Outbound Routing)<br><br> Các máy nhanh không có dấu # sẽ không đổ chuông Follow-Me của người dùng. Để quay số Follow-Me, các hàng đợi và các số điện thoại khác không phải là máy nhánh phải đặt dấu # ở cuối. Danh sách máy nhánh đổ chuông, 1 dòng 1 máy, hoặc sử dụng chức  năng chọn nhanh máy nhánh Extension Quick Select để chèn chúng tại đây.<br><br>bạn có thể bao gồm một máy nhánh trên hệ thống từ xa, hoặc một số điện thoại bên ngoài bằng cách thêm vào cuối số đó dấu #. Ví dụ 2448089# sẽ quay số 2448089 Thực hiện một cuộc gọi có thể nhảy giữa các máy nhánh mà không cần có quyền ưu tiên xác định trước để đảm bảo các hầu hết cuộc gọi trong các nhóm đều được lan truyền. Mô phỏng một hàng đợi đó đợi khi chính hàng đợi đó được sử dụng. Một tin nhắn sẽ được phát đến người gọi trước khi thực hiên quay số đến nhóm này. <br><br> Để thêm các ghi âm bổ sung vui lòng sử dụng MENU "System Recordings" ở trên Tin nhắn sẽ được phát tới người đang nhận cuộc gọi, nếu tính năng 'Xác nhận cuộc gọi" ('Confirm Calls') được kích hoạt. <br><br> Để thêm các ghi âm bổ sung vui lòng sử dụng MENU "System Recordings" ở trên Tin nhắn sẽ được phát tới người đang nhận cuộc gọi nếu cuộc gọi này đã được chấp nhận trước khi nhấn phím 1.<br><br> Để thêm các ghi âm bổ sung vui lòng sử dụng MENU "System Recordings" ở trên Chế độ Không bao giờ Không Không có Chỉ có  ringall, ringallv2, hunt và các phiên bản prim tương ứng được hỗ trợ khi đánh dấu check vào confirmation Gía trị CID cố định của các cuộc gọi bên ngoài Ghi đè âm lượng chuông. Lưu ý: Điều này chỉ hợp lệ cho các điện thoại %s tại thời điểm hiện tại Phát nhạc chờ Vui lòng nhập một mô tả Nhóm hợp lệ Vui lòng nhập một danh sách máy nhánh. Cung cấp một tiêu đề mô tả cho Ring Group này. Đặt tên cho Ring Group này. Thông báo từ xa Cài đặt lại Đổ chuông Tính năng Ring Group (Nhóm đổ chuông) Ring Group (Nhóm đổ chuông): %s  Thành viên của Ring Group Mô đun Ring Group Tên của Ring Group Nhóm đổ chuông: %s Nhóm đổ chuông: %s (%s) Các nhóm đổ chuông Chiến lược đổ chuông Thời gian rung chuông Thời gian đổ chuông ( tối đa 300 giây) Nhạc chuông Đổ chuông tất cả các kênh đến khi một cuộc gọi được trả lời ( mặc định) Số của Ring-Group RingGroup ( Đổ chuông nhóm) Ghi đè âm lượng chuông Chọn một nhạc chuông trong danh sách tùy chọn ở trên. Nó sẽ quyết đinh âm thanh cho máy của bạn khi nó đổ chuông từ nhóm này. Tiến trình gửi Theo thứ tự Ringgroup này nên chỉ thị tiến trình cuộc gọi đến các kênh kỹ thuật số được hỗ trợ. Đồng thời Bỏ qua tổng đài viên đang bận Gửi đi Thay phiên nhau đổ chuông từng máy nhánh khả dụng Danh sách nhóm chỉ có thể bao gồm tối đa 255 ký tự. Số mà người dùng sẽ gọi đến các máy nhánh trong Ring Group này Các chế độ này hoạt động giống như được mô tả ở trên. Tuy nhiên, nếu máy nhánh chính ( máy đầu tiên trong danh sách) bị bận thì các máy nhánh khác sẽ đổ chuông. Nếu máy nhánh đầu tiên là  FreePBX DND thì nó sẽ không đổ chuông. Nếu máy nhánh chính là FreePBX CF vô điều kiện thì tất cả các máy sẽ đổ chuông Ringgroup này Thời gian điện thoại đổ chuông sẽ được tính bằng giây. Đối với tất cả các chiến lược đổ chuông kiểu hunt thì đây là thời gian cho mỗi lần điện thoại rung lặp lại Thời gian điện thoại đổ chuông sẽ được tính bằng giây. Đối với tất cả các chiến lược đổ chuông theo thứ tự thì đây là thời gian cho mỗi lần điện thoại rung lặp lại Thời gian sẽ trong khoảng 1 đến 300 giây Thông báo quá muộn Truyền giá trị CID cố định dưới đây vào các cuộc gọi đến từ bên ngoài. Máy nhánh nội bộ đến các cuộc gọi của máy nhánh sẽ tiếp tục hoạt động ở chế độ mặc định. Truyền số đã được quay giống như CID cho các cuộc gọi đến từ bên ngoài. Máy nhánh nội bộ đến các cuộc gọi nội bộ sẽ tiếp tục hoạt động ở chế độ mặc định. Thao tác này cần phải có một DID trên tuyến gọi vào. Nó sẽ được truyền vào các trung kế đã khóa các Caller ID nước ngoài Truyền số đã được quay giống như CID cho các cuộc gọi đến từ bên ngoài. Máy nhánh nội bộ đến các cuộc gọi nội bộ sẽ tiếp tục hoạt động ở chế độ mặc định. Thao tác này cần phải có một DID trên tuyến gọi vào. Nó sẽ được truyền vào các trung kế đã khóa các Caller ID nước ngoài Truyền CID của người gọi nếu trung kế cho phép. Sử dụng số đã được quay Cảnh báo! Máy nhánh Khi được kích hoạt, tổng đài viên người đang dùng điện thoại sẽ bị bỏ qua như thể đường dây của điện thoại đó đang bận. Nghĩa là các cuộc gọi sẽ không xuất hiện Call Waiting hay các điện thoại đa tuyến, và trong các chiến lược đổ chuông kiểu Hunt , cuộc gọi sẽ tiếp tục đổ chuông đến tổng đài viên tiếp theo. Khi cài đặt về Yes, tổng đài viên người đang cố để chuyển tiếp cuộc gọi sẽ bị bỏ qua, điều này áp dụng cho CF, CFU và CFB. Các số máy nhánh đã được nhập dấu # ở cuối, chẳng hạn để truy nhập vào tính năng Follow-Me của máy nhánh, thì có thể không cần cài đặt này. Khi cài đặt về True thì các máy nhánh thuộc về một hay nhiều Ring Group sẽ có một lựa chọn Ring Group và kết nối trở lại với mỗi nhóm mà chúng là thành viên trong đấy. Nơi để gửi người gọi nếu không có trả lời nào. Có Bạn luôn có thể ghi lại các cuộc gọi đến Ring Groupnày (Force), không ghi lại chúng (Never), hoặc cho phép máy nhánh phải thực hiện trả lời trên các ghi âm yêu cầu (Dont Care). Nếu ghi âm bị từ chối thì khi nhấn vào yêu cầu thì ghi âm sẽ bị khóa, trừ khi bạn cài đặt ghi âm cuộc gọi là  "Override". Bạn có thể thêm tiền tố vào tên của CallerID khi đổ chuông các máy nhánh trong nhóm náy. Ví dụ: Nếu bạn thêm tiền tố là "Sales:" cho một cuộc gọi từ John Doe thì trên máy nhánh đang đổ chuông sẽ hiện lên "Sales:John Doe". Mặc định Khả dụng ban đầu firstnotonphone (notonphone đầu tiên) hunt đang được sử dụng Tài khoản của bạn không được cho phép memoryhunt ( Bộ nhớ hunt) Không có ngẫu nhiên Đổ chuông tất cả 