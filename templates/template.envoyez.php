<!-- Start content  -->
<div class="content">
<br />
<?if(isset($data['ScriptLoaded']) && (1==0)){?>dfdsfs
<?if(!$data['PostSent']){?><form method=post><center><table class=frame width=475 border=0 cellspacing=1 cellpadding=4><tr><td class=capl colspan=2>SEND MONEY (YOUR CURRENT BALANCE IS: <?php echo prntext($data['Currency'])?><?php echo prnsumm($data['Balance'])?>)</td></tr><?if($data['Error']){?><tr><td colspan=2 class=error><?php echo prntext($data['Error'])?></td></tr><?}?><tr><td class=field width=200 nowrap>Send money To:</td><td class=input width=275><input type=text name=receiver size=41 maxlength=32 value="<?php echo prntext($post['receiver'])?>"><br><font class=remark>Please use username or e-mail.</font></td></tr><tr><td class=field width=200 nowrap>Amount to transfer, <?php echo prntext($data['Currency'])?>:</td><td class=input width=275><input type=text name=amount size=10 maxlength=16 value="<?php echo prnsumm($post['amount'])?>"><br><font class=remark>Minimum amount you can transfer is <?php echo prntext($data['Currency'])?><?php echo prnsumm($data['PaymentMinSum'])?>.</font></td></tr><tr><td class=field nowrap>Description (optional):</td><td class=input><textarea name=comments cols=39 rows=10><?php echo prntext($post['comments'])?></textarea></td></tr><tr><td class=capc colspan=2><input type=submit class=submit name=send value="SEND NOW!"></td></tr></table><br><table class=frame width=475 border=0 cellspacing=1 cellpadding=2><tr><td class=capc>IF YOU WANT TO MAKE A MASS PAYMENTS PLEASE USE OUR<br><a href="<?php echo $data['Members']?>/mass.htm">MASS PAYMENTS OPTION</a></td></tr></table></center></form><?}else{?><table class=frame width=100% border=0 cellspacing=1 cellpadding=2><tr><td class=input><?php echo prntext($data['Currency'])?><?php echo prnsumm($post['amount'])?> was sent to member "<?php echo prntext($post['receiver'])?>".<br><br>You should get notification e-mail about this transaction.</td></tr></table><br><table class=frame width=100% border=0 cellspacing=1 cellpadding=2><tr><td class=capc><a href="<?php echo $data['Members']?>/send.htm">SEND MONEY TO OTHER MEMBER</a>&nbsp;|&nbsp;<a href="index.htm">ACCOUNT OVERVIEW</a></td></tr></table><?}?><?
}else{?>
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