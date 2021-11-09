<?php
header('Content-Type: application/json');

define("DIR_ROOT", "../../");
require DIR_ROOT.'includes/All_files.php';

$newuser = isset($_REQUEST['newuser']) ? clean_var($_REQUEST['newuser']) : '';
$newmail = isset($_REQUEST['newmail']) ? clean_var($_REQUEST['newmail']) : '';
$newpass = isset($_REQUEST['newpass']) ? clean_var($_REQUEST['newpass']) : '';
$cfmpass = isset($_REQUEST['cfmpass']) ? clean_var($_REQUEST['cfmpass']) : '';
$newques = isset($_REQUEST['newques']) ? clean_var($_REQUEST['newques']) : '';
$newansw = isset($_REQUEST['newansw']) ? clean_var($_REQUEST['newansw']) : '';
$newtype = isset($_REQUEST['newtype']) ? clean_var($_REQUEST['newtype']) : '';

$array_reponse = array( 'errors' => array(
                          'newmail' => '',
                          'newpass' => '',
                          'cfmpass' => '',
                          'newques' => '',
                          'newansw' => '',
                          'register' => ''),

                        'success'=>'yes');

//newmail
if($newmail == '') {
    $array_reponse['errors']['newmail'] = 'Veuillez saisir votre email!';
    $array_reponse['success']="no";

}elseif(!is_mail_available($newmail)) {
    $array_reponse['errors']['newmail'] = 'Cette adresse email est déjà utilisée';
    $array_reponse['success']="no";
}


//newpass
if($newpass == '') {
    $array_reponse['errors']['newpass'] = "Veuillez saisir votre mot de passe";
    $array_reponse['success']="no";
}elseif(strlen($newpass)<$data['PassLen']) {
    $array_reponse['errors']['newpass'] = "Votre mot de passe doit avoir au moins {$data['PassLen']} caract&eacute;re";
    $array_reponse['success']="no";
}elseif($cfmpass == '') {
    $array_reponse['errors']['cfmpass'] = "Veuillez répéter votre mot de passe !";
    $array_reponse['success']="no";
}elseif($cfmpass != $newpass) {
    $array_reponse['errors']['cfmpass'] = "Les mots de passe ne correspondent pas!";
    $array_reponse['success']="no";
}

////////////////////////////////////////////

//register ()
if($array_reponse['success']=="yes") {

    $create = create_confirmation($newpass, $newques, $newansw, $newmail, $newtype);

    if(!$create) {
        $array_reponse['errors']['register']="Erreur interne !";
        $array_reponse['success']="no";
    }
}

echo json_encode($array_reponse);