
<!-- Start content  -->

<div class="content">
	<article class="col-1">
		<div class="col_title">Sècuritè</div>
		<div class="col_text">
			<p class="pm">
				De ce fait nous vous invitent a ignorer les avertissements par email qui invitent à payer avec Edinars qui n’émane pas de nos partenaires certifier, Si des sites Internet, des mails ou autres activités en ligne vous paraissent suspects, veuillez les communiquer à l’équipe de sécurité Edinars à l’adresse email suivante : info@edinars.net.		
			</p>				
			<p class="pm" align="center">
				<a href="securite-Edinars.html" class="link">Plus information</a>
			</p>
		</div>
	</article>
	<article class="col-2">
		<div class="col_title">Les tarifs avec Edinars</div>
		<div class="col_text">
					<p class="pm" align="centre">
									<table id="hor-minimalist-a" summary="Informations Generales">
										<thead>
											<tr>
												<th scope="col">Inscription :</th>
												<th scope="col">GRATUITE</th>
											</tr>
											<tr>
												<th scope="col">Service Particuliers:</th>
												<th scope="col">GRATUITE</th>
											</tr>
											<tr>
												<th scope="col">Service Professionnels:</th>
												<th scope="col"><?=prnsumm($data['PaymentPercent'] )?>% &nbsp;+&nbsp; <?=prnsumm($data['PaymentFees'])?>&nbsp;<?=prntext($data['Currency'])?></th>
										
											</tr>
											<tr>
												<th scope="col">Créditer de l'argent à partir de compte ccp :</th>
												<th scope="col"><?=prnsumm($data['DepositMethod']['CCP']['prcn'])?>% &nbsp;+&nbsp; <?=prnsumm($data['DepositMethod']['CCP']['fees'])?>&nbsp;<?=prntext($data['Currency'])?></th>
											</tr>
											<tr>
												<th scope="col">Créditer de l'argent à partir de votre carte de recharge :</th>
												<th scope="col"><?=prnsumm($data['DepositMethod']['topup']['prcn'])?>% &nbsp;+&nbsp; <?=prnsumm($data['DepositMethod']['topup']['fees'])?>&nbsp;<?=prntext($data['Currency'])?></th>
											</tr>
											<tr>
												<th scope="col">Retirer de l'argent par chèque banquer :</th>
												<th scope="col"> <?=prnsumm($data['WithdrawMethod']['cheque']['fees'])?>&nbsp;<?=prntext($data['Currency'])?></th>
											</tr>
											<tr>
												<th scope="col">Retirer de l'argent par virement CCP :</th>
												<th scope="col"><?=prnsumm($data['WithdrawMethod']['ccp']['fees'])?>&nbsp;<?=prntext($data['Currency'])?></th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td></td>
											</tr>
										</tbody>
									</table>
								</p>	
		</div>
	</article>
	<div class="clr"></div>

</div>

<!-- End content  -->