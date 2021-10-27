<?php
header('Content-Type: application/json');

define("DIR_ROOT", "../../");

include(DIR_ROOT.'includes/All_files.php');


// tmp generate code pin
// $array =db_rows("SELECT * FROM `{$data['DbPrefix']}members`");
//
// foreach ($array as $key => $value) {
//   # code...
//   $pin_code = generate_pin_code(4);
//   $sql = " UPDATE `{$data['DbPrefix']}members` SET ";
//   $sql .= " pin_code = '{$pin_code}' ";
//   $sql .= " WHERE `id`={$array[$key]['id']} ";
//
//   $edit_profile = db_query($sql);
//   if($edit_profile)
//     echo "edit profile -> yes = ".$array[$key]['id']."<br>";
//   else
//     echo "edit profile -> no = ".$array[$key]['id']."<br>";
// }
// exit;



// security
include('verif_user.php');

$array_imp =db_rows("SELECT * FROM `{$data['DbPrefix']}members`".
                    " WHERE `id`={$user_id}");

if($post['status']<2){
  $status_color = "#FF0000"; //non color red
}else {
  $status_color = "#73be28"; //yes color green
}

$emails_list = get_email_details($user_id, false, false);

//
if($array_imp[0]['confirm_mobile_code'] == ""){
  $array_imp[0]['confirm_mobile_code'] = $confirm_mobile_code = generate_pin_code(6);

  $sql = " UPDATE `{$data['DbPrefix']}members` SET ";
  $sql .= " confirm_mobile_code = '{$confirm_mobile_code}' ";
  $sql .= " WHERE `id`={$user_id} ";

  $edit_profile = db_query($sql);
}

//reponse
$array_reponse = array( 'user_id' => $user_id,
                        'mem_id' => $array_imp[0]['mem_id'],
                        'prehashkey' => get_member_username_hashkey($user_id),
                        'phone' => $array_imp[0]['phone'],
                        'mobile' => $array_imp[0]['mobile'],
                        'confirm_mobile' => $array_imp[0]['confirm_mobile'],
                        'confirm_mobile_code' => $array_imp[0]['confirm_mobile_code'],
                        'confirmation_mobile_number' => $data['confirmation_mobile_number'],
                        'fax' => $array_imp[0]['fax'],
                        'firstname' => unhtmlentities($array_imp[0]['fname']),
                        'lastname'=>unhtmlentities($array_imp[0]['lname']),
                        'address'=>unhtmlentities($array_imp[0]['address']),
                        'city'=>unhtmlentities($array_imp[0]['city']),
                        'postcode'=>utf8_encode($array_imp[0]['postcode']),
                        'wilaya'=>($array_imp[0]['wilaya']),
                        'email'=> $array_imp[0]['email'],
                        'solde' => select_balance($user_id),
                        'solde_disponible' => select_balance_disponible($user_id),
                        'derniere_connexion' => $last_activity,
                        'status' => unhtmlentities($data['MemberStatus'][$array_imp[0]['status']]['status']),
                        'status_color' => $status_color,
                        'type_account' => utf8_encode($data['MemberType'][$array_imp[0]['type']]),
                        'type_account_id' => $array_imp[0]['type'],
                        'company'=> $array_imp[0]['company'],
                        'nrc'=> $array_imp[0]['nrc'],
                        'nnif'=> $array_imp[0]['nnif'],
                        'nart'=> $array_imp[0]['nart'],
                        'nfis'=> $array_imp[0]['nfis'],
                        'question'=> $array_imp[0]['question'],
                        'emails_list'=> $emails_list,
                        'empty' => $array_imp[0]['empty'],
                        'success'=>'yes'
);

//generated_csrf_token
$generated_csrf_token = generate_csrf_token();

$update_csrf_token = update_csrf_token($user_id, $generated_csrf_token);

if(!$update_csrf_token){
  $array_reponse['success'] = "no";
}else{
  $array_reponse['csrf_token'] = $generated_csrf_token;
}


