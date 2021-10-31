<?php
header('Content-Type: application/json');

define("DIR_ROOT", "../../");

require DIR_ROOT.'includes/All_files.php';

// security
require 'verif_user.php';

$array_imp =db_rows(
    "SELECT * FROM `{$data['DbPrefix']}members`".
    "WHERE `id`={$user_id}"
);

//response
$array_reponse = array(
                        'mobile' => $array_imp[0]['mobile'],
                        'confirm_mobile' => $array_imp[0]['confirm_mobile'],
                        'success'=>'yes'
);


// Check if he is already informed
$mobile = str_replace(" ", "", $array_imp[0]['mobile']);

$array_notification = db_rows(
    "SELECT * FROM `{$data['DbPrefix']}notifications`".
                              "WHERE `member_id`={$user_id} ".
                              "AND `type` = 'message' ".
                              "AND `view` = 'no' ".
                              "AND `message` LIKE '%{$mobile}%'"
);

if(isset($array_notification[0])) {
    $array_reponse['pin_code'] = $array_imp[0]['pin_code'];
}

echo json_encode($array_reponse);
