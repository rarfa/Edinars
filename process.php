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
$data['PageName']='DETAILS DE LA COMMANDE';
$data['PageFile']='process';
$data['HideMenu']=true;
###############################################################################
include('config.php');

$oldUrlContent = json_decode(file_get_contents('savedUrl.json'),true);

$ownerKey = (isset($_SESSION['owner']) ? $_SESSION['owner'] : '');
$produitKey = (isset($_SESSION['produit']) ? $_SESSION['produit'] : '');
$key = 0;
if(!$key) $key = '';
$oldUrlContent[$key]['postedReturnUrl'] = (isset($_POST['return'])) ?$_POST['return'] :  ((isset($oldUrlContent[$key]['postedReturnUrl'])) ? $oldUrlContent[$key]['postedReturnUrl'] : '' );
$oldUrlContent[$key]['postedUrlNotify'] = (isset($_POST['notify_url'])) ?$_POST['notify_url'] :  ((isset($oldUrlContent[$key]['postedUrlcancel'])) ? $oldUrlContent[$key]['postedUrlcancel'] : '' );
$oldUrlContent[$key]['postedUrlcancel'] = (isset($_POST['cancel_return'])) ?$_POST['cancel_return'] :  ((isset($oldUrlContent[$key]['postedUrlcancel'])) ? $oldUrlContent[$key]['postedUrlcancel'] : '' );

$myfile = fopen("savedUrl.json", "w+") or die("Unable to open file!");
$txt = json_encode($oldUrlContent);
fwrite($myfile, $txt);


###############################################################################


if(!isset($post['step'])){
  // var_dump($post);

	if ( (strlen($post['pincode']) > 0 ) && (strlen($post['prehashkey']) > 0 ) ) {

		$strToDeCrypt  = prntext($post['crypt']) ;
		$pincode =  '30616141' ;
		$prehashkey =  'EN1u9lwSWdIemOdU3LWEzj5lyBuk_GkJSVSy5e5xY5w' ;
		$strToDeCrypt = decryptPerHashKey ($pincode ,$strToDeCrypt) ;
		$strToDeCrypt = explode("|", $strToDeCrypt);

		// echo "pin code =".$post['pincode']."<br>";
		// echo "prehashkey =".$post['prehashkey']."<br>";
		// var_dump($strToDeCrypt);

		foreach($strToDeCrypt as $key=>$value){
			$part1 = substr($value,0,strpos($value,"=") );
			$part2 = substr($value,strpos($value,"=") + 1,strlen($value));
			$post[$part1]  = $part2;
		}
		$post['identifiant'] = decryptPerHashKey( $pincode, $prehashkey );
		// echo "<br>identifiant =".$post['identifiant']."<br>";

		if ($post['identifiant'] != "" ) {

			$tmp_email = get_member_email_by_username($post['identifiant']);
			// echo "<br>tmp_email =".$tmp_email."<br>";

			$post['owner']=get_member_id($tmp_email);

			$_SESSION['logo'] =get_member_logo($post['identifiant']);
			// echo "<br>owner member id =".$post['owner']."<br>";
			// echo "<br>owner logo =".$_SESSION['logo']."<br>";

			if($post['action']=='produit'|| $post['action']=='donation'||$post['action']=='abonnement' ){
				if(!$post['owner']){
					$post['error'] = "Pincode : {$pincode} \n Le champ identifiant il est vide ou il ne existe pas";
					send_email('ERROR-EMAIL-ADMIN', $post);
					header("Location:{$data['Host']}/error-Edinars/identifiant.html");
					echo('ACCESS DENIED.');
					exit;
				}
				$product=select_product_details($post['produit'], $post['owner']);
				if(!$product){
					$post['error'] = "Pincode : {$pincode} \n Le champ produit il est vide ou il ne existe pas";
					send_email('ERROR-EMAIL-ADMIN', $post);
					header("Location:{$data['Host']}/error-Edinars/produit.html");
					echo('ACCESS DENIED.');
					exit;
				}
				foreach($product as $key=>$value){
					$_SESSION[$key]=$value;
					$post[$key]=$value;
				}
				$_SESSION['pid']=$product['id'];
				$_SESSION['produit']=$product['nom'];
				$_SESSION['action']=$post['action'];
			}elseif($post['action']=='paiement'){

				if( (!$post['prix']) || ( $post['prix'] <= 0)  ){
					$post['error'] = "Pincode : {$pincode} \n Le champ prix il est vide ou il ne existe pas ou le montant est zero";
					send_email('ERROR-EMAIL-ADMIN', $post);

					//header("Location:{$data['Host']}/error-Edinars/prix.html");
					echo('ACCESS DENIED.');
					exit;
				}
				foreach($data['FormParams'] as $value){
					$_SESSION[$value]=$post[$value];
				}
				// var_dump($_SESSION);
				// echo "action = paiement";
				$tmp_email = get_member_email_by_username($post['identifiant']);
				$_SESSION['owner']=get_member_id($tmp_email);
			}else{
				$post['error'] = "Pincode : {$pincode} \n Le champ action il est vide ou il ne existe pas";
				send_email('ERROR-EMAIL-ADMIN', $post);
				header("Location:{$data['Host']}/error-edinars/action.html");
				echo('ACCESS DENIED.');
				exit;
			}
		} else {
      $post['error'] = "Pincode : {$pincode} \n Le champ identifiant il est vide ou il ne existe pas";
      send_email('ERROR-EMAIL-ADMIN', $post);
      header("Location:{$data['Host']}/error-edinars/identifiant-code.html");
      echo('ACCESS DENIED.');
      exit;

		}
	}else{
			unset($_SESSION['login']);
			unset($_SESSION['uid']);
			session_destroy();
			$post['error'] = "Pincode : {$post['pincode']} \n  prehashkey : {$post['prehashkey']} Le champ pincode ou prehashkey il est vide ou il ne existe pas";
			send_email('ERROR-EMAIL-ADMIN', $post);
			header("Location:{$data['Host']}/error-edinars/code.html");
			echo('ACCESS DENIED.');
			exit;
	}

	if($data['UseTuringNumber'])$_SESSION['turing']=gencode();
	if(!$_SESSION['quantite'])$_SESSION['quantite']=1;
	$post['step']=1;

}
###############################################################################
if(isset($post['back'])) $post['step']--;
###############################################################################

