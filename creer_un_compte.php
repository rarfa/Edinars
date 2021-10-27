<?
#################################################################################
# PROGRAM     : EDINAR APPLICATION                                             	#
# VERSION     : 0.02                                                          	#
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

$data['PageName']='Ouvrir un compte';
$data['PageFile']='signup';
###############################################################################
include('config.php');
###############################################################################
if($post['action']=='go')optimize('common');

$data['Error']="";


if(!$post['newpass']){
	$data['Error'] = "Votre mot de passe ne peut pas &egrave;tre vide"."<br>";
}elseif(strlen($post['newpass'])<$data['PassLen']){
	$data['Error'] = "Votre mot de passe doit avoir au moins {$data['PassLen']} caract&eacute;re"."<br>";
}elseif($post['newpass']!=$post['cfmpass']){
	$data['Error'] = "Votre mot de passe et confirmez ne devraient pas &ecirc;tre diff&ecirc;rentes"."<br>";
}elseif($post['newuser']==$post['newpass']){
	$data['Error'] = "Votre mot de passe ne peut pas &ecirc;tre le m&ecirc;me que votre Identifiant"."<br>";
}elseif(!$post['newques']){
	$data['Error'] = "S'il vous pla&icirc;t saisissez une question de s&ecirc;curit&ecirc; valide"."<br>";
}elseif(!$post['newansw']){
	$data['Error'] = "S'il vous pla&icirc;t entrer une r&ecirc;ponse de s&ecirc;curit&ecirc; valide"."<br>";
}elseif(!$post['newmail']||verify_email($post['newmail'])){
	$data['Error'] = "S'il vous pla&icirc;t saisissez votre adresse e-mail"."<br>";
}elseif(!is_mail_available($post['newmail'])){
	$data['Error'] = 'D&egrave;sol&egrave;, mais cette adresse e-mail d&egrave;j&agrave; prises'."<br>";
}elseif($data['UseTuringNumber']&&
	(!$post['turing']||strtoupper($post['turing'])!=$_SESSION['turing'])
){
	$data['Error'] = 'S\'il vous pla&icirc;t entrez le Code de s&egrave;curit&egrave; valide'."<br>";
}elseif($post['terms']!='on'){
	$data['Error'] = 'S\'il vous pla&icirc;t lire nos termes et conditions avant inscription'."<br>";
}else{
	create_confirmation(
		$post['newpass'],
		$post['newques'],
		$post['newansw'],
		$post['newmail'],
		$post['newtype'],
		get_member_id($_SESSION['sponsor'])
	);
	unset($_SESSION['turing']);
	$data['PostSent']=true;
}

if($data['UseTuringNumber']) $_SESSION['turing']=gencode();



if($data['Error']==""){//no errors
	echo '<div class="alert alert-success fade in alert-dismissable">
			   <h1>Félicitations !</h1><p>Votre inscription sur notre site s\'est déroulée avec succès. Afin de valider votre compte,
				 merci de cliquer sur le lien que vous avez reçu par email.</p>
				 <ol>
				 <li>Vérifiez que votre boîte email n\'est pas pleine.</li>
				 <li>Si vous ne recevez pas l\'email, vérifiez bien votre boite "Courrier indésirable" ou "SPAM" et pensez à autoriser
				 les emails provenant de <b>Edinars</b>. </li>
				 </ol>
				 <p>Pour toute question ou problème, n\'hésitez pas à nous contacter.</p>
				 <p>Merci pour votre patience et de l\'intérêt que vous portez à <b>Edinars</b>.</p><p>Cordialement,<br>L\'équipe <b>Edinars</b>.</p>
				</div>';
	echo "<script>
					$('#hor-minimalist-a').hide();
					$('#p_terms').hide();
					$('#submit_creer_un_compte').hide();
				</script>";

}else{
	echo '<div class="alert alert-danger fade in alert-dismissable">
			    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
			    '.$data['Error'].'
				</div>';
	echo "<script>
					$('#submit_creer_un_compte').show();
				</script>";
	//echo "Erreur: " . $data['Error'];
}

###############################################################################
//display('secure');
###############################################################################
?>
