<?php
//Secret
// by: Yacine Ait Chalal -> 02/10/2017
// Link for test https://v2.edinars.net/api/v1/confirm_mobile.php?mobile=&mem_id=
// 
header('Content-Type: application/json');

define("DIR_ROOT", "../../");

require DIR_ROOT.'includes/All_files.php';

$array_reponse = array( 'errors' => array('confirm_mobile'=>''),
                        'success'=>'yes' );

$mobile = !empty($_GET['mobile'])? clean_var($_GET['mobile']):clean_var($_POST['mobile']);


$mobile = "0".substr($mobile, 4, strlen($mobile)-3);



$code  = !empty($_GET['message'])? clean_var($_GET['message']):clean_var($_POST['message']);
$server  = !empty($_GET['server'])? clean_var($_GET['server']):clean_var($_POST['server']);
$port  = !empty($_GET['port'])? clean_var($_GET['port']):clean_var($_POST['port']);
$time  = !empty($_GET['time'])? clean_var($_GET['time']):clean_var($_POST['time']);


$user_infos = get_member_info_by_mobile_code($mobile, $code);
$user_infos['mobile'] = str_replace(" ", "", $user_infos['mobile']);
$user_id = $user_infos['id'];

if(!$mobile) {
    $array_reponse['errors']['confirm_mobile']="Numéro de téléphone incorrect";
    $array_reponse['success'] = "no";
}elseif(!$code || !$user_id) {
    $array_reponse['errors']['confirm_mobile']="Numéro de compte incorrect";
    $array_reponse['success'] = "no";
}elseif ($user_infos['mobile']!=$mobile) {
    $array_reponse['errors']['confirm_mobile']="Numéro de téléphone introuvable ".$user_infos['mobile']." -> ".$mobile;
    $array_reponse['success'] = "no";
}

// --> Output
if($array_reponse['success']=="yes") {
    if($user_infos['type'] == 0) {
        $post['status'] = 1;
    }

    $post['confirm_mobile'] = 1;
    $edit_profile = update_my_profile($post, $user_id, false);

    if($edit_profile) {
        //insert notification
        $array_infos['member_id'] = $user_id;
        $array_infos['type'] = "message";
        $array_infos['sender_id'] = "-1";
        $array_infos['hide_in_list'] = "yes";
        $array_infos['message']  = "<p>Votre numéro mobile <b>".$mobile."</b> a été bien confirmé</p>";
        $array_infos['message'] .= "<p>Vous allez recevoir un email avec le reste de code pin</p>";
        $array_infos['message'] .= '<p class="text-center">Code pin : <b>'.$user_infos['pin_code'].'</b></p>';

        insert_notification($array_infos);
    }else{
        $array_reponse['errors']['confirm_mobile']="Erreur interne";
        $array_reponse['success'] = "no";
    }
}

echo json_encode($array_reponse);