if($post['step']==1){

	foreach($data['FormParams'] as $value){
		if($_SESSION[$value]) $post[$value]=$_SESSION[$value];
	}

	if($_POST['prix']) $post['prix']=$_POST['prix'];
	$post['member'] = get_member_username($post['owner']);
	$post['status'] = get_member_status_ex($post['owner']);

	// echo 'member -> '.$post['member']."<br>";
	// echo 'owner -> '.$post['owner']."<br>";

	if ($post['quantite'] == 0) {
		$post['total']=($post['prix']+$post['installation']+$post['tva']+$post['livraison']);
	} else {
		$post['total']=($post['prix']+$post['installation']+$post['tva']+$post['livraison']) * $post['quantite'];
	}
	$_SESSION['total']=$post['total'];

	if($post['send']){
	   unset($_SESSION['ufound']);
		if($post['prix']==0){
			$data['Error']='S\'il vous pla&icirc;t saisissez le montant pour le paiement.';
		}elseif($_SESSION['action']=='paiement'&&
			get_member_status($uid)<2&&$post['price']>$data['PaymentMaxSum']){
				$data['Error']="R&eacute;cepteur ne peut pas recevoir plus de".
					" {$data['PaymentMaxSum']} {$data['Currency']} par".
					" transaction parceque il/elle n'est pas V&Eacute;RIFI&Eacute;ES";
		}elseif(!$post['username']){
			$data['Error']="S'il vous pla&icirc;t saisissez votre identifiant";
		}elseif(!$post['password']){
			$data['Error']="S'il vous pla&icirc;t saisissez votre mot de pass";
		}elseif($post['owner']==get_member_id($post['username'])){
			$data['Error']="Vous ne pouvez pas envoyer un paiement &agrave; vous-m&ecirc;me";
		}elseif($data['UseTuringNumber']&&
		(!$post['turing']||strtoupper($post['turing'])!=$_SESSION['turing'])){
			$data['Error']="S'il vous pla&icirc;t saisissez le Code de s&egrave;curit&egrave;";
		}elseif(!is_member_active($post['username'], $post['password'])){
			$data['Error']="Ce nom d'utilisateur n'est pas trouv&egrave;, inactifs ou interdits";
		}elseif(!is_member_found($post['username'], $post['password'])){
			$data['Error']="Votre avez saisissez un mauvais identifiant ou mot de passe";
		}elseif($post['total']>select_balance(get_member_id($post['username']))){
			$data['Error']="Vous n'avez pas assez d'argent dans votre compte ";
		}else{
			$_SESSION['ufound']=true;
			$_SESSION['acheteur'] = get_member_id($post['username'], $post['password']);
			$post['step']++;

		}
	}
}elseif($post['step']==2){

		if($_SESSION['ufound']){

			$fees=($_SESSION['total']*$data['PaymentPercent']/100)+$data['PaymentFees'];
			$_SESSION['trxid'] = get_trx_id();
			transaction(
					$_SESSION['trxid'],
					$_SESSION['acheteur'],
					$_SESSION['owner'],
					$_SESSION['total'],
					$fees,
					0,
					2,
					$post['notes']
			);
			// Get Transaction if was inserted
			// echo "1 - transaction_id = ".$transaction_id." | session = ".$_SESSION['trxid']."<br>";
			$transaction_id = get_transaction_trx_id($_SESSION['trxid']);
			//
			// echo "2 - transaction_id[0]['trxid'] = ".$transaction_id[0]['trxid']." | session = ".$_SESSION['trxid']."<br>";
			// var_dump($transaction_id);

			if ( $transaction_id[0]['trxid'] == $_SESSION['trxid']) {
					if($_SESSION['action']=='produit'||$_SESSION['action']=='donation'||$_SESSION['action']=='abonnement'){
						update_sold($_SESSION['pid'], $_SESSION['quantite']);
						if($_SESSION['action']=='abonnement'){
						insert_subscription($_SESSION['owner'], $_SESSION['acheteur'], $_SESSION['pid']);
						}
					}

					$post['trxid']=$_SESSION['trxid'];
					$post['fees']=$fees;
					$post['acheteur']=get_member_email($_SESSION['acheteur']);
					$post['montant']=$_SESSION['total'];
					$post['username']=get_member_username($_SESSION['acheteur']);
					$post['comments']=($post['notes']?$post['notes']:'N/A');
					$post['buyer'] = get_member_email($_SESSION['acheteur']);
					$post['seller'] = get_member_email($_SESSION['owner']);
					$post['sellerusername'] =  get_member_username($_SESSION['owner']);
					$post['email-id'] = get_pin_id();
					$post['commande'] = $_SESSION['commande'] ;

					if($_SESSION['action']!='abonnement'){
						$post['uid'] =  $_SESSION['acheteur']  ;
						$post['email']=$post['acheteur'];
						send_email('PAYMENT-MONEY', $post);
						$post['uid'] =  $_SESSION['owner'] ;
						$post['email']=get_member_email($_SESSION['owner']);
						send_email('PAYMENT-MONEY-TO-OWNER', $post);
					}else {
						$post['uid'] =  $_SESSION['acheteur']  ;
						$post['email']= $post['acheteur'];
						send_email('SUBSCRIPTION-MONEY', $post);
						$post['uid'] =  $_SESSION['owner'] ;
						$post['email']=get_member_email($_SESSION['owner']);
						send_email('SUBSCRIPTION-MONEY-TO-OWNER', $post);
					}

					$back['trxid']=$_SESSION['trxid'];
					$back['pid']=$_SESSION['pid'];
					$back['commande']=$_SESSION['commande'];
					$back['pname']=$_SESSION['produit'];
					$back['acheteur']=get_member_username($_SESSION['acheteur']);
					$back['total']=$_SESSION['total'];
					$back['action']=$_SESSION['action'];
					$back['quantity']=$_SESSION['quantity'];
					$back['comments']=$post['notes'];
					$back['refrence']= $data['Host'];
					$back['statut']= 'termine';

					$unotify=$oldUrlContent[$key]['postedNotifyUrl'];
					$ureturn=$oldUrlContent[$key]['postedReturnUrl'];
					$ucancel=$oldUrlContent[$key]['postedCancelUrl'];
				

					foreach($_SESSION as $key=>$value)unset($_SESSION[$key]);
					session_destroy();
					if($unotify)use_curl($unotify, $back); //<== IDK it just bugs things
					if(!$ureturn)$ureturn=$ureturn;
					if(!$ucancel)$ucancel=$ucancel;
					header("Location:$ureturn");


			}else {
			    
				$post['error'] = "Tranasction id : {$_SESSION['trxid']} \n transaction  il est vide ou il ne existe pas \n";
		    foreach($_SESSION as $key=>$value) {
            $post['error'] .= " {$key} = {$_SESSION[$key]}  \n";
				}
				send_email('ERROR-EMAIL-ADMIN', $post);
				$transaction_id = $_SESSION['trxid'];
				foreach($_SESSION as $key=>$value)unset($_SESSION[$key]);



				// session_destroy();
				// header("Location:{$data['Host']}/error-edinars/transaction/".$transaction_id.".html" );
				echo('ACCESS DENIED.');
				exit;

			}

	}
}
###############################################################################
display();
###############################################################################
?>
