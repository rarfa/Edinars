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

###############################################################################
$data['PageName']='E-MAILS MANAGER';
$data['PageFile']='emails';
###############################################################################
include('../config.php');
include('../plugin/audit.php');
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

if($post['addnow'] ) {
	$result=add_email($uid,$post['newmail']);
     
	if($result==INVALID_EMAIL_ADDRESS) $data['Error']="L'adresse E-mail que vous avez entr&egrave; n'est pas valide";
	elseif($result==EMAIL_EXISTS) $data['Error']="L'adresse E-mail que vous avez entré est en usage dans le syst&egrave;me";
	elseif($result==TOO_MANY_EMAILS) $data['Error']="Vous ne pouvez pas ajouter plus de {$data['maxemails']} adresses E-mail";
	elseif($result==DB_ERROR) $data['Error']="Une erreur temporaire s'est produite, s'il vous pla&icirc;t r&egrave;essayer plus tard";
	
	if ( $result == SUCCESS) {
			// ajoutre un audit 
				$mcheckinfo = $post['newmail']." E-mail adresse a &egrave;t&egrave; activ&egrave; avec succ&egrave;";
				audit(
						'AJOUTER EMAIL',
						$mcheckinfo,
						'member_emails',
						$uid,
						prnuser($uid)
				   );
	}
	
/* get the confirmation code from the url (link in email)*/
}elseif(isset($_GET['c'])) {
	$code=$_GET['c'];
	$uid=$_GET['u'];
	$result=activate_email($uid,$code);
	if ($result==CONFIRMATION_NOT_FOUND) $data['Error']="Pas de confirmation en attente de proc&egrave;der";
	unset($_GET);
}elseif($post['primbtn']) {
	$result=make_email_prim($uid,$post['choice']);
	if($result==INVALID_EMAIL_ADDRESS) $data['Error']="L'adresse E-mail que vous avez s&egrave;lectionn&egrave;e n'est pas valide";
	elseif($result==ALREADY_PRIMARY) $data['Error']="L'adresse E-mail que vous avez s&egrave;lectionn&egrave; est d&egrave;j&agrave; votre adresse principale";
	elseif($result==EMAIL_NOT_ACTIVE) $data['Error']="L'adresse E-mail que vous avez s&egrave;lectionn&egrave; n'est pas actif, s'il vous pla&icirc;t l'activer et re-essayez";
	elseif($result==EMAIL_NOT_FOUND) $data['Error']="L'adresse E-mail que vous avez s&egrave;lectionn&egrave; n'est pas trouv&egrave; dans le syst&egrave;me";
}elseif($post['deletebtn']) {
	$result=delete_member_email($uid,$post['choice']);
    if ( $result == SUCCESS) {
			// ajoutre un audit 
				$mcheckinfo = $post['choice']."E-mail adresse a &egrave;t&egrave; supprimer avec succ&egrave;";
				audit(
						'SUPPRIMER EMAIL',
						$mcheckinfo,
						'member_emails',
						$uid,
						prnuser($uid)
				   );
	}
	if($result==INVALID_EMAIL_ADDRESS) $data['Error']="L'adresse E-mail que vous avez s&egrave;lectionnée n'est pas valide";
	elseif($result==EMAIL_NOT_FOUND) $data['Error']="L'adresse E-mail que vous avez s&egrave;lectionn&egrave; n'est pas trouv&eacute; dans le syst&egrave;me";
	elseif($result==CANNOT_DELETE_PRIMARY) $data['Error']="Vous ne pouvez pas supprimer la principale adresse E-mail";
}
$data['emails']=get_email_details($uid, false, false);
$data['action']=$post['action'];
###############################################################################
display('secure');
###############################################################################
?>