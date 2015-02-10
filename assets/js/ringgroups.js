//Max Length counter
//Maybe move this to framework
$(document).ready(function(){
	$(".maxlen").each(function(){
		var curid = $(this).attr('id');
		var maxl = $(this).attr('maxlength');
		var curl = $(this).val().length;
		$(this).wrap('<div class="input-group"></div>');
		$(this).after('<span class="input-group-addon" id="basic-addon-'+curid+'">'+curl+'/'+maxl+'</span>');
	});
});
$(".maxlen").keyup(function(){
		var curid = $(this).attr('id');
		var maxl = $(this).attr('maxlength');
		var curl = $(this).val().length;
		$('#basic-addon-'+curid).html(curl+'/'+maxl);
});
//end Max Length counter

//Agent Quick Select
$("[id^='qsagents']").change(function(){
	var taelm = $(this).data('for');
	console.log($('#'+taelm));
	$('#'+taelm).append($(this).val()+"\n");
});
//FixedCID
$("#changecid").change(function(){
	if($(this).val() == 'fixed'){
		$("#fixedcid").attr('disabled',false);
	}else{
		$("#fixedcid").attr('disabled',true);
	}
});

$(document).ready(function(){
	$("#changecid").change(function(){
				state = (this.value == "fixed" || this.value == "extern") ? "" : "disabled";
		if (state == "disabled") {
			$("#fixedcid").attr("disabled",state);
		} else {
			$("#fixedcid").removeAttr("disabled");
		}
	});
});

function insertExten() {
	exten = document.getElementById('insexten').value;

	grpList=document.getElementById('grplist');
	if (grpList.value[ grpList.value.length - 1 ] == "\n") {
		grpList.value = grpList.value + exten;
	} else {
		grpList.value = grpList.value + '\n' + exten;
	}

	// reset element
	document.getElementById('insexten').value = '';
}

function checkGRP(theForm) {
	var msgInvalidGrpNum = _('Invalid Group Number specified');
	var msgInvalidExtList = _('Please enter an extension list.');
	var msgInvalidTime = _('Invalid time specified');
	var msgInvalidGrpTimeRange = _('Time must be between 1 and 300 seconds');
	var msgInvalidDescription = _('Please enter a valid Group Description');
	var msgInvalidRingStrategy = _('Only ringall, ringallv2, hunt and the respective -prim versions are supported when confirmation is checked');

	// set up the Destination stuff
	setDestinations(theForm, 1);

	// form validation
	defaultEmptyOK = false;
	if (!isInteger(theForm.account.value)) {
		return warnInvalid(theForm.account, msgInvalidGrpNum);
	}

	defaultEmptyOK = false;

	if (!isAlphanumeric(theForm.description.value))
		return warnInvalid(theForm.description, msgInvalidDescription);

	if (isEmpty(theForm.grplist.value))
		return warnInvalid(theForm.grplist, msgInvalidExtList);

	if (!theForm.fixedcid.disabled) {
		fixedcid = $.trim(theForm.fixedcid.value);
		if(!fixedcid.match('^[+]{0,1}[0-9]+$')) {
			return warnInvalid(theForm.fixedcid, msgInvalidCID);
		}
	}

	defaultEmptyOK = false;
	if (!isInteger(theForm.grptime.value)) {
		return warnInvalid(theForm.grptime, msgInvalidTime);
	} else {
		var grptimeVal = theForm.grptime.value;
		if (grptimeVal < 1 || grptimeVal > 300)
			return warnInvalid(theForm.grptime, msgInvalidGrpTimeRange);
	}

	if (theForm.needsconf.checked && (theForm.strategy.value.substring(0,7) != "ringall" && theForm.strategy.value.substring(0,4) != "hunt")) {
		return warnInvalid(theForm.needsconf, msgInvalidRingStrategy);
	}

	if (!validateDestinations(theForm, 1, true))
		return false;

	return true;
}