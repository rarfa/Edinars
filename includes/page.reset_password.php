<?php
//Vérification
$token = clean_var($_GET["token"]);

$member=db_rows(
    "SELECT  * ".
    " FROM `{$data['DbPrefix']}members` ".
    " WHERE MD5(CONCAT(CURDATE(), password, mem_id)) = '".$token."' ".
    " LIMIT 1 "
);

if(empty($member[0]["mem_id"])) {
    redirect("./");
    exit();
}

?>

<section id="features">
  <div class="container" style="padding-bottom:100px;">
    <h2>Réinitialiser le mot de passe</h2>

    <form method="post" id="reset_password_form" name="reset_password_form" onsubmit="reset_password();return false;">
      <div class="col-6" style="padding-top:20px;">
        <div class="col_title"></div>
        <div class="col_text">
          <p class="pm">
            Votre mot de passe est sensible &agrave; la casse et doit &ecirc;tre d'au moins 9 caract&egrave;res, y compris au moins une lettre <b>(AZ)</b>,
            un chiffre <b>(0-9)</b> et l'un des caract&egrave;res sp&egrave;ciaux suivants:
            <b>!=+*;:-,._{[()]}#%?@</b>
          </p>
          <div id="div_reset_password"></div>
          <div class="form-group" style="padding-top:20px;">
            <div>Email: <b><?php echo $member[0]["email"] ?></b></div>
          </div>
          <div class="form-group">
            <div id="div_newpass"><input type="password" placeholder="Choisir mot de passe (*)" id="newpass" name="newpass" size="35" maxlength="50" value="" class="form-control"></div>
          </div>
          <div class="form-group">
            <div id="div_cfmpass"><input type="password" placeholder="Confirmer le mot de passe(*)" id="cfmpass" name="cfmpass" size="35" maxlength="50" value="" class="form-control"></div>
          </div>

          <br>
          <div class="">
            <input type="hidden" id="token" name="token" value="<?php echo $token ?>" />
            <button type="submit" class="btn btn-success btn-lg"  name="submit_reset_password" id="submit_reset_password" style="float: right; display: block;">Réinitialiser</button>
            <div class="loader" id="loading_reset_password"  name="loading_reset_password" style="display:none;float:right"></div>
          </div>
        </div>
      </div>
    </form>

  </div>

</section>
