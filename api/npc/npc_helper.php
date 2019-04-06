<?php

function npcs_method_get(){

	$con = get_connection();

	if ( !$con ):
		echo json_error( 'Failure to access database...', mysql_errno());

	else:
		if ( !isset( $_GET['map'] ) || !is_numeric( $_GET['map'] ))
			$_GET['map'] = 0;

		$npc_arr = get_npcs( $_GET['map'] );
		echo json_encode( $npc_arr );

	endif;
}

function get_npcs( $map ){
	$query = "SELECT id, name, mapid, task0 FROM cq_npc";
	if ( $map != 0 ) $query .= " WHERE mapid = $map";
	$query .= ' ORDER BY ID';
	$result = mysql_query( $query );
	while ( $row = mysql_fetch_assoc( $result ) ){
		$obj = ( object )$row;
	  // if ( $obj->task0 == "0000" ) continue;
		// if ( $obj->mapid == "0100" ) continue;

		$obj->name = chinese_encode( $obj->name );
		$obj->isComplete = action_exists( $obj->task0 );
		$npc_arr[] = $obj;
	}//TODO: Show total incomplete npcs
	return $npc_arr;
}

function action_exists( $action ){
	$query = "SELECT id FROM cq_action WHERE id = $action";
	$result = mysql_query( $query );

	return !( mysql_num_rows( $result ) == 0 );
}
