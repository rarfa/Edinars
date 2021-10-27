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
$data['PageName']='MODIFIER VOTRE MOT DE PASSE ET SECURITE QUESTION';
$data['PageFile']='password';
###############################################################################

include('../config.php');
include('../plugin/profile.php');
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
$post=select_info($uid, $post);
$data['InfoIsEmpty']=is_info_empty($uid);
$data['Balance']=select_balance($uid);
$data['Balance-disponible']=select_balance_disponible($uid);
###############################################################################
if($post['change'] =='pwd'){
	
	if(!$post['opass']&&!$post['npass']&&!$post['cpass']){
		$data['Error']="S'il vous pla&icirc;t saisissez votre ancien mot de passe et le nouveau pour le changement";
	}elseif(!$post['opass']){
		$data['Error']="S'il vous pla&icirc;t saisissez votre ancien mot de passe";
	}elseif(!$post['npass']){
		$data['Error']="S'il vous pla&icirc;t saisissez votre nouveau mot de passe";
	}elseif(strlen($post['npass'])<$data['PassLen']){
		$data['Error']="Votre mot de passe doit avoir au moins {$data['PassLen']} caract&eacute;re";
	}elseif($post['npass']==$post['opass']){
		$data['Error']='Nouveau mot de passe ne doit pas tre le m&ecirc;me que ancien mot de passe';
	}elseif(!$post['cpass']){
		$data['Error']='S\'il vous pla&icirc;t saisissez de nouveau votre nouveau mot de passe';
	}elseif($post['password'] !=  strtoupper(md5($post['opass'].'|'.$_SESSION['Mem_Id'])) ){
		$data['Error']='Vous avez entr&ecirc; mauvaise ancien mot de passe';
	}elseif($post['npass']!=$post['cpass']){
		$data['Error']='Votre mot de passe et la confirmation ne doit pas &ecirc;tre diff&eacute;rente';
	}elseif($post['username']==$post['npass']){
		$data['Error']='Votre mot de passe ne peut pas &ecirc;tre le m&ecirc;me que votre Identifiant';
	}else{
		update_member_password($uid, $post['npass'], true);
		$data['PostSent']=true;
	}
}
	
if($post['change']== 'answer'){	
	if(!$post['answer']){
		$data['Error']="S'il vous plaît saisissez une r&eacute;ponse de s&eacute;curit&eacute; valide";
	}else{
		update_member_question($uid,$post['question'],base64_encode($post['answer']));
		$data['PostSent']=true;
	}
}
###############################################################################
display('secure');
###############################################################################
?>
