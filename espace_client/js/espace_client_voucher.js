//Service -> voucher
var voucher_infos;

function get_voucher_offers(callback){

  console.log("get_voucher_offers() ");

  var str="";
  str += append_access_token();
  //str += "&from=website" + append_csrf_token_to_form();
  $.ajax({
    url: api_url + "get_voucher_offers.php",
    cache: false,
    data: str,
    type:"post",
    dataType: 'json',
    error: function (xhr, ajaxOptions, thrownError) {
      console.error("xhr.status = "+xhr.status);
      console.error("thrownError = "+thrownError);
    },
    success: function(reponse){
      voucher_infos = reponse;
      if(typeof callback === "function"){
        callback();
      }
    }
  })
}

function show_voucher(action="", type_id=""){
  if(action==""){
    get_voucher_offers(function(){
      swal({
        title: " Recharge internet",
        html:'<p>Veillez choisir le type de carte de Recharge</p>'
        +'<a class="btn btn-primary btn-voucher" onclick="show_voucher(\'idoom\');"><img src="../images/voucher/idoom.png"></a> '
        +'<a class="btn btn-primary btn-voucher" onclick="show_voucher(\'4g\');"><img src="../images/voucher/4g.png"></a>',
        showCancelButton: true,
        cancelButtonText: "Fermer",
        showConfirmButton: false,
        showLoaderOnConfirm: false,
        allowOutsideClick: false,
        width : 650
      })
    });

  }else if(action=="idoom"){
    var offers_html = "";
    for (var key in voucher_infos.offers){
      if(voucher_infos.offers[key].voucher_type_id == 1){
        if(voucher_infos.offers[key].count_vouchers>0){
          offers_html += '<a class="btn btn-primary btn-voucher" onclick="confirm_purchase_voucher(\''+key+'\');"><img src="../images/voucher/idoom.png"><br><h2>'+voucher_infos.offers[key].price+' DA</h2></a>';
        }else{
          offers_html += '<a class="btn btn-primary btn-voucher" onclick="javascript:;"><img src="../images/voucher/idoom.png" ><br><h2  >'+voucher_infos.offers[key].price+' DA</h2></a>';
        }
      }
    }
    swal({
      title: " Recharge internet Idoom",
      html:'<p>Veillez choisir la carte de Recharge</p>' + offers_html,
      showCancelButton: true,
      cancelButtonText: "Fermer",
      showConfirmButton: false,
      showLoaderOnConfirm: false,
      allowOutsideClick: false,
      width : 650
    })
  }else if(action=="4g"){
    swal({
      title: " Recharge internet Idoom",
      html:'<p>Veillez choisir l\'opérateur</p>'
      +'<a class="btn btn-primary btn-voucher" onclick="show_voucher(\'4g_mobilis\', 2);"><h1>Mobilis</h1><img src="../images/voucher/4g_mobilis.png"><br></a>'
      +'<a class="btn btn-primary btn-voucher" onclick="show_voucher(\'4g_ooredoo\', 3);"><h1>Ooredoo</h1><img src="../images/voucher/4g_ooredoo.png"><br></a>'
      +'<a class="btn btn-primary btn-voucher" onclick="show_voucher(\'4g_djeezy\', 4);"><h1>Djeezy</h1><img src="../images/voucher/4g_djeezy.png"><br></a>',
      showCancelButton: true,
      cancelButtonText: "Fermer",
      showConfirmButton: false,
      showLoaderOnConfirm: false,
      allowOutsideClick: false,
      width : 650
    })
  }else if(action=="4g_mobilis" || action=="4g_ooredoo" || action=="4g_ooredoo"){
    var offers_html = "";

    for (var key in voucher_infos.offers){
      if(voucher_infos.offers[key].voucher_type_id == type_id){
        if(voucher_infos.offers[key].count_vouchers>0){
          offers_html += '<a class="btn btn-primary btn-voucher" onclick="confirm_purchase_voucher(\''+key+'\');"><img src="../images/voucher/'+action+'.png"><br><h2>'+voucher_infos.offers[key].price+' DA</h2></a>';
        }else{
          offers_html += '<a class="btn btn-primary btn-voucher" onclick="javascript:;"><img src="../images/voucher/'+action+'.png" style="opacity: 0.4" ><br><h2 style="opacity: 0.4" >'+voucher_infos.offers[key].price+' DA</h2></a>';
        }
      }
    }

    swal({
      title: " Recharge 4G Mobilis",
      html:'<p>Veillez choisir la carte de Recharge</p>' + offers_html,
      showCancelButton: true,
      cancelButtonText: "Fermer",
      showConfirmButton: false,
      showLoaderOnConfirm: false,
      allowOutsideClick: false,
      width : 650
    })
  }
}


function confirm_purchase_voucher(offer_id){
  swal({
    title: " Confirmation d'achat",
    html:'<p>Veillez confirmer l\'achat de <b>'+voucher_infos.offers[offer_id].offer_name+'</b></p>'
    +'<p>Prix : <b>'+voucher_infos.offers[offer_id].price+' DA</b></p>',
    type: 'question',
    showCancelButton: true,
    cancelButtonText: "Anuller",
    showConfirmButton: true,
    confirmButtonText: "Oui, Confirmer",
    showLoaderOnConfirm: false,
    allowOutsideClick: false,
    width : 650
  }).then((result) => {
    // confirm_purchase_voucher
    var str="offer_id="+voucher_infos.offers[offer_id].id;
    str += append_access_token();
    str += "&from=website" + append_csrf_token_to_form();
    $.ajax({
      url: api_url + "confirm_purchase_voucher.php",
      cache: false,
      data: str,
      type:"post",
      dataType: 'json',
      error: function (xhr, ajaxOptions, thrownError) {
        console.error("xhr.status = "+xhr.status);
        console.error("thrownError = "+thrownError);
      },
      success: function(reponse){
        if(reponse.success == "yes"){
          swal(
            'Achat de <b>'+reponse.offer+'</b>',
            '<p>Code de rechargement : <b>'+reponse.code+'</b></p>'
            +'<p>le code a été envoyer a votre adresse email (*) </p>',
            'success'
          )
        }else{
          swal(
            'Erreur d\'achat d\'une carte de rechargement',
            '<p>'+(reponse.errors.confirm_purchase_voucher || reponse.errors.csrf_token)+'</p>',
            'error'
          )
        }
      }
    })

  })
}
