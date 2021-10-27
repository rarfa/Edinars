<?if(isset($data['ScriptLoaded'])){?>
			   
<!-- ############# admin_box start ############# -->
<div class="admin_box">
    
    
    <!-- ############# admin_box_header start ############# -->
    <div class="admin_box_header">
    	<div class="box_header_left">
			<div class="header_tabs"><!-- add tabs in this div -->
				<a href="#tab01" class="default_tab current" onClick="jQuery('#topup-form').validationEngine('hide')" ><span class="tab">LES CARTES DE RECHARGE</span><span class="tab_right"></span></a>
				<a href="#tab02"><span class="tab">CREATION DES CARTES DE RECHARGE</span><span class="tab_right"></span></a>
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
						<th class="data_col">REFERENCE</th>
						<th class="short_col">WILAYA</th>
						<th class="short_col">DATE CREATION</th>
						<th class="short_col">MONTANT</th>
						<th class="short_col">TOTAL</th>
						<th class="short_col">UTULISER</th>
						<th class="short_col">NO UTULISER</th>
						<th class="short_col">ACTION</th>
					</tr>
				</thead>
				<tbody>
				<?foreach($data['MembersList'] as $key=>$value){$bgcolor=$key%2?'#EEEEEE':'#E7E7E7'?>
					<tr bgcolor=<?=$bgcolor?> onmouseover="setPointer(this,<?=$key?>,'over','<?=$bgcolor?>','#CCFFCC','#FFCC99')" onmouseout="setPointer(this,<?=$key?>,'out','<?=$bgcolor?>','#CCFFCC','#FFCC99')" onmousedown="setPointer(this,<?=$key?>,'click','<?=$bgcolor?>','#CCFFCC','#FFCC99')">
					<td>
						<a href="members.php?id=<?=$value['id']?>&action=detail&type=<?=$post['type']?>&page=<?=$post['StartPage']?>"><?=$value['username']?></a>
						</td>
						<td nowrap><?=$value['fname']?> <?=$value['lname']?><?if($post['type']=='online'){?> (<?=$value['last_ip']?>)<?}?></td>
						<td><?=$value['email']?></td>
						<td><?=$data['MemberType'][$value['type']]?></td>
						<td><a href="members.php?id=<?=$value['sponsor']?>&action=detail&type=<?=$post['type']?>&page=<?=$post['StartPage']?>"><?=$value['sname']?></a></td>
						<td><a href="transactions.php?bid=<?=$value['id']?>&action=select"><?=$value['transactions']?></a></td>
						<td nowrap>
						<?if($post['type']=='online'){?>---<?}else{?><a href="members.php?id=<?=$value['id']?>&action=detail&type=<?=$post['type']?>&page=<?=$post['StartPage']?>">VOIR</a>|
						<?if($post['type']=='active'){?>
								<a href="members.php?id=<?=$value['id']?>&action=suspend&type=<?=$post['type']?>&page=<?=$post['StartPage']?>" onclick="return cfmform()">SUSPENDRE</a>|
								<a href="members.php?id=<?=$value['id']?>&action=close&type=<?=$post['type']?>&page=<?=$post['StartPage']?>" onclick="return cfmform()">FERME</a>
						<?}else{?>
								<a href="members.php?id=<?=$value['id']?>&action=activate&type=<?=$post['type']?>&page=<?=$post['StartPage']?>" onclick="return cfmform()">ACTIVATE</a>
						<?}?>
							<?if($value['candelete']){?>|
							<a href="members.php?id=<?=$value['id']?>&action=delete&type=<?=$post['type']?>&page=<?=$post['StartPage']?>" onclick="return cfmform()">EFFACER</a>
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
									<span class="current"><?=$i+1?></span>
								<?}else{?>
									<a href="members.php?action=<?=$post['action']?>&type=<?=$post['type']?>&page=<?=$data['Pages'][$i]?>" title="Page <?=$i+1?>"><?=$i+1?></a>
								<?}?>
							<?}?>
					</div>			
				<?}?>
            </div>
            <br class="clear" />
        </div>
		<div id="tab02" class="content">
		<?if(!$post['PostSent']){?>
			<form method="post"  id="topup-form" > 
				<input type="hidden" name="step" value="<?=$post['step']?>">
						<?if($data['Error']){?>
								<?=prntext($data['Error'])?>.</p>
					    <br>
					    <?}?>
					<table class="common_table_detail">
						<thead>
							<tr>
								<th class="data_col" colspan="2">CR&Egrave;ER DES CARTES DE RECHARGE</a></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="left">Wilaya</td>
								<td><select name="wilaya" id="wilaya" class="validate[required]"><?=showselect($data['Wilayas'], $post['wilaya'])?></select></td>
							</tr>
							<tr>
								<td class="left">Quantit&egrave;</td>
								<td>
								    <input class="validate[required,custom[integer],max[500]] text-input" type="text" name="qty" id="qty" maxlength="5" value="<?=prntext($post['qty'])?>" >
								</td>
							</tr>
							<tr>
								<td class="left">Montant</td>
								<td><input type=text name="montant"  class="validate[required,custom[integer],max[1000]] text-input" id="montant"size=2 maxlength=16 value="<?=prntext($post['montant'])?>"  ></td>
							</tr>
							<tr>
								<td colspan="2" align = "right"><input class="submit" type="submit" name="send" value="CR&Egrave;ER"></td>
							</tr>	
							
						</tbody>
					</table>
				
			</form>
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

		
	<?}else{?>
<?if($post['dtype']=='pincode'){?>
sss
<?}elseif($post['dtype']=='paypal'){?>
<form method=post action="https://www.paypal.com/cgi-bin/webscr">
<input type=hidden name=cmd value="_xclick">
<input type=hidden name=business value="<?=$data['DepositMethod'][$post['dtype']]['user']?>">
<input type=hidden name=item_name value="Add funds to my <?=$data['SiteName']?> account">
<input type=hidden name=no_shipping value="1">
<input type=hidden name=return value="<?=$data['Members']?>/notify.htm">
<input type=hidden name=no_note value="1">
<input type=hidden name=amount value="<?=prnsum($post['total'])?>">
<?}elseif($post['dtype']=='egold'){?>
<form method=post action="https://www.e-gold.com/sci_asp/payments.asp">
<input type=hidden name=PAYEE_ACCOUNT value="<?=$data['DepositMethod'][$post['dtype']]['user']?>">
<input type=hidden name=PAYEE_NAME value="<?=$data['SiteName']?>">
<input type=hidden name=PAYMENT_UNITS value="1">
<input type=hidden name=PAYMENT_METAL_ID value="1">
<input type=hidden name=PAYMENT_AMOUNT value="<?=prnsum($post['total'])?>">
<input type=hidden name=NOPAYMENT_URL value="<?=$data['Members']?>/deposit.htm">
<input type=hidden name=NOPAYMENT_URL_METHOD value="LINK">
<input type=hidden name=PAYMENT_URL value="<?=$data['Members']?>/notify.htm">
<input type=hidden name=PAYMENT_URL_METHOD value="POST">
<input type=hidden name=MEMO value="Add funds to my <?=$data['SiteName']?> account">
<input type=hidden name=HASH value="<?=md5("abdo".time().$data['sid'])?>">
<input type=hidden name=CHECKSUM value="<?=time()?>">
<input type=hidden name=BAGGAGE_FIELDS value="">
<?}elseif($post['dtype']=='moneybookers'){?>
<form method=post action="https://www.moneybookers.com/app/payment.pl">
<input type=hidden name=pay_to_email value="<?=$data['DepositMethod'][$post['dtype']]['user']?>">
<input type=hidden name=return_url value="<?=$data['Members']?>/deposit.htm">
<input type=hidden name=cancel_url value="<?=$data['Members']?>/deposit.htm">
<input type=hidden name=status_url value="<?=$data['Members']?>/notify.htm">
<input type=hidden name=language value="EN">
<input type=hidden name=amount value="<?=$post['total']?>">
<input type=hidden name=currency value="USD">
<input type=hidden name=detail1_description value="Transaction Description:">
<input type=hidden name=detail1_text value="Add funds to my <?=$data['SiteName']?> account">

<?}elseif($$post['dtype']=='topup'|| $post['dtype']=='CCP'){?>
   
	<?if(!$post['ShowCheckInfo']){?>
		<form method="post" id="sigup-form" >
		<input type="hidden" name="dtype" value="<?=$post['dtype']?>">
		<input type="hidden" name="fees" value="<?=$post['fees']?>">
		<input type="hidden" name="amount" value="<?=$post['amount']?>">
		<input type="hidden" name="manual" value="true">
		<input type="hidden" id="action" value="">	
		</form>
	<?}else{?>
		<form method="post" id="sigup-form" >
		<input type="hidden" id="action" value="">	
		</form>
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
		
		</font>
		<?
		}
}?>

		<?if($post['dtype']=='CCP'&&!$post['ShowCheckInfo']){?>
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
		<center>
			<h2>cr&egraveer des cartes de recharge</h2>
			<?if($data['Error']){?>
						<div class="ui-widget">
							<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
								<p><span class="ui-icon ui-icon-alert" style="float: centre; margin-right: .3em;"></span> 
								<?=prntext($data['Error'])?></p>
							</div>
						</div>
					    <br>
					    <?}?>
			<div class="ui-state-highlight-big ui-corner-all" style="margin-top: 20px; padding: 0 .7em;"> 
							<br>
							<div class="field">
								Montant : <?=prnpays($post['amount'])."\n"?><br>
								Frais : <?=prnpays(-$post['fees'])."\n"?><BR>
								D&egrave;p&ocirc;t Total : <?=prnpays($post['total'])."\n"?>
								<br>
							</div>
					<br>
								
		 <?if($post['dtype']!='autorize'){?>
			
			<?if (($post['dtype']=='topup') &&  (!$post['ShowCheckInfo']) ){?>
				
				<form method="post" id="sigup-form" >
					<input type="hidden" name="dtype" value="<?=$post['dtype']?>">
					<input type="hidden" name="fees" value="<?=$post['fees']?>">
					<input type="hidden" name="amount" value="<?=$post['amount']?>">
					<input type="hidden" name="manual" value="true">
					<input type="hidden" id="action" value="">
					<div class="field text">
								<label>Saisissez les 16 chifres: </label>
								<input type="text" name="topup_number" value="<?=$post['topup_number']?>" size="41" maxlength="16">
					</div>					
					</form>
			<?php }elseif ($post['dtype']=='topup'){?>
			<form method="post" id="sigup-form" >
			<input type="hidden" id="action" value="">
			</form>
						La carte de recharge a  &egrave;t&egrave; charger avec succ&agrave;s
						<br>
						votre Solde: <?=prnpays($data['Balance']) ?>
			
			<?php } ?>
			<br>
			
			<?if($post['dtype']=='CCP'){?>
				<?if(!$post['ShowCheckInfo']){?>
						S'il vous pla&icirc;t envoyer un paiement de <?=prnsum($post['total'])?> &agrave; le compte suivante:
						<br><br>
						<?=prntext($data['CCPAccount'])?>
					  <br><br>
					   S'il vous pla&Icirc;t Note: inclure une note avec votre nom 
					   <br>identifiant (<?=prntext($post['username'])?>) et
					   l'adresse email que vous avez enregistr&egrave; aupr&egrave;s de (<?=prntext($post['email'])?>),
					  <br>		   afin que nous puissions de cr&egrave;dit votre compte.
					  <br>
					  <br>
				<?}else{?>
					<?=prntext($post['CheckInfo'])?>
				<?}?>
			<?}?>

<?}?>
		<br>
			</div>
		<br>
		 <div class="alignright">
					<a class="link4" href="#" onClick="send('cancel','ANNULER')"><span><span><?if($post['dtype']=='CCP'){?>ANULLER<?}elseif ($post['ShowCheckInfo']){ ?>Termin&egrave;<?} else{?>ANULLER TRANSACTION<?}?></span></span></a>
					<?if(!$post['ShowCheckInfo']){?>
						<a class="link2" href="#" onClick="send('send','CONTINUE')"><span><span>VALIDER</span></span></a>
					<?}?>
							
		 </div>
		<br>
	</div>
					
							<?}?>

							<?}else{?>SECURITY ALERT: Access Denied<?}?>


	</article>
						<div class="clear"></div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
