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
$data['PageName']='?';
$data['PageFile']='forgot';

$data['IsLogin']=true;
###############################################################################
include('../config.php');
include('../plugin/audit.php');
if(!$post['step'])$post['step']=1;
###############################################################################
if($post['back']){
	if($_SESSION['email']){
		$post['email']=$_SESSION['email'];
		unset($_SESSION['email']);
	}
	(int)$post['step']--;
}elseif($post['send']){
	if($post['step']==1){
		if(!$post['email']||verify_email($post['email'])){
			$data['Error']='S\'il vous pla&icirc;t saisissez votre adresse E-mail.';
		}elseif(!is_valid_mail($post['email'])){
			$data['Error']='Cette adresse E-mail n\'a pas &egrave;t&egrave; trouv&egrave; dans notre service.';
		}else{
		echo (!is_valid_mail($post['email']));
			$_SESSION['email']=$post['email'];
			(int)$post['step']++;
		}
	}elseif($post['step']==2){
		$info=get_member_by_email($_SESSION['email']);
		if(!$post['answer']||( base64_decode($info['answer'])!=$post['answer'])){
			$data['Error']="S'il vous pla&icirc;t saisissez la r&egrave;ponse de s&egrave;curit&egrave; valide.";
		}else{
		    $post['email']=$_SESSION['email'];
			$_SESSION['id']  = $info['id'];
			$_SESSION['fullname']  = $info['fullname'];
			(int)$post['step']++;
		}
	}elseif($post['step']==3){
		    if(!$post['newpass']){
				$data['Error']='Votre mot de passe ne peut pas &egrave;tre vide.';
			}elseif(strlen($post['newpass'])<$data['PassLen']){
				$data['Error']="Votre mot de passe doit avoir au moins {$data['PassLen']} caract&eacute;re.";
			}elseif($post['newpass']!=$post['cfmpass']){
				$data['Error']='Votre mot de passe et confirmez ne devraient pas &ecirc;tre diff&ecirc;rentes.';
			}else{
			update_member_forgot_password ($_SESSION['email'],$post['newpass']);
			$mcheckinfo = "Modification des detail sur S&egracecurit&egrace acc&egraces";
				audit(
						'MODIFICATION DES DETAIL SUR S&EgraveCURIT&Egrave ACC&EgraveS',
						$mcheckinfo,
						'members',
						$_SESSION['id'],
						prnuser($_SESSION['id'])
				   );
   
			$post['email'] = $_SESSION['email'];
			$post['fullname'] = $_SESSION['fullname'] ;
			send_email('RESTORE-PASSWORD', $post);
			unset($_SESSION['email']);
			(int)$post['step']++;
			}
			
	}elseif($post['step']==4){
		unset($post['step']);
	}
}
###############################################################################
if($_SESSION['email']){
	$info=get_member_by_email($_SESSION['email']);
	$post['question']=$info['question'];
}
###############################################################################
display('secure');
###############################################################################
?>
