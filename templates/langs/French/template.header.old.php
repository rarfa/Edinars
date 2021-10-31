<html lang="en">
<head>
  <title><?php echo prntext($data['SiteTitle'])?></title>
   <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name=Title content="<?php echo prntext($data['SiteTitle'])?>">
  <meta name=Description content="<?php echo prntext($data['SiteDescription'])?>">
  <meta name=Keywords content="<?php echo prntext($data['SiteKeywords'])?>">
  <meta name=Copyright content="<?php echo prntext($data['SiteCopyrights'])?>">
  <meta name=Classification content="Business">
  <meta name=Rating content="General">
  <meta name=Robots content="index,nofollow">
  <meta name=Revisit-After content="7 Days">
  <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
  <META HTTP-EQUIV="Expires" CONTENT="-1">



<meta http-equiv=Content-Type content="text/html; charset=<?php echo prntext($data['SiteCharset'])?>">
<link rel="shortcut icon" href="/favicon.ico">
<link rel="stylesheet" href="<?php echo $data['Host']?>/css/reset.css" type="text/css" media="all">
<link rel="stylesheet" href="<?php echo $data['Host']?>/css/layout.css" type="text/css" media="all">
<link rel="stylesheet" href="<?php echo $data['Host']?>/css/style.css" type="text/css" media="all">
<link type="text/css" href="<?php echo $data['Host']?>/css/jquery-ui-1.8.14.custom.css" rel="stylesheet" />    


        
<!--<script type="text/javascript" src="<?php echo $data['Host']?>/js/maxheight.js"></script> -->
<!--<script type="text/javascript" src="<?php echo $data['Host']?>/js/jquery-1.4.2.min.js"></script> -->
<!-- <script type="text/javascript" src="<?php echo $data['Host']?>/js/jquery-1.5.1.min.js"></script> -->
<script type="text/javascript" src="<?php echo $data['Host']?>/js/cufon-yui.js"></script>
<script type="text/javascript" src="<?php echo $data['Host']?>/js/cufon-replace.js"></script>
<script type="text/javascript" src="<?php echo $data['Host']?>/js/Myriad_Pro_300.font.js"></script>
<script type="text/javascript" src="<?php echo $data['Host']?>/js/Myriad_Pro_400.font.js"></script>
<script type="text/javascript" src="<?php echo $data['Host']?>/js/jquery.faded.js"></script>
<script type="text/javascript" src="<?php echo $data['Host']?>/js/jquery.jqtransform.js"></script>
<script type="text/javascript" src="<?php echo $data['Host']?>/js/script.js"></script>

<script type="text/javascript" src="<?php echo $data['Host']?>/js/jquery-1.6.min.js"></script>
<script type="text/javascript" src="<?php echo $data['Host']?>/js/jquery-ui-1.8.14.custom.min.js"></script>

<script type="text/javascript" src="<?php echo $data['Host']?>/js/script.js"></script>
<script type="text/javascript" src="<?php echo $data['Host']?>/js/javascript.js"></script>
<script type="text/javascript"  src="<?php echo $data['Host']?>/js/validation-login.js"></script>

<script type="text/javascript"  src="<?php echo $data['Host']?>/js/jquery.scrollTo-1.4.2-min.js"></script>
<script type="text/javascript"  src="<?php echo $data['Host']?>/js/jquery.localscroll-1.2.7-min.js"></script>

<script type="text/javascript" src="<?php echo $data['Host']?>/js/jquery.validationEngine-fr.js"  charset="utf-8"></script>
<script type="text/javascript" src="<?php echo $data['Host']?>/js/jquery.validationEngine.js" charset="utf-8"></script>

<link rel="stylesheet" href="<?php echo $data['Host']?>/css/validationEngine.jquery.css" type="text/css"/>
 <link rel="stylesheet" href="<?php echo $data['Host']?>/css/template.css" type="text/css"/>

<script type="text/javascript">function s(){window.status="<?php echo prntext($data['SiteTitle'])?>";return true};if(document.layers)document.captureEvents(Event.MOUSEOVER|Event.MOUSEOUT|Event.CLICK|Event.DBLCLICK);document.onmouseover=s;document.onmouseout=s;</script>

<!--[if lt IE 7]>
<script type="text/javascript" src="http://info.template-help.com/files/ie6_warning/ie6_script_other.js"></script>
<![endif]-->
<!--[if lt IE 9]>
<script type="text/javascript" src="<?php echo $data['Host']?>/js/html5.js"></script>
<![endif]-->
<script>
            jQuery(document).ready(function(){
                // binds form submission and fields to the validation engine
                jQuery("#sigup-form").validationEngine();
            });
</script>
        
