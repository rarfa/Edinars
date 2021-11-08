<?php
// Created by: Yacine Ait Chalal -> 24/09/2017
//
//header('Content-Type: application/json');

define("DIR_ROOT", "../../");

require DIR_ROOT . 'includes/All_files.php';


$mode = isset($_REQUEST['mode']) ?  prntext($_REQUEST['mode']) : '';

// security
if($mode != '') {
    include 'verif_user.php';
    include 'verif_csrf_token.php';
}


$pincode    = isset($_REQUEST['pincode'])    ?  prntext($_REQUEST['pincode']) : '';
$prehashkey = isset($_REQUEST['prehashkey']) ?  prntext($_REQUEST['prehashkey']) : '';
$crypt      = isset($_REQUEST['crypt'])      ?  prntext($_REQUEST['crypt']) : '';
$quantite   = isset($_REQUEST['quantite'])   ?  prntext($_REQUEST['quantite']) : '';
$note       = isset($_REQUEST['note'])       ?  prntext($_REQUEST['note']) : '';

// if facture
$facture_id = isset($_REQUEST['facture_id']) ? prntext($_REQUEST['facture_id']) : '';
$tva        = isset($_REQUEST['tva']) ? prntext($_REQUEST['tva']) : '';
$prix_total = isset($_REQUEST['prix_total']) ? prntext($_REQUEST['prix_total']) : 0;


$array_reponse = array('errors'=>[
    'pincode' => '',
    'prehashkey' => '',
    'crypt' => '',
    'get_checkout' => ''
  ], 'success'=>'yes' );


//quantite
if(!is_numeric($quantite) || $quantite <= 0) {
    $quantite = 1;
}

// echo "str_len pincode = ".(strlen($pincode));
// echo "str_len prehashkey = ".(strlen($prehashkey));
// echo "str_len crypt = ".(strlen($crypt));
// exit();

