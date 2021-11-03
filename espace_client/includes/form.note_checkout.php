<div class="row">
  <div class="col-md-12">
    <form class="form-horizontal" id="note_checkout_form" name="note_checkout_form" method="post" onsubmit="post_validate_commande();return false;">
      <div class="form-group">
        <label class="col-md-3 col-xs-12 control-label"></label>
        <div class="col-md-6 col-xs-12">
          <div class="input-group">
            <span class="input-group-addon"><span class="fa fa-commenting"></span></span>
            <textarea class="form-control" id="checkout_note" name="checkout_note" placeholder="Entrer une note (optionel)" rows="5"></textarea>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="col-md-12 col-xs-12" style="text-align:center">
          <input type="hidden" name="trx_id" id="trx_id" value="">
          <div class="loader" id="loading_note_checkout" name="loading_note_checkout" style="float: right; display: none;"></div>
          <button class="btn btn-primary" type="submit" id="btn_note_checkout" name="btn_note_checkout"><span class="fa fa-paper-plane"></span>Valider</button>
        </div>
      </div>
    </form>
  </div>
</div>
