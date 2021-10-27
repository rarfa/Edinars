<!-- Start content  -->
<div class="container">
<div class="row">
<br />
<?if(isset($data['ScriptLoaded'])){?>
<div id="compte">
		<!-- ############# admin_box start ############# -->
		<div class="admin_box">
			
			
			<!-- ############# admin_box_header start ############# -->
			<div class="admin_box_header">
				<div class="box_header_left">
				
				<div class="header_tabs"><!-- add tabs in this div -->
				<a href="#tab01" class="default_tab current"><span class="tab">Informations G&egrave;n&egrave;rales</span><span class="tab_right"></span></a>
				<a href="#tab02"><span class="tab">5 R&egrave;centes Transactions</span><span class="tab_right"></span></a>
				<a href="#tab03"><span class="tab">Paiements en instance</span><span class="tab_right"></span></a>
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
								<th class="code_col">Nom et Pr&eacute;nom</th>
								<th class="code_col">Identifiant</th>
								<th class="code_col">E-mail principale</th>
								<th class="code_col">Derni&eacute;re connexion</th>
								<th class="code_col">Solde</th>
								<th class="code_col">Mon Statut</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><?=prntext($post['fname'])?> <?=prntext($post['lname'])?></td>
								<td><?=prntext($post['username'])?></td>
								<td><?=prntext($post['Emails'])?></td>
								<td><?=prndate($post['ldate'])?></td>
								<td><?=balance($data['Balance'])?></td>
								<td><font color=<?if($post['status']<2){?>#FF0000<?}else{?>#0066CC<?}?>><?=prntext($data['MemberStatus'][$post['status']]['status'])?></font></td>
								<?if($data['ReferralPays']){?>
									<td><a href="<?=$data['Host']?>/?rid=<?=$post['username']?>" target=new><?=$data['Host']?>/?rid=<?=$post['username']?></a></td>
								<?}?>
							</tr>
						</tbody>
					</table>
					
				
						<br>
						<?if($post['type'] == 1){?>
							<!-- Professiotnl-->
							<table class="common_table">
								<thead>
									<tr>
										<th class="data_col">Logo</th>
										<th class="data_col">Numero RC</th>
										<th class="data_col">Numero NIF</th>
										<th class="data_col">Numero Article</th>
										<?if($data['ReferralPays']){?>
											<th class="data_col">Votre URL de parrainage</th>
										<?}?>
									</tr>
								</thead>
								<tbody>
									<tr>
										<?php 
										 if (!$post['logo']) { ?>
											<td></td>
										 <? } else { ?>
											<td><img src="<?php echo $post['logo']?>" /></td>
										 <? } ?>
										
										<td><?=prntext($post['nrc'])?></td>
										<td><?=prntext($post['nnif'])?></td>
										<td><?=prntext($post['nart'])?></td>
										
										<?if($data['ReferralPays']){?>
										<td><a href="<?=$data['Host']?>/?rid=<?=$post['username']?>" target=new><?=$data['Host']?>/?rid=<?=$post['username']?></a></td>
										<?}?>
									</tr>
								</tbody>
					
							</table>
						
						<?}?>
						
					<div class="table_bottom_right_tool">
						<?if(!empty($data['MemberStatus'][$post['status']]['action'])){?>
									<form action="<?=$data['Host']?>/verifier-Edinars/<?=$data['MemberStatus'][$post['status']]['action']?>" method="post">
										   <input type="hidden" id="action" name="action" value ="<?=$data['MemberStatus'][$post['status']]['action']?>" >
										<input type="submit" id="submit" name="send" value="<?=prntext($data['MemberStatus'][$post['status']]['button'])?>" />
									</form>
								<?}?>
					</div>
					
					<br class="clear" />
				</div>
				
				<div id="tab02" class="content">
					<table class="common_table">
						<thead>
							<tr>
								<th class="data_col">Dir</th>
								<th class="data_col">Member</th>
								<th class="data_col">Montant</th>
								<th class="data_col">Frais</th>
								<th class="data_col">Pay&egrave</th>
								<th class="data_col">Date</th>
								<th class="data_col">Type</th>
								<th class="data_col">Statut</th>
							</tr>
						</thead>
						<tbody>
								<?php if($post['Transactions']){
									$idx=1;
									foreach($post['Transactions'] as $value){ ?>
									<tr>
										<td><img src="<?=$data['Host']?>/<?=$data['direction'][$value['direction']] ;?>"></td>
										<td><?if($value['userid']>0){?><a href="<?=$data['Members']?>/member-Edinars.html/<?=$value['userid']?>/view"><?=prntext($value['username'])?></a><?}else{?><?=prntext($value['username'])?><?}?></td>
										<td><?=$value['amount']?></td>
										<td><?=$value['fees']?></td>
										<td><?=$value['nets']?></td>
										<td><?=$value['tdate']?></td>
										<td><?=$value['type']?></td>
										<td><?=$value['status']?></td>
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
					 
				</div>
				
				<div id="tab03" class="content">
					<table class="common_table">
						<thead>
							<tr>
								<th scope="col">UNREG. Member</th>
								<th scope="col">Montant</th>
								<th scope="col">Frais</th>
								<th scope="col">Date</th>
							</tr>
						</thead>
						<tbody>
							<?if($post['PaysToUnregMembers']){?>
							<?
								foreach($post['PaysToUnregMembers'] as $value){ ?>
						   <tr>
								<td><?=prntext($value['receiver'])?></td>
								<td><?=$value['amount']?></td>
								<td><?=prnfees($value['fees'])?></td>
								<td><?=prndate($post['tdate'])?></td>
							</tr>
							<?}?>
							<?}else{?>
							<tr>
								<td colspan=8 align=center>AUCUNE TRANSACTION TROUV&Egrave;</td>
							</tr>
						<?}?>
						</tbody>
					</table>
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

</div>

<!-- End content  -->

<?}else{?>SECURITY ALERT: Access Denied<?}?>

</div>