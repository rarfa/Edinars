<script>
            jQuery(document).ready(function(){
                // binds form submission and fields to the validation engine
                jQuery("#donation-form").validationEngine();
            });
            
</script>
<!-- Start content  -->
<div class="content">
<br />

<? if ( !$post['type']) { ?> 
    <center>
    <br>
        <div class="ui-widget">
            <div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
                <p>
                    <span class="ui-icon ui-icon-alert" style="float: centre; margin-right: .3em;"></span> 
                    Ce service est disponible que pour les Professionnels.
                    <br>pour plus d'information contact L'&egrave;quipe Erecovery.
                </p>
            </div>
        </div>
    </center>
<? } else { ?>     
        <?if(isset($data['ScriptLoaded'])){?>
        <center>
                    <?if($data['Error']){?>
                                <div class="ui-widget">
                                    <div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
                                        <p><span class="ui-icon ui-icon-alert" style="float: centre; margin-right: .3em;"></span> 
                                        <?php echo prntext($data['Error'])?>.</p>
                                    </div>
                                </div>
                            <br>
                    <?}?>
        
    <?php if ($post['step'] == 1) { ?>        
        <!-- ############# admin_box start ############# -->
        <div class="admin_box">
            <!-- ############# admin_box_header start ############# -->
            <div class="admin_box_header">
                <div class="box_header_left">
                    <div class="header_tabs"><!-- add tabs in this div -->
                        <a href="#tab01" class="default_tab current" ><span class="tab">Les  Abonnements</span><span class="tab_right"></span></a>
                        <a href="<?php echo $data['Members']?>/subscriptions-Edinars/ajouter" class="no_submenu"><span class="tab">Ajouter un Abonnements</span><span class="tab_right"></span></a>
                        <a href="#tab03"><span class="tab">Des Abonn&eacute;s</span><span class="tab_right"></span></a>
                    </div>
                </div>                
            </div>
            <!-- ############# admin_box_header end ############# -->
            <!-- ############# content_box start ############# -->
            <div class="content_box">
                <div id="tab01" class="content default_tab">
                    <center>
                    <br class="clear" />
                    <table class="common_table">
                        <thead>
                            <tr>
                                <th class="code_col">NOM</th>
                                <th class="code_col">PRIX</th>
                                <th class="code_col">P&Eacute;RIODE</th>
                                <th class="code_col">VENDU</th>
                                <th class="code_col">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?$idx=0;foreach($data['Products'] as $value){ ?>
                            <tr>
                                <td><?php echo prntext($value['nom'])?></td>
                                <td><?php echo prnsumm($value['prix'])?><?php echo prntext($data['Currency'])?></td>
                                <td nowrap><?php echo prnintg($value['periode'])?> Jours</td>
                                <td nowrap><?php echo ($value['sold']?$value['sold']:'0')?> (<?php echo prnsumm($value['prix']*$value['sold'])?> <?php echo prntext($data['Currency'])?>)</td>
                                <td nowrap>
                                    <a href="<?php echo $data['Members']?>/subscriptions-Edinars/<?php echo $value['id']?>/update"><img src="<?php echo $data['Host']?>/images/icons/edit.png"  alt="MODIFIER"></a> 
                                    <a href="<?php echo $data['Members']?>/subscriptions-Edinars/<?php echo $value['id']?>/supprimer" onclick="return cfmform()"><img src="<?php echo $data['Host']?>/images/icons/delete.png"  alt="SUPPRIMER"></a>
                                    <a href="<?php echo $data['Members']?>/code-Edinars/<?php echo $value['id']?>/subscriptions"><img src="<?php echo $data['Host']?>/images/icons/code.png"  alt="G&Eacute;N&Eacute;RER CODE"></a>
                                </td>
                            </tr>
                        <?$idx++;}?>
                         </tbody>
                    </table>
                    <br>
                    </center>    
                        <br class="clear" />
                </div>
                
                <div id="tab03" class="content">
                        <table class ="common_table">
                                    <thead>
                                        <tr>
                                            <th class="code_col" >MEMBRE</th>
                                            <th class="code_col">NOM</th>
                                            <th class="code_col">PRIX</th>
                                            <th class="code_col" >P&Eacute;RIODE</th>
                                            <th class="code_col" >ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>                                
                                    <?$idx=0;foreach($data['Subscriptions'] as $value){ ?>
                                        <tr >
                                            <td><?php echo prntext($value['owner'])?></td>
                                            <td><?php echo prntext($value['nom'])?></td>
                                            <td><?php echo prnsumm($value['prix'])?><?php echo prntext($data['Currency'])?></td>
                                            <td><?php echo prnintg($value['periode'])?> Jours</td>
                                            <td><a href="subscriptions.htm?id=<?php echo $value['id']?>&action=cancel" onclick="return cfmform()"><img src="../images/icons/delete.png"  alt="ANNULER"> </a></td>
                                        </tr>
                                    <?$idx++;}?>
                                    </tbody>
                                </table>
                 
                 
                 <br class="clear" />
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
    <?php  } else  { ?>                            
                        <!-- ############# admin_box start ############# -->
        <div class="admin_box">
            <!-- ############# admin_box_header start ############# -->
            <div class="admin_box_header">
                <div class="box_header_left">
                    <div class="header_tabs"><!-- add tabs in this div -->
                        <a href="<?php echo $data['Members']?>/subscriptions-Edinars" class="no_submenu" ><span class="tab">Les Abonnements</span><span class="tab_right"></span></a>
                        <?if($post['gid']){?>
                            <a href="#tab01" class="default_tab current" ><span class="tab">Modifier une Abonnement<?php echo prntext($post['nom'])?> </span><span class="tab_right"></span></a>
                        <? } else { ?>
                            <a href="#tab01" class="default_tab current" ><span class="tab">Ajouter une Abonnement</span><span class="tab_right"></span></a>
                        <? } ?>
                        <a href="#tab03"><span class="tab">Des Abonn&eacute;s</span><span class="tab_right"></span></a>
                
                    </div>
                </div>                
            </div>
            <!-- ############# admin_box_header end ############# -->
            <!-- ############# content_box start ############# -->
            <div class="content_box">
                <div id="tab01" class="content default_tab">
                    <center>
                    <br class="clear" />
                     <form method="post" name="sigup-form"  id="donation-form"  >
                        <?if($post['gid']){?>
                            <input type="hidden" name="gid" value="<?php echo $post['gid']?>">
                        <?}?>
                        <input type="hidden" name="step" value="2">
                        
                        <table class="common_table_detail">
                            <thead>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Produit/Service Nom (*):</td>
                                    <td><input type="text" id="nom" name="nom"  maxlength="64" value="<?php echo prntext($post['nom'])?>" class="validate[required]  text-input" ></td>
                                </tr>    
                                <tr>
                                    <td>Montant r&eacute;currents, <?php echo prntext($data['Currency'])?> (*):</td>
                                    <td><input type="text" id="prix" name="prix"  maxlength="20" value="<?php echo $post['prix']?>" class="validate[required,custom[number]]  text-input" >
                                            </td>
                                </tr>
                                <tr>
                                    <td>Dur&eacute;e (*) : <small>(Jours)</small></td>
                                    <td><input type="text" id="periode" name="periode"  maxlength="2" value="<?php echo (int)$post['periode']?>" class="validate[required,custom[integer]] text-input"></td>
                                </td>
                                <tr>
                                    <td>P&eacute;riode d'essai : <small>(Jours)</small></td>
                                    <td><input type="text" id="essai" name="essai"  maxlength="2" value="<?php echo (int)$post['essai']?>" class="validate[required,custom[integer]] text-input"></td>
                                </tr>
                                <tr>
                                    <td>Frais d'installation, <?php echo prntext($data['Currency'])?>:</td>
                                    <td><input type="text" id="installation" name="installation"  maxlength="20" value="<?php echo $post['installation']?>" class="validate[required,custom[number]]  text-input">
                                    <td>
                                </tr>    
                                <tr>
                                    <td>TVA, <?php echo prntext($data['Currency'])?>:</td>
                                    <td><input type="text" id="tva" name="tva"  maxlength="10" value="<?php echo $post['tva']?>" class="validate[required,custom[number]]  text-input">
                                    </td>
                                </tr>    
                                <tr>
                                    <td>Livraison, <?php echo prntext($data['Currency'])?>:</td>
                                    <td><input type="text" id="livraison" name="livraison"  maxlength="10" value="<?php echo $post['livraison']?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>URL de Retour (*):</td>
                                    <td><input type="text" id="ureturn" name="ureturn"  value="<?php echo prntext($post['ureturn'])?>" class="validate[required,custom[url]] text-input" ></td>
                                </tr>
                                <tr>
                                    <td>URL de Notification (*):</td>
                                    <td><input type="text" id="unotify" name="unotify"  value="<?php echo prntext($post['unotify'])?>" class="validate[required,custom[url]] text-input"></td>
                                </tr>
                                <tr>
                                    <td>URL de Annulation (*):</td>
                                    <td><input type="text" id="ucancel" name="ucancel"  value="<?php echo prntext($post['ucancel'])?>" class="validate[required,custom[url]] text-input"></td>
                                </tr>
                                <tr>
                                    <td>Description:<small>(En option)</small></td>
                                    <td><textarea name="comments"><?php echo prntext($post['comments'])?></textarea></td>
                                </tr>
                                <tr>
                                    <td>S'il vous pla&icirc;t s&egrave;lectionner un bouton:</td>
                                    <td> 
                                
                                        <?$idx=1;foreach($post['Buttons'] as $key=>$value){ ?>
                                            <input class="validate[required] radio" type=radio id=button_<?php echo $idx?> name=button value="<?php echo $value?>"<?if($post['button']==$value){?> checked<?}?>>
                                            &nbsp;<img src="<?php echo $data['SubBtns']?>/<?php echo $value?>" align=absmiddle onclick="javascript:document.all['button_<?php echo $idx?>'].checked=true">
                                            <br><br>
                                        <?$idx++;}?>
                                    </td>
                                </tr>    
                                <tr>
                                    <td colspan="2" class="middle">
                                            <?if($post['gid']){?>
                                                <input type="submit" id="submit" name="send" value="sauvegarde" />
                                                <input type="hidden" name="update" value="update">    
                                            <?}else { ?>
                                                <input type="submit" id="submit" name="send" value="AJOUTER" />
                                            <?}?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        </form>         
                        
                    </center>    
                        <br class="clear" />
                </div>
                <div id="tab03" class="content">
                        <table class ="common_table">
                                    <thead>
                                        <tr>
                                            <th class="code_col" >MEMBRE</th>
                                            <th class="code_col">NOM</th>
                                            <th class="code_col">PRIX</th>
                                            <th class="code_col" >P&Eacute;RIODE</th>
                                            <th class="code_col" >ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>                                
                                    <?$idx=0;foreach($data['Subscriptions'] as $value){ ?>
                                        <tr >
                                            <td><?php echo prntext($value['owner'])?></td>
                                            <td><?php echo prntext($value['nom'])?></td>
                                            <td><?php echo prnsumm($value['prix'])?><?php echo prntext($data['Currency'])?></td>
                                            <td><?php echo prnintg($value['periode'])?> Jours</td>
                                            <td><a href="subscriptions.htm?id=<?php echo $value['id']?>&action=cancel" onclick="return cfmform()"><img src="../images/icons/delete.png"  alt="ANNULER"> </a></td>
                                        </tr>
                                    <?$idx++;}?>
                                    </tbody>
                                </table>
                 
                 
                 <br class="clear" />
                </div>
                
                <br class="clear" />
                </div>
            </div>
            <!-- ############# content_box end ############# -->
                
                
            <!-- ############# admin_box_bottom start ############# -->
            <div class="admin_box_bottom">
                <div class="box_bottom_left"></div>
            </div>
            <!-- ############# admin_box_bottom end ############# -->
            
            
        </div>
        <!-- ############# admin_box end ############# -->

        </div>

   </div>
                            
    <?php  } ?>            
            </center>
    
    <?}else{?>SECURITY ALERT: Access Denied<?}?>
<? } // end for check account type?>
    </div>

<!-- End content  -->