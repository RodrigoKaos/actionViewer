 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 	<meta charset="utf-8">
 </head>
 <body>

<?php 
	require_once('functions.php');

	// $con = new PDO("mysql:host=localhost;dbname=my", "root", "");
	// $con->exec("set names utf8");
	
	// $action_arr = array();
	// $query = "SELECT * FROM cq_action WHERE id = ?";
	// $stmt = $con->prepare( $query );
	// if ( $stmt->execute( array($_GET['task']) ) ) {
	// 	while( $row = $stmt->fetch(PDO::FETCH_OBJ) ){
			
	// 		$action_arr['id'] 			= $row->id;
	// 		$action_arr['idNext'] 		= $row->id_next;
	// 		$action_arr['idNextFail'] 	= $row->id_nextfail;
	// 		$action_arr['type'] 		= $row->type;
	// 		$action_arr['data'] 		= $row->data;
	// 		$action_arr['param'] 		= chinese_encode( $row->param );
			
	// 	}
	// }
	
	
	$arr = get_action($_GET['task']);	
	// $actions[] = $action_arr;
	print_r($arr);
	

	
function get_action($t_id){
	$con = new PDO("mysql:host=localhost;dbname=my", "root", "");
	$con->exec("set names utf8");

	$actions = array();
	$action_arr = array();
	$action_arr2 = array();

	$query = "SELECT * FROM cq_action WHERE id = ?";
	$stmt = $con->prepare( $query );
	if ( $stmt->execute( array($t_id) ) ) {
		while( $row = $stmt->fetch(PDO::FETCH_OBJ) ){
			
			$action_arr['id'] 			= $row->id;
			$action_arr['idNext'] 		= $row->id_next;
			$action_arr['idNextFail'] 	= $row->id_nextfail;
			$action_arr['type'] 		= $row->type;
			$action_arr['data'] 		= $row->data;
			$action_arr['param'] 		= chinese_encode( $row->param );

			$actions[] = $action_arr;
			if( $action_arr['idNext'] != "0000" ){
				$action_arr2 = get_action($action_arr['idNext']);
				$actions[] = $action_arr2;
			}
			
		}
	}


	return $actions;	
}

?>


 
 </body>
 </html>