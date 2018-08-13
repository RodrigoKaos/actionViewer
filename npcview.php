<?php 

require_once('functions.php');

$con = new PDO("mysql:host=localhost;dbname=my", "root", "");
$con->exec("set names utf8");

$str = "SELECT * FROM cq_npc";
$str2 = $str  . " WHERE mapid = ?";
$str3 = $str  . " WHERE mapid > ?";
$query = $str2;


if( !isset($_GET['map']) ){
	$_GET['map'] = '0';
	$query = $str3;
}

?>
<div class="modal hide">
	<span class="close">X</span>
</div>

<table>
	<tr>
		<td>Id</td><td>Name</td><td>Map Id</td><td>Task</td>
	</tr>

<?php
$stmt = $con->prepare($query . 'ORDER BY ID'); 	
if ( $stmt->execute( array($_GET['map']) ) ) {
	while( $row = $stmt->fetch(PDO::FETCH_OBJ) ){
		echo "<tr>";
		echo "<td>" . $row->id;
		echo "<td>" . chinese_encode( $row->name );
		echo "<td>" . $row->mapid;
		echo "<td class='task'><a href='taskview.php?task=$row->task0'>" . $row->task0;
	}
}
?>

</table>

