<!-- Start content  -->
<div class="content">
<br />
<?if(isset($data['ScriptLoaded']) && (1==0) ){?><?if(!$data['PostSent']){?><form method=post><center><table class=frame width=475 border=0 cellspacing=1 cellpadding=4><tr><td class=capl colspan=2>SEND REQUEST FOR PAYMENT TO ANYBODY</td></tr><?if($data['Error']){?><tr><td colspan=2 class=error><?php echo prntext($data['Error'])?></td></tr><?}?><tr><td class=field width=200 nowrap>Receiver Full Name (*):</td><td class=input width=275><input type=text name=rname size=41 maxlength=32 value="<?php echo prntext($post['rname'])?>"></td></tr><tr><td class=field width=200 nowrap>Receiver E-Mail Address (*):</td><td class=input width=275><input type=text name=remail size=41 maxlength=32 value="<?php echo prntext($post['remail'])?>"><br><font class=remark>Please use ONLY valid e-mail address.</font></td></tr><tr><td class=field width=200 nowrap>Amount to request, <?php echo prntext($data['Currency'])?> (*):</td><td class=input width=275><input type=text name=amount size=10 maxlength=16 value="<?php echo prnsumm($post['amount'])?>"><br><font class=remark>Minimum amount you can transfer is <?php echo prntext($data['Currency'])?><?php echo prnsumm($data['PaymentMinSum'])?>.</font></td></tr><tr><td class=field nowrap>Description (optional):</td><td class=input><textarea name=comments cols=39 rows=10><?php echo prntext($post['comments'])?></textarea></td></tr><tr><td class=capc colspan=2><input type=submit class=submit name=send value="SEND NOW!"></td></tr></table></center></form><?}else{?><table class=frame width=100% border=0 cellspacing=1 cellpadding=2><tr><td class=input>Your request with payment URL was sent to <?php echo prntext($post['rname'])?> (<?php echo prntext($post['remail'])?>).<br><br>You should get notification by e-mail about this transaction.<br><br>And you should get notification by e-mail when payment will be completed.</td></tr></table><br><table class=frame width=100% border=0 cellspacing=1 cellpadding=2><tr><td class=capc><a href="<?php echo $data['Members']?>/request.htm">SEND NEW REQUEST</a>&nbsp;|&nbsp;<a href="index.htm">ACCOUNT OVERVIEW</a></td></tr></table><?}?>
<?}else{?>
<center>
                 <br>
                            <div class="ui-widget">
                            <div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
                                <p><span class="ui-icon ui-icon-alert" style="float: centre; margin-right: .3em;"></span> 
                                    Ce service sera bient&ocirc;t disponible
                                </p>
                            </div>
                            </div>
</center>
<?}?>
</div>

<!-- End content  -->