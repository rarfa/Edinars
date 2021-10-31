<script>
        jQuery(document).ready(function(){
            // binds form submission and fields to the validation engine
            jQuery("#flexy-form").validationEngine();
        });
</script>
<!-- Start content  -->
<div class="container">
<br />
<?if(isset($data['ScriptLoaded'])){?>
    <?if(!$post['PostSent']){?>
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

        <?if ($post['ShowCheckInfo']) {
                if ($post['dtype']=='topup')  {
                  ?>
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
                  <?
                }
        } ?>

<!-- ############# admin_box start ############# -->
        <div class="admin_box">
            <!-- ############# admin_box_header start ############# -->
            <div class="admin_box_header">
                <div class="box_header_left">
                    <div class="header_tabs"><!-- add tabs in this div -->
                        <a href="#tab01" class="default_tab current" onclick="jQuery('#flexy-form').validationEngine('hide');"><span class="tab">RECHARGE MOBILE</span><span class="tab_right"></span></a>
                        <a href="#tab02" ><span class="tab">HISTORIQUE </span><span class="tab_right"></span></a>
                    </div>
                </div>
            </div>
            <!-- ############# admin_box_header end ############# -->
            <!-- ############# content_box start ############# -->
            <div class="content_box">
                <div id="tab01" class="content default_tab">
                    <center>
                    <form method="post"  id="flexy-form" >
                        <table class="common_table_detail" >
                            <thead>
                                <tr>
                                    <th class="code_col"  colspan=2><b>FRAIS DE RECHARGER  <?php echo prnsumm($data['flexy_fee'])?>&nbsp;<?php echo prntext($data['Currency'])?></b></th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                         <td colspan=2>
                                          <input type="hidden" name="dtype" value="flexy">
                                         <input type="hidden" id ="operator" name ="operator" >
                                          <img src="../images/recharge/djezzy-off.png"  id ="djezzy" onclick="switchImg(this)">
                                          <img src="../images/recharge/mobilis-off.png" id ="mobilis" onclick="switchImg(this)">
                                          <img src="../images/recharge/ooredoo-off.png" id ="ooredoo"  onclick="switchImg(this)">

                                        </td>
                                </tr>
                                <tr>
                                        <input type="hidden" name="dtype" value="flexy">
                                        <br>
                                        <td>Type de Recharger:</td>
                                        <td>
                                            <select name="recharge_type" id="recharge_type" class="validate[required]" >

                                                <?php echo showselect($data['recharge_type'], "Credit")?>

                                            </select>
                                        </td>
                                </tr>
                                <tr>
                                        <td>Mobile &agrave; Recharger:</td>
                                         <td> <input type="text" name="mobile_flexy"  id="mobile_flexy" maxlength="10" value="<?php echo prntext($post['mobile_flexy'])?>" class="validate[required,custom[integer],minSize[10]]  text-input"></td>
                                </tr>
                                <tr>
                                        <td>Montant &agrave; Recharger:</td>
                                         <td> <input type="text" name="montant"  id="montant" maxlength="16" value="<?php echo prntext($post['montant'])?>" class="validate[required,custom[integer],min[100],max[5000]]  text-input"></td>

                                </tr>

                                <tr>
                                    <td colspan="2" class="middle">
                                            <input type="submit" id="submit" name="send" value="RECHARGEZ" />
                                    </td>
                                </tr>
                           </tbody>
                        </table>
                    </form>

                    </center>
                    <br class="clear" />
                </div>
                <div id="tab02" class="content">
                    <br class="clear" />
                    <center>
                        <table class="common_table">
                        <thead>
                            <tr>
                                <th class="data_col">OPERATOR</th>
                                <th class="data_col">NUM&Egrave;RO</th>
                                <th class="data_col">MONTANT</th>
                                <th class="data_col">FRAIS</th>
                                <th class="data_col">PAY&Egrave;</th>
                                <th class="data_col">DATE</th>
                                <th class="data_col">STATUT</th>
                                <th class="data_col">MESSAGE</th>
                            </tr>
                        </thead>
                        <tbody>
                                <?php if($post['Transactions']) {
                                            $idx=1;
                                    foreach($post['Transactions'] as $value){

                                        $url = "http://www.ediffuse.net/api/beta/transaction.php?imei=1111111111&pin=5818&trx_id=".$value['ussd_retries'] ;

                                        $Load_xml_ussd = simplexml_load_file($url);
                                        $comments = $Load_xml_ussd->trx[0]->trx_ussd_message;


                                        If ($Load_xml_ussd->trx[0]->trx_status != $value['status_update'] ) {

                                              $status = $Load_xml_ussd->trx[0]->trx_status;;
                                            if($status == "ATTENTE") {
                                                $status = 0;
                                            } else if($status == "TERMINE") {
                                                $status = 1;
                                            } else if($status == "ANNULER") {
                                                $status = 2;
                                            } else if($status == "REMBOURSE") {
                                                $status = 3;
                                            } else if($status == "PROCESSE") {
                                                $status = 4;
                                            } else if($status == "ERREUR") {
                                                $status = 99;
                                            }
                                                update_transaction_status_topup($value['id'], $status, $comments);
                                        }
                                        ?>
                                        <tr>
                                            <td nowrap ><?php echo $value['ussd_operator']?></td>
                                            <td nowrap ><?php echo $value['ussd_number']?></td>
                                            <td nowrap ><?php echo $value['amount']?></td>
                                            <td><?php echo $value['fees']?></td>
                                            <td nowrap><?php echo $value['nets']?></td>
                                            <td><?php echo $value['tdate']?></td>
                                            <td><?php echo  "<font color=".get_status_color($status).">".$data['TransactionStatus'][$status].'</font>'?></td>


                                            <td nowrap>
                                            <?if($value['canview']){?>
                                                <a href="<?php echo $data['Members']?>/mon-historique-Edinars-transaction.html/<?php echo $value['id']?>/details">D&Egrave;TAIL</a>
                                            <?}?>
                                            </td>
                                        </tr>

                                    <?php   } 
                                }?>



                            </tbody>
                    </table>
                    <div class="table_bottom_right_tool">
                        <?if($data['Pages']){?>
                            <div class="page_area">
                                <?$count=count($data['Pages']);
                                     for($i=0; $i<$count; $i++){?>
                                        <?if($data['Pages'][$i]==$post['StartPage']){?>
                                            <span class="current"><?php echo $i+1?></span>
                                        <?}else{?>
                                            <a href="<?php echo $data['Members']?>/recharger-mobile-Edinars.html/<?php echo $data['Pages'][$i]?>" title="Page <?php echo $i+1?>"><?php echo $i+1?></a>
                                        <?}?>
                                    <?}?>
                            </div>
                        <?}?>
                    </div>
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


    <?}else{?>
<?if($post['dtype']=='pincode'){?>


<?}elseif($post['dtype']=='topup'|| $post['dtype']=='CCP'){?>

    <?if($post['ShowCheckInfo']){?>
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

        <?
        }
}?>
<CENTER>
        <?if($post['dtype']=='CCP'){?>
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
        <table class="common_table_detail" >
            <thead>
                <tr>
                    <th class="code_col"  colspan=2>
                    D&egrave;tails de la transaction
                    <br>(Ajouter des fonds avec <?php echo strtoupper($data['DepositMethod'][$post['dtype']]['name'])?>)
                </tr>
            </thead>
            <tbody>
                    <tr>
                            <td>Montant</td>
                            <td><?php echo prnpays($post['montant'])?></td>
                    </tr>
                    <tr>
                            <td>Frais</td>
                            <td><?php echo prnpays(-$post['fees'])?></td>
                    </tr>
                    <tr>
                            <td>D&egrave;p&ocirc;t Total</td>
                            <td><?php echo prnpays($post['total'])?></td>
                    </tr>
                    <?if($post['dtype']=='CCP'){?>
                            <?if(!$post['ShowCheckInfo']){?>
                            <tr>
                                <td colspan=2 >
                                    <b>S'il vous pla&icirc;t envoyer un paiement de <?php echo prnpays($post['total'])?> sur le compte suivante</b>
                                </td>
                            </tr>
                            <tr>
                                <td colspan=2 >
                                <?php echo prntext($data['CCPAccount'])?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan=2 >
                                    <b>S'il vous pla&icirc;t Note: inclure une note avec votre d&egrave;tail</b>
                                </td>
                            </tr>
                            <tr>
                                <td>identifiant</td>
                                <td><?php echo prntext($post['username'])?></td>
                            </tr>
                            <tr>
                                <td>Numero Compte</td>
                                <td><?php echo prntext($_SESSION['Mem_Id'])?></td>
                            </tr>
                            <tr>
                                <td colspan=2>
                                     <b> et   l'adresse email que vous avez enregistr&egrave; aupr&egrave;s de (<?php echo prntext($post['email'])?>),
                                    <br>afin que nous puissions de cr&egrave;dit votre compte.</b>
                                </td>
                            </tr>
                            <tr>
                                <td colspan=2 class="middle">
                                    <FORM METHOD="POST">
                                        <input type="submit" id="submit" name="cancel" value="<?if($post['dtype']=='CCP'){?>Termin&egrave;<?}elseif ($post['ShowCheckInfo']){ ?>VALIDER LE DEPOT<?} else{?>ANULLER TRANSACTION<?}?>" />
                                    </FORM>
                                </td>
                            </tr>
                     <?}else{?>
                    <tr>
                        <td colspan=2 class="middle">
                            <?php echo prntext($post['CheckInfo'])?>
                        </td>
                    </tr>
                <?}?>
            <?}?>
           </tbody>
        </table>
    <?}?>
</CENTER>
<script>
function switchImg(img){

        img.src = img.src.match(/-on/) ?

        img.src.replace(/-on/, "-off") :
        img.src.replace(/-off/, "-on");

        document.getElementById("operator").value = img.id;


        switch( img.id) {
        case 'djezzy':
                document.getElementById("mobilis").src = "../images/recharge/mobilis-off.png" ;
                document.getElementById("ooredoo").src=  "../images/recharge/ooredoo-off.png" ;

            break;
        case 'mobilis':
                document.getElementById("djezzy").src = "../images/recharge/djezzy-off.png" ;
                document.getElementById("ooredoo").src = "../images/recharge/ooredoo-off.png" ;
            break;
        case 'ooredoo':
                document.getElementById("djezzy").src = "../images/recharge/djezzy-off.png" ;
                document.getElementById("mobilis").src = "../images/recharge/mobilis-off.png" ;
                break;
        default:
            document.getElementById("djezzy").src.replace(/-on/, "-off");
            document.getElementById("mobilis").src.replace(/-on/, "-off");
            document.getElementById("ooredoo").src.replace(/-on/, "-off");

}



}
</script>
<?}else{?>SECURITY ALERT: Access Denied<?}?>
</div>

<!-- End content  -->
