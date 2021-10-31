<section id="content"><div class="inner_copy"><div class="inner_copy"></a></div></div>
        <div class="container">
            <div class="inside">
                <div id="slogan">
                    <div class="inside">
                        <h2><span>SOLDE:</span> <?php echo balance($data['Balance'])?> </span></h2>
                        <p></p>
                    </div>
                </div>
                
                <div class="inside1">
                    <div class="wrap row-2">
                        <article class="col-1">
                          <?showmenu('paiment')?>
                        </article>
                        <article class="col-2">

<?if(isset($data['ScriptLoaded'])){?>
    <?if(!$post['PostSent']){?>
        <form method="post" name="data" id="sigup-form" > 
            <input type="text" name=step value="<?php echo $post['step']?>">
        <center>
         <h2>cr&egraveer des cartes de recharge</h2>
            <fieldset>
                        <?if($data['Error']){?>
                        <div class="ui-widget">
                            <div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
                                <p><span class="ui-icon ui-icon-alert" style="float: centre; margin-right: .3em;"></span> 
                                <?php echo prntext($data['Error'])?>.</p>
                            </div>
                        </div>
                        <br>
                        <?}?>
                    
                    <div class="ui-state-highlight-big ui-corner-all" style="margin-top: 20px; padding: 0 .7em;"> 
                    <br>
                        <div class="field text">
                                <label>Bare code :</label>
                                 <input type=text name="barecode" size=3 maxlength=3 value="<?php echo prntext($post['barecode'])?>">
                        </div>
                        <div class="field text">
                                <label>Wilaya:</label>
                                 <input type=text name="wilayacode" size=2 maxlength=2 value="<?php echo prntext($post['wilayacode'])?>">
                        </div>
                            <div class="field text">
                                <label> Quantit&egrave;:</label>
                                 <input type=text name="qty" size=2 maxlength=5 value="<?php echo prntext($post['qty'])?>">
                        </div>
                        <div class="field text">
                                <label> Montant:</label>
                                 <input type=text name="montant" size=2 maxlength=16 value="<?php echo prntext($post['montant'])?>">
                        </div>
                    </div>
                    <div class="alignright">
                            <br>
                                <a class="link2" href="#" onClick="send('send','CONTINUE')"><span><span>cr&egraveer</span></span></a>
                                <input type="hidden" id="action" value="">    
                            </div>
                    
         
        </center>
            
            
        </form>
    <?}else{?>
<?if($post['dtype']=='pincode'){?>
sss
<?}elseif($post['dtype']=='paypal'){?>
<form method=post action="https://www.paypal.com/cgi-bin/webscr">
<input type=hidden name=cmd value="_xclick">
<input type=hidden name=business value="<?php echo $data['DepositMethod'][$post['dtype']]['user']?>">
<input type=hidden name=item_name value="Add funds to my <?php echo $data['SiteName']?> account">
<input type=hidden name=no_shipping value="1">
<input type=hidden name=return value="<?php echo $data['Members']?>/notify.htm">
<input type=hidden name=no_note value="1">
<input type=hidden name=amount value="<?php echo prnsum($post['total'])?>">
<?}elseif($post['dtype']=='egold'){?>
<form method=post action="https://www.e-gold.com/sci_asp/payments.asp">
<input type=hidden name=PAYEE_ACCOUNT value="<?php echo $data['DepositMethod'][$post['dtype']]['user']?>">
<input type=hidden name=PAYEE_NAME value="<?php echo $data['SiteName']?>">
<input type=hidden name=PAYMENT_UNITS value="1">
<input type=hidden name=PAYMENT_METAL_ID value="1">
<input type=hidden name=PAYMENT_AMOUNT value="<?php echo prnsum($post['total'])?>">
<input type=hidden name=NOPAYMENT_URL value="<?php echo $data['Members']?>/deposit.htm">
<input type=hidden name=NOPAYMENT_URL_METHOD value="LINK">
<input type=hidden name=PAYMENT_URL value="<?php echo $data['Members']?>/notify.htm">
<input type=hidden name=PAYMENT_URL_METHOD value="POST">
<input type=hidden name=MEMO value="Add funds to my <?php echo $data['SiteName']?> account">
<input type=hidden name=HASH value="<?php echo md5("abdo".time().$data['sid'])?>">
<input type=hidden name=CHECKSUM value="<?php echo time()?>">
<input type=hidden name=BAGGAGE_FIELDS value="">
<?}elseif($post['dtype']=='moneybookers'){?>
<form method=post action="https://www.moneybookers.com/app/payment.pl">
<input type=hidden name=pay_to_email value="<?php echo $data['DepositMethod'][$post['dtype']]['user']?>">
<input type=hidden name=return_url value="<?php echo $data['Members']?>/deposit.htm">
<input type=hidden name=cancel_url value="<?php echo $data['Members']?>/deposit.htm">
<input type=hidden name=status_url value="<?php echo $data['Members']?>/notify.htm">
<input type=hidden name=language value="EN">
<input type=hidden name=amount value="<?php echo $post['total']?>">
<input type=hidden name=currency value="USD">
<input type=hidden name=detail1_description value="Transaction Description:">
<input type=hidden name=detail1_text value="Add funds to my <?php echo $data['SiteName']?> account">

<?}elseif($$post['dtype']=='topup'|| $post['dtype']=='CCP'){?>
   
    <?if(!$post['ShowCheckInfo']){?>
        <form method="post" id="sigup-form" >
        <input type="hidden" name="dtype" value="<?php echo $post['dtype']?>">
        <input type="hidden" name="fees" value="<?php echo $post['fees']?>">
        <input type="hidden" name="amount" value="<?php echo $post['amount']?>">
        <input type="hidden" name="manual" value="true">
        <input type="hidden" id="action" value="">    
        </form>
    <?}else{?>
        <form method="post" id="sigup-form" >
        <input type="hidden" id="action" value="">    
        </form>
         <center>
            <div class="ui-widget">
                <div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
                    <p><span class="ui-icon ui-icon-alert" style="float: centre; margin-right: .3em;"></span> 
                    <b><u>S'IL VOUS PLA&Icirc;T NOTE</u>
                    <blockquote>Des fonds ont &egrave;t&egrave; ajout&egrave; avec succ&egrave;s &agrave; votre compte et a un statut "EN ATTAND".<Br>
                    Lorsque nous allons obtenir votre paiement, votre fonds seront disponibles.</blockquote>
                    <p>
                </div>
            </div>
            </center>
        
        </font>
        <?
        }
}?>

        <?if($post['dtype']=='CCP'&&!$post['ShowCheckInfo']){?>
            <center>
            <div class="ui-widget">
                <div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
                    <p><span class="ui-icon ui-icon-alert" style="float: centre; margin-right: .3em;"></span> 
                    <b><u>S'IL VOUS PLA&Icirc;T NOTE</u>
                    <blockquote>Lorsque nous allons obtenir votre paiement, votre fonds seront disponibles.</blockquote>
                    <p>
                </div>
            </div>
            </center>
        <?}?>
          <br>
        <center>
            <h2>cr&egraveer des cartes de recharge</h2>
            <?if($data['Error']){?>
                        <div class="ui-widget">
                            <div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
                                <p><span class="ui-icon ui-icon-alert" style="float: centre; margin-right: .3em;"></span> 
                                <?php echo prntext($data['Error'])?></p>
                            </div>
                        </div>
                        <br>
                        <?}?>
            <div class="ui-state-highlight-big ui-corner-all" style="margin-top: 20px; padding: 0 .7em;"> 
                            <br>
                            <div class="field">
                                Montant : <?php echo prnpays($post['amount'])."\n"?><br>
                                Frais : <?php echo prnpays(-$post['fees'])."\n"?><BR>
                                D&egrave;p&ocirc;t Total : <?php echo prnpays($post['total'])."\n"?>
                                <br>
                            </div>
                    <br>
                                
         <?if($post['dtype']!='autorize'){?>
            
            <?if (($post['dtype']=='topup') &&  (!$post['ShowCheckInfo']) ){?>
                
                <form method="post" id="sigup-form" >
                    <input type="hidden" name="dtype" value="<?php echo $post['dtype']?>">
                    <input type="hidden" name="fees" value="<?php echo $post['fees']?>">
                    <input type="hidden" name="amount" value="<?php echo $post['amount']?>">
                    <input type="hidden" name="manual" value="true">
                    <input type="hidden" id="action" value="">
                    <div class="field text">
                                <label>Saisissez les 16 chifres: </label>
                                <input type="text" name="topup_number" value="<?php echo $post['topup_number']?>" size="41" maxlength="16">
                    </div>                    
                    </form>
            <?php }elseif ($post['dtype']=='topup') {?>
            <form method="post" id="sigup-form" >
            <input type="hidden" id="action" value="">
            </form>
                        La carte de recharge a  &egrave;t&egrave; charger avec succ&agrave;s
                        <br>
                        votre Solde: <?php echo prnpays($data['Balance']) ?>
            
            <?php } ?>
            <br>
            
            <?if($post['dtype']=='CCP'){?>
                <?if(!$post['ShowCheckInfo']){?>
                        S'il vous pla&icirc;t envoyer un paiement de <?php echo prnsum($post['total'])?> &agrave; le compte suivante:
                        <br><br>
                        <?php echo prntext($data['CCPAccount'])?>
                      <br><br>
                       S'il vous pla&Icirc;t Note: inclure une note avec votre nom 
                       <br>identifiant (<?php echo prntext($post['username'])?>) et
                       l'adresse email que vous avez enregistr&egrave; aupr&egrave;s de (<?php echo prntext($post['email'])?>),
                      <br>           afin que nous puissions de cr&egrave;dit votre compte.
                      <br>
                      <br>
                <?}else{?>
                    <?php echo prntext($post['CheckInfo'])?>
                <?}?>
            <?}?>

<?}?>
        <br>
            </div>
        <br>
         <div class="alignright">
                    <a class="link4" href="#" onClick="send('cancel','ANNULER')"><span><span><?if($post['dtype']=='CCP'){?>ANULLER<?}elseif ($post['ShowCheckInfo']){ ?>Termin&egrave;<?} else{?>ANULLER TRANSACTION<?}?></span></span></a>
                    <?if(!$post['ShowCheckInfo']){?>
                        <a class="link2" href="#" onClick="send('send','CONTINUE')"><span><span>VALIDER</span></span></a>
                    <?}?>
                            
         </div>
        <br>
    </div>
                    
                            <?}?>

                            <?}else{?>SECURITY ALERT: Access Denied<?}?>


    </article>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
function send(obj ,objvalue) {
    document.getElementById('action').value = objvalue ;
    document.getElementById('action').name = obj ;
    document.getElementById('sigup-form').submit();
}

</script>