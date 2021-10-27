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
$data['PageName']='ADVERTISE WITH US';
$data['PageFile']='advertising';
###############################################################################
include('../config.php');
include('../plugin/security.php');
###############################################################################
if(!$_SESSION['login']){
        header("Location:{$data['Host']}/acceuil-.html");
        echo('ACCESS DENIED.');
        exit;
}
if(!$data['Advertising']){
        header("Location:{$data['Members']}/acceuil-Edinars.html");
        echo('ACCESS DENIED.');
        exit;
}
if(is_info_empty($uid)){
        header("Location:{$data['Host']}/mon-profile-Edinars.html");
        echo('ACCESS DENIED.');
        exit;
}
###############################################################################
$post=select_info($uid, $post);
$data['Balance']=select_balance($uid);
$data['Balance-disponible']=select_balance_disponible($uid);
if(!$post['step'])$post['step']=1;
###############################################################################
if($post['send']){
        if($post['step']==1){
                $post['step']++;
        }elseif($post['step']==2){
                if(!$post['banner']){
                   $data['Error']='No Banner URL entered. Enter Banner URL.<br>';
                }elseif(!ereg('^http://.+\.|^https://.+\.', $post['banner'])){
                   $data['Error']='Incorrect format of Banner URL. Enter correct Banner URL.<br>';
                }elseif(!$post['url']){
                   $data['Error']='No Site URL entered. Enter Site URL.<br>';
                }elseif(!ereg('^http://.+\.|^https://.+\.', $post['url'])){
                   $data['Error']='Incorrect format of Site URL. Enter correct Site URL.<br>';
                }else{
                   $post['step']++;
                }
        }elseif($post['step']==3){
                insert_banner($uid, $post['banner'], $post['url'], $post['package'], $post['period']);
                $package=fetch_banners_packages($post['package']);
                //TODO: insert transaction
                $post['step']++;
        }elseif($post['step']==4){
        }
}elseif($post['cancel'])$post['step']--;
if($post['action']=='delete'){
        if($post['gid'])delete_banners($post['gid']);
        //TODO: end reccuring
}
if($post['step']==1){
   $data['Banners']=select_banners($uid);
}
if($post['step']==2){
  $data['AdvPeriods']=array(
      '30'=>'1 Month',
      '60'=>'2 Months',
      '90'=>'3 Months',
      '180'=>'6 Months',
      '270'=>'9 Months',
      '360'=>'12 Months'
   );
   $data['AdvVisiblePacks']=select_banners_packages();
}
if($post['step']==3){
   $data['AdvPackage']=fetch_banners_packages($post['package']);
   $post['amount']=$data['AdvPackage']['price'];
   $post['fees']=0;
   $post['package_name']=$data['AdvPackage']['name'];
   $post['period_name']=$data['AdvPeriods'][$post['period']];
   $post['total']=$post['amount'];
}
###############################################################################
display('secure');
###############################################################################
?>