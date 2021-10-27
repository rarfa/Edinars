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
$data['PageName']='MODIFIER VOTRE INFORMATION';
$data['PageFile']='profile';
###############################################################################
include('../config.php');
include('../plugin/extra.php');
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

###############################################################################
$data['Balance']=select_balance($uid);
$data['Balance-disponible']=select_balance_disponible($uid);


if($post['change'] =='updateProfile'){
	//if(!$post['fname']){
	//	$data['Error']="S'il vous pla&icirc;t saisissez votre Nom";
	//}elseif(!$post['lname']){
	//	$data['Error']="S'il vous pla&icirc;t saisissez votre Pr&egrave;nom";
	//}else
	if(!$post['mobile']){
		$data['Error']="S'il vous pla&icirc;t saisissez votre mobile";
	}else{
		update_mon_profile($post, $uid);
		$data['InfoIsProfileEmpty']=false;
		$data['PostSent']=true;
	}
}elseif(($post['change'] =='updateAddress')){

	if(!$post['address']){
		$data['Error']="S'il vous pla&icirc;t saisissez votre address";
	}elseif(!$post['city']){
		$data['Error']="S'il vous pla&icirc;t saisissez votre Commune";
	}elseif(!$post['postcode']){
		$data['Error']="S'il vous pla&icirc;t saisissez votre Code postal";
	}elseif(!$post['wilaya']){
		$data['Error']="S'il vous pla&icirc;t saisissez votre wilaya";
	
	}else{
	    update_add_profile($post, $uid);
		$data['InfoIsProfileEmpty']=false;
		$data['PostSent']=true;
	}
}elseif(($post['change'] =='updateEntreprise')){

	if(!$post['company']){
		$data['Error']='S\'il vous pla&icirc;t saisissez le nom de l\'entreprise';
	}elseif(!$post['nrc']){ 
		$data['Error']='S\'il vous pla&icirc;t saisissez votre registre de commerce';
	}elseif(!$post['nnif']){
		$data['Error']='S\'il vous pla&icirc;t saisissez votre numero fiscal';
	}elseif(!$post['nart']){
		$data['Error']='S\'il vous pla&icirc;t saisissez votre numero d\'article';
	}elseif(!$_FILES['logo']){
		$data['Error']="S'il vous pla&icirc;t ajouter votre Logo";	
	}else{
	    update_entreprise_profile($post, $uid);
		$data['InfoIsProfileEmpty']=false;
		$data['PostSent']=true;
	}	
}

###############################################################################
$post=select_info($uid, $post);
$post['emails']=prnmemberemails($uid);
$data['InfoIsProfileEmpty']=is_info_empty_profile($uid);

###############################################################################
display('secure');
###############################################################################
?>
