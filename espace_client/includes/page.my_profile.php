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
        <!-- Remarque -->
        <div class="alert alert-warning" role="alert" id="my_profile_note" style="display:none">
          <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
          <strong>Remarque:</strong> Avant l'utilisation de notre système, vous devez remplir les formulaires de votre profil et Address.
        </div>
        <!-- END Remarque -->

        <div class="panel panel-default tabs">
            <ul class="nav nav-tabs nav-justified">
                <li class="active" id="li_my_profile_tab1" ><a href="#my_profile_tab1" data-toggle="tab" aria-expanded="true"><span class="fa fa-user"></span> Mon Profile</a></li>
                <li class="" id="li_my_profile_tab2"><a href="#my_profile_tab2" data-toggle="tab" aria-expanded="false"><span class="fa fa-map-marker"></span> Mon Adresse</a></li>
                <li class="" id="li_my_profile_tab3"><a href="#my_profile_tab3" data-toggle="tab" aria-expanded="false"><span class="fa fa-briefcase"></span> Mon Entreprise</a></li>
                <li class="" id="li_my_profile_tab4"><a href="#my_profile_tab4" data-toggle="tab" aria-expanded="false"><span class="fa fa-envelope"></span> Mes Emails</a></li>
            </ul>
            <div class="panel-body tab-content">
                <div class="tab-pane active" id="my_profile_tab1">
                  <form class="form-horizontal" id="edit_profile_form" name="edit_profile_form" method="post" onsubmit="edit_profile();return false;">
                    <div class="form-group">
                      <label class="col-md-3 col-xs-12 control-label">Email</label>
                      <div class="col-md-6 col-xs-12">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-envelope"></span></span>
                          <input type="email" class="form-control input_user_data_email" readonly>
                        </div>
                        <span class="help-block">Entrez votre email</span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 col-xs-12 control-label">Nom*</label>
                      <div class="col-md-6 col-xs-12">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                          <input type="text" class="form-control input_user_data_lastname readonly_if_not_empty" id="lastname" name="lastname" required>
                        </div>
                        <span class="help-block">Entrez votre nom</span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 col-xs-12 control-label">Prenom*</label>
                      <div class="col-md-6 col-xs-12">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                          <input type="text" class="form-control input_user_data_firstname readonly_if_not_empty" id="firstname" name="firstname" required>
                        </div>
                        <span class="help-block">Entrez votre prénom</span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-md-3 col-xs-12 control-label">Type de compte*</label>
                      <div class="col-md-6 col-xs-12">
                        <div class="">
                          <!-- <span class="input-group-addon"></span> -->
                          <select class="btn-group  form-control select input_user_data_type_account_id readonly_if_not_empty" id="type_account" name="type_account" required >
                            <option value="">Sélectionnez le type de compte</option>
                            <option value="0">Particuliers</option>
                            <option value="1">Professionnels</option>
                          </select>
                          <!-- <input type="text" class="form-control input_user_data_type_account" readonly> -->
                        </div>
                        <span class="help-block">Sélectionnez le type de votre compte</span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 col-xs-12 control-label">Téléphone</label>
                      <div class="col-md-6 col-xs-12">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-phone"></span></span>
                          <input type="text" class="form-control mask_phone input_user_data_phone" id="phone" name="phone" >
                        </div>
                        <span class="help-block">Entrez votre numéro de téléphone, ex: 021000000</span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 col-xs-12 control-label">Mobile*</label>
                      <div class="col-md-6 col-xs-12">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-mobile"></span></span>
                          <input type="text" class="form-control input_user_data_mobile" id="mobile" name="mobile" required >
                          <span class="input-group-addon confirmed_mobile" ><span class="fa fa-check-circle-o"></span> Confirmé</span>
                          <span class="input-group-addon not_confirmed_mobile" style="background:red;border-color:red;cursor:pointer" onclick="show_confirmation_mobile();"><span class="fa fa-check-circle-o"></span> Non confirmé</span>
                        </div>
                        <span class="help-block">Entrez votre numéro de mobile, ex: 0550000000</span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 col-xs-12 control-label">Fax</label>
                      <div class="col-md-6 col-xs-12">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-fax"></span></span>
                          <input type="text" class="form-control input_user_data_fax" id="fax" name="fax">
                        </div>
                        <span class="help-block">Entrez votre numéro de fax, ex: 021000000</span>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-12 col-xs-12" style="text-align:center">
                        <div class="loader" id="loading_edit_profile" name="loading_edit_profile" style="float: right; display: none;"></div>
                        <button class="btn btn-primary" type="submit" id="btn_edit_profile" name="btn_edit_profile" disabled><span class="fa fa-pencil"></span>Enregistrer</button>
                      </div>
                    </div>
                  </form>

                </div>
                <div class="tab-pane" id="my_profile_tab2">
                  <form class="form-horizontal" id="edit_address_form" name="edit_address_form" method="post" onsubmit="edit_address();return false;">
                    <div class="form-group">
                      <label class="col-md-3 col-xs-12 control-label">Adresse*</label>
                      <div class="col-md-6 col-xs-12">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-map-marker"></span></span>
                          <input type="text" class="form-control input_user_data_address" id="address" name="address" required>
                        </div>
                        <span class="help-block">Entrez votre adresse</span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 col-xs-12 control-label">Commune*</label>
                      <div class="col-md-6 col-xs-12">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                          <input type="text" class="form-control input_user_data_city" id="city" name="city" required>
                        </div>
                        <span class="help-block">Entrez votre Commune</span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 col-xs-12 control-label">Code postal*</label>
                      <div class="col-md-6 col-xs-12">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                          <input type="text" class="form-control input_user_data_postcode" id="postcode" name="postcode" required>
                        </div>
                        <span class="help-block">Entrez votre code postal</span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-md-3 col-xs-12 control-label">Wilaya*</label>
                      <div class="col-md-6 col-xs-12">
                        <div class="">
                          <!-- <span class="input-group-addon"></span> -->
                          <select class="btn-group form-control select input_user_data_wilaya" id="wilaya" name="wilaya" required >
                            <!-- <option value="">Sélectionner votre wilaya</option> -->
                          </select>
                          <!-- <input type="text" class="form-control input_user_data_type_account" readonly> -->
                        </div>
                        <span class="help-block">Sélectionnez votre wilaya</span>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-12 col-xs-12" style="text-align:center">
                        <div class="loader" id="loading_edit_address" name="loading_edit_address" style="float: right; display: none;"></div>
                        <button class="btn btn-primary" type="submit" id="btn_edit_address" name="btn_edit_address" disabled><span class="fa fa-pencil"></span>Enregistrer</button>
                      </div>
                    </div>
                  </form>

                </div>
                <div class="tab-pane" id="my_profile_tab3">
                  <form class="form-horizontal" id="edit_entreprise_form" name="edit_entreprise_form" method="post" onsubmit="edit_entreprise();return false;">
                    <div class="form-group">
                      <label class="col-md-3 col-xs-12 control-label">Nom de société*</label>
                      <div class="col-md-6 col-xs-12">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                          <input type="text" class="form-control input_user_data_company" id="company" name="company" required>
                        </div>
                        <span class="help-block">Entrez le Nom votre société</span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 col-xs-12 control-label">N° RC*</label>
                      <div class="col-md-6 col-xs-12">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                          <input type="text" class="form-control input_user_data_nrc" id="nrc" name="nrc" required>
                        </div>
                        <span class="help-block">Entrez votre N° RC</span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 col-xs-12 control-label">N° NIF*</label>
                      <div class="col-md-6 col-xs-12">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                          <input type="text" class="form-control input_user_data_nnif" id="nnif" name="nnif" required>
                        </div>
                        <span class="help-block">Entrez votre N° NIF</span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 col-xs-12 control-label">N° ART*</label>
                      <div class="col-md-6 col-xs-12">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                          <input type="text" class="form-control input_user_data_nart" id="nart" name="nart" required>
                        </div>
                        <span class="help-block">Entrez votre code N° ART</span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 col-xs-12 control-label">N° FIS*</label>
                      <div class="col-md-6 col-xs-12">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                          <input type="text" class="form-control input_user_data_nfis" id="nfis" name="nfis" required>
                        </div>
                        <span class="help-block">Entrez votre code N° FIS</span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 col-xs-12 control-label">Logo*</label>
                      <div class="col-md-6 col-xs-12">
                        <div class="input-group">
                          <input type="file" name="logo" id="logo" class="validate[required] text-input" required>
                          <!-- <input type="text" class="form-control input_user_data_nfis" id="nfis" name="nfis" required> -->
                        </div>
                        <span class="help-block">La taille maximal 500x500px</span>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-12 col-xs-12" style="text-align:center">
                        <div class="loader" id="loading_edit_entreprise" name="loading_edit_entreprise" style="float: right; display: none;"></div>
                        <button class="btn btn-primary" type="submit" id="btn_edit_entreprise" name="btn_edit_entreprise" disabled><span class="fa fa-pencil"></span>Enregistrer</button>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="tab-pane" id="my_profile_tab4">
                  <p>Gérer les adresses emails</p>
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped table-actions">
                        <thead>
                            <tr>
                                <th width="50">Primaire</th>
                                <th>Email</th>
                                <th width="100">Statut</th>
                                <th width="100">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_emails_list">
                            <tr id="trow_1">
                                <td class="text-center">{Primaire}</td>
                                <td><strong>{Email}</strong></td>
                                <td><span class="label label-success">{Status}</span></td>
                                <td>
                                    <button class="btn btn-default btn-rounded btn-sm"><span class="fa fa-pencil"></span></button>
                                    <button class="btn btn-danger btn-rounded btn-sm" onclick="delete_row('trow_1');"><span class="fa fa-times"></span></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                  </div>

                  <form class="form-horizontal" id="add_email_form" name="add_email_form" method="post" onsubmit="add_email();return false;">

                    <div class="form-group">
                      <label class="col-md-3 col-xs-12 control-label"><h3>Ajouter un email</h3></label>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 col-xs-12 control-label">Email*</label>
                      <div class="col-md-6 col-xs-12">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-envelope"></span></span>
                          <input type="email" class="form-control" id="newmail" name="newmail" required>
                        </div>
                        <span class="help-block">Entrez votre email</span>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-12 col-xs-12" style="text-align:center">
                        <div class="loader" id="loading_add_email" name="loading_add_email" style="float: right; display: none;"></div>
                        <button class="btn btn-primary" type="submit" id="btn_add_email" name="btn_add_email" disabled><span class="fa fa-plus"></span>Enregistrer</button>
                      </div>
                    </div>
                  </form>
                </div><!-- my_profile_tab4 -->
            </div>
        </div>
      </div>
    </div>

    <!-- END TABS WIDGET -->

    <script>


    //edit profile
    $('#edit_profile_form input').click(function() {
      // do something
      $("#btn_edit_profile").attr("disabled", false);
      // alert("click");
    });

    // $("#phone").mask('999 99 99 99');
    // $("#mobile").mask('9999 99 99 99');
    // $("#fax").mask('999 99 99 99');

    //edit adresse
    $('#edit_address_form input').click(function() {
      // do something
      $("#btn_edit_address").attr("disabled", false);
      // alert("click");
    });
    // $("#postcode").mask('99999');

    //edit entreprise
    $('#edit_entreprise_form input').click(function() {
      // do something
      $("#btn_edit_entreprise").attr("disabled", false);
      // alert("click");
    });

    //add_email
    $('#add_email_form input').click(function() {
      // do something
      $("#btn_add_email").attr("disabled", false);
      // alert("click");
    });


    // ############################ profile ############################

    function edit_profile(){
    	console.log("edit_profile() ");
    	reset_error_form();

    	var str = $("#edit_profile_form").serialize();
      str += "&from=website" + append_csrf_token_to_form();
      str += append_access_token();

    	$('#btn_edit_profile').hide();
    	$('#loading_edit_profile').show();

      $.ajax({
    	  url: api_url + "edit_profile.php",
    	  cache: false,
    	  data: str,
    		type:"post",
    		dataType: 'json',
    		error: function (xhr, ajaxOptions, thrownError) {
    			console.error("xhr.status = "+xhr.status);
    			console.error("thrownError = "+thrownError);
    			$('#btn_edit_profile').show();
    			$('#loading_edit_profile').hide();
    		},
    	  success: function(html){
    			$('#btn_edit_profile').show();
    			$('#loading_edit_profile').hide();
    			process_edit_profile(html);
    	  }
    	});

    }
    function process_edit_profile(reponse){

    	console.log("process_edit_profile() "+reponse.success);
    	if(reponse.success=="yes"){
    		swal({
    		  title: 'Profile modifié',
    		  html: 'Votre profile a été modifié avec succès',
    			timer: 4000,
    		  type: 'success'
    		})
    		$("#my_profile_note").hide();
    		//refresh_user_datas();
    		load_include_page("my_profile");
    	}else{
    		loop_errors_form(reponse.errors);
    	}
    }

    // ############################ entreprise ############################
    function edit_entreprise(){
    	console.log("edit_entreprise() ");
    	reset_error_form();

    	var str = $("#edit_entreprise_form").serialize();
      str += "&from=website" + append_csrf_token_to_form();
      str += append_access_token();

    	$('#btn_edit_entreprise').hide();
    	$('#loading_edit_entreprise').show();

    	$.ajax({
    	  url: api_url + "edit_entreprise.php",
    	  cache: false,
    	  data: str,
    		type:"post",
    		dataType: 'json',
    		error: function (xhr, ajaxOptions, thrownError) {
    			console.error("xhr.status = "+xhr.status);
    			console.error("thrownError = "+thrownError);
    			$('#btn_edit_entreprise').show();
    			$('#loading_edit_entreprise').hide();
    		},
    	  success: function(html){
    			$('#btn_edit_entreprise').show();
    			$('#loading_edit_entreprise').hide();
    			process_edit_entreprise(html);
    	  }
    	});
    }
    function process_edit_entreprise(reponse){

    	console.log("process_edit_entreprise() "+reponse.success);
    	if(reponse.success=="yes"){
    		// $('#success_edit_entreprise').show();
    		// noty({text: 'Votre entreprise a été modifié avec succès', layout: 'center', type: 'success', "timeout":3000});
    		swal({
    			title: 'Entreprise modifié',
    			text: 'Votre entreprise a été modifié avec succès',
    			timer: 4000,
    			type: 'success'
    		})
    		$("#my_profile_note").hide();
    		// refresh_user_datas();
    		// load_include_page("index");
    		location.href="./#/";
    	}else{

    		loop_errors_form(reponse.errors);
    	}
    }

    // ############################ address ############################
    function edit_address(){
    	console.log("edit_address() ");
    	reset_error_form();

    	var str = $("#edit_address_form").serialize();
      str += "&from=website" + append_csrf_token_to_form();
      str += append_access_token();

    	$('#btn_edit_address').hide();
    	$('#loading_edit_address').show();

    	$.ajax({
    	  url: api_url + "edit_address.php",
    	  cache: false,
    	  data: str,
    		type:"post",
    		dataType: 'json',
    		error: function (xhr, ajaxOptions, thrownError) {
    			console.error("xhr.status = "+xhr.status);
    			console.error("thrownError = "+thrownError);
    			$('#btn_edit_address').show();
    			$('#loading_edit_address').hide();
    		},
    	  success: function(html){
    			$('#btn_edit_address').show();
    			$('#loading_edit_address').hide();
    			process_edit_address(html);
    	  }
    	});
    }
    function process_edit_address(reponse){

    	console.log("process_edit_address() "+reponse.success);
    	if(reponse.success=="yes"){
    		// $('#success_edit_address').show();
    		// noty({text: 'Votre address a été modifié avec succès', layout: 'center', type: 'success', "timeout":3000});

    		swal({
    			title: 'Adresse modifié',
    			text: 'Votre adresse a été modifié avec succès',
    			timer: 4000,
    			type: 'success'
    		})
    		$("#my_profile_note").hide();
    		//refresh_user_datas();
    		// load_include_page("index");
    		location.href="./#/";
    	}else{

    		loop_errors_form(reponse.errors);
    	}
    }

    // ############################ email ############################
    function add_email(){
    	console.log("add_email() ");
    	reset_error_form();

    	var str = $("#add_email_form").serialize()+"&mode=add";
      str += "&from=website" + append_csrf_token_to_form();
      str += append_access_token();

    	$('#btn_add_email').hide();
    	$('#loading_add_email').show();

    	$.ajax({
    	  url: api_url + "edit_email.php",
    	  cache: false,
    	  data: str,
    		type:"post",
    		dataType: 'json',
    		error: function (xhr, ajaxOptions, thrownError) {
    			console.error("xhr.status = "+xhr.status);
    			console.error("thrownError = "+thrownError);
    			$('#btn_add_email').show();
    			$('#loading_add_email').hide();
    		},
    	  success: function(html){
    			$('#btn_add_email').show();
    			$('#loading_add_email').hide();
    			process_add_email(html);
    	  }
    	});
    }
    function process_add_email(reponse){

    	console.log("process_add_email() "+reponse.success);
    	if(reponse.success=="yes"){
    		// $('#success_add_email').show();
    		// noty({text: 'Votre entreprise a été modifié avec succès', layout: 'center', type: 'success', "timeout":3000});

    		swal({
    			title: 'Email ajouté',
    			text: 'Nouvelle adresse e-mail a ètè ajouté avec succès.<br> Vèrifiez votre boite e-mail pour l\'activer.',
    			timer: 4000,
    			type: 'success'
    		})
    		refresh_user_datas();
    	}else{

    		loop_errors_form(reponse.errors);

    		if(reponse.errors.edit_email!=""){

    			swal({
    				title: 'Email non ajouté',
    				text: reponse.errors.edit_email,
    				timer: 4000,
    				type: 'error'
    			})
    		}

    	}
    }

    function set_primary_email(email){
    	console.log("set_primary_email() ");
    	reset_error_form();

    	swal({
    	  title: "Êtes-vous sûr? ",
    	  text: "Êtes-vous sûr de vouloir définir cette email comme email pricipale? ",
    	  type: 'warning',
    	  showCancelButton: true,
    	  confirmButtonColor: '#3085d6',
    	  cancelButtonColor: '#d33',
    	  confirmButtonText: 'Oui',
    	  cancelButtonText: 'Non, annuler!',
    	  confirmButtonClass: 'btn btn-success',
    	  cancelButtonClass: 'btn btn-danger',
    	  buttonsStyling: false
    	}).then(function () { //send
    		var str = "email="+email+"&mode=primary";
        str += "&from=website" + append_csrf_token_to_form();
        str += append_access_token();

    		$.ajax({
    		  url: api_url + "edit_email.php",
    		  cache: false,
    		  data: str,
    			type:"post",
    			dataType: 'json',
    			error: function (xhr, ajaxOptions, thrownError) {
    				console.error("xhr.status = "+xhr.status);
    				console.error("thrownError = "+thrownError);
    			},
    		  success: function(html){
    				process_set_primary_email(html);
    		  }
    		});
    	}, function (dismiss) {
    	  // dismiss can be 'cancel', 'overlay',
    	  // 'close', and 'timer'
    	  if (dismiss === 'cancel') {
    	  }
    	})

    }
    function process_set_primary_email(reponse){

    	console.log("process_set_primary_email() "+reponse.success);
    	if(reponse.success=="yes"){
    		// $('#success_add_email').show();

    		swal({
    			title: 'Email primaire',
    			text: 'Cette adresse e-mail a ètè définie comme email pricipale.',
    			timer: 4000,
    			type: 'success'
    		})
    		refresh_user_datas();
    	}else{

    		loop_errors_form(reponse.errors);

    		if(reponse.errors.edit_email!=""){
    			swal({
    				title: 'E-mail n\'a pas ètè définie comme email pricipale',
    				text: reponse.errors.edit_email,
    				timer: 4000,
    				type: 'error'
    			})
    		}

    	}
    }

    function delete_email(email){
    	console.log("delete_email() ");
    	reset_error_form();

    	swal({
    	  title: "Êtes-vous sûr? ",
    	  text: "Êtes-vous sûr de vouloir supprimer cette email? ",
    	  type: 'warning',
    	  showCancelButton: true,
    	  confirmButtonColor: '#3085d6',
    	  cancelButtonColor: '#d33',
    	  confirmButtonText: 'Oui',
    	  cancelButtonText: 'Non, annuler!',
    	  confirmButtonClass: 'btn btn-success',
    	  cancelButtonClass: 'btn btn-danger',
    	  buttonsStyling: false
    	}).then(function () { //send
    		var str = "email="+email+"&mode=delete";
        str += "&from=website" + append_csrf_token_to_form();
        str += append_access_token();

    		$.ajax({
    		  url: api_url + "edit_email.php",
    		  cache: false,
    		  data: str,
    			type:"post",
    			dataType: 'json',
    			error: function (xhr, ajaxOptions, thrownError) {
    				console.error("xhr.status = "+xhr.status);
    				console.error("thrownError = "+thrownError);
    			},
    		  success: function(html){
    				process_delete_email(html);
    		  }
    		});
    	}, function (dismiss) {
    	  // dismiss can be 'cancel', 'overlay',
    	  // 'close', and 'timer'
    	  if (dismiss === 'cancel') {
    	  }
    	})
    }

    function process_delete_email(reponse){

    	console.log("process_delete_email() "+reponse.success);
    	if(reponse.success=="yes"){

    		swal({
    			title: 'Email supprimé',
    			text: 'Votre e-mail a ètè supprimè avec succès.',
    			timer: 4000,
    			type: 'success'
    		})
    		refresh_user_datas();
    	}else{

    		loop_errors_form(reponse.errors);

    		if(reponse.errors.edit_email!=""){
    			swal({
    				title: 'Votre e-mail n\'a pas ètè supprimè!',
    				text: reponse.errors.edit_email,
    				timer: 4000,
    				type: 'error'
    			})
    		}

    	}
    }

    </script>
