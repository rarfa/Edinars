<?php
header('Content-Type: application/json');

define("DIR_ROOT", "../../");

include(DIR_ROOT.'includes/All_files.php');

// security
include('verif_user.php');
// include('verif_csrf_token.php');

$array_reponse = array( 'success'=>'yes', 'success_viewed' => 'yes' );

$notification_id = !empty($_GET['notification_id'])? prntext($_GET['notification_id']):prntext($_POST['notification_id']);

$notification = get_notification_by_id($user_id, $notification_id);

if($notification['id']){
	$array_reponse['notification'] = $notification;

	//set_notification_viewed
	$viewed = set_notification_viewed($user_id,$notification_id);
	if(!$viewed){
		$array_reponse['success_viewed'] = "no";
	}

}else{
	$array_reponse['success'] = 'no';
}

echo json_encode($array_reponse);

?>
