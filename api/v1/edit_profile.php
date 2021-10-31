<?php
// Created by: Yacine Ait Chalal -> 12/07/2017
// 
header('Content-Type: application/json');

define("DIR_ROOT", "../../");

require DIR_ROOT.'includes/All_files.php';

// security
require 'verif_user.php';
require 'verif_csrf_token.php';




// 'type_account_id' => $array_imp[0]['type'],

$lastname = !empty($_GET['lastname'])? clean_var($_GET['lastname']):clean_var($_POST['lastname']);
$firstname = !empty($_GET['firstname'])? clean_var($_GET['firstname']):clean_var($_POST['firstname']);
$type_account = !empty($_GET['type_account'])? clean_var($_GET['type_account']):clean_var($_POST['type_account']);
$phone = !empty($_GET['phone'])? clean_var($_GET['phone']):clean_var($_POST['phone']);
$mobile = !empty($_GET['mobile'])? clean_var($_GET['mobile']):clean_var($_POST['mobile']);
$fax = !empty($_GET['fax'])? clean_var($_GET['fax']):clean_var($_POST['fax']);


$array_reponse = array( 'errors'=> array(
                          'lastname' => '',
                          'firstname' => '',
                          'type_account' => '',
                          'phone' => '',
                          'mobile' => '',
                          'fax' => '',
                          'edit_profile' => ''),
                        'success'=>'yes' );



$info_user = select_info($user_id, $post);


// var_dump($info_user);
// echo "empty = ".$info_user["empty"]."<br>";

if($info_user["empty"]!="0") {
    if(!$lastname) {
        $array_reponse['errors']['lastname'] = "Veuillez saisir votre nom";
        $array_reponse['success'] = "no";
    }

    if($firstname == '') {
        $array_reponse['errors']['firstname'] = "Veuillez saisir votre prénom";
        $array_reponse['success']="no";
    }

    if(is_null($type_account)) {
        $array_reponse['errors']['type_account'] = "Veuillez sélectionner le type de compte";
        $array_reponse['success']="no";
    }
}

if($mobile == '') {
    $array_reponse['errors']['mobile'] = "Veuillez saisir votre numéro mobile";
    $array_reponse['success']="no";
}


if($array_reponse['success']=="yes") {//if no errors

    if($info_user["empty"]!="0") {
        $post['fname'] = $firstname;
        $post['lname'] = $lastname;
        $post['type'] = $type_account;
    }

    $post['phone'] = $phone;

    if($mobile != $info_user['mobile']) {
        $post['mobile'] = $mobile;
    }

    $post['fax'] = $fax;

    $edit_profile = update_my_profile($post, $user_id);

    $update_my_profile_empty = update_my_profile_empty($user_id);


    if(!$edit_profile || !$update_my_profile_empty) {
        $array['errors']['edit_profile'] = "Erreur interne !!";
        $array['success']="no";
    }

}

echo json_encode($array_reponse);
