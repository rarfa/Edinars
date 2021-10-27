<script type="text/javascript">
  v_menu_id = "traders"
</script>

    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="javascript:;">Espace client</a></li>
        <li><a href="javascript:;">Marchants</a></li>
        <li class="active">Abonnements</li>
    </ul>
    <!-- END BREADCRUMB -->

    <!-- TABS WIDGET -->
    <div class="row">
      <div class="col-md-12">


        <div class="panel panel-default tabs">
            <ul class="nav nav-tabs nav-justified">
                <li class="active" id="li_subscriptions_tab1" ><a href="#subscriptions_tab1" data-toggle="tab" aria-expanded="true">Les abonnements</a></li>
                <li id="li_subscriptions_tab2" ><a href="#subscriptions_tab2" data-toggle="tab" aria-expanded="true">Les abonnés</a></li>
            </ul>
            <div class="panel-body tab-content">
              <div class="tab-pane active" id="subscriptions_tab1">
                <div class="col-md-12 col-xs-12" style="text-align:center">
                  <div class="loader" id="loading_get_subscriptions_list" name="loading_get_subscriptions_list" style="float: right; display: none;"></div>
                </div>


                <div class="row">
                  <div class="col-md-12">
                    <div class="panel panel-default">
                      <div class="panel-heading ui-draggable-handle">
                        <h3 class="panel-title">Liste des abonnements</h3>
                      </div>
                      <div class="panel-body">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>Nom</th>
                              <th>Prix</th>
                              <th>TVA</th>
                              <th>Livraison</th>
                              <th>Vendu</th>
                              <th width="160">Action</th>
                            </tr>
                          </thead>
                          <tbody id="tbody_subscriptions">
                            <tr>
                              <td>{Nom}</td>
                              <td>{Prix}</td>
                              <td>{TVA}</td>
                              <td>{Livraison}</td>
                              <td>{Vendu}</td>
                              <td>{Action}</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12" id="btn_show_more_history" style="text-align:center">
                    <button class="btn btn-primary" onclick="show_subscription_form('');"><span class="fa fa-plus"></span> Ajouter un abonnement</button>
                  </div>
                </div> <!-- ROW -->


              </div>
              <div class="tab-pane" id="subscriptions_tab2">
                <div class="col-md-12 col-xs-12" style="text-align:center">
                  <div class="loader" id="loading_get_subscribers_list" name="loading_get_subscribers_list" style="float: right; display: none;"></div>
                </div>


                <div class="row">
                  <div class="col-md-12">
                    <div class="panel panel-default">
                      <div class="panel-heading ui-draggable-handle">
                        <h3 class="panel-title">Liste des abonnés</h3>
                      </div>
                      <div class="panel-body">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>Membre</th>
                              <th>Nom</th>
                              <th>Prix</th>
                              <th>Période</th>
                              <th width="160">Action</th>
                            </tr>
                          </thead>
                          <tbody id="tbody_subscribers">
                            <tr>
                              <td>{Membre}</td>
                              <td>{Nom}</td>
                              <td>{Prix}</td>
                              <td>{Période}</td>
                              <td>{Action}</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div> <!-- ROW -->
              </div>
            </div>
            </div>
        </div>
      </div>
    </div>

    <!-- END TABS WIDGET -->

    <script>

    get_subscriptions_list();
    get_subscribers_list();


    // ################################# Subscribers #################################

    // get_subscribers_list
    function get_subscribers_list(){
    	console.log("get_subscribers_list() ");
    	reset_error_form();

    	var str = $("#get_subscribers_list_form").serialize();
      str += append_access_token();

    	$('#loading_get_subscribers_list').show();

    	$.ajax({
    		url: api_url + "get_subscribers_list.php",
    		cache: false,
    		data: str,
    		type:"post",
    		dataType: 'json',
    		error: function (xhr, ajaxOptions, thrownError) {
    			console.error("xhr.status = "+xhr.status);
    			console.error("thrownError = "+thrownError);
    			$('#loading_get_subscribers_list').hide();
    		},
    		success: function(html){
    			$('#loading_get_subscribers_list').hide();
    			process_get_subscribers_list(html);
    		}
    	});
    }

    function process_get_subscribers_list(reponse){

    	console.log("process_get_subscribers_list() "+reponse.success);

    	$('#tbody_subscribers').html("");

    	if(reponse.success=="yes"){
    		var raw_subscribers="";
    		for (var key in reponse["subscribers"]){

    			raw_subscribers = '';
    			raw_subscribers += '<tr>';
    			raw_subscribers += '<td>'+reponse["subscribers"][key].owner+'</td>';
    			raw_subscribers += '<td>'+reponse["subscribers"][key].nom+' DA</td>';
    			raw_subscribers += '<td>'+reponse["subscribers"][key].prix+' DA</td>';
    			raw_subscribers += '<td>'+reponse["subscribers"][key].periode+' DA</td>';
    			raw_subscribers += '<td>';
    			raw_subscribers += '<button class="btn btn-danger btn-rounded btn-sm" onclick="cancel_subscription(\''+reponse["subscribers"][key].id+'\');"><span class="fa fa-stop-circle"></span></button> ';
    			raw_subscribers += '</td>';
    			raw_subscribers += '</tr>';
    			$('#tbody_subscribers').append(raw_subscribers);
    		}
    	}else{

    		noty({text: 'Erreur', layout: 'center', type: 'error', "timeout":3000});
    	}
    }

    function cancel_subscription(subscription_id){
      console.log("cancel_subscription() ");
      reset_error_form();

      swal({
        title: "Êtes-vous sûr? ",
        text: "Êtes-vous sûr de vouloir annuler cet abonnement? ",
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
        var str = "subscription_id="+subscription_id+"&mode=cancel";
        str += "&from=website" + append_csrf_token_to_form();
        str += append_access_token();

        $.ajax({
          url: api_url + "edit_subscription.php",
          cache: false,
          data: str,
          type:"post",
          dataType: 'json',
          error: function (xhr, ajaxOptions, thrownError) {
            console.error("xhr.status = "+xhr.status);
            console.error("thrownError = "+thrownError);
          },
          success: function(html){
            process_cancel_subscription(html);
          }
        });
      }, function (dismiss) {
        // dismiss can be 'cancel', 'overlay',
        // 'close', and 'timer'
        if (dismiss === 'cancel') {
        }
      })
    }

    function process_cancel_subscription(reponse){

      console.log("process_cancel_subscription() "+reponse.success);
      if(reponse.success=="yes"){
        swal({
          title: 'Abonnement annulé',
          text: 'L\'abonnement a ètè annulè avec succès.',
          timer: 4000,
          type:  'success'
        })
        get_subscribers_list();
      }else{

        loop_errors_form(reponse.errors);

        if(reponse.errors.edit_subscription!=""){
          swal({
            title: 'L\'abonnement n\'a pas ètè annulè!',
            text: reponse.errors.edit_subscription,
            timer: 4000,
            type:  'error'
          })
        }

      }
    }

    // ################################# Subscriptions #################################
    // Edit get_subscriptions_list

    function get_subscriptions_list(){
    	console.log("get_subscriptions_list() ");
    	reset_error_form();

    	var str = $("#get_subscriptions_list_form").serialize();
      str += append_access_token();

    	$('#loading_get_subscriptions_list').show();

    	$.ajax({
    		url: api_url + "get_subscriptions_list.php",
    		cache: false,
    		data: str,
    		type:"post",
    		dataType: 'json',
    		error: function (xhr, ajaxOptions, thrownError) {
    			console.error("xhr.status = "+xhr.status);
    			console.error("thrownError = "+thrownError);
    			$('#loading_get_subscriptions_list').hide();
    		},
    		success: function(html){
    			$('#loading_get_subscriptions_list').hide();
    			process_get_subscriptions_list(html);
    		}
    	});
    }

    function process_get_subscriptions_list(reponse){

    	console.log("process_get_subscriptions_list() "+reponse.success);

    	$('#tbody_subscriptions').html("");

    	if(reponse.success=="yes"){
    		var raw_subscriptions="";
    		for (var key in reponse["subscriptions"]){

    			raw_subscriptions = '';
    			raw_subscriptions += '<tr>';
    			raw_subscriptions += '<td>'+reponse["subscriptions"][key].nom+'</td>';
    			raw_subscriptions += '<td>'+reponse["subscriptions"][key].prix+' DA</td>';
    			raw_subscriptions += '<td>'+reponse["subscriptions"][key].tva+' DA</td>';
    			raw_subscriptions += '<td>'+reponse["subscriptions"][key].livraison+' DA</td>';
    			raw_subscriptions += '<td>'+reponse["subscriptions"][key].sold+' ('+reponse["subscriptions"][key].vendu+' DA)</td>';
    			raw_subscriptions += '<td>';
    			raw_subscriptions += '<button class="btn btn-default btn-rounded btn-sm" onclick="show_subscription_form(\''+reponse["subscriptions"][key].id+'\');"><span class="fa fa-pencil"></span></button> ';
    			raw_subscriptions += '<button class="btn btn-default btn-rounded btn-sm" onclick="show_subscription_code_form(\''+reponse["subscriptions"][key].id+'\');"><span class="fa fa-code"></span></button> ';
    			raw_subscriptions += '<button class="btn btn-danger btn-rounded btn-sm" onclick="delete_subscription(\''+reponse["subscriptions"][key].id+'\');"><span class="fa fa-times"></span></button> ';
    			raw_subscriptions += '</td>';
    			raw_subscriptions += '</tr>';
    			$('#tbody_subscriptions').append(raw_subscriptions);
    		}
    	}else{

    		noty({text: 'Erreur', layout: 'center', type: 'error', "timeout":3000});
    	}
    }

    //delete subscription

    function delete_subscription(subscription_id){
    	console.log("delete_subscription() ");
    	reset_error_form();

    	swal({
    	  title: "Êtes-vous sûr? ",
    	  text: "Êtes-vous sûr de vouloir supprimer cet abonnement? ",
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
    		var str = "subscription_id="+subscription_id+"&mode=delete";
        str += "&from=website" + append_csrf_token_to_form();
        str += append_access_token();

    		$.ajax({
    		  url: api_url + "edit_subscription.php",
    		  cache: false,
    		  data: str,
    			type:"post",
    			dataType: 'json',
    			error: function (xhr, ajaxOptions, thrownError) {
    				console.error("xhr.status = "+xhr.status);
    				console.error("thrownError = "+thrownError);
    			},
    		  success: function(html){
    				process_delete_subscription(html);
    		  }
    		});
    	}, function (dismiss) {
    	  // dismiss can be 'cancel', 'overlay',
    	  // 'close', and 'timer'
    	  if (dismiss === 'cancel') {
    	  }
    	})
    }

    function process_delete_subscription(reponse){

    	console.log("process_delete_subscription() "+reponse.success);
    	if(reponse.success=="yes"){
    		swal({
    			title: 'Abonnement supprimé',
    			text: 'L\'abonnement a ètè supprimè avec succès.',
    			timer: 4000,
    			type:  'success'
    		})
    		get_subscriptions_list();
    	}else{

    		loop_errors_form(reponse.errors);

    		if(reponse.errors.edit_subscription!=""){
    			swal({
    				title: 'L\'abonnement n\'a pas ètè supprimè!',
    				text: reponse.errors.edit_subscription,
    				timer: 4000,
    				type:  'error'
    			})
    		}

    	}
    }


    // form subscription

    function show_subscription_code_form(subscription_id){
    	swal({
    	  title: "Code pour abonnement",
    		html:'<div class="loader" id="loading_subscription_code_form" name="loading_subscription_form" ></div>'
    					+'<div id="div_subscription_code_form"></div>',
    	  showCancelButton: true,
    	  cancelButtonText: "Fermer",
    		showConfirmButton: false,
    	  showLoaderOnConfirm: false,
    	  allowOutsideClick: false,
    		width : 650
    	})

    	load_form("subscription_code",function(){
    		$("#loading_subscription_code_form").show();
    		$("#div_subscription_code_form").hide();

        var str = "subscription_id=" + subscription_id;
        str += append_access_token();

    		$.ajax({
    			url: api_url + "get_subscription_code.php",
    			cache: false,
          data: str,
    			type:"post",
    			dataType: 'json',
    			error: function (xhr, ajaxOptions, thrownError) {
    				console.error("xhr.status = "+xhr.status);
    				console.error("thrownError = "+thrownError);
    				$("#loading_subscription_code_form").hide();
    				$("#div_subscription_code_form").show();
    			},
    			success: function(reponse){
    				//process_get_subscriptions_list(html);
    				$("#loading_subscription_code_form").hide();
    				$("#div_subscription_code_form").show();

    				$('.subscription_code_post').html(decodeHtml(reponse.code_post));
    				$('.subscription_code_get').html(decodeHtml(reponse.code_get));
    			}
    		});
    	});
    }


    function show_subscription_form(subscription_id){
    	var title, btn_title;
    	var html_form;
    	if(subscription_id==""){
    		title = "Ajouter un abonnement";
    		btn_title = "Ajouter";
    	}else{
    		title = "Modifier un abonnement";
    		btn_title = "Modifier";
    	}

    	swal({
    	  title: title,
    		html:'<div class="loader" id="loading_subscription_form" name="loading_subscription_form" ></div>'
    					+'<div id="div_subscription_form"></div>',
    	  showCancelButton: true,
    	  cancelButtonText: "Annuler",
    		showConfirmButton: false,
    	  showLoaderOnConfirm: false,
    	  allowOutsideClick: false,
    		width : 650
    	})

    	load_form("subscription",function(){
    		if(subscription_id!=""){
    			$("#loading_subscription_form").show();
    			$("#div_subscription_form").hide();

          var str = "subscription_id=" + subscription_id+"&mode=single";
          str += append_access_token();

    			$.ajax({
    				url: api_url + "get_subscriptions_list.php",
    				cache: false,
            data: str,
    				type:"post",
    				dataType: 'json',
    				error: function (xhr, ajaxOptions, thrownError) {
    					console.error("xhr.status = "+xhr.status);
    					console.error("thrownError = "+thrownError);
    					$("#loading_subscription_form").hide();
    					$("#div_subscription_form").show();
    				},
    				success: function(reponse){
    					//process_get_subscriptions_list(html);
    					$("#loading_subscription_form").hide();
    					$("#div_subscription_form").show();

    					$('#subscription_id').val(reponse.subscriptions[0].id);
    					$('#nom').val(reponse.subscriptions[0].nom);
    					$('#prix').val(reponse.subscriptions[0].prix);
    					$('#periode').val(reponse.subscriptions[0].periode);
    					$('#essai').val(reponse.subscriptions[0].essai);
    					$('#installation').val(reponse.subscriptions[0].installation);
    					$('#tva').val(reponse.subscriptions[0].tva);
    					$('#livraison').val(reponse.subscriptions[0].livraison);
    					$('#ureturn').val(reponse.subscriptions[0].ureturn);
    					$('#unotify').val(reponse.subscriptions[0].unotify);
    					$('#ucancel').val(reponse.subscriptions[0].ucancel);
    					$('#comments').val(reponse.subscriptions[0].comments);
    					$("input[value='"+reponse.subscriptions[0].button+"']").attr("checked", true);
    				}
    			});
    		}
    	});
    }


    function edit_subscription(){
    	console.log("edit_subscription() ");
    	reset_error_form();

    	var str = $("#edit_subscription_form").serialize()+"&mode=add";
      str += "&from=website" + append_csrf_token_to_form();
      str += append_access_token();

    	$('#loading_edit_subscription').show();
    	$('#btn_edit_subscription').hide();

    	$.ajax({
    		url: api_url + "edit_subscription.php",
    		cache: false,
    		data: str,
    		type:"post",
    		dataType: 'json',
    		error: function (xhr, ajaxOptions, thrownError) {
    			console.error("xhr.status = "+xhr.status);
    			console.error("thrownError = "+thrownError);
    			$('#loading_edit_subscription').hide();
    			$('#btn_edit_subscription').show();
    		},
    		success: function(html){
    			$('#loading_edit_subscription').hide();
    			$('#btn_edit_subscription').show();
    			process_edit_subscription(html);
    		}
    	});
    }

    function process_edit_subscription(reponse){

    	console.log("process_edit_subscription() "+reponse.success);
    	if(reponse.success=="yes"){
    		swal({
    		  title:reponse.title,
    		  text:reponse.description,
    			timer: 4000,
    		  type:'success'
    		});
    		get_subscriptions_list();
    	}else{

    		loop_errors_form(reponse.errors);

    		if(reponse.errors.edit_subscription!=""){
    			swal({
    				title: 'Abonnement!',
    				text: reponse.errors.edit_subscription,
    				timer: 4000,
    				type:  'error'
    			})
    		}

    	}
    }

    // # Edit get_subscriptions_list
    </script>
