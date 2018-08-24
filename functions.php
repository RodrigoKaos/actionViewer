<?php 

function chinese_encode( $str ){
	return mb_convert_encoding(  $str, "UTF-8", "gbk" );//gbk
}

function html_action( $arr ){
	$html  = html_span( $arr->id );
	// $html .= html_span_editable( chinese_encode( $arr->param ), 'param bold' );
	$html .= html_span_editable( $arr->param, 'param bold' );
	
	// $url_next = "taskview.php/#" . $arr->id_next;
	// $url_fail = "taskview.php/#" . $arr->id_nextfail;
	$url_next = "taskview.php?task=" . $arr->id_next;
	$url_fail = "taskview.php?task=" . $arr->id_nextfail;

	$ancor_next = html_ancor( $arr->id_next, $url_next ); 
	$ancor_fail = html_ancor( $arr->id_nextfail, $url_fail ); 
	
	$div = "<div class='margin'>" .
				html_span( "Next: " . $ancor_next ) .
				html_span( "Fail: " . $ancor_fail ) .
				html_span( "Data: " . $arr->data  ) .
				html_span( "Type: " . $arr->type  ) .
				html_button( "Edit", 'edit a'.$arr->id ).
			"</div>";

	$html .= $div;

	return $html;
}

function html_span( $str, $cssCLass = "", $elementId = "" ){
	return "<span id='$elementId' class='$cssCLass'> $str </span>";
}

function html_span_editable( $str, $cssCLass = "" ){
	return "<span class='$cssCLass' contenteditable='false'> $str </span>";
}

function html_div( $str, $cssCLass = "" ){
	return "<div class='$cssCLass'> $str </div>";
}

function html_ancor( $str, $url ){
	return "<a href='$url'> $str </a>";
}

function html_button( $str, $cssClass = "" ){
	return "<button class='$cssClass'> $str </button>";
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