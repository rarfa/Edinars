<?php
// $headers = apache_request_headers();
// var_dump($headers);
// foreach ($headers as $header => $value) {
//     echo "$header: $value <br />\n";
// }
// exit();
header('Content-Type: application/json');


define("DIR_ROOT", "../../");

require DIR_ROOT.'includes/All_files.php';

// security
// include('verif_csrf_token.php');

$username = !empty($_GET['login_username'])? clean_var($_GET['login_username']):clean_var($_POST['login_username']);
$password = !empty($_GET['login_password'])? clean_var($_GET['login_password']):clean_var($_POST['login_password']);

$array_reponse = array('errors' => array('username' => '',
                          'password' => '',
                          'identification' => ''),
                        'access_token' => '',
                        'success'=>'yes' );

//username
if($username == '') {
    $array_reponse['errors']['username'] =  'Veuillez saisir votre email !';
    $array_reponse['success'] = "no";
}

//password
if($password == '') {
    $array_reponse['errors']['password'] = 'Veuillez saisir votre mot de passe !';
    $array_reponse['success'] = "no";
}

//identification ()
if($array_reponse['success']=="yes") {

    $return_identification = get_member_id($username, $password);

    if($return_identification==0) {

        $array_reponse['errors']['identification'] = "Votre email / mot de passe n'est pas valide! ";//$return_identification;
        $array_reponse['success'] = "no";

    }else{
        //get access_token
        $array_reponse['access_token'] = insert_member_id_session($return_identification);

        $_SESSION['access_token'] = $array_reponse['access_token'];
        $_SESSION['uid']          = $return_identification;
        $_SESSION['login']        = true;
        $_SESSION['login_time']   = date("Y-m-d H:i:s");
    }
}

echo json_encode($array_reponse);