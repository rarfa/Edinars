<?php
$page_par_defaut = "includes/page.index.php";

//include
$page     = isset($_REQUEST['page'])    ? clean_var($_REQUEST['page'])    : ''; // accessible par tous le monde
$process  = isset($_REQUEST['process']) ? clean_var($_REQUEST['process']) : ''; // Pour les traitement ajax
$form     = isset($_REQUEST['form'])    ? clean_var($_REQUEST['form'])    : ''; //inclure un form

$includes = dirname(__DIR__) . "/includes/";


$distributorPages = ['load_account'];
$marchandPages    = ['generate_order', 'products', 'traders_simple_payment', 'subscriptions', 'donations'];

$member = get_member_info($_SESSION['uid'] ?? 0);
$type   = $member['type'] ?? 0;

if($type == 0 && in_array($page, [...$distributorPages, ...$marchandPages]))
{
    include $includes . "page.error.php";
    die;
}
//professionel marchand
if($type == 1 && in_array($page, $distributorPages))
{
    include $includes . "page.error.php";
    die;
}
// distributeur or detallant
if(($type == 2 || $type == 3) && in_array($page, $marchandPages))
{
    include $includes . "page.error.php";
    die;
}

if($page && file_exists($includes . "page.".$page.".php")) {

    include $includes . "page.".$page.".php";

}elseif($process && file_exists($includes . "process.".$process.".php")) {

    include $includes . "process.".$process.".php";

}elseif($form && file_exists($includes . "form.".$form.".php")) {

    include $includes . "form.".$form.".php";

}elseif($page_par_defaut && file_exists($page_par_defaut)) {

    include $page_par_defaut;//il faut la protéger
  
}else{
    echo "Error: Page not found!";
}