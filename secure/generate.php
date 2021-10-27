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
$data['PageName']='CODE HTML POUR BUTTON';
$data['PageFile']='generate';
###############################################################################
include('../config.php');
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
$data['Balance']=select_balance($uid);
$data['Balance-disponible']=select_balance_disponible($uid);

$paths=array(0=>$data['SinBtns'],1=>$data['SubBtns'],2=>$data['DonBtns']);
if($post['gid']){

	$type=select_type($post['gid']);
	$tname=$data['PaymentType'][$type];
	$bpath=
	$button=select_button($post['gid']);
	
	$strToCrypt = "action={$tname}|" ;
	$strToCrypt .= "identifiant=".get_member_username($uid)."|" ;
	$strToCrypt .= "produit=".$post['gid'] ;
	
	$strToCrypt = encryptPerHashKey (get_member_username_pincode($uid) , $strToCrypt)  ;
	

	$post['PostHtmlCode']=
		"<!-- {$data['SiteName']} FORMULAIRE DE PAIEMENT METHODE POST-->\n".
		"<form method='post' action='{$data['Host']}/edinars-paiments.html' target='new'>\n".
		"<input type='hidden' name='pincode'  value='".get_member_username_pincode($uid)."'>\n".
		"<input type='hidden' name='prehashkey'  value='".get_member_username_hashkey($uid)."'>\n".
		"<input type='hidden' name='crypt'  value='".$strToCrypt."'>\n".
		"<input type='image' src='{$paths[$type]}/{$button}' >\n".
		"</form>\n".
		"<!-- {$data['SiteName']}  FORMULAIRE DE PAIEMENT -->"
	;
	
	$post['OrgPostHtml']=$post['PostHtmlCode'];
	$post['PostHtmlCode']=htmlspecialchars($post['PostHtmlCode'], ENT_QUOTES);
	$post['GetHtmlCode']=
		"<!-- {$data['SiteName']} FORMULAIRE DE PAIEMENT  METHODE GET-->\n".
		"<a href={$data['Host']}/edinars-paiments.html?pincode=".get_member_username_pincode($uid)."&prehashkey=".get_member_username_hashkey($uid)."&crypt=".$strToCrypt."&send=yes target=new>\n".
		"<img src={$paths[$type]}/{$button} >\n".
		"</a>".
		"\n<!-- {$data['SiteName']} FORMULAIRE DE PAIEMENT -->"
	;
	$post['OrgGetHtml']=$post['GetHtmlCode'];
	if($post['status']=='crypt'){
      $post['GetHtmlCode']=
         "<!-- {$data['SiteName']} FORMULAIRE DE PAIEMENT -->\n".
         encrypt($post['GetHtmlCode']).
         "\n<!-- {$data['SiteName']} FORMULAIRE DE PAIEMENT -->"
      ;
   }
	$post['GetHtmlCode']=htmlspecialchars($post['GetHtmlCode'], ENT_QUOTES);
	$post['BackPage']=$post['action'];
}
###############################################################################
display('secure');
###############################################################################
?>

