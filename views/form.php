<?php
extract($request);
if ($extdisplay) {
	// We need to populate grplist with the existing extension list.
	$account = ltrim($extdisplay,'GRP-');
	$thisgrp = ringgroups_get(ltrim($extdisplay,'GRP-'));
	$grpliststr = $thisgrp['grplist'];
	$grplist = explode("-", $grpliststr);
	$strategy = $thisgrp['strategy'];
	$grppre = $thisgrp['grppre'];
	$grptime = $thisgrp['grptime'];
	$goto = $thisgrp['postdest'];
	$annmsg_id = $thisgrp['annmsg_id'];
	$description = $thisgrp['description'];
	$alertinfo = $thisgrp['alertinfo'];
	$remotealert_id = $thisgrp['remotealert_id'];
	$needsconf = $thisgrp['needsconf'];
	$cwignore = $thisgrp['cwignore'];
	$cpickup = $thisgrp['cpickup'];
	$cfignore = $thisgrp['cfignore'];
	$toolate_id = $thisgrp['toolate_id'];
	$ringing = $thisgrp['ringing'];
	$changecid   = isset($thisgrp['changecid'])   ? $thisgrp['changecid']   : 'default';
	$fixedcid    = isset($thisgrp['fixedcid'])    ? $thisgrp['fixedcid']    : '';
	$recording = $thisgrp['recording'];
	unset($grpliststr);
	unset($thisgrp);
	//account input
	$accountinput = '<input type="text" class="form-control" name="account" id="account" value="'.ltrim($extdisplay,'GRP-').'" readonly>';
}else{
	//defaults
	$grplist = explode("-", '');;
	$strategy = '';
	$grppre = '';
	$grptime = '';
	$goto = '';
	$annmsg_id = '';
	$alertinfo = '';
	$remotealert_id = '';
	$needsconf = '';
	$cwignore = '';
	$cpickup = '';
	$cfignore = '';
	$toolate_id = '';
	$ringing = '';
	$recording = 'dontcare';
	$accountinput = '<input type="text" class="form-control" id="account" name="account" value="">';
}
//Ring Strategy Help
$rshelp = '<b>' . _("ringall")				.'</b>: '. _("Ring all available channels until one answers (default)")
		. '<br>'
		. '<b>'. _("hunt")				.'</b>: '. _("Take turns ringing each available extension")
		. '<br>'
		. '<b>'. _("memoryhunt") 		.'</b>: '. _("Ring first extension in the list, then ring the 1st and 2nd extension, then ring 1st 2nd and 3rd extension in the list.... etc.")
		. '<br>'
		. '<b>'. _("*-prim")  			.'</b>: '. _("These modes act as described above. However, if the primary extension (first in list) is occupied, the other extensions will not be rung. If the primary is FreePBX DND, it won't be rung. If the primary is FreePBX CF unconditional, then all will be rung")
		. '<br>'
		. '<b>'. _("firstavailable")  	.'</b>: '. _("ring only the first available channel")
		. '<br>'
		. '<b>'. _("firstnotonphone")	.'</b>: '. _("ring only the first channel which is not offhook - ignore CW")
		. '<br>'
		. '<b>'. _("random") 			.'</b>: '. _("Makes a call could hop between the included extensions without a predefined priority to ensure that calls in the groups are (almost) evenly spread. Simulates a Queue when a Queue can not otherwise be used.")
		. '<br>';
//End Ring Strategy Help

//Ring Strategy Rows
$default = (isset($strategy) ? $strategy : 'ringall');
$items = array('ringall','ringall-prim','hunt','hunt-prim','memoryhunt','memoryhunt-prim','firstavailable','firstnotonphone','random');
$rsrows = '';
foreach ($items as $item) {
	$rsrows .= '<option value="'.$item.'" '.($default == $item ? 'SELECTED' : '').'>'._($item) .'</option>';
}
//For Quick Select
$results = core_users_list();
$qsagentlist = '';
foreach($results as $result){
	$qsagentlist .= "<option value='".$result[0]."'>".$result[0]." (".$result[1].")</option>\n";
}
$glrows = count($grplist)+1;
$glrows = ($glrows < 4) ? 4 : (($glrows > 20) ? 20 : $glrows);

