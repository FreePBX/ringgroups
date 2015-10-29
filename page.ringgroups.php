<?php /* $Id$ */
if (!defined('FREEPBX_IS_AUTH')) { die('No direct script access allowed'); }
$rg = \FreePBX::create()->Ringgroups;

$request = $_REQUEST;
$tabindex = 0;
$dispnum = 'ringgroups'; //used for switch on config.php

$heading = _("Ring Groups");

switch($request['view']){
	case "form":
		if($request['extdisplay'] != ''){
			$heading .= ": Edit ".ltrim($request['extdisplay'],'GRP-');
		}else{
			$heading .= ": Add";
		}
		$content = load_view(__DIR__.'/views/form.php', array('request' => $request));
	break;
	default:
		$content = load_view(__DIR__.'/views/rggrid.php');
	break;
}

?>

<div class="container-fluid">
	<h1><?php echo $heading ?></h1>
	<div class = "display full-border">
		<div class="row">
			<div class="col-sm-12">
				<div class="fpbx-container">
					<div class="display full-border">
						<?php echo $content ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
