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
$data['PageName']='MEMBER LOGIN';
$data['PageFile']='login';
###############################################################################
include('../config.php');
###############################################################################
if(!$_SESSION['attempts'])$_SESSION['attempts']=0;
###############################################################################
if($post['send']){
   if($_SESSION['attempts']<$data['PassAtt']-1){
        if(!$post['username']){
                $data['Error']="S'il vous pla&icirc;t saisissez votre Identifiant?";
	    }elseif(!$post['password']){
               $data['Error']="S'il vous pla&icirc;t saisissez votre Mot de passe?";
				
        }elseif($data['UseTuringNumber']&&
                (!$post['turing']||strtoupper($post['turing'])!=$_SESSION['turing'])
        ){
                $data['Error']="S'il vous pla&icirc;t saisissez le code de s&egrave;curit&egrave;?";
				
		}elseif(!is_member_active($post['username'])){
                $data['Error']="Ce membre n'a pas &egrave;t&egrave; trouv&egrave; dans le syst&egrave;me. Ou est inactif, interdit ou ferm&egrave;";
				
        }elseif(!is_member_found($post['username'], $post['password'])){
           $data['Error']="Votre avez entr&egrave; un mauvais identifiant ou mot de passe.";
		  
		   
        }else{
			unset($_SESSION['attempts']);
			$_SESSION['uid']=get_member_id($post['username'], $post['password']);
			$_SESSION['login']=true;
			$_SESSION['login_time']=true;
			set_last_access($post['username']);
			save_remote_ip((int)$_SESSION['uid'], $_SERVER["REMOTE_ADDR"]);
			if($data['UseTuringNumber'])unset($_SESSION['turing']);
			header("Location:{$data['Host']}/acceuil-Edinars.html");
			echo('ACCESS DENIED.');
			exit;
        }
        (int)$_SESSION['attempts']++;
   }else{
      if($data['UseTuringNumber'])unset($_SESSION['turing']);
      unset($_SESSION['attempts']);
      $data['CantLogin']=true;
   }
}
$data['attempts']=$_SESSION['attempts'];
###############################################################################
if($data['UseTuringNumber'])$_SESSION['turing']=gencode();
###############################################################################
display('secure');
###############################################################################
?>
