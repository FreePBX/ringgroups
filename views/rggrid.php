<?php
namespace FreePBX\modules;
$gresults = ringgroups_list();
foreach($gresults as $g){
	$grows .= '<tr><td>'.$g[0].'</td><td>'.$g[1].'</td><td><a href="/admin/config.php?display=ringgroups&view=form&extdisplay=GRP-'.urlencode($g[0]).'"><i class="fa fa-edit"></i></a>&nbsp;<a href="config.php?display=ringgroups&action=delGRP&account='.urlencode($g[0]).'"><i class="fa fa-trash"></i></a></td></tr>';
}
?>

<table class="table table-striped">
<thead>
	<tr>
		<th><?php echo _("Ring Group")?></th>
		<th><?php echo _("Description")?></th>
		<th><?php echo _("Actions")?></th>
	</tr>	
</thead>
<tbody>
	<?php echo $grows ?>
</tbody>
</table>