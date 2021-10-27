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
$data['PageName']='HTML CODE POUR PAIMENT SIMPLE';
$data['PageFile']='payment';
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
$post=select_info($uid, $post);

$data['Balance']=select_balance($uid);
$data['Balance-disponible']=select_balance_disponible($uid);

$strToCrypt = "action={$tname}|" ;

$post['HtmlCode']=htmlspecialchars(
	"<!-- {$data['SiteName']} FORMULAIRE DE PAIEMENT  -->\n".
	"<form method=post action={$data['Host']}/edinars-paiments.html>\n".
	"<input type='hidden' name='pincode'  value='".get_member_username_pincode($uid)."'>\n".
    "<input type='hidden' name='prehashkey'  value='".get_member_username_hashkey($uid)."'>\n".
	"<input type='hidden' name='crypt'  value='".$strToCrypt."'>\n".
	"<input type='hidden' name='action' value=\"produit/donation/abonnement/paiement\">\n".
	"<input type='hidden' name='commande' value=\"--NUMERO-DE-COMMANDE--\">\n".
	"<input type='hidden' name='produit' value=\"--NOM-DE-PRODUIT-SERVICE--\">\n".
	"<input type='hidden' name='prix' value=\"--PRIX--\">\n".
	"<input type='hidden' name='quantite' value=\"--QUANTITE--\">\n".
	"<input type='hidden' name='periode' value=\"--PERIODE--\">\n".
	"<input type='hidden' name='essai' value=\"--P&Eacute;RIODE D'ESSAI--\">\n".
	"<input type='hidden' name='installation' value=\"--FRAIS-D'INSTALLATION--\">\n".
	"<input type='hidden' name='tva' value=\"--FRAIS-DE-TVA--\">\n".
	"<input type='hidden' name='livraison' value=\"--FRAIS-DE-LIVRAISON--\">\n".
	"<input type='hidden' name='ureturn' value=\"--RETURN-URL--\">\n".
	"<input type='hidden' name='unotify' value=\"--NOTIFY-URL--\">\n".
	"<input type='hidden' name='ucancel' value=\"--CANCEL-URL--\">\n".
	"<input type='hidden' name='comments' value=\"--YOUR-COMMENTS--\">\n".
	"<input type='image' src=\"--VOTRE-BOUTON-ICI--\">\n".
	"</form>\n".
	"<!-- {$data['SiteName']} FORMULAIRE DE PAIEMENT  -->", ENT_QUOTES
);
###############################################################################
display('secure');
###############################################################################
?>
