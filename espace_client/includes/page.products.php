<script type="text/javascript">
  v_menu_id = "traders"
</script>

    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="javascript:;">Espace client</a></li>
        <li><a href="javascript:;">Marchants</a></li>
        <li class="active">Produits</li>
    </ul>
    <!-- END BREADCRUMB -->

    <!-- TABS WIDGET -->
    <div class="row">
      <div class="col-md-12">


        <div class="panel panel-default tabs">
            <ul class="nav nav-tabs nav-justified">
                <li class="active" id="li_products_tab1" ><a href="#products_tab1" data-toggle="tab" aria-expanded="true">Les Produits/Services</a></li>
            </ul>
            <div class="panel-body tab-content">
                <div class="tab-pane active" id="products_tab1">
                  <div class="col-md-12 col-xs-12" style="text-align:center">
                    <div class="loader" id="loading_get_products_list" name="loading_get_products_list" style="float: right; display: none;"></div>
                  </div>


                  <div class="row">
                    <div class="col-md-12">
                      <div class="panel panel-default">
                        <div class="panel-heading ui-draggable-handle">
                          <h3 class="panel-title">Liste des produits</h3>
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
                            <tbody id="tbody_products">
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
                      <button class="btn btn-primary" onclick="show_product_form('');"><span class="fa fa-plus"></span> Ajouter un produit</button>
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

    get_products_list();

    // ################################# products #################################

    // Edit get_products_list

    function get_products_list(){
    	console.log("get_products_list() ");
    	reset_error_form();

    	var str = $("#get_products_list_form").serialize();
      str += append_access_token();

    	$('#loading_get_products_list').show();

    	$.ajax({
    		url: api_url + "get_products_list.php",
    		cache: false,
    		data: str,
    		type:"post",
    		dataType: 'json',
    		error: function (xhr, ajaxOptions, thrownError) {
    			console.error("xhr.status = "+xhr.status);
    			console.error("thrownError = "+thrownError);
    			$('#loading_get_products_list').hide();
    		},
    		success: function(html){
    			$('#loading_get_products_list').hide();
    			process_get_products_list(html);
    		}
    	});
    }

    function process_get_products_list(reponse){

    	console.log("process_get_products_list() "+reponse.success);

    	$('#tbody_products').html("");

    	if(reponse.success=="yes"){
    		var raw_products="";
    		for (var key in reponse["products"]){

    			raw_products = '';
    			raw_products += '<tr>';
    			raw_products += '<td>'+reponse["products"][key].nom+'</td>';
    			raw_products += '<td>'+reponse["products"][key].prix+' DA</td>';
    			raw_products += '<td>'+reponse["products"][key].tva+' DA</td>';
    			raw_products += '<td>'+reponse["products"][key].livraison+' DA</td>';
    			raw_products += '<td>'+reponse["products"][key].sold+' ('+reponse["products"][key].vendu+' DA)</td>';
    			raw_products += '<td>';
    			raw_products += '<button class="btn btn-default btn-rounded btn-sm" onclick="show_product_form(\''+reponse["products"][key].id+'\');"><span class="fa fa-pencil"></span></button> ';
    			raw_products += '<button class="btn btn-default btn-rounded btn-sm" onclick="show_product_code_form(\''+reponse["products"][key].id+'\');"><span class="fa fa-code"></span></button> ';
    			raw_products += '<button class="btn btn-danger btn-rounded btn-sm" onclick="delete_product(\''+reponse["products"][key].id+'\');"><span class="fa fa-times"></span></button> ';
    			raw_products += '</td>';
    			raw_products += '</tr>';
    			$('#tbody_products').append(raw_products);
    		}
    	}else{

    		noty({text: 'Erreur', layout: 'center', type: 'error', "timeout":3000});
    	}
    }

    //delete product

    function delete_product(product_id){
    	console.log("delete_product() ");
    	reset_error_form();

    	swal({
    	  title: "Êtes-vous sûr? ",
    	  text: "Êtes-vous sûr de vouloir supprimer ce produit? ",
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
    		var str = "product_id="+product_id+"&mode=delete";
        str += "&from=website" + append_csrf_token_to_form();
        str += append_access_token();

    		$.ajax({
    		  url: api_url + "edit_product.php",
    		  cache: false,
    		  data: str,
    			type:"post",
    			dataType: 'json',
    			error: function (xhr, ajaxOptions, thrownError) {
    				console.error("xhr.status = "+xhr.status);
    				console.error("thrownError = "+thrownError);
    			},
    		  success: function(html){
    				process_delete_product(html);
    		  }
    		});
    	}, function (dismiss) {
    	  // dismiss can be 'cancel', 'overlay',
    	  // 'close', and 'timer'
    	  if (dismiss === 'cancel') {
    	  }
    	})
    }

    function process_delete_product(reponse){

    	console.log("process_delete_product() "+reponse.success);
    	if(reponse.success=="yes"){
    		swal({
    			title: 'Produit supprimé',
    			text: 'Le produit a ètè supprimè avec succès.',
    			timer: 4000,
    			type:  'success'
    		})
    		get_products_list();
    	}else{
        loop_errors_form(reponse.errors);

    		if(reponse.errors.edit_product!=""){
    			swal({
    				title: 'Le produit n\'a pas ètè supprimè!',
    				text: reponse.errors.edit_product,
    				timer: 4000,
    				type:  'error'
    			})
    		}

    	}
    }

    // form product

    function show_product_code_form(product_id){
    	swal({
    	  title: "Code pour produit",
    		html:'<div class="loader" id="loading_product_code_form" name="loading_product_form" ></div>'
    					+'<div id="div_product_code_form"></div>',
    	  showCancelButton: true,
    	  cancelButtonText: "Fermer",
    		showConfirmButton: false,
    	  showLoaderOnConfirm: false,
    	  allowOutsideClick: false,
    		width : 650
    	})

    	load_form("product_code",function(){
    		$("#loading_product_code_form").show();
    		$("#div_product_code_form").hide();

        var str = "product_id="+product_id;
        str += append_access_token();

    		$.ajax({
    			url: api_url + "get_product_code.php",
    			cache: false,
          data: str,
    			type:"post",
    			dataType: 'json',
    			error: function (xhr, ajaxOptions, thrownError) {
    				console.error("xhr.status = "+xhr.status);
    				console.error("thrownError = "+thrownError);
    				$("#loading_product_code_form").hide();
    				$("#div_product_code_form").show();
    			},
    			success: function(reponse){
    				//process_get_products_list(html);
    				$("#loading_product_code_form").hide();
    				$("#div_product_code_form").show();

    				$('.product_code_post').html(decodeHtml(reponse.code_post));
    				$('.product_code_get').html(decodeHtml(reponse.code_get));
    			}
    		});
    	});
    }


    function show_product_form(product_id){
    	var title, btn_title;
    	var html_form;
    	if(product_id==""){
    		title = "Ajouter un produit";
    		btn_title = "Ajouter";
    	}else{
    		title = "Modifier un produit";
    		btn_title = "Modifier";
    	}

    	swal({
    	  title: title,
    		html:'<div class="loader" id="loading_product_form" name="loading_product_form" ></div>'
    					+'<div id="div_product_form"></div>',
    	  showCancelButton: true,
    	  cancelButtonText: "Annuler",
    		showConfirmButton: false,
    	  showLoaderOnConfirm: false,
    	  allowOutsideClick: false,
    		width : 650
    	})

    	load_form("product",function(){
    		if(product_id!=""){
    			$("#loading_product_form").show();
    			$("#div_product_form").hide();

          var str = "product_id="+product_id+"&mode=single";
          str += append_access_token();

    			$.ajax({
    				url: api_url + "get_products_list.php",
    				cache: false,
            data: str,
    				type:"post",
    				dataType: 'json',
    				error: function (xhr, ajaxOptions, thrownError) {
    					console.error("xhr.status = "+xhr.status);
    					console.error("thrownError = "+thrownError);
    					$("#loading_product_form").hide();
    					$("#div_product_form").show();
    				},
    				success: function(reponse){
    					//process_get_products_list(html);
    					$("#loading_product_form").hide();
    					$("#div_product_form").show();

    					$('#product_id').val(reponse.products[0].id);
    					$('#nom').val(reponse.products[0].nom);
    					$('#prix').val(reponse.products[0].prix);
    					$('#tva').val(reponse.products[0].tva);
    					$('#livraison').val(reponse.products[0].livraison);
    					$('#ureturn').val(reponse.products[0].ureturn);
    					$('#unotify').val(reponse.products[0].unotify);
    					$('#ucancel').val(reponse.products[0].ucancel);
    					$('#comments').val(reponse.products[0].comments);

    					$("input[value='"+reponse.products[0].button+"']").attr("checked", true);
    				}
    			});
    		}
    	});
    }


    function edit_product(){
    	console.log("edit_product() ");
    	reset_error_form();

    	var str = $("#edit_product_form").serialize()+"&mode=add";
      str += "&from=website" + append_csrf_token_to_form();
      str += append_access_token();


    	$('#loading_edit_product').show();
    	$('#btn_edit_product').hide();

    	$.ajax({
    		url: api_url + "edit_product.php",
    		cache: false,
    		data: str,
    		type:"post",
    		dataType: 'json',
    		error: function (xhr, ajaxOptions, thrownError) {
    			console.error("xhr.status = "+xhr.status);
    			console.error("thrownError = "+thrownError);
    			$('#loading_edit_product').hide();
    			$('#btn_edit_product').show();
    		},
    		success: function(html){
    			$('#loading_edit_product').hide();
    			$('#btn_edit_product').show();
    			process_edit_product(html);
    		}
    	});
    }

    function process_edit_product(reponse){

    	console.log("process_edit_product() "+reponse.success);
    	if(reponse.success=="yes"){
    		swal({
    		  title:reponse.title,
    		  text:reponse.description,
    			timer: 4000,
    		  type:'success'
    		});
    		get_products_list();
    	}else{
        loop_errors_form(reponse.errors);

    		if(reponse.errors.edit_product!=""){
    			swal({
    				title: 'Produit!',
    				text: reponse.errors.edit_product,
    				timer: 4000,
    				type:  'error'
    			})
    		}

    	}
    }

    // # Edit get_products_list

    </script>
