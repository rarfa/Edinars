<script type="text/javascript">
  v_menu_id = "settings"
</script>

    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="#">Espace client</a></li>
        <li><a href="./#settings/">Paramètres</a></li>
        <li class="active">Mon profile</li>
    </ul>
    <!-- END BREADCRUMB -->

    <!-- TABS WIDGET -->
    <div class="row">
      <div class="col-md-12">


        <div class="panel panel-default tabs">
            <ul class="nav nav-tabs nav-justified">
                <li class="active" id="li_confidentiality_tab1" ><a href="#confidentiality_tab1" data-toggle="tab" aria-expanded="true"><span class="fa fa-key"></span> Mot de passe</a></li>
                <li class="" id="li_confidentiality_tab2"><a href="#confidentiality_tab2" data-toggle="tab" aria-expanded="false"><span class="fa fa-lock"></span> Question de sécurité</a></li>
                <li class="" id="li_confidentiality_tab3"><a href="#confidentiality_tab3" data-toggle="tab" aria-expanded="false"><span class="fa fa-asterisk"></span> Code PIN</a></li>
            </ul>
            <div class="panel-body tab-content">
                <div class="tab-pane active" id="confidentiality_tab1">
                  <!-- Remarque -->
                  <div class="alert alert-warning" role="alert" id="confidentiality_note" >
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <p><strong>Remarque:</strong> Votre mot de passe est sensible aux majuscules et minuscules, et doit contenir au moins 9 caractères,</p>
                      <p>dont au moins une lettre en majuscule (A-Z),un chiffre (0-9) et l'un des caractères spéciaux suivants:<b> !=+*;:-,._{[()]}#%?@</b>.</p>
                  </div>
                  <!-- END Remarque -->
                  <form class="form-horizontal" id="edit_password_form" name="edit_password_form" method="post" onsubmit="edit_password();return false;">
                    <div class="form-group">
                      <label class="col-md-3 col-xs-12 control-label">Ancien mot de passe*</label>
                      <div class="col-md-6 col-xs-12">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-key"></span></span>
                          <input type="password" class="form-control " id="old_password" name="old_password" required>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 col-xs-12 control-label">Nouveau mot de passe*</label>
                      <div class="col-md-6 col-xs-12">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-key"></span></span>
                          <input type="password" class="form-control " id="new_password" name="new_password" required>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 col-xs-12 control-label">Re-entrez le Nouveau mot de passe*</label>
                      <div class="col-md-6 col-xs-12">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-key"></span></span>
                          <input type="password" class="form-control" id="retyped_new_password" name="retyped_new_password" required>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-12 col-xs-12" style="text-align:center">
                        <div class="loader" id="loading_edit_password" name="loading_edit_password" style="float: right; display: none;"></div>
                        <button class="btn btn-primary" type="submit" id="btn_edit_password" name="btn_edit_password" disabled><span class="fa fa-pencil"></span>Enregistrer</button>
                      </div>
                    </div>
                  </form>

                </div>
                <div class="tab-pane" id="confidentiality_tab2">
                  <!-- Remarque -->
                  <div class="alert alert-warning" role="alert" id="confidentiality_note" >
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <p><strong>Remarque:</strong> Si vous oubliez votre mot de passe, nous allons vous poser la question que vous soumettez ci-dessous.</p>
                    <p>S'il vous plaît, essayez de trouver une question personnelle et une réponse que vous seul connaissez.</p>
                  </div>
                  <!-- END Remarque -->
                  <form class="form-horizontal" id="edit_security_question_form" name="edit_security_question_form" method="post" onsubmit="edit_security_question();return false;">
                    <div class="form-group">
                      <label class="col-md-3 col-xs-12 control-label">Question de sécurité*</label>
                      <div class="col-md-6 col-xs-12">
                        <div class="">
                          <!-- <span class="input-group-addon"></span> -->
                          <select class="btn-group form-control select input_user_data_question" id="question" name="question" required >
                          </select>
                          <!-- <input type="text" class="form-control input_user_data_type_account" readonly> -->
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-md-3 col-xs-12 control-label">Rèponse de sècurité *</label>
                      <div class="col-md-6 col-xs-12">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-key"></span></span>
                          <input type="text" class="form-control input_user_data_answer" id="answer" name="answer" required>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="col-md-12 col-xs-12" style="text-align:center">
                        <div class="loader" id="loading_edit_security_question" name="loading_edit_security_question" style="float: right; display: none;"></div>
                        <button class="btn btn-primary" type="submit" id="btn_edit_security_question" name="btn_edit_security_question" disabled><span class="fa fa-pencil"></span>Modifier</button>
                      </div>
                    </div>
                  </form>

                </div>
                <div class="tab-pane" id="confidentiality_tab3">
                  <h2>Afficher le code PIN</h2>
                  <div class="alert alert-warning" role="alert" id="confidentiality_note" >
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <p><strong>Remarque:</strong> En raison de sécurité votre mot de passe est indispensable pour pouvoir afficher votre code pin </p>
                  </div>
                  <form class="form-horizontal" id="show_pin_code_form" name="show_pin_code_form" method="post" onsubmit="show_pin_code();return false;">
                    <div class="form-group">
                      <label class="col-md-3 col-xs-12 control-label">Votre mot de passe actuel *</label>
                      <div class="col-md-6 col-xs-12">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-key"></span></span>
                          <input type="password" class="form-control " id="show_pin_code_password" name="show_pin_code_password" required>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-12 col-xs-12" style="text-align:center">
                        <div class="loader" id="loading_show_pin_code" name="loading_show_pin_code" style="float: right; display: none;"></div>
                        <button class="btn btn-primary" type="submit" id="btn_show_pin_code" name="btn_show_pin_code" disabled><span class="fa fa-asterisk"></span>Afficher mon code pin</button>
                      </div>
                    </div>
                  </form>
                  <hr>
                  <h2>Réinitialiser le code PIN</h2>
                  <div class="alert alert-warning" role="alert" id="confidentiality_note" >
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <p><strong>Remarque:</strong> En raison de sécurité votre mot de passe est indispensable pour pouvoir réinitialiser votre code pin </p>
                  </div>
                  <form class="form-horizontal" id="reset_pin_code_form" name="reset_pin_code_form" method="post" onsubmit="reset_pin_code();return false;">
                    <div class="form-group">
                      <label class="col-md-3 col-xs-12 control-label">Votre mot de passe actuel *</label>
                      <div class="col-md-6 col-xs-12">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-key"></span></span>
                          <input type="password" class="form-control " id="reset_pin_code_password" name="reset_pin_code_password" required>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-12 col-xs-12" style="text-align:center">
                        <div class="loader" id="loading_reset_pin_code" name="loading_reset_pin_code" style="float: right; display: none;"></div>
                        <button class="btn btn-primary" type="submit" id="btn_reset_pin_code" name="btn_reset_pin_code" disabled><span class="fa fa-pencil"></span>Réinitialiser code PIN</button>
                      </div>
                    </div>
                  </form>
                </div>
            </div>
        </div>
      </div>
    </div>

    <!-- END TABS WIDGET -->

    <script>
    //edit password
    $('#edit_password_form input').click(function() {
      $("#btn_edit_password").attr("disabled", false);
    });


    //edit adresse
    $('#edit_security_question_form input').click(function() {
      // do something
      $("#btn_edit_security_question").attr("disabled", false);
      // alert("click");
    });

    //show pin code
    $('#show_pin_code_form input').click(function() {
      $("#btn_show_pin_code").attr("disabled", false);
    });

    //reset pin code
    $('#reset_pin_code_form input').click(function() {
      $("#btn_reset_pin_code").attr("disabled", false);
    });

    // ############################ password ############################
    function edit_password(){
    	console.log("edit_password() ");
    	reset_error_form();

    	var str = $("#edit_password_form").serialize();
      str += "&from=website" + append_csrf_token_to_form();
      str += append_access_token();

    	$('#btn_edit_password').hide();
    	$('#loading_edit_password').show();

    	$.ajax({
    	  url: api_url + "edit_password.php",
    	  cache: false,
    	  data: str,
    		type:"post",
    		dataType: 'json',
    		error: function (xhr, ajaxOptions, thrownError) {
    			console.error("xhr.status = "+xhr.status);
    			console.error("thrownError = "+thrownError);
    			$('#btn_edit_password').show();
    			$('#loading_edit_password').hide();
    		},
    	  success: function(html){
    			$('#btn_edit_password').show();
    			$('#loading_edit_password').hide();
    			process_edit_password(html);
    	  }
    	});
    }
    function process_edit_password(reponse){

    	console.log("process_edit_password() "+reponse.success);
    	if(reponse.success=="yes"){
    		// $('#success_edit_password').show();

    		swal({
    			title: 'Mot de passe modifié',
    			text: 'Mot de passe a été modifié avec succès',
    			timer: 4000,
    			type: 'success'
    		})

    		$("#my_profile_note").hide();
    		// refresh_user_datas();
    		// load_include_page("index");
    		location.href="./#/";
    	}else{

    		loop_errors_form(reponse.errors);

    		if(reponse.errors.edit_password!=""){
    			swal({
    				title: 'Erreur',
    				text: reponse.errors.edit_password,
    				timer: 4000,
    				type: 'error'
    			})
    		}

    	}
    }


    // ############################ security_question ############################
    function edit_security_question(){
    	console.log("edit_security_question() ");
    	reset_error_form();

    	var str = $("#edit_security_question_form").serialize();
      str += "&from=website" + append_csrf_token_to_form();
      str += append_access_token();

    	$('#btn_edit_security_question').hide();
    	$('#loading_edit_security_question').show();

    	$.ajax({
    	  url: api_url + "edit_security_question.php",
    	  cache: false,
    	  data: str,
    		type:"post",
    		dataType: 'json',
    		error: function (xhr, ajaxOptions, thrownError) {
    			console.error("xhr.status = "+xhr.status);
    			console.error("thrownError = "+thrownError);
    			$('#btn_edit_security_question').show();
    			$('#loading_edit_security_question').hide();
    		},
    	  success: function(html){
    			$('#btn_edit_security_question').show();
    			$('#loading_edit_security_question').hide();
    			process_edit_security_question(html);
    	  }
    	});
    }

    function process_edit_security_question(reponse){

    	console.log("process_edit_security_question() "+reponse.success);
    	if(reponse.success=="yes"){
    		// $('#success_edit_security_question').show();
    		// noty({text: 'Votre entreprise a été modifié avec succès', layout: 'center', type: 'success', "timeout":3000});
    		swal({
    			title: 'Question de sécurité modifié',
    			text: 'Question de sécurité a été modifié avec succès',
    			timer: 4000,
    			type: 'success'
    		})
    		$("#my_profile_note").hide();
    		// refresh_user_datas();
    		// load_include_page("index");
    		location.href="./#/";
    	}else{

    		loop_errors_form(reponse.errors);

    		if(reponse.errors.edit_security_question!=""){
    			swal({
    				title: 'Erreur',
    				text: reponse.errors.edit_security_question,
    				timer: 4000,
    				type: 'error'
    			})
    		}

    	}
    }

    // ############################ Show Pin code ############################
    function show_pin_code(){
    	console.log("show_pin_code() ");
    	reset_error_form();

    	var str = $("#show_pin_code_form").serialize();
      str += "&from=website" + append_csrf_token_to_form();
      str += append_access_token();

    	$('#btn_show_pin_code').hide();
    	$('#loading_show_pin_code').show();

    	$.ajax({
    	  url: api_url + "show_pin_code.php",
    	  cache: false,
    	  data: str,
    		type:"post",
    		dataType: 'json',
    		error: function (xhr, ajaxOptions, thrownError) {
    			console.error("xhr.status = "+xhr.status);
    			console.error("thrownError = "+thrownError);
    			$('#btn_show_pin_code').show();
    			$('#loading_show_pin_code').hide();
    		},
    	  success: function(html){
    			$('#btn_show_pin_code').show();
    			$('#loading_show_pin_code').hide();
    			process_show_pin_code(html);
    	  }
    	});
    }
    function process_show_pin_code(reponse){

    	console.log("process_show_pin_code() "+reponse.success);
    	if(reponse.success=="yes"){
    		// $('#success_show_pin_code').show();
        $("#show_pin_code_password").val("");
    		swal({
    			title: 'Votre code PIN',
    			html: '<h2>'+reponse.pin_code+'</h2>',
    			type: 'info'
    		})
    	}else{

    		loop_errors_form(reponse.errors);

    		if(reponse.errors.show_pin_code!=""){
    			swal({
    				title: 'Erreur',
    				text: reponse.errors.show_pin_code,
    				timer: 4000,
    				type: 'error'
    			})
    		}

    	}
    }

    // ############################ Reset Pin code ############################
    function reset_pin_code(){
    	console.log("reset_pin_code() ");
    	reset_error_form();

    	var str = $("#reset_pin_code_form").serialize();
      str += "&from=website" + append_csrf_token_to_form();
      str += append_access_token();

    	$('#btn_reset_pin_code').hide();
    	$('#loading_reset_pin_code').show();

    	$.ajax({
    	  url: api_url + "reset_pin_code.php",
    	  cache: false,
    	  data: str,
    		type:"post",
    		dataType: 'json',
    		error: function (xhr, ajaxOptions, thrownError) {
    			console.error("xhr.status = "+xhr.status);
    			console.error("thrownError = "+thrownError);
    			$('#btn_reset_pin_code').show();
    			$('#loading_reset_pin_code').hide();
    		},
    	  success: function(html){
    			$('#btn_reset_pin_code').show();
    			$('#loading_reset_pin_code').hide();
    			process_reset_pin_code(html);
    	  }
    	});
    }
    function process_reset_pin_code(reponse){

    	console.log("process_reset_pin_code() "+reponse.success);
    	if(reponse.success=="yes"){
    		// $('#success_reset_pin_code').show();
        $("#reset_pin_code_password").val("");
    		swal({
    			title: 'Votre code PIN',
    			html: 'Votre code PIN a été bien réinitialiser<h2>'+reponse.pin_code+'</h2>',
    			type: 'info'
    		})
    	}else{

    		loop_errors_form(reponse.errors);

    		if(reponse.errors.reset_pin_code!=""){
    			swal({
    				title: 'Erreur',
    				text: reponse.errors.reset_pin_code,
    				timer: 4000,
    				type: 'error'
    			})
    		}

    	}
    }

    </script>
