<?php
// Created by: Acher Adlane
// Revised by: Yacine Ait Chalal -> 25/05/2017
// 
header('Content-Type: application/json');

define("DIR_ROOT", "../../");

require DIR_ROOT.'includes/All_files.php';

// security
require 'verif_user.php';
require 'verif_csrf_token.php';


//http://www.edinars.net/api/v1/load_account.php?member_id=000&amount=100&code_pin=0000

$member_id = !empty($_GET['member_id'])? clean_var($_GET['member_id']):clean_var($_POST['member_id']);
$amount = !empty($_GET['amount'])? clean_var($_GET['amount']):clean_var($_POST['amount']);
$dtype  = !empty($_GET['dtype'])? clean_var($_GET['dtype']):clean_var($_POST['dtype']);
$code_pin  = !empty($_GET['code_pin'])? clean_var($_GET['code_pin']):clean_var($_POST['code_pin']);

$array_reponse = array( 'errors' => array(
                          'member_id' => '',
                          'amount' => '',
                          'code_pin' => '',
                          'load_account'=>''),
                        'success'=>'yes' );



$array_info_sender = select_info($user_id, $post);
$array_info_reciever = get_member_info_reciever($member_id);



if(!$member_id) {
    $array_reponse['errors']['member_id'] = "Veillez entrer le N° de compte";
    $array_reponse['success'] = "no";
}elseif(!$array_info_reciever["id"]) {
    $array_reponse['errors']['member_id'] = "Ce compte n'existe pas ";
    $array_reponse['success'] = "no";
}


$balance_disponible = select_balance_disponible($user_id);

$fees = $data['DepositMethod'][$dtype]['fees'];
$prcn = $data['DepositMethod'][$dtype]['prcn'];


$amount_fees = round(($amount*$prcn/100)+$fees, 2);

if(!$amount) {
    $array_reponse['errors']['amount'] = "Veillez entrer le montant";
    $array_reponse['success'] = "no";
}elseif($amount > ($balance_disponible + $amount_fees)) {
    $array_reponse['errors']['amount'] = "Votre solde est insuffisant pour effectuer cette transaction";
    $array_reponse['success'] ="no";
}elseif($amount < $data['DepositMinSum']) {
    $array_reponse['errors']['amount'] = "Le montant minimum que vous pouvez déposer est {$data['DepositMinSum']} {$data['Currency']}";
    $array_reponse['success'] ="no";
}elseif($amount > $data['DepositMaxSum']) {
    $array_reponse['errors']['amount'] = "Le montant maximun que vous pouvez déposer est {$data['DepositMaxSum']} {$data['Currency']}";
    $array_reponse['success'] = "no";
}


if(!$code_pin) {
    // $array_reponse['errors']['code_pin'] = "Code PIN incorrect";
    // $array_reponse['success']="no";
}

if($array_reponse['success']=="yes") {

    $get_trx_id = get_trx_id();

    $mcheckinfo .=" Montant : ".$amount." \n" ;
    $mcheckinfo .=" Identifinat : ".prnuser($array_info_reciever['id'])." \n " ;
    $mcheckinfo .=" Réference : ".$get_trx_id;

    $data['success'] ="yes";

    transaction(
        $get_trx_id,
        $user_id,
        $array_info_reciever['id'],
        $amount,
        0, // fees
        1, // type Depot
        2, // status
        'DEPOT PAR APPLICATION',
        "Details de la transaction:\n".$mcheckinfo
    );

    $transaction = get_transaction_trx_id($get_trx_id);

    //insert notification
    $array_infos['member_id'] = $array_info_reciever['id'];
    $array_infos['transaction_id'] = $transaction[0]['id'];
    $array_infos['type'] = "transaction";

    insert_notification($array_infos);

    $mcheckinfo ="";
    $mcheckinfo .=" Montant : <b>".$amount_fees." DA</b> <br />" ;
    $mcheckinfo .=" Identifinat    : <b>".prnuser($uid)."</b> <br /> " ;
    $mcheckinfo .=" Adresse E-Mail : <b>".get_member_email($uid)."</b> <br /> " ;
    $mcheckinfo .=" Réference : <b>".$get_trx_id."</b>";

    $post['email']=get_member_email($tran['receiver']);
    send_email('SEND-MONEY', $post);
    // 
    // transaction(get_trx_id(),
    //             $user_id,
    //             -1,
    //             $amount_fees,
    //             0,
    //             5,
    //             2,
    //             'DEPOT PAR APPLICATION',
    //             "Details de la transaction:\n".$mcheckinfo
    //);

    $array_reponse["new_balance"] = select_balance_disponible($user_id);
    $array_reponse["transaction"] = get_transaction_trx_id($get_trx_id);

}

echo json_encode($array_reponse);
