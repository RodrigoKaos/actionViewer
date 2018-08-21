<?php 

$id 	= explode('a', $_GET['id'])[1];
$param 	= $_GET['param'];
$msg 	= '';

try{

	$con = new PDO("mysql:host=localhost;dbname=my", "root", "");
	$con->exec("set names utf8");	

	$query = 'UPDATE cq_action SET param = ? WHERE id = ?';

	$smtm = $con->prepare($query);
	$count = $smtm->execute( array( $param, $id ) );

	$msg = 'Action updated!';

}catch( PDOException $e ){
	$msg = $e;	
}

echo $msg;

?>
