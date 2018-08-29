<?php 

function html_( $el , $str, $cssClass = "", $opt = "" ){
	return "<$el class='$cssClass' $opt > $str </$el>";
}

function html_span( $str, $cssCLass = "", $elementId = "" ){
	return html_( 'span', $str, $cssCLass, "id='$elementId'");
	// return "<span id='$elementId' class='$cssCLass'> $str </span>";
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


function html_table( $str, $cssClass = "" ){
	return "<table class='$cssClass'> $str </table>";
}

function html_tr( $str, $cssClass = "" ){
	return "<tr class='$cssClass'> $str </tr>";
}

function html_td( $str, $cssClass = "" ){
	return "<td class='$cssClass'> $str </td>";
}




