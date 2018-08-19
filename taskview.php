 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 	<meta charset="utf-8">
 	<link rel="stylesheet" type="text/css" href="css/style.css">
 </head>
 <body>

<?php 
	require_once('functions.php');

	// $con = new PDO("mysql:host=localhost;dbname=my", "root", "");
	// $con->exec("set names utf8");
	
	// $action_arr = array();
	// $query = "SELECT * FROM cq_action WHERE id = ? LIMIT 1";
	// $stmt = $con->prepare( $query );
	
	// if ( $stmt->execute( array($_GET['task']) )) {		
	// 	$action = $stmt->fetch(PDO::FETCH_OBJ);
	// }

	// $html = html_action2($action);
	// echo '<div>' . $html . '</div>';	

$arr = get_action($_GET['task']);	
print_r($arr);

// $actions[] = $action_arr;
	
function get_action( $action_id, $action_arr = array(), $con = null, $i = 0 ){
	
	if( $con == null ){
		$con = new PDO("mysql:host=localhost;dbname=my", "root", "");
		$con->exec("set names utf8");		
	}

	$query = "SELECT * FROM cq_action WHERE id = ? LIMIT 1";
	$stmt = $con->prepare( $query );
	

	if ( $stmt->execute( array($action_id) )) {
		$action = $stmt->fetch( PDO::FETCH_OBJ );
		$action_arr[ $i ] = $action;		
			
		if( $action->id_next != "0000"){
			if( ! is_indexed( $action->id_next, $action_arr ) )
					$action_arr = get_action( $action->id_next, $action_arr, $con, $i+1 );
		}

		if( $action->id_nextfail != "0000" ){
			if( ! is_indexed( $action->id_nextfail, $action_arr ) )
					$action_arr = get_action( $action->id_nextfail, $action_arr, $con, $i+1 );
		}

			
	}

	return $action_arr;	
}

function is_indexed( $id, $arr){
	
	foreach ($arr as $key => $value) {
		if( $value->id == $id )
			return true;
	}
	
	return false;
}

?>


 
 </body>
 </html>