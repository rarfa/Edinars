<script>
            jQuery(document).ready(function(){
                // binds form submission and fields to the validation engine
                jQuery("#ccp-form").validationEngine();
				jQuery("#topup-form").validationEngine();
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
								<?=prntext($data['Error'])?>.</p>
							</div>
						</div>
					    <br>
		  <? If ($post['dtype'] !="ccp")  {  ?>
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

		    <? }  ?>

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
					<a href="#tab01" class="default_tab current" onclick="jQuery('#ccp-form').validationEngine('hide');"><span class="tab">RECHARGE PAR CARTE DE RECHARGE</span><span class="tab_right"></span></a>
			<!--	<a href="#tab02" onclick="jQuery('#topup-form').validationEngine('hide');"  ><span class="tab">RECHARGE PAR CCP</span><span class="tab_right"></span></a>
      --><a href="#tab03" onclick="jQuery('#bank-form').validationEngine('hide');"  ><span class="tab">RECHARGE PAR VIREMENT BANCAIRE ET CCP</span><span class="tab_right"></span></a>
					</div>
				</div>
			</div>
			<!-- ############# admin_box_header end ############# -->
			<!-- ############# content_box start ############# -->
			<div class="content_box">
				<div id="tab01" class="content default_tab">
					<br class="clear" />
					<center>
							<form method="post" action="" id="topup-form" >
						<table CLASS="common_table_detail">
								<tr>
									<th class="code_col"  colspan=2 ><b>FRAIS D&Egrave;P&Ocirc;T PAR CARTE DE RECHARGE: <?=prnsumm($data['DepositMethod']['topup']['prcn'])?>%</b></th>
									<th></th>
								</tr>
							</thead>
							<tbody>
									<?if (!$post['ShowCheckInfo']) {?>
									<tr>
											<input type="hidden" name="dtype" value="topup">
											<input type="hidden" name="fees" value="<?=$post['fees']?>">
											<input type="hidden" name="manual" value="true">
											<input type="hidden" name="send" value="true">
											<br>
											<td>Montant &agrave; D&egrave;poser :</td>
								            <td><input type="text" name="montant-topup" id="montant-topup" maxlength=16 value="<?=prntext($post['montant'])?>" class="validate[required,custom[number]]  text-input"></td>
									</tr>
									<tr>
											<td>Saisissez les chifres: </td>
											<td><input type="text" name="topup_number" id="topup_number" value="<?=$post['topup_number']?>"  maxlength="16" class="validate[required]  text-input"></td>
									</tr>
									<?php }else {?>
									<tr>
										<td colspan=2>
												La carte de recharge a  &egrave;t&egrave; charger avec succ&egrave;s votre Solde: <?=prnpays($data['Balance']) ?>
										</td>
									</tr>
										<tr>
											<td>Montant</td>
											<td><?=prnpays($post['montant'])?></td>
									</tr>
									<tr>
											<td>Frais</td>
											<td><?=prnpays(-$post['fees'])?></td>
									</tr>
									<tr>
											<td>D&egrave;p&ocirc;t Total</td>
											<td><?=prnpays($post['total'])?></td>
									</tr>../../../../../images/banques/
									<?php } ?>
									<?if (!$post['ShowCheckInfo']) {?>
										<tr>
											<td class="middle" COLSPAN="2"><input type="submit" id="submit" name="send" value="RECHARGER MAINTENANT" /></td>
										</tr>
									<? } ?>
							</tbody>
						</table>
					</form>
					</center>
					<br class="clear" />
				</div>
				<div id="tab02" class="content">
					<br class="clear" />
						<center>
						 <form method="post"  id="ccp-form" >
							<table class="common_table_detail" >
							<thead>
								<tr>
									<th class="code_col"  colspan=2><b>FRAIS D&Egrave;P&Ocirc;T PAR CCP: <?=prnsumm($data['DepositMethod']['CCP']['prcn'])?>% &nbsp;+&nbsp; <?=prnsumm($data['DepositMethod']['CCP']['fees'])?>&nbsp;<?=prntext($data['Currency'])?></b></th>
								</tr>
							</thead>
							<tbody>
								<?if (!$post['ShowCheckInfo']) {?>
									<tr>
											<input type="hidden" name="dtype" value="CCP">
											<input type="hidden" name="fees" value="<?=$post['fees']?>">
											<input type="hidden" name="manual" value="true">
											<input type="hidden" name="send" value="true">
											<br>
											<td>Montant &agrave; D&egrave;poser :</td>
								            <td> <input type="text" name="montant-ccp"  id="montant-ccp" maxlength="16" value="<?=prntext($post['montant'])?>" class="validate[required,custom[number]]  text-input"></td>
									</tr>
									<tr>
										<td colspan="2" class="middle">
											<?if (!$post['ShowCheckInfo']) {?>
												<input type="submit" id="submit" name="send" value="RECHARGER MAINTENANT" />
											<? } ?>
										</td>
									</tr>

									<?php } ?>
						   </tbody>
						</table>
						</form>

						</center>
				 	 <br class="clear" />
				</div>
				<div id="tab03" class="content">
					<br class="clear" />
						<center>
						 <form method="post"  id="ccp-form" >
							<table class="common_table_detail" >
							<thead>
								<tr>
									<th class="code_col"  colspan=2><b>FRAIS D&Egrave;P&Ocirc;T PAR VIREMENT BANCAIRE: <?=prnsumm($data['DepositMethod']['CCP']['prcn'])?>% &nbsp;+&nbsp; <?=prnsumm($data['DepositMethod']['CCP']['fees'])?>&nbsp;<?=prntext($data['Currency'])?></b></th>
								</tr>
							</thead>
							<tbody>



									<tr>
										<td colspan="2" class="middle">
											<div class="cc-selector-2">
												<input id="visa2" type="radio" name="creditcard" value="visa" />
												<label class="drinkcard-cc visa" for="visa2"><img src="../../../../../images/banques/agb.png"></label>
												<input id="mastercard2" type="radio" name="creditcard" value="mastercard" />
												<label class="drinkcard-cc mastercard" for="mastercard2"><img src="../../../../../images/banques/badr.png"></label>
												<input id="visa2" type="radio" name="creditcard" value="visa" />
												<label class="drinkcard-cc badr" for="visa2"><img src="../../../../../images/banques/abc.png"></label>
												<input id="mastercard2" type="radio" name="creditcard" value="mastercard" />
												<label class="drinkcard-cc bea"for="mastercard2"><img src="../../../../../images/banques/bdl.png"></label>
												<br>

												<input id="visa2" type="radio" name="creditcard" value="visa" />
												<label class="drinkcard-cc visa" for="visa2"><img src="../../../../../images/banques/bea.png"></label>

												<input id="visa2" type="radio" name="creditcard" value="visa" />
												<label class="drinkcard-cc visa" for="visa2"><img src="../../../../../images/banques/bna.png"></label>

												<input id="visa2" type="radio" name="creditcard" value="visa" />
												<label class="drinkcard-cc visa" for="visa2"><img src="../../../../../images/banques/bnp.png"></label>

												<input id="visa2" type="radio" name="creditcard" value="visa" />
												<label class="drinkcard-cc visa" for="visa2"><img src="../../../../../images/banques/cpa.png"></label>
												<br>

                        <input id="visa2" type="radio" name="creditcard" value="visa" />
												<label class="drinkcard-cc visa" for="visa2"><img src="../../../../../images/banques/citibank.png"></label>

												<input id="visa2" type="radio" name="creditcard" value="visa" />
												<label class="drinkcard-cc visa" for="visa2"><img src="../../../../../images/banques/hsbc.png"></label>

												<input id="visa2" type="radio" name="creditcard" value="visa" />
												<label class="drinkcard-cc visa" for="visa2"><img src="../../../../../images/banques/cnep.png"></label>

												<input id="visa2" type="radio" name="creditcard" value="visa" />
												<label class="drinkcard-cc visa" for="visa2"><img src="../../../../../images/banques/societe-general.png"></label>

										</td>
									</div>
									</tr>
									<tr>
										<td colspan="2" class="middle">
											<?if (!$post['ShowCheckInfo']) {?>
												<input type="submit" id="submit" name="send" value="RECHARGER MAINTENANT" />
											<? } ?>
										</td>
									</tr>

						   </tbody>
						</table>
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
					<br>(Ajouter des fonds avec <?=strtoupper($data['DepositMethod'][$post['dtype']]['name'])?>)
				</tr>
			</thead>
			<tbody>
					<tr>
							<td>Montant</td>
							<td><?=prnpays($post['montant'])?></td>
					</tr>
					<tr>
							<td>Frais</td>
							<td><?=prnpays(-$post['fees'])?></td>
					</tr>
					<tr>
							<td>D&egrave;p&ocirc;t Total</td>
							<td><?=prnpays($post['total'])?></td>
					</tr>
					<?if($post['dtype']=='CCP'){?>
							<?if(!$post['ShowCheckInfo']){?>
							<tr>
								<td colspan=2 >
									<b>S'il vous pla&icirc;t envoyer un paiement de <?=prnpays($post['total'])?> sur le compte suivante</b>
								</td>
							</tr>
							<tr>
								<td colspan=2 >
								<?=prntext($data['CCPAccount'])?>
								</td>
							</tr>
							<tr>
								<td colspan=2 >
									<b>S'il vous pla&icirc;t Note: inclure une note avec votre d&egrave;tail</b>
								</td>
							</tr>
							<tr>
								<td>identifiant</td>
								<td><?=prntext($post['username'])?></td>
							</tr>
							<tr>
								<td>Numero Compte</td>
								<td><?=prntext($_SESSION['Mem_Id'])?></td>
							</tr>
							<tr>
								<td colspan=2>
									 <b> et   l'adresse email que vous avez enregistr&egrave; aupr&egrave;s de (<?=prntext($post['email'])?>),
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
							<?=prntext($post['CheckInfo'])?>
						</td>
					</tr>
				<?}?>
			<?}?>
		   </tbody>
		</table>
	<?}?>
</CENTER>
<?}else{?>SECURITY ALERT: Access Denied<?}?>
</div>

<!-- End content  -->
