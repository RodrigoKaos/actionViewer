<?php 
function chinese_encode($str){
	return mb_convert_encoding(  $str, "UTF-8", "gbk");//gbk
	// return mb_convert_encoding( $str, "utf-8");
	// return mb_convert_encoding( mb_convert_encoding( $str, "UTF-8"), "UTF-8", "gbk");//gbk
	// return iconv('big5', 'utf-8', $str);
}

?>