<?php 

require_once('functions.php');

$con = get_connection();
$query_select = "SELECT * FROM cq_npc WHERE mapid ";

if( ! isset($_GET['map']) ){
	$query_select .= " > 0 ORDER BY ID";

}else { //TEST ternary logic
	$equal_to = " = " . $_GET['map'] . " ORDER BY ID";
	$query_select .= $equal_to;
}

$res = mysql_query( $query_select );
$table_lines = '';

while( $row = mysql_fetch_assoc( $res ) ){
	$table_lines = "<tr>" .
	"<td>" . $row->['id'] .
	"<td>" . chinese_encode( $row['name'] ) .
	"<td><a href=#$row['mapid']>" . $row['mapid'] . "</a>" .
	"<td class='task'><a href='actionview.php?id=$row['task0']'>" . $row['task0'];
}
	

?>

<div class="modal hide">
	<span class="close">X</span>
</div>

<table>
	<tr>
		<th>Id</th><th>Name</th><th>Map Id</th><th>Action</th>
	</tr>

	<?php
		echo $table_lines;
	?>
	
</table>

