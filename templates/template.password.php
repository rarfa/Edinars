<script>
            jQuery(document).ready(function(){
                // binds form submission and fields to the validation engine
                jQuery("#pwd-form").validationEngine();
				jQuery("#sec-form").validationEngine();
		    });
			
</script>
<!-- Start content  -->
<div class="content">
<br />
<?if(isset($data['ScriptLoaded'])){?>
	<?if(!$data['PostSent']){?>
			    <center>
				  <?if($data['Error']){?>
						<br>
							<div class="ui-widget">
							<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
								<p><span class="ui-icon ui-icon-alert" style="float: centre; margin-right: .3em;"></span> 
								<?=prntext($data['Error'])?>.</p>
							</div>
							</div>
							<br>
					<?}?>
<!-- ############# admin_box start ############# -->
		<div class="admin_box">
			<!-- ############# admin_box_header start ############# -->
			<div class="admin_box_header">
				<div class="box_header_left">
					<div class="header_tabs"><!-- add tabs in this div -->
						<a href="#tab01" class="default_tab current" onclick="jQuery('#pwd-form').validationEngine('hide');jQuery('#sec-form"').validationEngine('hide');" ><span class="tab">Mot de Passe</span><span class="tab_right"></span></a>
						<a href="#tab02" onclick="jQuery('#pwd-form').validationEngine('hide');jQuery('#sec-form"').validationEngine('hide');"><span class="tab">Question de S&egrave;curit&egrave;</span><span class="tab_right"></span></a>
					</div>
				</div>                
			</div>
			<!-- ############# admin_box_header end ############# -->
			<!-- ############# content_box start ############# -->
			<div class="content_box">
				<div id="tab01" class="content default_tab">
					<center>
					<br class="clear" />
					  <form method="post"  id="pwd-form">
						<table class="common_table_detail">
							<thead>
								<tr>
									<th class="code_col" colspan="2">Mot de Passe</th>
								</tr>
								<tr>
									<th class="code_col" colspan="2">
										Votre mot de passe est sensible &agrave; la casse et doit &ecirc;tre d'au moins 9 caract&egrave;res, y compris au moins une lettre (AZ),
										un chiffre (0-9) et l'un des caract&egrave;res sp&egrave;ciaux suivants:
										<br>!=+*;:-,._{[()]}#%?@
									</th>
								</tr>
							</thead>
							<tbody>
									<tr>	
										<td>Ancien mot de passe(*) :</td>
										<td><input type="password" id="opass" name="opass" size="30" maxlength="100" value="<?=prntext($post['opass'])?>" class="validate[required,optional,minSize[9]] text-input"></td>
									</tr>
									<tr>	
										<td>Nouveau mot de passe (*):</td>
										<td><input type="password" id="npass" name="npass" size="30" maxlength="100" value="<?=prntext($post['npass'])?>" class="validate[required,optional,minSize[9]] text-input" ></td>
									</tr>
									<tr>	
										<td>Re-enter Nouveau mot de passe (*):</td>
										<td><input type="password" id="cpass" name="cpass" size="30" maxlength="100" value="<?=prntext($post['cpass'])?>" class="validate[required,minSize[9],equals[npass]] text-input"></td>
									</tr>									
									<tr>
										<td colspan="2" class="middle">
												<input type="hidden" name="change" value="pwd" >
												<input type="submit" id="submit" name="send" value="sauvegarder" />
										</td>
									</tr>
							</tbody>
						</table>
						</form>		 
						
					</center>	
						<br class="clear" />
				</div>
				
				<div id="tab02" class="content">
						<center>
						<br class="clear" />
						<form method="post" id="sec-form" >
						<table class="common_table_detail">
						<thead>
							<tr>
								<th class="code_col" colspan="2">Question de S&egrave;curit&egrave;</th>
							</tr>
							<tr>
								<th class="code_col" colspan="2">
									Si vous oubliez votre mot de passe, nous allons vous poser la question que vous soumettez ci-dessous. S'il vous pla&icirc;t, essayez de trouver une question 
									personnelle et une r&egrave;ponse qui vous seul connaissez.
								</th>
							</tr>
						</thead>
						<tbody>
								<tr>
									<td nowrap>Question de S&egrave;curit&egrave;(*):</td>
									<td>
									<select name="question" id="question" class="validate[required]" ><?=showselect($data['question'], $post['question'])?></select>
									</td>
								</tr>
								<tr>
									<td nowrap>R&egrave;ponse de s&egrave;curit&egrave; (*):</td>
									<td><input type="text" id="answer" name="answer" size="30" maxlength="255" value="" class="validate[required] text-input"></td>
								</tr>	
								<tr>
									<td colspan="2" class="middle">
										<input type="hidden" name="change" value="answer" >
										<input type="submit" id="submit" name="send" value="sauvegarder" />
									</td>
								</tr>									
						</tbody>
						</table>
						</form>		 
					
					<br class="clear" />
				</center>
						
				</div>
			
				<br class="clear" />
				</div>
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

		</center>
	<?}else{?>
				<center>
				<br>
					<div class="ui-widget">
						<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
							<p><span class="ui-icon ui-icon-alert" style="float: centre; margin-right: .3em;"></span> 
							Votre s&egrave;curite&egrave; d'acc&egrave;s &egrave;t&egrave; modifier.</p>
						</div>
					</div>
					<br>
					<!-- ############# admin_box start ############# -->
		<div class="admin_box">
			<!-- ############# admin_box_header start ############# -->
			<div class="admin_box_header">
				<div class="box_header_left">
					<div class="header_tabs"><!-- add tabs in this div -->
						<a href="#tab01" class="default_tab current" onclick="jQuery('#pwd-form').validationEngine('hide');jQuery('#sec-form"').validationEngine('hide');" ><span class="tab">Mot de Passe</span><span class="tab_right"></span></a>
						<a href="#tab02" onclick="jQuery('#pwd-form').validationEngine('hide');jQuery('#sec-form"').validationEngine('hide');"><span class="tab">Question de S&egrave;curit&egrave;</span><span class="tab_right"></span></a>
					</div>
				</div>                
			</div>
			<!-- ############# admin_box_header end ############# -->
			<!-- ############# content_box start ############# -->
			<div class="content_box">
				<div id="tab01" class="content default_tab">
					<center>
					<br class="clear" />
					  <form method="post"  id="pwd-form">
						<table class="common_table_detail">
							<thead>
								<tr>
									<th class="code_col" colspan="2">Mot de Passe</th>
								</tr>
								<tr>
									<th class="code_col" colspan="2">
										Votre mot de passe est sensible &agrave; la casse et doit &ecirc;tre d'au moins 9 caract&egrave;res, y compris au moins une lettre (AZ),
										un chiffre (0-9) et l'un des caract&egrave;res sp&egrave;ciaux suivants:
										<br>!=+*;:-,._{[()]}#%?@
									</th>
								</tr>
							</thead>
							<tbody>
									<tr>	
										<td>Ancien mot de passe(*) :</td>
										<td><input type="password" id="opass" name="opass" size="30" maxlength="100" value="<?=prntext($post['opass'])?>" class="validate[required,optional,minSize[9]] text-input"></td>
									</tr>
									<tr>	
										<td>Nouveau mot de passe (*):</td>
										<td><input type="password" id="npass" name="npass" size="30" maxlength="100" value="<?=prntext($post['npass'])?>" class="validate[required,optional,minSize[9]] text-input" ></td>
									</tr>
									<tr>	
										<td>Re-enter Nouveau mot de passe (*):</td>
										<td><input type="password" id="cpass" name="cpass" size="30" maxlength="100" value="<?=prntext($post['cpass'])?>" class="validate[required,minSize[9],equals[npass]] text-input"></td>
									</tr>									
									<tr>
										<td colspan="2" class="middle">
												<input type="hidden" name="change" value="pwd" >
												<input type="submit" id="submit" name="send" value="sauvegarder" />
										</td>
									</tr>
							</tbody>
						</table>
						</form>		 
						
					</center>	
						<br class="clear" />
				</div>
				
				<div id="tab02" class="content">
						<center>
						<br class="clear" />
						<form method="post" id="sec-form" >
						<table class="common_table_detail">
						<thead>
							<tr>
								<th class="code_col" colspan="2">Question de S&egrave;curit&egrave;</th>
							</tr>
							<tr>
								<th class="code_col" colspan="2">
									Si vous oubliez votre mot de passe, nous allons vous poser la question que vous soumettez ci-dessous. S'il vous pla&icirc;t, essayez de trouver une question 
									personnelle et une r&egrave;ponse qui vous seul connaissez.
								</th>
							</tr>
						</thead>
						<tbody>
								<tr>
									<td nowrap>Question de S&egrave;curit&egrave;(*):</td>
									<td>
									<select name="question" id="question" class="validate[required]" ><?=showselect($data['question'], $post['question'])?></select>
									</td>
								</tr>
								<tr>
									<td nowrap>R&egrave;ponse de s&egrave;curit&egrave; (*):</td>
									<td><input type="text" id="answer" name="answer" size="30" maxlength="255" value="" class="validate[required] text-input"></td>
								</tr>	
								<tr>
									<td colspan="2" class="middle">
										<input type="hidden" name="change" value="answer" >
										<input type="submit" id="submit" name="send" value="sauvegarder" />
									</td>
								</tr>									
						</tbody>
						</table>
						</form>		 
					
					<br class="clear" />
				</center>
						
				</div>
			
				<br class="clear" />
				</div>
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

		 </center>
	<?}?>
<?}else{?>SECURITY ALERT: Access Denied<?}?>
</div>

<!-- End content  -->
