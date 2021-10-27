<?php
// Created by: Yacine Ait Chalal -> 12/07/2017
#############################################################
header('Content-Type: application/json');

define("DIR_ROOT", "../../");

include(DIR_ROOT.'includes/All_files.php');

// security
include('verif_user.php');
include('verif_csrf_token.php');


$mode = !empty($_GET['mode'])? clean_var($_GET['mode']):clean_var($_POST['mode']);

//***** Mode: Add new product *****//
if($mode=="add"){
  $product_id = !empty($_GET['product_id'])? clean_var($_GET['product_id']):clean_var($_POST['product_id']);
  $nom = !empty($_GET['nom'])? clean_var($_GET['nom']):clean_var($_POST['nom']);
  $prix = !empty($_GET['prix'])? clean_var($_GET['prix']):clean_var($_POST['prix']);
  $tva = !empty($_GET['tva'])? clean_var($_GET['tva']):clean_var($_POST['tva']);
  $livraison = !empty($_GET['livraison'])? clean_var($_GET['livraison']):clean_var($_POST['livraison']);
  $ureturn = !empty($_GET['ureturn'])? clean_var($_GET['ureturn']):clean_var($_POST['ureturn']);
  $unotify = !empty($_GET['unotify'])? clean_var($_GET['unotify']):clean_var($_POST['unotify']);
  $ucancel = !empty($_GET['ucancel'])? clean_var($_GET['ucancel']):clean_var($_POST['ucancel']);
  $comments = !empty($_GET['comments'])? clean_var($_GET['comments']):clean_var($_POST['comments']);
  $button = !empty($_GET['button'])? clean_var($_GET['button']):clean_var($_POST['button']);

  $array_reponse = array( 'errors' => array(
                            'edit_product' => ''),
                          'success'=>'yes' );

  if($product_id!=""){
    $product = select_products($user_id, 0, $product_id, true);
    if($product[0]['id']==""){
      $array_reponse['errors']['edit_product'] = "Produit n'existe pas!";
      $array_reponse['success'] = "no";
    }
  }

  if(!$nom){
    $array_reponse['errors']['nom'] = "Veuillez saisir le nom de produit";
    $array_reponse['success'] = "no";
  }

  if(!$prix){
    $array_reponse['errors']['prix'] = "Veuillez saisir le prix de produit";
    $array_reponse['success'] = "no";
  }elseif($prix < $data['PaymentMinSum']){
    $array_reponse['errors']['prix'] = "Prix pour un produit ou un service doit être inférieur à".
			" {$data['PaymentMinSum']} {$data['Currency']}";
    $array_reponse['success'] = "no";
  }elseif(get_member_status($uid)<2 && $post['price']>$data['PaymentMaxSum']){
		$array_reponse['errors']['prix'] ="Prix pour de produit doit être inférieur à".
			" {$data['PaymentMaxSum']} {$data['Currency']}  ".
			" parce que votre compte ne pas encore vérifié";
    $array_reponse['success'] = "no";
	}

  // if(!$tva){
  //   $array_reponse['errors']['tva'] = "Veuillez saisir la tva";
  //   $array_reponse['success'] = "no";
  // }

  if(!$ureturn){
    $array_reponse['errors']['ureturn'] = "Veuillez saisir l'URL de Retour";
    $array_reponse['success'] = "no";
  }

  if(!$unotify){
    $array_reponse['errors']['unotify'] = "Veuillez saisir l'URL de Notification";
    $array_reponse['success'] = "no";
  }

  if(!$ucancel){
    $array_reponse['errors']['ucancel'] = "Veuillez saisir l'URL de Annulation";
    $array_reponse['success'] = "no";
  }

  if(!$button){
    $array_reponse['errors']['button'] = "Veuillez sélectionner l'image pour le bouton de paiement";
    $array_reponse['success'] = "no";
  }

  $post = compact('nom', 'prix', 'tva', 'livraison', 'ureturn', 'unotify', 'ucancel', 'comments', 'button');

  if($array_reponse['success']=="yes" && $product_id==""){ //add
    $insert = insert_product($user_id, 0, $post);
    if(!$insert){
      $array_reponse['errors']['edit_product'] = "Erreur interne!";
    }else{
      $array_reponse['title'] = "Ajouter un produit";
      $array_reponse['description'] = "Produit ajouté avec succès";
    }
  }else if($array_reponse['success']=="yes" && $product_id!=""){ //edit
    $update = update_product($product_id, $post);
    if(!$update){
      $array_reponse['errors']['edit_product'] = "Erreur interne!";
    }else{
      $array_reponse['title'] = "Modifier un produit";
      $array_reponse['description'] = "Produit modifié avec succès";
    }
  }

}

//***** Mode: delete product *****//
if($mode=="delete"){
  $product_id = !empty($_GET['product_id'])? clean_var($_GET['product_id']):clean_var($_POST['product_id']);

  $array_reponse = array( 'errors' => array(
                            'edit_product' => ''),
                          'success'=>'yes' );

  $result = delete_product($product_id);

  if(!$result){
    $array_reponse['errors']['edit_product'] = "Erreur de suppression";
    $array_reponse['success'] = "no";
  }

}


echo json_encode ($array_reponse);

?>
