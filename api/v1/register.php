<?php
header('Content-Type: application/json');

define("DIR_ROOT", "../../");
include(DIR_ROOT.'includes/All_files.php');

$newuser = !empty($_GET['newuser'])? clean_var($_GET['newuser']):clean_var($_POST['newuser']);
$newmail = !empty($_GET['newmail'])? clean_var($_GET['newmail']):clean_var($_POST['newmail']);
$newpass = !empty($_GET['newpass'])? clean_var($_GET['newpass']):clean_var($_POST['newpass']);
$cfmpass = !empty($_GET['cfmpass'])? clean_var($_GET['cfmpass']):clean_var($_POST['cfmpass']);
$newques = !empty($_GET['newques'])? clean_var($_GET['newques']):clean_var($_POST['newques']);
$newansw = !empty($_GET['newansw'])? clean_var($_GET['newansw']):clean_var($_POST['newansw']);
$newtype = !empty($_GET['newtype'])? clean_var($_GET['newtype']):clean_var($_POST['newtype']);

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

}elseif(!is_mail_available($newmail)){
  $array_reponse['errors']['newmail'] = 'Cette adresse email est déjà utilisée';
  $array_reponse['success']="no";
}


//newpass
if($newpass == '') {
  $array_reponse['errors']['newpass'] = "Veuillez saisir votre mot de passe";
  $array_reponse['success']="no";
}elseif(strlen($newpass)<$data['PassLen']){
  $array_reponse['errors']['newpass'] = "Votre mot de passe doit avoir au moins {$data['PassLen']} caract&eacute;re";
  $array_reponse['success']="no";
}elseif($cfmpass == ''){
  $array_reponse['errors']['cfmpass'] = "Veuillez répéter votre mot de passe !";
  $array_reponse['success']="no";
}elseif($cfmpass != $newpass){
  $array_reponse['errors']['cfmpass'] = "Les mots de passe ne correspondent pas!";
  $array_reponse['success']="no";
}

////////////////////////////////////////////

//register ()
if($array_reponse['success']=="yes"){

  $create = create_confirmation($newpass, $newques, $newansw, $newmail, $newtype);

  if(!$create){
    $array_reponse['errors']['register']="Erreur interne !";
    $array_reponse['success']="no";
  }
}

echo json_encode($array_reponse);

?>
