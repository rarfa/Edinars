<?php
// Created by: Yacine Ait Chalal -> 12/07/2017
// 
header('Content-Type: application/json');

define("DIR_ROOT", "../../");

require DIR_ROOT.'includes/All_files.php';

// security
require 'verif_user.php';
require 'verif_csrf_token.php';



$company = !empty($_GET['company'])? clean_var($_GET['company']):clean_var($_POST['company']);
$nrc = !empty($_GET['nrc'])? clean_var($_GET['nrc']):clean_var($_POST['nrc']);
$nnif = !empty($_GET['nnif'])? clean_var($_GET['nnif']):clean_var($_POST['nnif']);
$nart = !empty($_GET['nart'])? clean_var($_GET['nart']):clean_var($_POST['nart']);
$nfis = !empty($_GET['nfis'])? clean_var($_GET['nfis']):clean_var($_POST['nfis']);


$array_reponse = array( 'errors' => array('company' => '',
                          'nrc' => '',
                          'nnif' => '',
                          'nart' => '',
                          'nfis' => '',
                          'edit_entreprise' => ''),
                        'success'=>'yes' );



$info_user = select_info($user_id, $post);





// var_dump($return_identification);

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

    $post['company'] = $company;
    $post['nrc'] = $nrc;
    $post['nnif'] = $nnif;
    $post['nart'] = $nart;
    $post['nfis'] = $nfis;




    $edit_entreprise = update_my_profile($post, $user_id);

    // $array_reponse['user'] = get_member_info($user_id);

    $update_my_profile_empty = update_my_profile_empty($user_id);

    if(!$edit_entreprise || !$update_my_profile_empty) {
        $array['errors']['edit_entreprise'] = "Erreur interne !!";
        $array['success']="no";
    }

}

echo json_encode($array_reponse);
