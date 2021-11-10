<section id="content"><div class="inner_copy"><div class="inner_copy"></a></div></div>
		<div class="container">
			<div class="inside">
					 <? showbar ($data['PageFile'])?>
				<div class="inside1">
					<div class="wrap row-2">
						<article class="col-1-login">
						
<?if(isset($data['ScriptLoaded'])){?>
<?if($post['action']=='verify'){?>
 <p class="title">Mon compte > Verifier</p>
		<div id="tabs">
				<ul>
					<li><a href="#tabs-1">Verifier Mon compte Erecovery</a></li>
				</ul>
				<div id="tabs-1">
					Information what documents members should send to site administrator to verify his account...
				</div>
		</div>		
<?}elseif($post['action']=='certify'){?>
 <p class="title">Mon compte > Certifie</p>
		<div id="tabs">
				<ul>
					<li><a href="#tabs-1">Certifier Mon compte Erecovery</a></li>
				</ul>
				<div id="tabs-1">
					Information what documents members should send to site administrator to verify his account...
				</div>
		</div>		

<?}else{?>
	Information what documents members should send to site administrator to certify his account...
<?}?><?}else{?>SECURITY ALERT: Access Denied<?}?>
</article>
						
						<div class="clear"></div>

</div>
				</div>
			</div>
		</div>
	</section>
</div>