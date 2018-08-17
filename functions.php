<?php 

function chinese_encode( $str ){
	return mb_convert_encoding(  $str, "UTF-8", "gbk" );//gbk
}

function html_action( $arr ){
	$html  = html_span( $arr['id'] );
	$html .= html_span( $arr['param'], 'bold' );
	
	$url_next = "taskview.php?task=" . $arr['idNext'];
	$url_fail = "taskview.php?task=" . $arr['idNextFail'];

	$ancor_next = html_ancor( $arr['idNext'], $url_next ); 
	$ancor_fail = html_ancor( $arr['idNextFail'], $url_fail ); 
	
	$div = "<div>" .
				html_span( "Next: " . $ancor_next ) .
				html_span( "Fail: " . $ancor_fail ) .
				html_span( "Data: " . $arr['data']) .
			"</div>";

	$html .= $div;

	return $html;
}

function html_action2( $arr ){
	$html  = html_span( $arr->id );
	$html .= html_span( chinese_encode( $arr->param ), 'bold' );
	
	$url_next = "taskview.php?task=" . $arr->id_next;
	$url_fail = "taskview.php?task=" . $arr->id_nextfail;

	$ancor_next = html_ancor( $arr->id_next, $url_next ); 
	$ancor_fail = html_ancor( $arr->id_nextfail, $url_fail ); 
	
	$div = "<div>" .
				html_span( "Next: " . $ancor_next ) .
				html_span( "Fail: " . $ancor_fail ) .
				html_span( "Data: " . $arr->data  ) .
			"</div>";

	$html .= $div;

	return $html;
}

function html_span( $str, $cssCLass = " " ){
	return "<span class='$cssCLass'> $str  </span>";
}

function html_ancor( $str, $url ){
	return "<a href=$url>$str</a>";
}
