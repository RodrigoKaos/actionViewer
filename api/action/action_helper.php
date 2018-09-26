<?php  

function action_exists( $action ){
	$query = "SELECT id FROM cq_action WHERE id = $action";
	$result = mysql_query( $query );

	return !( mysql_num_rows( $result ) == 0 );
}

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

function get_actions_api(){
	require_once('action/GET_.php');
}