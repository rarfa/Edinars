<!-- Start content  -->

<div class="content">
    <article class="col-1">
        <div class="col_title">S�curit�</div>
        <div class="col_text">
            <p class="pm">
                    De ce fait nous vous invitent a ignorer les avertissements par email qui invitent � payer avec Erecovery qui n��mane pas de nos partenaires certifier, Si des sites Internet, des mails ou autres activit�s en ligne vous paraissent suspects, veuillez les communiquer � l��quipe de s�curit� Erecovery � l�adresse email suivante : info@erecovery.dz.
            <BR>    
            </p>                
            <p class="pm" align="center">
                <a href="securite-Edinars" class="link">Plus information</a>
            </p>
            
                
        </div>
    </article>
    <article class="col-2">
        <div class="col_title">Ouvrir un compte avec Erecovery</div>
        <div class="col_text">
                <p class="pm">
                    <?if(isset($data['ScriptLoaded'])){?>
                    <?if(!$data['PostSent']){?>
                        <form method="post" id="sigup-form">
                            <input type="hidden" name=step value="1">
                            <input type="hidden" id="newtype" name="newtype" value="<?php echo prntext($post['newtype'])?>">
                            <p class="pm">
                                <?if($data['Error']){?>
                                
                                <center>
                                    <br>
                                    <div class="ui-widget">
                                    <div class="ui-state-error ui-corner-all" style="padding: 0 .7em;width:350px"> 
                                        <p><span class="ui-icon ui-icon-alert" style="float: centre; margin-right: .3em;"></span> 
                                        <?php echo prntext($data['Error'])?>.</p>
                                    </div>
                                    </div>
                                    <br>
                                </center>    
                                <?}?>
                            </p>
                            <table id="hor-minimalist-a" summary="PROFILE">
                                                    <tbody>
                                                    <tr>
                                                        <td>Identifiant (*) :</td>
                                                        <td><input type="text" id="newuser" name="newuser" size="35" maxlength="50" value="<?php echo prntext($post['newuser'])?>" class="validate[required] text-input"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>E-Mail Adresse (*):</td>
                                                        <td><input type="text" id="newmail" name="newmail" size="35" maxlength="50" value="<?php echo prntext($post['newmail'])?>" class="validate[required,custom[email]] text-input"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Choisir mot de passe (*):</td>
                                                        <td><input type="password" id="newpass" name="newpass" size="35" maxlength="50" value="<?php echo prntext($post['newpass'])?>" class="validate[required,optional,minSize[9]] text-input"></td>
                                                        <td></td>    
                                                    </tr>
                                                    <tr>
                                                        <td>Confirmer le mot de passe (*):</td>
                                                        <td><input type="password" id="cfmpass" name="cfmpass" size="35" maxlength="50" value="<?php echo prntext($post['cfmpass'])?>" class="validate[required,minSize[9],equals[newpass]] text-input"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Question de S&egrave;curit&egrave;(*):</td>
                                                        <td><select name="newques" id="newques" class="validate[required]">
                                                          <?php echo showselect($data['question'], $post['newques'])?>
                                                        </select>
                                                        </td>
                                                        <td></td>    
                                                    </tr>
                                                    <tr>
                                                        <td>R&egrave;ponse de s&egrave;curit&egrave; (*):</td>
                                                        <td><input type="text" id="newansw" name="newansw" size="35" maxlength="100" value="<?php echo prntext($post['newansw'])?>" class="validate[required] text-input"></td>
                                                    </tr>
                                                    <?if($data['UseTuringNumber']){?>
                                                        <div class="ui-widget">
                                                            <div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;"> 
                                                                <p align="center">Dans nos efforts continus pour fournir le service le plus s&egrave;curis&egrave; possible,
                                                                nous avons ajout&egrave; un test de s&egrave;curit&egrave; pour emp&ecirc;cher les enregistrements automatiques.
                                                                Entrez les num&egrave;ros tels qu'ils figurent dans l'image ci-dessous.
                                                                <br>
                                                                <img src="<?php echo $data['Host']?>/turing.htm" width="150" height="30" border="1">
                                                                </p>

                                                            </div>
                                                            </div>
                                                        
                                                            
                                                            <div class="field text">
                                                                <label>Code de s&egrave;curit&egrave; (*):</label>
                                                                <input type="text" id="turing" name="turing" size="30" maxlength="32"">&nbsp;&nbsp;&nbsp;
                                                                    
                                                            </div>    
                                    
                                                    <?}?>
                                                </tbody>
                                                </table>

                                                    <p align="center">
                                                    <input id="terms" class="validate[required] checkbox" type="checkbox" name="terms">
                                                    OUI, J'ai lu les
                                                    <a href="javascript:view('https://edinars.net/edinars/terms.htm',400,500)">Termes et Conditions</a>
                                                    avant de vous inscrire.
                                                    </p>
                                                    <div style="float:right;padding:10px;"><input type="submit" value="Ouvrir un compte" name="send" id="submit"></div>

                            </div>
                            </form>
                        
                    <?}else{?>
                        <br>
                            <p class="pm">
                                Un message a &egrave;t&egrave; envoy&egrave; &egrave; l'adresse e-mail <?php echo prntext($post['newmail'])?><br>
                                <br>S'il vous pla&icirc;t clic sur le lien contenu dans l'e-mail pour continuer le processus d'inscription.<br>
                                <br>Ce code de confirmation ne sera valable que 48 heures.
                            </p>
                    <?}?>
                <?}
                else{?>SECURITY ALERT: Access Denied<?}?>
                </p>
                <BR>
        </div>
    </article>
    <div class="clr"></div>
</div>

<!-- End content  -->


    