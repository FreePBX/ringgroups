Þ    E      D  a   l      ð     ñ     ø  
          *        D     Q     a  !   p       =        Þ     æ  $   ÿ     $    7     W	     f	     v	     	     	     ¢	     8
     K
     j
     
     
     
  j   
     ü
  &        A  0   a       
        ¢     ²     È     Ú     é     ý     	  7   !     Y     k  +   {  @   §  ü   è     å     ô  &        ¨    D    T  2   `          ¥     ¸  Ç   L               +     ;     @     R  
   r     }                        7     J  -   Q               ·     Ä     ã  s  ü     p  !     6   ¢  -   Ù  g       o  	     9        Ã  	   Ù  ±   ã       9   ±  -   ë  	        #     3     :     Á  9   à  -     $   H  	   m     w          ¢  !   Á     ã     ú       !   )  \   K     ¨  3   Á  *   õ  W      K  x     Ä     Ý  1   `   ®      C  A!    "  H   $  3   g$     $  Ô   ª$  ß   %     _&     o&  !   &     §&     ¬&  <   Å&  
   '     '     '         	                                  E       9   ;          +   <          "       
   ?       3   ,   0              -   4   >       5      A   7       !   %                 .      1                 C                  :   (         =             B   &   *   2           6           @                $      /                       8      )   D   #   '    *-prim Add Ring Group Alert Info Always Always transmit the Fixed CID Value below. Applications CID Name Prefix Call Recording Change External CID Configuration Confirm Calls Creates a group of extensions that all ring together. Extensions can be rung all at once, or in various 'hunt' configurations. Additionally, external numbers are supported, and there is a call confirmation option where the callee has to confirm if they actually want to take the call before the caller is transferred. Default Destination if no answer Display Extension Ring Group Members Enable Call Pickup Enable this if you're calling external numbers that need confirmation - eg, a mobile phone may go to voicemail which will pick up the call. Enabling this requires the remote side push 1 on their phone before the call is put through. This feature only works with the ringall ring strategy Extension List Fixed CID Value Force Dialed Number Group Description INUSE If you select a Music on Hold class to play, instead of 'Ring', they will hear that instead of Ringing while they are waiting for someone to pick up. Ignore CF Settings Invalid Group Number specified Invalid time specified Mode Never None Only ringall, ringallv2, hunt and the respective -prim versions are supported when confirmation is checked Outside Calls Fixed CID Value Please enter a valid Group Description Please enter an extension list. Provide a descriptive title for this Ring Group. Ring Ring Group Ring Group %s:  Ring Group Membership Ring Group Module Ring Group: %s Ring Group: %s (%s) Ring Groups Ring Time (max 300 sec) Ring all available channels until one answers (default) Ring-Group Number Skip Busy Agent Take turns ringing each available extension The number users will dial to ring extensions in this ring group These modes act as described above. However, if the primary extension (first in list) is occupied, the other extensions will not be rung. If the primary is FreePBX DND, it won't be rung. If the primary is FreePBX CF unconditional, then all will be rung This ringgroup Time in seconds that the phones will ring. For all hunt style ring strategies, this is the time for each iteration of phone(s) that are rung Time must be between 1 and 300 seconds Transmit the Fixed CID Value below on calls that come in from outside only. Internal extension to extension calls will continue to operate in default mode. Transmit the number that was dialed as the CID for calls coming from outside. Internal extension to extension calls will continue to operate in default mode. There must be a DID on the inbound route for this. This WILL be transmitted on trunks that block foreign CallerID Transmit the number that was dialed as the CID for calls coming from outside. Internal extension to extension calls will continue to operate in default mode. There must be a DID on the inbound route for this. This will be BLOCKED on trunks that block foreign CallerID Transmits the Callers CID if allowed by the trunk. Use Dialed Number Warning! Extension When set to true extensions that belong to one or more Ring Groups will have a Ring Group section and link back to each group they are a member of. You can optionally prefix the CallerID name when ringing extensions in this group. ie: If you prefix with "Sales:", a call from John Doe would display as "Sales:John Doe" on the extensions that ring. default firstavailable firstnotonphone hunt is already in use is not allowed for your account memoryhunt none ringall Project-Id-Version: FreePBX 2.10.0.6
Report-Msgid-Bugs-To: 
PO-Revision-Date: 2014-04-17 15:59+0200
Last-Translator: Kevin <kevin@qloog.com>
Language-Team: Japanese <http://git.freepbx.org/projects/freepbx/ringgroups/ja/>
Language: ja_JP
MIME-Version: 1.0
Content-Type: text/plain; charset=UTF-8
Content-Transfer-Encoding: 8bit
Plural-Forms: nplurals=1; plural=0;
X-Generator: Weblate 1.9-dev
 *-prim çä¿¡ã°ã«ã¼ããè¿½å  ã¢ã©ã¼ãæå ± å¸¸ã« å¸¸ã«ä»¥ä¸ã®åºå®CIDãéä¿¡ãã¾ãã ã¢ããªã±ã¼ã·ã§ã³ CIDååããªãã£ãã¯ã¹ éè©±é²é³ å¤é¨CIDè¨­å®ãå¤æ´ãã ã³ã¼ã«ãç¢ºèªãã åæã«å¼ã³åºãããåç·ã®ã°ã«ã¼ããä½æãã¾ããåç·ã¯å¨ã¦åæã«å¼ã³åºãããæ§ããª'ãã³ã'æ§æã§å¼ã³åºããè¨­å®ã§ãã¾ããåç·ã«å ãã¦å¤é¨ã®çªå·ãä½¿ããä»ãã³ã¼ã«ãè»¢éããåã«ãå¼ã³åºãåã®äººãã³ã¼ã«ãåããããã©ãããç¢ºèªã§ãããªãã·ã§ã³ãä½¿ãã¾ãã ããã©ã«ã å¿ç­ããªãå ´åã®è»¢éå åç·çä¿¡ã°ã«ã¼ãã®ã¡ã³ãã¼ãè¡¨ç¤ºãã ã³ã¼ã«ããã¯ã¢ãããæå¹ã«ãã å¤ç·çªå·ã§ç¢ºèªåä½ãå¿è¦ãªå ´åï¼ä¾ãã°ããã¤ã¹ã¡ã¼ã«ãå¿ç­ããæºå¸¯é»è©±ããªã³ã°ã°ã«ã¼ãã«å«ã¾ãã¦ããï¼ã«ãæå¹ã«ãã¦ãã ãããæå¹ã«ããã¨ããªã¢ã¼ãå´ã§ 1 ãæ¼ãã¾ã§ãã³ã¼ã«ãè»¢éããã¾ããããã®æ©è½ã¯ãringall ã¹ãã©ãã¸ã¼ã§ã®ã¿ä½¿ç¨ã§ãã¾ãã åç·ãªã¹ã åºå®CID ãã¤ã¤ã«ããå¼ã³åºãå´ã®çªå·ãå¼·å¶ãã ã°ã«ã¼ãã®èª¬æ ä½¿ç¨ä¸­ ããªã³ã°ãã®ä»£ããã«ä¿çé³ã¯ã©ã¹ãé¸æããå ´åã¯ãå¼ã³åºãä¸­ã«éå¸¸ã®å¼ã³åºãé³ï¼ãªã³ã°ï¼ã§ã¯ãªããä¿çé³ãåçãã¾ãã è»¢éè¨­å®ãç¡è¦ãã ä¸æ­£ãªã°ã«ã¼ãçªå·ãå¥åããã¦ãã¾ãã ä¸æ­£ãªæéãå¥åããã¦ãã¾ãã ã¢ã¼ã é²é³ããªã ãªã ç¢ºèªããã§ãã¯ããå ´åã¯ãringall, ringallv2, hunt ã¨ãã® -prim ã¤ããã¼ã¸ã§ã³ã®ã¿ããµãã¼ããã¾ãã å¤é¨ã³ã¼ã«ç¨ã®åºå®CID æå¹ãªã°ã«ã¼ãèª¬æãå¥åãã¦ãã ããã åç·ãªã¹ããå¥åãã¦ãã ããã ãã®çä¿¡ã°ã«ã¼ãã®èª¬æã ãªã³ã° çä¿¡ã°ã«ã¼ã çä¿¡ã°ã«ã¼ã %s:  æå±ããçä¿¡ã°ã«ã¼ã çä¿¡ã°ã«ã¼ãã¢ã¸ã¥ã¼ã« çä¿¡ã°ã«ã¼ã: %s çä¿¡ã°ã«ã¼ã: %s (%s) çä¿¡ã°ã«ã¼ã å¼ã³åºãæé (æå¤§300ç§) èª°ããå¿ç­ããã¾ã§å¨ã¦ã®ç©ºãã¦ãããã£ãã«ãé³´ãã(ããã©ã«ã) çä¿¡ã°ã«ã¼ãçªå· ãã¸ã¼ç¶æã®ã¨ã¼ã¸ã§ã³ããã¹ã­ãã ç©ºãã¦ããåç·ãé çªã«é³´ãã ãã®ãªã³ã°ã°ã«ã¼ãã«æå±ããåç·ãé³´ããããã®ãã¤ã¤ã«çªå· ãã®ã¢ã¼ãã¯ä¸è¨ã¨åããããªæåããã¾ãããã¡ã¤ã³ã®åç·(ãªã¹ãä¸­ã®æåã®åç·)ãå æããã¦ããå ´åãä»ã®åç·ã¯é³´ãã¾ãããããã¡ã¤ã³ãFreePBX DND(do not disturb)ã®å ´åã¯é³´ãã¾ãããããã¡ã¤ã³ãFreePBX ç¡æ¡ä»¶è»¢éã®å ´åãå¨ã¦ãé³´ãã¾ã ãã®çä¿¡ã°ã«ã¼ã é»è©±ãé³´ãç§æ°ãå¨ã¦ã®huntåãªã³ã°ã«ã¼ã«ã®å ´åã¯ãããããã®é»è©±ãåå¾©ãã¦é³´ãæéã§ãã 1ï½300ç§ã®æéãå¥åãã¦ãã ããã å¤ç·ããçä¿¡ããã³ã¼ã«ã®CIDããä»¥ä¸ã®åºå®CIDã«ç½®ãæãã¾ããåé¨ã®åç·éã³ã¼ã«ã¯å¼ãç¶ãããã©ã«ãã¢ã¼ãã§åä½ãã¾ãã å¤é¨ã³ã¼ã«ã®å ´åã«ããã¤ã¢ã«ããå¼ã³åºãå´ã®çªå·ãCIDã¨ãã¦éä¿¡ãã¾ããåé¨ã®åç·éã³ã¼ã«ã¯ããã©ã«ãã¢ã¼ãã§åä½ãã¾ããçä¿¡ã«ã¼ãã«DIDãè¨­å®ããã¦ããå¿è¦ãããã¾ããå¤é¨ã®CallerIDããã­ãã¯ãããã©ã³ã¯ã«ãéä¿¡ãã¾ãã å¤ç·ããçä¿¡ããã³ã¼ã«ã®å ´åããã¤ã¤ã«ããå¼ã³åºãå´ã®çªå·ããã®ã¾ã¾CIDã¨ãã¦éä¿¡ãã¾ããåé¨ã®åç·éã³ã¼ã«ã¯ããã©ã«ãã¢ã¼ãã§åä½ãã¾ãããã®æ©è½ãä½¿ãã«ã¯ãçä¿¡ã«ã¼ãã«DIDãè¨­å®ããã¦ããå¿è¦ãããã¾ãããã®æ©è½ã¯ãå¤é¨ CallerIDããã­ãã¯ãããã©ã³ã¯ä¸ã§ã¯ãã­ãã¯ããã¾ãã çºä¿¡èã®CIDãéä¿¡ãã (ãã©ã³ã¯ãè¨±å¯ããå ´åã«)ã ãã¤ã¤ã«ããå¼ã³åºãå´ã®çªå·ãä½¿ç¨ è­¦å! åç· trueã«è¨­å®ããã¨ã1ã¤ä»¥ä¸ã®çä¿¡ã°ã«ã¼ãã«æå±ããåç·ã®è¨­å®ãã¼ã¸ã§ãçä¿¡ã°ã«ã¼ããã®é ç®ãè¿½å ãããæå±ããã°ã«ã¼ãã¸ã®ãªã³ã¯ãè¡¨ç¤ºããã¾ãã CallerIDåã«ãã¬ãã£ãã¯ã¹ãä»ãããã¾ããä¾:ãååããã¨è¨ããã¬ãã£ãã¯ã¹ãä»ããã¨ããAæ§ãããã®çä¿¡ã¯ãçä¿¡ç«¯æ«ã«ãååã: Aæ§ãã¨ãã¦è¡¨ç¤ºããã¾ãã ããã©ã«ã å©ç¨å¯è½ãªæå é»è©±ä¸­ã§ãªãæåã®ãã® hunt ã¯æ¢ã«ä½¿ç¨ä¸­ã§ã ã¯ããªãã®ã¢ã«ã¦ã³ãã«è¨±å¯ããã¦ãã¾ãã memoryhunt ãªã ringall 