if(function_exists('recordings_list')) {
	$announcementhtml = '
		<!--Announcement-->
		<div class="element-container">
			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="form-group">
							<div class="col-md-3">
								<label class="control-label" for="annmsg_id">'._("Announcement").'</label>
								<i class="fa fa-question-circle fpbx-help-icon" data-for="annmsg_id"></i>
							</div>
							<div class="col-md-9">
								<select name="annmsg_id" id="annmsg_id" class="form-control">';
								$tresults = recordings_list();
								$default = (isset($annmsg_id) ? $annmsg_id : '');
								$announcementhtml .= '<option value="">'._("None")."</option>";
								if (isset($tresults[0])) {
									foreach ($tresults as $tresult) {
										$announcementhtml .= '<option value="'.$tresult['id'].'"'.($tresult['id'] == $default ? ' SELECTED' : '').'>'.$tresult['displayname']."</option>\n";
									}
								}
	$announcementhtml .='	</select>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<span id="annmsg_id-help" class="help-block fpbx-help-block">'. _("Message to be played to the caller before dialing this group.<br><br>To add additional recordings please use the \"System Recordings\" MENU above").'</span>
				</div>
			</div>
		</div>
		<!--END Announcement-->
	';
	$remoteahtml = '
		<!--Remote Announce-->
		<div class="element-container">
			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="form-group">
							<div class="col-md-3">
								<label class="control-label" for="remotealert_id">'._("Remote Announce").'</label>
								<i class="fa fa-question-circle fpbx-help-icon" data-for="remotealert_id"></i>
							</div>
							<div class="col-md-9">
								<select name="remotealert_id" id="remotealert_id" class="form-control">';
								$tresults = recordings_list();
								$default = (isset($remotealert_id) ? $remotealert_id : '');
								$remoteahtml .= '<option value="">'._("Default")."</option>";
								if (isset($tresults[0])) {
									foreach ($tresults as $tresult) {
										$remoteahtml .= '<option value="'.$tresult['id'].'"'.($tresult['id'] == $default ? ' SELECTED' : '').'>'.$tresult['displayname']."</option>\n";
									}
								}
	$remoteahtml .='			</select>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<span id="remotealert_id-help" class="help-block fpbx-help-block">'. _("Message to be played to the person RECEIVING the call, if 'Confirm Calls' is enabled.<br><br>To add additional recordings use the \"System Recordings\" MENU above").'</span>
				</div>
			</div>
		</div>
		<!--END Remote Announce-->
	';
	$toolatehtml = '
		<!--Too-Late Announce-->
		<div class="element-container">
			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="form-group">
							<div class="col-md-3">
								<label class="control-label" for="toolate_id">'._("Too-Late Announce").'</label>
								<i class="fa fa-question-circle fpbx-help-icon" data-for="toolate_id"></i>
							</div>
							<div class="col-md-9">
								<select name="toolate_id" id="toolate_id" class="form-control">';
								$tresults = recordings_list();
								$default = (isset($toolate_id) ? $toolate_id : '');
								$toolatehtml .= '<option value="">'._("Default")."</option>";
								if (isset($tresults[0])) {
									foreach ($tresults as $tresult) {
										$toolatehtml .= '<option value="'.$tresult['id'].'"'.($tresult['id'] == $default ? ' SELECTED' : '').'>'.$tresult['displayname']."</option>\n";
									}
								}
	$toolatehtml .='			</select>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<span id="toolate_id-help" class="help-block fpbx-help-block">'. _("Message to be played to the person RECEIVING the call, if the call has already been accepted before they push 1.<br><br>To add additional recordings use the \"System Recordings\" MENU above").'</span>
				</div>
			</div>
		</div>
		<!--END Too-late Announce-->
	';
}else{
	$default = (isset($annmsg_id) ? $annmsg_id : '');
	$announcementhtml = '<input type="hidden" name="annmsg_id" value="'.$default.'">';
}
if(function_exists('music_list')) {
	$ringhtml='
	<!--Play Music On Hold-->
	<div class="element-container">
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="form-group">
						<div class="col-md-3">
							<label class="control-label" for="ringing">'._("Play Music On Hold").'</label>
							<i class="fa fa-question-circle fpbx-help-icon" data-for="ringing"></i>
						</div>
						<div class="col-md-9">
							<select name="ringing" id="ringing" class="form-control">';
							$cur = (isset($ringing) ? $ringing : 'Ring');
							$tresults = \music_list();
							$ringhtml .= '<option value="Ring">'._("Ring").'</option>';
							$ringhtml .= '<option value="inherit">'._("Inherit").'</option>';
							if (isset($tresults[0])) {
							foreach ($tresults as $tresult) {
							    ( $tresult == 'none' ? $ttext = _("none") : $ttext = $tresult );
							    ( $tresult == 'default' ? $ttext = _("default") : $ttext = $tresult );
								$ringhtml .= '<option value="'.$tresult.'"'.($tresult == $cur ? ' SELECTED' : '').'>'._($ttext)."</option>\n";
							}
						}

	$ringhtml .= '			</select>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<span id="ringing-help" class="help-block fpbx-help-block">'._("If you select a Music on Hold class to play, instead of 'Ring', they will hear that instead of Ringing while they are waiting for someone to pick up.").'</span>
			</div>
		</div>
	</div>
	<!--END Music on Hold Class-->
	';
}
$ccidhelp = _("Mode").':'
			.'<br>'
			.'<b>'. _("Default") 						.'</b>: '. _("Transmits the Callers CID if allowed by the trunk.")
			.'<br>'
			.'<b>'. _("Fixed CID Value") 				.'</b>: '. _("Always transmit the Fixed CID Value below.")
			.'<br>'
			.'<b>'. _("Outside Calls Fixed CID Value") 	.'</b>: '. _("Transmit the Fixed CID Value below on calls that come in from outside only. Internal extension to extension calls will continue to operate in default mode.")
			.'<br>'
			.'<b>'. _("Use Dialed Number")				.'</b>: '. _("Transmit the number that was dialed as the CID for calls coming from outside. Internal extension to extension calls will continue to operate in default mode. There must be a DID on the inbound route for this. This will be BLOCKED on trunks that block foreign CallerID")
			.'<br>'
			.'<b>'. _("Force Dialed Number")			.'</b>: '. _("Transmit the number that was dialed as the CID for calls coming from outside. Internal extension to extension calls will continue to operate in default mode. There must be a DID on the inbound route for this. This WILL be transmitted on trunks that block foreign CallerID")
			.'<br>';

