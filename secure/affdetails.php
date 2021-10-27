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
$data['PageName']='AFFILIATE PROGRAM INFORMATION';
$data['PageFile']='affdetails';
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
$data['Balance']=select_balance($uid);
$data['Balance-disponible']=select_balance_disponible($uid);

$post['username']=get_member_username($uid);
$post['Example'][0]['members']=10;
$post['Example'][0]['spends']=2000;
$post['Example'][0]['fees']=($post['Example'][0]['spends']*$data['PaymentPercent']/100)+$data['PaymentFees'];
$post['Example'][0]['commission']=$post['Example'][0]['fees']*$data['ReferralPercent']/100;
$post['ExampleTotal']['members']=$post['Example'][0]['members'];
$post['ExampleTotal']['spends']=$post['Example'][0]['spends'];
$post['ExampleTotal']['commission']=$post['Example'][0]['commission'];
$post['Commissions']=array();
$post['Commissions'][0]=$data['ReferralPercent'];
for($i=1; $i<$data['ReferralLevels']; $i++){
	$post['Commissions'][$i]=$data['ReferralPercent'];
	$post['Example'][$i]['members']=$post['Example'][$i-1]['members']*($data['ReferralLevels']);
	$post['ExampleTotal']['members']=$post['ExampleTotal']['members']+$post['Example'][$i]['members'];
	$post['Example'][$i]['spends']=$post['Example'][$i-1]['spends']*($data['ReferralLevels']);
	$post['ExampleTotal']['spends']=$post['ExampleTotal']['spends']+$post['Example'][$i]['spends'];
	$post['Example'][$i]['fees']=($post['Example'][$i]['spends']*$data['PaymentPercent']/100)+$data['PaymentFees'];
	$post['Example'][$i]['commission']=$post['Example'][$i]['fees']*$data['ReferralPercent']/100;
	$post['ExampleTotal']['commission']=$post['ExampleTotal']['commission']+$post['Example'][$i]['commission'];
}
$post['ExampleTotal']['members']=$post['ExampleTotal']['members'];
###############################################################################
display('secure');
###############################################################################
?>
