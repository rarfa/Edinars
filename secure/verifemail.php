<?php
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
$data['PageName']='E-MAIL ACTIVATION';
$data['PageFile']='verifemail';
###############################################################################
include('../config.php');
//include('../plugin/security.php');
###############################################################################
if (isset($_GET['c']) && isset($_GET['u'])) {
	$code   = (string) $_GET['c'];
	$uid    = (string) $_GET['u'];

	$result = activate_email($uid, $code);

	if ($result == CONFIRMATION_NOT_FOUND) {
		$data['Error'] = "Le code de confirmation que vous avez entr&eacute; n'est pas valide";
	}

} else {
	header("Location:{$data['Host']}/acceuil-Edinars.html");
}


$_SESSION['Error'] 		 = $data['Error'];
$_SESSION['post_header'] = "Nouvelle adresse e-mail";
$_SESSION['post_detail'] = "Vous avez activ&eacute; avec succ&egrave;s la nouvelle adresse e-mail";

header("Location:{$data['Host']}/validation-Edinars.html");
###############################################################################
display("secure");