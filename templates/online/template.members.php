<?if(isset($data['ScriptLoaded'])){?>
<center>
<?if($post['action']=='select'){?>

<!-- ############# wrapper start ############# -->
<div class="wrapper">    
    
<!-- ############# admin_box start ############# -->
<div class="admin_box">
    <!-- ############# admin_box_header start ############# -->
    <div class="admin_box_header">
        <div class="box_header_left">
            <div class="header_tabs">
                <!-- add tabs in this div -->
                <a href="#tab01" class="default_tab current">
                    <span class="tab">
                              LISTE DES COMPTE 
                            <?if($post['type']=='found'){?>TROUVER<?} 
                            else if($post['type']=='active'){?>ACTIF 
                            <?}elseif($post['type']=='suspended'){?>SUSPENDU
                            <?}elseif($post['type']=='closed'){?>FERM&Egrave;
                            <?}elseif($post['type']=='online'){?>ONLINE<?}?> 
                            <?if($post['type']!='online'){?> (DISPONIBLE <?php echo $data['MembersCount']?> MEMBRES)<?}?>
    
                    </span>
                    <span class="tab_right"></span>
                </a>
                
                <!-- add class="no_submenu" while a tab with no content -->
            </div>
        </div>                
    </div> 
    <!-- ############# admin_box_header end ############# -->
        
    <!-- ############# content_box start ############# -->
    <div class="content_box">
    
        <div id="tab01" class="content default_tab">
           
            <br class="clear" />
            <table class="common_table">
                <thead>
                    <tr>
                        <th class="data_col">IDENTIFIANT</th>
                        <th class="short_col">NOM ET PR&Egrave;NOM</th>
                        <th class="short_col">E-MAIL</th>
                        <th class="short_col">COMPTE</th>
                        <th class="short_col">PARRAINER</th>
                        <th class="short_col">NUM TR</th>
                        <th class="short_col">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                <?foreach($data['MembersList'] as $key=>$value){$bgcolor=$key%2?'#EEEEEE':'#E7E7E7'?>
                    <tr bgcolor=<?php echo $bgcolor?> onmouseover="setPointer(this,<?php echo $key?>,'over','<?php echo $bgcolor?>','#CCFFCC','#FFCC99')" onmouseout="setPointer(this,<?php echo $key?>,'out','<?php echo $bgcolor?>','#CCFFCC','#FFCC99')" onmousedown="setPointer(this,<?php echo $key?>,'click','<?php echo $bgcolor?>','#CCFFCC','#FFCC99')">
                    <td>
                        <a href="members.php?id=<?php echo $value['id']?>&action=detail&type=<?php echo $post['type']?>&page=<?php echo $post['StartPage']?>"><?php echo $value['username']?></a>
                        </td>
                        <td nowrap><?php echo $value['fname']?> <?php echo $value['lname']?><?if($post['type']=='online'){?> (<?php echo $value['last_ip']?>)<?}?></td>
                        <td><?php echo $value['email']?></td>
                        <td><?php echo $data['MemberType'][$value['type']]?></td>
                        <td><a href="members.php?id=<?php echo $value['sponsor']?>&action=detail&type=<?php echo $post['type']?>&page=<?php echo $post['StartPage']?>"><?php echo $value['sname']?></a></td>
                        <td><a href="transactions.php?bid=<?php echo $value['id']?>&action=select"><?php echo $value['transactions']?></a></td>
                        <td nowrap>
                        <?if($post['type']=='online'){?>---<?}else{?><a href="members.php?id=<?php echo $value['id']?>&action=detail&type=<?php echo $post['type']?>&page=<?php echo $post['StartPage']?>">VOIR</a>|
                        <?if($post['type']=='active'){?>
                                <a href="members.php?id=<?php echo $value['id']?>&action=suspend&type=<?php echo $post['type']?>&page=<?php echo $post['StartPage']?>" onclick="return cfmform()">SUSPENDRE</a>|
                                <a href="members.php?id=<?php echo $value['id']?>&action=close&type=<?php echo $post['type']?>&page=<?php echo $post['StartPage']?>" onclick="return cfmform()">FERME</a>
                        <?}else{?>
                                <a href="members.php?id=<?php echo $value['id']?>&action=activate&type=<?php echo $post['type']?>&page=<?php echo $post['StartPage']?>" onclick="return cfmform()">ACTIVATE</a>
                        <?}?>
                            <?if($value['candelete']){?>|
                            <a href="members.php?id=<?php echo $value['id']?>&action=delete&type=<?php echo $post['type']?>&page=<?php echo $post['StartPage']?>" onclick="return cfmform()">EFFACER</a>
                        <?}}?>
                        </td>
                    </tr> 
                   <?}?>
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
                                    <a href="members.php?action=<?php echo $post['action']?>&type=<?php echo $post['type']?>&page=<?php echo $data['Pages'][$i]?>" title="Page <?php echo $i+1?>"><?php echo $i+1?></a>
                                <?}?>
                            <?}?>
                    </div>            
                <?}?>
            </div>
            <br class="clear" />
        </div>
        <br class="clear" />
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
<!-- ############# wrapper end ############# -->
<BR><BR><BR>
<!-- ############# wrapper end ############# -->


