<?php
//
// PROGRAM     : EDINAR APPLICATION                                                 #
// VERSION     : 0.01                                                              #
// AUTHOR      : Arfa Abderrahim                                                   #
// COMPANY     : HOSTDZ                                                             #
// COPYRIGHTS  : (C) HOSTDZ. ALL RIGHTS RESERVED                                    #
// COPYRIGHTS BY (C)2011 HOSTDZ. ALL RIGHTS RESERVDED                        #
//
// DEVELOPED BY HOSTDZ             `                        #
//
// ALL SOURCE CODE, IMAGES, PROGRAMS, FILES INCLUDED IN THIS DISTRIBUTION       #
// COPYRIGHTS BY (C)2012 HOSTDZ. ALL RIGHTS RESERVDED                        #
//
// ANY REDISTRIBUTION WITHOUT PERMISSION OF HOSTDZ AND IS                  #
// STRICTLY FORBIDDEN                                 #
//
// COPYRIGHTS BY (C)2012 HOSTDZ. ALL RIGHTS RESERVDED                        #
//

//

$data['Hostname']=$db_hostname;

$data['Username']=$db_username;

$data['Password']=$db_password;

$data['Database']=$db_database;

$data['DbPrefix']=$db_tbprefix;

//

$data['Folder'] = $folder;

//

$data['confirmation_mobile_number'] = "‎0541348000";

//

$data['SiteName']=stripslashes($site_name);

$data['SiteTitle']=stripslashes($site_title);

$data['SiteCharset']=stripslashes($site_charset);

$data['SiteCopyrights']=stripslashes($site_copyrights);

$data['SiteKeywords']=stripslashes($site_keywords);

$data['SiteDescription']=stripslashes($site_description);

$data['AdminEmail']=$admin_email;

$data['AdmincontactEmail'] = $admin_contact_email;

$data['AdminUsername']=$admin_username;

$data['AdminPassword']=$admin_password;

$data['AdminCheckIp']=$admin_check_ip;

$data['AdminIpAddress']=$admin_ip_address;

$data['ProtectHtml']=$protect_html;

$data['CCP_email']=$CCP_email;

$data['withdraw_email']=$withdraw_email;

$data['error_email'] = $error_email;

//

// PLEASE DO NOT CHANGE INFORMATION BELOW THIS COMMENT           ###

//

$data['MaxRowsByPage']=10;

$data['TopupLenNumber']=$topup_lenght_number;

$data['UseTuringNumber']=$use_turing;

$data['TuringNumbers']=$use_numbers;

$data['TuringSize']=$turing_size;

$data['TuringQuality']=$turing_quality;

$data['TuringBackground']=$turing_bgfile;

$data['UseExtRegForm']=$use_extreg;

$data['DefaultLanguage']=$default_language;

$data['PassLen']=$passlen;

$data['PassAtt']=$passatt;

$data['Currency']=$currency;

$data['CurrSize']=$currsize;

$data['DateFormat']=$dateformat;

$data['SmallDateFormat']=$smalldateformat;

$data['StatGraphic']= $StatGraphic;

$data['StatGraphicTransaction']= $StatGraphicTransaction;

$data['StatGraphicTransactionTotal']= $StatGraphicTransactionTotal;

$data['SignupPays']=$signup_use;

$data['SignupBonus']=$signup_bonus;

$data['ReferralPays']=$affiliate_program;

$data['ReferralLevels']=$affiliate_levels;

$data['ReferralPercent']=$affiliate_percent;

$data['Advertising'] = $advertising;

$data['PaymentFees']=$transfer_fee;

$data['PaymentPercent']=$transfer_percent;

$data['PaymentMinSum']=$minimal_transfer;

$data['PaymentMaxSum']=$maximal_transfer;

$data['RefundPeriod']=$refund_period;

$data['PostMailAddress']=$mail_address;

$data['maxemails']=$maxemails;

$data['CCPAccount']=$ccp_account;

$data['ContactNumber']=$Contact_Numbre;

$data['line']  = array("\r\n", "\n", "\r");

$data['replace']  = '<br />';

$data['DepositMinSum']=$dep_minimal;

$data['DepositMaxSum']=$dep_maximal;


$data['flexy_fee']  = $flexy_fee;

$data['flexy_minimal']=$flexy_minimal;

$data['flexy_maximal']=$flexy_maximal;

$data['sms_fee']=$sms_fee;

//


