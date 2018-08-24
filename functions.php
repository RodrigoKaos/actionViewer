<?php 

function chinese_encode( $str ){
	return mb_convert_encoding(  $str, "UTF-8", "gbk" );//gbk
}

function html_action( $obj ){
	$html  = html_span( $obj->id );
	$html .= html_span_editable( chinese_encode( $obj->param ), 'param bold' );
	
	$url_next = "#" . $obj->id_next;
	$url_fail = "#" . $obj->id_nextfail;
	// $url_next = "taskview.php?task=" . $obj->id_next;
	// $url_fail = "taskview.php?task=" . $obj->id_nextfail;

	$ancor_next = html_ancor( $obj->id_next, $url_next ); 
	$ancor_fail = html_ancor( $obj->id_nextfail, $url_fail ); 
	
	$div = "<div class='margin'>" .
				html_span( "Next: " . $ancor_next ) .
				html_span( "Fail: " . $ancor_fail ) .
				html_span( "Data: " . $obj->data  ) .
				html_span( "Type: " . $obj->type  ) .
				html_button( "Edit", 'edit a'.$obj->id ).
			"</div>";

	$html .= $div;

	return $html;
}


function get_connection(){

	$host	= 'localhost';
	$user	= 'root';	
	$pass	= '';
	$db		= 'my';

	$con = mysql_connect( $host, $user, $pass );
	mysql_select_db( $db );

	return $con;		
}