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
$data['PageName']='ACCOUNT OVERVIEW';
$data['PageFile']='index';
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
$post=select_info($uid, $post);
$post['Emails']=get_member_email($uid, false, false);
$data['Balance']=select_balance($uid);
$data['Balance-disponible']=select_balance_disponible($uid);
$post['Transactions']=get_transactions($uid, 'both', -1, -1, 0, 5);
$post['LastTransaction']=$post['Transactions'][0];
$post['PaysToUnregMembers']=get_unreg_member_pay($uid);
$_SESSION['Mem_Id'] = $post['mem_id'];
$_SESSION['Balance'] = $data['Balance'];
$_SESSION['Balance-disponible'] = $data['Balance-disponible'];
$_SESSION['Connexion'] = prndate($post['ldate']);

if(is_info_empty($uid)){
	header("Location:{$data['Host']}/secure/mon-profile-Edinars.html");
	echo('ACCESS DENIED.');
	exit;
}
###############################################################################
display('secure');
###############################################################################
?>
