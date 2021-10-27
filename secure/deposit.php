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
###############################################################################
$data['PageName']='AJOUTER DES FONDS';
$data['PageFile']='deposit';
###############################################################################
include('../config.php');
include('../plugin/security.php');
include('../plugin/topup.php');
include('../plugin/extra.php');
include('../plugin/audit.php');

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
	$post['LastDeposit']=get_transactions($uid, 'incoming', 1, 1, 0, 1);
	$post['LastDeposit']=$post['LastDeposit'][0];
	
	
	if ($post['montant-topup']) { 
			$post['montant'] = $post['montant-topup'];
		} else  { 
			$post['montant']= $post['montant-ccp'];
	  }
	
	if (!is_numeric($post['montant']) ){
		$data['Error']="S'il vous pla&icirc;t saisissez le montant";
	}elseif(!$post['montant']){
		$$data['Error']="S'il vous pla&icirc;t saisissez le montant";	
	}elseif($post['montant'] < $data['DepositMinSum']){
		$data['Error']="Le montant minimum que vous pouvez d&egrave;poser est {$data['DepositMinSum']} {$data['Currency']}";
	}elseif($post['montant'] > $data['DepositMaxSum']){
		$data['Error']="Le montant maximun que vous pouvez d&egrave;poser est {$data['DepositMaxSum']} {$data['Currency']}";
	}elseif(!$post['dtype']){
		$data['Error']="S'il vous pla&icirc;t s&egrave;lectionner mode de paiement";
	}elseif( ( $post['dtype']=='topup') && (!$post['topup_number'])) {
		$data['Error']="S\il vous pla&icirc;t saisissez votre carte de recharge";	
	/*}
	elseif(get_member_status($uid)<2&&isset($post['LastDeposit']['period'])&&$post['LastDeposit']['period']<30){
		if($post['LastDeposit']['period']==0)$days="aujourd'hui";
		elseif($post['LastDeposit']['period']==1)$days='hier';
		else $days="Il ya {$post['LastDeposit']['period']} jours";
		$data['Error']="Vous ne pouvez pas d&egrave;poser plus de".
			" {$data['DepositMaxSum']} {$data['Currency']} ".
			" chaque 30 jours parce que vous &ecirc;tes membre non v&egrave;rifi&egrave;es".
			" Vos derni&egrave;res d&egrave;p&ocirc;t a &egrave;t&egrave; {$days}";
	*/}else{
		
		$fees=$data['DepositMethod'][$post['dtype']]['fees'];
		$prcn=$data['DepositMethod'][$post['dtype']]['prcn'];
		$post['fees']=round(($post['montant']*$prcn/100)+$fees, 2);
		
                if($post['manual']){
                        if($post['dtype']=='CCP'){
								$post['total']=$post['montant']+$post['fees'];
                                $mcheckinfo= "Envoyer un paiement de sur le compte suivante ".prntext($data['CCPAccount'])." \n ".
											 "inclure une note avec votre nom \n ".
								             " Identifinat    : ".prnuser($uid)." \n ".
                                             " Adresse E-Mail : ".get_member_email($uid)." \n".
											 " Numero Compte : ".prntext($_SESSION['Mem_Id'])." \n" ;

                                       transaction(
										get_trx_id(),
                                        -1,
                                        $uid,
                                        $post['montant']+$post['fees'],
                                        $post['fees'],
                                        1,
                                        0,
                                        'DEPOT PAR CCP',
                                        "Details de la transaction:\n".$mcheckinfo
										);
										 
                                $post['CheckInfo']=$mcheckinfo;
                                $post['ShowCheckInfo']=false;
								$post['depot_info'] = $mcheckinfo ;
								
								send_email('DEPOT-PAYMENT-CCP', $post);
								send_email('DEPOT-PAYMENT-CCP-ADMIN', $post);
								$post['PostSent']=true;
                        }
						if($post['dtype']=='topup'){
						        $post['total']=$post['montant']-$post['fees'];
								if(!$post['topup_number']){
                                        $data['Error']="S'il vous pla&icirc;t saisissez votre carte de recharge.";
										$post['ShowCheckInfo']=false;
								/*}elseif (strlen($post['topup_number'])!= $data['TopupLenNumber']) {
										$data['Error']='La carte de recharge est invalide.';
										$post['ShowCheckInfo']=false;
										echo $data['Error'];
									*/
								}else{
                                     
									$topup_number = $post['topup_number']; 
									$cryptedcode =  encryptPerHashKey ($admin_secure_pwd ,prntext($post['topup_number'])) ;
  									$topupinfo=select_topup($cryptedcode, prntext($post['montant']));
									
										if($topupinfo[0]){
										
                                                foreach($topupinfo[0] as $key=>$val)$post[$key]=$val;
													
													$mcheckinfo  =" Carte de recharege    : ".addslashes($topup_number)." \n ";
													$mcheckinfo .=" Code Bare    : ".addslashes($post['topup_code_bare'])." \n ";
													$mcheckinfo .=" Montant : ".prnpays($post['topup_amount'])." \n" ;
													$mcheckinfo .=" Identifinat    : ".prnuser($uid)." \n " ;
													$mcheckinfo .=" Adresse E-Mail : ".get_member_email($uid);
													$post['depot_info'] = " Carte de recharege    : ".addslashes($topup_number)." \n ";
												    
													transaction(
															get_trx_id(),
													        -1,
													        $uid,
													        //$post['montant']+$post['fees'],
															$post['montant'],
													        $post['fees'],
													        1,
													        1,
													       'DEPOT PAR CARTE DE RECHARGE',
													       "Details de la transaction:\n".$mcheckinfo
													);
													// ajoutre un audit 
													audit(
													        'AJOUTER DES FONDS CARTE DE RECHARGE',
													        $mcheckinfo,
															'topup',
													        $post['topup_id'],
															prnuser($uid)
													   );
													 
												   // deactive carte de recharge 
												   archive_topup( $post['topup_id'],$uid);
												   $data['Balance']=select_balance($uid);
												   $_SESSION['Balance'] = $data['Balance'] ;
												   $post['uid'] = $uid; ; 
												   send_email('DEPOT-PAYMENT-CARD', $post);
												   $post['ShowCheckInfo']=true;
												
                                        }else{
                                                $data['Error']='La carte de recharge est invalide';
												$post['ShowCheckInfo']=false;
												$post['PostSent'] = false;
									    }
								}
                                             
								
                        }
		  }else{
			 $_SESSION['fees']=$post['fees'];
			 $_SESSION['montant']=$post['montant'];
			 $_SESSION['dtype']=$post['dtype'];
			 $_SESSION['action']='automatic';
		  }
          // $post['PostSent']=true;
        }
}elseif($post['cancel'])$post['PostSent']=false;
###############################################################################
display('secure');
###############################################################################
?>