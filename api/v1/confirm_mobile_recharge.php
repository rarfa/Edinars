<?php
//Secret
// by: Yacine Ait Chalal -> 03/10/2017
// Link for test https://v2.edinars.net/api/v1/confirm_mobile_recharge.php?trx=&status=&message=
// https://www.ediffuse.net/api/beta/transaction.php?imei=1111111111&pin=5818&trx_id=
// 
header('Content-Type: application/json');

define("DIR_ROOT", "../../");

require DIR_ROOT.'includes/All_files.php';

$array_reponse = array( 'errors' => array('confirm_mobile_recharge'=>''),
                        'status' => '',
                        'success'=>'yes' );

$trx = !empty($_GET['trx'])? clean_var($_GET['trx']):clean_var($_POST['trx']);
$status = !empty($_GET['status'])? clean_var($_GET['status']):clean_var($_POST['status']);
$message = !empty($_GET['message'])? clean_var($_GET['message']):clean_var($_POST['message']);

$ussd = get_ussd_by_trx_id($trx);

if(!$trx) {
    $array_reponse['errors']['confirm_mobile_recharge']="Numéro TRX incorrect !";
    $array_reponse['success'] = "no";
}elseif(!$ussd["ussd_id"]) {
    $array_reponse['errors']['confirm_mobile_recharge']="Numéro TRX introuvable";
    $array_reponse['success'] = "no";
}elseif(!$status) {
    $array_reponse['errors']['confirm_mobile_recharge']="Status incorrect";
    $array_reponse['success'] = "no";
}elseif (!$message) {
    $array_reponse['errors']['confirm_mobile_recharge']="Message incorrect";
    $array_reponse['success'] = "no";
}

// --> Output
if($array_reponse['success']=="yes") {


    if($status == "ATTENTE") {
        $status = 0;
    } else if($status == "TERMINE") {
        $status = 1;
    } else if($status == "ANNULER") {
        $status = 2;
    } else if($status == "REMBOURSE") {
        $status = 3;
    } else if($status == "PROCESSE") {
        $status = 4;
    } else if($status == "ERREUR") {
        $status = 99;
    }

    if($status != $ussd['status']) {
        $array_reponse['status'] = $status;

        // Update transaction "ussd_trx_id"
        update_transaction_status_topup($ussd['ussd_trx_id'], $status, $message);

        // Notification

        $array_infos['member_id'] = $ussd['ussd_user_id'];
        $array_infos['type'] = "message";
        $array_infos['sender_id'] = "-1";
        $array_infos['message'] = $message;
        // $array_infos['message']  = "<p>Vous avez reçu une somme de  <b>".$ussd['ussd_amount']." DA</b></p>";
        // $array_infos['message'] .= "<p>sur ce numéro <b>".$ussd['ussd_number']."</b></p>";

        insert_notification($array_infos);
    }

}

echo json_encode($array_reponse);
