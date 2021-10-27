<script type="text/javascript">
  v_menu_id = "load_account"
</script>
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="#">Espace client</a></li>
        <li><a href="./#settings/">Paiement</a></li>
        <li class="active">Recharger un compte</li>
    </ul>
    <!-- END BREADCRUMB -->

    <!-- TABS WIDGET -->
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default tabs">
            <ul class="nav nav-tabs nav-justified">
                <li class="active" id="li_load_account_tab1" ><a href="#load_account_tab1" data-toggle="tab" aria-expanded="true">Recharger un compte</a></li>
            </ul>
            <div class="panel-body tab-content">
                <div class="tab-pane active" id="load_account_tab1">
                  <form class="form-horizontal" id="load_account_form" name="load_account_form" method="post" onsubmit="load_account();return false;">
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
                      <label class="col-md-3 col-xs-12 control-label">N° de compte*</label>
                      <div class="col-md-6 col-xs-12">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-mobile"></span></span>
                          <input type="text" class="form-control" id="member_id" name="member_id" required>
                        </div>
                        <span class="help-block">Entrer le numéro de compte</span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 col-xs-12 control-label">Code pin*</label>
                      <div class="col-md-6 col-xs-12">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-lock"></span></span>
                          <input type="text" class="form-control" id="code_pin" name="code_pin" required>
                        </div>
                        <span class="help-block">Entrer votre code pin</span>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="col-md-12 col-xs-12" style="text-align:center">
                        <div class="loader" id="loading_load_account" name="loading_load_account" style="float: right; display: none;"></div>
                        <button class="btn btn-primary" type="submit" id="btn_load_account" name="btn_load_account" disabled><span class="fa fa-paper-plane"></span>Envoyer</button>
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
    $('#load_account_form input').click(function() {
      // do something
      $("#btn_load_account").attr("disabled", false);
      // alert("click");
    });

    // ############################################################################

    // load_account

    function load_account(){
    	console.log("load_account() ");
    	reset_error_form();

    	var str = $("#load_account_form").serialize();
      str += "&from=website" + append_csrf_token_to_form();
      str += append_access_token();

    	$('#btn_load_account').hide();
    	$('#loading_load_account').show();

    	$.ajax({
    	  url: api_url + "load_account.php",
    	  cache: false,
    	  data: str,
    		type:"post",
    		dataType: 'json',
    		error: function (xhr, ajaxOptions, thrownError) {
    			console.error("xhr.status = "+xhr.status);
    			console.error("thrownError = "+thrownError);
    			$('#btn_load_account').show();
    			$('#loading_load_account').hide();
    		},
    	  success: function(html){
    			$('#btn_load_account').show();
    			$('#loading_load_account').hide();
    			process_load_account(html);
    	  }
    	});
    }
    function process_load_account(reponse){

    	console.log("process_load_account() "+reponse.success);
    	if(reponse.success=="yes"){
    		swal({
    		  title: 'Recharge un compte',
    		  html: reponse.transaction[0]["ecomments"],
    			timer: 4000,
    		  type: 'success'
    		})
    		//refresh_user_datas();
    		load_include_page("load_account");
    	}else{
        loop_errors_form(reponse.errors);

        if(reponse.errors.load_account!=""){ //fatal error
          swal({
            title: 'Erreur',
            html: reponse.errors.load_account,
            timer: 4000,
            type: 'error'
          })
        }

    	}
    }

    // # load_account

    </script>
