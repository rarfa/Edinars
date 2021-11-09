<?php
// Created by: Acher Adlane
// Revised by: Yacine Ait Chalal -> 29/05/2017
// Link for http://www.edinars.net/api/v1/generate_order.php?member_id=000&amount=500&from=application
//
//header('Content-Type: application/json');

define("DIR_ROOT", "../../");

require DIR_ROOT . 'includes/All_files.php';

// security
require 'verif_user.php';
require 'verif_csrf_token.php';

$array_reponse = array( 'errors' => array(
                          'member_id' => '',
                          'amount' => '',
                          'code_pin' => '',
                          'generate_order'=>''),
                        'success'=>'yes' );

$member_id      =  isset($_REQUEST['member_id']) ? clean_var($_REQUEST['member_id']) : null;
$amount         = $post['montant'] = isset($_REQUEST['amount']) ? clean_var($_REQUEST['amount']) : null;
$code_pin       = $post['dtype'] = isset($_REQUEST['code_pin']) ? clean_var($_REQUEST['code_pin']) : null;
$description    = isset($_REQUEST['description']) ? clean_var($_REQUEST['description']) : null;

// if no post dtype default to edifuse
// TODO :: sould be checked with rahim it was deleted here so it wasn't working this is just example fix
$dtype          = isset($_REQUEST['dtype']) ? clean_var($_REQUEST['dtype']) : 'Ediffuse';

$array_info_sender      = select_info($user_id, $post);
$array_info_reciever    = get_member_info_reciever($member_id);

$data['Balance-disponible'] = select_balance_disponible($user_id);

$fees = $data['DepositMethod'][$dtype]['fees'];
$prcn = $data['DepositMethod'][$dtype]['prcn'];

$amount_fees = $post['fees'] = round(($amount * $prcn/100)+$fees, 2);


if(!$member_id) {
    $array_reponse['errors']['member_id'] = "Veillez entrer le N° de compte";
    $array_reponse['success'] = "no";
}elseif(!$array_info_reciever["id"]) {
    $array_reponse['errors']['member_id'] = "Ce compte n'existe pas ";
    $array_reponse['success'] = "no";
}


if(!$amount) {
    $array_reponse['errors']['amount'] = "Veillez entrer le montant";
    $array_reponse['success'] = "no";
}


if($array_reponse['success']=="yes") {
    $get_trx_id = get_trx_id();

    transaction(
        $get_trx_id,
        $array_info_reciever['id'],
        $user_id,
        $amount,
        0,
        0, // type
        1,
        'Demande de paiement',
        "Details de la transaction:\n".$description
    );


    $transaction = get_transaction_trx_id($get_trx_id);

    //insert notification
    $array_infos['member_id'] = $array_info_reciever['id'];
    $array_infos['transaction_id'] = $transaction[0]['id'];
    $array_infos['type'] = "transaction";

    insert_notification($array_infos);


    // var_dump($array_info_reciever);
    // echo $array_info_reciever['id']." <- id \r\n";
    // echo prnuser($array_info_reciever['id'])." <- prnuser\r\n";

    $transaction_description  = "Montant : <b>".$amount." DA</b><br>" ;
    $transaction_description .= "Envoyé à : ".prnuser($array_info_reciever['id'])."<br>" ;

    //
    $post['email'] = get_member_email($array_info_reciever['id']);
    send_email('REQUEST-MONEY', $post);

    $array_reponse['trx_id'] = $get_trx_id;
    $array_reponse['transaction_description'] = $transaction_description;


}

// $array_send_recharge = array( 'error'=> $data['error'],
//                                                             'trx_id'=> $get_trx_id,
//                                                             'success'=>$data['status'],
//                                                           'resever'=> $mcheckinfo );

echo json_encode($array_reponse);
