

<!-- START PAGE -->
<div class="row">
  <div class="col-md-6 col-xs-10 col-md-offset-3 col-xs-offset-1">
    <div class="panel panel-warning push-up-20">
      <div class="panel-heading">
        <h2 class="panel-title"><span class="fa fa-shopping-basket"></span> Détails de votre commande</h2>
      </div>
      <div class="panel-body panel-body-pricing">
        <h2 id="product_title_price"></h2>
      </div>

      <div class="panel-body list-group">
        <table class="table table-striped">
          <tbody id="tbody_checkout_info">
            <tr>
                <td></td>
                <td></td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="panel-body panel-body-pricing">
        <a href="javascript:;" class="tile tile-default" onclick="validate_commande();">
          <h1 class="widget-int num-count" id="checkout_total"></h1>
          <p>Acheter</p>
          <div class="informer informer-default"><span class="fa fa-shopping-cart"></span></div>
        </a>
      </div>

      <div class="panel-footer">
        <button class="btn btn-primary btn-block" onclick="validate_commande();"><span class="fa fa-shopping-cart"></span>Valider la commande</button>
        <a class="btn btn-link btn-block" href="javascript:;" id="checkout_cancel_link">Annuler</a>
      </div>
    </div>

  </div>
</div>
<!-- END PAGE -->


<!-- START Fill_loading -->
<div id="fill_loading" style="width: 100%; height: 100%; position: absolute; background:rgba(255,255,255,0.8);top:0px; ">
  <div class="loader" style="margin:25% auto;"></div>
</div>
<!-- END Fill_loading -->


<script type="text/javascript">
get_checkout();

// ################################# get_checkout #################################
function get_checkout(){
  console.log("get_checkout() ");
  reset_error_form();

  var str = $("#get_checkout_form").serialize();

  $('#fill_loading').show();

  $.ajax({
    url: api_url + "checkout.php",
    cache: false,
    data: str,
    type:"post",
    dataType: 'json',
    error: function (xhr, ajaxOptions, thrownError) {
      console.error("xhr.status = "+xhr.status);
      console.error("thrownError = "+thrownError);
      $('#fill_loading').hide();
    },
    success: function(html){
      $('#fill_loading').hide();
      process_get_checkout(html);
    }
  });
}

function process_get_checkout(reponse){

  console.log("process_get_checkout() "+reponse.success);


  if(reponse.success=="yes"){

    var str_to, object_str, price_str, total_str;
    total_str = '<b>'+reponse._total+' '+reponse.currency+'</b>';
    if(reponse.action!="donation"){
      str_to = "Faire une donation pour";
      object_str = "Objet";
      price_str = "Montant";
    }else{
       str_to = "Paiement pour";
       object_str = "Objet";
       price_str = "Prix";
    }

    $("#product_title_price").html('<small>'+reponse.product.nom+'</small>');
    $('#tbody_checkout_info').html("");
    $('#checkout_total').html(total_str);

    $('#tbody_checkout_info').append('<tr><td>'+str_to+'</td><td>'+reponse.owner+'</td></tr>');
    $('#tbody_checkout_info').append('<tr><td>'+object_str+'</td><td>'+reponse.product.nom+'</td></tr>');
    $('#tbody_checkout_info').append('<tr><td>'+price_str+'</td><td>'+reponse.product._prix+' '+reponse.currency+'</td></tr>');
    if(reponse.action!="donation"){
        $('#tbody_checkout_info').append('<tr><td>Quantitè :</td><td>'+reponse.quantite+'</td></tr>');
    }

    if(reponse.product.installation>0){
      $('#tbody_checkout_info').append('<tr><td>Frais d\'installation :</td><td>'+reponse.product.installation+'</td></tr>');
    }

    if(reponse.product.tva>0){
      $('#tbody_checkout_info').append('<tr><td>TVA</td><td>'+reponse.product.tva+' '+reponse.currency+'</td></tr>');
    }

    if(reponse.product.livraison>0){
      $('#tbody_checkout_info').append('<tr><td>La livraison / Manipulation</td><td>'+reponse.product.livraison+' '+reponse.currency+'</td></tr>');
    }

    if(reponse.product.periode>0){
      $('#tbody_checkout_info').append('<tr><td>Duré:</td><td>'+reponse.product.periode+' Jour(s)</td></tr>');
    }

    if(reponse.product.essai>0){
      $('#tbody_checkout_info').append('<tr><td>Duré:</td><td>'+reponse.product.essai+' Jour(s)</td></tr>');
    }

    if(reponse.product.comments>0){
      $('#tbody_checkout_info').append('<tr><td>Description :</td><td>'+reponse.product._comments+'</td></tr>');
    }

    $('#tbody_checkout_info').append('<tr><td>Total :</td><td>'+total_str+'</td></tr>');
    $('#checkout_cancel_link').attr("href", reponse.product.ucancel);

  }else{

    noty({text: 'Erreur', layout: 'center', type: 'error', "timeout":3000});
    setTimeout(function(){
      location.href='./';
    }, 3000)
  }
}

