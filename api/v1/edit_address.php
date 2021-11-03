<?php
// Created by: Yacine Ait Chalal -> 12/07/2017
// 
header('Content-Type: application/json');

define("DIR_ROOT", "../../");

require DIR_ROOT.'includes/All_files.php';

// security
require 'verif_user.php';
require 'verif_csrf_token.php';


$address    = isset($_REQUEST['address'])   ? clean_var($_REQUEST['address'])   : '';
$city       = isset($_REQUEST['city'])      ? clean_var($_REQUEST['city'])      : '';
$postcode   = isset($_REQUEST['postcode'])  ? clean_var($_REQUEST['postcode'])  : '';
$wilaya     = isset($_REQUEST['wilaya'])    ? clean_var($_REQUEST['wilaya'])    : '';


$array_reponse = array( 'errors'=> array(
                          'address' => '',
                          'city' => '',
                          'postcode' => '',
                          'wilaya' => '',
                          'edit_address' => ''),
                        'success'=>'yes' );


if(!$address) {
    $array_reponse['errors']['address'] = "Veuillez saisir votre adresse";
    $array_reponse['success'] = "no";
}

if($city == '') {
    $array_reponse['errors']['city'] = "Veuillez saisir votre commune";
    $array_reponse['success']="no";
}

if($postcode == '') {
    $array_reponse['errors']['postcode'] = "Veuillez saisir votre code postal";
    $array_reponse['success']="no";
}

if($wilaya == '') {
    $array_reponse['errors']['wilaya'] = "Veuillez sélectionner votre wilaya";
    $array_reponse['success']="no";
}

if($array_reponse['success']=="yes") {

    $info_user = select_info($user_id, $post);

    $post['address']    = $address;
    $post['city']       = $city;
    $post['postcode']   = $postcode;
    $post['wilaya']     = $wilaya;
    $post['fullname']   = $info_user['lname'] . " " . $info_user['fname'];

    // perform update
    $edit_address            = update_my_profile($post, $user_id);
    $update_my_profile_empty = update_my_profile_empty($user_id);

    if(!$edit_address || !$update_my_profile_empty) {
        $array['errors']['edit_address'] = "Erreur interne !!";
        $array['success'] = "no";
    }

}

echo json_encode($array_reponse);