<section id="features">
  <div class="container" style="padding-bottom:100px;">
    <h2>Mot de passe oublilé</h2>

    <form method="post" id="lost_password_form" name="lost_password_form" onsubmit="lost_password();return false;">
      <div class="col-6" style="padding-top:20px;">
        <div class="col_title"></div>
        <div class="col_text">
          <p class="pm">
            Vous pouvez modifier votre mot de passe pour des raisons de sécurité ou le réinitialiser si vous l'avez oublié.
          </p>
          <div id="div_lost_password"></div> 
          <div class="form-group" style="padding-top:20px;">
            <div id="div_email"><input type="email" placeholder="Entrer votre email" id="email" name="email" size="35" maxlength="50" value="" class="form-control"></div>
          </div>

          <br>
          <div class="">
            <button type="submit" class="btn btn-success btn-lg"  name="submit_lost_password" id="submit_lost_password" style="float: right; display: block;">Envoyer</button>
            <div class="loader" id="loading_lost_password"  name="loading_lost_password" style="display:none;float:right"></div>
          </div>
        </div>
      </div>
    </form>

  </div>

</section>
