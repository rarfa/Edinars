<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default tabs">
      <ul class="nav nav-tabs nav-justified">
          <li class="active" id="li_subscription_code_tab1" ><a href="#subscription_code_tab1" data-toggle="tab" aria-expanded="true">CODE : mèthode POST</a></li>
          <li class="" id="li_subscription_code_tab2"><a href="#subscription_code_tab2" data-toggle="tab" aria-expanded="false">CODE : mèthode GET</a></li>
      </ul>
      <div class="panel-body tab-content">
        <div class="tab-pane active" id="subscription_code_tab1">
          <!-- Remarque -->
          <div class="alert alert-warning" role="alert" id="confidentiality_note" >
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <strong>Remarque: Copiez ce code et coller dans votre page</strong>
          </div>
          <!-- END Remarque -->
          <div class="col-md-12 col-xs-12" style="text-align:center">
            <button class="btn btn-primary" type="button" onclick="copy_to_clipboard('#subscription_code_post');" id="btn_code_simple_paiement"  name="btn_code_simple_paiement"><span class="fa fa-clone"></span>Copiez ce code</button>
          </div>
          <div class="col-md-12 col-xs-12" style="text-align:center">
            <textarea  name="subscription_code_post" id="subscription_code_post" class="form-control subscription_code_post" rows="12" style="margin-top:20px;">{code}</textarea>
          </div>

          <div class="col-md-12 col-xs-12" style="text-align:center;margin-top:20px;">
            <h3>Exemple</h3>
            <span class="subscription_code_post"></span>
          </div>


        </div>
        <div class="tab-pane" id="subscription_code_tab2">
          <!-- Remarque -->
          <div class="alert alert-warning" role="alert" id="confidentiality_note" >
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <strong>Remarque: Copiez ce code et coller dans votre page</strong>
          </div>
          <!-- END Remarque -->
          <div class="col-md-12 col-xs-12" style="text-align:center">
            <button class="btn btn-primary" type="button" onclick="copy_to_clipboard('#subscription_code_get');" id="btn_code_simple_paiement"  name="btn_code_simple_paiement"><span class="fa fa-clone"></span>Copiez ce code</button>
          </div>
          <div class="col-md-12 col-xs-12" style="text-align:center">
            <textarea  name="subscription_code_get" id="subscription_code_get" class="form-control subscription_code_get" rows="9" style="margin-top:20px;">{code}</textarea>
          </div>
          <div class="col-md-12 col-xs-12" style="text-align:center;margin-top:20px;">
            <h3>Exemple</h3>
            <span class="subscription_code_get"></span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
