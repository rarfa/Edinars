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
                            
<?if(isset($data['ScriptLoaded'])){?>
    <?if(!$data['PostSent']){?>
        <form method=post id="sigup-form" >
        <article class="col-2">
                <div class="col_title">Ouvrir un compte Erecovery Etape 2</div>
                <div class="col_text">
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
                    <p class="pm">
                                    S'il vous pla&icirc;t saisissez votre code de confirmation!
                        <br><br>
                        <div class="field text">
                            <label>Code de confirmation  (*):</label>
                            <input type="text" id="cid" name="cid" size="30" maxlength="32" value="<?php echo prntext($post['cid'])?>">
        
                                </p>
                        <br>
                    <div class="alignright">
                            <input type="submit" id="submit" name="confirm" value="Suivant &raquo;" />
                    </div>
                                </p>
                </div>
        </article>
        
        
<?}else{?>
        <article class="col-2">
                <div class="col_title">Ouvrir un compte Erecovery Etape Final</div>
                <div class="col_text">
                    <p class="pm">
                                    Votre compte a &egrave;t&egrave; cr&egrave;&egrave;, <br> 
                                </p>
                                <p class="pm">
                                    Vous venez de vous confirmer votre compte sur Erecovery et nous vous souhaitons la bienvenue 
                                </p>
                                <p class="pm">
                                     Vous pouvez acc�der � votre compte � tout moment � l'adresse:
                                </p>
                                <p class="pm">
                                    Nous vous souhaitons de profiter au mieux de nos services.
                                </p>
                                <p class="pm">
                                    Merci d'avoir choisi Erecovery.
                                </p>
                    
                </div>
        </article>
        
        
     
    <?}?>
</form>
<?}else{?>SECURITY ALERT: Access Denied<?}?>



  <div class="clr"></div>

</div>

<!-- End content  -->
