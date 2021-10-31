<?php
$page_par_defaut = "includes/page.index.php";

//include
$page     = isset($_GET['page'])    ? clean_var($_GET['page'])    : 'index'; // accessible par tous le monde
$process  = isset($_GET['process']) ? clean_var($_GET['process']) : ''; // Pour les traitement ajax
$form     = isset($_GET['form'])    ? clean_var($_GET['form'])    : ''; //inclure un form

if($page && file_exists("includes/page.".$page.".php")) {

    include "includes/page.".$page.".php";

}elseif($process && file_exists("includes/process.".$process.".php")) {

    include "includes/process.".$process.".php";

}elseif($form && file_exists("includes/form.".$form.".php")) {

    include "includes/form.".$form.".php";

}elseif($page_par_defaut && file_exists($page_par_defaut)) {

    include $page_par_defaut;//il faut la protéger
  
}else{
    echo "Error: Page not found!";
}