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
$data['PageName']='RECHARGER MOBILE';
$data['PageFile']='ussd';
###############################################################################

include('../config.php');
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

if(!isset($post['StartPage'])){$post['StartPage']=0;} else { $post['StartPage']=$_GET['page'];}

if($post['send'] =='RECHARGEZ'){
		if(!$post['montant']){
			$data['Error']="S'il vous pla&icirc;t saisissez le montant pour la recharger";
		}elseif(!$post['operator']){
			$data['Error']="S'il vous pla&icirc;t s&eacute;lectionner un operator";
		}elseif(!$post['mobile_flexy']){
			$data['Error']="S'il vous pla&icirc;t saisissez mobile &agrave; recharger";
		}elseif($post['montant'] > ($data['Balance-disponible'] + $data['flexy_fee'] ) ){
				$data['Error']="Vous n'avez pas assez d'argent disponible pour la recharger de votre mobile dans votre compte" ;
		}elseif( ($post['operator'] == "Djezzy") && ( substr($post['mobile_flexy'],0, 2) <> "07")   ){
				$data['Error']="S'il vous pla&icirc;t saisissez mobile valide pour l'operator Djezzy";
	    }elseif(($post['operator'] == "Mobilis") && ( substr($post['mobile_flexy'],0, 2) <> "06")   ){
				$data['Error']="S'il vous pla&icirc;t saisissez mobile valide pour l'operator Mobilis";
		}elseif( ($post['operator'] == "Nedjma") && ( substr($post['mobile_flexy'] ,0, 2)<> "05")   ){
				$data['Error']="S'il vous pla&icirc;t saisissez mobile valide pour l'operator Nedjma";
		}else{

			$post['fees'] =$data['flexy_fee'];
			$post['get_trx_id'] =  get_trx_id() ;
			$post['total']=$post['montant'] - $post['fees'];
			           if($post['dtype']=='flexy'){
						        $mcheckinfo  =" Mobile a recharger: ".addslashes($post['mobile_flexy'])." \n ";
								$mcheckinfo .=" Montant: ".prnpays($post['montant'])." \n" ;
								$mcheckinfo .=" Operator: ".addslashes($post['operator'])." \n " ;

								// creating transaction
								transaction(
										$post['get_trx_id'],
										$uid,
										-1,
										$post['montant'],
										$post['fees'],
										3,
										0,
									   "Recharger (".addslashes($post['operator']).")" ,
									   "Details de la transaction: ".$mcheckinfo
								);


									$URL = "http://dzflex.edinars.net/server/service.html?ussd=Recharge&type_recharge=".$post['recharge_type']."&imei=1111111111&code=5818&mobile=".$post['mobile_flexy']."&montant_ussd=".$post['montant'];
									$Load_xml_ussd = simplexml_load_file($URL) ;

								// creating USSD Request
								ussd(   $uid,
										mysql_insert_id(),
										$post['operator'],
										$post['mobile_flexy'],
										$post['montant'],
										0,
										$Load_xml_ussd->trx);

								// ajoutre un audit
								audit(
										"Recharger (".addslashes($post['operator']).") ",
										$mcheckinfo,
										'flexy',
										$post['get_trx_id'],
										prnuser($uid)
								   );

							   // deactive carte de recharge
							   $data['Balance']=select_balance($uid) ;
							   $data['Balance-disponible']=select_balance_disponible($uid);
							   $_SESSION['Balance'] = $data['Balance'] ;
							   $_SESSION['Balance-disponible'] = $data['Balance-disponible'] ;
							   $post['uid'] = $uid; ;
							   send_email('PAYMENT-FLEXY', $post);
							   $post['historic']=true;
							   $post['operator']="";
							   $post['mobile_flexy']="";
							   $post['montant'] ="" ;
							   header("Location: recharger-mobile-Edinars.html");

					    }
	    }

}


    $count=get_trans_count("WHERE `sender`={$uid}  AND `type`=3" );
	for($i=0; $i<$count; $i+=$data['MaxRowsByPage'])$data['Pages'][]=$i;


	$post['Transactions']=

	get_transactions_ussd(
		$uid,
		$post['StartPage'],
		$data['MaxRowsByPage']
	  );




###############################################################################
display('secure');
###############################################################################
?>
