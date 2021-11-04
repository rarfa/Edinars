<?php

define("DIR_ROOT", "../../");

require DIR_ROOT . 'includes/All_files.php';

unset($_SESSION['login']);
session_destroy();

echo json_encode([
    'success' => 'yes'
]);
exit;
