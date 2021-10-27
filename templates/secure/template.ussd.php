<script>
		jQuery(document).ready(function(){
			// binds form submission and fields to the validation engine
		jQuery("#flexy-form").validationEngine();
	});
</script>
<!-- Start content  -->
<div class="content">
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
									<th class="code_col"  colspan=2><b>FRAIS DE RECHARGER  <?=prnsumm($data['flexy_fee'])?>&nbsp;<?=prntext($data['Currency'])?></b></th>
								</tr>
							</thead>
							<tbody>
								<tr>
										<input type="hidden" name="dtype" value="flexy">
										<br>
										<td>Operator:</td>
										 <td>
											<select name="operator" id="operator" class="validate[required]" ><?=showselect($data['operator-flexy'], $post['operator'])?></select>
										</td>
								</tr>
								<tr>
										<td>Montant &agrave; Recharger:</td>
										 <td> <input type="text" name="montant"  id="montant" maxlength="16" value="<?=prntext($post['montant'])?>" class="validate[required,custom[integer],min[100],max[5000]]  text-input"></td>

								</tr>
									<tr>
										<td>Mobile &agrave; Recharger:</td>
										 <td> <input type="text" name="mobile_flexy"  id="mobile_flexy" maxlength="10" value="<?=prntext($post['mobile_flexy'])?>" class="validate[required,custom[integer],minSize[10]]  text-input"></td>

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
								<th class="data_col">ACTION</th>
							</tr>
						</thead>
						<tbody>
								<?php if($post['Transactions']){
									$idx=1;
									foreach($post['Transactions'] as $value){ ?>
									<tr>
										<td nowrap ><?=$value['ussd_operator']?></td>
										<td nowrap ><?=$value['ussd_number']?></td>
										<td nowrap ><?=$value['amount']?></td>
										<td><?=$value['fees']?></td>
										<td nowrap><?=$value['nets']?></td>
										<td><?=$value['tdate']?></td>
										<td><?=$value['status']?></td>
										<td nowrap>
										<?if($value['canview']){?>
											<a href="<?=$data['Members']?>/mon-historique-Edinars-transaction.html/<?=$value['id']?>/details">D&Egrave;TAIL</a>
										<?}?>
										</td>
									</tr>
						     <?php
							     }
							   }else{?>
								<tr>
									<td colspan=9  align=center>AUCUNE TRANSACTION TROUV&Egrave;</td>
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
											<a href="<?=$data['Members']?>/recharger-mobile-Edinars.html/<?=$data['Pages'][$i]?>" title="Page <?=$i+1?>"><?=$i+1?></a>
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
