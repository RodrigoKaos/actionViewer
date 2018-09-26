<?php

function chinese_encode( $str ){
	return mb_convert_encoding(  $str, "UTF-8", "gbk" );//gbk
}

function get_connection(){
	$host	= 'localhost';
	$user	= 'root';
	$pass	= 'test';
	$db		= 'my';

	$con = @mysql_connect( $host, $user, $pass );
	@mysql_select_db( $db );

	return $con;
}

function is_indexed( $id, $arr){
	foreach ($arr as $key => $value) {
		if( $value->id == $id )
			return true;
	}
	return false;
}

function json_error( $str, $status = 0 ){
	return json_encode( 
		array(
			'message' => $str, 
			'status'  => $status 
		));
}

