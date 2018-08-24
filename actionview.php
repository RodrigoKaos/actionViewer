
<?php 

require_once('functions.php');
require_once('includes/html_functions.php');

?>

<!DOCTYPE html>
<html>

<head>
	<title></title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body> 


<div class="task-list">

	<?php

	$arr = get_action( $_GET['id'] );

	foreach ( $arr as $key => $value ) {
		$div = html_action( $value );
		echo html_div( $div, 'a'. $value->id );
	}

	?>

</div>

 
 <script type="text/javascript" src='js/action.js'></script>
 </body>
 </html>

<?php 

function get_action( $action_id, $action_arr = array(), $con = null, $i = 0 ){
	
	if( $con == null ){
		$con = get_connection();
	}
	
	$qry = sprintf( "SELECT * FROM cq_action WHERE id = %s LIMIT 1", $action_id );
	$res = mysql_query( $qry );
	$row = mysql_fetch_assoc( $res );
	$action = ( object )$row;
	
	if( $action != false ){
		$action_arr[ $i ] = $action;

		if( $action->id_next != "0000")
			if( ! is_indexed( $action->id_next, $action_arr ) )
					$action_arr = get_action( $action->id_next, $action_arr, $con, $i+1 );
		

		if( $action->id_nextfail != "0000" )
			if( ! is_indexed( $action->id_nextfail, $action_arr ) )
					$action_arr = get_action( $action->id_nextfail, $action_arr, $con, $i+1 );
		
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