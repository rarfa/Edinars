<script>
            jQuery(document).ready(function(){
                // binds form submission and fields to the validation engine
                jQuery("#email-form").validationEngine();
		    });
			
</script>
<!-- Start content  -->
<div class="container">
<br />
<?if(isset($data['ScriptLoaded'])){?>
	<?if(!$data['PostSent']){?>
		<? if(!$data['action']){?>	
		<?if($data['Error']){?>
											<tr>
											<th class="code_col" colspan="2">
												<center>
												<br>
														<div class="ui-widget">
														<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
															<p><span class="ui-icon ui-icon-alert" style="float: centre; margin-right: .3em;"></span> 
															<?=prntext($data['Error'])?>.</p>
														</div>
														</div>
														<br>
											</center>	
											</th>
										</tr>
										<?}elseif(isset($_POST['addnow'])) {?>
											<tr>
											<th class="code_col" colspan="2">
												<center>
														<div class="ui-widget">
														<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;"> 
														<p><span class="ui-icon ui-icon-info" style="float: centre; margin-right: .3em;"></span>
															Nouvelle adresse e-mail a &egrave;t&egrave; soumise avec succ&egrave;s. V&egrave;rifiez votre e-mail pour l'activer.
															</p>
														</div>
														</div>
														<br>
												</center>	
											</th>
										</tr>
										<?}elseif(isset($_GET['c'])) {?>
											<tr>
											<th class="code_col" colspan="2">
												<center>
														<div class="ui-widget">
														<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;"> 
														<p><span class="ui-icon ui-icon-info" style="float: centre; margin-right: .3em;"></span>
															Votre nouvelle adresse e-mail a &egrave;t&egrave; activ&egrave; avec succ&egrave;s.
															</p>
														</div>
														</div>
														<br>
												</center>	
											</th>
										</tr>
										<?}elseif(isset($_POST['primbtn'])) {?>
											<tr>
											<th class="code_col" colspan="2">
												<center>
														<div class="ui-widget">
														<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;"> 
														<p><span class="ui-icon ui-icon-info" style="float: centre; margin-right: .3em;"></span>
															Votre d&egrave;faut adresse e-mail a &egrave;t&egrave; chang&egrave; avec succ&egrave;s.
															</p>
														</div>
														</div>
														<br>
												</center>	
											</th>
										</tr>
										<?}elseif(isset($_POST['deletebtn'])) {?>
											<tr>
											<th class="code_col" colspan="2">
												<center>
													<div class="ui-widget">
														<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;"> 
														<p><span class="ui-icon ui-icon-info" style="float: centre; margin-right: .3em;"></span>
																Votre e-mail a &egrave;t&egrave; supprim&egrave; avec succ&egrave;s.
															</p>
														</div>
														</div>
														<br>
													</center>	
												</th>
											</tr>
										<?}?>		
			<!-- ############# admin_box start ############# -->
				<div class="admin_box">
					<!-- ############# admin_box_header start ############# -->
					<div class="admin_box_header">
						<div class="box_header_left">
							<div class="header_tabs"><!-- add tabs in this div -->
								<a href="#tab01" class="default_tab current" onclick="jQuery('#sigup-form-step1').validationEngine('hide');jQuery('#sigup-form-step2').validationEngine('hide');jQuery('#sigup-form-step3').validationEngine('hide')<?php if($post['type'] == 1){?> ;jQuery('#sigup-form-step4').validationEngine('hide')<?php } ?> " ><span class="tab">G&egrave;rer&nbsp;Emails</span><span class="tab_right"></span></a>
							    <a href="<?=$data['Members']?>/mes-emails-Edinars.html/ajouter" class="no_submenu" ><span class="tab">Ajouter Email</span><span class="tab_right"></span></a>
							</div>
						</div>                
					</div>
					
					<!-- ############# admin_box_header end ############# -->
						
						
					<!-- ############# content_box start ############# -->
					<div class="content_box">
						<div id="tab01" class="content default_tab">
						<center>
						  <br class="clear" />
							
							<form method="post"  action="#tabs-1" id="sigup-form-step1" >
							<table class="common_table_detail">
								<thead>
									<tr>
										<th class="code_col" colspan="2">Mes Email</th>
									</tr>
								
											
								</thead>
								<tbody>
										<? foreach($data['emails'] as $ind=>$email) {?>
										 <tr>
											<td><input type="radio" name="choice" value="<?=$email['email']?>"> </td>
											<td><b><?=$email['email']?> </b>
													<? if(!$email['active']) echo("Non confirm&eacute;");
												elseif($email['primary']) echo("Primaire");
												else echo("Confirm&eacute;e");
												?>
											</td>	
										</tr>	
										<?}?>
										<tr>
											<td colspan="2" class="middle">
												<input type="submit" id="submit" name="deletebtn" value="SUPPRIMER" />
												<input type="submit" id="submit" name="primbtn" value="R&eacute;eglez primaires" />
									
											</td>
										</tr>
									</tbody>
								</table>
							
								</form>		 
								<br>
							</center>
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
				
		<? } else { ?>
			<?if($data['Error']){?>
						
								<center>
								<br>
								<div class="ui-widget">
								<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
									<p><span class="ui-icon ui-icon-alert" style="float: centre; margin-right: .3em;"></span> 
									<?=prntext($data['Error'])?>.</p>
								</div>
								</div>
								<br>
						<?}elseif(isset($_POST['addnow'])) {?>
							<center>
								<div class="ui-widget">
								<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;"> 
								<p><span class="ui-icon ui-icon-info" style="float: centre; margin-right: .3em;"></span>
									Nouvelle adresse e-mail a &egrave;t&egrave; soumise avec succ&egrave;s. V&egrave;rifiez votre e-mail pour l'activer.
									</p>
								</div>
								</div>
								<br>
						<?}elseif(isset($_GET['c'])) {?>
									<center>
								<div class="ui-widget">
								<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;"> 
								<p><span class="ui-icon ui-icon-info" style="float: centre; margin-right: .3em;"></span>
									Votre nouvelle adresse e-mail a &egrave;t&egrave; activ&egrave; avec succ&egrave;s.
									</p>
								</div>
								</div>
								<br>
						<?}elseif(isset($_POST['primbtn'])) {?>
									<center>
								<div class="ui-widget">
								<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;"> 
								<p><span class="ui-icon ui-icon-info" style="float: centre; margin-right: .3em;"></span>
									Votre d&egrave;faut adresse e-mail a &egrave;t&egrave; chang&egrave; avec succ&egrave;s.
									</p>
								</div>
								</div>
								<br>
								</center>	
						<?}elseif(isset($_POST['deletebtn'])) {?>
								<center>
									<div class="ui-widget">
										<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;"> 
										<p><span class="ui-icon ui-icon-info" style="float: centre; margin-right: .3em;"></span>
												Votre e-mail a &egrave;t&egrave; supprim&egrave; avec succ&egrave;s.
											</p>
										</div>
										</div>
										<br>
									</center>	
						<?}?>
				<!-- ############# admin_box start ############# -->
				<div class="admin_box">
					<!-- ############# admin_box_header start ############# -->
					<div class="admin_box_header">
						<div class="box_header_left">
							<div class="header_tabs"><!-- add tabs in this div -->
								<a href="<?=$data['Members']?>/mes-emails-Edinars.html/"  class="no_submenu"  onclick="jQuery('#sigup-form-step1').validationEngine('hide');jQuery('#sigup-form-step2').validationEngine('hide');jQuery('#sigup-form-step3').validationEngine('hide')<?php if($post['type'] == 1){?> ;jQuery('#sigup-form-step4').validationEngine('hide')<?php } ?> " ><span class="tab">G&egrave;rer&nbsp;Emails</span><span class="tab_right"></span></a>
								<a href="<?=$data['Members']?>/mes-emails-Edinars.html/ajouter" class="default_tab current" ><span class="tab">Ajouter Email</span><span class="tab_right"></span></a>
						
							</div>
						</div>                
					</div>
					<!-- ############# admin_box_header end ############# -->
					<!-- ############# content_box start ############# -->
					<div class="content_box">
					
						<div id="tab01" class="content default_tab">
						<center>
						  <br class="clear" />
							<form method="post" action="#tabs-1" id="email-form">
							<input type="hidden" name="action" value="add">
							<table class="common_table_detail">
								<thead>
									<tr>
										<th class="code_col" colspan="2">Ajouter Email</th>
									</tr>
												
											
								</thead>
								<tbody>
									<tr>
										<td colspan="2"  class="middle">S'il vous pla&icirc;t saisissez votre Email address</td>
									</tr>
									<tr>									
										<td colspan="2"  class="middle"><input type="text" name="newmail" id="newmail" size="41" maxlength="32" class="validate[required,custom[email]] text-input"></td>
									</tr>
									<tr>
										<td colspan="2" class="middle"><input type="submit" id="submit" name="addnow" value="Ajouter" /></td>
									</tr>
								</tbody>
							</table>
							<br class="clear" />
						</center>
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


		<? } ?>
<?}?><?}else{?>SECURITY ALERT: Access Denied<?}?>
</div>

<!-- End content  -->

