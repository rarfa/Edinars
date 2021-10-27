<?php


$from = !empty($_GET['from'])? clean_var($_GET['from']):clean_var($_POST['from']);;
$csrf_token = !empty($_GET['csrf_token'])? clean_var($_GET['csrf_token']):clean_var($_POST['csrf_token']);
$user_csrf_token = get_user_csrf_token($user_id);


$array_reponse = array( "errors" => [
                                      'csrf_token' => ''
                                    ],
                        'success'=>'yes' );

//csrf_token
if(
  ($csrf_token == '')
  ||
  ($csrf_token != $user_csrf_token)
){
    $array_reponse["errors"]['csrf_token'] =  'Vous n\'avez pas de permission!';
    $array_reponse['success'] = "no";
}


if($array_reponse['success']!="yes") {
  echo json_encode($array_reponse);
  exit();
}else {
  $array_reponse = array();
}

// echo '$csrf_token = '.$csrf_token.'<br>';
// echo '$user_csrf_token = '.$user_csrf_token.'<br>';
// echo '$user_id = '.$user_id.'<br>';
// echo '$from = '.$from.'<br>';

?>
