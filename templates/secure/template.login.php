<section id="content">
		<div class="container">
			<div class="inside">
				<div id="slogan">
					<div class="inside">
						<h2><span>Your Domain Name</span> Helps the World  to Find You</h2>
						<p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae.</p>
					</div>
				</div>
				<div class="inside1">
					<div class="wrap row-2">
						<article class="col-1">
							<h2>Login</h2>
							<ul class="list1">
								<li><a href="#">Sed ut perspiciatis unde</a></li>
								<li><a href="#">Omnis iste natus error sit volupta</a></li>
								<li><a href="#">Tem accusantium doloreque</a></li>
								<li><a href="#">Laudantiumtotam rem aperiam</a></li>
								<li><a href="#">Eaque ipsa quae</a></li>
								<li><a href="#">Lnventore veritatis et quasi</a></li>
								<li><a href="#">Architecto beatae vitae</a></li>
								<li><a href="#">Dicta sunt explicabo</a></li>
								<li><a href="#">Nemo enim ipsam voluptatem</a></li>
								<li><a href="#">Quia voluptas sit aspernatur</a></li>
								<li><a href="#">Aut odit aut fugit, sed quia</a></li>
								<li><a href="#">Consequuntur magni</a></li>
							</ul>
							<a href="#" class="link2"><span><span>More Solutions</span></span></a> </article>
						<article class="col-2">
							<center>
							<h2>Connection aux compte</h2>
							
<?if(isset($data['ScriptLoaded'])){?>
	<?if(!$data['PostSent']){?>
				<form method=post id="sigup-form">
			    <center>
<?if(!$data['CantLogin']){?>
					<?php if ($data['attempts'] != 0) { ?> 
						<br>
						<div class="ui-widget">
						<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;"> 
							<p><span class="ui-icon ui-icon-info" style="float: centre; margin-right: .3em;"></span>
							 Connection aux compte (ATTEMPT #<?=prnintg($data['attempts'])?>, MAX. <?=prnintg($data['PassAtt'])?>)</p>
						</div>
					  </div>
					    <br>
				  <?}?>
				
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
					 
							<p>
							
								<div class="field text">
														<label>Identifiant (*): \zx\z</label>
														<input type="text" id="username" name="username" size="30" maxlength="128" value="<?=prntext($post['username'])?>">
								</div>
								
								<div class="field text">
														<label>mot de passe (*):</label>
														<input type="password" id="password" name="password" size="30" maxlength="30" value="<?=prntext($post['password'])?>">
													
								</div>
						  
							<?if($data['UseTuringNumber']){?>
							<div class="field text">
									<label>Code de s&egrave;curit&egrave; (*):</label>
									<input type="text" id="turing" name="turing" size="30" maxlength="32">
										
								</div>	
									<div class="ui-widget">
									<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;"> 
										<br>
										<img src="<?=$data['Host']?>/turing.htm" width="150" height="30" border="1">
										<br>
										<p align="center">Dans nos efforts continus pour fournir le service le plus s&egrave;curis&egrave; possible,
										nous avons ajout&egrave; un test de s&egrave;curit&egrave; pour emp&ecirc;cher les enregistrements automatiques.
										Entrez les num&egrave;ros tels qu'ils figurent dans l'image ci-dessous.
										<br>
										
										</p>
								</div>	
								<br>
								
							
							<?}?>
							 </div>
					  
					    <br>
							
							<div class="alignright">
									<a href="#" class="link2" onClick="document.getElementById('sigup-form').submit()"><span><span>Connectez-vous</span></span></a>
									<input type="hidden" name="send" value="Ouvrir un compte" >
							</div>
					   		
				</center>
				
		</form>	
<?}else{?>
<div class="ui-widget">
						<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;"> 
							<p align="center">Vous avez entr&egrave; un mauvais mot de passe environ 5 fois. Probablement vous avez oubli&egrave; votre mot de passe. S'il vous pla&icirc;t utiliser notre syst&egrave;me pour r&egrave;cup&egrave;rer votre mot de passe.
Mot de passe Oublie.
						
							</p>

						</div>
						</div>
					
					<br>
					<a href="forgot.htm" class="link4"><span><span>Mot de passe oublie</span></span></a>
	<?}?>		
<?}else{?>

<?}?>
<?}else{?>SECURITY ALERT: Access Denied<?}?>
							</center>
							
						</article>
						<div class="clear"></div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>