<?}elseif($post['action']=='detail'){?>


<!-- ############# wrapper start ############# -->
<div class="wrapper">
    
    
<!-- ############# admin_box start ############# -->
<div class="admin_box">
    
    
    <!-- ############# admin_box_header start ############# -->
    <div class="admin_box_header">
        <div class="box_header_left">
        
        <div class="header_tabs"><!-- add tabs in this div -->
        <a href="#tab01" class="default_tab current"><span class="tab">INFO PROFILE</span><span class="tab_right"></span></a>
        <a href="#tab02"><span class="tab">INFO ADDRESS</span><span class="tab_right"></span></a>
        <a href="#tab03"><span class="tab">INFO BANCAIRES</span><span class="tab_right"></span></a>
        <? if ( $post['MemberInfo']['type'] == 1 ) { ?>
            <a href="#tab04"><span class="tab">INFO ENTREPRISE</span><span class="tab_right"></span></a>
        <? } ?>    
       </div>
        
        </div>                
    </div>
    <!-- ############# admin_box_header end ############# -->
    <!-- ############# content_box start ############# -->
    <div class="content_box">
    
        <div id="tab01" class="content default_tab">
            
            <br class="clear" />
            <table class="common_table_detail">
            <thead>
            <tr>
                <th class="data_col" colspan="2">INFORMATIONS GÉNÉRALES</a></th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="left">Balance</td>
                    <td>
                        <font color=green><a href="transactions.php?bid=<?php echo $post['MemberInfo']['id']?>&action=select"><?php echo balance($post['MemberInfo']['balance'])?></a></font>
                    </td>
                </tr>
                <tr>
                    <td class="left">Statut</td>
                    <td  nowrap>
                        <font color=<?if($post['MemberInfo']['active']==1){?>green>ACTIF<?}
                        elseif($post['MemberInfo']['active']==2){?>gray>FERMÉ<?}
                        else{?>maroon>SUSPENDU<?}?>
                        </font>, <a href="verify.php?action=help&status=<?php echo $post['MemberInfo']['status']?>">
                                <font color=<?if($post['MemberInfo']['status']<2){?>#FF0000<?}
                                                else{?>#0066CC<?}?>><?php echo $data['MemberStatus'][$post['MemberInfo']['status']]['status']?></font></a></b>
                              | 
                                    <?if($post['MemberInfo']['active']==1){?>
                                        <font color=#FFFFFF>|</font> 
                                        <a href="members.php?id=<?php echo $post['MemberInfo']['id']?>&action=<?if($post['MemberInfo']['status']==0){?>verify<?}
                                                                                                        elseif($post['MemberInfo']['status']==1){?>certify<?}
                                                                                                        else{?>unverify<?}?>&page=<?php echo $post['StartPage']?>" onclick="return cfmform()">
                                    <?}?>
                                    <?if($post['MemberInfo']['status']==0){?>Vérifier maintenant<?}
                                    elseif($post['MemberInfo']['status']==1){?>Certifie MAINTENANT<?}
                                    elseif($post['MemberInfo']['status']==2){?>Annuler la vérification<?}?>
                                    <?if($post['MemberInfo']['status']<2){?></a><?}?>
                            
                    </td>
                </tr>
                <tr>
                    <td class="left">Compte</td>
                    <td>
                        <?php echo $data['MemberType'][$post['MemberInfo']['type']]?>
                    </td>
                </tr>
                <tr>
                    <td class="left">Nom et pr&egrave;nom</td>
                    <td ><?php echo $post['MemberInfo']['fname']?> <?php echo $post['MemberInfo']['lname']?></td>
                </tr>
                <tr>
                    <td class="left">Identifiant</td>
                    <td nowrap><?php echo $post['MemberInfo']['username']?></td>
                </tr>
                
                <tr>
                    <td class="left">Emails:</td>
                    <td nowrap>
                        <?php echo $post['MemberInfo']['email']?>&nbsp;</td>
                                
                        <?if($post['MemberInfo']['emails']){?>
                                    <?foreach($post['MemberInfo']['emails'] as $key=>$val){$bgcolor=($key+1)%2?'#EEEEEE':'#E7E7E7'?>
                                    <br>
                                    <?php echo $val['email']?>&nbsp;
                                            <?if($val['status']>=2){?><a href="members.php?id=<?php echo $post['MemberInfo']['id']?>&bid=<?php echo $val['id']?>&action=setdefault&type=<?php echo $post['type']?>&page=<?php echo $post['StartPage']?>">Primaire</a><?}
                                            elseif($val['status']<2){?><a href="members.php?id=<?php echo $post['MemberInfo']['id']?>&bid=<?php echo $val['id']?>&action=sendemail&type=<?php echo $post['type']?>&page=<?php echo $post['StartPage']?>">V&egraves;rifier</a><?}?>
                                            |<a href="members.php?id=<?php echo $post['MemberInfo']['id']?>&bid=<?php echo $val['id']?>&action=delemail&type=<?php echo $post['type']?>&page=<?php echo $post['StartPage']?>" onclick="return cfmform()">Effaceer</a>
                                <?}?>
                                <?}?>
                    </td>
                </tr>
                <tr>
                        <td class="left" nowrap>T&egrave;l&egrave;phone</td>
                        <td><?php echo $post['MemberInfo']['phone']?></td>
                </tr>
                <tr>
                        <td class="left" nowrap>Mobile</td>
                        <td><?php echo $post['MemberInfo']['mobile']?></td>
                </tr>
                <tr>
                        <td class="left" nowrap>Fax</td>
                        <td><?php echo $post['MemberInfo']['fax']?></td>
                    </tr>
                <tr>
                    <td class="left" nowrap>Parrainer</td>
                    <td  nowrap>
                        <?if($post['MemberInfo']['sponsor']){?><a href="members.php?id=<?php echo $post['MemberInfo']['sponsor']?>&action=detail"><?php echo $post['MemberInfo']['sname']?></a> (<a href="mailto:<?php echo $post['MemberInfo']['smail']?>"><?php echo $post['MemberInfo']['smail']?></a>)<?}else{?>---<?}?>
                    </td>
                </tr>
                <tr>
                    <td class="left" nowrap >Date de création</td>
                    <td nowrap><?php echo prndate($post['MemberInfo']['cdate'])?></td>
                </tr>
                <tr>
                    <td class="left" nowrap>Dernier accès</td>
                    <td  nowrap>
                        <?php echo prndate($post['MemberInfo']['ldate'])?><?if($post['MemberInfo']['last_ip']){?> (à partir de IP: <?php echo $post['MemberInfo']['last_ip']?>)<?}?>
                        <font color=#FFFFFF> | </font><a href="javascript:view('<?php echo $data['Admins']?>/audit.php?member=<?php echo $post['MemberInfo']['id']?>',300,400)">IP HISTOIRE</a>
                    </td>
                </tr>
                <tr>
                    <td class="left" nowrap>DESCRIPTION</td>
                    <td ><?php echo $post['MemberInfo']['description']?$post['MemberInfo']['description']:'N/A'?></td>
                </tr>
                <tr>
                    <td class=capc colspan=2>
                        <a href="members.php?id=<?php echo $post['MemberInfo']['id']?>&action=cancel&type=<?php echo $post['MemberInfo']['active']?>&page=<?php echo $post['StartPage']?>">RETOUR</a>|
                        <a href="members.php?id=<?php echo $post['MemberInfo']['id']?>&action=update&type=<?php echo $post['MemberInfo']['active']?>&page=<?php echo $post['StartPage']?>">MODIFIER</a>|
                        <?if($post['type']=='active'||$post['type']==1){?>
                            <a href="members.php?id=<?php echo $post['MemberInfo']['id']?>&action=suspend&type=<?php echo $post['MemberInfo']['active']?>&page=<?php echo $post['StartPage']?>" onclick="return cfmform()">SUSPENDRE</a>
                        <?}else{?>
                            <a href="members.php?id=<?php echo $post['MemberInfo']['id']?>&action=activate&type=<?php echo $post['MemberInfo']['active']?>&page=<?php echo $post['StartPage']?>" onclick="return cfmform()">ACTIVER</a>
                        <?}?>
                    </td>
                </tr>
                <tr>
                    <td class=capc colspan=2>
                        <a href="transactions.php?bid=<?php echo $post['MemberInfo']['id']?>&action=select">TOUTES LES TRANSACTIONS</a>|
                        <a href="transactions.php?bid=<?php echo $post['MemberInfo']['id']?>&action=select&type=1">TOUS LES DÉPÔTS</a>|
                        <a href="transactions.php?bid=<?php echo $post['MemberInfo']['id']?>&action=select&type=2">TOUS LES RETRAITS</a>
                    </td>
                </tr>
                <tr>
                    <td class=capc colspan=2>
                        <a href="transactions.php?bid=<?php echo $post['MemberInfo']['id']?>&action=select&type=1&status=0">DÉPÔTS EN ATTENTE</a>|
                        <a href="transactions.php?bid=<?php echo $post['MemberInfo']['id']?>&action=select&type=2&status=0">RETRAITS EN ATTENTE</a>
                    </td>
                </tr>
            </tbody>
            </table>
        <br class="clear" />
        </div>
         <div id="tab02" class="content">
                <table class="common_table_detail">
                    <thead>
                        <tr>
                            <th class="data_col" colspan="2">INFORMATIONS ADDRESS</a></th>
                        </tr>
                    </thead>
                <tbody>
                    <tr>
                        <td class="left" nowrap >Address</td>
                        <td><?php echo $post['MemberInfo']['address']?></td>
                    </tr>
                    <tr>
                        <td class="left" nowrap>Commune</td>
                        <td><?php echo $post['MemberInfo']['city']?></td>
                    </tr>
                    <tr>
                        <td class="left" nowrap >Code postal</td>
                        <td><?php echo $post['MemberInfo']['postcode']?></td>
                    </tr>
                    <tr>
                        <td class="left" nowrap >Wilaya</td>
                        <td><?php echo $data['Wilayas'][$post['MemberInfo']['wilaya']]?></td>
                    </tr>
                </tbody>
            </table>
            <br class="clear" />
        </div>
        <div id="tab03" class="content">
            <table class="common_table_detail">
                    <thead>
                        <tr>
                            <th class="data_col" colspan="2">INFORMATIONS BANCAIRES</a></th>
                        </tr>
                    </thead>
                <tbody>
                    <?if($post['BanksInfo']){?>
                    <?foreach($post['BanksInfo'] as $key=>$val){?>
                        <tr>
                            <td class="left" nowrap>Nom de la banque</td>
                            <td nowrap><?php echo $val['bname']?></td>
                        </tr>
                        <tr>
                            <td class="left" nowrap>Address de la banque</td>
                            <td nowrap><?php echo $val['baddress']?></td>
                        </tr>
                        <tr>
                            <td class="left" nowrap>Commune de la banque</td>
                            <td nowrap><?php echo $val['bcity']?></td>
                        </tr>
                        <tr>
                            <td class="left" nowrap>Code postal de la banque</td>
                            <td nowrap><?php echo $val['bzip']?></td>
                        </tr>
                        <tr>
                            <td class=field nowrap>T&egrave;l&egrave;phone de la banque</td>
                            <td class=input nowrap><?php echo $val['bphone']?></td>
                        </tr>
                        <tr>
                            <td class=field nowrap>Account Holder's Name:</td>
                            <td class=input nowrap><?php echo $val['bnameacc']?></td>
                        </tr>
                        <tr>
                            <td class=field nowrap>Account Number:</td>
                            <td class=input nowrap><?php echo $val['baccount']?></td>
                        </tr>
                        <tr>
                            <td class=field nowrap>Account Type:</td>
                            <td class=input nowrap><?php echo $data['BankAccountType'][$val['btype']]?></td>
                        </tr>
                        <tr>
                            <td class=field nowrap>9 Digits Routing Number:</td>
                            <td class=input nowrap><?php echo $val['brtgnum']?></td>
                        </tr>
                        <tr>
                            <td class=field nowrap>S.W.I.F.T. Code:</td>
                            <td class=input nowrap><?php echo $val['bswift']?></td>
                        </tr>
                        <tr>
                            <td class=capc colspan=2>
                                <a href="members.php?id=<?php echo $post['MemberInfo']['id']?>&action=insert_bank&type=<?php echo $post['type']?>&page=<?php echo $post['StartPage']?>">AJOUTER</a>|
                                <a href="members.php?id=<?php echo $post['MemberInfo']['id']?>&bid=<?php echo $val['id']?>&action=update_bank&type=<?php echo $post['type']?>&page=<?php echo $post['StartPage']?>">MODIFIER</a>|
                                <a href="members.htm?id=<?php echo $post['MemberInfo']['id']?>&bid=<?php echo $val['id']?>&action=delete_bank&type=<?php echo $post['type']?>&page=<?php echo $post['StartPage']?>" onclick="return cfmform()">EFFACER</a></td></tr>
                    <?}?>
                    <?}else{?>
                    <tr>
                        <td class=error align=center colspan=2>INFORMATION BANCAIRES VIDE</td>
                    </tr>
                    <?}?>
                </tbody>
            </table>    
            <br class="clear" />
        </div>
        <? if ( $post['MemberInfo']['type'] == 1 ) { ?>
            <div id="tab04" class="content">
            <table class="common_table_detail">
                    <thead>
                        <tr>
                            <th class="data_col" colspan="2">INFORMATIONS ENTREPRISE</a></th>
                        </tr>
                    </thead>
                <tbody>
                                            <tr>
                                                <td class="left" nowrap >Nom de soci&eacute;t&eacute;</td>
                                                <td><?php echo $post['MemberInfo']['company']?></td>
                                            </tr>
                                            <tr>
                                                <td class="left" nowrap >N&deg; RC </td>
                                                <td><?php echo $post['MemberInfo']['nrc']?></td>
                                            </tr>
                                            <tr>
                                                <td class="left" nowrap >N&deg; NIF</td>
                                                <td><?php echo $post['MemberInfo']['nnif']?></td>
                                            </tr>
                                            <tr>
                                                <td class="left" nowrap  >N&deg; ART</td>
                                                <td><?php echo $post['MemberInfo']['nart']?></td>
                                            </tr>
                                            <tr>
                                                <td class="left" nowrap  >N&deg; FIS</td>
                                                <td><?php echo $post['MemberInfo']['nfis']?></td>
                                            </tr>
                                            <?php if ($post['MemberInfo']['logo']) {?>
                                                <tr>
                                                    <td  class="left" nowrap valign="top">Logo</td>
                                                    <td valign="top"><img src="<?php echo $post['MemberInfo']['logo']?>" /></td>
                                                </tr>
                                            <?php }//if ($image) {?>
                                    </tbody>
            </table>    
            <br class="clear" />
            </div>
        <?php } ?>
        <br class="clear" /> 
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
<!-- ############# wrapper end ############# -->

<?}elseif($post['action']=='insert'||$post['action']=='update'){?>
<?if(!$post['PostSent']){?>
<form method=post><input type=hidden name=action value="<?php echo $post['action']?>"><input type=hidden name=gid value="<?php echo $post['id']?>"><input type=hidden name=type value="<?php echo $post['type']?>"><input type=hidden name=StartPage value="<?php echo $post['StartPage']?>"><table class=frame width=480 border=0 cellspacing=1 cellpadding=2><tr><td class=capl colspan=2><?if($post['action']=='insert'){?>CREATE NEW MEMBER<?}else{?>MODIFY MEMBER INFORMATION<?}?></td></tr><?if($data['Error']){?><tr><td colspan=2 class=error><?php echo $data['Error']?></td></tr><?}?><tr><td class=field nowrap>Sponsor:</td><td class=input nowrap><select name=sponsor><?php echo showselect($data['Sponsors'], $post['sponsor'])?></select></td></tr><tr><td class=field nowrap>Username (*):</td><td class=input nowrap><input type=text name=username size=40 value="<?php echo $post['username']?>"></td></tr><tr><td class=field nowrap>Password (*):</td><td class=input nowrap><input type=text name=password size=40 value="<?php echo $post['password']?>"></td></tr><?if($post['action']=='insert'){?><tr><td class=field nowrap>Email address (*):</td><td class=input nowrap><input type=text name=email size=40 value="<?php echo $post['email']?>"></td></tr><?}?><tr><td class=field nowrap>First Name (*):</td><td class=input nowrap><input type=text name=fname size=40 value="<?php echo $post['fname']?>"></td></tr><tr><td class=field nowrap>Last Name (*):</td><td class=input nowrap><input type=text name=lname size=40 value="<?php echo $post['lname']?>"></td></tr><tr><td class=field nowrap>Company:</td><td class=input nowrap><input type=text name=company size=40 value="<?php echo $post['company']?>"></td></tr><tr><td class=field nowrap>Company Registration Number:</td><td class=input nowrap><input type=text name=regnum size=40 value="<?php echo $post['regnum']?>"></td></tr><tr><td class=field nowrap>Drivers License No:</td><td class=input nowrap><input type=text name=drvnum size=40 value="<?php echo $post['drvnum']?>"></td></tr><tr><td class=field nowrap>Address (*):</td><td class=input nowrap><input type=text name=address size=40 value="<?php echo $post['address']?>"></td></tr><tr><td class=field nowrap>City (*):</td><td class=input nowrap><input type=text name=city size=40 value="<?php echo $post['city']?>"></td></tr><tr><td class=field nowrap>Country (*):</td><td class=input nowrap><select name=country><?php echo showselect($data['Countries'], $post['country'])?></select></td></tr><tr><td class=field nowrap>State:</td><td class=input nowrap><input type=text name=state size=20 value="<?php echo $post['state']?>"></td></tr><tr><td class=field nowrap>Postal Code (*):</td><td class=input nowrap><input type=text name=zip size=20 value="<?php echo $post['zip']?>"></td></tr><tr><td class=field nowrap>Phone (*):</td><td class=input nowrap><input type=text name=phone size=30 value="<?php echo $post['phone']?>"></td></tr><tr><td class=field nowrap>Fax:</td><td class=input nowrap><input type=text name=fax size=30 value="<?php echo $post['fax']?>"></td></tr><tr><td class=capl colspan=2>DESCRIPTION</td></tr><tr><td class=input colspan=2><textarea cols=75 rows=10 name=description><?php echo $post['description']?></textarea></td></tr><tr><td class=capc colspan=2>

<input class=submit type=submit name=cancel value="BACK">&nbsp;
<input class=submit type=submit name=send value="SAVE CHANGES">

</td></tr></table></form>
<?}else{?>
All changes was stored in the database.<?if($post['action']=='insert'){?><br><br>Just created member has SUSPENDED status therefore you should change member status manually.<?}?><br><br><hr><br><a href="members.htm?id=<?php echo $post['id']?>&action=update&type=<?php echo $post['type']?>&page=<?php echo $post['StartPage']?>">BACK</a> | <a href="index.htm">HOME</a>
<?}?>
<?}elseif($post['action']=='insert_card'||$post['action']=='update_card'){?>
<?if(!$post['PostSent']){?>
<form method=post><input type=hidden name=action value="<?php echo $post['action']?>"><input type=hidden name=gid value="<?php echo $post['gid']?>"><input type=hidden name=bid value="<?php echo $post['bid']?>"><input type=hidden name=type value="<?php echo $post['type']?>"><input type=hidden name=StartPage value="<?php echo $post['StartPage']?>"><table class=frame width=480 border=0 cellspacing=1 cellpadding=2><tr><td class=capl colspan=2><?if($post['action']=='insert'){?>CREATE NEW CARD FOR MEMBER<?}else{?>MODIFY MEMBER CARD<?}?></td></tr><?if($data['Error']){?><tr><td colspan=2 class=error><?php echo $data['Error']?></td></tr><?}?><tr><td class=field nowrap>Card Type:</td><td class=input nowrap><select name=ctype><?php echo showselect($data['CreditCardType'], $post['ctype'])?></select></td></tr><tr><td class=field nowrap>Name Of Card:</td><td class=input nowrap><input type=text name=cname size=40 value="<?php echo $post['cname']?>"></td></tr><tr><td class=field nowrap>Card Number:</td><td class=input nowrap><input type=text name=cnumber size=40 value="<?php echo $post['cnumber']?>"></td></tr><tr><td class=field nowrap>AVS or CVV Code:</td><td class=input nowrap><input type=text name=ccvv size=10 value="<?php echo $post['ccvv']?>"></td></tr><tr><td class=field nowrap>Expire Date MM/YYYY:</td><td class=input nowrap><select name=cmonth><?php echo showselect($data['Months'], $post['cmonth'])?></select> / <select name=cyear><?php echo showselect($data['Years'], $post['cyear'])?></select></td></tr><tr><td class=capc colspan=2><input class=submit type=submit name=cancel value="BACK">&nbsp;<input class=submit type=submit name=send value="SAVE CHANGES"></td></tr></table></form>
<?}else{?>
All changes was stored in the database.<br><br><hr><br><a href="members.htm?id=<?php echo $post['gid']?>&bid=<?php echo $post['bid']?>&action=update_card&type=<?php echo $post['type']?>&page=<?php echo $post['StartPage']?>">BACK</a> | <a href="members.htm?id=<?php echo $post['gid']?>&action=detail&type=<?php echo $post['type']?>&page=<?php echo $post['StartPage']?>">DETAIL</a>
<?}?>
<?}elseif($post['action']=='insert_bank'||$post['action']=='update_bank'){?>
<?if(!$post['PostSent']){?>
<form method=post><input type=hidden name=action value="<?php echo $post['action']?>"><input type=hidden name=gid value="<?php echo $post['gid']?>"><input type=hidden name=bid value="<?php echo $post['bid']?>"><input type=hidden name=type value="<?php echo $post['type']?>"><input type=hidden name=StartPage value="<?php echo $post['StartPage']?>"><table class=frame width=480 border=0 cellspacing=1 cellpadding=2><tr><td class=capl colspan=2><?if($post['action']=='insert'){?>CREATE NEW BANK FOR MEMBER<?}else{?>MODIFY MEMBER BANK INFORMATION<?}?></td></tr><?if($data['Error']){?><tr><td colspan=2 class=error><?php echo $data['Error']?></td></tr><?}?><tr><td class=field nowrap>Bank Name:</td><td class=input nowrap><input type=text name=bname size=40 value="<?php echo $post['bname']?>"></td></tr><tr><td class=field nowrap>Bank Address:</td><td class=input nowrap><input type=text name=baddress size=40 value="<?php echo $post['baddress']?>"></td></tr><tr><td class=field nowrap>Bank City:</td><td class=input nowrap><input type=text name=bcity size=40 value="<?php echo $post['bcity']?>"></td></tr><tr><td class=field nowrap>Bank ZIP Code:</td><td class=input nowrap><input type=text name=bzip size=20 value="<?php echo $post['bzip']?>"></td></tr><tr><td class=field nowrap>Bank Country:</td><td class=input nowrap><select name=bcountry><?php echo showselect($data['Countries'], $post['bcountry'])?></select></td></tr><tr><td class=field nowrap>Bank State:</td><td class=input nowrap><input type=text name=bstate size=20 value="<?php echo $post['bstate']?>"></td></tr><tr><td class=field nowrap>Bank Phone:</td><td class=input nowrap><input type=text name=bphone size=30 value="<?php echo $post['bphone']?>"></td></tr><tr><td class=field nowrap>Account Holder's Name:</td><td class=input nowrap><input type=text name=bnameacc size=40 value="<?php echo $post['bnameacc']?>"></td></tr><tr><td class=field nowrap>Account Number:</td><td class=input nowrap><input type=text name=baccount size=40 value="<?php echo $post['baccount']?>"></td></tr><tr><td class=field nowrap>Account Type:</td><td class=input nowrap><select name=btype><?php echo showselect($data['BankAccountType'], $post['btype'])?></select></td></tr><tr><td class=field nowrap>9 Digits Routing Number:</td><td class=input nowrap><input type=text name=brtgnum size=20 value="<?php echo $post['brtgnum']?>"></td></tr><tr><td class=field nowrap>S.W.I.F.T. Code:</td><td class=input nowrap><input type=text name=bswift size=20 value="<?php echo $post['bswift']?>"</td></tr><tr><td class=capc colspan=2><input class=submit type=submit name=cancel value="BACK">&nbsp;<input class=submit type=submit name=send value="SAVE CHANGES"></td></tr></table></form>
<?}else{?>
All changes was stored in the database.<br><br><hr><br><a href="members.htm?id=<?php echo $post['gid']?>&bid=<?php echo $post['bid']?>&action=update_bank&type=<?php echo $post['type']?>&page=<?php echo $post['StartPage']?>">BACK</a> | <a href="members.htm?id=<?php echo $post['gid']?>&action=detail&type=<?php echo $post['type']?>&page=<?php echo $post['StartPage']?>">DETAIL</a>
<?}?>
<?}?>
</center>
<?}else{?>SECURITY ALERT: Access Denied<?}?>