// verification
if (strlen($pincode) <= 0 || strlen($prehashkey) <= 0 || strlen($crypt) <= 0) {
    $array_reponse['errors']['get_checkout'] = "Erreur! 0x0001";
    $array_reponse['success'] = "no";
}else{

    // disable decrypt as its not doing anything the crypt is already sent which holds all needed data need to process
    //$strToDeCrypt = decryptPerHashKey($prehashkey, $crypt);

    $strToDeCrypt = explode("|", $crypt);

    foreach ($strToDeCrypt as $key => $value){
        $part1 = substr($value, 0, strpos($value, "="));
        $part2 = substr($value, strpos($value, "=") + 1, strlen($value));
        $checkout[$part1]  = $part2;
    }

    $array_reponse['errors']['strToDeCrypt']      = $strToDeCrypt;
    $array_reponse['errors']['decryptPerHashKey'] = $crypt; // decryptPerHashKey

    // action for facture 
    if(isset($checkout['action']) && $checkout['action'] == 'facture') { // --------------------------------------------------------------------------------------
        
        // validate variables
        if(!$facture_id) {

            $array_reponse['errors']['get_checkout'] = "L'identifiant de la facture est manquant";
            $array_reponse['success'] = "no";

        }else {

            // check if owner correct 
            $owner = get_member_info_by_mem_id($pincode);

            if(!$owner) {
                $array_reponse['errors']['get_checkout'] = "Code pin incorrect, propriétaire introuvable";
                $array_reponse['success'] = "no";
            }else{

                $checkout['action']     = 'facture';
                $checkout['quantite']   = 1; // facture wahda
                $checkout['facture_id'] = $facture_id; // facture wahda
                $checkout['owner']      = $owner['username'];
                $checkout['fullname']   = $owner['fname'] . " " . $owner['lname'];
                $checkout['total']      = $prix_total;
                $checkout['product']    = [];

                $checkout['product']['nom']   = $facture_id;
                $checkout['product']['owner'] = $owner['id'];
                $checkout['product']['tva']   = $tva;
                $checkout['product']['_prix']  = $prix_total;

                $checkout['product']['ureturn'] = $_REQUEST['ureturn'] ?? null;
                $checkout['product']['unotify'] = $_REQUEST['unotify'] ?? null;
                $checkout['product']['ucancel'] = $_REQUEST['ucancel'] ?? null;
                $checkout['product']['image']   = $_REQUEST['image']   ?? null;
                

                //$checkout['product']['_prix']       = prnsumm($checkout['product']['prix']);
                $checkout['_total']                 = prnsumm($checkout['total']);
                //$checkout['product']['_comments']   = nl2br($checkout['product']['comments']);
                $checkout['currency']               = "DA";//prntext($post['Currency']);

            }
        }

    } elseif(!isset($checkout['identifiant']) || !isset($checkout['action']) || !isset($checkout['produit'])) {  // ------------------------------------------------------------------------

        $array_reponse['errors']['get_checkout'] = "Erreur!! 0x0002";
        $array_reponse['success'] = "no";

    }else{
        $tmp_email          = get_member_email_by_username($checkout['identifiant']);
        $owner              = get_member_id($tmp_email);
        $checkout['owner']  = prnuser($owner);

        if(!$owner) {
            $array_reponse['errors']['get_checkout'] = "Code pin incorrect, propriétaire introuvable";
            $array_reponse['success'] = "no";
        }else{

            $product = select_product_details($checkout['produit'], $owner);

            if(!$product) {
                $array_reponse['errors']['get_checkout'] = "Code pin incorrect!! produit introuvable";
                $array_reponse['success'] = "no";
            }else{
                $checkout['quantite']   = $quantite;
                $checkout['total']      = ($product['prix'] + $product['installation'] + $product['tva'] + $product['livraison']) * $quantite;
                $checkout['livraison']  = $product['livraison'];
                $checkout['product']    = $product;
                //filter
                unset($checkout['product']['unotify']);

                //process

                if(!isset($checkout['product']['ureturn'])) {
                    $checkout['product']['ureturn'] = "{$data['Host']}";
                }
                if(!isset($checkout['product']['ucancel'])) {
                    $checkout['product']['ucancel'] = "{$data['Host']}";
                }
                $checkout['product']['_prix']       = prnsumm($checkout['product']['prix']);
                $checkout['_total']                 = prnsumm($checkout['total']);
                $checkout['_livraison']             = prnsumm($checkout['livraison']);
                $checkout['product']['_comments']   = nl2br($checkout['product']['comments']);
                $checkout['currency']               = "DA";//prntext($post['Currency']);
            }
        }
    }
}


