<!-- Start content  -->
<div class="container">
<br />
    <? if ( !$post['type']) { ?> 
    <center>
    <br>
        <div class="ui-widget">
            <div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
                <p>
                    <span class="ui-icon ui-icon-alert" style="float: centre; margin-right: .3em;"></span> 
                    Ce service est disponible que pour les Professionnels.
                    <br>pour plus d'information contact L'&egrave;quipe Edinars.
                </p>
            </div>
        </div>
    </center>
<? } else { ?>                    
                        
    <?if(isset($data['ScriptLoaded'])){?>
          <center>
          
          <!-- ############# admin_box start ############# -->
        <div class="admin_box">
            <!-- ############# admin_box_header start ############# -->
            <div class="admin_box_header">
                <div class="box_header_left">
                    <div class="header_tabs"><!-- add tabs in this div -->
                        <a href="#tab01" class="default_tab current" ><span class="tab">CODE #1 - En utilisant la m&egrave;thode POST</span><span class="tab_right"></span></a>
                        <a href="#tab02" ><span class="tab">Param&egrave;tres de retour</span><span class="tab_right"></span></a>
                    </div>
                </div>                
            </div>
            <!-- ############# admin_box_header end ############# -->
            <!-- ############# content_box start ############# -->
            <div class="content_box">
                <div id="tab01" class="content default_tab">
                    <center>
                    <br class="clear" />
                                <form id="contacts-form" >
                                    <br>Copiez ce code et coller dans votre page <br><br>
                                    <textarea readonly ><?php echo $post['HtmlCode']?></textarea>
                                    <br><br>
                                </form>    
                                
                                <table  class="common_table">
                                        <thead>
                                            <tr>
                                                <th colspan=2>Description de tous les champs que vous pouvez utiliser</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan=2>
                                                Pour paiement autoris&eacute;, vous devez utiliser les param&egrave;tres suivant:
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>identifiant</td>
                                                <td>Votre Identifiant</td>
                                            </tr>
                                            <tr>
                                                <td>commande</td>
                                                <td>Votre numéro de commande </td>
                                            </tr>
                                            <tr>
                                                <td>produit</td>
                                                <td>Votre produit id ou le nom </td>
                                            </tr>
                                            <tr>
                                                <td>action</td>
                                                <td>l'utilisation de "produit" si ce produit est pr&eacute;-d&eacute;fini <br>
                                                    l'utilisation de "donation" pour un paiement d'une donation <br>
                                                    l'utilisation de "abonnement"  pour un paiement d'une abonnement<br> 
                                                    l'utilisation de "paiement" pour un paiement simple <br>
                                                    </td>
                                            </tr>
                                            <tr>
                                                <td>prix</td>
                                                <td>prix du produit, DA</td>
                                            </tr>
                                            <tr>
                                                <td>quantite</td>
                                                <td>la quantit&eacute;</td>
                                            </tr>
                                            <tr>
                                                <td>periode</td>
                                                <td>p&eacute;riode de souscription refacturation, les jours</td>
                                            </tr>
                                            <tr>
                                                <td>essai</td>
                                                <td>p&eacute;riode d'essai, les jours</td>
                                            </tr>
                                            <tr>
                                                <td>installation</td>
                                                <td>frais d'installation, DA</td>
                                            </tr>
                                            <tr>
                                                <td>tva</td>
                                                <td>frais TVA, DA</td>
                                            </tr>
                                            <tr>
                                                <td>livraison</td>
                                                <td>frais de livraison, DA</td>
                                            </tr>
                                            <tr>
                                                <td>ureturn</td>
                                                <td>URL de Retour </td>
                                            </tr>
                                            <tr>
                                                <td>unotify</td>
                                                <td>URL de Notification</td>
                                            </tr>
                                            <tr>
                                                <td>ucancel</td>
                                                <td>URL de Annulation</td>
                                            </tr>
                                        </tbody>
                                </table>        
                    <br>
                    </center>    
                        <br class="clear" />
                </div>
                <div id="tab02" class="content">
                    <table class="common_table">
                        <thead>
                                <tr>
                                    <th colspan=2>Apr&egrave;s le succ&egrave;s du paiement le syst&egrave;me transmettra acheteur pour votre site et certains param&egrave;tres seront de retour &agrave; votre script par la m&eacute;thode POST:</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>action</td>
                                    <td>type de transaction (produit / donation / abonnement / paiement)</td>
                                </tr>
                                <tr>
                                    <td>statut</td>
                                    <td>Le statut de paiement</td>
                                </tr>
                                <tr>
                                    <td>trxid</td>
                                    <td>Identifiant de la transaction</td>
                                </tr>
                                <tr>
                                    <td>commande</td>
                                    <td>Votre commande numéro</td>
                                </tr>
                                <tr>
                                    <td>pid</td>
                                    <td>ID produit interne</td>
                                </tr>
                                <tr>
                                    <td>pname</td>
                                    <td>nom de produit/service</td>
                                </tr>
                                <tr>
                                    <td>acheteur</td>
                                    <td>acheteur identifiant</td>
                                </tr>
                                <tr>
                                    <td>total</td>
                                    <td>total montant</td>
                                </tr>
                                <tr>
                                    <td>quantite</td>
                                    <td>la quantit&eacute;</td>
                                </tr>
                                <tr>
                                    <td>commentaires</td>
                                    <td>note l'acheteur</td>
                                </tr>
                                <tr>
                                    <td>refrence</td>
                                    <td>syst&egrave;me, URL de r&eacute;f&eacute;rence (<?php echo $data['Host']?>) </td>
                                </tr>
                                <tr>
                                    <td colspan=2>Vous pouvez obtenir ces param&egrave;tres par la variable POST $_POST[--VARIABLE-NAME--]...
                                             
                                    </td>
                                    
                                </tr>
                            </tbody>
                    </table>
                    
              </div>
                <br class="clear" />
                </div>
                
            </div>
            <!-- ############# content_box end ############# -->
                
                
            <!-- ############# admin_box_bottom start ############# -->
            <div class="admin_box_bottom">
                <div class="box_bottom_left">
                    
                </div>
            </div>
            <!-- ############# admin_box_bottom end ############# -->
            
            
        </div>
        <!-- ############# admin_box end ############# -->
        </div>
   </div>                      
          
        
    <?}else{?>SECURITY ALERT: Access Denied<?}?>
<? } // end for check account type?>
</div>
<!-- End content  -->