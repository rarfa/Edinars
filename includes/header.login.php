
<!-- BEGIN # MODAL LOGIN http://bootsnipp.com/snippets/featured/modal-login-with-jquery-effects -->
<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" id="modal-dialog-login">
        <div class="modal-content">
            <div class="modal-header" align="center">
                <img id="img_logo" alt="Vikings Rush logo" src="images/logo.svg" height="60">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="fa fa-remove" aria-hidden="true"></span>
                </button>
            </div>

      <!-- Begin # DIV Form -->
      <div id="div-forms">
        <!-- Begin # Login Form -->
        <form id="login_form" name="login_form">
          <div class="modal-body">
                        <h2>Connexoin</h2>
                        <span id="div_login_identification"></span>
                        <div id="div_login_username">
                            <div class="form-group has-feedback">

                      <input name="login_username" type="user" class="form-control" id="login_username" placeholder="Votre email">
                    </div>
                        </div>
                        <div id="div_login_password">
                            <div class="form-group has-feedback">

                      <input name="login_password" id="login_password" class="form-control" type="password" placeholder="Entrer le mot de passe" >
                    </div>
                        </div>
                  </div>
            <div class="modal-footer">
            <div>
                <button type="submit" class="btn btn-success btn-lg btn-block" id="btn_login">Connexion</button>
                                <div class="loader" id="login_loading" name="login_loading" style="display:none"></div>
            </div>
                <div>
                <button id="login_lost_btn" type="button" class="btn btn-link">Mot de passe oublié?</button>
                <button id="login_register_btn" type="button" class="btn btn-link"><b>Inscription</b></button>
            </div>
            </div>
          </form>
        <!-- End # Login Form -->

        <!-- Begin | Lost Password Form -->
                <div id="lost_success" style="display:none" class="modal-body">
                    <?php
                    echo '<div class="alert alert-success" role="alert">';
                    echo"Instructions de récupération de mot de passe ont été envoyés à votre adresse email.
							<br>Pour récupérer votre mot de passe s'il vous plaît suivez les instructions.";
                    echo '</div>';
                    ?>
                </div>
        <form id="lost_password_form" style="display:none;">
              <div class="modal-body">
                        <h2>Mot de passe oublié</h2>
                        <span class="div_lost_lost_password"></span>
                    <div id="div-lost-msg" style="margin:15px 0 15px 0">
              <span id="text-lost-msg">Si vous avez perdu votre mot de passe,entrer votre adresse e-mail ci-dessous.</span>
            </div>
                        <div id="div_lost_email">
                            <div class="form-group has-feedback">
                                <input name="lost_email" type="email" class="form-control" id="lost_email" placeholder="entrer votre email">
                            </div>
                        </div>

                </div>
              <div class="modal-footer">
            <div>
                <button type="submit" class="btn btn-success btn-lg btn-block" id="btn_lost">Envoyer</button>
                                <div class="loader" id="lost_loading" style="display:none"></div>
            </div>
            <div>
                <button id="lost_login_btn" type="button" class="btn btn-link">Connexion</button>
                <button id="lost_register_btn" type="button" class="btn btn-link"><b>Inscription</b></button>
            </div>
              </div>
        </form>
        <!-- End | Lost Password Form -->

        <!-- Begin | Register Form -->
                <div id="register_success" style="display:none" class="modal-body">
                    <?php
                    echo '<div class="alert alert-success fade in alert-dismissable">
								 <h1>Félicitations !</h1><p>Votre inscription sur notre site s\'est déroulée avec succès. Afin de valider votre compte,
								 merci de cliquer sur le lien que vous avez reçu par email.</p>
								 <ol>
								 <li>Vérifiez que votre boîte email n\'est pas pleine.</li>
								 <li>Si vous ne recevez pas l\'email, vérifiez bien votre boite "Courrier indésirable" ou "SPAM" et pensez à autoriser
								 les emails provenant de <b>Edinars</b>. </li>
								 </ol>
								 <p>Pour toute question ou problème, n\'hésitez pas à nous contacter.</p>
								 <p>Merci pour votre patience et de l\'intérêt que vous portez à <b>Edinars</b>.</p><p>Cordialement,<br>L\'équipe <b>Edinars</b>.</p>
								</div>';
                    ?>
                </div>

        <form id="register_form" style="display:none;">
              <div class="modal-body">
                        <h1>Inscription</h1>

                        <span class="div_register_register"></span>
                        <div id="div_register_newmail">
                            <div class="form-group has-feedback">
                                <input name="newmail" type="user" class="form-control" id="newmail" placeholder="Entrer votre email">
                            </div>
                        </div>
                        <div id="div_register_newpass">
                            <div class="form-group has-feedback">
                                <input name="newpass" id="newpass" class="form-control" type="password" placeholder="Entrer votre mot de passe" >
                            </div>
                        </div>
                        <div id="div_register_cfmpass">
                            <div class="form-group has-feedback">
                                <input name="cfmpass" id="cfmpass" class="form-control" type="password" placeholder="Répéter le mot de passe" >
                            </div>
                        </div>
                        <div id="div_register_terms">
                            <p class="form-group has-feedback" align="center">
                                <input id="terms" class="checkbox" type="checkbox" name="terms">
                                OUI, J'ai lu les
                                <a href="javascript:view('https://www.edinars.net/edinars/terms.htm',400,500)">Termes et Conditions</a>
                                avant de vous inscrire.
                            </p>
                        </div>

                </div>
              <div class="modal-footer">
            <div>
              <button type="submit" class="btn btn-success btn-lg btn-block" id="btn_register">Inscription</button>
                            <div class="loader" id="register_loading" name="lost_loading" style="display:none"></div>
            </div>
            <div>
              <button id="register_login_btn" type="button" class="btn btn-link">Connexion</button>
              <button id="register_lost_btn" type="button" class="btn btn-link">Mot de passe oublié?</button>
            </div>
              </div>
        </form>
        <!-- End | Register Form -->

      </div>
        <!-- End # DIV Form -->
        </div>
    </div>
