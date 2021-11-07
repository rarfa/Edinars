<script type="text/javascript">
  v_menu_id = "services"
</script>
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="#">Espace client</a></li>
        <li><a href="./#settings/">Service</a></li>
        <li class="active">Recharger un mobile</li>
    </ul>
    <!-- END BREADCRUMB -->

    <!-- TABS WIDGET -->
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default tabs">
            <ul class="nav nav-tabs nav-justified">
                <li class="active" id="li_mobile_recharge_tab1" ><a href="#mobile_recharge_tab1" data-toggle="tab" aria-expanded="true">Recharger un mobile</a></li>
            </ul>
            <div class="panel-body tab-content">
                <div class="tab-pane active" id="mobile_recharge_tab1">
                  <form class="form-horizontal" id="mobile_recharge_form" name="mobile_recharge_form" method="post" onsubmit="mobile_recharge();return false;">
                    <div class="form-group">
                      <label class="col-md-3 col-xs-12 control-label">Numéro de mobile*</label>
                      <div class="col-md-6 col-xs-12">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-mobile"></span></span>
                          <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>
                        <span class="help-block">Entrez votre numéro de téléphone, ex: 0550000000</span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 col-xs-12 control-label">Montant*</label>
                      <div class="col-md-6 col-xs-12">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-money"></span></span>
                          <input type="number" class="form-control" id="amount" name="amount" required>
                        </div>
                        <span class="help-block">Entrez le montant en DA</span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 col-xs-12 control-label">Code pin*</label>
                      <div class="col-md-6 col-xs-12">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-lock"></span></span>
                          <input type="password" class="form-control" id="code_pin" name="code_pin" required>
                        </div>
                        <span class="help-block">Entrez votre code pin</span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-md-3 col-xs-12 control-label">Type*</label>
                      <div class="col-md-6 col-xs-12">
                        <div class="">
                          <!-- <span class="input-group-addon"></span> -->
                          <select class="btn-group  form-control select input_user_data_recharge_type" id="type" name="type" required >

                          </select>
                          <!-- <input type="text" class="form-control input_user_data_type_account" readonly> -->
                        </div>
                        <span class="help-block">Sélectionnez le type de votre recharge</span>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-12 col-xs-12" style="text-align:center">
                        <div class="loader" id="loading_mobile_recharge" name="loading_mobile_recharge" style="float: right; display: none;"></div>
                        <button class="btn btn-primary" type="submit" id="btn_mobile_recharge" name="btn_mobile_recharge" disabled><span class="fa fa-paper-plane"></span>Envoyer</button>
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
    $('#mobile_recharge_form input').click(function() {
      // do something
      $("#btn_mobile_recharge").attr("disabled", false);
      // alert("click");
    });

    //$("#phone").mask('9999 99 99 99');

    $('#mobile_recharge_form #phone').change(function() {
      generate_recharge_types();
    })
    $('#mobile_recharge_form #type').on('change', function() {
      var optionSelected = $("option:selected", this);
      var amount = offers[prefix][optionSelected.attr("key")].amount;
      if(amount>0){
        $("#mobile_recharge_form #amount").val(amount).attr("readonly", true);
      }else{
        $("#mobile_recharge_form #amount").attr("readonly", false);
      }
    })






    get_offers();

    // ####################### mobile_recharge #######################
    var offers, prefix;

    function generate_recharge_types(){
      $('#mobile_recharge_form #type').html('<option value="">Type recharge?</option>');
      prefix = $('#mobile_recharge_form #phone').val().substring(0,2);
      //alert(prefix);
      jQuery.each(offers[prefix], function(key, val) {
        var id = offers[prefix][key].id;
        var name = offers[prefix][key].name;
        var amount = offers[prefix][key].amount;
        $('#mobile_recharge_form #type').append('<option value="'+id+'" key="'+key+'" >'+name+'</option>');
      })

    }

    function get_offers(){
      console.log("get_offers() ");
      var str = "";
      $('#btn_mobile_recharge').hide();
    	$('#loading_mobile_recharge').show();

      $.ajax({
    	  url: api_url + "get_mobile_recharge_offers.php",//"http://dzflex.edinars.net/api/beta/offer_json.php",
    	  cache: false,
    	  data: str,
    		type:"post",
    		dataType: 'json',
    		error: function (xhr, ajaxOptions, thrownError) {
    			console.error("xhr.status = "+xhr.status);
    			console.error("thrownError = "+thrownError);
    			$('#btn_mobile_recharge').show();
    			$('#loading_mobile_recharge').hide();
    		},
    	  success: function(reponse){
    			$('#btn_mobile_recharge').show();
    			$('#loading_mobile_recharge').hide();
    			offers = reponse.offers;
    	  }
    	});
    }


    function mobile_recharge(){
    	console.log("mobile_recharge() ");
    	reset_error_form();

    	var str = $("#mobile_recharge_form").serialize();
      str += "&from=website" + append_csrf_token_to_form();
      str += append_access_token();

    	$('#btn_mobile_recharge').hide();
    	$('#loading_mobile_recharge').show();


    	$.ajax({
    	  url: api_url + "mobile_recharge.php",
    	  cache: false,
    	  data: str,
    		type:"post",
    		dataType: 'json',
    		error: function (xhr, ajaxOptions, thrownError) {
    			console.error("xhr.status = "+xhr.status);
    			console.error("thrownError = "+thrownError);
    			$('#btn_mobile_recharge').show();
    			$('#loading_mobile_recharge').hide();
    		},
    	  success: function(html){
    			$('#btn_mobile_recharge').show();
    			$('#loading_mobile_recharge').hide();
    			process_mobile_recharge(html);
    	  }
    	});
    }
    function process_mobile_recharge(reponse){

    	console.log("process_mobile_recharge() "+reponse.success);
    	if(reponse.success=="yes"){
    		swal({
    		  title: 'Recharge mobile',
    		  html: +'<br>Le crédit a été bien envoyé avec succes'
          +'<br>Numéro: <b>'+reponse.phone+'</b>'
          +'<br>Montant: <b>'+reponse.amount+' DA</b>',
    			timer: 4000,
    		  type: 'success'
    		})
    		//refresh_user_datas();
    		load_include_page("mobile_recharge");
    	}else{
        loop_errors_form(reponse.errors);

        if(reponse.errors.mobile_recharge!=""){
          swal({
            title: 'Erreur',
            html: reponse.errors.mobile_recharge,
            timer: 4000,
            type: 'error'
          })
        }

    	}
    }

    // # mobile_recharge

    </script>
