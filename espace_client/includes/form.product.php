<form class="form-horizontal" id="edit_product_form" name="edit_product_form" method="post" onsubmit="edit_product();return false;">
  <div class="form-group">
    <div class="col-md-12 col-xs-12">
      <div class="input-group">
        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
        <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom de produit/service *" required>
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
            <input class="radio" type="radio" id="button_1" name="button" value="01.png" >&nbsp;
          </div>
          <div class="col-md-9 col-xs-12">
            <img src="../images/buttons/single/01.png" align="middle">
          </div>
        </div>
        <div class="row">
          <div class="col-md-3 col-xs-12">
            <input class="radio" type="radio" id="button_2" name="button" value="02.png">&nbsp;
          </div>
          <div class="col-md-9 col-xs-12">
            <img src="../images/buttons/single/02.png" align="middle">
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="col-md-12 col-xs-12" style="text-align:center">
      <input type="hidden" name="product_id" id="product_id" value="">
      <div class="loader" id="loading_edit_product" name="loading_edit_product" style="float: right; display: none;"></div>
      <button class="btn btn-primary" type="submit" id="btn_edit_product" name="btn_edit_product" ><span class="fa fa-paper-plane"></span>Valider</button>
    </div>
  </div>
</form>