// ################################# checkout #################################
function validate_commande() {
  console.log("validate_commande()");
  // console.log(user_datas);
  if(user_datas.success=="no"){
    $('#login-modal').modal('show');
  }else{
    $('#login-modal').modal('hide');
    console.log("user logged "+user_datas.success);

    show_note_checkout_form();
  }

}

function show_note_checkout_form(){
  var form_name = "note_checkout";
  swal({
		title: "Paiement de commande",
		html:'<div class="loader" id="loading_'+form_name+'_form" name="loading_product_form" ></div>'
					+'<div id="div_'+form_name+'_form"></div>',
		showCancelButton: true,
		cancelButtonText: "Annuler",
		showConfirmButton: false,
		showLoaderOnConfirm: false,
		allowOutsideClick: false,
		width : 650
	})

  load_form(form_name,function(){
    $("#loading_"+form_name+"_form").hide();
    $("#div_"+form_name+"_form").show();
  });
}

function post_validate_commande(){
  console.log('post_validate_commande()');

  var str = $("#get_checkout_form").serialize()+"&mode=validate";
  str += "&note=" + $("#checkout_note").val();
  str += "&from=website" + append_csrf_token_to_form();
  str += append_access_token();

  $('#fill_loading').show();
  $('#loading_note_checkout_form').show();
  $('#div_note_checkout_form').hide();

  $.ajax({
    url: api_url + "checkout.php",
    cache: false,
    data: str,
    type:"post",
    dataType: 'json',
    error: function (xhr, ajaxOptions, thrownError) {
      console.error("xhr.status = "+xhr.status);
      console.error("thrownError = "+thrownError);
      $('#fill_loading').hide();
      $('#loading_note_checkout_form').hide();
      $('#div_note_checkout_form').hide();
    },
    success: function(html){
      //$('#fill_loading').hide();
      $('#loading_note_checkout_form').hide();
      $('#div_note_checkout_form').hide();
      process_validate_commande(html);
    }
  });
}

function process_validate_commande(reponse) {
  console.log('process_validate_commande()'+reponse.success);
  //console.log(reponse);
  if(reponse.success=="yes"){
    swal({
			title:'Paiement effectué avec succes',
			html:'N° transaction:<b>'+reponse.trxid+'</b>'
					+'<br>Montant: <b>'+reponse.total+' DA</b>',
			timer: 4000,
			type:'success'
		});

    //redirect
		setTimeout(function(){
      location.href = reponse.product.ureturn;
    }, 4000);
  }else{
    $('#fill_loading').hide();
    if(reponse.errors.confirm_payment!=""){
      swal({
        title: 'Erreur de paiement!',
        text: reponse.errors.validate,
        timer: 4000,
        type:  'error'
      })
    }
  }
}

</script>
