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
$data['PageName']='RETIRER DES FONDS DE VOTRE COMPTE';
$data['PageFile']='retirer';
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
if(!$post['step'])$post['step']=1;
$post=select_info($uid, $post);
$data['Balance']=select_balance($uid);
$data['Balance-disponible']=select_balance_disponible($uid);
$post['BanksInfo']=select_banks($uid);
###############################################################################

if($post['send']){
	$post['LastWithdraw']=get_transactions($uid, 'outgoing', 2, 1, 0, 1);
	$post['LastWithdraw']=$post['LastWithdraw'][0];

	if($post['step']==1){
	
		if ($post['montant-cheque']) { 
			$post['montant'] = $post['montant-cheque'];
		} else  { 
			$post['montant']= $post['montant-ccp'];
		}
	    if(!$post['montant']){
			$data['Error']="S'il vous pla&icirc;t saisissez le montant pour le retirer";
		}elseif(!$post['wtype']){
			$data['Error']="S'il vous pla&icirc;t s&eacute;lectionner un mode de paiement";
		}elseif($post['montant']<$data['WithdrawMinSum']+$data['WithdrawMethod'][$post['wtype']]['fees']){
			$data['Error']=
				"Le montant minimal des fonds que vous pouvez retirer est ".
				($data['WithdrawMinSum']+$data['WithdrawMethod'][$post['wtype']]['fees'])." {$data['Currency']} " ;
		}elseif($post['montant']>$data['Balance-disponible']){
				$data['Error']="Vous n'avez pas assez d'argent disponible pour le retirer dans votre compte";
		}elseif(get_member_status($uid)<2&&isset($post['LastWithdraw']['period'])&&$post['LastWithdraw']['period']<30){
			if($post['LastWithdraw']['period']==0)$days="aujourd'hui";
			elseif($post['LastWithdraw']['period']==1)$days='hier';
			else $days="{$post['LastWithdraw']['period']} jours";
			$data['Error']="Vous ne pouvez pas retirer plus de ".
				" {$data['WithdrawMaxSum']} {$data['Currency']}".
				" chaque 30 jours parce que vous &ecirc;tes membre non V&egrave;RIFI&egrave;ES ".
				" Vos dernières retrait a été {$days}.";
		}else{
			$post['step']++;
		}
	}elseif($post['step']==2){
	    if ($post['wtype']=='cheque') {
                     if(!$post['fname']){
                                $data['Error']="S'il vous pla&icirc;t saisissez votre nom";
                        }elseif(!$post['lname']){
                                $data['Error']="S'il vous pla&icirc;t saisissez votre pr&egrave;nom";
						}elseif(!$post['company']){
                                $data['Error']="S'il vous pla&icirc;t saisissez le nom de soci&egrave;t&egrave; ";
						}elseif(!$post['address']){
                                $data['Error']="S'il vous pla&icirc;t saisissez votre address";
					    }elseif(!$post['city']){
                                $data['Error']="S'il vous pla&icirc;t saisissez votre commune";
                        }elseif(!$post['postcode']){
                                $data['Error']="S\il vous pla&icirc;t saisissez votre code postal";
                        }elseif(!$post['mobile']){
                                $data['Error']="S'il vous pla&icirc;t saisissez votre mobile";
                        }else{
                                $checkinfo=
                                        "Montant : ".prnsumm($post['montant'])." {$data['Currency']} \n".
                                        "Frais : ".prnsumm($data['WithdrawMethod'][$post['wtype']]['fees'])." {$data['Currency']} \n".
                                        "Total de Retirer : ".prnsumm($post['montant']-$data['WithdrawMethod'][$post['wtype']]['fees'])." {$data['Currency']} \n\n".
                                        "Type de Paiement : {$data['WithdrawMethod'][$post['wtype']]['name']}\n".
                                        "Nom : {$post['lname']}, {$post['fname']}\n".
                                        "Nom de soci&egrave;t&egrave; : {$post['company']}\n".
                                        "Address : {$post['address']}\n".
                                        "Commune : {$post['city']}\n".
										"Wilaya	: {$data['Wilayas'][$post['wilaya']]}\n".
                                        "Code Postal : {$post['postcode']}\n".
                                        "Mobile : {$post['mobile']}";
                                $_SESSION['transinfo']="D&egrave;tails de la transaction:\n{$checkinfo}";
                                $post['info']=prntext($checkinfo);
                                $post['step']++;
                        }
                }elseif ($post['wtype']=='ccp') {
                          if(!$post['fname']){
                                $data['Error']="S'il vous pla&icirc;t saisissez votre nom";
                        }elseif(!$post['lname']){
                                $data['Error']="S'il vous pla&icirc;t saisissez votre pr&egrave;nom";
						}elseif(!$post['company']){
                                $data['Error']="S'il vous pla&icirc;t saisissez le nom de soci&egrave;t&egrave; ";
					}elseif(!$post['ccp']){
                                $data['Error']="S'il vous pla&icirc;t saisissez votre compte de CCP ";
						}elseif(!$post['address']){
                                $data['Error']="S'il vous pla&icirc;t saisissez votre address";
					    }elseif(!$post['city']){
                                $data['Error']="S'il vous pla&icirc;t saisissez votre commune";
                        }elseif(!$post['postcode']){
                                $data['Error']="S\il vous pla&icirc;t saisissez votre code postal";
                        }elseif(!$post['mobile']){
                                $data['Error']="S'il vous pla&icirc;t saisissez votre mobile";
                        }else{
                                $checkinfo=
                                        "Montant : ".prnsumm($post['montant'])." {$data['Currency']} \n".
                                        "Frais : ".prnsumm($data['WithdrawMethod'][$post['wtype']]['fees'])." {$data['Currency']} \n".
                                        "Total de Retirer : ".prnsumm($post['montant']-$data['WithdrawMethod'][$post['wtype']]['fees'])." {$data['Currency']} \n\n".
                                        "Type de Paiement : {$data['WithdrawMethod'][$post['wtype']]['name']}\n".
                                        "Nom : {$post['lname']}, {$post['fname']}\n".
                                        "Nom de soci&egrave;t&egrave; : {$post['company']}\n".
                                        "Compte CCP : {$post['ccp']}\n".
										"Address : {$post['address']}\n".
                                        "Commune : {$post['city']}\n".
										"Wilaya	: {$data['Wilayas'][$post['wilaya']]}\n".
                                        "Code Postal : {$post['postcode']}\n".
                                        "Mobile : {$post['mobile']}";
                                $_SESSION['transinfo']="D&egrave;tails de la transaction:\n{$checkinfo}";
                                $post['info']=prntext($checkinfo);
                                $post['step']++;
                        }
                }
        }elseif($post['step']==3){
               
				if ($_SESSION['transinfo'] !="") { 
					   transaction(
					    get_trx_id(),
                        $uid,
                        -1,
                        $post['montant'],
                        $data['WithdrawMethod'][$post['wtype']]['fees'],
                        2,
                        0,
                        "Demande de retire par {$data['WithdrawMethod'][$post['wtype']]['name']}",
                        $_SESSION['transinfo']
					);
                /*
                        TODO: Send notification e-mail
                */
						$post['uid'] = $uid; ; 
						send_email('WITHDRAW-PAYMENT', $post);
						send_email('WITHDRAW-PAYMENT-ADMIN', $post);
				}
                unset($_SESSION['transinfo']);
                $post['step']++;
        }
}elseif($post['cancel'])$post['step']--;
###############################################################################
display('secure');
###############################################################################
?>