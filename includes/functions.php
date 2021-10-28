<?php

function format_date($time, $format){
	if($format=="") $format = "d/m/Y G:i";
	$date = date('d/m/Y', $time);

	if($date == date('d/m/Y')) {
		//$date = 'Today';
		$date = date('G:i', $time);
	} else if($date == date('d/m/Y', time() - (24 * 60 * 60))) {
		$date = 'Yesterday';
	}else{
		$date = date($format, $time);
	}


	//$rtn="Test";
	return $date;
}
function clean_var($variable){
	global $data;
	$variable = trim(mysqli_real_escape_string($data['cid'], $variable));
	return($variable);
}

function redirect($to){
	echo "<script>location.href='".$to."'</script>";
	exit();
}
