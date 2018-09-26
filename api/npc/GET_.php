<?php

$con = get_connection();

if ( !$con ):
	echo json_error( 'Failure to access database...', mysql_errno());

else:
	if ( !isset( $_GET['map'] ) || !is_numeric( $_GET['map'] ))
		$_GET['map'] = 0;
	
	$npc_arr = get_npcs( $_GET['map'] );
	echo json_encode( $npc_arr );	

endif;
