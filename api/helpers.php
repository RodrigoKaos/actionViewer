<?php

function chinese_encode( $str ){
	return mb_convert_encoding(  $str, "UTF-8", "gbk" );//gbk
}

function get_connection(){
	$host	= 'localhost';
	$user	= 'root';
	$pass	= 'test';
	$db		= 'my';

	$con = mysql_connect( $host, $user, $pass );
	mysql_select_db( $db );

	return $con;
}

function action_exists( $action ){
	$query = "SELECT id FROM cq_action WHERE id = $action";
	$result = mysql_query( $query );

  return !( mysql_num_rows( $result ) == 0 );
}

function is_indexed( $id, $arr){
	foreach ($arr as $key => $value) {
		if( $value->id == $id )
			return true;
	}
	return false;
}

?>
