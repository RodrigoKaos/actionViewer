<?php

function get_npcs_api(){
	require_once('npc/GET_.php');
}

function get_npcs( $map ){
	$query = "SELECT id, name, mapid, task0 FROM cq_npc";
	if ( $map != 0 ) $query .= " WHERE mapid = $map";

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
