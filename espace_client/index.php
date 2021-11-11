<?php
require '../config.php';
require '../includes/functions.php';

$esc_url = $base_url . 'espace_client/';

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
  header('location:/');
  exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <!-- META SECTION -->
        <title>E-Recovery - Espace client</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf_token" content="<?=$_SESSION['csrf_token']?>">

        <meta name="theme-color" content="#e30613" />

        <link rel="icon" href="<?=$base_url?>images/ico/favicon_last.ico" type="image/x-icon" />
        <!-- END META SECTION -->

        <!-- CSS INCLUDE -->
        <link rel="stylesheet" type="text/css" id="theme" href="<?=$esc_url?>css/theme-default2.css?update=<?=time()?>"/>
        <link rel="stylesheet" type="text/css" href="<?=$esc_url?>css/fontawesome/css/font-awesome.min.css"/>
        <!-- EOF CSS INCLUDE -->
    </head>
    <body>
        <!-- START PAGE CONTAINER -->
        <div class="page-container">

          <!-- START PAGE SIDEBAR -->
          <div class="page-sidebar">
              <!-- START X-NAVIGATION -->
              <ul class="x-navigation">
                  <li class="xn-logo">
                      <a href="./">Espace client</a>
                      <a href="#" class="x-navigation-control"></a>
                  </li>
                  <li class="xn-profile">
                      <a href="#" class="profile-mini">
                          <img src="<?=$base_url?>images/logo_icone.svg" alt="logo Erecovery" height="35"/>
                      </a>
                      <div class="profile">
                          <div class="profile-image">
                              <img src="<?=$base_url?>images/logo_text_blanc .svg" alt="logo Erecovery" height="50">
                          </div>
                          <div class="profile-data">
                            <div class="profile-data-name"><span class="user_data_firstname">{firstname}</span> <span class="user_data_lastname">{lastname}</span> </div>
                            <div class="profile-data-title ">Solde: <b class="user_data_solde">0 DA</b></div>
                            <div class="profile-data-title ">Disponible: <b class="user_data_solde_disponible">0 DA</b></div>
                            <div class="profile-data-title "><span class="badge user_data_status ">{status}</span></div>
                          </div>
                      </div>
                  </li>
                  <li class="xn-title">Navigation</li>
                  <span id="v_menu"> </span>

              </ul>
              <!-- END X-NAVIGATION -->
          </div>
          <!-- END PAGE SIDEBAR -->

          <!-- PAGE CONTENT -->
          <div class="page-content">
            <!-- START X-NAVIGATION VERTICAL -->
            <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
                <!-- TOGGLE NAVIGATION -->
                <li class="xn-icon-button">
                    <a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
                </li>
                <!-- END TOGGLE NAVIGATION -->

                <!-- SIGN OUT -->
                <!-- <li class="xn-icon-button pull-right">
                    <a href="javascript:;" class="mb-control" data-box="#mb-logout"><span class="fa fa-sign-out"></span></a>
                </li> -->
                <!-- END SIGN OUT -->

                <!-- Notifications -->
                <li class="xn-icon-button pull-right">
                    <a href="#"><span class="fa fa-bell"></span></a>
                    <div class="informer informer-danger notifications_count" >0</div>
                    <div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
                        <div class="panel-heading">
                            <h3 class="panel-title"><span class="fa fa-bell"></span> Notifications</h3>
                            <div class="pull-right">
                                <!-- <span class="label label-danger"><span class="notifications_count">0</span> notification(s)</span> -->
                            </div>
                        </div>
                        <div class="panel-body list-group list-group-contacts scroll" style="height: 200px;" id="notifications_list">
                            <a href="#" class="list-group-item">
                                <span  class="fa fa-bell fa-4x pull-left" style="color:#73be28"></span>
                                <span class="contacts-title">Titre</span>
                                <p>Description</p>
                            </a>
                        </div>
                        <div class="panel-footer text-center">
                            <a href="<?=$esc_url?>#notifications/">Afficher toutes les notifications</a>
                        </div>
                    </div>
                </li>
                <!-- END Notifications -->
                <!-- <li class="xn-icon-button pull-right">
                    <a href="#" class="mb-control" data-box="#mb-identity"><span class="fa fa-qrcode"></span></a>
                </li> -->
            </ul>
            <!-- END X-NAVIGATION VERTICAL -->

            <!-- START PAGE CONTENT WRAPPER -->
            <div class="page-content-wrap" >
              <div class="row not_confirmed_mobile" style="margin-top:20px;margin-bottom:10px;display:none">
                <div class="col-md-12">
                  <div class="alert alert-danger" role="alert" id="confidentiality_note">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <p>Vous n'avez pas encore confirmé votre numéro de téléphone</p>
                    <p>Vous devez confirmer votre numéro mobile pour pouvoir utiliser les services de Erecovery</p>
                    <div class="text-center">
                      <a class="btn btn-primary" onclick="show_confirmation_mobile();">Confirmer maintenant</a>
                    </div>
                  </div>
                </div>
              </div>
              <div  id="included_loading" name="included_loading" style="display:none;">
                <div class="loader"></div>
              </div>

              <div id="included_page"> </div>
            </div>
            <!-- END PAGE CONTENT WRAPPER -->
          </div>
          <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->

        <!-- Logout BOX-->
        <div class="message-box animated fadeIn" id="mb-logout">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-sign-out"></span> Déconnexion ?</div>
                    <div class="mb-content">
                        <p>Êtes-vous sûr de vouloir vous déconnecter?</p>
                        <p>Appuyez sur Non si vous souhaitez continuer votre travail. Appuyez sur Oui pour déconnecter l'utilisateur actuel.</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <!-- <a href="index.php?action=logout" class="btn btn-success btn-lg">Oui</a> -->
                            <a href="javascript:;" onclick="logout();" class="btn btn-success btn-lg">Oui</a>
                            <button class="btn btn-default btn-lg mb-control-close">Non</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Logout BOX-->

        <!-- identity BOX-->
        <div class="message-box animated fadeIn" id="mb-identity">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-qrcode"></span> QR Code</div>
                    <div class="mb-content" style="text-align:center">
                      <p>Utilisez ce QR Code pour vos transferts</p>
                      <p><br></p>
                      <img height="210" src="img/qr.png" class="user_datas_img_qr_code" />
                      <hr>
                      <h3> N° de compte : <b class="user_data_mem_id"></b></h3>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <a href="javascript:;" class=" mb-control-close fa fa-times-circle-o fa-4x rednew" ></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END identity BOX-->

        <!-- Paiement BOX-->
        <div class="message-box animated fadeIn" id="mb-paiement">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-money"></span> Paiement</div>
                    <div class="mb-content">
                        <ul class="x-navigation">
                            <li>
                                <a href="#load_account/" onclick="$('#mb-paiement').removeClass('open');"><span class="fa fa-chevron-right"></span> <span class="xn-text">Recharger un compte</span></a>
                            </li>
                            <li>
                                <a href="#generate_order/" onclick="$('#mb-paiement').removeClass('open');"><span class="fa fa-chevron-right"></span> <span class="xn-text">Générer une facture</span></a>
                            </li>

                        </ul>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <a href="javascript:;" class=" mb-control-close fa fa-times-circle-o fa-4x rednew" ></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Paiement BOX-->

        <!-- services BOX-->
        <div class="message-box animated fadeIn" id="mb-services">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-shopping-cart"></span> Services</div>
                    <div class="mb-content">
                      <!-- <ul class="x-navigation">
                          <li>
                              <a href="./#mobile_recharge/" onclick="$('#mb-services').removeClass('open');"><span class="fa fa-chevron-right"></span> <span class="xn-text">Recharger votre mobile</span></a>
                          </li>
                      </ul> -->
                      <div class="row">
                        <div class="col-md-4">
                          <a  href="./#mobile_recharge/" onclick="$('#mb-services').removeClass('open');" class="tile tile-success tile-valign"><span class="fa fa-mobile"></span>
                            <br> Recharge mobile
                          </a>
                        </div>
                        <div class="col-md-4">
                          <a  href="javascript:;" onclick="$('#mb-services').removeClass('open');show_voucher('')" class="tile tile-success tile-valign"><span class="fa fa-credit-card"></span>
                            <br> Recharge internet
                          </a>
                        </div>
                        <div class="col-md-4">
                          <a  href="./#/" onclick="$('#mb-services').removeClass('open');" class="tile tile-success tile-valign"><span class="fa fa-map-o"></span>
                            <br> Payer une facture
                          </a>
                        </div>

                      </div>

                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <a href="javascript:;" class=" mb-control-close fa fa-times-circle-o fa-4x rednew" ></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END services BOX-->

        <!-- settings BOX-->
        <div class="message-box animated fadeIn" id="mb-settings">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-cog"></span> Paramètres</div>
                    <div class="mb-content">
                      <div class="row">
                        <div class="col-md-6">
                          <a  href="./#my_profile/" onclick="$('#mb-settings').removeClass('open');" class="tile tile-success tile-valign"><span class="fa fa-user"></span>
                            <br> Mon profile
                          </a>
                        </div>
                        <div class="col-md-6">
                          <a  href="./#confidentiality/" onclick="$('#mb-settings').removeClass('open');" class="tile tile-success tile-valign"><span class="fa fa-lock"></span>
                            <br> Confidentialité
                          </a>
                        </div>
                      </div>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <a href="javascript:;" class=" mb-control-close fa fa-times-circle-o fa-4x rednew" ></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END settings BOX-->

        <!-- traders BOX-->
        <div class="message-box animated fadeIn" id="mb-traders">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-shopping-basket"></span> Marchants</div>
                    <div class="mb-content">
                      <div class="row">
                        <div class="col-md-3">
                          <a  href="<?=$esc_url?>#products/" onclick="$('#mb-traders').removeClass('open');" class="tile tile-success tile-valign"><span class="fa fa-gift"></span>
                            <br> Produits
                          </a>
                        </div>
                        <div class="col-md-3">
                          <a  href="<?=$esc_url?>#traders_simple_payment/" onclick="$('#mb-traders').removeClass('open');" class="tile tile-success tile-valign"><span class="fa fa-credit-card"></span>
                            <br> Paiements
                          </a>
                        </div>
                        <div class="col-md-3">
                          <a  href="<?=$esc_url?>#subscriptions/" onclick="$('#mb-traders').removeClass('open');" class="tile tile-success tile-valign"><span class="fa fa-rss"></span>
                            <br>Abonnements
                          </a>
                        </div>
                        <div class="col-md-3">
                          <a  href="<?=$esc_url?>#donations/" onclick="$('#mb-traders').removeClass('open');" class="tile tile-success tile-valign"><span class="fa fa-heart-o"></span>
                            <br> Donation
                          </a>
                        </div>

                      </div>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <!-- <button class="btn btn-default btn-lg mb-control-close">Fermer</button> -->
                            <a href="javascript:;" class=" mb-control-close fa fa-times-circle-o fa-4x rednew" ></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END traders BOX-->

        <!-- START PRELOADS -->
        <audio id="audio-alert" src="<?=$esc_url?>audio/alert.mp3" preload="auto"></audio>
        <audio id="audio-fail" src="<?=$esc_url?>audio/fail.mp3" preload="auto"></audio>
        <!-- END PRELOADS -->

    <!-- START SCRIPTS -->
        <!-- START PLUGINS -->
        <script> var base_url = '<?=$base_url?>'; </script>
        <script> var esc_url  = '<?=$esc_url?>'; </script>
        <script type="text/javascript" src="<?=$esc_url?>js/plugins/jquery/jquery.min.js"></script>
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

        <script type="text/javascript" src="<?=$base_url?>js/common.js?update=<?=time()?>"></script>
        <script type="text/javascript" src="<?=$esc_url?>js/espace_client.js?update=<?=time()?>"></script>
        <script type="text/javascript" src="<?=$esc_url?>js/espace_client_voucher.js?update=<?=time()?>"></script>

        <script type="text/javascript">
          //check_login
          $( document ).ready(function() {
            check_login();
              $('.page-sidebar').height(0).height($(document).height());
              $('.page-sidebar ul').height("100%")
              $(window).resize(function(){
                  $('.page-sidebar').height(0).height($(document).height());
                  $('.page-sidebar ul').height("100%")
              });
          })
          var routing_app = $.sammy(function() {

            this.get('#/', function() {
              load_include_page("index");
            });
            this.get('#:page/', function() {
              load_include_page(this.params['page']);
            });

          });

          // start the application
          routing_app.run('#/');

          init_mb();
          setTimeout(function(){
            $('.page-content').attr('style', '');
          }, 1000);

        </script>
        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->
    </body>
</html>
<style>
    .swal2-modal .swal2-styled {
        width: 100% !important;
        margin: unset;
    }

    .swal2-modal button:not(#show_transaction_actions > button){
        height: 45px;
        width: 100% !important;
        border-radius: 3px;
    }
</style>