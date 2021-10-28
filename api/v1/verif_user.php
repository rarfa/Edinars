<?php


$access_token = isset($_REQUEST['access_token']) ? clean_var($_REQUEST['access_token']) : '';



$array_reponse = array( 'errors'=> ['access_token' => ''],
                        'success'=>'yes' );

//username
if($access_token == ''){
    $array_reponse['errors']['access_token'] =  'Votre Identification ne peut pas être valider!';
    $array_reponse['success'] = "no";
 }else{

  $result_access_token = db_rows("SELECT * FROM `{$data['DbPrefix']}members_sessions`
                                WHERE MD5(CONCAT(member_id,member_session_id))='{$access_token}'
                                AND last_activity > NOW()-21600
                                LIMIT 1");

  if ($result_access_token[0]["member_id"]==''){
    $array_reponse['errors']['access_token'] =  'Votre Identification ne peut pas être valider!';
    $array_reponse['success'] = "no";
  }else{
    $user_id = $result_access_token[0]["member_id"];
    $last_activity=  $result_access_token[0]["last_activity"];

    db_query("UPDATE `{$data['DbPrefix']}members_sessions`
              SET last_activity = NOW()
              WHERE MD5(CONCAT(member_id,member_session_id))='{$access_token}' "
    );

    $user_infos = db_rows("SELECT * FROM `{$data['DbPrefix']}members`".
                        "WHERE `id`={$user_id}")[0];
  }

}


if($array_reponse['success']!="yes") {
  echo json_encode($array_reponse);exit();
}else {
  $array_reponse = array();
}