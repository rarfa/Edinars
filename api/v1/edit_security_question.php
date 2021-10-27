<?php
// Created by: Yacine Ait Chalal -> 14/09/2017
#############################################################
header('Content-Type: application/json');

define("DIR_ROOT", "../../");

include(DIR_ROOT.'includes/All_files.php');

// security
include('verif_user.php');
include('verif_csrf_token.php');


$question = !empty($_GET['question'])? clean_var($_GET['question']):clean_var($_POST['question']);
$answer = !empty($_GET['answer'])? clean_var($_GET['answer']):clean_var($_POST['answer']);


$array_reponse = array( 'errors' => array(
                          'question' => '',
                          'answer' => '',
                          'edit_security_question' => '' ),
                        'success'=>'yes' );



$info_user = select_info($user_id, $post);


// var_dump($return_identification);

if(!$question){
	$array_reponse['errors']['question'] = "Veuillez saisir le question de sècuritè";
	$array_reponse['success'] = "no";
}elseif($answer == '') {
  $array_reponse['errors']['answer'] = "Veuillez saisir la rèponse de sècurité";
  $array_reponse['success']="no";
}else {

  $edit_security_question = update_security_question($user_id, $question, base64_encode($answer));

  // $array_reponse['user'] = get_member_info($user_id);


  if(!$edit_security_question){
    $array['errors']['edit_security_question'] = "Erreur interne !!";
    $array['success']="no";
  }

}

echo json_encode ($array_reponse);

?>
