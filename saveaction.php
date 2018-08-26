<?php 

require_once('functions.php');

//echo $_GET['id'];
$id 	= explode('a', $_GET['id'] );
$param 	= $_GET['param'];
$msg 	= '';

echo strlen( $param );
// $con = new PDO("mysql:host=localhost;dbname=my", "root", "");
// $con->exec("set names utf8");	
$con = get_connection();
// $qry = sprintf( "UPDATE cq_action SET param = '%s' WHERE id = %s", $param, $id[1] );
$qry = "UPDATE cq_action SET param = '$param' WHERE id = $id[1]";
echo "$qry";

$res = mysql_query( $qry );
//$count = $smtm->execute( array( $param, $id ) );
$msg = 'Action updated! ';

if( !$res )	$msg = mysql_error($con) . " : " . mysql_errno($con);

echo $msg . $param . " " .$id[1];

?>
