<form class="form-horizontal" id="edit_subscription_form" name="edit_subscription_form" method="post" onsubmit="edit_subscription();return false;">
  <div class="form-group">
    <div class="col-md-12 col-xs-12">
      <div class="input-group">
        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
        <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom d'abonnement *" required>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-md-12 col-xs-12">
      <div class="input-group">
        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
        <input type="text" class="form-control" id="prix" name="prix" placeholder="Prix/Montant, DA *" required>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-md-12 col-xs-12">
      <div class="input-group">
        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
        <input type="text" class="form-control" id="periode" name="periode" placeholder="Durée (jours) *" required>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-md-12 col-xs-12">
      <div class="input-group">
        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
        <input type="text" class="form-control" id="essai" name="essai" placeholder="Période d'essai : (Jours)" >
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-md-12 col-xs-12">
      <div class="input-group">
        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
        <input type="text" class="form-control" id="installation" name="installation" placeholder="Frais d'installation en DA" >
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="col-md-12 col-xs-12">
      <div class="input-group">
        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
        <input type="text" class="form-control" id="tva" name="tva" placeholder="TVA, DA *" required>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-md-12 col-xs-12">
      <div class="input-group">
        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
        <input type="text" class="form-control" id="livraison" name="livraison" placeholder="Livraison, DA">
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-md-12 col-xs-12">
      <div class="input-group">
        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
        <input type="url" class="form-control" id="ureturn" name="ureturn" placeholder="URL de Retour *" required>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-md-12 col-xs-12">
      <div class="input-group">
        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
        <input type="url" class="form-control" id="unotify" name="unotify" placeholder="URL de Notification *" required>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-md-12 col-xs-12">
      <div class="input-group">
        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
        <input type="url" class="form-control" id="ucancel" name="ucancel" placeholder="URL de Annulation *" required>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-md-12 col-xs-12">
      <div class="input-group">
        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
        <textarea class="form-control" id="comments" name="comments" placeholder="Description"></textarea>
      </div>
    </div>
  </div>
  <div class="form-group">
    <label class="col-md-3 col-xs-12 control-label">Sèlectionner un bouton*</label>
    <div class="col-md-6 col-xs-12">
      <div class="input-group">
        <span id="button"></span>
        <div class="row">
          <div class="col-md-3 col-xs-12">
            <input class="radio" type="radio" id="button_1" name="button" value="Abonnement-1.png" >&nbsp;
          </div>
          <div class="col-md-9 col-xs-12">
            <img src="../images/buttons/subscriptions/Abonnement-1.png" align="middle">
          </div>
        </div>
        <div class="row">
          <div class="col-md-3 col-xs-12">
            <input class="radio" type="radio" id="button_2" name="button" value="abonnement-2.png">&nbsp;
          </div>
          <div class="col-md-9 col-xs-12">
            <img src="../images/buttons/subscriptions/abonnement-2.png" align="middle">
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="col-md-12 col-xs-12" style="text-align:center">
      <input type="hidden" name="subscription_id" id="subscription_id" value="">
      <div class="loader" id="loading_edit_subscription" name="loading_edit_subscription" style="float: right; display: none;"></div>
      <button class="btn btn-primary" type="submit" id="btn_edit_subscription" name="btn_edit_subscription" ><span class="fa fa-paper-plane"></span>Valider</button>
    </div>
  </div>
</form>