$default = (isset($changecid) ? $changecid : 'default');
$ccidrows = '<option value="default" '.($default == 'default' ? 'SELECTED' : '').'>'._("Default").'</option>';
$ccidrows .= '<option value="fixed" '.($default == 'fixed' ? 'SELECTED' : '').'>'._("Fixed CID Value").'</option>';
$ccidrows .= '<option value="extern" '.($default == 'extern' ? 'SELECTED' : '').'>'._("Outside Calls Fixed CID Value").'</option>';
$ccidrows .= '<option value="did" '.($default == 'did' ? 'SELECTED' : '').'>'._("Use Dialed Number").'</option>';
$ccidrows .= '<option value="forcedid" '.($default == 'forcedid' ? 'SELECTED' : '').'>'._("Force Dialed Number").'</option>';
$fixedcid_disabled = ($default != 'fixed' && $default != 'extern') ? 'disabled = "disabled"':'';
?>
<form class="popover-form fpbx-submit" name="editGRP" action="" method="post" onsubmit="return checkGRP(editGRP);" data-fpbx-delete="config.php?display=ringgroups&action=delGRP&account=<?php echo $account ?>">
<input type="hidden" name="display" value="ringgroups">
<input type="hidden" name="view" value="form">
<input type="hidden" name="action" value="<?php echo ($extdisplay ? 'edtGRP' : 'addGRP'); ?>">
<!--Ring-Group Number-->
<div class="element-container">
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="form-group">
					<div class="col-md-3">
						<label class="control-label" for="account"><?php echo _("Ring-Group Number") ?></label>
						<i class="fa fa-question-circle fpbx-help-icon" data-for="account"></i>
					</div>
					<div class="col-md-9">
						<?php echo $accountinput ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<span id="account-help" class="help-block fpbx-help-block"><?php echo _("The number users will dial to ring extensions in this ring group")?></span>
		</div>
	</div>
