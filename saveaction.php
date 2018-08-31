<?php 

require_once('functions.php');

$id 	= explode('a', $_GET['id'] );
$param 	= $_GET['param'];
$msg 	= '';
$con 	= get_connection();
$qry 	= "UPDATE cq_action SET param = '$param' WHERE id = $id[1]";
$res 	= mysql_query( $qry );
$msg 	= 'Action updated! ';

if( !$res )	$msg = mysql_error($con) . " : " . mysql_errno($con);

echo $msg;

?>
