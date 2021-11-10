<?php
// header('Content-Type: application/json');

// Created by: Yacine Ait Chalal -> 09/06/2017
// 

define("DIR_ROOT", "../../");

require DIR_ROOT.'includes/All_files.php';

// security
require 'verif_user.php';
require 'verif_csrf_token.php';


$array_reponse = array('errors' => array(
                              'phone' => '',
                              'amount' => '',
                              'type' => '',
                              'code_pin' => '',
                              'mobile_recharge' => ''),
                            'success'=>'yes');


$phone = !empty($_GET['phone'])? clean_var($_GET['phone']):clean_var($_POST['phone']);
$phone = str_replace(" ", "", $phone);
if(substr($phone, 0, 5)=="00213") { $phone = "0"+ substr($phone, 5, strlen($phone)-5);
}
if(substr($phone, 0, 4)=="+213") { $phone = "0"+ substr($phone, 4, strlen($phone)-4);
}

$amount  = !empty($_GET['amount'])? clean_var($_GET['amount']):clean_var($_POST['amount']);
$type  = !empty($_GET['type'])? clean_var($_GET['type']):clean_var($_POST['type']);
$post['recharge_type'] =  'credit';//$type;
$code_pin  = !empty($_GET['code_pin'])? clean_var($_GET['code_pin']):clean_var($_POST['code_pin']);


$post = select_info($user_id, $post);
$data['Balance'] = select_balance($user_id);
$data['Balance-disponible'] = select_balance_disponible($user_id);

if(!$phone) {
    $array_reponse['errors']['phone']="Numéro de téléphone incorrect";
    $array_reponse['success']="no";
}

if(!$amount || $amount < 30) {
    $array_reponse['errors']['amount']="Le montant est incorrect";
    $array_reponse['success']="no";
}elseif($amount+ $data['flexy_fee'] > $data['Balance-disponible']) {
    $array_reponse['errors']['mobile_recharge']="Votre solde est insuffisant pour effectuer cette transaction";
    $array_reponse['success']="no";
}

if(!$type) {
    $array_reponse['errors']['type']="Veuillez sélectionner le type";
    $array_reponse['success']="no";
}

if(!$code_pin || $code_pin!=$user_infos['pin_code']) {
    $array_reponse['errors']['code_pin'] = "Code PIN incorrect";
    $array_reponse['success']="no";
}


// --> Output
if($array_reponse['success']=="yes") {

    // phone
    $post['mobile_flexy'] = $phone;


    if(substr($post['mobile_flexy'], 0, 2)== "07") {
        $post['operator'] = "Djezzy";
    }elseif (substr($post['mobile_flexy'], 0, 2)== "06") {
        $post['operator'] = "Mobilis";
    }elseif (substr($post['mobile_flexy'], 0, 2)== "05") {
        $post['operator'] = "Ooredoo";
    }

    $post['fees'] = $data['flexy_fee'];
    $post['get_trx_id'] =  get_trx_id();
    $post['montant'] = $amount;
    $post['total'] = $post['montant'] - $post['fees'];

    $mcheckinfo  =" Mobile à Rechargé: ".addslashes($post['mobile_flexy'])." \r\n ";
    $mcheckinfo .=" Montant: ".$post['montant']." \r\n" ;
    $mcheckinfo .=" Operator: ".addslashes($post['operator'])." \r\n " ;


    // ediffuse API
    $URL  = "http://dzflex.edinars.dz/server/service.html?ussd=Recharge&type_recharge=";
    $URL .= $post['recharge_type']."&imei=1111111111&code=8163&mobile=".$post['mobile_flexy']."&montant_ussd=".$post['montant'];
    
    $Load_xml_ussd = simplexml_load_file($URL);
    // exit;
    if(!(string)$Load_xml_ussd->trx) {
        $array_reponse['errors']['mobile_recharge']=(string)$Load_xml_ussd->message;
        $array_reponse['success']="no";
    }else{
        // creating transaction
        transaction(
            $post['get_trx_id'],
            $user_id,
            -1,
            $post['montant'],
            $post['fees'],
            3,
            1,
            "Recharger (".addslashes($post['operator']).")",
            "Details de la transaction: ".$mcheckinfo
        );

        // creating USSD Request
        ussd(
            $user_id,
            mysqli_insert_id($data['cid']),
            $post['operator'],
            $post['mobile_flexy'],
            $post['montant'],
            0,
            $Load_xml_ussd->trx
        );

        // ajoutre un audit
        audit(
            "	Recharger (".addslashes($post['operator']).") ",
            $mcheckinfo,
            'flexy',
            $post['get_trx_id'],
            prnuser($user_id)
        );


        // $array_reponse['success'] = $data['status'];


        // deactive carte de recharge
        // $data['Balance'] = select_balance($user_id) ;
        // $data['Balance-disponible'] = select_balance_disponible($user_id);
        // $_SESSION['Balance'] = $data['Balance'] ;
        // $_SESSION['Balance-disponible'] = $data['Balance-disponible'] ;
        $post['uid'] = $user_id;
        // Email
        send_email('PAYMENT-FLEXY', $post);
        // $post['historic'] = true;
        // $post['operator'] = "";
        // $post['mobile_flexy'] = "";
        // $post['montant'] = "" ;

        $array_reponse['resever'] = nl2br($mcheckinfo);

        $array_reponse['phone'] = ($phone);
        $array_reponse['amount'] = ($amount);
    }



}

// $array_reponse = array( 'error'=> $data['error'],
//                                                 'success'=>$data['status'],
//                                               'resever'=> nl2br($mcheckinfo),
//                                                  'Balance'=>$data['Balance'],
//                                                  'Balance-disponible'=>$data['Balance-disponible']);

echo json_encode($array_reponse);
