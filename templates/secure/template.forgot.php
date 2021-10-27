<!-- Start content  -->

<div class="content">

<article class="col-1">
<div class="col_title">Sècuritè</div>
<div class="col_text">
		<p class="pm">
			Ne donnez jamais votre code de carte Edinars à des personnes qui vous demandent une avance de paiement.
								<BR>	
			</p>				
			<p class="pm" align="center">
				<a href="securite-Edinars" class="link">Plus information</a>
			</p>
			
				
</div>
</article>

<?if(isset($data['ScriptLoaded'])){?>
	
		<form method="post" id="sigup-form" >
	   <input type="hidden" name="step" value="<?=$post['step']?>">
		<?if($post['step']==1){?>
						
						<article class="col-2">
							<div class="col_title">Mot de passe oubli&egrave; Etape 1</div>
							<div class="col_text">
								<p class="pm">
										<?if($data['Error']){?>
										<center>
											<br>
											<div class="ui-widget">
											<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;width:350px"> 
												<p><span class="ui-icon ui-icon-alert" style="float: centre; margin-right: .3em;"></span> 
												<?=prntext($data['Error'])?>.</p>
											</div>
											</div>
											<br>
										</center>	
										<?}?>
									</p>
								<p class="pm">
									Pour recevoir vos informations de connexion par E-mail, entrez votre adresse email que vous avez fournies lors de l'ouverture du compte.
									</p>
									<p class="pm">
									Nous vous enverrons alors votre mot de passe &agrave; l'adresse e-mail.
									<table id="hor-minimalist-a" summary="MOT-DE-PASS">
										<tbody>
											<tr>
												<td align="right">Adresse E-Mail (*) :</td>
												<td><input type="text" id="email" name="email" size="30" maxlength="250" value="<?=prntext($post['email'])?>" class="validate[required,custom[email]] text-input"></td>
											</tr>
										</tbody>
									</table>
									</p>	
								<div class="alignright">
									<input type="submit" id="submit" name="send" value="Suivant &raquo;" />
								</div>

							</div>
						</article>
		<?}elseif($post['step']==2){?>
					<article class="col-2">
							<div class="col_title">Mot de passe oubli&egrave; Etape 2</div>
							<div class="col_text">
								<p class="pm">
										<?if($data['Error']){?>
										<center>
											<div class="ui-widget">
											<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;width:350px"> 
												<p><span class="ui-icon ui-icon-alert" style="float: centre; margin-right: .3em;"></span> 
												<?=prntext($data['Error'])?>.</p>
											</div>
											</div>
										</center>	
										<?}?>
									</p>
									<p class="pm">
										Si vous oubliez votre mot de passe, nous allons vous poser la question que vous soumettez. 
									</p>
									<p class="pm">
									S'il vous pla&icirc;t,saisissez la r&egrave;ponse qui vous seul connaissez.</p>
									</p>
									<table id="hor-minimalist-a" summary="MOT-DE-PASS">
										<tbody>
											<tr>
												<td align="right">Question de S&egrave;curit&egrave; :</td>
												<td><b><?=$data['question'][$post['question']] ?></b></td>
											</tr>
											<tr>
												<td align="right">R&egrave;ponse de s&egrave;curit&egrave; (*):</td>
												<td><input type="text" id="answer" name="answer" size="30" maxlength="250" value="<?=prntext($post['answer'])?>" class="validate[required] text-input">			</td>
											</tr>
										</tbody>
									</table>
									</p>	
								<br>
								<div class="alignright">
								    <input type="submit" id="submit" name="back" value="&laquo; Pr&eacute;c&eacute;dent" />
									<input type="submit" id="submit" name="send" value="Suivant &raquo;" />
								</div>

							</div>
						</article>
						
		
	
				</form>
				<?}elseif($post['step']==3){?>
						<article class="col-2">
							<div class="col_title">Mot de passe oubli&egrave; Etape 3</div>
							<div class="col_text">
								<p class="pm">
										<?if($data['Error']){?>
										<center>
											<div class="ui-widget">
											<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;width:350px"> 
												<p><span class="ui-icon ui-icon-alert" style="float: centre; margin-right: .3em;"></span> 
												<?=prntext($data['Error'])?>.</p>
											</div>
											</div>
										</center>	
										<?}?>
									</p>
									<p class="pm">
										Si vous oubliez votre mot de passe, nous allons vous poser la question que vous soumettez. 
									</p>
									<p class="pm">
									S'il vous pla&icirc;t,saisissez la r&egrave;ponse qui vous seul connaissez.</p>
									</p>
									
										<table id="hor-minimalist-a" summary="PROFILE">
							<tbody>
									<tr>
										<td>Choisir mot de passe (*):</td>
										<td><input type="password" id="newpass" name="newpass" size="35" maxlength="50" value="<?=prntext($post['newpass'])?>" class="validate[required,optional,minSize[9]] text-input"></td>
										<td></td>	
									</tr>
									<tr>
										<td>Confirmer le mot de passe (*):</td>
										<td><input type="password" id="cfmpass" name="cfmpass" size="35" maxlength="50" value="<?=prntext($post['cfmpass'])?>" class="validate[required,minSize[9],equals[newpass]] text-input"></td>
									</tr>
									
							</tbody>
							</table>
							    <br>
									<div class="alignright">
										<input type="submit" id="submit" name="send" value="Suivant &raquo;" />
									</div>
						</div>
						</article>
						
	<?}elseif($post['step']==4){?>
						<article class="col-2">
							<div class="col_title">Mot de passe oubli&egrave; Etape Final</div>
							<div class="col_text">
								<p class="pm">
										Vous avez modifié le mot de passe de votre compte avec succes.
									</p>
									
									<p class="pm">
										Si vous n'avez pas demandé de modifier votre mot passe, veuillez contacter le service client imidiatement.</p>
									</p>

							</div>
						</article>
<?}?>
<?}else{?>SECURITY ALERT: Access Denied<?}?>
 <div class="clr"></div>

</div>

<!-- End content  -->
