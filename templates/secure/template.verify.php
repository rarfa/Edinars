<!-- Start content  -->
<div class="content">
<br />
<?if(isset($data['ScriptLoaded'])){?>
<?if($post['action']=='verify'){?>
 <p class="title">Mon compte > Verifier</p>
		<div id="tabs">
				<ul>
					<li><a href="#tabs-1">Verifier Mon compte Edinars</a></li>
				</ul>
				<div id="tabs-1">
					Information what documents members should send to site administrator to verify his account...
				</div>
		</div>		
<?}elseif($post['action']=='certify'){?>
 <p class="title">Mon compte > Certifie</p>
		<div id="tabs">
				<ul>
					<li><a href="#tabs-1">Certifier Mon compte Edinars</a></li>
				</ul>
				<div id="tabs-1">
					Information what documents members should send to site administrator to verify his account...
				</div>
		</div>		

<?}else{?>
	Information what documents members should send to site administrator to certify his account...
<?}?><?}else{?>SECURITY ALERT: Access Denied<?}?>
</div>

<!-- End content  -->
