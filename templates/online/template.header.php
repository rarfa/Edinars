<?if(isset($data['ScriptLoaded'])){?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<html>
<head>
	<title><?=$data['SiteTitle']?> [EDINARS MANAGEMENT]</title>
	<meta http-equiv="pragma" content="no-cache"/>
	<meta http-equiv=Content-Type content="text/html; charset=iso-8859-1">
	    <link rel="stylesheet" type="text/css" href="<?=$data['Host']?>/css-old/style_admin.css">
		<link rel="stylesheet" type="text/css" href="<?=$data['Host']?>/css-old/style_admin1_old.css">
	<?if(!$data['HideMenu']){?>
		<link rel="stylesheet" type="text/css" href="<?=$data['Host']?>/css-old/style_menu.css" />
		<link rel="stylesheet" type="text/css" href="<?=$data['Host']?>/css-old/megamenu.css" />
		<link rel="stylesheet" type="text/css" href="<?=$data['Host']?>/css-old/graph_admin.css" />
	
		<link rel="stylesheet" type="text/css" href="<?=$data['Host']?>/css-old/style_table_admin.css" />
		<link rel="stylesheet" type="text/css" href="<?=$data['Host']?>/css-old/green.css" />
		
		<link rel="stylesheet" type="text/css" href="<?=$data['Host']?>/css-old/validationEngine.jquery.css" />
		
		
<!--[if lte IE 6]>
<link href="<?=$data['Host']?>/css/green_ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
		
		<script type="text/javascript" language="JavaScript" src="<?=$data['Host']?>/js-old/jquery-1.6.min.js"></script>
		<script type="text/javascript" language="JavaScript" src="<?=$data['Host']?>/js-old/AdminScript.js"></script>

		 <script type="text/javascript" src="<?=$data['Host']?>/js-old/jquery.validationEngine-fr.js"  charset="utf-8"></script>
		<script type="text/javascript" src="<?=$data['Host']?>/js-old/jquery.validationEngine.js" charset="utf-8"></script>

	
	<? } ?>
	

	<script type="text/javascript" language="JavaScript">document.oncontextmenu=new Function("return false")</script>
	<script type="text/javascript">function s(){window.status="<?=$data['SiteTitle']?>[ADMINISTRATION]";return true};if(document.layers)document.captureEvents(Event.MOUSEOVER|Event.MOUSEOUT|Event.CLICK|Event.DBLCLICK);document.onmouseover=s;document.onmouseout=s;</script>

	
	<script>
            jQuery(document).ready(function(){
                // binds form submission and fields to the validation engine
                jQuery("#topup-form").validationEngine();
            });
</script>	
			
	</head>
	
<body topmargin="0"  leftmargin="0" marginwidth="0" marginheight="0" bgcolor="#FFFFFF">
	       
		<div id="wrap">
		 
	   <center>
		
		  
			<table width=98% border=0 cellspacing=0 cellpadding=4>
				<tr>
					
					<?if(!$data['HideMenu']){?>
					    <td nowrap><b>EDINARS MANAGEMENT</b></td>
						<td align=right nowrap><b>VOTRE SOLDE ACTUEL: <?=prnpays($data['SystemBalance'])?></b></td>
					<?}?>
				</tr>
			</table>
			
			<br>
			
				<?if(!$data['HideMenu']){?>
					<div id="megamenu" class="megamenu megamenu_green">
					<ul>
					 <!--
						<li><a href="#">&nbsp;CONFIGURATION</a>
							<div class="submenu" align="left">
								<a<?if($data['PageFile']=='index'){?> style="color:#FF3399"<?}?> href="<?=$data['Admins']?>/index.php">&nbsp;&middot;&nbsp;HOME</a>
								<a href="<?=$data['Admins']?>/main-conf.php#general">&nbsp;&middot;&nbsp;GENERAL</a>
								<a href="<?=$data['Admins']?>/main-conf.php#additional">&nbsp;&middot;&nbsp;ADDITIONAL</a>
								<a href="<?=$data['Admins']?>/main-conf.php#currency">&nbsp;&middot;&nbsp;CURRENCY</a>
								<a href="<?=$data['Admins']?>/main-conf.php#signup">&nbsp;&middot;&nbsp;SIGNUP</a>
								<a href="<?=$data['Admins']?>/main-conf.php#payments">&nbsp;&middot;&nbsp;PAYMENTS</a>
								<a href="<?=$data['Admins']?>/main-conf.php#deposit">&nbsp;&middot;&nbsp;DEPOSIT</a>
								<a href="<?=$data['Admins']?>/main-conf.php#withdraw">&nbsp;&middot;&nbsp;WITHDRAW</a>
								<a href="<?=$data['Admins']?>/main-conf.php#affiliate">&nbsp;&middot;&nbsp;AFFILIATE</a>
								<a href="<?=$data['Admins']?>/main-conf.php#advertising">&nbsp;&middot;&nbsp;ADVERTISING</a>
								<hr style="color:#CCCCFF">
								<a<?if($data['PageFile']=='mail-conf'){?> style="color:#FF3399"<?}?> href="<?=$data['Admins']?>/mail-conf.php">&nbsp;&middot;&nbsp;E-MAIL TEMPLATES</a>
								<?if($data['HotNewsSection']){?>
									
										<a<?if($data['PageFile']=='news'){?> style="color:#FF3399"<?}?> href="<?=$data['Admins']?>/news.htm">&nbsp;&middot;&nbsp;HOT&nbsp;NEWS</a>
									    <a<?if($data['PageFile']=='faqs'){?> style="color:#FF3399"<?}?> href="<?=$data['Admins']?>/faqs.htm">&nbsp;&middot;&nbsp;FAQs</a>
							    <?}?>
							</div>
						</li>
					-->	
						<li><a href="#">&nbsp;MANAGEMENT</a>
							<div class="submenu" align="left">
						        <a href="<?=$data['Admins']?>/transactions.php?action=summary">&nbsp;&middot;&nbsp;SOMMAIRE</a><br>
								<a href="<?=$data['Admins']?>/transactions.php?action=select">&nbsp;&middot;&nbsp;TRANSACTIONS</a><br>
								<a href="<?=$data['Admins']?>/transactions.php?type=1&action=select">&nbsp;&middot;&nbsp;DEPOT</a><br>
								<a href="<?=$data['Admins']?>/transactions.php?type=2&action=select">&nbsp;&middot;&nbsp;RETIRER</a><br>
								<a href="<?=$data['Admins']?>/transactions.php?type=4&action=select">&nbsp;&middot;&nbsp;INSCRIPTIONS</a><br>
								<a href="<?=$data['Admins']?>/transactions.php?type=5&action=select">&nbsp;&middot;&nbsp;COMMISSIONS</a><br>
								<a href="<?=$data['Admins']?>/transactions.php?type=-1&status=3&action=select">&nbsp;&middot;&nbsp;REMBOURSEMENT</a>
								<hr style="color:#CCCCFF">
								<a href="<?=$data['Admins']?>/investment.php">&nbsp;&middot;&nbsp;INVESTISSEMENT</a><br>
								<a href="<?=$data['Admins']?>/topup.php">&nbsp;&middot;&nbsp;CARTE DE RECHARGE</a><br>
								<a href="<?=$data['Admins']?>/payment.php">&nbsp;&middot;&nbsp;PAIEMENT&nbsp;UNIQUE</a><br>
								<a href="<?=$data['Admins']?>/payments.php">&nbsp;&middot;&nbsp;PAIEMENTS&nbsp;DE&nbsp;MASSE</a><br>
								<a href="<?=$data['Admins']?>/mass-mail.php">&nbsp;&middot;&nbsp;EMAILING</a>
							
							</div>
						</li>
						<li><a href="#">&nbsp;MEMBRES</a>
							<div class="submenu" align="left">
						        <a href="<?=$data['Admins']?>/members.php?action=select&type=active">&nbsp;&middot;&nbsp;ACTIF</a><br>
								<a href="<?=$data['Admins']?>/members.php?action=select&type=suspended">&nbsp;&middot;&nbsp;SUSPENDU</a><br>
								<a href="<?=$data['Admins']?>/members.php?action=select&type=closed">&nbsp;&middot;&nbsp;FERMÉ</a><br>
								<a href="<?=$data['Admins']?>/members.php?action=select&type=online">&nbsp;&middot;&nbsp;ONLINE</a><br>
								<a href="<?=$data['Admins']?>/members.php?action=search">&nbsp;&middot;&nbsp;RECHERCHE</a><br>
							</div>
						</li>
						<!--
						<li><a href="#">&nbsp;UTULISATEURS</a>
							<div class="submenu" align="left">
						    
							</div>
						</li>
						-->
						<li><a href="#">&nbsp;VENDEUR</a>
							<div class="submenu" align="left">
								<a href="<?=$data['Admins']?>/shopcategories.php?action=view">&nbsp;&middot;&nbsp;MANAGEMENT</a> <br>
								<a href="<?=$data['Admins']?>/shopcategories.php?action=search">&nbsp;&middot;&nbsp;RECHERCHE</a>
							</div>
						</li>
						
						<?if($data['Advertising']){?>
							<li><a href="#">&nbsp;PUBLICIT&Egrave;</a>
							<div class="submenu" align="left">
									<a href="<?=$data['Admins']?>/advertising.php">&nbsp;&middot;&nbsp;MANAGEMENT </a> 
							</div>
						</li>
						<?}?>
						
						
						<li class="right" ><a href="<?=$data['Admins']?>/logout.php">&nbsp;D&Egrave;CONNEXION</a>
						</li>
						
						<?if($data['LiveSupport']){?>
							<li class="right"><a href="#">&nbsp;LIVE SUPPORT</a>
								<div class="submenu" align="right">
									<a href="<?=$data['Admins']?>/support/index.htm">&nbsp;&middot;&nbsp;ADMIN AREA</a>
								</div>
							</li>
						<?}?>
						<li class="right"><a href="#">FAQ</a>
							<div class="submenu" align="right">
								<a href="<?=$data['Admins']?>/faq_section.php">&nbsp;&middot;&nbsp;FAQ SECTION</a> |
								<a href="<?=$data['Admins']?>/faq_list.php">&nbsp;&middot;&nbsp;FAQ LIST</a>
							</div>
						</li>
					</ul>
				<div class="clearer"></div>
				</div>
					
			<?}?>
			<br><br><br>
			
<?}else{?>SECURITY ALERT: Access Denied<?}?>