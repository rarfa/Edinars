<script>
            jQuery(document).ready(function(){
                // binds form submission and fields to the validation engine
                jQuery("#donation-form").validationEngine();
            });
            
</script>
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
                        <a href="#tab01" class="default_tab current" ><span class="tab">Les Donations</span><span class="tab_right"></span></a>
                        <a href="<?php echo $data['Members']?>/donations-Edinars.html/ajouter" class="no_submenu"><span class="tab">Ajouter des Donations</span><span class="tab_right"></span></a>
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
                                <th>Don Pour</th>
                                <th>Total</th>
                                <th>Don</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>    
                        <?$idx=0;foreach($data['Products'] as $value){  ?>
                            <tr>
                                <td><?php echo prntext($value['nom'])?></td>
                                <td nowrap>
                                    <?if($value['prix']>0){?><?php echo prnsumm($value['prix'])?><?php echo prntext($data['Currency'])?>
                                    <?}else{?>Toute<?}?>
                                </td>
                                <td nowrap>
                                    <?php echo ($value['sold']?$value['sold']:'0')?>
                                        <font class=remark>(<?php echo prnsumm($value['prix']*$value['sold'])?><?php echo prntext($data['Currency'])?>)
                                </td>
                                <td nowrap>
                                    <a href="<?php echo $data['Members']?>/donations-Edinars.html/<?php echo $value['id']?>/update"><img src="<?php echo $data['Host']?>/images/icons/edit.png"  alt="MODIFIER"></a> 
                                    <a href="<?php echo $data['Members']?>/donations-Edinars.html/<?php echo $value['id']?>/supprimer" onclick="return cfmform()"><img src="<?php echo $data['Host']?>/images/icons/delete.png"  alt="SUPPRIMER"></a>
                                    <a href="<?php echo $data['Members']?>/code-Edinars.html/<?php echo $value['id']?>/donation"><img src="<?php echo $data['Host']?>/images/icons/code.png"  alt="G&Eacute;N&Eacute;RER CODE"></a>
                                </td>
                            </tr>
                        <?$idx++;}?>
                    </tbody>
                    </table>
                    <br>
                    </center>    
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
                        <a href="<?php echo $data['Members']?>/donations-Edinars.html" class="no_submenu" ><span class="tab">Tous Les Produits/Serivces</span><span class="tab_right"></span></a>
                        <?if($post['gid']){?>
                            <a href="#tab01" class="default_tab current" ><span class="tab">Modifier une Donation <?php echo prntext($post['nom'])?> </span><span class="tab_right"></span></a>
                        <? } else { ?>
                            <a href="#tab01" class="default_tab current" ><span class="tab">Ajouter une Donation</span><span class="tab_right"></span></a>
                        <? } ?>
                        
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
                                            <td>Donation vers (*):</td>
                                            <td><input type="text" id="nom" name="nom"  maxlength="64" value="<?php echo prntext($post['nom'])?>"  class="validate[required]  text-input" ></td>
                                        </tr>
                                        <tr>
                                            <td>Montant du don, <?php echo prntext($data['Currency'])?> (*):</td>
                                            <td><input type="text" id="prix" name="prix"  maxlength="10" value="<?php echo $post['prix']?>" class="validate[required,custom[number]]  text-input" ></td>
                                        </tr>
                                        <tr>
                                            <td>URL de Retour (*):</td>
                                            <td><input type="text" id="ureturn" name="ureturn"  maxlength="100" value="<?php echo prntext($post['ureturn'])?>"  class="validate[required,custom[url]] text-input"><td>
                                        </tr>
                                        <tr>
                                            <td>URL de Notification (*):</td>
                                            <td><input type="text" id="unotify" name="unotify"  maxlength="100" value="<?php echo prntext($post['unotify'])?>"  class="validate[required,custom[url]] text-input"><td>
                                        </tr>
                                        <tr>
                                            <td>URL de Annulation (*):</td>
                                            <td><input type="text" id="ucancel" name="ucancel"  maxlength="100" value="<?php echo prntext($post['ucancel'])?>"  class="validate[required,custom[url]] text-input"><td>
                                        </tr>
                                        <tr>
                                            <td>S'il vous pla&icirc;t s&egrave;lectionner un bouton:</td>
                                            <td><?$idx=1;foreach($post['Buttons'] as $key=>$value){ ?>
                                                <input class="validate[required] radio" type="radio" id="button_<?php echo $idx?>" name="button" value="<?php echo $value?>"
                                                <?if($post['button']==$value){?> checked<?}?>>&nbsp;<img src="<?php echo $data['DonBtns']?>/<?php echo $value?>" align="absmiddle" onclick="javascript:document.all['button_<?php echo $idx?>'].checked=true">
                                                <br>
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
            <form method="post" name="data" action="#tabs-2" id="sigup-form"  >
                    <div id="tabs">
                            <ul>
                                
                            </ul>
                            <div id="tabs-1">
                                
                            </div>
                            <div id="tabs-2">
                                    
                                        
                                                
                                                
                                    </div>
                            
                </div>

            </form>
        </center>
             
        <?}else{?>SECURITY ALERT: Access Denied<?}?>
<? } // end for check account type?>
    </div>

<!-- End content  -->