<?php
$page_par_defaut = DIR_ROOT."includes/page.index.php";

//include
$page     =  isset($_REQUEST['page'])     ? clean_var($_REQUEST['page'])       : ''; // accessible par tous le monde
$process  =  isset($_REQUEST['process'])  ? clean_var($_REQUEST['process'])    : ''; // Pour les traitement ajax
$form     =  isset($_REQUEST['form'])     ? clean_var($_REQUEST['form'])       : ''; //inclure un form
$user     =  isset($_REQUEST['user'])     ? clean_var($_REQUEST['user'])       : ''; //Accès réservé aux users
$admin    =  isset($_REQUEST['admin'])    ? clean_var($_REQUEST['admin'])      : ''; //Accès réservé aux admins
$services =  isset($_REQUEST['services']) ? clean_var($_REQUEST['services'])   : ''; //Accès réservé aux services


if($page && file_exists(DIR_ROOT."includes/page.".$page.".php")) {

    include DIR_ROOT."includes/page.".$page.".php";

}elseif($process && file_exists(DIR_ROOT."includes/process.".$process.".php")) {

    include DIR_ROOT."includes/process.".$process.".php";

}elseif($form && file_exists(DIR_ROOT."includes/form.".$form.".php")) {

    include DIR_ROOT."includes/form.".$form.".php";

}elseif($user && file_exists(DIR_ROOT."includes/user.".$user.".php")) {

    if(isset($_SESSION['user_id'])) {
        include DIR_ROOT."includes/user.".$user.".php";
    }else{
        echo "Error: Access for Members only";
    }

}elseif($admin && file_exists(DIR_ROOT."includes/admin/admin.".$admin.".php")) {

    if (isset($_SESSION['admin_id'])) {
        include DIR_ROOT."includes/admin/admin.".$admin.".php";
    }else {
        echo "Error: Access for Admins only";
    }

}elseif($services && file_exists(DIR_ROOT."includes/services.".$services.".php")) {

    include DIR_ROOT."includes/services.".$services.".php";

}elseif($page_par_defaut && file_exists($page_par_defaut)) {

    include $page_par_defaut;//il faut la protéger

}else{

    echo "Error: Page not found!";
}
