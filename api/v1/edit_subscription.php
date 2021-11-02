<?php
// Created by: Yacine Ait Chalal -> 18/09/2017
// 
header('Content-Type: application/json');

define("DIR_ROOT", "../../");

require DIR_ROOT.'includes/All_files.php';

// security
require 'verif_user.php';
require 'verif_csrf_token.php';


$mode = isset($_REQUEST['mode']) ? clean_var($_REQUEST['mode']) : '' ;

//***** Mode: Add new subscription *****//
if($mode=="add") {
    $subscription_id    = isset($_REQUEST['subscription_id']) ? clean_var($_REQUEST['subscription_id']) : '' ;
    $nom                = isset($_REQUEST['nom']) ? clean_var($_REQUEST['nom']) : '' ;
    $prix               = isset($_REQUEST['prix']) ? clean_var($_REQUEST['prix']) : '' ;
    $periode            = isset($_REQUEST['periode']) ? clean_var($_REQUEST['periode']) : '' ;
    $essai              = isset($_REQUEST['essai']) ? clean_var($_REQUEST['essai']) : '' ;
    $installation       = isset($_REQUEST['installation']) ? clean_var($_REQUEST['installation']) : '' ;
    $tva                = isset($_REQUEST['tva']) ? clean_var($_REQUEST['tva']) : '' ;
    $livraison          = isset($_REQUEST['livraison']) ? clean_var($_REQUEST['livraison']) : '' ;
    $ureturn            = isset($_REQUEST['ureturn']) ? clean_var($_REQUEST['ureturn']) : '' ;
    $unotify            = isset($_REQUEST['unotify']) ? clean_var($_REQUEST['unotify']) : '' ;
    $ucancel            = isset($_REQUEST['ucancel']) ? clean_var($_REQUEST['ucancel']) : '' ;
    $comments           = isset($_REQUEST['comments']) ? clean_var($_REQUEST['comments']) : '' ;
    $button             = isset($_REQUEST['button']) ? clean_var($_REQUEST['button']) : '' ;

    $array_reponse = array( 'errors' => array(
                            'edit_subscription' => ''),
                          'success'=>'yes' );

    if($subscription_id != "") {
        $subscription = select_products($user_id, 1, $subscription_id, true);
        if($subscription[0]['id']=="") {
            $array_reponse['errors']['edit_subscription'] = "Abonnement n'existe pas!";
            $array_reponse['success'] = "no";
        }
    }

    if(!$nom) {
        $array_reponse['errors']['nom'] = "Veuillez saisir le nom d'abonnement";
        $array_reponse['success'] = "no";
    }

    if(!$prix) {
        $array_reponse['errors']['prix'] = "Veuillez saisir le prix d'abonnement";
        $array_reponse['success'] = "no";
    }elseif($prix < $data['PaymentMinSum']) {
        $array_reponse['errors']['prix'] = "Prix pour un abonnement ou un service doit être inférieur à".
        " {$data['PaymentMinSum']} {$data['Currency']}";
        $array_reponse['success'] = "no";
    }elseif(get_member_status($uid) < 2 && $post['prix']>$data['PaymentMaxSum']) {
        $array_reponse['errors']['prix'] ="Prix pour d'abonnement doit être inférieur à".
        " {$data['PaymentMaxSum']} {$data['Currency']}  ".
        " parce que votre compte ne pas encore vérifié";
        $array_reponse['success'] = "no";
    }

    if(!$periode) {
        $array_reponse['errors']['periode'] = "Veuillez saisir la periode";
        $array_reponse['success'] = "no";
    }

    // if(!$tva){
    //   $array_reponse['errors']['tva'] = "Veuillez saisir la tva";
    //   $array_reponse['success'] = "no";
    // }

    if(!$ureturn) {
        $array_reponse['errors']['ureturn'] = "Veuillez saisir l'URL de Retour";
        $array_reponse['success'] = "no";
    }

    if(!$unotify) {
        $array_reponse['errors']['unotify'] = "Veuillez saisir l'URL de Notification";
        $array_reponse['success'] = "no";
    }

    if(!$ucancel) {
        $array_reponse['errors']['ucancel'] = "Veuillez saisir l'URL de Annulation";
        $array_reponse['success'] = "no";
    }

    if(!$button) {
        $array_reponse['errors']['button'] = "Veuillez sélectionner l'image pour le bouton de paiement";
        $array_reponse['success'] = "no";
    }

    $post = compact('nom', 'prix', 'periode', 'essai', 'installation', 'tva', 'livraison', 'ureturn', 'unotify', 'ucancel', 'comments', 'button');

    if($array_reponse['success']=="yes" && $subscription_id=="") { //add
        $insert = insert_product($user_id, 1, $post);
        if(!$insert) {
            $array_reponse['errors']['edit_subscription'] = "Erreur interne!";
        }else{
            $array_reponse['title'] = "Ajouter un abonnement";
            $array_reponse['description'] = "Abonnement ajouté avec succès";
        }
    }else if($array_reponse['success']=="yes" && $subscription_id!="") { //edit
        $update = update_product($subscription_id, $post);
        if(!$update) {
            $array_reponse['errors']['edit_subscription'] = "Erreur interne!";
        }else{
            $array_reponse['title'] = "Modifier un abonnement";
            $array_reponse['description'] = "Abonnement modifié avec succès";
        }
    }

}

//***** Mode: delete subscription *****//
if($mode=="delete") {
    $subscription_id    = isset($_REQUEST['subscription_id']) ? clean_var($_REQUEST['subscription_id']) : 0;

    $array_reponse = array( 'errors' => array(
                            'edit_subscription' => ''),
                          'success'=>'yes' );

    $result = delete_product($subscription_id);

    if(!$result) {
        $array_reponse['errors']['edit_subscription'] = "Erreur de suppression";
        $array_reponse['success'] = "no";
    }

}


//***** Mode: cancel subscription *****//
if($mode=="cancel") {
    $subscription_id    = isset($_REQUEST['subscription_id']) ? clean_var($_REQUEST['subscription_id']) : 0 ;

    $array_reponse = array( 'errors' => array(
                            'edit_subscription' => ''),
                          'success'=>'yes' );

    $result = cancel_subscription($subscription_id);

    if(!$result) {
        $array_reponse['errors']['edit_subscription'] = "Erreur de d'annulation";
        $array_reponse['success'] = "no";
    }

}


echo json_encode($array_reponse);
