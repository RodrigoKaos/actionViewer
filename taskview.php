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

$arr = get_action( $_GET['task'] );

foreach ( $arr as $key => $value ) {
	echo '<div>' . html_action( $value ) . '</div>';
}
	
function get_action( $action_id, $action_arr = array(), $con = null, $i = 0 ){
	
	if( $con == null ){
		$con = new PDO("mysql:host=localhost;dbname=my", "root", "");
		$con->exec("set names utf8");		
	}

	$query = "SELECT * FROM cq_action WHERE id = ? LIMIT 1";
	$stmt = $con->prepare( $query );	

	if ( $stmt->execute( array($action_id) )) {
		$action = $stmt->fetch( PDO::FETCH_OBJ );
		
		if( $action != false ){
			$action_arr[ $i ] = $action;

			if( $action->id_next != "0000")
				if( ! is_indexed( $action->id_next, $action_arr ) )
						$action_arr = get_action( $action->id_next, $action_arr, $con, $i+1 );
			

			if( $action->id_nextfail != "0000" )
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