$data['DepositMethod']=array(
    'CCP'=>array(
        'actv'=>$dep_ccp_use,
        'name'=>'DEPOSER PAR CCP',
        'fees'=>$dep_ccp_fee,
        'prcn'=>$dep_ccp_percent,
        'user'=>$dep_ccp_username,
        'pswd'=>$dep_ccp_password
    ),
    'topup'=>array(
        'actv'=>$dep_topup_use,
        'name'=>'CARTE DE RECHARGE',
        'fees'=>$dep_topup_fee,
        'prcn'=>$dep_topup_percent,
        'user'=>$dep_topup_username,
        'pswd'=>$dep_topup_password
    ),
    'Ediffuse'=>array(
        'actv'=>$dep_Ediffuse_use,
        'name'=>'Ediffuse',
        'fees'=>$dep_Ediffuse_fee,
        'prcn'=>$dep_Ediffuse_percent,
        'user'=>$dep_Ediffuse_username,
        'pswd'=>$dep_Ediffuse_password
    )
);

//

$data['WithdrawMinSum']=$wdr_minimal;
$data['WithdrawMaxSum']=$wdr_maximal;

$data['WithdrawMethod']=array(

    'cheque'=>array(
        'actv'=>$wdr_cc_use,
        'name'=>'Cheque',
        'fees'=>$wdr_cc_fee ,
        'cmnt'=>'RETIRER PAR CHEQUE'
    ),
    'ccp'=>array(
        'actv'=>$wdr_ccp_use,
        'name'=>'CCP',
        'fees'=>$wdr_ccp_fee,
        'cmnt'=>'RETIRER PAR CCP'
    )
);
//
$data['MemberType']=array(
    ''=>'Choisir type de compte',
    0=>'Particuliers',
    1=>'Professionnels',
    2=>'Détaillant',
    2=>'Grossiste'
);
$data['MemberStatus']=array(
    0=>array(
        'action'=>'verify',
        'status'=>'NON V&Egrave;RIFI&Egrave;',
        'button'=>'V&Egrave;RIFIER MAINTENANT'
    ),
    1=>array(
        'action'=>'certify',
        'status'=>'V&Egrave;RIFI&Egrave;',
        'button'=>'CERTIFIE MAINTENANT'
    ),
    2=>array(
        'action'=>'',
        'status'=>'CERTIFI&Egrave;',
        'button'=>''
    )
);

$data['TransactionType']=array(
    0=>'PAIEMENT',
    1=>'DEPOT', // realtime
    2=>'RETIRER',
    3=>'RECHARGE', // realtime
    4=>'INSCRIPTION',
    5=>'COMISSION',
    6=>'REMBOURSEMENT',
    7=>'SMS'
);

$data['TransactionTypeUser']=array(
    0=>'PAIEMENT',
    1=>'DEPOT',
    2=>'RETIRER',
    3=>'RECHARGE',
    //5=>'COMMISSION',
    6=>'REMBOURSEMENT',
    7=>'SMS'
);



//################################ TransactionStatus ######################################
$data['TransactionStatus']=array(
    -1=> 'TOUTE LES TRANSACTIONS',
    1=>'EN ATTENTE',
    2=>'TERMINE',
    3=>'ANNULER',
    4=>'REMBOURSE',
    5=>'EN PROCESSE',
    6=>'ERREUR',
);
// $data['TransactionStatus']=array(
//     -1=> 'TOUTE LES TRANSACTIONS',
//     0=>'EN ATTENTE', -> 1
//     1=>'TERMINE', -> 2
//     2=>'ANNULER',
//     3=>'REMBOURSE',
//     4=>'EN PROCESSE',
//     99=>'ERREUR',
//
// );



$data['TransactionStatusImages']=array(
    0=>'../images/exclamation.png',
    1=>'../images/tick.png',
    2=>'../images/cross.png',
    4=>'../images/process.png'
);

$data['PaymentType']=array(
    0=>'produit',
    1=>'abonnement',
    2=>'donation',
    3=>'paiement'
);

$data['FormParams']=array(
    0=>'owner',
    1=>'action',
    2=>'produit',
    3=>'commande',
    4=>'prix',
    5=>'quantite',
    6=>'periode',
    7=>'essai',
    8=>'installation',
    9=>'tva',
    10=>'livraison',
    11=>'ureturn',
    12=>'unotify',
    13=>'ucancel',
    14=>'comments'
);

$data['direction']=array(
    0=>'images/icons/out.png',
    1=>'images/icons/in.png'
);

$data['question']=array(
    ''=>'Choisir Question de Sécurité?',
    2=>'Prénom de votre oncle préféré?',
    3=>'Surnom de votre premier enfant?',
    4=>'Prénom de votre tante préférée?',
    5=>'Lieu de naissance de ma mére?',
    6=>'Meilleur ami d\'enfance?',
    7=>'Nom de mon premier animal de compagnie?',
    8=>'Professeur préférer?',
    9=>'Personnage historique préférer? ',
    10=>'Métier de mon grand-pére?'
);

