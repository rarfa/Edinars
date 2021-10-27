<?php
// Created by: Yacine Ait Chalal -> 12/07/2017
#############################################################
header('Content-Type: application/json');

define("DIR_ROOT", "../../");

include(DIR_ROOT.'includes/All_files.php');

// security
include('verif_user.php');
include('verif_csrf_token.php');




// 'type_account_id' => $array_imp[0]['type'],

$show_pin_code_password = !empty($_GET['show_pin_code_password'])? clean_var($_GET['show_pin_code_password']):clean_var($_POST['show_pin_code_password']);


$array_reponse = array( 'errors'=> array(
                          'show_pin_code_password' => '',
                          'show_pin_code' => ''
                        ),
                        'success'=>'yes' );



$info_user = select_info($user_id, $post);


if ($info_user['confirm_mobile'] != 1) {
  $array_reponse['errors']['show_pin_code'] = "Vous devez confirmer votre numéro de mobile pour pouvoir afficher votre code PIN";
  $array_reponse['success']="no";
}


if($show_pin_code_password == ''){
  $array_reponse['errors']['show_pin_code_password'] = "Veuillez saisir votre mot de passe";
  $array_reponse['success']="no";
}elseif (get_member_id($info_user["email"], $show_pin_code_password)==0) {
  $array_reponse['errors']['show_pin_code_password'] = "Mot de passe incorrect";
  $array_reponse['success']="no";
}


if($array_reponse['success']=="yes"){//if no errors

  $array_reponse['pin_code'] = $info_user["pin_code"];

}

echo json_encode ($array_reponse);

?>
