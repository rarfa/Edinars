<script type="text/javascript">
  v_menu_id = "traders"
</script>

    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="javascript:;">Espace client</a></li>
        <li><a href="javascript:;">Marchants</a></li>
        <li class="active">Donations</li>
    </ul>
    <!-- END BREADCRUMB -->

    <!-- TABS WIDGET -->
    <div class="row">
      <div class="col-md-12">


        <div class="panel panel-default tabs">
            <ul class="nav nav-tabs nav-justified">
                <li class="active" id="li_donations_tab1" ><a href="#donations_tab1" data-toggle="tab" aria-expanded="true">Les Donations</a></li>
            </ul>
            <div class="panel-body tab-content">
                <div class="tab-pane active" id="donations_tab1">
                  <div class="col-md-12 col-xs-12" style="text-align:center">
                    <div class="loader" id="loading_get_donations_list" name="loading_get_donations_list" style="float: right; display: none;"></div>
                  </div>


                  <div class="row">
                    <div class="col-md-12">
                      <div class="panel panel-default">
                        <div class="panel-heading ui-draggable-handle">
                          <h3 class="panel-title">Liste des donations</h3>
                        </div>
                        <div class="panel-body">
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>Don pour</th>
                                <th>Total</th>
                                <th>Don</th>
                                <th width="160">Action</th>
                              </tr>
                            </thead>
                            <tbody id="tbody_donations">
                              <tr>
                                <td>{Nom}</td>
                                <td>{Prix}</td>
                                <td>{Vendu}</td>
                                <td>{Action}</td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-12" id="btn_show_more_history" style="text-align:center">
                      <button class="btn btn-primary" onclick="show_donation_form('');"><span class="fa fa-plus"></span> Ajouter une donation</button>
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

    get_donations_list();

    // ################################# donations #################################

    // Edit get_donations_list

    function get_donations_list(){
    	console.log("get_donations_list() ");
    	reset_error_form();

    	var str = $("#get_donations_list_form").serialize();
      str += append_access_token();

    	$('#loading_get_donations_list').show();

    	$.ajax({
    		url: api_url + "get_donations_list.php",
    		cache: false,
    		data: str,
    		type:"post",
    		dataType: 'json',
    		error: function (xhr, ajaxOptions, thrownError) {
    			console.error("xhr.status = "+xhr.status);
    			console.error("thrownError = "+thrownError);
    			$('#loading_get_donations_list').hide();
    		},
    		success: function(html){
    			$('#loading_get_donations_list').hide();
    			process_get_donations_list(html);
    		}
    	});
    }

    function process_get_donations_list(reponse){

    	console.log("process_get_donations_list() "+reponse.success);

    	$('#tbody_donations').html("");

    	if(reponse.success=="yes"){
    		var raw_donations="";
    		for (var key in reponse["donations"]){

    			raw_donations = '';
    			raw_donations += '<tr>';
    			raw_donations += '<td>'+reponse["donations"][key].nom+'</td>';
    			raw_donations += '<td>'+reponse["donations"][key].prix+' DA</td>';
    			raw_donations += '<td>'+reponse["donations"][key].sold+' ('+reponse["donations"][key].vendu+' DA)</td>';
    			raw_donations += '<td>';
    			raw_donations += '<button class="btn btn-default btn-rounded btn-sm" onclick="show_donation_form(\''+reponse["donations"][key].id+'\');"><span class="fa fa-pencil"></span></button> ';
    			raw_donations += '<button class="btn btn-default btn-rounded btn-sm" onclick="show_donation_code_form(\''+reponse["donations"][key].id+'\');"><span class="fa fa-code"></span></button> ';
    			raw_donations += '<button class="btn btn-danger btn-rounded btn-sm" onclick="delete_donation(\''+reponse["donations"][key].id+'\');"><span class="fa fa-times"></span></button> ';
    			raw_donations += '</td>';
    			raw_donations += '</tr>';
    			$('#tbody_donations').append(raw_donations);
    		}
    	}else{

    		noty({text: 'Erreur', layout: 'center', type: 'error', "timeout":3000});
    	}
    }

    //delete donation

    function delete_donation(donation_id){
    	console.log("delete_donation() ");
    	reset_error_form();

    	swal({
    	  title: "Êtes-vous sûr? ",
    	  text: "Êtes-vous sûr de vouloir supprimer cette donation? ",
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
    		var str = "donation_id="+donation_id+"&mode=delete";
        str += "&from=website" + append_csrf_token_to_form();
        str += append_access_token();

    		$.ajax({
    		  url: api_url + "edit_donation.php",
    		  cache: false,
    		  data: str,
    			type:"post",
    			dataType: 'json',
    			error: function (xhr, ajaxOptions, thrownError) {
    				console.error("xhr.status = "+xhr.status);
    				console.error("thrownError = "+thrownError);
    			},
    		  success: function(html){
    				process_delete_donation(html);
    		  }
    		});
    	}, function (dismiss) {
    	  // dismiss can be 'cancel', 'overlay',
    	  // 'close', and 'timer'
    	  if (dismiss === 'cancel') {
    	  }
    	})
    }

    function process_delete_donation(reponse){

    	console.log("process_delete_donation() "+reponse.success);
    	if(reponse.success=="yes"){
    		swal({
    			title: 'Donation supprimé',
    			text: 'La donation a ètè supprimè avec succès.',
    			timer: 4000,
    			type:  'success'
    		})
    		get_donations_list();
    	}else{

    		loop_errors_form(reponse.errors);

    		if(reponse.errors.edit_donation!=""){
    			swal({
    				title: 'La donation n\'a pas ètè supprimè!',
    				text: reponse.errors.edit_donation,
    				timer: 4000,
    				type:  'error'
    			})
    		}

    	}
    }

    // form donation

    function show_donation_code_form(donation_id){
    	swal({
    	  title: "Code pour donation",
    		html:'<div class="loader" id="loading_donation_code_form" name="loading_donation_form" ></div>'
    					+'<div id="div_donation_code_form"></div>',
    	  showCancelButton: true,
    	  cancelButtonText: "Fermer",
    		showConfirmButton: false,
    	  showLoaderOnConfirm: false,
    	  allowOutsideClick: false,
    		width : 650
    	})

    	load_form("donation_code",function(){
    		$("#loading_donation_code_form").show();
    		$("#div_donation_code_form").hide();

        var str = "donation_id="+donation_id;
        str += append_access_token();

    		$.ajax({
    			url: api_url + "get_donation_code.php",
    			cache: false,
          data:str,
    			type:"post",
    			dataType: 'json',
    			error: function (xhr, ajaxOptions, thrownError) {
    				console.error("xhr.status = "+xhr.status);
    				console.error("thrownError = "+thrownError);
    				$("#loading_donation_code_form").hide();
    				$("#div_donation_code_form").show();
    			},
    			success: function(reponse){
    				//process_get_donations_list(html);
    				$("#loading_donation_code_form").hide();
    				$("#div_donation_code_form").show();

    				$('.donation_code_post').html(decodeHtml(reponse.code_post));
    				$('.donation_code_get').html(decodeHtml(reponse.code_get));
    			}
    		});
    	});
    }


    function show_donation_form(donation_id){
    	var title, btn_title;
    	var html_form;
    	if(donation_id==""){
    		title = "Ajouter une donation";
    		btn_title = "Ajouter";
    	}else{
    		title = "Modifier une donation";
    		btn_title = "Modifier";
    	}

    	swal({
    	  title: title,
    		html:'<div class="loader" id="loading_donation_form" name="loading_donation_form" ></div>'
    					+'<div id="div_donation_form"></div>',
    	  showCancelButton: true,
    	  cancelButtonText: "Annuler",
    		showConfirmButton: false,
    	  showLoaderOnConfirm: false,
    	  allowOutsideClick: false,
    		width : 650
    	})

    	load_form("donation",function(){
    		if(donation_id!=""){
    			$("#loading_donation_form").show();
    			$("#div_donation_form").hide();

          var str = "donation_id="+donation_id+"&mode=single";
          str += append_access_token();

    			$.ajax({
    				url: api_url + "get_donations_list.php",
    				cache: false,
            data:str,
    				type:"post",
    				dataType: 'json',
    				error: function (xhr, ajaxOptions, thrownError) {
    					console.error("xhr.status = "+xhr.status);
    					console.error("thrownError = "+thrownError);
    					$("#loading_donation_form").hide();
    					$("#div_donation_form").show();
    				},
    				success: function(reponse){
    					//process_get_donations_list(html);
    					$("#loading_donation_form").hide();
    					$("#div_donation_form").show();

    					$('#donation_id').val(reponse.donations[0].id);
    					$('#nom').val(reponse.donations[0].nom);
    					$('#prix').val(reponse.donations[0].prix);
    					$('#tva').val(reponse.donations[0].tva);
    					$('#livraison').val(reponse.donations[0].livraison);
    					$('#ureturn').val(reponse.donations[0].ureturn);
    					$('#unotify').val(reponse.donations[0].unotify);
    					$('#ucancel').val(reponse.donations[0].ucancel);
    					$('#comments').val(reponse.donations[0].comments);

    					$("input[value='"+reponse.donations[0].button+"']").attr("checked", true);
    				}
    			});
    		}
    	});
    }


    function edit_donation(){
    	console.log("edit_donation() ");
    	reset_error_form();

    	var str = $("#edit_donation_form").serialize()+"&mode=add";
      str += "&from=website" + append_csrf_token_to_form();
      str += append_access_token();

    	$('#loading_edit_donation').show();
    	$('#btn_edit_donation').hide();

    	$.ajax({
    		url: api_url + "edit_donation.php",
    		cache: false,
    		data: str,
    		type:"post",
    		dataType: 'json',
    		error: function (xhr, ajaxOptions, thrownError) {
    			console.error("xhr.status = "+xhr.status);
    			console.error("thrownError = "+thrownError);
    			$('#loading_edit_donation').hide();
    			$('#btn_edit_donation').show();
    		},
    		success: function(html){
    			$('#loading_edit_donation').hide();
    			$('#btn_edit_donation').show();
    			process_edit_donation(html);
    		}
    	});
    }

    function process_edit_donation(reponse){

    	console.log("process_edit_donation() "+reponse.success);
    	if(reponse.success=="yes"){
    		swal({
    		  title:reponse.title,
    		  text:reponse.description,
    			timer: 4000,
    		  type:'success'
    		});
    		get_donations_list();
    	}else{

    		loop_errors_form(reponse.errors);

    		if(reponse.errors.edit_donation!=""){
    			swal({
    				title: 'Donation!',
    				text: reponse.errors.edit_donation,
    				timer: 4000,
    				type:  'error'
    			})
    		}

    	}
    }

    // # Edit get_donations_list



    </script>
