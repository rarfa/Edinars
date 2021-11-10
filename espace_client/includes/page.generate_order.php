<script type="text/javascript">
  v_menu_id = "generate_order"
</script>
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="#">Espace client</a></li>
        <li><a href="./#settings/">Paiement</a></li>
        <li class="active">Générer une facture</li>
    </ul>
    <!-- END BREADCRUMB -->

    <!-- TABS WIDGET -->
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default tabs">
            <ul class="nav nav-tabs nav-justified">
                <li class="active" id="li_generate_order_tab1" ><a href="#generate_order_tab1" data-toggle="tab" aria-expanded="true">Générer une facture</a></li>
            </ul>
            <div class="panel-body tab-content">
                <div class="tab-pane active" id="generate_order_tab1">
                  <form class="form-horizontal" id="generate_order_form" name="generate_order_form" method="post" onsubmit="generate_order();return false;">
                    <div class="form-group">
                      <label class="col-md-3 col-xs-12 control-label">Montant*</label>
                      <div class="col-md-6 col-xs-12">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-money"></span></span>
                          <input type="number" class="form-control" id="amount" name="amount" required>
                        </div>
                        <span class="help-block">Entrer le montant en DA</span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 col-xs-12 control-label">N° de compte/Email*</label>
                      <div class="col-md-6 col-xs-12">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-mobile"></span></span>
                          <input type="text" class="form-control" id="member_id" name="member_id" required>
                        </div>
                        <span class="help-block">Entrer le numéro de compte</span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 col-xs-12 control-label">Description</label>
                      <div class="col-md-6 col-xs-12">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-lock"></span></span>
                          <input type="text" class="form-control" id="description" name="description">
                        </div>
                        <span class="help-block">Entrer une description</span>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="col-md-12 col-xs-12" style="text-align:center">
                        <div class="loader" id="loading_generate_order" name="loading_generate_order" style="float: right; display: none;"></div>
                        <button class="btn btn-primary" type="submit" id="btn_generate_order" name="btn_generate_order" disabled><span class="fa fa-paper-plane"></span>Envoyer</button>
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
    //edit profile
    $('#generate_order_form input').click(function() {
      // do something
      $("#btn_generate_order").attr("disabled", false);
      // alert("click");
    });

    // ############################################################################

    // generate_order

    function generate_order(){
    	console.log("generate_order() ");
    	reset_error_form();

    	var str = $("#generate_order_form").serialize();
      str += "&from=website" + append_csrf_token_to_form();
      str += append_access_token();

    	$('#btn_generate_order').hide();
    	$('#loading_generate_order').show();

    	$.ajax({
    	  url: api_url + "generate_order.php",
    	  cache: false,
    	  data: str,
    		type:"post",
    		dataType: 'json',
    		error: function (xhr, ajaxOptions, thrownError) {
    			console.error("xhr.status = "+xhr.status);
    			console.error("thrownError = "+thrownError);
    			$('#btn_generate_order').show();
    			$('#loading_generate_order').hide();
    		},
    	  success: function(html){
    			$('#btn_generate_order').show();
    			$('#loading_generate_order').hide();
    			process_generate_order(html);
    	  }
    	});
    }
    function process_generate_order(reponse){

    	console.log("process_generate_order() "+reponse.success);
    	if(reponse.success=="yes"){
        var url_qrcode_img = api_url+"qr.php?qr_type=order&trx_id="+reponse.trx_id+"&access_token="+append_access_token();
    		swal({
    		  title: 'La commande a été généré',
    		  html: reponse.transaction_description+"<br>"
                +'<img src="'+url_qrcode_img+'" /><br>'
                +'<br> N° transaction: <b>'+reponse.trx_id+'</b>',
    		  type: 'success'
    		})
    		//refresh_user_datas();
    		load_include_page("generate_order");
    	}else{

        loop_errors_form(reponse.errors);

        if(reponse.errors.generate_order!=""){
          swal({
            title: 'Erreur',
            text: reponse.errors.generate_order,
            timer: 4000,
            type: 'error'
          })
        }

    	}
    }

    // # generate_order

    </script>
