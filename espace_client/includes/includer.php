<?php
$page_par_defaut = "includes/page.index.php";

//include
$page     = isset($_REQUEST['page'])    ? clean_var($_REQUEST['page'])    : ''; // accessible par tous le monde
$process  = isset($_REQUEST['process']) ? clean_var($_REQUEST['process']) : ''; // Pour les traitement ajax
$form     = isset($_REQUEST['form'])    ? clean_var($_REQUEST['form'])    : ''; //inclure un form

$includes = dirname(__DIR__) . "/includes/";

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