<?php  

function get_actions( $id, $arr = array(), $i = 0 ){
	$query = "SELECT * FROM cq_action WHERE id = $id LIMIT 1";
	$result = mysql_query( $query );
	$row = mysql_fetch_assoc( $result );
	$action = ( object )$row;

	if( $action != false ):
		$arr[ $i ] = $action;

		if ( $action->id_next != "0000")
			if ( !is_indexed( $action->id_next, $arr ))
					$arr = get_actions( $action->id_next, $arr, $i+1 );

		if ( $action->id_nextfail != "0000" )
			if ( !is_indexed( $action->id_nextfail, $arr ))
					$arr = get_actions( $action->id_nextfail, $arr, $i+1 );
	endif;

	return $arr;
}

function actions_method_get(){

	$con = get_connection();
	
	if ( !$con ):
		echo json_error( 'Failure to access database...', mysql_errno());

	else:
		if ( !isset( $_GET['id'] ) || !is_numeric( $_GET['id'] ) ):
			echo json_error( 'Action not found', 404 );

		else:
			$actions = get_actions( $_GET['id'] );
			echo json_encode( $actions );

		endif;		

	endif;
}
