<?php
require_once('helpers.php');
header('Content-Type: application/json; charset=utf-8');

if ( !isset( $_GET['id'] ) || !is_numeric( $_GET['id'] ) ):
  $error = new stdClass();
  $error->message = 'Action not found';
  echo json_encode( $error );
else:
  $actions = get_actions( $_GET['id'] );
  echo json_encode( $actions );
endif;

function get_actions( $id, $arr = array(), $con = null, $i = 0 ){
	if ( $con == null ) $con = get_connection();

	$query = "SELECT * FROM cq_action WHERE id = $id LIMIT 1";
	$result = mysql_query( $query );
	$row = mysql_fetch_assoc( $result );
	$action = ( object )$row;

	if( $action != false ):
		$arr[ $i ] = $action;
		if ( $action->id_next != "0000")
			if ( !is_indexed( $action->id_next, $arr ))
					$arr = get_actions( $action->id_next, $arr, $con, $i+1 );

		if ( $action->id_nextfail != "0000" )
			if ( !is_indexed( $action->id_nextfail, $arr ))
					$arr = get_actions( $action->id_nextfail, $arr, $con, $i+1 );
	endif;

	return $arr;
}

?>