</head>
<body id="page1">
<div class="tail-top">
<!-- header -->
    <header>
        <div class="container">
            <?if(!$_SESSION['login']){?>

                <div class="header-box">
                    <div class="left">
                        <div class="right">
                            <div class="nav">
                                <ul>
                                    <li><a href="<?php echo $data['Host']?>/acceuil-Edinars">Acceuil</a>
                                        <ul>
                                            <li><a href="<?php echo $data['Host']?>/a-propos-de-Edinars">A Propos de E-Dinars</a></li>
                                            <li><a href="<?php echo $data['Host']?>/comment-ca-marche-Edinars">Comment &ccedil;a marche</a></li>
                                            <li><a href="<?php echo $data['Host']?>/pourquoi-choisir-Edinars">Pourquoi nous choisir</a></li>
                                            
                                        </ul>    
                                    </li>
                                    <li><a href="<?php echo $data['Host']?>/comment-acheter-Edinars">Achat</a>
                                        <ul>
                                            <li><a href="<?php echo $data['Host']?>/comment-acheter-Edinars">Comment Acheter</a></li>
                                            <li><a href="<?php echo $data['Host']?>/ou-acheter-Edinars">Ou Acheter</a></li>
                                        </ul>
                                        
                                    </li>
                                    <li><a href="<?php echo $data['Host']?>/comment-vendre-Edinars">Vente</a>
                                        <ul>
                                            <li><a href="<?php echo $data['Host']?>/comment-vendre-Edinars">Comment vendre</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="<?php echo $data['Host']?>/ouvrir-un-compte-Edinars">Ouvrir un compte</a></li>
                                    <li><a href="#">Services</a>
                                        <ul>
                                            <li><a href="<?php echo $data['Host']?>/envoyer-un-sms-Edinars">Envoyer un SMS</a></li>
                                            <li><a href="<?php echo $data['Host']?>/recharger-mobile-Edinars">Recharger Mobile</a></li>
                                            <li><a href="<?php echo $data['Host']?>/e-commerce-Edinars">Site E-commerce</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Support</a>
                                        <ul>
                                            <li><a href="<?php echo $data['Host']?>/conditions-utilisation-Edinars">Conditions d'utilisation</a></li>
                                            <li><a href="<?php echo $data['Host']?>/questions-frequentes-Edinars">Questions fréquentes</a></li>
                                            <li><a href="<?php echo $data['Host']?>/garanties-Edinars">Garanties avec Edinars</a></li>
                                            <li><a href="<?php echo $data['Host']?>/tarifs-Edinars">Tarifs avec Edianrs</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="<?php echo $data['Host']?>/contact-Edinars">Contacts</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="top-info"> 
                        <img src="<?php echo $data['Host']?>/images/logo.png"> 
                </div> 
                <div class="panel">
                    <div  id="loginPanel">
                            <center>
                            <br>
                            <span class="header">Connection aux compte</span>
                            <div class="LoginLeft">
                                <form action="" id="login-form" method="post">
                                <input type="hidden" name="send" value="Ouvrir un compte" >
                                      <fieldset>
                                            <div class="field text">
                                                <label>Identifiant (*): </label>
                                                <input type="text" id="username" name="username" size="30" maxlength="128" value="<?php echo prntext($post['username'])?>">
                                                <br>
                                                <span id="usernameInfo"></span>
                                            </div>
                                            <div class="field text">
                                                <label>Mot de passe (*):</label>
                                                <input type="password" id="password" name="password" size="30" maxlength="30" value="<?php echo prntext($post['password'])?>">
                                                <br>
                                                <span id="passwordInfo"></span>
                                            </div>
                                            <?if($data['UseTuringNumber']){?>
                                            <div class="field text">
                                                <label>Code de s&egrave;curit&egrave; (*):</label>
                                                <input type="text" id="turing" name="turing" size="30" maxlength="32">
                                                <br>
                                                <span id="securityInfo"></span>
                                            </div>    
                                            <div class="field text">
                                                <img src="<?php echo $data['Host']?>/turing.htm" width="150" height="30" border="1">
                                            </div>    
                                            <?}?>
                                            <div class="alignright">
                                                <input type="submit" id="submit" name="send" value="Connectez-vous" />
                                                <br>
                                                <div class="field text">
                                                <label>
                                                 <br>
                                                    <a href="<?php echo $data['Host']?>/mot-de-passe-oublie">Mot de passe oubli&egrave;?</a>
                                                </label>
                                            </div>
                                            
                                                
                                            </div>
                                        </fieldset>
                                </form>
                            </div>
                            
                            <div class="LoginRight">
                                    
                                   <div class="ui-widget" id="ui" style="display:none">
                                    <div class="ui-state-error ui-corner-all" style="padding: 0 .7em; width: 250px;"> 
                                        <p><span class="ui-icon ui-icon-alert" style="float: centre; margin-right: .3em;"></span> 
                                        <span id="msgbox" style="display:none"></span>
                                    </div>
                                    </div>
                            </div>
                            
                     </center>            
                    </div>
                </div>
                    <div class="panel_button" style="display: visible;"><a href="#">Connection</a> </div>
                    <div class="panel_button" id="hide_button" style="display: none;"><a href="#">fermer</a> </div>
                    </div>
                </div>
                
                    
             <?} else {?>
                    <div class="header-box">
                        <div class="left">
                            <div class="right">
                                <div class="nav">
                                    <ul>
                                        <li><a href="#">MON COMPTE</a>
                                            <ul>
                                                <li class="<?if($data['PageFile']=='index'){?>current<?}?>"><a href="<?php echo $data['Members']?>/mon-compte-Edinars">SOMMAIRE&nbsp;&nbsp;</a> </li>
                                                <li class="<?if($data['PageFile']=='transactions'){?>current<?}?>"><a href="<?php echo $data['Members']?>/mon-historique-Edinars">HISTORIQUE</a> </li>
                                                <li class="<?if($data['PageFile']=='profile'){?>current<?}?>"><a href="<?php echo $data['Members']?>/mon-profile-Edinars">MODIFIER&nbsp;PROFILE</a> </li>
                                                <li class="<?if($data['PageFile']=='emails'){?>current<?}?>"><a href="<?php echo $data['Members']?>/mes-emails-Edinars">G&Egrave;RER&nbsp;EMAILS</a> </li>
                                                <li class="<?if($data['PageFile']=='password'){?>current<?}?>"><a href="<?php echo $data['Members']?>/mes-acces-Edinars">S&Egrave;CURIT&Egrave; D'ACC&Egrave;S</a> </li>
                                                <li class="<?if($data['PageFile']=='close'){?>current<?}?>"><a href="<?php echo $data['Members']?>/fermer-mon-compte-Edinars">FERMER&nbsp;LE&nbsp;COMPTE</a></li>
                                            </ul>
                                        </li>    
                                        <li><a href="#">Service Merchant</a>
                                            <ul>        
                                                <li class="<?if($data['PageFile']=='products'){?>current<?}?>"><a href="<?php echo $data['Members']?>/products-Edinars">PRODUITS&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
                                                <li class="<?if($data['PageFile']=='donations'){?>current<?}?>"><a href="<?php echo $data['Members']?>/donations-Edinars">DONATIONS</a></li>
                                                <li class="<?if($data['PageFile']=='subscriptions'){?>current<?}?>" ><a href="<?php echo $data['Members']?>/subscriptions-Edinars">ABONNEMENTS</a></li>
                                                <li class="<?if($data['PageFile']=='payment'){?>current<?}?>"><a href="<?php echo $data['Members']?>/paiments-Edinars">PAIMENTS SIMPLE</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#">Services Paiements</a>
                                            <ul>    
                                                <li class="<?if($data['PageFile']=='deposit'){?>current<?}?>"><a href="<?php echo $data['Members']?>/deposit-Edinars">D&Egrave;POSER</a> </li>
                                                <li class="<?if($data['PageFile']=='retirer'){?>current<?}?>"><a href="<?php echo $data['Members']?>/retirer-Edinars">RETIRER DE L'ARGENT</a> </li>
                                                <li class="<?if($data['PageFile']=='envoyez'){?>current<?}?>"><a href="<?php echo $data['Members']?>/envoyez-Edinars">ENVOYEZ UN PAIEMENT</a> </li>
                                                <li class="<?if($data['PageFile']=='demande'){?>current<?}?>"><a href="<?php echo $data['Members']?>/demande-Edianrs">DEMANDE UN PAIEMENT</a></li>
                                            </ul>
                                        </li>
                                        <?if($data['ReferralPays']){?>
                                            <li><a href="#">parrainage</a>
                                                <ul>
                                                    <li class="<?if($data['PageFile']=='affdetails'){?>current<?}?>"><a href="<?php echo $data['Members']?>/parrainage-Edinars">Detail de programe</a> </li>
                                                    <li class="<?if($data['PageFile']=='affdownline'){?>current<?}?>"><a href="<?php echo $data['Members']?>/DOWNLINE-Edinars">YOUR&nbsp;DOWNLINE</a> </li>
                                                    <li class="<?if($data['PageFile']=='affbanners'){?>current<?}?>"><a href="<?php echo $data['Members']?>/bannieres-Edianrs">DEMANDE UN PAIEMENT</a></li>
                                                </ul>
                                            </li>
                                        <?}?>
                                        <?if($data['Advertising']){?>
                                         <li class="<?if($data['PageFile']=='advertising'){?>current<?}?>"><a href="<?php echo $data['Members']?>/publicite-Edianrs">Publicit&egrave;</a> </li>
                                        <?}?>
                                        <li><a href="<?php echo $data['Members']?>/deconnexion">D&egrave;connexion</a></li>
                                    </ul>
                                </div>
                                
                            </div>
                        </div>    
                    
                    </div>
                        <div class="top-info"><img src="<?php echo $data['Host']?>/images/logo.png"></div> 
                        <div class="top-side">
                            <p><span>Numero Compte:</span> <?php echo $_SESSION['Mem_Id']?></p>
                            <p><span>Solde:</span> <?php echo showBalance($_SESSION['Balance'], true)?></p>
                            <p><span>Derni&egrave;re connexion:</span><?php echo $_SESSION['Connexion']?></p>
                        </div>
            <?php } ?>
        </div>
    
    </header>

<!-- content -->
