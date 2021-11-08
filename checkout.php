<?php
define("DIR_ROOT", "");
// include('config.php');
require 'includes/All_files.php';

$esc_url = $base_url . 'espace_client/';
$post    = $_REQUEST;
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <!-- META SECTION -->
        <title>Erecovery - Services de paiements enline</title>
        <meta name="csrf_token" content="<?=$_SESSION['csrf_token'] ?>">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <meta name="theme-color" content="#e30613" />

        <base href="<?=$data['Host'] ?>/" >

        <link rel="icon" href="<?=$base_url?>images/ico/favicon_last.ico" type="image/x-icon" />
        <!-- END META SECTION -->

        <!-- CSS INCLUDE -->
        <link rel="stylesheet" type="text/css" id="theme" href="<?=$esc_url?>css/theme-default.css?update=<?php echo time()?>"/>
        <link rel="stylesheet" type="text/css" href="<?=$esc_url?>css/fontawesome/css/font-awesome.min.css"/>
        <!-- EOF CSS INCLUDE -->
        <script> var base_url = '<?=$base_url?>'; </script>
        <script> var esc_url  = base_url + 'espace_client/'; </script>
        <script type="text/javascript" src="<?=$esc_url?>js/plugins/jquery/jquery.min.js"></script>
    </head>
    <body>
        <?php require "includes/header.login.php"; ?>
        <!-- START PAGE CONTAINER -->
        <div class="page-container">

            <!-- START PAGE CONTENT WRAPPER -->
            <div class="page-content-wrap" >
              <div  id="included_loading" name="included_loading" style="display:none;">
                <div class="loader"></div>
              </div>
              <div class="row">
                <div class="col-md-6 col-xs-10 col-md-offset-3 col-xs-offset-1 text-center margin-top-3-perc">
                  <img src="<?=$base_url?>images/logo.png" alt="" height="100">
                </div>
              </div>
              <div id="included_page" class="margin-top-3-perc">
              </div>
              <form class="" id="get_checkout_form" name="get_checkout_form" action="" method="get" onsubmit="return false;">
                <input type="hidden" id="pincode" name="pincode" value="<?=$post['pincode']?>">
                <input type="hidden" id="prehashkey" name="prehashkey" value="<?=$post['prehashkey']?>">
                <input type="hidden" id="crypt" name="crypt" value="<?=$post['crypt']?>">
                <input type="hidden" id="quantite" name="quantite" value="<?=$post['quantite'] ?? 1 ?>">

                <input type="hidden" id="facture_id" name="facture_id" value="<?=$post['facture_id'] ?? null ?>">
                <input type="hidden" id="prix_total" name="prix_total" value="<?=$post['prix_total'] ?? null ?>">
                <input type="hidden" id="tva" name="tva" value="<?=$post['tva'] ?? null ?>">

                <input type="hidden" id="ureturn" name="ureturn" value="<?=$post['ureturn'] ?? null ?>">
                <input type="hidden" id="unotify" name="unotify" value="<?=$post['unotify'] ?? null ?>">
                <input type="hidden" id="ucancel" name="ucancel" value="<?=$post['ucancel'] ?? null ?>">
                <input type="hidden" id="image" name="image" value="<?=$post['image'] ?? null ?>">


              </form>
            </div>
            <!-- END PAGE CONTENT WRAPPER -->
        </div>
        <!-- END PAGE CONTAINER -->
        <footer class="text-center">
          Copyright © <?=date("Y")?> Erecovery. Tous droits réservés
        </footer>
        <!-- START PRELOADS -->
        <audio id="audio-alert" src="<?=$esc_url?>audio/alert.mp3" preload="auto"></audio>
        <audio id="audio-fail" src="<?=$esc_url?>audio/fail.mp3" preload="auto"></audio>
        <!-- END PRELOADS -->

    <!-- START SCRIPTS -->
        <!-- START PLUGINS -->

        <script type="text/javascript" src="<?=$esc_url?>js/plugins/jquery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="<?=$esc_url?>js/plugins/bootstrap/bootstrap.min.js"></script>
        <!-- END PLUGINS -->

        <!-- START THIS PAGE PLUGINS-->
        <script type='text/javascript' src='<?=$esc_url?>js/plugins/icheck/icheck.min.js'></script>
        <script type="text/javascript" src="<?=$esc_url?>js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
        <script type="text/javascript" src="<?=$esc_url?>js/plugins/scrolltotop/scrolltopcontrol.js"></script>

        <script type="text/javascript" src="<?=$esc_url?>js/plugins/morris/raphael-min.js"></script>
        <script type="text/javascript" src="<?=$esc_url?>js/plugins/morris/morris.min.js"></script>
        <script type="text/javascript" src="<?=$esc_url?>js/plugins/rickshaw/d3.v3.js"></script>
        <script type="text/javascript" src="<?=$esc_url?>js/plugins/rickshaw/rickshaw.min.js"></script>
        <script type='text/javascript' src='<?=$esc_url?>js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'></script>
        <script type='text/javascript' src='<?=$esc_url?>js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'></script>
        <script type='text/javascript' src='<?=$esc_url?>js/plugins/bootstrap/bootstrap-datepicker.js'></script>
        <script type="text/javascript" src="<?=$esc_url?>js/plugins/owl/owl.carousel.min.js"></script>

        <script type="text/javascript" src="<?=$esc_url?>js/plugins/moment.min.js"></script>
        <script type="text/javascript" src="<?=$esc_url?>js/plugins/daterangepicker/daterangepicker.js"></script>
        <!-- END THIS PAGE PLUGINS-->

        <!-- START TEMPLATE -->
        <!-- <script type="text/javascript" src="js/settings.js"></script> -->

        <script type="text/javascript" src="<?=$esc_url?>js/plugins.js"></script>
        <script type="text/javascript" src="<?=$esc_url?>js/actions.js"></script>

        <!-- <script type="text/javascript" src="js/demo_dashboard.js"></script> -->

        <script type='text/javascript' src='<?=$esc_url?>js/plugins/noty/jquery.noty.js'></script>
        <script type='text/javascript' src='<?=$esc_url?>js/plugins/noty/layouts/center.js'></script>
        <script type='text/javascript' src='<?=$esc_url?>js/plugins/noty/themes/default.js'></script>

        <script type='text/javascript' src='<?=$esc_url?>js/plugins/maskedinput/jquery.maskedinput.min.js'></script>

        <script src="<?=$esc_url?>js/plugins/sweet_alert/sweetalert2.min.js"></script>
        <link rel="stylesheet" href="<?=$esc_url?>js/plugins/sweet_alert/sweetalert2.min.css">

        <script type="text/javascript" src="<?=$esc_url?>js/faq.js"></script>

        <script type="text/javascript" src="<?=$esc_url?>js/sammy-latest.min.js"></script>
        <!-- <script type="text/javascript" src="js/angular.min.js"></script> -->

        <script type="text/javascript" src="<?=$esc_url?>js/espace_client.js?update=<?php echo time()?>"></script>
        <script type="text/javascript" src="<?=$base_url?>js/common.js?update=<?php echo time()?>"></script>

        <script type="text/javascript">
          load_include_page("checkout", false);

          init_mb();
          setTimeout(function(){
            $('.page-content').attr('style', '');
          }, 1000);

          //append action to login form
          $('#login_form').append('<input type="hidden" id="action" name="action" value="checkout" >');

        </script>
        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->
    </body>
</html>
