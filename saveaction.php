<?php 

require_once('functions.php');

$id 	= explode('a', $_POST['id'] );
$param 	= $_POST['param'];
$msg 	= '';
$con 	= get_connection();

$query_update = "UPDATE cq_action SET param = '$param' WHERE id = $id[1]";
$res = mysql_query( $query_update );
$msg = 'Action updated!';

if( !$res )	$msg = mysql_error($con) . " : " . mysql_errno($con);

echo $msg;

?>
