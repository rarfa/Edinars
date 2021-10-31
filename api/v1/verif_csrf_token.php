<?php


$from               = $_REQUEST['from'] ?? '';
$csrf_token         = $_REQUEST['csrf_token'] ?? '';
$session_csrf_token = $_SESSION['csrf_token']; // removed csrf check from db |and used session based csrf

$array_reponse = array( "errors" => [
                                      'csrf_token' => ''
                                    ],
                        'success'=>'yes' );

//csrf_token
if(($csrf_token == '') || ($csrf_token != $session_csrf_token)) {

    $array_reponse["errors"]['csrf_token'] =  'Vous n\'avez pas de permission!';
    $array_reponse['success'] = "no";
}


if($array_reponse['success']!="yes") {
    echo json_encode($array_reponse);
    exit();
}else {
    $array_reponse = array();
}