<?php
// Created by: Yacine Ait Chalal -> 12/07/2017
#############################################################
header('Content-Type: application/json');

define("DIR_ROOT", "../../");

include(DIR_ROOT.'includes/All_files.php');

// security
include('verif_user.php');
include('verif_csrf_token.php');


$old_password = !empty($_GET['old_password'])? clean_var($_GET['old_password']):clean_var($_POST['old_password']);
$new_password = !empty($_GET['new_password'])? clean_var($_GET['new_password']):clean_var($_POST['new_password']);
$retyped_new_password = !empty($_GET['retyped_new_password'])? clean_var($_GET['retyped_new_password']):clean_var($_POST['retyped_new_password']);


$array_reponse = array( 'errors'=>array(
                          'old_password' => '',
                          'new_password' => '',
                          'retyped_new_password' => '',
                          'edit_password' => ''),
                        'success'=>'yes' );



$info_user = select_info($user_id, $post);
$return_identification = get_member_id($info_user['email'], $old_password);




// var_dump($return_identification);

if(!$old_password){
	$array_reponse['errors']['old_password'] = "Veuillez saisir l'ancien mot de passe";
	$array_reponse['success'] = "no";
}elseif(!$return_identification){
	$array_reponse['errors']['old_password'] = "Le mot de passe que vous avez entré est incorrect";
	$array_reponse['success'] = "no";
}

if($new_password == '') {
  $array_reponse['errors']['new_password'] = "Veuillez saisir le nouveau mot de passe";
  $array_reponse['success']="no";
}elseif(strlen($new_password) < $data['PassLen']){
  $array_reponse['errors']['new_password'] = "Votre nouveau mot de passe doit avoir au moins {$data['PassLen']} caract&eacute;re";
  $array_reponse['success']="no";
}elseif($retyped_new_password == ''){
  $array_reponse['errors']['retyped_new_password'] = "Veuillez resaisir le nouveau mot de passe";
  $array_reponse['success']="no";
}elseif($retyped_new_password != $new_password){
  $array_reponse['errors']['retyped_new_password'] = "Les mots de passe ne correspondent pas!";
  $array_reponse['success']="no";
}

if($array_reponse['success']=="yes"){

  $CrypPassword =  strtoupper(md5($new_password.'|'.$info_user['mem_id']));

  $sql_edit = mysql_query("UPDATE `{$data['DbPrefix']}members` SET
                          `password` = '".$CrypPassword."'
                          WHERE id  = '".$return_identification."';");


  if(!$sql_edit){
    $array['errors']['edit_password'] = "Erreur de modification de mot de passe !!";
    $array['success']="no";
  }

}

echo json_encode ($array_reponse);

?>
