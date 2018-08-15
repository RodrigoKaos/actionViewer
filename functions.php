<?php 
function chinese_encode($str){
	return mb_convert_encoding(  $str, "UTF-8", "gbk");//gbk
	// return mb_convert_encoding( $str, "utf-8");
	// return mb_convert_encoding( mb_convert_encoding( $str, "UTF-8"), "UTF-8", "gbk");//gbk
	// return iconv('big5', 'utf-8', $str);
}

function html_action( $arr ){ 
	$html  = html_span( $arr['id'] );
	$html .= html_span("<h4>" . $arr['param'] . "</h4>");
	
	$url_next = "taskview.php?task=" . $arr['idNext'];
	$url_fail = "taskview.php?task=" . $arr['idNextFail'];

	$ancor_next = html_ancor($arr['idNext'], $url_next); 
	$ancor_fail = html_ancor($arr['idNextFail'], $url_fail); 
	
	$div = "<div>" .
				html_span( "ID:  " . $ancor_next ) .
				html_span("Fail: " . $ancor_fail ) .
				html_span("Data: " . $arr['data']) .
			"</div>";

	$html .= $div;

	// "
	// 	<span class=''>ID: " . $action_arr['id'] . "</span>" .
	// 		"<span>" . $action_arr['param'] . "</span>" . 
	// 		"<div>" .
	// 			"<span><a href='taskview.php?task=". $action_arr['idNext'] . "'>"  . $action_arr['idNext'] . "</a></span>" .
	// 			"<span>Next:" . $action_arr['idNextFail'] . "</span>" .
	// 			"<span>" . $action_arr['data'] . "</span>" .
	// 		"</div>";

	// echo '<div>' . $html . '</div>';


	return $html;
}

function html_span($str, $cssCLass = " "){
	return "<span class='$cssCLass'> $str  </span>";
}

function html_ancor($str, $url){
	return "<a href=$url>$str</a>";
}