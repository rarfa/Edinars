<?
#################################################################################
# PROGRAM     : EDINAR APPLICATION                                             	#
# VERSION     : 0.01                                                          	#
# AUTHOR      : Arfa Abderrahim                                               	#
# COMPANY     : HOSTDZ	                                             			#	
# COPYRIGHTS  : (C) HOSTDZ. ALL RIGHTS RESERVED                    				#
#         COPYRIGHTS BY (C)2011 HOSTDZ. ALL RIGHTS RESERVDED  	  				#
###############################################################################
#               	     DEVELOPED BY HOSTDZ             `		        		#
###############################################################################
#    ALL SOURCE CODE, IMAGES, PROGRAMS, FILES INCLUDED IN THIS DISTRIBUTION   	#
#         COPYRIGHTS BY (C)2012 HOSTDZ. ALL RIGHTS RESERVDED  	      			#
###############################################################################
#       ANY REDISTRIBUTION WITHOUT PERMISSION OF HOSTDZ AND IS          		#
#                            STRICTLY FORBIDDEN                                 #
###############################################################################
#         COPYRIGHTS BY (C)2012 HOSTDZ. ALL RIGHTS RESERVDED  	      			#
###############################################################################

###############################################################################
$data['PageName']='SERVICE MERCHANT (VOTRE DONATIONS)';
$data['PageFile']='donations';
###############################################################################
include('../config.php');
include('../plugin/product.php');
include('../plugin/security.php');
###############################################################################
if(!$_SESSION['login']){
	header("Location:{$data['Host']}/acceuil-Edinars.html");
	echo('ACCESS DENIED.');
	exit;
}
###############################################################################
if(is_info_empty($uid)){
	header("Location:{$data['Host']}/secure/mon-profile-Edinars.html");
	echo('ACCESS DENIED.');
	exit;
}
###############################################################################
$post=select_info($uid, $post);
$data['Balance']=select_balance($uid);
$data['Balance-disponible']=select_balance_disponible($uid);
if(!$post['step'])$post['step']=1;
$post['Buttons']=get_files_list($data['DonBtnsPath']);
###############################################################################
if($post['send']){
	if($post['step']==1){
		$post['step']++;
	}elseif($post['step']==2){
		if(!$post['nom']){
			$data['Error']="S'il vous pla&icirc;t saisissez la Donation vers";
		}elseif(get_member_status($uid)<2&&$post['price']>$data['PaymentMaxSum']){
			$data['Error']="Prix pour le produit devrait &ecirc;tre inf&eacute;rieure &agrave;".
				" {$data['PaymentMaxSum']}  {$data['Currency']} ".
				" parce que vous n'etes pas v&eacute;rifi&eacute;es";
		}elseif(!$post['ureturn']){
			$data['Error']="S'il vous pla&icirc;t saisissez l'URL valide pour revenir apr&egrave;s la transaction";
		}elseif(!$post['button']){
			$data['Error']="S'il vous pla&icirc;t choisir l'image pour le bouton de paiement";
		}else{
			if(!$post['gid']) 
			{
				insert_product($uid, 2, $post);
				header("Location:".$data['Members']."/donations-Edinars.html?");
			}
			else 
			{
				update_product($post['gid'], $post);
				header("Location:".$data['Members']."/donations-Edinars.html?#tabs-1");
			}
			$post['step']--;
		}
		$data['Products']=select_products($uid, 2);
	}
}elseif($post['cancel'])$post['step']--;
if($post['action']=='update'){
	$product=select_products($uid, 2, $post['gid'], true);
	foreach($product[0] as $key=>$value)if(!$post[$key])$post[$key]=$value;
	$post['actn']='update';
	$post['step']++;
	$data['Products']=select_products($uid, 2);
}elseif($post['action']=='supprimer'){
	delete_product($post['gid']);
}elseif($post['action']=='add'){
	$post['step']++;
}
if($post['step']==1)$data['Products']=select_products($uid, 2);
###############################################################################
display('secure');
###############################################################################
?>