if($array_reponse['success'] == "yes") {
    unset($checkout['identifiant']);
    $array_reponse += $checkout;

    // validate_commande
    if($mode == "validate") {
        // $array_reponse['payment_percent'] = $data['PaymentPercent'];
        // $array_reponse['payment_fees'] = $data['PaymentFees'];

        $fees = ($array_reponse['total'] * $data['PaymentPercent'] / 100) + $data['PaymentFees'];
        $array_reponse['fees'] = $fees;
        $array_reponse['trxid'] = get_trx_id();

        //buyer
        $array_reponse['buyer'] = $user_id;


        // PaymentMaxSum
        if($array_reponse['action'] == 'paiement'
            && get_member_status($array_reponse['product']['owner']) < 2
            && $post['price'] > $data['PaymentMaxSum']
        ) {
            $array_reponse['errors']['validate'] = "Récepteur ne peut pas recevoir plus de".
                                              " {$data['PaymentMaxSum']} {$array_reponse['currency']} par".
                                              " transaction parceque son compte ne pas encore vérifié";
            $array_reponse['success'] = "no";
        }

        // owner == buyer
        if($owner == $array_reponse['buyer']) {
            $array_reponse['errors']['validate'] = "Vous ne pouvez pas envoyer un paiement à vous-même";
            $array_reponse['success'] = "no";
        }

        // balance < price
        if($array_reponse['total'] > select_balance($array_reponse['buyer'])) {
            $array_reponse['errors']['validate'] = "Vous n'avez pas assez d'argent dans votre compte ";
            $array_reponse['success'] = "no";
        }


        if($array_reponse['success'] == "yes") {

            $insert_transaction = transaction(
                $array_reponse['trxid'],
                $array_reponse['buyer'],
                $array_reponse['product']['owner'],
                $array_reponse['total'],
                $array_reponse['fees'],
                0,
                2,
                ucfirst($array_reponse['action']) . ": " . $note
            );



            if(!$insert_transaction) {
                $array_reponse['errors']['validate'] = "Transaction non enregistré";
                $array_reponse['success'] = "no";
            }else{
                $transaction = get_transaction_trx_id($array_reponse['trxid']);

                //insert notification
                $array_infos['member_id']       = $array_reponse['product']['owner'];
                $array_infos['sender_id']       = $user_id;
                $array_infos['transaction_id']  = $transaction[0]['id'];
                $array_infos['type']            = "transaction";
                $array_infos['message']         = "New product payment received";

                insert_notification($array_infos);

                if($array_reponse['action'] == 'produit' || $array_reponse['action'] == 'donation' || $array_reponse['action'] == 'abonnement' || $array_reponse['action'] == 'facture') {
                    update_sold($array_reponse['product']['id'], $array_reponse['quantite']);
                    if($array_reponse['action'] == 'abonnement') {
                        insert_subscription($array_reponse['product']['owner'], $array_reponse['buyer'], $array_reponse['product']['id']);
                    }
                }

                //prepare for send email
                $post['trxid']          = $array_reponse['trxid'];
                $post['fees']           = $fees;
                $post['acheteur']       = get_member_email($array_reponse['buyer']);
                $post['montant']        = $array_reponse['total'];
                $post['username']       = prnuser($array_reponse['buyer']);
                $post['comments']       = ($note ? $note : 'N/A');
                $post['buyer']          = get_member_email($array_reponse['buyer']);
                $post['seller']         = get_member_email($array_reponse['product']['owner']);
                $post['sellerusername'] = prnuser($array_reponse['product']['owner']);
                $post['email-id']       = get_pin_id();
                $post['commande']       = $_SESSION['commande'] ?? '';
                $post['fullname']       = $array_reponse['fullname'];



                if ($array_reponse['action'] != 'abonnement') {
                    $post['uid']    =  $array_reponse['buyer'];
                    $post['email']  = get_member_email($array_reponse['buyer']);
                    send_email('PAYMENT-MONEY', $post);

                    $post['uid']    =  $array_reponse['product']['owner'] ;
                    $post['email']  = get_member_email($array_reponse['product']['owner']);
                    send_email('PAYMENT-MONEY-TO-OWNER', $post);

                } else {
                    $post['uid']    = $array_reponse['buyer']  ;
                    $post['email']  = get_member_email($array_reponse['buyer']);
                    send_email('SUBSCRIPTION-MONEY', $post);

                    $post['uid']    = $array_reponse['product']['owner'] ;
                    $post['email']  = get_member_email($array_reponse['product']['owner']);
                    send_email('SUBSCRIPTION-MONEY-TO-OWNER', $post);
                }



                // Send info & back now
                $back['trxid']      = $array_reponse['trxid'];
                $back['pid']        = $array_reponse['product']['id'] ?? 'facture';
                $back['commande']   = $_SESSION['commande'] ?? '';
                $back['pname']      = $array_reponse['product']['nom'];
                $back['acheteur']   = get_member_username($array_reponse['buyer']);
                $back['total']      = $array_reponse['total'] . ' DA';
                $back['action']     = $array_reponse['action'];
                $back['quantity']   = $array_reponse['quantite']; // ??? missing something
                $back['comments']   = ($note ? $note : 'N/A'); // ??? missing something
                $back['refrence']   = $data['Host']; // ??? missing something
                $back['statut']     = 'termine';

                $unotify = $checkout['product']['unotify'] ?? $data['Host'];
                $ureturn = $checkout['product']['ureturn'] ?? $data['Host'];
                $ucancel = $checkout['product']['ucancel'] ?? $data['Host'];

                if ($unotify) { // if website asks for notification after payment
                    use_curl($unotify, $back);
                }
                //header("Location:{$ureturn}"); // if no need to send notification to the website
            }
        }
    }
}


echo json_encode($array_reponse);