</div>
<!-- END # MODAL LOGIN -->


<script>
// ############################# Login #############################

var modal_login= $(function() {

    var $formLogin = $('#login_form');
    var $formLost = $('#lost_password_form');
    var $formRegister = $('#register_form');
    var $divForms = $('#div-forms');
    var $modalAnimateTime = 300;
    var $msgAnimateTime = 150;
    var $msgShowTime = 2000;

    $("form").submit(function (e) {

        e.preventDefault();

        switch(this.id) {
            case "login_form":
                        login();
            return false;
            break;
            case "lost_password_form":
                lost_password();
                return false;
                break;
            case "register_form":
                register();
                return false;
                break;
            default:
                return false;
        }
      return false;
    });

    $('#login_register_btn').click( function () { modalAnimate($formLogin, $formRegister) });
    $('#register_login_btn').click( function () { modalAnimate($formRegister, $formLogin); });


        $('#login_lost_btn').click( function () { modalAnimate($formLogin, $formLost); });
    $('#lost_login_btn').click( function () { modalAnimate($formLost, $formLogin); });
    $('#lost_register_btn').click( function () { modalAnimate($formLost, $formRegister); });
    $('#register_lost_btn').click( function () { modalAnimate($formRegister, $formLost); });


        $('.register_btn').click( function () {
            setTimeout(function(){
                var hh = $formRegister.height();
                $divForms.css("height", hh);
                $formRegister.show();
                $formLogin.hide();
                $formLost.hide();
            }, 500);
        });

        $('.login_btn').click( function () {
            setTimeout(function(){
                var hh = $formLogin.height();
                $divForms.css("height", hh);
                $formLogin.show();
                $formRegister.hide();
                $formLost.hide();
            }, 500);
        });


    function modalAnimate ($oldForm, $newForm) {
            console.log("modalAnimate()");
        var $oldH = $oldForm.height();
        var $newH = $newForm.height();
        $divForms.css("height",$oldH);
        $oldForm.fadeToggle($modalAnimateTime, function(){
            $divForms.animate({height: $newH}, $modalAnimateTime, function(){
                $newForm.fadeToggle($modalAnimateTime);
            });
        });
    }
});
// ############################# END Login #############################

</script>
