<?php
// Created by: Yacine Ait Chalal -> 12/07/2017
// 
header('Content-Type: application/json');

define("DIR_ROOT", "../../");

require DIR_ROOT.'includes/All_files.php';

// security
require 'verif_user.php';
require 'verif_csrf_token.php';

$mode = !empty($_GET['mode'])? clean_var($_GET['mode']):clean_var($_POST['mode']);


//***** Mode: Add new donation *****//
if($mode=="add") {
    $donation_id = !empty($_GET['donation_id'])? clean_var($_GET['donation_id']):clean_var($_POST['donation_id']);
    $nom = !empty($_GET['nom'])? clean_var($_GET['nom']):clean_var($_POST['nom']);
    $prix = !empty($_GET['prix'])? clean_var($_GET['prix']):clean_var($_POST['prix']);
    $ureturn = !empty($_GET['ureturn'])? clean_var($_GET['ureturn']):clean_var($_POST['ureturn']);
    $unotify = !empty($_GET['unotify'])? clean_var($_GET['unotify']):clean_var($_POST['unotify']);
    $ucancel = !empty($_GET['ucancel'])? clean_var($_GET['ucancel']):clean_var($_POST['ucancel']);
    $comments = !empty($_GET['comments'])? clean_var($_GET['comments']):clean_var($_POST['comments']);
    $button = !empty($_GET['button'])? clean_var($_GET['button']):clean_var($_POST['button']);

    $array_reponse = array( 'errors' => array(
                            'edit_donation' => ''),
                          'success'=>'yes' );

    if($donation_id!="") {
        $donation = select_products($user_id, 2, $donation_id, true);
        if($donation[0]['id']=="") {
            $array_reponse['errors']['edit_donation'] = "Donation n'existe pas!";
            $array_reponse['success'] = "no";
        }
    }

    if(!$nom) {
        $array_reponse['errors']['nom'] = "Veuillez saisir le nom de donation";
        $array_reponse['success'] = "no";
    }

    if(!$prix) {
        $array_reponse['errors']['prix'] = "Veuillez saisir le prix de donation";
        $array_reponse['success'] = "no";
    }elseif(get_member_status($uid)<2 && $post['price']>$data['PaymentMaxSum']) {
        $array_reponse['errors']['prix'] ="Prix pour de donation doit être inférieur à".
        " {$data['PaymentMaxSum']} {$data['Currency']}  ".
        " parce que votre compte ne pas encore vérifié";
        $array_reponse['success'] = "no";
    }

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

    $post = compact('nom', 'prix', 'ureturn', 'unotify', 'ucancel', 'button');

    if($array_reponse['success']=="yes" && $donation_id=="") { //add
        $insert = insert_product($user_id, 2, $post);
        if(!$insert) {
            $array_reponse['errors']['edit_donation'] = "Erreur interne!";
        }else{
            $array_reponse['title'] = "Ajouter une donation";
            $array_reponse['description'] = "Donation ajouté avec succès";
        }
    }else if($array_reponse['success']=="yes" && $donation_id!="") { //edit
        $update = update_product($donation_id, $post);
        if(!$update) {
            $array_reponse['errors']['edit_donation'] = "Erreur interne!";
        }else{
            $array_reponse['title'] = "Modifier une donation";
            $array_reponse['description'] = "Donation modifié avec succès";
        }
    }

}

//***** Mode: delete donation *****//
if($mode=="delete") {
    $donation_id = !empty($_GET['donation_id'])? clean_var($_GET['donation_id']):clean_var($_POST['donation_id']);

    $array_reponse = array( 'errors' => array(
                            'edit_donation' => ''),
                          'success'=>'yes' );

    $result = delete_product($donation_id);

    if(!$result) {
        $array_reponse['errors']['edit_donation'] = "Erreur de suppression";
        $array_reponse['success'] = "no";
    }

}


echo json_encode($array_reponse);
