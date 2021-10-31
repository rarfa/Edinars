<?php

// Created by: Yacine Ait Chalal -> 12/07/2017
header('Content-Type: application/json');

define("DIR_ROOT", "../../");

require DIR_ROOT . 'includes/All_files.php';

// security
require 'verif_user.php';
require 'verif_csrf_token.php';

$mode =  isset($_REQUEST['mode']) ? clean_var($_REQUEST['mode']) : '';


//***** Mode: Add new email *****//
if ($mode == "add") {
    $newmail = isset($_REQUEST['newmail']) ? clean_var($_REQUEST['newmail']) : '';

    $array_reponse = array( 'errors' => array(
                            'newemail'   => '',
                            'edit_email' => ''),
                            'success'    => 'yes' );

    $result = add_email($user_id, $newmail);

    if (!$newmail) {
        $array_reponse['errors']['newmail'] = "Veuillez saisir votre adresse email";
        $array_reponse['success'] = "no";
    } elseif ($result == INVALID_EMAIL_ADDRESS) {
        $array_reponse['errors']['edit_email'] = "L'adresse E-mail que vous avez entré n'est pas valide";
        $array_reponse['success'] = "no";
    } elseif ($result == EMAIL_EXISTS) {
        $array_reponse['errors']['edit_email'] = "L'adresse E-mail que vous avez entré est en usage dans le systeme";
        $array_reponse['success'] = "no";
    } elseif ($result == TOO_MANY_EMAILS) {
        $array_reponse['errors']['edit_email'] = "Vous ne pouvez pas ajouter plus de {$data['maxemails']} adresses E-mail";
        $array_reponse['success'] = "no";
    } elseif ($result == DB_ERROR) {
        $array_reponse['errors']['edit_email'] = "Une erreur temporaire s'est produite, veillez réessayer plus tard";
        $array_reponse['success'] = "no";
    }
}

//***** Mode: set primary email *****//
if ($mode == "primary") {
    $email = isset($_REQUEST['email']) ? clean_var($_REQUEST['email']) : '';

    $array_reponse = array( 'errors' => array(
    'email'      => '',
    'edit_email' => ''),
    'success'    => 'yes' );

    $result = make_email_prim($user_id, $email);

    if (!$email) {
        $array_reponse['errors']['email'] = "Veuillez saisir votre adresse email";
        $array_reponse['success'] = "no";
    } elseif ($result == INVALID_EMAIL_ADDRESS) {
        $array_reponse['errors']['edit_email'] = "L'adresse E-mail que vous avez entré n'est pas valide";
        $array_reponse['success'] = "no";
    } elseif ($result == ALREADY_PRIMARY) {
        $array_reponse['errors']['edit_email'] = "L'adresse E-mail que vous avez sélectionnée; est déja votre adresse principale";
        $array_reponse['success'] = "no";
    } elseif ($result == EMAIL_NOT_ACTIVE) {
        $array_reponse['errors']['edit_email'] = "L'adresse E-mail que vous avez sélectionnée n'est pas actif, Veillez activer le et re-essayez";
        $array_reponse['success'] = "no";
    } elseif ($result == EMAIL_NOT_FOUND) {
        $array_reponse['errors']['edit_email'] = "L'adresse E-mail que vous avez sélectionnée n'est pas trouvée; dans le systeme";
        $array_reponse['success'] = "no";
    }
}

//***** Mode: delete email *****//
if ($mode == "delete") {
    $email = isset($_REQUEST['email']) ? clean_var($_REQUEST['email']) : '';

    $array_reponse = array( 'errors' => array(
    'email'         => '',
    'edit_email'    => ''),
    'success'       => 'yes' );

    $result = delete_member_email($user_id, $email);

    if (!$email) {
        $array_reponse['errors']['email'] = "Veuillez saisir votre adresse email";
        $array_reponse['success'] = "no";
    } elseif ($result == INVALID_EMAIL_ADDRESS) {
        $array_reponse['errors']['edit_email'] = "L'adresse E-mail que vous avez entré n'est pas valide";
        $array_reponse['success'] = "no";
    } elseif ($result == CANNOT_DELETE_PRIMARY) {
        $array_reponse['errors']['edit_email'] = "L'adresse E-mail que vous avez sélectionnée; est déja votre adresse principale";
        $array_reponse['success'] = "no";
    } elseif ($result == EMAIL_NOT_FOUND) {
        $array_reponse['errors']['edit_email'] = "Vous ne pouvez pas supprimer l'adresse E-mail principale ";
        $array_reponse['success'] = "no";
    }

}


echo json_encode($array_reponse);
