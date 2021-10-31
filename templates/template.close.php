<!-- Start content  -->
<div class="content">
<br />
<center>                        
<?if(isset($data['ScriptLoaded'])){?>
        <?if(!$post['send']){?>
            
            <div class="ui-widget">
                <div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
                    <p><span class="ui-icon ui-icon-alert" style="float: centre; margin-right: .3em;"></span> 
                        S'IL VOUS PLA&Icirc;T confirmer que vous voulez de fermer votre compte?
                    </p>
                </div>
            </div>
            <br>
        <!-- ############# admin_box start ############# -->
        <div class="admin_box">
            <!-- ############# admin_box_header start ############# -->
            <div class="admin_box_header">
                <div class="box_header_left">
                    <div class="header_tabs"><!-- add tabs in this div -->
                        <a href="#tab01" class="default_tab current" ><span class="tab">Fermer Mon Compte</span><span class="tab_right"></span></a>
                    </div>
                </div>                
            </div>
            <!-- ############# admin_box_header end ############# -->
            <!-- ############# content_box start ############# -->
            <div class="content_box">
                <div id="tab01" class="content default_tab">
                    <center>
                    <br class="clear" />
                     <form method="post"  id="sigup-form">
                        <table class="common_table_detail">
                            <thead>
                                <tr>
                                    <th class="code_col" colspan="2">Fermer Mon Compte</th>
                                </tr>
                                <tr>
                                    <th class="code_col" colspan="2">
                                            Si vous s&eacute;lectionnez "Fermer mon compte" ci-dessous, vous ne pourrez plus avoir acc&eacute;s aux informations de votre compte
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="2" class="middle">
                                        <input type="submit" id="submit" name="cancel" value="Annuler" />
                                        <input type="submit" id="submit" name="send" value="Fermer mon compte" onclick="return cfmform()" />
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

        </center>
 
        <?}else{?>
                <div class="ui-widget">
                <div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
                    <p><span class="ui-icon ui-icon-alert" style="float: centre; margin-right: .3em;"></span> 
                        Votre <?php echo prntext($data['SiteName'])?> compte a &egrave;t&egrave; ferm&egrave;.    
                                    <br>Merci d'utiliser notre service.
                    </p>
                </div>
            </div>
            <br>
                
        <?}?>


<?}else{?>SECURITY ALERT: Access Denied<?}?>
</div>

<!-- End content  -->
