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
                          <?showmenu('aff')?>
                        </article>
                        <article class="col-2">
<?if(isset($data['ScriptLoaded'])){?><center><?if($data['Pages']){?><table class=frame width=100% border=0 cellspacing=1 cellpadding=4><tr><td class=capc><?$count=count($data['Pages']);for($i=0; $i<$count; $i++){?><?if($data['Pages'][$i]==$post['StartPage']){?><?php echo $i+1?><?}else{?><a href="affdownline.htm?page=<?php echo $data['Pages'][$i]?>"><?php echo $i+1?></a><?}?><?if($i<$count-1)echo(" | ");}?></td></tr></table><br><?}?><table class=frame width=100% border=0 cellspacing=1 cellpadding=2><tr><td class=capl colspan=8>YOUR DIRECT REFERRALS (LEVEL 1)</td></tr><tr><td class=capc>SIGNUP DATE</td><td class=capc>USERNAME</td><td class=capc>FIRST/LAST NAME</td><td class=capc>REFERRALS</td><td class=capc>PAYMENTS</td><td class=capc>EARNED</td></tr><?$idx=1;foreach($post['Referrals'] as $value){$bgcolor=$idx%2?'#EEEEEE':'#E7E7E7'?><tr bgcolor=<?php echo $bgcolor?> onmouseover="setPointer(this,<?php echo $idx?>,'over','<?php echo $bgcolor?>','#CCFFCC','#FFCC99')" onmouseout="setPointer(this,<?php echo $idx?>,'out','<?php echo $bgcolor?>','#CCFFCC','#FFCC99')" onmousedown="setPointer(this,<?php echo $idx?>,'click','<?php echo $bgcolor?>','#CCFFCC','#FFCC99')"><td align=center valign=top><?php echo prndate($value['cdate'])?></td><td align=right valign=top><a href="userinfo.htm?id=<?php echo $value['id']?>&bp=<?php echo $data['PageFile']?><?if(isset($post['StartPage'])){?>&page=<?php echo $post['StartPage']?><?}?>"><?php echo prntext($value['username'])?></a></td><td align=right valign=top><?php echo prntext($value['fname'])?> <?php echo prntext($value['lname'])?></td><td align=right valign=top><?php echo prnintg($value['referrals'])?></td><td align=right valign=top><?php echo prnsumm($value['payments'])?></td><td align=right valign=top><?php echo prnsumm($value['earned'])?></td></tr><?$idx++;}?></table><br><table class=frame width=100% border=0 cellspacing=1 cellpadding=2><?if($data['Pages']){?><tr><td class=capc><?$count=count($data['Pages']);for($i=0; $i<$count; $i++){?><?if($data['Pages'][$i]==$post['StartPage']){?><?php echo $i+1?><?}else{?><a href="affdownline.htm?page=<?php echo $data['Pages'][$i]?>"><?php echo $i+1?></a><?}?><?if($i<$count-1)echo(" | ");}?></td></tr><?}?><tr><td class=capc colspan=8><a href="affdownline.htm<?if($post['StartPage']){?>?page=<?php echo $post['StartPage']?><?}?>">REFRESH</a></td></tr></table></center><?}else{?>SECURITY ALERT: Access Denied<?}?>
</article>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>