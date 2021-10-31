<?php
// Created by: Acher Adlane
// Revised by: Yacine Ait Chalal -> 29/05/2017
// Link for http://www.edinars.net/api/v1/generate_order.php?member_id=000&amount=500&from=application
// 
//header('Content-Type: application/json');

define("DIR_ROOT", "../../");

require DIR_ROOT.'includes/All_files.php';

// security
require 'verif_user.php';
require 'verif_csrf_token.php';

$array_reponse = array( 'errors' => array(
                          'member_id' => '',
                          'amount' => '',
                          'code_pin' => '',
                          'generate_order'=>''),
                        'success'=>'yes' );

$member_id = !empty($_GET['member_id'])? clean_var($_GET['member_id']):clean_var($_POST['member_id']);
$amount = $post['montant'] = !empty($_GET['amount'])? clean_var($_GET['amount']):clean_var($_POST['amount']);
$code_pin = $post['dtype'] = !empty($_GET['code_pin'])? clean_var($_GET['code_pin']):clean_var($_POST['code_pin']);
$description  = !empty($_GET['description'])? clean_var($_GET['description']):clean_var($_POST['description']);
// $dtype  = !empty($_GET['from'])? clean_var($_GET['from']):clean_var($_GET['from']);

$array_info_sender = select_info($user_id, $post);
$array_info_reciever = get_member_info_reciever($member_id);

$data['Balance-disponible']=select_balance_disponible($user_id);

$fees = $data['DepositMethod'][$post['dtype']]['fees'];
$prcn = $data['DepositMethod'][$post['dtype']]['prcn'];

$amount_fees = $post['fees']=round(($amount * $prcn/100)+$fees, 2);


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
        1,
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

    $transaction_description .="Montant : <b>".$amount." DA</b><br>" ;
    $transaction_description .="Envoyé à : ".prnuser($array_info_reciever['id'])."<br>" ;

    //
    $post['email']=get_member_email($array_info_reciever['id']);
    send_email('REQUEST-MONEY', $post);

    $array_reponse['trx_id'] = $get_trx_id;
    $array_reponse['transaction_description'] = $transaction_description;


}

// $array_send_recharge = array( 'error'=> $data['error'],
//                                                             'trx_id'=> $get_trx_id,
//                                                             'success'=>$data['status'],
//                                                           'resever'=> $mcheckinfo );

echo json_encode($array_reponse);
