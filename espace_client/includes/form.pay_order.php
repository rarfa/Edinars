<div class="row">
  <div class="col-md-12">
    <p> Entrer votre code PIN pour confirmer le paiement suivant.</p>
    <p>N°: <b id="order_trxid"></b></p>
    <p>Montant: <b id="order_nets"></b></p>

    <form class="form-horizontal" id="pay_order_form" name="pay_order_form" method="post" onsubmit="pay_order();return false;">
      <div class="form-group">
        <label class="col-md-3 col-xs-12 control-label"></label>
        <div class="col-md-6 col-xs-12">
          <div class="input-group">
            <span class="input-group-addon"><span class="fa fa-lock"></span></span>
            <input type="password" class="form-control" id="code_pin" name="code_pin" required placeholder="Code pin ****">
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="col-md-12 col-xs-12" style="text-align:center">
          <input type="hidden" name="trx_id" id="trx_id" value="">
          <div class="loader" id="loading_pay_order" name="loading_pay_order" style="float: right; display: none;"></div>
          <button class="btn btn-primary" type="submit" id="btn_pay_order" name="btn_pay_order"><span class="fa fa-paper-plane"></span>Payer</button>
        </div>
      </div>
    </form>
  </div>
</div>
