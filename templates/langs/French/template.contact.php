
<!-- Start content  -->

<div class="content">
	<article class="col-1">
		<div class="col_title">Postal Adresse</div>
		<div class="col_text">
			<p class="pm">
								
		
			</p>
		</div>
	</article>
	<article class="col-2">
		<div class="col_title">Contacter Edinars</div>
		<div class="col_text">
			<form method=post id="sigup-form">
				<?if(!$data['PostSent']){?>	
							<div class="box-right-middle  col-2 "> 
							<div class="left"> 
								<div class="right">
									<br>
									<center>
									 <p class="pm">
									<?if($data['Error']){?>
									<br>
									<div class="ui-widget">
									<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;width:350px"> 
										<p><span class="ui-icon ui-icon-alert" style="float: centre; margin-right: .3em;"></span> 
										<?=prntext($data['Error'])?>.</p>
									</div>
									</div>
									<br>
									<?}?>
									</center>
								</p>
									<p class="pm">
										<table id="hor-minimalist-a" summary="PROFILE">
									<tbody>
									<tr>
										<td>Nom (*) :</td>
										<td><input type="text"  id="nom" name="nom" size="35" maxlength="50" value="<?=prntext($post['nom'])?>" class="validate[required] text-input"></td>
									</tr>
									<tr>
										<td>E-Mail Adresse (*):</td>
										<td><input type="text" id="mail" name="mail" size="35" maxlength="50" value="<?=prntext($post['mail'])?>" class="validate[required,custom[email]] text-input"></td>
									</tr>
									<tr>
										<td>Telephone (*):</td>
										<td><input type="text" id="phone" name="phone" size="35" maxlength="50" value="<?=prntext($post['phone'])?>" class="validate[required,custom[phone]] text-input" ></td>
									</tr>
									<tr>
										<td>Message (*):</td>
										<td><textarea id="msg" name="msg" class="validate[required] text-input"s></textarea>
											
										</td>
									</tr>
									</tbody>
								</table>
								</p>
									<div class="alignright">
										<input type="submit" id="submit" name="send" value="Contacter Edianrs" />
									</div>
								<br><br>
								</div>
								</div>
							</div>	
						<?}else{?>
							<div class="box-right-middle  col-2 "> 
							<div class="left"> 
								<div class="right">
									<br>
								<p class="pm">
								  Contact a ete envoiye 
								
								</p>									
								<br><br>
								</div>
								</div>
							</div>

						<?}?>	
				<BR>
			</form>	
		</div>
	</article>
	<div class="clr"></div>

</div>

<!-- End content  -->
