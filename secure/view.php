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
$data['PageName']='OP&Egrave;RATIONS APER&Ccedil;U';
$data['PageFile']='view';
###############################################################################
include('../config.php');
include('../plugin/security.php');
###############################################################################
if(!$_SESSION['login']){
	header("Location:{$data['Host']}/acceuil-Edinars.html");
	echo('ACCESS DENIED.');
	exit;
}
if(is_info_empty($uid)){
	header("Location:{$data['Host']}/secure/mon-profile-Edinars.html");
	echo('ACCESS DENIED.');
	exit;
}
###############################################################################
if(!isset($post['StartPage']))$post['StartPage']=0;
if(!isset($post['tabs']))$post['tabs']=0;
###############################################################################
if(!$post['action'])$post['action']='select';
if(!isset($post['type']))$post['type']=-1;
if(!isset($post['status']))$post['status']=-1;
###############################################################################
$where='';
$post['SearchResult']=False;
//echo ("<BR>tabs".$post['tabs']);
//echo ("<BR>type".$post['type']);
//echo ("<BR>status".$post['status']);
//echo ("<BR>page".$post['StartPage']);
###############################################################################

if($post['action']=='select'){
	$count=get_trans_count(
		"WHERE (`sender`={$uid} OR `receiver`={$uid})".
		($post['type']>=0?" AND `type`={$post['type']}":'').
		($post['status']>=0?" AND `status`={$post['status']}":'')
	);
	for($i=0; $i<$count; $i+=$data['MaxRowsByPage'])$data['Pages'][]=$i;
	$post['Transactions']=get_transactions(
		$uid,
		'both',
		$post['type'],
		$post['status'],
		$post['StartPage'],
		$data['MaxRowsByPage'],
		'',
		$suser,
		$sdate
	  );
	  	
}

###############################################################################
//display('secure');
###############################################################################
?>
<table id="hor-minimalist-a" summary="TOUTES LES TRANSACTIONS">
							<thead>
								<tr>
									<th scope="col">Dir</th>
									<th scope="col">Member</th>
									<th scope="col">Montant</th>
									<th scope="col">Frais</th>
									<th scope="col">Pay&egrave</th>
									<th scope="col">Date</th>
									<th scope="col">Type</th>
									<th scope="col">Statut</th>
									<th scope="col">Action</th>
								</tr>
							</thead>
							<tbody>
								
								<?php if($post['Transactions']){
									$idx=1;
									foreach($post['Transactions'] as $value){ ?>
									<tr>
										<td><?=$data['direction'][$value['direction']] ;?></td>
										<td><?if($value['userid']>0){?><a href="userinfo.php?id=<?=$value['userid']?>&bp=<?=$data['PageFile']?><?if(isset($post['StartPage'])){?>&page=<?=$post['StartPage']?><?}?>&action=view"><?=prntext($value['username'])?></a><?}else{?><?=prntext($value['username'])?><?}?></td>
										<td><?=$value['amount']?></td>
										<td><?=$value['fees']?></td>
										<td><?=$value['nets']?></td>
										<td><?=$value['tdate']?></td>
										<td><?=$value['type']?></td>
										<td><?=$value['status']?></td>
										<td>
											<?if($value['canview']){?>
												<a href="mon-historique-Edinars-transaction/<?=$value['id']?>/details"><img src="../images/icons/info.png" alt="Plus info"></a>
											<?}?>
											<?if($value['canrefund']){?>
												<a href="mon-historique-Edinars-transaction/<?=$value['id']?>/refund" onclick="return cfmform()"><img src="../images/icons/refund.png" alt="refund"></a>
											<?}?>
										</td>
									
									</tr>
						   
							  <?php 
							     }
							   }else{?>
								<tr>
									<td colspan=9 align=center >AUCUNE TRANSACTION TROUV&Egrave;</td>
								</tr>
								<?}?>
								<tr>
									<td colspan="9" align="center">
										<?$count=count($data['Pages']);
										if($count>0){
											for($i=0; $i<$count; $i++){?>
											<?if($data['Pages'][$i]==$post['StartPage']){?>
												<?=$i+1?>
											<?}else{?>
												<a href="transactions.php?page=<?=$data['Pages'][$i]?>&status=<?=$post['status']?>"><?=$i+1?></a>
											<?}?>
											<?if($i<$count-1)echo(" | ");}?><?}else{?>1<?}?>
									</td>
								</tr>
								
							</tbody>
						</table>