// Menu
$mm=0;
$array_reponse['menu'] = [
  $mm++ => array("id" => "mon_compte", "title" => "Mon compte", "icon" => "fa-user-circle-o", "type" => "link", "action" => "./"),
  // $mm++ => array("id" => "paiement", "title" => "Paiement", "icon" => "fa-money", "type" => "mb", "action" => "mb-paiement"),
  $mm++ => array("id" => "services", "title" => "Services", "icon" => "fa-shopping-cart", "type" => "mb", "action" => "mb-services")
];
if($array_imp[0]['type']==1){ //pro
  $array_reponse['menu'] += [
    $mm++ => array("id" => "traders", "title" => "Marchants", "icon" => "fa-shopping-basket", "type" => "mb", "action" => "mb-traders"),
    $mm++ => array("id" => "generate_order", "title" => "Générer une commande", "icon" => "fa-shopping-bag", "type" => "link", "action" => "./#generate_order/"),
  ];
}
if($array_imp[0]['type']==2 || $array_imp[0]['type']==3){ // grossiste ou détallant
  $array_reponse['menu'] += [
    $mm++ => array("id" => "load_account", "title" => "Recharger un compte", "icon" => "fa-sitemap", "type" => "link", "action" => "./#load_account/"),
  ];
}


$array_reponse['menu'] += [
  $mm++ => array("id" => "history", "title" => "Historique", "icon" => "fa-newspaper-o", "type" => "link", "action" => "./#history/"),
  $mm++ => array("id" => "settings", "title" => "Paramètres", "icon" => "fa-cog", "type" => "mb", "action" => "mb-settings"),
  $mm++ => array("id" => "settings", "title" => "Identity", "icon" => "fa-qrcode", "type" => "mb", "action" => "mb-identity"),
  $mm++ => array("id" => "logout", "title" => "Déconnexion", "icon" => "fa-sign-out", "type" => "mb", "action" => "mb-logout")
];


// menu App
$mm=0;
$array_reponse['menu_app'] = [
  $mm++ => array("title" => "Mon compte", "icon" => "md-contact", "page" => "HomePage"),
];

// $array_reponse['menu_app'] += [
//   $mm++ => array("title" => "Paiement", "icon" => "md-cash", "page" => "PaiementPage"),
// ];
if($array_imp[0]['type']==1){ //pro
  $array_reponse['menu_app'] += [
    $mm++ => array("title" => "Générer une commande", "icon" => "md-basket", "page" => "GenerateOrderPage"),
  ];
}
if($array_imp[0]['type']==2 || $array_imp[0]['type']==3){ // grossiste ou détallant
  $array_reponse['menu_app'] += [
    $mm++ => array("title" => "Recharger un compte", "icon" => "md-share", "page" => "LoadAccountPage"),
  ];
}

$array_reponse['menu_app'] += [
  $mm++ => array("title" => "Services", "icon" => "md-cart", "page" => "ServicePage"),
  $mm++ => array("title" => "Historique", "icon" => "md-paper", "page" => "HistoryPage"),
  $mm++ => array("title" => "Paramètres", "icon" => "md-settings", "page" => "SettingsPage"),
  $mm++ => array("title" => "Identité", "icon" => "md-finger-print", "page" => "IdentityPage"),
  $mm++ => array("title" => "Informations", "icon" => "md-information-circle", "page" => "InformationsPage"),
];

// 5 derniers trasactions
$_array = get_transactions($user_id, 'both', -1, 2, 0, 5);

foreach ($_array as $key => $value) {
	foreach ($value as $key_2 => $value_2) {
		if(!is_array($value_2)){
			$array_reponse['last_transactions'][$key][$key_2] = strip_tags(utf8_encode($value_2));
		}
	}
}

// Paiements en instance
$_array = get_transactions($user_id, 'both', -1, 1, 0, 5);
foreach ($_array as $key => $value) {
  foreach ($value as $key_2 => $value_2) {
    if(!is_array($value_2)){
      $array_reponse['pending_payments'][$key][$key_2] = strip_tags(utf8_encode($value_2));
    }
  }
}

// consts
$array_reponse['wilayas'] = ($data['Wilayas']);

$array_reponse['questions'] = ($data['question']);

$array_reponse['recharge_types'] = ($data['recharge_type']);
$array_reponse['transaction_types'] = ($data['TransactionType']);


//consts
// $wilayas = $data['Wilayas'];
// unset($wilayas['']);
// $array_reponse['system_consts']['wilayas'] = $wilayas;

// $array_reponse['system_consts']['member_type'] = $data['MemberType'];
// $_array_reponse['la_liste'] = array();

// $_array_reponse[strip_tags('fdsfdsfds')] = array(  strip_tags('wilayas')=>strip_tags('eee'),
//                                                   strip_tags('member_type')=>strip_tags('ddd'));


// var_dump($emails_list);
// echo "-----------------------";
// var_dump(array($data['Wilayas']));
echo json_encode($array_reponse);




// var_dump($array_reponse);
// header('Content-Type: application/json; Charset="UTF-8"');
// echo json_encode($array_reponse);

?>
