<!-- Start content  -->
<div class="content">
<br />
<?if(isset($data['ScriptLoaded'])){?>
        
            
<!-- ############# admin_box start ############# -->
        <div class="admin_box">
            <!-- ############# admin_box_header start ############# -->
            <div class="admin_box_header">
                <div class="box_header_left">
                    <div class="header_tabs"><!-- add tabs in this div -->
                        <a href="#tab01" class="default_tab current" ><span class="tab">MEMBER INFORMATION</span><span class="tab_right"></span></a>
                    </div>
                </div>                
            </div>
            <!-- ############# admin_box_header end ############# -->
            <!-- ############# content_box start ############# -->
            <div class="content_box">
                <div id="tab01" class="content default_tab">
                    <center>
                    <br class="clear" />
                    <center>    
                        <table class="common_table_detail">
                            <thead>
                                <tr>
                                
                                </tr>
                            </thead>
                            <tbody>
                                    <tr> 
                                            <td>Identifiant:</td>
                                            <td><?php echo prntext($post['Profile']['username'])?></td>
                                    </tr> 
                                    <tr> 
                                            <td>E-Mail Address:</td>
                                            <td><?php echo $post['useremails']?></td>
                                    </tr>
                                    <tr> 
                                            <td>Nom:</td>
                                            <td><?php echo prntext($post['Profile']['fname'])?> <?php echo prntext($post['Profile']['lname'])?></td>
                                    </tr>
                                    <tr> 
                                            <td>Company:</td>
                                            <td><?php echo prntext($post['Profile']['company'])?>&nbsp;</td>
                                    </tr>
                          </tbody>
                        </table>    
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
   
        
            
<?}else{?>SECURITY ALERT: Access Denied<?}?>
</div>

<!-- End content  -->