<?php
$gresults = ringgroups_list();
foreach($gresults as $g){
	$grows .= '<tr><td>'.$g[0].'</td><td>'.$g[1].'</td><td><a href="/admin/config.php?display=ringgroups&view=form&extdisplay=GRP-'.urlencode($g[0]).'"><i class="fa fa-edit"></i></a>&nbsp;<a class="delAction" href="config.php?display=ringgroups&action=delGRP&account='.urlencode($g[0]).'"><i class="fa fa-trash"></i></a></td></tr>';
}
?>

<table id= "ringgroupgrid"
        data-cookie="true"
        data-cookie-id-table="ringgroupgrid"
        data-maintain-selected="true"
        data-toggle="table"
        data-pagination="true"
        data-search="true"
        class="table table-striped">
<thead>
	<tr>
		<th data-sortable="true"><?php echo _("Ring Group")?></th>
		<th><?php echo _("Description")?></th>
		<th><?php echo _("Actions")?></th>
	</tr>
</thead>
<tbody>
	<?php echo $grows ?>
</tbody>
</table>
