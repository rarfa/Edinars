<?php
// by: Yacine Ait Chalal -> 20/09/2017
// Link for test http://www.edinars.net/api/v1/confirm_payment.php?trx_id=
// 
header('Content-Type: application/json');

define("DIR_ROOT", "../../");

require DIR_ROOT.'includes/All_files.php';

// security
require 'verif_user.php';
require 'verif_csrf_token.php';


$array_reponse = array( 'errors' => array(
                          'trx_id' => '',
                          'code_pin' => '',
                          'confirm_payment'=>''),
                        'success'=>'yes' );

$trx_id = !empty($_GET['trx_id'])? clean_var($_GET['trx_id']):clean_var($_POST['trx_id']);
$code_pin  = !empty($_GET['code_pin'])? clean_var($_GET['code_pin']):clean_var($_POST['code_pin']);


$transaction = get_transaction_trx_id($trx_id);

$transaction_details = get_transaction_detail($transaction[0]['id'], $user_id);

$balance_disponible = select_balance_disponible($transaction_details['sender']);



if(!$trx_id || !$transaction[0]['id']) {
    $array_reponse['errors']['trx_id']="Numéro de transaction incorrect";
    $array_reponse['success'] = "no";
}elseif($transaction[0]['oamount'] > $balance_disponible) {
    $array_reponse['errors']['confirm_payment']="Votre solde est insuffisant pour effectuer cette transaction";
    $array_reponse['success'] = "no";
}

// var_dump($transaction);
// echo '<br>--------------<br>'.$balance_disponible;
// exit();

if(!$code_pin) {
    // $array_reponse['errors']['code_pin'] = "Code PIN incorrect";
    // $array_reponse['success']="no";
}


// --> Output
if($array_reponse['success']=="yes") {
    $update = update_transaction_status($user_id, $transaction[0]["id"], 1);

    if($update) {
        $transaction = get_transaction_trx_id($trx_id);

        //insert notification
        $array_infos['member_id'] = $transaction_details['receiver'];
        $array_infos['transaction_id'] = $transaction[0]['id'];
        $array_infos['type'] = "transaction";

        insert_notification($array_infos);

        // Email
        $post['email'] = get_member_email(get_member_id($transaction[0]["recvuser"]));
        // send_email('PAYMENT-MONEY', $post);

        $array_reponse['transaction'] = $transaction[0];
    }else{
        $array_reponse['errors']['code_pin'] = "Erreur interne !";
        $array_reponse['success']="no";
    }
}

// $array_reponse = array( 'error'=> $data['error'],
//                                                 'success'=>$data['status'],
//                                               'resever'=> $mcheckinfo,
//                                                  'transaction'=>$transaction[0]);

echo json_encode($array_reponse);
