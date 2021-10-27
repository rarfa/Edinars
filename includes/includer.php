<?php
$page_par_defaut = DIR_ROOT."includes/page.index.php";

//include
$page = clean_var($_GET['page']); // accessible par tous le monde
$process = clean_var($_GET['process']); // Pour les traitement ajax
$form = clean_var($_GET['form']); //inclure un form
$user = clean_var($_GET['user']); //Accès réservé aux users
$admin = clean_var($_GET['admin']); //Accès réservé aux admins
$services = clean_var($_GET['services']); //Accès réservé aux services


if($page && file_exists(DIR_ROOT."includes/page.".$page.".php")){
  include(DIR_ROOT."includes/page.".$page.".php");
}elseif($process && file_exists(DIR_ROOT."includes/process.".$process.".php")){
  include(DIR_ROOT."includes/process.".$process.".php");
}elseif($form && file_exists(DIR_ROOT."includes/form.".$form.".php")){
  include(DIR_ROOT."includes/form.".$form.".php");
}elseif($user && file_exists(DIR_ROOT."includes/user.".$user.".php")){
  if($_SESSION['user_id']){
    include(DIR_ROOT."includes/user.".$user.".php");
  }else{
    echo "Error: Access for Members only";
  }
}elseif($admin && file_exists(DIR_ROOT."includes/admin/admin.".$admin.".php")){
  if($_SESSION['admin_id']) include(DIR_ROOT."includes/admin/admin.".$admin.".php");
  else
    echo "Error: Access for Admins only";

}elseif($services && file_exists(DIR_ROOT."includes/services.".$services.".php")){
  include(DIR_ROOT."includes/services.".$services.".php");
}elseif($page_par_defaut && file_exists($page_par_defaut)){
  include($page_par_defaut);//il faut la protéger
}else{
  echo "Error: Page not found!";
}
?>
