<script>
            jQuery(document).ready(function(){
                // binds form submission and fields to the validation engine
                jQuery("#sigup-form-step1").validationEngine();
                jQuery("#sigup-form-step2").validationEngine();
                jQuery("#sigup-form-step3").validationEngine();
            });
            
</script>

<!-- Start content  -->
<div class="content">
<br />



                        
<?if(isset($data['ScriptLoaded'])){?>
    <?//if(!$data['PostSent']){?>
        <?if($data['InfoIsProfileEmpty']){?>
                        <br>
                        <center>
                            <div class="ui-widget">
                            <div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
                                <p><span class="ui-icon ui-icon-alert" style="float: centre; margin-right: .3em;"></span> 
                                <b><u>REMARQUE</u>
                                <blockquote>Avant l'utilisation de notre syst&egrave;me, vous devez remplir les formulaires de votre 
                                    <?php if (strlen(prntext($post['fname'])) == 0 ) {  ?>
                                    profil 
                                    <?php } elseif (strlen(prntext($post['address'])) == 0) {  ?> 
                                    Address  
                                    <?php } else {  ?>
                                    profil et Address.
                                    <?php } ?> 
                                    </blockquote>
                                <p>
                            </div>
                            </div>
                            </center>
                            <br>
                            <?php if (strlen(prntext($post['fname'])) == 0 ) {  ?>
                            
                            <?php } elseif (strlen(prntext($post['address'])) == 0) {  ?> 
                            <script>
                                jQuery(document).ready(function(){
                                    $('.content_box div.content').hide(); 
                                    $('.header_tabs a.default_tab').addClass('current'); 
                                    $('.content_box div.default_tab').show(); 
                                    $(".header_tabs a").each(function(){
                                            if($(this).attr("href")=="#tab02") { 
                                            $(this).parent().find("a").removeClass('current'); 
                                            $(this).addClass('current'); 
                                            var currentTab = $(this).attr('href'); 
                                            $(currentTab).siblings().hide(); 
                                            $(currentTab).show(); 
                                            }
                                        })
                                });
                            </script>
                            
                            <?php } ?> 
            
        <?}?>
            <center>
                    <?if($data['Error']){?>
                        <br>
                            <div class="ui-widget">
                            <div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
                                <p><span class="ui-icon ui-icon-alert" style="float: centre; margin-right: .3em;"></span> 
                                <?php echo prntext($data['Error'])?>.</p>
                            </div>
                            </div>
                            <br>
                    <?}?>
            </center>
<!-- ############# admin_box start ############# -->
        <div class="admin_box">
            <!-- ############# admin_box_header start ############# -->
            <div class="admin_box_header">
                <div class="box_header_left">
                
                <div class="header_tabs"><!-- add tabs in this div -->
                <a href="#tab01" class="default_tab current" onclick="jQuery('#sigup-form-step1').validationEngine('hide');jQuery('#sigup-form-step2').validationEngine('hide');jQuery('#sigup-form-step3').validationEngine('hide')<?php if($post['type'] == 1) {?> ;jQuery('#sigup-form-step4').validationEngine('hide')<?php 
                                                                                                                                                                                                                                    } ?> " ><span class="tab">Mon Profile</span><span class="tab_right"></span></a>
                <a href="#tab02" onclick="jQuery('#sigup-form-step1').validationEngine('hide');jQuery('#sigup-form-step2').validationEngine('hide');jQuery('#sigup-form-step3').validationEngine('hide')<?php if($post['type'] == 1) {?> ;jQuery('#sigup-form-step4').validationEngine('hide')<?php 
                                                                                                                                                                                                        } ?>"><span class="tab">Mon Address</span><span class="tab_right"></span></a>
                <?php if($post['type'] == 1) {?>
                    <a href="#tab04" onclick="jQuery('#sigup-form-step1').validationEngine('hide');jQuery('#sigup-form-step2').validationEngine('hide');jQuery('#sigup-form-step3').validationEngine('hide');jQuery('#sigup-form-step4').validationEngine('hide')"><span class="tab">Mon Entreprise</span><span class="tab_right"></span></a>
                <?php } ?>
                </div>
                </div>                
            </div>
            
            <!-- ############# admin_box_header end ############# -->
                
                
            <!-- ############# content_box start ############# -->
            <div class="content_box">
                <div id="tab01" class="content default_tab">
                    <center>
                    <br class="clear" />
                      <form method="post"  action="" id="sigup-form-step1" >
                        <table class="common_table_detail">
                            <thead>
                                <tr>
                                    <th class="code_col" colspan="2">Mon Profile</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Mon Status</td>
                                    <td><font color=<?if($post['status']<2){?>#FF0000<?}else{?>#0066CC<?}?>><?php echo prntext($data['MemberStatus'][$post['status']]['status'])?></font>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Identifiant</td>
                                    <td><?php echo prntext($post['username'])?> </td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><?php echo $post['emails']?></td>
                                </tr>
                                <tr>
                                    <td>Nom (*)</td>
                                    <?if($data['InfoIsProfileEmpty']){?>
                                        <td><input type="text" name="fname" id="fname" size="41" maxlength="32" value="<?php echo prntext($post['fname'])?>" class="validate[required] text-input"></td>
                                    <? } else { ?>
                                        <td><?php echo prntext($post['fname'])?></td>
                                    <? } ?>
                                </tr>
                                <tr>
                                    <td>Pr&egrave;nom (*)</td>
                                    <?if($data['InfoIsProfileEmpty']){?>
                                        <td><input type="text" name="lname" id="lname" size="41" maxlength="32" value="<?php echo prntext($post['lname'])?>" class="validate[required] text-input"></td>
                                    <? } else { ?>
                                        <td><?php echo prntext($post['lname'])?></td>
                                    <? } ?>
                                    
                                </tr>
                                <tr>
                                    <td>Type de compte (*)</td>
                                    <?if($data['InfoIsProfileEmpty']){?>
                                        <td><select name="type" id="type" class="validate[required]">
                                                          <?php echo showselect($data['MemberType'], $post['type'])?>
                                                        </select>
                                        </td>
                                    <? } else { ?>
                                        <td>    <?php echo $data['MemberType'][$post['type']] ?></td>
                                    <? } ?>
                                </tr>
                                <tr>
                                    <td>T&egrave;l&egrave;phone</td>
                                    <td><input type="text" name="phone" size="41" maxlength="64" value="<?php echo prntext($post['phone'])?>"></td>
                                </tr>
                                <tr>
                                    <td>Mobile (*)</td>
                                    <td><input type="text" name="mobile"  id="mobile" size="41" maxlength="64" value="<?php echo prntext($post['mobile'])?>" class="validate[required,custom[phone]] text-input"></td>
                                </tr>
                                <tr>
                                    <td>Fax</td>
                                    <td><input type="text" name="fax" size="41" maxlength="64" value="<?php echo prntext($post['fax'])?>"></td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="middle">
                                        <input type="hidden" name="change" value="updateProfile" >
                                        <input type="submit" id="submit" name="send" value="sauvegarder" />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        </form>         
                        
                    </center>    
                        <br class="clear" />
                </div>
                
                <div id="tab02" class="content">
                        <center>
                        <br class="clear" />
                        <form method="post"  action="" id="sigup-form-step2" >
                        <table class="common_table_detail">
                        <thead>
                            <tr>
                                <th class="code_col" colspan="2">Mon Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                        <td>Address (*):</td>
                                        <td><input type="text" name="address"  id="address" size="41" maxlength="128" value="<?php echo prntext($post['address'])?>" class="validate[required] text-input"></td>
                                    </tr>
                                    <tr>
                                        <td>Commune (*):</td>
                                        <td><input type="text" name="city" id="city" size="41" maxlength="64" value="<?php echo prntext($post['city'])?>" class="validate[required] text-input"></td>
                                    </tr>
                                    <tr>
                                        <td>Code postal (*):</td>
                                        <td><input type="text" name="postcode" id="postcode" size="41" maxlength="64" value="<?php echo prntext($post['postcode'])?>" class="validate[required] text-input"></td>
                                    </tr>
                                    <tr>
                                        <td>Wilaya(*):</td>
                                        <td><select name="wilaya" id="wilaya" class="validate[required]"><?php echo showselect($data['Wilayas'], $post['wilaya'])?></select></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="middle">
                                            <input type="hidden" name="change" value="updateAddress" >
                                            <input type="submit" id="submit" name="send" value="sauvegarder" />
                                        </td>
                                    </tr>                                    
                        </tbody>
                        </table>
                        </form>         
                        <br>
                    
                    <br class="clear" />
                </center>
                        
                </div>
                <?php if($post['type'] == 1) {?>
                <div id="tab04" class="content">
                    <center>
                            <br class="clear" />
                            <form method="post" action=""   id="sigup-form-step3" enctype="multipart/form-data" >
                            <table class="common_table_detail">
                                <thead>
                                    <tr>
                                        <th class="code_col" colspan="2">Mon Entreprise</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                                <td>Nom de soci&eacute;t&eacute; (*) :</td>
                                                <td><input type="text" name="company" id="company"  size="41" maxlength="128" value="<?php echo prntext($post['company'])?>" class="validate[required] text-input"></td>
                                            </tr>
                                            <tr>
                                                <td>N&deg; RC (*) :</td>
                                                <td><input type="text" name="nrc"  id="nrc" size="41" maxlength="128" value="<?php echo prntext($post['nrc'])?>" class="validate[required] text-input"></td>
                                            </tr>
                                            <tr>
                                                <td>N&deg; NIF (*) :</td>
                                                <td><input type="text" name="nnif" id="nnif" size="41" maxlength="128" value="<?php echo prntext($post['nnif'])?>" class="validate[required] text-input"></td>
                                            </tr>
                                            <tr>
                                                <td>N&deg; ART (*) :</td>
                                                <td><input type="text" name="nart" id="nart" size="41" maxlength="128" value="<?php echo prntext($post['nart'])?>" class="validate[required] text-input"></td>
                                            </tr>
                                            <tr>
                                                <td>N&deg; FIS :</td>
                                                <td><input type="text" name="nfis" size="41" maxlength="128" value="<?php echo prntext($post['nfis'])?>"></td>
                                            </tr>
                                            <tr>
                                                <td>Logo </td>
                                                <td>
                                                    <input type="file" name="logo" id="logo" class="validate[required] text-input"> 
                                                    <br>La Taille 158 x 103
                                                    <?php if ($post['logo']) {?>
                                                        <br />
                                                        <b style="color:red">Laissez ce champs vide si vous voulez pas &egrave;craser</b>
                                                    <?php }//if ($image) ?>
                                                </td>
                                            </tr>
                                              <?php if ($post['logo']) {?>
                                                <tr>
                                                    <td valign="top">Logo d'origine</td>
                                                    <td valign="top"><img src="<?php echo $post['logo']?>" /><br />
                                                </tr>
                                              <?php }//if ($image) {?>
                                            <tr>
                                        <td colspan="2" class="middle">
                                            <input type="hidden" name="change" value="updateEntreprise" >
                                            <input type="submit" id="submit" name="send" value="sauvegarder" />
                                        </td>
                                    </tr>        
                                                
                                </tbody>
                                </table>
                        </form>         
                        </center>
                <?php } ?>
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
                    
<?}else{?>
    SECURITY ALERT: Access Denied
    
<?}?>
</div>

<!-- End content  -->