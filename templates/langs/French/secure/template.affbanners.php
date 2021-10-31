
<section id="container"><div class="inner_copy"><div class="inner_copy"></a></div></div>
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
<?if(isset($data['ScriptLoaded'])){?><center>Your affiliate link is:<br><a href="<?php echo $data['Host']?>?rid=<?php echo $post['username']?>"><?php echo $data['Host']?>?rid=<?php echo $post['username']?></a><br>Right-Click and Copy Shortcut to copy the link<br><br><b>COPY & PASTE AFFILIATE CODE:</b><br><br>Just select and copy the code in the boxes below and paste it into your html pages.<br><br><table class=frame width=100% border=0 cellspacing=1 cellpadding=2><?$idx=1;foreach($post['Banners'] as $value){$bgcolor=$idx%2?'#EEEEEE':'#E7E7E7'?><tr bgcolor=<?php echo $bgcolor?> onmouseover="setPointer(this, <?php echo $idx?>, 'over', '<?php echo $bgcolor?>', '#CCFFCC', '#FFCC99')" onmouseout="setPointer(this, <?php echo $idx?>, 'out', '<?php echo $bgcolor?>', '#CCFFCC', '#FFCC99')" onmousedown="setPointer(this, <?php echo $idx?>, 'click', '<?php echo $bgcolor?>', '#CCFFCC', '#FFCC99')"><td align=center><a href="<?php echo $data['Host']?>/?rid=<?php echo $post['username']?>"><img src="<?php echo $data['Banners']?>/<?php echo $value?>" width=468 height=60 border=0></a><br>Copy the text below and paste in your HTML code:<br><table class=frame width=468 border=0 cellspacing=1 cellpadding=2><tr><td class=courier>&lt;a href="<?php echo $data['Host']?>/?rid=<?php echo $post['username']?>"&gt;&lt;img src="<?php echo $data['Banners']?>/<?php echo $value?>" width=468 height=60 border=0>&lt;/a&gt;</td></tr></table><br></td></tr><?$idx++;}?></table></center><?}else{?>SECURITY ALERT: Access Denied<?}?>
</article>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>