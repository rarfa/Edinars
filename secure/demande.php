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
$data['PageName']='ENVOYER DEMANDE DE PAIEMENT';
$data['PageFile']='demande';
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
if(is_info_empty($uid)){
	header("Location:{$data['Host']}/secure/mon-profile-Edinars.html");
	echo('ACCESS DENIED.');
	exit;
}

###############################################################################
$post=select_info($uid, $post);
$data['Balance']=select_balance($uid);
$data['Balance-disponible']=select_balance_disponible($uid);
###############################################################################
if($post['send']){
	if(!$post['rname']){
		$data['Error']='Please enter receiver full name.';
	}elseif(!$post['remail']){
		$data['Error']='Please enter valid e-mail address.';
	}elseif(!$post['amount']){
		$data['Error']='Please enter valid amount for transfering.';
	}elseif($post['amount']<$data['PaymentMinSum']){
		$data['Error']="Amount can not be less than".
			" {$data['Currency']}{$data['PaymentMinSum']}.";
	}elseif(get_member_status($uid)<2&&$post['amount']>$data['PaymentMaxSum']){
		$data['Error']="You cannot request more than".
			" {$data['Currency']}{$data['PaymentMaxSum']} per transaction".
			" because you are UNVERIFIED member.";
	}else{
		$post['fullname']=$post['rname'];
		$post['email']=$post['remail'];
		send_email('REQUEST-MONEY', $post);
		$data['PostSent']=true;
	}
}
###############################################################################
display('secure');
###############################################################################
?>
