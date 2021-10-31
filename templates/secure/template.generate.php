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
                        <a href="#tab01" class="default_tab current" ><span class="tab">CODE #1 - En utilisant la m&egrave;thode POST</span><span class="tab_right"></span></a>
                        <a href="#tab02"><span class="tab">CODE #2 - En utilisant la m&egrave;thode GET</span><span class="tab_right"></span></a>
                    </div>
                </div>                
            </div>
            <!-- ############# admin_box_header end ############# -->
            <!-- ############# content_box start ############# -->
            <div class="content_box">
                <div id="tab01" class="content default_tab">
                    <center>
                    <br class="clear" />
                    
                        
                                Besoin de description de tous champ utilis&egrave; s'il vous pla&icirc;t <a href="<?php echo $data['Members']?>/paiments-Edinars#ipn">CLIQUEZ ICI</a>
                                <br><br>
                                 Copiez ce code et coller dans votre page
                                <br><br>
                            <form id="code-form" action="">    
                                <textarea readonly ><?php echo $post['PostHtmlCode']?></textarea>
                            </form>    
                                
                                
                                    <h2>EXEMPLE</h2>
                                    POST :<br>  <br><?php echo unhtmlentities($post['OrgPostHtml'])?>
                                    <br>
                               
                            </form>
                    </center>    
                    </center>    
                        <br class="clear" />
                </div>
                
                <div id="tab02" class="content">
                    <br class="clear" />
                        <center>    
                        <form id="code-form" action="">
                                 Besoin de description de tous champ utilis&egrave; s'il vous pla&icirc;t <a href="<?php echo $data['Members']?>/paiments-Edinars#ipn">CLIQUEZ ICI</a>
                                <br><br>
                                 Copiez ce code et coller dans votre page
                                <br><br>
                                <textarea readonly ><?php echo $post['GetHtmlCode']?></textarea>
                            </form>
                            
                              <center>
                                    <h2>EXEMPLE</h2>

                                     <div>GET :  <br><br><?php echo unhtmlentities($post['OrgGetHtml'])?></div>
                                    <br>
                                </center>
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
    
    
    
    
    