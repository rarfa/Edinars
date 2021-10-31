<?php
// Created by: Yacine Ait Chalal -> 19/08/2017
// 
header('Content-Type: application/json');

define("DIR_ROOT", "../../");

require DIR_ROOT.'includes/All_files.php';

// security
require 'verif_user.php';


$array_reponse = array( 'code'=> 'scripts',
                        'success'=>'yes' );



$info_user = select_info($user_id, $post);


//code
$strToCrypt = "action={$tname}|" ;

$pincode = get_member_username_pincode($user_id);
$prehashkey = get_member_username_hashkey($user_id);


$code =htmlspecialchars(
    "<!-- {$data['SiteName']} FORMULAIRE DE PAIEMENT  -->\n".
    "<form method=post action={$data['Host']}/edinars-paiments.html>\n".
    "<input type='hidden' name='pincode'  value='".$pincode."'>\n".
    "<input type='hidden' name='prehashkey'  value='".$prehashkey."'>\n".
    "<input type='hidden' name='crypt'  value='".$strToCrypt."'>\n".
    "<input type='hidden' name='action' value=\"produit/donation/abonnement/paiement\">\n".
    "<input type='hidden' name='commande' value=\"--NUMERO-DE-COMMANDE--\">\n".
    "<input type='hidden' name='produit' value=\"--NOM-DE-PRODUIT-SERVICE--\">\n".
    "<input type='hidden' name='prix' value=\"--PRIX--\">\n".
    "<input type='hidden' name='quantite' value=\"--QUANTITE--\">\n".
    "<input type='hidden' name='periode' value=\"--PERIODE--\">\n".
    "<input type='hidden' name='essai' value=\"--P&Eacute;RIODE D'ESSAI--\">\n".
    "<input type='hidden' name='installation' value=\"--FRAIS-D'INSTALLATION--\">\n".
    "<input type='hidden' name='tva' value=\"--FRAIS-DE-TVA--\">\n".
    "<input type='hidden' name='livraison' value=\"--FRAIS-DE-LIVRAISON--\">\n".
    "<input type='hidden' name='ureturn' value=\"--RETURN-URL--\">\n".
    "<input type='hidden' name='unotify' value=\"--NOTIFY-URL--\">\n".
    "<input type='hidden' name='ucancel' value=\"--CANCEL-URL--\">\n".
    "<input type='hidden' name='comments' value=\"--YOUR-COMMENTS--\">\n".
    "<input type='image' src=\"--VOTRE-BOUTON-ICI--\">\n".
    "</form>\n".
    "<!-- {$data['SiteName']} FORMULAIRE DE PAIEMENT  -->", ENT_QUOTES
);

$array_reponse['code'] = $code;

$array_reponse['pincode'] = $pincode;
$array_reponse['prehashkey'] = $prehashkey;

echo json_encode($array_reponse);
