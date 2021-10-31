<section id="content">
        <div class="container">
            <div class="inside">
                  <!--
                <div id="slogan">
                    <div class="inside">
                        <h2><span>Your Domain Name</span> Helps the World  to Find You</h2>
                        <p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae.</p>
                    </div>
                </div>
                -->
                <div class="inside1">
                    <div class="wrap row-2">
                        <article class="col-1">
                         <div class="box-left-top col-1 "> 
                                <BR>
                                <p class="pt">S&egrave;curit&egrave;</p>
                            </div>
                            <div class="box-left-middle  col-1 "> 
                                <div class="left"> 
                                    <div class="right">
                                    
                                        <p class="pm">
                                            Ne saisissez jamais votre mot de pass dans des logiciels inconnus, car il pourrait s’agir d’une tentative frauduleuse d’accéder à vos données et à votre compte Edinars    </p>
                                        </p>
                                        <div class="aligncenter">
                                                <a href="securite-Edinars" class="link">Plus information</a>
                                            </div>
                                        <BR><BR>    
                                    </div>
                                    
                                </div>    
                            </div>
                            <div class="box-left-bottom col-1 maxheight"></div>
                        </article>
                        <article class="col-2">
                        
<?if(isset($data['ScriptLoaded'])){?>
<center>
                            <div class="box-right-top col-2"> 
                                    <BR><p class="pt">Nouvelle adresse e-mail</p>
                            </div>
                            <div class="box-right-middle  col-2 "> 
                         <div class="left"> 
                            <div class="right">
                                <br>
                                <p class="pm">
                                    <?if($data['Error']){?>
                                    <br>
                                    <div class="ui-widget">
                                    <div class="ui-state-error ui-corner-all" style="padding: 0 .7em;width:350px"> 
                                        <p><span class="ui-icon ui-icon-alert" style="float: centre; margin-right: .3em;"></span> 
                                        <?php echo prntext($data['Error'])?>.</p>
                                    </div>
                                    </div>
                                    <br>
                                    <? } elseif (isset($_GET['c'])) { ?>
                                            <div class="ui-widget">
                                                <div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;;width:350px"> 
                                                <p><span class="ui-icon ui-icon-info" style="float: centre; margin-right: .3em;"></span>
                                                        Vous avez activ&eacute;  avec succ&egrave;s votre nouvellement ajout&eacute;s adresse e-mail.
                                                    </p>
                                                </div>
                                                </div>
                                                <br>
                                    <?}?>

                                </p>
                                
                            </div>
                        </div>    
                        <div class="box-right-bottom col-2 maxheight"></div>
                </div>
            </div>    
            </center>


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
