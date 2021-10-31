<?php
header('Content-Type: application/json');

define("DIR_ROOT", "../../");
require DIR_ROOT.'includes/All_files.php';

$token   = isset($_REQUEST['token'])   ? clean_var($_REQUEST['token'])  : '';
$newpass = isset($_REQUEST['newpass']) ? clean_var($_REQUEST['newpass']) : '';
$cfmpass = isset($_REQUEST['cfmpass']) ? clean_var($_REQUEST['cfmpass']) : '';

$array = array( 'errors' => array(
                  'token' => '',
                  'newpass' => '',
                  'cfmpass' => ''),

                'success'=>'yes');


////////////////////////////////////////////
//token
if(empty($token)) {
    $array['errors']['token'] = "Erreur d\'identification".$token;
    $array['success']="no";
}else{
    $member=db_rows(
        "SELECT  * ".
                  " FROM `{$data['DbPrefix']}members` ".
                  " WHERE MD5(CONCAT(CURDATE(), password, mem_id)) = '".$token."' ".
        " LIMIT 1 "
    );
    if(!$member) {
        $array['errors']['token'] = "Erreur d\'identification !".$token;
        $array['success']="no";
    }
}

//newpass
if($newpass == '') {
    $array['errors']['newpass'] = "Votre mot de passe ne peut pas &egrave;tre vide";
    $array['success']="no";
}elseif(strlen($newpass)<$data['PassLen']) {
    $array['errors']['newpass'] = "Votre mot de passe doit avoir au moins {$data['PassLen']} caract&eacute;re";
    $array['success']="no";
}elseif($cfmpass == '') {
    $array['errors']['cfmpass'] = "Votre mot de passe ne peut pas &egrave;tre vide";
    $array['success']="no";
}elseif($cfmpass != $newpass) {
    $array['errors']['cfmpass'] = "Votre mot de passe et confirmez ne devraient pas &ecirc;tre diff&ecirc;rentes";
    $array['success']="no";
}

//register ()
if($array['success']=="yes") {
    $reset = mysqli_query($data['cid'], 
        "UPDATE `{$data['DbPrefix']}members` SET
                        `password` = MD5(CONCAT('".$newpass."','|','".$member[0]["mem_id"]."'))
                        WHERE MD5(CONCAT(CURDATE(), password, mem_id)) = '".$token."';"
    );

    if(!$reset) {
        $array['errors']['token'] = "Erreur d\'identification !!";
        $array['success']="no";
    }
}

echo json_encode($array);
