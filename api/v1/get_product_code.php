<?php
// Created by: Yacine Ait Chalal -> 18/09/2017
#############################################################
header('Content-Type: application/json');

define("DIR_ROOT", "../../");

include(DIR_ROOT.'includes/All_files.php');

// security
include('verif_user.php');

$array_reponse = array( 'code_post'=> '',
                        'code_get'=> '',
                        'success'=>'yes' );

$product_id = !empty($_GET['product_id'])? clean_var($_GET['product_id']):clean_var($_POST['product_id']);

$product = select_products($user_id, 0, $product_id, true);

if($product_id==""){
  $array_reponse['errors']['get_product_code'] = "Veuillez entrer le produit ID";
  $array_reponse['success'] = "no";
}elseif($product[0]['id']==""){
  $array_reponse['errors']['get_product_code'] = "Produit n'existe pas!";
  $array_reponse['success'] = "no";
}

if($array_reponse['success']=="yes"){
  //code

  $paths=array(0=>$data['SinBtns'],1=>$data['SubBtns'],2=>$data['DonBtns']);

  $type=select_type($product_id);
  $tname=$data['PaymentType'][$type];

  $button=select_button($product_id);

  $strToCrypt = "action={$tname}|" ;
  $strToCrypt .= "identifiant=".get_member_username($user_id)."|" ;
  $strToCrypt .= "produit=".$product_id ;

  $strToCrypt = encryptPerHashKey (get_member_username_pincode($user_id) , $strToCrypt)  ;


  $post['PostHtmlCode']=
  "<!-- {$data['SiteName']} FORMULAIRE DE PAIEMENT METHODE POST-->\n".
  "<form method='post' action='{$data['Host']}/edinars-paiments.html' target='new'>\n".
  "<input type='hidden' name='pincode'  value='".get_member_username_pincode($user_id)."'>\n".
  "<input type='hidden' name='prehashkey'  value='".get_member_username_hashkey($user_id)."'>\n".
  "<input type='hidden' name='crypt'  value='".$strToCrypt."'>\n".
  "<input type='image' src='{$paths[$type]}/{$button}' >\n".
  "</form>\n".
  "<!-- {$data['SiteName']}  FORMULAIRE DE PAIEMENT -->"
  ;

  $post['OrgPostHtml']=$post['PostHtmlCode'];
  $post['PostHtmlCode']=htmlspecialchars($post['PostHtmlCode'], ENT_QUOTES);
  $post['GetHtmlCode']=
  "<!-- {$data['SiteName']} FORMULAIRE DE PAIEMENT  METHODE GET-->\n".
  "<a href={$data['Host']}/edinars-paiments.html?pincode=".get_member_username_pincode($user_id)."&prehashkey=".get_member_username_hashkey($user_id)."&crypt=".$strToCrypt."&send=yes target=new>\n".
  "<img src={$paths[$type]}/{$button} >\n".
  "</a>".
  "\n<!-- {$data['SiteName']} FORMULAIRE DE PAIEMENT -->"
  ;
  $post['OrgGetHtml']=$post['GetHtmlCode'];
  if($post['status']=='crypt'){
    $post['GetHtmlCode']=
    "<!-- {$data['SiteName']} FORMULAIRE DE PAIEMENT -->\n".
    encrypt($post['GetHtmlCode']).
    "\n<!-- {$data['SiteName']} FORMULAIRE DE PAIEMENT -->"
    ;
  }
  $post['GetHtmlCode']=htmlspecialchars($post['GetHtmlCode'], ENT_QUOTES);
  //$post['BackPage']=$post['action'];

  $array_reponse['code_post'] = $post['PostHtmlCode'];
  $array_reponse['code_get'] = $post['GetHtmlCode'];

}


echo json_encode ($array_reponse);

?>
