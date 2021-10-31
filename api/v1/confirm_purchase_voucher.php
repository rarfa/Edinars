<?php
//Secret
// by: Yacine Ait Chalal -> 19/12/2017
// 
// header('Content-Type: application/json');

define("DIR_ROOT", "../../");

require DIR_ROOT.'includes/All_files.php';

// security
require 'verif_user.php';
require 'verif_csrf_token.php';


$array_reponse = array( 'errors' => array('confirm_purchase_voucher'=>''),
                        'status' => '',
                        'success'=>'yes' );

$offer_id = !empty($_GET['offer_id'])? clean_var($_GET['offer_id']):clean_var($_POST['offer_id']);
$offer_details = get_voucher_offer_details($offer_id);

// $fees = $data['DepositMethod'][$post['dtype']]['fees'];
// $prcn = $data['DepositMethod'][$post['dtype']]['prcn'];
//
// $amount_fees = $post['fees']=round(($amount * $prcn/100)+$fees, 2);

if(!$offer_id) {
    $array_reponse['errors']['confirm_purchase_voucher'] = "Numéro d'offre incorrect !";
    $array_reponse['success'] = "no";
}elseif($offer_details['id']=="") {
    $array_reponse['errors']['confirm_purchase_voucher'] = "Numéro d'offre incorrect !!";
    $array_reponse['success'] = "no";
}elseif($offer_details['count_vouchers']<=0) {
    $array_reponse['errors']['confirm_purchase_voucher'] = "Pas de carte disponible pour l'instant ! Veuillez reessayer ulterierement.";
    $array_reponse['success'] = "no";
}elseif ($offer_details['price'] > select_balance_disponible($user_id) + $amount_fees) {
    $array_reponse['errors']['confirm_purchase_voucher'] = "Votre solde est insuffisant pour effectuer cet achat.";
    $array_reponse['success'] = "no";
}

// --> Output
if($array_reponse['success']=="yes") {

    $purchase_voucher = purchase_voucher($user_id, $offer_id);

    if($purchase_voucher['id']) {
        $post['get_trx_id'] =  get_trx_id();

        transaction(
            $post['get_trx_id'],
            $user_id,
            -1,
            $offer_details['price'],
            0, //fees
            3, //type
            2,
            "Achat d'une carte de recharge (".addslashes($offer_details['offer_name']).") Code: ".$purchase_voucher['code'],
            "Achat d'une carte de recharge (".addslashes($offer_details['offer_name']).") Code: ".$purchase_voucher['code']
        );

        // reponse
        $array_reponse['offer'] = $offer_details['offer_name'];
        $array_reponse['price'] = $offer_details['price'];
        $array_reponse['code'] = $purchase_voucher['code'];

        // Envoyer l'email

    }else{
        $array_reponse['errors']['confirm_purchase_voucher'] = "Impossible d'acheter une carte, Erreur interne.";
        $array_reponse['success'] = "no";
    }

}

echo json_encode($array_reponse);
