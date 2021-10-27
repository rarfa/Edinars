<script>
            jQuery(document).ready(function(){
                // binds form submission and fields to the validation engine
                jQuery("#form-ccp").validationEngine();
				jQuery("#from-cheque").validationEngine();
				jQuery("#retire-form-step1").validationEngine();
			});
			
</script>
<!-- Start content  -->
<div class="content">
<? if ( !$post['type']) { ?> 
	<center>
	<br>
		<div class="ui-widget">
			<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
				<p>
					<span class="ui-icon ui-icon-alert" style="float: centre; margin-right: .3em;"></span> 
					Ce service est disponible que pour les Professionnels.
					<br>pour plus d'information contact L'&egrave;quipe Edinars.
				</p>
			</div>
		</div>
	</center>
<? } else { ?>
	<?if(isset($data['ScriptLoaded'])){?>
		<?if($post['step']<4){?>
		
			<?if($data['Error']){?>
				<center>
							<div class="ui-widget">
								<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
									<p><span class="ui-icon ui-icon-alert" style="float: centre; margin-right: .3em;"></span> 
									<?=prntext($data['Error'])?>.</p>
								</div>
							</div>
							<br>
				</center>			
			<?}?>
				<?if($post['step']==1){?>
					
					<!-- ############# admin_box start ############# -->
		<div class="admin_box">
			<!-- ############# admin_box_header start ############# -->
			<div class="admin_box_header">
				<div class="box_header_left">
					<div class="header_tabs"><!-- add tabs in this div -->
						<a href="#tab01" class="default_tab current" onclick="jQuery('#form-ccp').validationEngine('hide');jQuery('#from-cheque').validationEngine('hide')";><span class="tab">RETIRER PAR CHEQUE</span><span class="tab_right"></span></a>
						<a href="#tab02" onclick="jQuery('#form-ccp').validationEngine('hide');jQuery('#from-cheque').validationEngine('hide')";><span class="tab">RETIRER PAR CCP</span><span class="tab_right"></span></a>
					</div>
				</div>                
			</div>
			<!-- ############# admin_box_header end ############# -->
			<!-- ############# content_box start ############# -->
			<div class="content_box">
					<div id="tab01" class="content default_tab">
						<br class="clear" />
						<center>
						<form method="post" id="from-cheque" > 
						<input type=hidden name=step value="<?=$post['step']?>">
							<table class="common_table_detail" >
							
								<thead>
									<tr>
										<th class="code_col" colspan=2>Montant minimum que vous pouvez retirer est <?=prnsumm($data['WithdrawMinSum'])?> <?=prntext($data['Currency'])?>.
										<br><br><b>FRAIS RETIRER PAR CHEQUE: <?=prnsumm($data['WithdrawMethod']['cheque']['fees'])?>&nbsp;<?=prntext($data['Currency'])?></b>
										<br><br>
										</th>
									
									</tr>
								</thead>
								<tbody>
										<tr> 
											<input type="hidden" name="wtype" value="cheque">
											<input type="hidden" name="fees" value="<?=$data['WithdrawMethod']['cheque']['fees']?>">
											<input type="hidden" name="manual" value="true">
											<input type="hidden" name="send" value="true">
											<br>
											<td>Montant de retrait, <?=prntext($data['Currency'])?> :</td>
											<td> <input type="text" name="montant-cheque" id="montant-cheque"  maxlength=16 value="<?=prntext($post['montant'])?>" class="validate[required,custom[number]]  text-input"></td>
										</tr> 
										<tr>
											<td colspan="2" class="middle">
												<input type="submit" id="submit" name="send" value="RETIRER MAINTENANT" />
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
							<form method="post" id="form-ccp" > 
							<input type=hidden name=step value="<?=$post['step']?>">
							<table class="common_table_detail">
								<thead>
									<tr>
										<th class="code_col" colspan=2>Montant minimum que vous pouvez retirer est <?=prnsumm($data['WithdrawMinSum'])?> <?=prntext($data['Currency'])?>.
										<br><br><b>FRAIS RETIRER PAR CCP : <?=prnsumm($data['WithdrawMethod']['ccp']['fees'])?>&nbsp;<?=prntext($data['Currency'])?></b>
										<br><br>
										</th>
									</tr>
								</thead>
								<tbody>
										<tr> 
												<input type="hidden" name="wtype" value="ccp">
												<input type="hidden" name="fees" value="<?=$data['WithdrawMethod']['ccp']['fees']?>">
												<input type="hidden" name="manual" value="true">
												<input type="hidden" name="send" value="true">
												<br>
												<td>Montant de retrait, <?=prntext($data['Currency'])?> :</td>
												<td> <input type="text" name="montant-ccp" id="montant-ccp"   maxlength=16 value="<?=prntext($post['montant'])?>" class="validate[required,custom[number]]  text-input"></td>
										</tr>
										<tr>
											<td colspan="2" class="middle">
												<input type="submit" id="submit" name="send" value="RETIRER MAINTENANT" />
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

			<?}elseif($post['step']==2){?>
					
						<? if(($post['wtype']=='cheque') || ($post['wtype']=='ccp')){?>
						<article class="col-3">
							<div class="col_title">LES INFORMATIONS DE RETIRER PAR <?=strtoupper($post['wtype'])?></div>
							<div class="col_text">
								<center>		
					
									 <form method="post"  id="retire-form-step1" >
										<input type="hidden" name=step value="<?=$post['step']?>">
										<input type="hidden" name=montant value="<?=$post['montant']?>">
										<input type="hidden" name=wtype value="<?=$post['wtype']?>">
								
									<table class="common_table_detail">
										<tbody>
												<tr>
													<td>Nom (*)</td>
													<td><?=prntext($post['fname'])?></td>
												</tr>
												<tr>
													<td>Pr&egrave;nom (*)</td>
													<td><?=prntext($post['lname'])?></td>
												</tr>
												<tr>
													<td>Nom de soci&eacute;t&eacute; (*) :</td>
													<td><?=prntext($post['company'])?></td>
												</tr>
												<? if ($post['wtype']=='ccp') { ?>
													<tr>
														<td>Compte CCP (*) :</td>
														<td><input type="text" name="ccp" id="montant-ccp"   maxlength=30 value="<?=prntext($post['ccp'])?>" class="validate[required]  text-input"></td>
												</tr>
												<? } ?>
												<tr>
													<td>Address (*):</td>
													<td><?=prntext($post['address'])?></td>
												</tr>
												<tr>
													<td>Commune (*):</td>
													<td><?=prntext($post['city'])?></td>
												</tr>
												<tr>
													<td>Code postal (*):</td>
													<td><?=prntext($post['postcode'])?></td>
												</tr>
												<tr>
													<td>Wilaya(*):</td>
													<td><?=$data['Wilayas'][$post['wilaya']]?></td>
												</tr>
												<tr>
													<td>Mobile (*)</td>
													<td><?=prntext($post['mobile'])?></td>
												</tr>
												<tr>
													<td colspan="2" class="middle">
														<input type="submit" id="submit" name="send" value="VALIDER" />
													</td>
												</tr>										
								
									   </tbody>
										</table>
								
								</form>
								</center>
						</p>
		</div>
	</article>	
					<div class="clr"></div>
					<?}?>
			<?}elseif($post['step']==3){?>
					<article class="col-3">
							<div class="col_title">LES INFORMATIONS DE RETIRER PAR <?=strtoupper($post['wtype'])?></div>
							<div class="col_text">
						 <center>
							<form method="post" id="retire-form-step2" >
								<input type="hidden" name="step" value="<?=$post['step']?>">
								<input type="hidden" name="montant" value="<?=$post['montant']?>">
								<input type="hidden" name="wtype" value="<?=$post['wtype']?>">
								<input type="hidden" id="send" name="send" value="true">
								<table class="common_table_detail">
								<thead>
									<tr>
										<th class="code_col" colspan=2>LES D&Egrave;TAILS DE RETIRER PAR <?=strtoupper($post['wtype'])?></th>
									</tr>
								</thead>
									<tbody>
										<tr>
											<td >
												<b><?=str_replace($data['line'] ,$data['replace'] , prntext($post['info']) )?></b>
											</td>
										</tr>
										<tr>
											<td colspan="2" class="middle">
												<b><input type="submit" id="submit" name="send" value="VALIDER" /></b>
											</td>
										</tr>
									</tbody>
								</table>		
							</form>
						</center>
							
						</p>
		</div>
	</article>	
					<div class="clr"></div>	
				<?}?>
		
		<?}else{?>
					
			<article class="col-3">
				<div class="col_title">LES D&Egrave;TAILS DE RETIRER PAR <?=strtoupper($post['wtype'])?></div>
				<div class="col_text">
				
							<p>Votre demande de retirer le transfert a été envoyé.</p>
							<p>Vous devriez recevoir une notification par e-mail au sujet de cette transaction.</p>	
							<p>Cette transaction sera traitée dans les 24 heures.</p>
							<p>S'il vous plaît être patient.</p>
				
			</p>
		</div>
	</article>			
	<div class="clr"></div>	
		<?}?>
	<?}else{?>SECURITY ALERT: Access Denied<?}?>
<? } // end for check account type?>	
</div>

<!-- End content  -->
