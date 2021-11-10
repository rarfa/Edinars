<?php
//Secret
// by: Yacine Ait Chalal -> 03/10/2017
// Link for test https://v2.edinars.net/api/v1/confirm_mobile_recharge.php?trx=&status=&message=
// https://www.ediffuse.net/api/beta/transaction.php?imei=1111111111&pin=5818&trx_id=
// 
header('Content-Type: application/json');

define("DIR_ROOT", "../../");

require DIR_ROOT.'includes/All_files.php';

// security
require 'verif_user.php';
require 'verif_csrf_token.php';


// if user id
//$user_id = $_REQUEST['user_id'] ?? null; user_id is defined global no need to use it from here 

//  flexy with status pending 
$pendingFlexyTransactions = [];
$transactions             = get_transactions($user_id, 'both', 3, 1, 0, 5);

foreach ($transactions as $key => $value) {
    foreach ($value as $key_2 => $value_2) {
        if(!is_array($value_2)) {
            $pendingFlexyTransactions[$key][$key_2] = strip_tags(utf8_encode($value_2));
        }
    }
}

$endpoint = 'https://dzflex.edinars.dz/api/beta/transaction.php?pin=8163&imei=1111111111&trx_id=';

// send to dzflex and check if status updated 
foreach($pendingFlexyTransactions as $key => &$transaction) {

    // skip & kep only transactions that has ssd
    if(!isset($transaction['ussd_retries']) || !$transaction['ussd_retries']) {
        unset($pendingFlexyTransactions[$key]);
        continue;
    }

    $response = simplexml_load_file($endpoint . $transaction['ussd_retries']);
    $transaction['dzflex_status'] = $response->trx->trx_status->__toString();
    $transaction['last_message']  = $response->trx->trx_ussd_message->__toString();
}


$array_reponse = [
    'success' => 'No'
];

if(count($pendingFlexyTransactions) > 0) {

    foreach($pendingFlexyTransactions as $transaction) {

        $status = $transaction['dzflex_status'];

        if($status == "ATTENTE") {
            $status = 1;
        } else if($status == "TERMINE") {
            $status = 2;
        } else if($status == "ANNULER") {
            $status = 3;
        } else if($status == "REMBOURSE") {
            $status = 4;
        } else if($status == "PROCESSE") {
            $status = 5;
        } else if($status == "ERREUR") {
            $status = 6;
        }

        if($status != $transaction['ostatus']) {

            // update status 
            update_transaction_status_topup($transaction['id'], $status, $transaction['last_message']);
    
            // Notification
            $array_infos['member_id']   = $user_id;
            $array_infos['type']        = "message";
            $array_infos['sender_id']   = "-1";
            $array_infos['message']     = $transaction['last_message'];
    
            insert_notification($array_infos);

            $array_reponse['success'] = 'Yes'; 
            $array_reponse['updated_transactions'][] = $transaction; 
        }
    }
}

echo json_encode($array_reponse);
