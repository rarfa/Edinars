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
$data['PageName']='CONFIRMATION DE VOTRE E-MAIL ON LIGNE';
$data['PageFile']='confirm';
###############################################################################
include('../config.php');

###############################################################################
if($post['cid']){
	if(!isset($post['email'])||empty($post['email'])){
		$cid=select_confirmation('', '', strtolower($post['cid']));
	}else{
		$cid=select_confirmation($post['cid'], $post['email']);
	}
	if($cid){
		update_confirmation($cid);
		$data['PostSent']=true;
	}else $data['Error']="URL de confirmation incorrect";
}elseif($post['confirm']){
	if(!$post['ccode']){
		$data['Error']="S'il vous pla&icirc;t saisissez votre code de confirmation";
	}elseif(!$cid&&!$eid){
		$data['Error']="S'il vous pla&icirc;t saisissez le code de confirmation valide";
	}else{
		if($cid)update_confirmation($cid);
		elseif($eid){
			update_email_confirmation($eid);
			$data['Email']=true;
		}
		$data['PostSent']=true;
		header("Location:{$data['Host']}/activation.html");
	    echo('ACCESS DENIED.');
	exit;
	}
}
###############################################################################
display('secure');
###############################################################################
?>
