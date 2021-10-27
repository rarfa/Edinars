<?php
// Created by: Yacine Ait Chalal -> 12/07/2017
#############################################################
header('Content-Type: application/json');

define("DIR_ROOT", "../../");

include(DIR_ROOT.'includes/All_files.php');

// security
include('verif_user.php');
include('verif_csrf_token.php');


$address = !empty($_GET['address'])? clean_var($_GET['address']):clean_var($_POST['address']);
$city = !empty($_GET['city'])? clean_var($_GET['city']):clean_var($_POST['city']);
$postcode = !empty($_GET['postcode'])? clean_var($_GET['postcode']):clean_var($_POST['postcode']);
$wilaya = !empty($_GET['wilaya'])? clean_var($_GET['wilaya']):clean_var($_POST['wilaya']);


$array_reponse = array( 'errors'=> array(
                          'address' => '',
                          'city' => '',
                          'postcode' => '',
                          'wilaya' => '',
                          'edit_address' => ''),
                        'success'=>'yes' );

$info_user = select_info($user_id, $post);





// var_dump($return_identification);

if(!$address){
	$array_reponse['errors']['address'] = "Veuillez saisir votre adresse";
	$array_reponse['success'] = "no";
}

if($city == '') {
  $array_reponse['errors']['city'] = "Veuillez saisir votre commune";
  $array_reponse['success']="no";
}

if($postcode == ''){
  $array_reponse['errors']['postcode'] = "Veuillez saisir votre code postal";
  $array_reponse['success']="no";
}

if($wilaya == ''){
  $array_reponse['errors']['wilaya'] = "Veuillez sélectionner votre wilaya";
  $array_reponse['success']="no";
}

if($array_reponse['success']=="yes"){

  $post['address'] = $address;
  $post['city'] = $city;
  $post['postcode'] = $postcode;
  $post['wilaya'] = $wilaya;


  $edit_address = update_my_profile($post, $user_id);

  $update_my_profile_empty = update_my_profile_empty($user_id);

  if(!$edit_address || !$update_my_profile_empty){
    $array['errors']['edit_address'] = "Erreur interne !!";
    $array['success']="no";
  }

}

echo json_encode ($array_reponse);

?>
