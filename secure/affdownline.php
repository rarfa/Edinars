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
#######################################################################
$data['PageName']='AFFILIATE PROGRAM DOWNLINE';
$data['PageFile']='affdownline';
###############################################################################
include('../config.php');
include('../plugin/security.php');
###############################################################################
if(!$_SESSION['login']){
	header("Location:{$data['Host']}/acceuil-Edinars.html");
	echo('ACCESS DENIED.');
	exit;
}
if(!$data['ReferralPays']){
	header("Location:{$data['Members']}/acceuil-Edinars.html");
	echo('ACCESS DENIED.');
	exit;
}
if(is_info_empty($uid)){
	header("Location:{$data['Members']}/mon-profile-Edinars.html");
	echo('ACCESS DENIED.');
	exit;
}
###############################################################################
if(!isset($post['StartPage']))$post['StartPage']=0;
###############################################################################
$data['Balance']=select_balance($uid);
$data['Balance-disponible']=select_balance_disponible($uid);
$count=get_referrals_count($uid);
for($i=0; $i<$count; $i+=$data['MaxRowsByPage'])$data['Pages'][]=$i;
$post['Referrals']=get_referrals($uid, $post['StartPage'], $data['MaxRowsByPage']);
###############################################################################
display('secure');
###############################################################################
?>