$data['FlexyStatus']=array(
    0=>'EN ATTENTE',
    1=>'TERMINE',
    2=>'ANNULER',
    4=>'EN PROCESSUS',
    5=>'EXECUTION',
    99=>'ERROE EXECUTION'

);

$data['operator']=array(
    ''=>array(
            'name'=>'choisir un operator?',
            'ussd'=>'',
            'number'=>''
    ),
    0=>array(
        'name'=>'Djezzy',
        'ussd'=>'',
        'number'=>'07'
    ),
    1=>array(
        'name'=>'Mobilis',
        'ussd'=>'',
        'number'=>'06'
    ),
    2=>array(
        'name'=>'Ooredoo',
        'ussd'=>'*115*',
        'number'=>'05'
    )
);

$data['operator-flexy']=array(
    '' => 'Operator?',
    'Djezzy'=>'Djezzy',
    'Mobilis'=>'Mobilis',
    'Ooredoo'=>'Ooredoo'

);

$data['recharge_type']=array(
    '' => 'Type recharge?',
    'Credit'=>'Credit',
    'Facture'=>'Facture'
);

//

$data['Countries']=array(

    'DZ'=>'Algerie',
);

$data['Wilayas']=array(
    ''=> 'Sélectionner une wilaya?',
    '1'=>'Adrar',
    '44'=>'Ain Defla',
    '46'=>'Ain Timouchent',
    '16'=>'Alger',
    '23'=>'Annaba',
    '5'=>'Batna',
    '8'=>'Bechar',
    '6'=>'Bejaia',
    '7'=>'Biskra',
    '9'=>'Blida',
    '34'=>'Bordj Bou-Arreridj',
    '10'=>'Bouira',
    '35'=>'Boumerdes',
    '2'=>'Chlef',
    '25'=>'Constantine',
    '17'=>'Djelfa',
    '32'=>'El-Bayadh',
    '39'=>'El-Oued',
    '36'=>'El-Taref',
    '47'=>'Ghardaia',
    '24'=>'Guelma',
    '33'=>'Illizi',
    '18'=>'Jijel',
    '40'=>'khenchela',
    '3'=>'Laghouat',
    '26'=>'M&eacute;dea',
    '28'=>'M\'sila',
    '29'=>'Mascara',
    '43'=>'Mila',
    '27'=>'Mostaganem',
    '45'=>'Naama',
    '31'=>'Oran',
    '30'=>'Ouargla',
    '4'=>'Oum El-Bouaghi',
    '48'=>'Relizane',
    '20'=>'Saida',
    '19'=>'Setif',
    '22'=>'Sidi-Bel-Abbes',
    '21'=>'Skikda',
    '41'=>'Souk Ahras',
    '11'=>'Tamanrassat',
    '12'=>'Tebessa',
    '14'=>'Tiaret',
    '37'=>'Tindouf',
    '42'=>'Tipaza',
    '38'=>'Tissimsilt',
    '15'=>'Tizi-Ouzou',
    '13'=>'Tlemcen'
);
//

$data['CreditCardType']=array(
    '0'        => '--',
    'VISA'     => 'Visa',
    'MC'       => 'MasterCard',
    'AMEX'     => 'American Express',
    'DISCOVER' => 'Discover'
);

//

$data['BankAccountType']=array(

    '0' =>'--',

    'PC'=>'Personal Checking',

    'PS'=>'Personal Saving',

    'BC'=>'Business Checking',

    'BS'=>'Business Saving'

);

//

$data['Months'] = array('--');

for($i=1;$i<=12;$i++) {
    $data['Months'][$i] = $i;
}

$data['Years'] = array('--');

for($i=(int)date('Y');$i<=(int)date('Y')+10;$i++) {
    $data['Years'][$i]=$i;
}

// constants for email edit
defined('INVALID_EMAIL_ADDRESS') || define('INVALID_EMAIL_ADDRESS', 1);
defined('EMAIL_EXISTS')          || define('EMAIL_EXISTS', 2);
defined('TOO_MANY_EMAILS')       || define('TOO_MANY_EMAILS', 3);
defined('DB_ERROR')              || define('DB_ERROR', 4);

defined('ALREADY_PRIMARY')       || define('ALREADY_PRIMARY', 5);
defined('EMAIL_NOT_ACTIVE')      || define('EMAIL_NOT_ACTIVE', 6);
defined('EMAIL_NOT_FOUND')       || define('EMAIL_NOT_FOUND', 7);
defined('CANNOT_DELETE_PRIMARY') || define('CANNOT_DELETE_PRIMARY', 8);
defined('SUCCESS')               || define('SUCCESS', 9);
defined('CONFIRMATION_NOT_FOUND')|| define('CONFIRMATION_NOT_FOUND', 10);
