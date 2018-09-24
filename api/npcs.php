<?php

require_once('helpers.php');

$con = get_connection();

if ( !isset( $_GET['map'] ) || !is_numeric( $_GET['map'] )) $_GET['map'] = 0;
$map = $_GET['map'];

$query = "SELECT id, name, mapid, task0 FROM cq_npc";
if ( $map != 0 ) $query .= " WHERE mapid = $map";

$result = mysql_query( $query );
while ( $row = mysql_fetch_assoc( $result ) ){
  $obj = ( object )$row;
  // if ( $obj->task0 == "0000" ) continue;
	// if ( $obj->mapid == "0100" ) continue;

  $obj->name = chinese_encode($obj->name);
  $obj->isComplete = action_exists( $obj->task0 );
	$npc_arr[] = $obj;
}//TODO: Show total incomplete npcs

header('Content-Type: application/json; charset=utf-8');
echo json_encode( $npc_arr );

?>
