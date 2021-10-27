<?php
header('Content-Type: application/json');

define("DIR_ROOT", "../../");

include(DIR_ROOT.'includes/All_files.php');

// security
include('verif_user.php');

$count = 8;
$page = !empty($_GET['page'])? clean_var($_GET['page']):clean_var($_POST['page']);

$page = $page * $count;

$_array = get_transactions($user_id, 'both', -1, -1, $page, $count);
$all_transactions = get_transactions($user_id, 'both', -1, -1);

foreach ($_array as $key => $value) {
	foreach ($value as $key_2 => $value_2) {
		if(!is_array($value_2)){
			$array_reponse[$key][$key_2] = strip_tags(utf8_encode($value_2));
		}
	}
}

if (count($array_reponse)==0 ){ //|| count($all_transactions) == count($array_reponse)
	$array_reponse['end_of_list'] = "yes";
}

// $array_reponse['count_all_transactions'] = count($all_transactions);

// var_dump($array);

echo json_encode($array_reponse);

?>
