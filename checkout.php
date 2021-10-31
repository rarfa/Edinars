<?php
define("DIR_ROOT", "");
// include('config.php');
require 'includes/All_files.php';

// var_dump($post);

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <!-- META SECTION -->
        <title>Edinars - Services de paiements enline</title>
        <meta name="csrf_token" content="<?php echo $_SESSION['csrf_token'] ?>">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <meta name="theme-color" content="#e30613" />

        <base href="<?php echo $data['Host'] ?>/" >

        <link rel="icon" href="images/ico/favicon_last.ico" type="image/x-icon" />
        <!-- END META SECTION -->

        <!-- CSS INCLUDE -->
        <link rel="stylesheet" type="text/css" id="theme" href="espace_client/css/theme-default.css?update=<?php echo time()?>"/>
        <link rel="stylesheet" type="text/css" href="espace_client/css/fontawesome/css/font-awesome.min.css"/>
        <!-- EOF CSS INCLUDE -->

        <script type="text/javascript" src="espace_client/js/plugins/jquery/jquery.min.js"></script>
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
                  <img src="https://v2.edinars.net/images/logo.png" alt="" height="100">
                </div>
              </div>
              <div id="included_page" class="margin-top-3-perc">
              </div>
              <form class="" id="get_checkout_form" name="get_checkout_form" action="" method="get" onsubmit="return false;">
                <input type="hidden" id="pincode" name="pincode" value="<?php echo $post['pincode']?>">
                <input type="hidden" id="prehashkey" name="prehashkey" value="<?php echo $post['prehashkey']?>">
                <input type="hidden" id="crypt" name="crypt" value="<?php echo $post['crypt']?>">
                <input type="hidden" id="quantite" name="quantite" value="<?php echo $post['quantite']?>">
              </form>
            </div>
            <!-- END PAGE CONTENT WRAPPER -->
        </div>
        <!-- END PAGE CONTAINER -->
        <footer class="text-center">
          Copyright © <?php echo date("Y")?> Edinars. Tous droits réservés
        </footer>
        <!-- START PRELOADS -->
        <audio id="audio-alert" src="espace_client/audio/alert.mp3" preload="auto"></audio>
        <audio id="audio-fail" src="espace_client/audio/fail.mp3" preload="auto"></audio>
        <!-- END PRELOADS -->

    <!-- START SCRIPTS -->
        <!-- START PLUGINS -->

        <script type="text/javascript" src="espace_client/js/plugins/jquery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="espace_client/js/plugins/bootstrap/bootstrap.min.js"></script>
        <!-- END PLUGINS -->

        <!-- START THIS PAGE PLUGINS-->
        <script type='text/javascript' src='espace_client/js/plugins/icheck/icheck.min.js'></script>
        <script type="text/javascript" src="espace_client/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
        <script type="text/javascript" src="espace_client/js/plugins/scrolltotop/scrolltopcontrol.js"></script>

        <script type="text/javascript" src="espace_client/js/plugins/morris/raphael-min.js"></script>
        <script type="text/javascript" src="espace_client/js/plugins/morris/morris.min.js"></script>
        <script type="text/javascript" src="espace_client/js/plugins/rickshaw/d3.v3.js"></script>
        <script type="text/javascript" src="espace_client/js/plugins/rickshaw/rickshaw.min.js"></script>
        <script type='text/javascript' src='espace_client/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'></script>
        <script type='text/javascript' src='espace_client/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'></script>
        <script type='text/javascript' src='espace_client/js/plugins/bootstrap/bootstrap-datepicker.js'></script>
        <script type="text/javascript" src="espace_client/js/plugins/owl/owl.carousel.min.js"></script>

        <script type="text/javascript" src="espace_client/js/plugins/moment.min.js"></script>
        <script type="text/javascript" src="espace_client/js/plugins/daterangepicker/daterangepicker.js"></script>
        <!-- END THIS PAGE PLUGINS-->

        <!-- START TEMPLATE -->
        <!-- <script type="text/javascript" src="js/settings.js"></script> -->

        <script type="text/javascript" src="espace_client/js/plugins.js"></script>
        <script type="text/javascript" src="espace_client/js/actions.js"></script>

        <!-- <script type="text/javascript" src="js/demo_dashboard.js"></script> -->

        <script type='text/javascript' src='espace_client/js/plugins/noty/jquery.noty.js'></script>
        <script type='text/javascript' src='espace_client/js/plugins/noty/layouts/center.js'></script>
        <script type='text/javascript' src='espace_client/js/plugins/noty/themes/default.js'></script>

        <script type='text/javascript' src='espace_client/js/plugins/maskedinput/jquery.maskedinput.min.js'></script>

        <script src="espace_client/js/plugins/sweet_alert/sweetalert2.min.js"></script>
        <link rel="stylesheet" href="espace_client/js/plugins/sweet_alert/sweetalert2.min.css">

        <script type="text/javascript" src="espace_client/js/faq.js"></script>

        <script type="text/javascript" src="espace_client/js/sammy-latest.min.js"></script>
        <!-- <script type="text/javascript" src="js/angular.min.js"></script> -->

        <script type="text/javascript" src="espace_client/js/espace_client.js?update=<?php echo time()?>"></script>
        <script type="text/javascript" src="js/common.js?update=<?php echo time()?>"></script>

        <script type="text/javascript">
          espace_client_dir ="./espace_client/";
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