</div>
<!--END Ring-Group Number-->
<!--Group Description-->
<div class="element-container">
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="form-group">
					<div class="col-md-3">
						<label class="control-label" for="description"><?php echo _("Group Description") ?></label>
						<i class="fa fa-question-circle fpbx-help-icon" data-for="description"></i>
					</div>
					<div class="col-md-9">
						<input type="text" maxlength="35" class="form-control maxlen" id="description" name="description" value="<?php echo htmlspecialchars($description); ?>">
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<span id="description-help" class="help-block fpbx-help-block"><?php echo _("Provide a descriptive title for this Ring Group.")?></span>
		</div>
	</div>
</div>
<!--END Group Description-->
<!--Ring Strategy-->
<div class="element-container">
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="form-group">
					<div class="col-md-3">
						<label class="control-label" for="strategy"><?php echo _("Ring Strategy") ?></label>
						<i class="fa fa-question-circle fpbx-help-icon" data-for="strategy"></i>
					</div>
					<div class="col-md-9">
						<select name="strategy" id="strategy" class="form-control">
							<?php echo $rsrows?>
						</select>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<span id="strategy-help" class="help-block fpbx-help-block"><?php echo $rshelp?></span>
		</div>
	</div>
</div>
<!--END Ring Strategy-->
<!--Ring Time (max 300 sec)-->
<div class="element-container">
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="form-group">
					<div class="col-md-3">
						<label class="control-label" for="grptime"><?php echo _("Ring Time (max 300 sec)") ?></label>
						<i class="fa fa-question-circle fpbx-help-icon" data-for="grptime"></i>
					</div>
					<div class="col-md-9">
						<input type="number" min="0" max="300" class="form-control" id="grptime" name="grptime" value="<?php  echo $grptime?$grptime:20 ?>">
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<span id="grptime-help" class="help-block fpbx-help-block"><?php echo _("ime in seconds that the phones will ring. For all hunt style ring strategies, this is the time for each iteration of phone(s) that are rung")?></span>
		</div>
	</div>
</div>
<!--END Ring Time (max 300 sec)-->
<!--Extension List-->
<div class="element-container">
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="form-group">
					<div class="col-md-3">
						<label class="control-label" for="grplist"><?php echo _("Extension List") ?></label>
						<i class="fa fa-question-circle fpbx-help-icon" data-for="grplist"></i>
					</div>
					<div class="col-md-9">
						<div class="input-group">
							<textarea id="grplist" class="form-control" cols="15" rows="<?php echo $glrows?>" name="grplist"><?php echo implode("\n",$grplist);?></textarea>
							<span class="input-group-addon">
								<select id="qsagents1" class="form-control" data-for="grplist" style="width:170px;">
									<option SELECTED><?php echo("Agent Quick Select")?></option>
									<?php echo $qsagentlist ?>
								</select>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<span id="grplist-help" class="help-block fpbx-help-block"><?php echo _("List extensions to ring, one per line, or use the Extension Quick Pick below to insert them here.<br><br>You can include an extension on a remote system, or an external number by suffixing a number with a '#'.  ex:  2448089# would dial 2448089 on the appropriate trunk (see Outbound Routing)<br><br>Extensions without a '#' will not ring a user's Follow-Me. To dial Follow-Me, Queues and other numbers that are not extensions, put a '#' at the end.")?></span>
		</div>
	</div>
</div>
<!--END Static Agents-->
<?php echo $announcementhtml?>
<?php echo $ringhtml ?>
<!--CID Name Prefix-->
<div class="element-container">
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="form-group">
					<div class="col-md-3">
						<label class="control-label" for="grppre"><?php echo _("CID Name Prefix") ?></label>
						<i class="fa fa-question-circle fpbx-help-icon" data-for="grppre"></i>
					</div>
					<div class="col-md-9">
						<input type="text" class="form-control" id="grppre" name="grppre" value="<?php  echo $grppre ?>">
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<span id="grppre-help" class="help-block fpbx-help-block"><?php echo _('You can optionally prefix the CallerID name when ringing extensions in this group. ie: If you prefix with "Sales:", a call from John Doe would display as "Sales:John Doe" on the extensions that ring.')?></span>
		</div>
	</div>
</div>
<!--END CID Name Prefix-->
<!--Alert Info-->
<div class="element-container">
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="form-group">
					<div class="col-md-3">
						<label class="control-label" for="alertinfo"><?php echo _("Alert Info") ?></label>
						<i class="fa fa-question-circle fpbx-help-icon" data-for="alertinfo"></i>
					</div>
					<div class="col-md-9">
						<?php echo FreePBX::View()->alertInfoDrawSelect("alertinfo",(($alertinfo)?$alertinfo:''));?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<span id="alertinfo-help" class="help-block fpbx-help-block"><?php echo _("ALERT_INFO can be used for distinctive ring with SIP devices.")?></span>
		</div>
	</div>
