<?php 

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