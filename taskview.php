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

	$con = new PDO("mysql:host=localhost;dbname=my", "root", "");
	$con->exec("set names utf8");
	
	$action_arr = array();
	$query = "SELECT * FROM cq_action WHERE id = ? LIMIT 1";
	$stmt = $con->prepare( $query );
	
	if ( $stmt->execute( array($_GET['task']) ) ) {
		
		$action = $stmt->fetch(PDO::FETCH_OBJ);
		// while( $row = $stmt->fetch(PDO::FETCH_OBJ) ){
			
		// 	$action_arr['id'] 			= $row->id;
		// 	$action_arr['idNext'] 		= $row->id_next;
		// 	$action_arr['idNextFail'] 	= $row->id_nextfail;
		// 	$action_arr['type'] 		= $row->type;
		// 	$action_arr['data'] 		= $row->data;
		// 	$action_arr['param'] 		= chinese_encode( $row->param );
			
		// }
	}	
	// $html = html_action($action_arr);
	$html = html_action2($action);
	echo '<div>' . $html . '</div>';	

// $arr = get_action($_GET['task']);	
// print_r($arr);

// $actions[] = $action_arr;
	
function get_action($action_id, $action_arr = array(), $i = 0){ //FIX 
	
	$con = new PDO("mysql:host=localhost;dbname=my", "root", "");
	$con->exec("set names utf8");

	$query = "SELECT * FROM cq_action WHERE id = ? LIMIT 1";
	$stmt = $con->prepare( $query );
	
	if ( $stmt->execute( array($action_id) )) {

		$action = $stmt->fetch( PDO::FETCH_OBJ );
		$action_arr[$i] = $action;

		if( $action->id_next != "0000")
			$action_arr[ $i+1 ] = get_action( $action->id_next, $action_arr, $i+1 );
	
	}

	return $action_arr;	
}

?>


 
 </body>
 </html>