</div>
<!--END Alert Info-->
<!--Ignore CF Settings-->
<div class="element-container">
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="form-group">
					<div class="col-md-3">
						<label class="control-label" for="cfignorew"><?php echo _("Ignore CF Settings") ?></label>
						<i class="fa fa-question-circle fpbx-help-icon" data-for="cfignorew"></i>
					</div>
					<div class="col-md-9 radioset">
						<input type="radio" name="cfignore" id="cfignoreyes" value="CHECKED" <?php echo ($cfignore == "CHECKED"?"CHECKED":"") ?>>
						<label for="cfignoreyes"><?php echo _("Yes");?></label>
						<input type="radio" name="cfignore" id="cfignoreno" value = "" <?php echo ($cfignore == "CHECKED"?"":"CHECKED") ?>>
						<label for="cfignoreno"><?php echo _("No");?></label>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<span id="cfignorew-help" class="help-block fpbx-help-block"><?php echo _("When set to Yes, agents who attempt to Call Forward will be ignored, this applies to CF, CFU and CFB. Extensions entered with '#' at the end, for example to access the extension's Follow-Me, might not honor this setting .")?></span>
		</div>
	</div>
</div>
<!--END Ignore CF Settings-->
<!--Skip Busy Agent-->
<div class="element-container">
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="form-group">
					<div class="col-md-3">
						<label class="control-label" for="cwignorew"><?php echo _("Skip Busy Agent") ?></label>
						<i class="fa fa-question-circle fpbx-help-icon" data-for="cwignorew"></i>
					</div>
					<div class="col-md-9 radioset">
						<input type="radio" name="cwignore" id="cwignoreyes" value="CHECKED" <?php echo ($cwignore == "CHECKED"?"CHECKED":"") ?>>
						<label for="cwignoreyes"><?php echo _("Yes");?></label>
						<input type="radio" name="cwignore" id="cwignoreno" value="" <?php echo ($cwignore == "CHECKED"?"":"CHECKED") ?>>
						<label for="cwignoreno"><?php echo _("No");?></label>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<span id="cwignorew-help" class="help-block fpbx-help-block"><?php echo _("When enabled, agents who are on an occupied phone will be skipped as if the line were returning busy. This means that Call Waiting or multi-line phones will not be presented with the call and in the various hunt style ring strategies, the next agent will be attempted.")?></span>
		</div>
	</div>
</div>
<!--END Skip Busy Agent-->
<!--Enable Call Pickup-->
<div class="element-container">
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="form-group">
					<div class="col-md-3">
						<label class="control-label" for="cpickupw"><?php echo _("Enable Call Pickup") ?></label>
						<i class="fa fa-question-circle fpbx-help-icon" data-for="cpickupw"></i>
					</div>
					<div class="col-md-9 radioset">
						<input type="radio" name="cpickup" id="cpickupyes" value="CHECKED" <?php echo ($cpickup == "CHECKED"?"CHECKED":"") ?>>
						<label for="cpickupyes"><?php echo _("Yes");?></label>
						<input type="radio" name="cpickup" id="cpickupno" value="" <?php echo ($cpickup == "CHECKED"?"":"CHECKED") ?>>
						<label for="cpickupno"><?php echo _("No");?></label>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<span id="cpickupw-help" class="help-block fpbx-help-block"><?php echo _("When enabled, this will allow calls to the Ring Group to be picked up with the directed call pickup feature using the group number. When not checked, individual extensions that are part of the group can still be picked up by doing a directed call pickup to the ringing extension, which works whether or not this is checked.")?></span>
		</div>
	</div>
