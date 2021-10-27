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
$data['PageName']='OP&Egrave;RATIONS APER&Ccedil;U';
$data['PageFile']='transactions';
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

###############################################################################

$data['Balance']=select_balance($uid);
$data['Balance-disponible']=select_balance_disponible($uid);

if(!isset($post['action'])){$post['action']='select';} ;//else { $post['action'] = $_GET['action'] ;};
if(!isset($post['type'])) {$post['type']=-1;} ;//else {$post['type']=$_GET['type'];};
if(!isset($post['status'])){$post['status']=-1;};// else {$post['status']= $_GET['status'];}
if(!isset($post['tabs'])){$post['tabs']=0;};// else {$post['tabs'] = $_GET['tabs'];}
if(!isset($post['StartPage'])){$post['StartPage']=0;} ;//else { $post['StartPage']=$_GET['page'];}


###############################################################################
$where='';
$post['SearchResult']=False;
if($post['action']=='search'){
	if($post['search']){
		if($post['field']=='username'){
			$suser=$post['username'];
			$sdate='';
			$post['SearchResult']=True;
		}elseif($post['field']=='tdate'){
			$suser='';
			$sdate="{$post['year']}-{$post['month']}-{$post['day']}";
			$post['SearchResult']=True;
		}
		$post['action']='select';
	}elseif($post['cancel']){
		$post['StartPage']=$post['page'];
		$post['action']='select';
	}else{
		$now=getdate();
		if(!isset($post['month']))$post['month']=$now['mon'];
		if(!isset($post['day']))$post['day']=$now['mday'];
		if(!isset($post['year']))$post['year']=$now['year'];
		if(!$post['month'])$post['day']=0;

		$data['StatDays']=array();
		for($i=1;$i<=31;$i++)$data['StatDays'][$i]=$i;
		$data['StatMonth']=array();
		for($i=1;$i<=12;$i++)$data['StatMonth'][$i]=date('F', mktime(0,0,0,$i,1,0));
		$years=get_transactions_year();
		$data['StatYear']=array();
		for($i=$years['min'];$i<=$years['max'];$i++)$data['StatYear'][$i]=$i;
	}
}elseif($post['action']=='irefund'){
	update_transaction_status($uid, $post['gid'], 3);
	header("Location:{$data['Host']}/secure/mon-compte-Edinars.html");
	echo('ACCESS DENIED.');
	exit;
}elseif($post['action']=='refund'){
	update_transaction_status($uid, $post['gid'], 3);
	$post['action']='select';
}
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
	  
	
	  
			
}elseif($post['action']=='details'){
	$post['Transaction']=get_transaction_detail($post['gid'], $uid);
	list($wtype, $total, $email, $ecomments)=explode("#", trim($post['Transaction']['ecomments']));
	if($wtype&&$total&&$email&&$ecomments)$post['Transaction']['ecomments']=$ecomments;
}
$post['ViewMode']=$post['action'];

###############################################################################
display('secure');
###############################################################################
?>
