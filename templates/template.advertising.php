<section id="content"><div class="inner_copy"><div class="inner_copy"></a></div></div>
        <div class="container">
            <div class="inside">
                <div id="slogan">
                    <div class="inside">
                        <h2><span>SOLDE:</span> <?php echo balance($data['Balance'])?> </span></h2>
                        <p></p>
                    </div>
                </div>
                
                <div class="inside1">
                    <div class="wrap row-2">
                        <article class="col-1">
                          <?showmenu('add')?>
                        </article>
                        <article class="col-2">
<?if(isset($data['ScriptLoaded'])){?><form method=post name=data><input type=hidden name=step value="<?php echo $post['step']?>"><?if($post['step']==1){?>
<table class=frame width=100% align=center border=0 cellspacing=1 cellpadding=2>
 <tr><td class=capl colspan=6>BANNERS</td></tr>
 <tr><td class=capc>PATH</td>
 <td class=capc width=1%>STATUS</td>
 <td class=capc width=1%>VIEWS</td>
 <td class=capc width=1%>CLICKS</td>
 <td class=capc width=1%>ACTION</td>
</tr>
<?$idx=0;foreach($data['Banners'] as $value){$bgcolor=$idx%2?'#EEEEEE':'#E7E7E7'?><tr bgcolor=<?php echo $bgcolor?> onmouseover="setPointer(this, <?php echo $idx?>, 'over', '<?php echo $bgcolor?>', '#CCFFCC', '#FFCC99')" onmouseout="setPointer(this, <?php echo $idx?>, 'out', '<?php echo $bgcolor?>', '#CCFFCC', '#FFCC99')" onmousedown="setPointer(this, <?php echo $idx?>, 'click', '<?php echo $bgcolor?>', '#CCFFCC', '#FFCC99')"><td><a href="<?php echo $value['lurl']?>" target=_blank><?php echo prnintg($value['lurl'])?></a></td><td align=center><?php echo ($value['active'])? 'ACTIVE':'VERIFYING'?></td><td align=center><?php echo $value['views']?></td><td align=center><?php echo prnintg($value['clicks'])?></td><td align=center nowrap><a href="advertising.htm?id=<?php echo $value['id']?>&action=delete" onclick="return cfmform()">DELETE</a></td></tr><?$idx++;}?>
<tr><td class=capc align=center colspan=5><input type=submit class=submit name=send value="PAY FOR NEW BANNER PLACE NOW!"></td>
</table>
<?}elseif($post['step']==2){?>
<?if($post['gid']){?><input type=hidden name=gid value="<?php echo $post['gid']?>"><?}?><table class=frame width=100% align=center border=0 cellspacing=1 cellpadding=4><tr><td class=capl colspan=2>NEW BANNER INFORMATION</td></tr><?if($data['Error']){?><tr><td colspan=2 class=error><?php echo prntext($data['Error'])?></td></tr><?}?>
<tr><td class=field nowrap>URL to your banner (*):</td><td class=input width=1%><input type=text name=banner size=51 maxlength=255 value="<?php echo prntext($post['banner'])?>"></td></tr>
<tr><td class=field nowrap>URL for banner site (*):</td><td class=input width=1%><input type=text name=url size=51 maxlength=255 value="<?php echo prntext($post['url'])?>"></td></tr>
<tr><td class=field nowrap>Package (*):</td><td class=input width=1%><select name=package style='width:100%'><?php echo showselect($data['AdvVisiblePacks'], $post['package'])?></select></td></tr>
<tr><td class=field nowrap>Period (*):</td><td class=input width=1%><select name=period style='width:100%'><?php echo showselect($data['AdvPeriods'], $post['period'])?></select></td></tr>
<tr><td class=capc colspan=2><input class=submit type=submit name=cancel value="BACK">&nbsp;<input type=submit class=submit name=send value="CONTINUE"></td></tr></table>
<?}elseif($post['step']==3){?>
<input type=hidden name=banner value="<?php echo prntext($post['banner'])?>"><input type=hidden name=url value="<?php echo prntext($post['url'])?>"><input type=hidden name=package value="<?php echo prntext($post['package'])?>"><input type=hidden name=period value="<?php echo prntext($post['period'])?>">
<table class=frame width=100% align=center border=0 cellspacing=1 cellpadding=4><tr><td class=capl colspan=2>TRANSACTION DETAILS</td></tr>
<tr><td class=input><br><pre class=info>
   · Amount         : <?php echo prnpays($post['amount'])."\n"?>
   · Processing Fee : <?php echo prnpays(-$post['fees'])."\n"?>
   · Banner         : <?php echo prntext($post['banner']?substr($post['banner'], 0, 48)."...":'N/A')."\n"?>
   · URL            : <?php echo prntext($post['url']?$post['url']:'N/A')."\n"?>
   · Packet         : <?php echo prntext($post['package_name']?$post['package_name']:'N/A')."\n"?>
   · Period         : <?php echo prntext($post['period_name']?$post['period_name']:0)."\n"?>

   · Total Sum      : <?php echo prnpays($post['total'])."\n"?>
</pre></td></tr>
<tr><td class=capc colspan=2><input class=submit type=submit name=cancel value="BACK">&nbsp;<input type=submit class=submit name=send value="CONTINUE"></td></tr></table>
<?}elseif($post['step']==4){?>
<table class=frame width=100% border=0 cellspacing=1 cellpadding=2><tr><td class=input align=center>Thank you very much for using our service. Your banner will be shown at nearest time.</td></tr></table><br><table class=frame width=100% border=0 cellspacing=1 cellpadding=2><tr><td class=capc><a href="<?php echo $data['Members']?>/advertising.htm">BUY PLACE FOR NEW BANNER</a>&nbsp;|&nbsp;<a href="index.htm">ACCOUNT OVERVIEW</a></td></tr></table>
<?}?>
</form>
<?}else{?>SECURITY ALERT: Access Denied<?}?>

    </article>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>