<?php
header('Content-Type: application/json');

define("DIR_ROOT", "../../");
require DIR_ROOT.'includes/All_files.php';


$lost_email = !empty($_GET['lost_email'])? clean_var($_GET['lost_email']) : clean_var($_POST['lost_email']);

$array = array('errors' => array(
                  'lost_email' => '',
                  'lost_password' => ''),
                'success'=>'yes');

//mail
if($lost_email == '') {
    $array['errors']['lost_email'] ='Email ne peut pas être vide!';
    $array['success']="no";
}elseif(verify_email($lost_email)) {
    $array['errors']['lost_email'] ="Votre email est invalide";
    $array['success']="no";
}elseif(is_mail_available($lost_email)) {
    $array['errors']['lost_email'] ='Cet email n\'existe pas sur notre base de donnée';
    $array['success']="no";
}

if($array['success']=="yes") {

    $result=gencode();
    $post['ccode']=$result;
    $post['lost_email']=$lost_email;
    // $post['chash']=strtoupper(md5($post['ccode'].'|'.$post['lost_email']));
    $chach=db_rows(
        "SELECT MD5(CONCAT(CURDATE(), password, mem_id)) as token".
                  " FROM `{$data['DbPrefix']}members` ".
                  " WHERE email = '".$lost_email."' ".
        " LIMIT 1 "
    );

    $post['chash'] = $chach[0]["token"];

    send_email('RESTORE-PASSWORD', $post);

}

echo json_encode($array);
