<script>
            jQuery(document).ready(function(){
                // binds form submission and fields to the validation engine
                jQuery("#payment-form").validationEngine();
            });
            
</script>

<!-- Start content  -->

 <div class="container">
  <div class="row">    <?if($data['Error']){?>
        <center>
            <div class="ui-widget">
                <div class="ui-state-error ui-corner-all" style="padding: 0 .7em"> 
                        <p><span class="ui-icon ui-icon-alert" style="float: centre; margin-right: .3em;"></span> 
                                <?php echo prntext($data['Error'])?>.</p>
                            </div>
                        </div>
        </center>                
        <?}?>
<?    if ($post['step']!=3) { ?>
    
    <article class="col-3">
        <div class="col_title">D&egrave;tail de votre Commande</div>
        <div class="col_text">
                    <p class="pm">
                        <center>                        
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th colspan="2"><? if ($_SESSION['logo']!="") { ?>
                                            <img src="<?php echo $data['Host'].'/'.$_SESSION['logo']?>"> 
                                    <? }  ?></span></th>
                                    
                                </tr>
                            </thead>
                                <tfoot>
                                <tr>
                                    <td colspan="2" class="rounded-foot-left"><em><?if($post['comments']){?>Description :<?}?></em><br>
                                    <?if($post['comments']){?><?php echo str_replace($data['line'], $data['replace'], prntext($post['comments']))?><?}?></td>
                                </tr>
                            </tfoot>
                            <tbody>
                                <tr>
                                    <td><?if($post['action']!='donation'){?>Paiement <?}else{?>Faire un don<?}?> pour :</td>
                                    <td><?php echo prntext($post['member'])?></td>
                               </tr>
                                <tr>
                                    <td><?if($post['action']!='donation'){?>Produit / Service<?}else{?>Faire un don Vers<?}?> :</td>
                                    <td><?php echo prntext($post['produit'])?></td>
                                </tr>
                                <tr>
                                    <td><?if($post['action']!='donation'){?>Prix :<?}else{?>Montant, <?php echo prntext($data['Currency'])?><?}?></td>
                                    <td><?if($post['action']!='donation'){?>
                                            <?php echo prnsumm($post['prix'])?>&nbsp;<?php echo prntext($data['Currency'])?>
                                        <?}else{?>
                                            <input type=text name=price size=10 maxlength=8 value="<?php echo prnsumm($post['prix'])?>">
                                        <?}?>
                                    </td>
                                </tr>
                                <?if($post['action']!='donation'){?>
                                    <?if($post['quantite']>0){?>
                                    <tr>
                                        <td>Quantit&egrave :</td>
                                        <td><?php echo prnintg($post['quantite'])?></td>
                                    </tr>
                                    <?}?>
                                    <?if($post['installation']>0){?>
                                        <tr>
                                            <td>Frais d'installation :</td>
                                            <td><?php echo prnsumm($post['installation'])?>&nbsp; <?php echo prntext($data['Currency'])?></td>
                                        </tr>
                                    <?}?>
                                    <?if($post['tva']>0){?><tr><td>TVA :</td><td><?php echo prnsumm($post['tva'])?> &nbsp; <?php echo prntext($data['Currency'])?></td></tr><?}?>
                                    <?if($post['livraison']>0){?><tr><td>La livraison / Manipulation :</td><td ><?php echo prnsumm($post['livraison'])?> &nbsp; <?php echo prntext($data['Currency'])?></td></tr><?}?>
                                    <?if($post['periode']>0){?><tr><td>Dur&egrave:</td><td><?php echo prnintg($post['periode'])?> jour (s)</td></tr><?}?>
                                    <?if($post['essai']>0){?><tr><td>P&egraveriode d'essai:</td><td><?php echo prnintg($post['essai'])?> jour (s)</td></tr><?}?>
                                    
                                <?}?>
                                <tr>
                                        <td> <em>Total:</em></td>
                                        <td><?php echo prnsumm($post['total'])?>&nbsp;<?php echo prntext($data['Currency'])?></td>
                                    </tr>
                                
                            </tbody>
                        </table>
                        </center>    
                    </p>
        </div>
    </article>
<?php } ?>    
    <div class="clr"></div>

</div>
</div>

<!-- End content  -->    




<!-- Start footer  -->

<footer>

<div class="footer_head">

  
</div>

<div class="clr">
</div>

Copyright ? 2012 Edinars. Tous droits r?serv?s

</footer>

<!-- End footer  -->

</div>

</body>
</html>
