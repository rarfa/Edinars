<script type="text/javascript">
  v_menu_id = "traders"
</script>

    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="javascript:;">Espace client</a></li>
        <li><a href="javascript:;">Marchants</a></li>
        <li class="active">Paiement simple</li>
    </ul>
    <!-- END BREADCRUMB -->

    <!-- TABS WIDGET -->
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default tabs">
          <ul class="nav nav-tabs nav-justified">
              <li class="active" id="li_simple_payment_tab1" ><a href="#simple_payment_tab1" data-toggle="tab" aria-expanded="true">CODE #1 - En utilisant la mèthode POST</a></li>
              <li class="" id="li_simple_payment_tab2"><a href="#simple_payment_tab2" data-toggle="tab" aria-expanded="false">Paramètres de retour</a></li>
          </ul>
          <div class="panel-body tab-content">
            <div class="tab-pane active" id="simple_payment_tab1">
              <!-- Remarque -->
              <div class="alert alert-warning" role="alert" id="confidentiality_note" >
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <strong>Remarque: Copiez ce code et coller dans votre page</strong>
              </div>
              <!-- END Remarque -->
              <div class="col-md-12 col-xs-12" style="text-align:center">
                <button class="btn btn-primary" type="button" onclick="copy_to_clipboard('#code_simple_paiement');" id="btn_code_simple_paiement"  name="btn_code_simple_paiement"><span class="fa fa-clone"></span>Copiez ce code</button>
                <div class="loader" id="loading_code_simple_paiement" name="loading_code_simple_paiement" style="float: right; display: none;"></div>
              </div>
              <div class="col-md-12 col-xs-12" style="text-align:center">
                <textarea  name="code_simple_paiement" id="code_simple_paiement" class="form-control" rows="20" style="margin-top:20px;">{code}</textarea>
              </div>
              <div class="row">
                <div class="col-md-12" style="margin-top:20px;">
                  <!-- LIST GROUP WITH BADGES -->
                  <div class="panel panel-default">
                      <div class="panel-heading ui-draggable-handle">
                          <h3 class="panel-title">Informations</h3>
                      </div>
                      <div class="panel-body">
                        <ul class="list-group border-bottom col-md-6">
                          <li class="list-group-item">Pincode (identifiant)<span class="badge"><span class="user_data_mem_id">82458999</span></span></li>
                        </ul>
                        <ul class="list-group border-bottom col-md-6">
                          <li class="list-group-item">Prehashkey (code secret)<span class="badge"><span class="user_data_prehashkey"></span></span></li>
                        </ul>
                      </div>
                  </div>
                  <!-- END LIST GROUP WITH BADGES -->
                </div>
              </div>


              <div class="panel panel-default" id="panel_faq_description">
                <div class="panel-body">
                    <h3 class="push-down-0">Description de tous les champs que vous pouvez utiliser</h3>
                    <p>Pour paiement autorisé, vous devez utiliser les paramètres suivant:</p>
                </div>
                <div class="panel-body faq">
                    <div class="faq-item">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>Identifiant</div>
                        <div class="faq-text">
                            <h5>A quoi ça sert identifiant?</h5>
                            <p>Votre Identifiant</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>Commande</div>
                        <div class="faq-text">
                            <h5>A quoi ça sert commande?</h5>
                            <p>Votre numéro de commande</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>Produit</div>
                        <div class="faq-text">
                            <h5>A quoi ça sert produit?</h5>
                            <p>Votre produit id ou le nom</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>Action</div>
                        <div class="faq-text">
                            <h5>A quoi ça sert action?</h5>
                            <ul>
                              <li>Utiliser "<b>produit</b>" si ce produit est pré-défini </li>
                              <li>Utiliser "<b>donation</b>" pour un paiement d'une donation </li>
                              <li>Utiliser "<b>abonnement</b>" pour un paiement d'une abonnement</li>
                              <li>Utiliser "<b>paiement</b>" pour un paiement simple</p>
                            </ul>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>Prix</div>
                        <div class="faq-text">
                            <h5>A quoi ça sert prix?</h5>
                            <p>Le prix du produit, DA</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>Quantite</div>
                        <div class="faq-text">
                            <h5>A quoi ça sert quantite?</h5>
                            <p>la quantité</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>Periode</div>
                        <div class="faq-text">
                            <h5>A quoi ça sert periode?</h5>
                            <p>la période de souscription refacturation, les jours</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>Essai</div>
                        <div class="faq-text">
                            <h5>A quoi ça sert essai?</h5>
                            <p>la période d'essai en jours</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>Installation</div>
                        <div class="faq-text">
                            <h5>A quoi ça sert Installation?</h5>
                            <p>Les frais d'installation en DA</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>TVA</div>
                        <div class="faq-text">
                            <h5>A quoi ça sert tva?</h5>
                            <p>Les frais TVA en DA</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>Livraison</div>
                        <div class="faq-text">
                            <h5>A quoi ça sert livraison?</h5>
                            <p>Les frais de la livraison en DA</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>Ureturn</div>
                        <div class="faq-text">
                            <h5>A quoi ça sert ureturn?</h5>
                            <p>Le lien de retour</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>unotify</div>
                        <div class="faq-text">
                            <h5>A quoi ça sert unotify?</h5>
                            <p>Le lien de notification</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>ucancel</div>
                        <div class="faq-text">
                            <h5>A quoi ça sert ucancel?</h5>
                            <p>Le lien d'annulation</p>
                        </div>
                    </div>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="simple_payment_tab2">
                <!-- Remarque -->
                <div class="alert alert-warning" role="alert" id="confidentiality_note" >
                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                  <strong>Remarque: Vous pouvez obtenir ces paramètres par la variable POST $_POST[--VARIABLE-NAME--]...</strong>
                </div>
                <!-- END Remarque -->
                <div class="panel panel-default" id="panel_faq_retour">
                  <div class="panel-body">
                      <h3 class="push-down-0">Paramètres de retour</h3>
                      <p>Après le succès du paiement le système transmettra acheteur pour votre site et certains paramètres seront de retour à votre script par la méthode POST:</p>
                  </div>
                  <div class="panel-body faq">
                      <div class="faq-item">
                          <div class="faq-title"><span class="fa fa-angle-down"></span>action</div>
                          <div class="faq-text">
                              <p>Type de transaction (produit / donation / abonnement / paiement)</p>
                          </div>
                      </div>
                      <div class="faq-item">
                          <div class="faq-title"><span class="fa fa-angle-down"></span>statut</div>
                          <div class="faq-text">
                              <p>Le statut de paiement</p>
                          </div>
                      </div>
                      <div class="faq-item">
                          <div class="faq-title"><span class="fa fa-angle-down"></span>trxid</div>
                          <div class="faq-text">
                              <p>L'identifiant de la transaction</p>
                          </div>
                      </div>
                      <div class="faq-item">
                          <div class="faq-title"><span class="fa fa-angle-down"></span>Commande</div>
                          <div class="faq-text">
                              <p>Votre numéro de commande</p>
                          </div>
                      </div>
                      <div class="faq-item">
                          <div class="faq-title"><span class="fa fa-angle-down"></span>pid</div>
                          <div class="faq-text">
                              <p>ID produit interne</p>
                          </div>
                      </div>
                      <div class="faq-item">
                          <div class="faq-title"><span class="fa fa-angle-down"></span>pname</div>
                          <div class="faq-text">
                              <p>Le nom de produit/service</p>
                          </div>
                      </div>
                      <div class="faq-item">
                          <div class="faq-title"><span class="fa fa-angle-down"></span>acheteur</div>
                          <div class="faq-text">
                              <p>L'identifiant de l'acheteur </p>
                          </div>
                      </div>
                      <div class="faq-item">
                          <div class="faq-title"><span class="fa fa-angle-down"></span>total</div>
                          <div class="faq-text">
                              <p>Le montant total </p>
                          </div>
                      </div>
                      <div class="faq-item">
                          <div class="faq-title"><span class="fa fa-angle-down"></span>quantite</div>
                          <div class="faq-text">
                              <p>La quantité</p>
                          </div>
                      </div>
                      <div class="faq-item">
                          <div class="faq-title"><span class="fa fa-angle-down"></span>commentaires</div>
                          <div class="faq-text">
                              <p>La note l'acheteur</p>
                          </div>
                      </div>
                      <div class="faq-item">
                          <div class="faq-title"><span class="fa fa-angle-down"></span>refrence</div>
                          <div class="faq-text">
                              <p>Le système, URL de référence (https://www.Erecovery.dz)</p>
                          </div>
                      </div>

                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END TABS WIDGET -->

    <script>
    // init faq
    init_faq();
    get_code_simple_paiement();

    // ########################## code_simple_paiement ##########################

    function get_code_simple_paiement(){
    	console.log("get_code_simple_paiement() ");
    	reset_error_form();

    	var str = $("#get_code_simple_paiement_form").serialize();
      str += append_access_token();

    	$('#btn_code_simple_paiement').hide();
    	$('#loading_code_simple_paiement').show();

    	$.ajax({
    		url: api_url + "get_code_simple_paiement.php",
    		cache: false,
    		data: str,
    		type:"post",
    		dataType: 'json',
    		error: function (xhr, ajaxOptions, thrownError) {
    			console.error("xhr.status = "+xhr.status);
    			console.error("thrownError = "+thrownError);
    			$('#btn_code_simple_paiement').show();
    			$('#loading_code_simple_paiement').hide();
    		},
    		success: function(html){
    			$('#btn_code_simple_paiement').show();
    			$('#loading_code_simple_paiement').hide();
    			process_get_code_simple_paiement(html);
    		}
    	});
    }

    function process_get_code_simple_paiement(reponse){

    	console.log("process_get_code_simple_paiement() "+reponse.success);
    	if(reponse.success=="yes"){
    		// $('#success_get_code_simple_paiement').show();
    		// noty({text: 'Votre profile a été modifié avec succès', layout: 'center', type: 'success', "timeout":3000});
    		$("#code_simple_paiement").html(decodeHtml(reponse.code));
    	}else{

    		noty({text: 'Erreur de récupération de code', layout: 'center', type: 'error', "timeout":3000});
    	}
    }

    </script>
