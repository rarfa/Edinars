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
$data['PageName']='ENVOYER DEMANDE DE PAIEMENT AUTRE COMPTE';
$data['PageFile']='envoyez';
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
	if(!$post['receiver']){
		$data['Error']='Please enter username or e-mail address of the receiver.';
	}elseif($uid==get_member_id($post['receiver'])){
		$data['Error']='You cannot send money to yourself.';
	}elseif(!is_member_active($post['receiver'])&&is_member_found($post['receiver'], '')){
		$data['Error']='You cannot send money to inactive or banned member.';
	}elseif(!$post['amount']){
		$data['Error']='Please enter valid amount for transfering.';
	}elseif($post['amount']<$data['PaymentMinSum']){
		$data['Error']="Amount can not be less than {$data['Currency']}{$data['PaymentMinSum']}.";
	}elseif($post['amount']>$data['Balance']){
		$data['Error']='You do not have enough money in your account.';
	}elseif(get_member_status($uid)<2&&$post['amount']>$data['PaymentMaxSum']){
		$data['Error']="You cannot send more than {$data['Currency']}{$data['PaymentMaxSum']}".
			" per transaction because you are UNVERIFIED member.";
	}else{
	
		if(!is_member_found($post['receiver'], '')){
			unreg_member_pay($uid, $receiver, $post['amount'], $post['comments']);
			$data['PostSent']=true;
		}else{
		$receiver=get_user_id($post['receiver']);
		$sender=get_user_id($post['sender']);
		$fees=($post['amount']*$data['PaymentPercent']/100)+$data['PaymentFees'];
		transaction(
			$uid,
			$receiver,
			$post['amount'],
			$fees,
			0,
			1,
			$post['comments']
		);
		$post['fees']=$fees;
		$post['email']=get_member_email($receiver);
		$post['emailadr']=get_member_email($uid);
		send_email('SEND-MONEY', $post);
		$data['Username']=get_member_name($receiver);
		$data['PostSent']=true;
		
			
		}
	}
}
###############################################################################
display('secure');
###############################################################################
?>
