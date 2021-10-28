<?php
#################################################################################
# PROGRAM     : EDINAR APPLICATION                                             	#
# VERSION     : 0.02                                                          	#
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
$data['PageName']='CONFIRMATION DE VOTRE E-MAIL ON LIGNE';
$data['PageFile']='confirm';
###############################################################################
include('config.php');
$data['Error'] = "";
###############################################################################

if(isset($post['cid'])){

	$cid = select_confirmation($post['cid'] ?? '', $post['email'] ?? '', $post['cid']);
	
	if(!$cid){

		echo "Error activating email";
		header('refresh:1,'. BASE_URL);
		exit;
	}

	// update confirmation
	// TODO  still need to fix issue dp_temp_pays (get_unreg_member_pay)
	update_confirmation($cid);

	var_dump(($confirm));

}elseif(isset($post['confirm'])){
	if(!$post['ccode']){
		$data['Error']="S'il vous pla&icirc;t saisissez votre code de confirmation";
	}elseif(!$cid&&!$eid){
		$data['Error']="S'il vous pla&icirc;t saisissez le code de confirmation valide";
	}else{
		if($cid){
			update_confirmation($cid);
		}elseif($eid){
			update_email_confirmation($eid);
			$data['Email']=true;
		}
		$data['PostSent']=true;
		header("Location:{$data['Host']}/activation.html");
	  echo('ACCESS DENIED.');
	exit;
	}
}else{

	echo "Error activating email";
	header('refresh:1,'. BASE_URL);
}