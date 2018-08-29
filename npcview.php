<?php 

require_once('functions.php');
require_once('includes/html_functions.php');

$con = get_connection();
$query_select = "SELECT * FROM cq_npc WHERE mapid ";

if( ! isset($_GET['map']) ){
	$query_select .= " > 0 ORDER BY ID";

}else {
	$equal_to = " = " . $_GET['map'] . " ORDER BY ID";
	$query_select .= $equal_to;
}

$res = mysql_query( $query_select );
$table_trs = '';

while( $row = mysql_fetch_assoc( $res ) ){
	
	$url_map = "?map=" . $row['mapid'];
	$ancor_map = html_ancor( $row['mapid'], $url_map );

	$url_action = "actionview.php?id=" . $row['task0'];
	$ancor_action = html_ancor( $row['task0'], $url_action );

	$table_tds 	= html_( 'td', $row['id'] );
	$table_tds .= html_td( chinese_encode( $row['name'] ));
	$table_tds .= html_td( $ancor_map );
	$table_tds .= html_td( $ancor_action, 'task' ); //change class selector??

	$table_trs .= html_tr( $table_tds );
}

echo html_ancor( "NPC", "http://localhost/actionViewer");

?>

<div class="modal hide">
	<span class="close">X</span>
</div>

<table>

	<tr>
		<th>Id</th><th>Name</th><th>Map Id</th><th>Action</th>
	</tr>

	<?php echo $table_trs; ?>
	
</table>