</div>
<!--END Enable Call Pickup-->
<!--Confirm Calls-->
<div class="element-container">
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="form-group">
					<div class="col-md-3">
						<label class="control-label" for="needsconfw"><?php echo _("Confirm Calls") ?></label>
						<i class="fa fa-question-circle fpbx-help-icon" data-for="needsconfw"></i>
					</div>
					<div class="col-md-9 radioset">
						<input type="radio" name="needsconf" id="needsconfyes" value="CHECKED" <?php echo ($needsconf == "CHECKED"?"CHECKED":"") ?>>
						<label for="needsconfyes"><?php echo _("Yes");?></label>
						<input type="radio" name="needsconf" id="needsconfno" value="" <?php echo ($needsconf == "CHECKED"?"":"CHECKED") ?>>
						<label for="needsconfno"><?php echo _("No");?></label>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<span id="needsconfw-help" class="help-block fpbx-help-block"><?php echo _('Enable this if you\'re calling external numbers that need confirmation - eg, a mobile phone may go to voicemail which will pick up the call. Enabling this requires the remote side push 1 on their phone before the call is put through. This feature only works with the ringall ring strategy')?></span>
		</div>
	</div>
</div>
<!--END Confirm Calls-->
<?php echo $remoteahtml ?>
<?php echo $toolatehtml ?>
<!--Change External CID Configuration-->
<div class="element-container">
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="form-group">
					<div class="col-md-3">
						<label class="control-label" for="changecid"><?php echo _("Change External CID Configuration") ?></label>
						<i class="fa fa-question-circle fpbx-help-icon" data-for="changecid"></i>
					</div>
					<div class="col-md-9">
						<select name="changecid" id="changecid" class="form-control">
							<?php echo $ccidrows ?>
						</select>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<span id="changecid-help" class="help-block fpbx-help-block"><?php echo $ccidhelp?></span>
		</div>
	</div>
</div>
<!--END Change External CID Configuration-->
<!--Fixed CID Value-->
<div class="element-container">
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="form-group">
					<div class="col-md-3">
						<label class="control-label" for="fixedcid"><?php echo _("Fixed CID Value") ?></label>
						<i class="fa fa-question-circle fpbx-help-icon" data-for="fixedcid"></i>
					</div>
					<div class="col-md-9">
						<input type="text" class="form-control" id="fixedcid" name="fixedcid" value="<?php echo $fixedcid ?>" <?php echo $fixedcid_disabled ?>>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<span id="fixedcid-help" class="help-block fpbx-help-block"><?php echo _("Fixed value to replace the CID with used with some of the modes above. Should be in a format of digits only with an option of E164 format using a leading '+'.")?></span>
		</div>
	</div>
</div>
<!--END Fixed CID Value-->
<!--Call Recording-->
<div class="element-container">
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="form-group">
					<div class="col-md-3">
						<label class="control-label" for="recordingw"><?php echo _("Call Recording") ?></label>
						<i class="fa fa-question-circle fpbx-help-icon" data-for="recordingw"></i>
					</div>
					<div class="col-md-9 radioset">
						<input type="radio" id="record_force" name="recording" value="force" <?php echo ($recording=='force'?'checked':'');?>>
						<label for="record_force"><?php echo _('Force'); ?></label>
						<input type="radio" id="record_dontcare" name="recording" value="dontcare" <?php echo ($recording=='dontcare'?'checked':'');?>>
						<label for="record_dontcare"><?php echo _("Dont Care")?></label>
						<input type="radio" id="record_never" name="recording" value="never" <?php echo ($recording=='never'?'checked':'');?>>
						<label for="record_never"><?php echo _('Never'); ?></label>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<span id="recordingw-help" class="help-block fpbx-help-block"><?php echo _('You can always record calls that come into this ring group (Force), never record them (Never), or allow the extension that answers to do on-demand recording (Dont Care). If recording is denied then one-touch on demand recording will be blocked, unless they have the "Override" call recording setting.')?></span>
		</div>
	</div>
</div>
<!--END Call Recording-->
<?php
// implementation of module hook
$module_hook = \moduleHook::create();
echo $module_hook->hookHtml;
?>
<!--Destination if no answer-->
<div class="element-container">
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="form-group">
					<div class="col-md-3">
						<label class="control-label" for="goto0"><?php echo _("Destination if no answer") ?></label>
						<i class="fa fa-question-circle fpbx-help-icon" data-for="goto0"></i>
					</div>
					<div class="col-md-9">
						<?php echo drawselects($goto,0);?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<span id="goto0-help" class="help-block fpbx-help-block"><?php echo _("Where to send callers if there is no answer.")?></span>
		</div>
	</div>
</div>
<!--END Destination if no answer-->
</form>
