<?php
// Created by: Yacine Ait Chalal -> 18/09/2017
// 
header('Content-Type: application/json');

define("DIR_ROOT", "../../");

require DIR_ROOT.'includes/All_files.php';

// security
require 'verif_user.php';
require 'verif_csrf_token.php';


$mode = !empty($_GET['mode'])? clean_var($_GET['mode']):clean_var($_POST['mode']);

//***** Mode: Add new subscription *****//
if($mode=="add") {
    $subscription_id = !empty($_GET['subscription_id'])? clean_var($_GET['subscription_id']):clean_var($_POST['subscription_id']);
    $nom = !empty($_GET['nom'])? clean_var($_GET['nom']):clean_var($_POST['nom']);
    $prix = !empty($_GET['prix'])? clean_var($_GET['prix']):clean_var($_POST['prix']);
    $periode = !empty($_GET['periode'])? clean_var($_GET['periode']):clean_var($_POST['periode']);
    $essai = !empty($_GET['essai'])? clean_var($_GET['essai']):clean_var($_POST['essai']);
    $installation = !empty($_GET['installation'])? clean_var($_GET['installation']):clean_var($_POST['installation']);
    $tva = !empty($_GET['tva'])? clean_var($_GET['tva']):clean_var($_POST['tva']);
    $livraison = !empty($_GET['livraison'])? clean_var($_GET['livraison']):clean_var($_POST['livraison']);
    $ureturn = !empty($_GET['ureturn'])? clean_var($_GET['ureturn']):clean_var($_POST['ureturn']);
    $unotify = !empty($_GET['unotify'])? clean_var($_GET['unotify']):clean_var($_POST['unotify']);
    $ucancel = !empty($_GET['ucancel'])? clean_var($_GET['ucancel']):clean_var($_POST['ucancel']);
    $comments = !empty($_GET['comments'])? clean_var($_GET['comments']):clean_var($_POST['comments']);
    $button = !empty($_GET['button'])? clean_var($_GET['button']):clean_var($_POST['button']);

    $array_reponse = array( 'errors' => array(
                            'edit_subscription' => ''),
                          'success'=>'yes' );

    if($subscription_id!="") {
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
    }elseif(get_member_status($uid)<2 && $post['price']>$data['PaymentMaxSum']) {
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
    $subscription_id = !empty($_GET['subscription_id'])? clean_var($_GET['subscription_id']):clean_var($_POST['subscription_id']);

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
    $subscription_id = !empty($_GET['subscription_id'])? clean_var($_GET['subscription_id']):clean_var($_POST['subscription_id']);

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
