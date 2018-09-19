<?php 

require_once('functions.php');
require_once('includes/html_functions.php');

$con = get_connection();
 
if( ! isset($_GET['map']) ) $_GET['map'] = 0;

$query_select = get_query( 'cq_npc',  $_GET['map'] );

$res = mysql_query( $query_select );
$table_trs = '';

while( $row = mysql_fetch_assoc( $res ) ){
	if( $row['task0'] == "0000" ) continue;

	if( $row['mapid'] == "0100" ) continue;

	$table_trs .= get_npc_trs( $row );
	
}


function get_npc_status( $action ){
	$query_check_action = 'SELECT id FROM cq_action WHERE id = ' . $action; 
	$res_act = mysql_query( $query_check_action );	
	$status = '';	

	if( mysql_num_rows( $res_act ) == 0 )
		$status = 'error incomplete';

	return $status;
}

function get_query( $table, $id = 0 ){
	if(	$id == null ) $id = 0;
	
	if( $id == 0 )
		return sprintf('SELECT * FROM %s WHERE mapid > %s ORDER BY ID', $table, $id);

	return sprintf('SELECT * FROM %s WHERE mapid = %s ORDER BY ID', $table, $id);
}

function get_npc_trs( $npc ){
	$url_map = "?map=" . $npc['mapid'];
	$ancor_map = html_ancor( $npc['mapid'], $url_map );
	
	$status_class = get_npc_status( $npc['task0'] );

	$url_action = ($status_class == '' )? "actionview.php?id=" . $npc['task0']: '#';
	$ancor_action = html_ancor( $npc['task0'], $url_action );		

	$table_tds 	= html_( 'td', $npc['id'] );
	$table_tds .= html_td( chinese_encode( $npc['name'] ));
	$table_tds .= html_td( $ancor_map );
	$table_tds .= html_td( $ancor_action, 'task' ); //change class selector??

	$trs = html_tr( $table_tds, $status_class );
	
	return $trs;
}

//------
?>

<div class="modal hide">
	<span class="close">X</span>
</div>

<?php echo html_ancor( "NPC", "/actionViewer"); ?>

<table>

	<tr>
		<th>Id</th><th>Name</th><th>Map Id</th><th>Action</th>
	</tr>

	<?php echo $table_trs; ?>
	
</table>

