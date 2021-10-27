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

$data['PageName']='Ouvrir un compte';
$data['PageFile']='signup';
###############################################################################
include('../config.php');
###############################################################################
if($post['action']=='go')optimize('common');


if($post['send']){
	if(!$post['newpass']){
		$data['Error']="Votre mot de passe ne peut pas &egrave;tre vide";
	}elseif(strlen($post['newpass'])<$data['PassLen']){
		$data['Error']="Votre mot de passe doit avoir au moins {$data['PassLen']} caract&eacute;re";
	}elseif($post['newpass']!=$post['cfmpass']){
		$data['Error']="Votre mot de passe et confirmez ne devraient pas &ecirc;tre diff&ecirc;rentes";
	}elseif(!$post['newques']){
		$data['Error']="S'il vous pla&icirc;t saisissez une question de s&ecirc;curit&ecirc; valide";
	}elseif(!$post['newansw']){
		$data['Error']="S'il vous pla&icirc;t entrer une r&ecirc;ponse de s&ecirc;curit&ecirc; valide";
	}elseif(!$post['newmail']||verify_email($post['newmail'])){
		$data['Error']="S'il vous pla&icirc;t saisissez votre adresse e-mail";
  }elseif($data['UseTuringNumber']&&
		(!$post['turing']||strtoupper($post['turing'])!=$_SESSION['turing'])
	){
		$data['Error']='S\'il vous pla&icirc;t entrez le Code de s&egrave;curit&egrave; valide';
	}elseif($post['terms']!='on'){
		$data['Error']='S\'il vous pla&icirc;t lire nos termes et conditions avant inscription';
	}elseif(!is_user_available($post['newuser'])){
		$data['Error']='D&egrave;sol&egrave;, mais ce Identifiant d&egrave;j&agrave; pris';
	}elseif(!is_mail_available($post['newmail'])){
		$data['Error']='D&egrave;sol&egrave;, mais cette adresse e-mail d&egrave;j&agrave; prises';
	}else{
		create_confirmation(
			$post['newpass'],
			$post['newques'],
			$post['newansw'],
			$post['newmail'],
			$post['newtype'],
			get_member_id($_SESSION['sponsor'])
		);
		unset($_SESSION['turing']);
		$data['PostSent']=true;
	}
	if($data['UseTuringNumber'])$_SESSION['turing']=gencode();
}else{
	if($data['UseTuringNumber'])$_SESSION['turing']=gencode();
}
###############################################################################
display('secure');
###############################################################################
?>
