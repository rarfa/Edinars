<?php
// Created by: Yacine Ait Chalal -> 12/07/2017
// 
header('Content-Type: application/json');

define("DIR_ROOT", "../../");

require DIR_ROOT.'includes/All_files.php';

// security
require 'verif_user.php';
require 'verif_csrf_token.php';



$company    = isset($_REQUEST['company']) ? clean_var($_REQUEST['company']) : '';
$nrc        = isset($_REQUEST['nrc']) ? clean_var($_REQUEST['nrc']) : '';
$nnif       = isset($_REQUEST['nnif']) ? clean_var($_REQUEST['nnif']) : '';
$nart       = isset($_REQUEST['nart']) ? clean_var($_REQUEST['nart']) : '';
$nfis       = isset($_REQUEST['nfis']) ? clean_var($_REQUEST['nfis']) : '';


$array_reponse = array( 'errors' => array('company' => '',
                          'nrc' => '',
                          'nnif' => '',
                          'nart' => '',
                          'nfis' => '',
                          'edit_entreprise' => ''),
                        'success'=>'yes' );



if(!$company) {
    $array_reponse['errors']['company'] = "Veuillez saisir le nom de votre société";
    $array_reponse['success'] = "no";

}elseif($nrc == '') {
    $array_reponse['errors']['nrc'] = "Veuillez saisir le N° RC";
    $array_reponse['success']="no";

}elseif($nnif == '') {
    $array_reponse['errors']['nnif'] = "Veuillez saisir le N° NIF";
    $array_reponse['success']="no";

}elseif($nart == '') {
    $array_reponse['errors']['nart'] = "Veuillez saisir le N° ART";
    $array_reponse['success']="no";

}elseif($nfis == '') {
    $array_reponse['errors']['nfis'] = "Veuillez saisir le N° FIS";
    $array_reponse['success']="no";

}else {

    $info_user = select_info($user_id, $post);

    $post['company']    = $company;
    $post['nrc']        = $nrc;
    $post['nnif']       = $nnif;
    $post['nart']       = $nart;
    $post['nfis']       = $nfis;
    $post['fullname']   = $info_user['lname'] . " " . $info_user['fname'];

    $edit_entreprise         = update_my_profile($post, $user_id);
    $update_my_profile_empty = update_my_profile_empty($user_id);

    if(!$edit_entreprise || !$update_my_profile_empty) {
        $array['errors']['edit_entreprise'] = "Erreur interne !!";
        $array['success']="no";
    }
}

echo json_encode($array_reponse);
