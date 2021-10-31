<html lang="en">
<head>
    <title><?php echo prntext($data['SiteTitle'])?></title>
    <META http-equiv="X-UA-Compatible" content="IE=edge" />
    <META name="Title" content="<?php echo prntext($data['SiteTitle'])?>">
    <META name="Description" content="<?php echo prntext($data['SiteDescription'])?>">
    <META name="Keywords" content="<?php echo prntext($data['SiteKeywords'])?>">
    <META name="Copyright" content="<?php echo prntext($data['SiteCopyrights'])?>">
    <META name="Classification" content="Business">
    <META name="Rating" content="General">
    <META name="Robots" content="index,nofollow">
    <META name="Revisit-After" content="7 Days">
    <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
    <META HTTP-EQUIV="Expires" CONTENT="-1">
    <META http-equiv=Content-Type content="text/html; charset=<?php echo prntext($data['SiteCharset'])?>">

    <link rel="shortcut icon" href="/favicon.ico">
    <link href="<?php echo $data['Host']?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $data['Host']?>/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo $data['Host']?>/css/animate.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $data['Host']?>/css/style.css">

    <script type="text/javascript" language="JavaScript">document.oncontextmenu=new Function("return false")</script>
    <script type="text/javascript" src="<?php echo $data['Host']?>/js/jquery-1.7.2.min.js"></script>

    <!-- Parada libs -->
        <link rel="stylesheet" href="<?php echo $data['Host']?>/css/smoothDivScroll.css" type="text/css" />

        <script type="text/javascript" src="<?php echo $data['Host']?>/js/jquery-ui-1.8.18.custom.min.js"></script>
        <script type="text/javascript" src="<?php echo $data['Host']?>/js/jquery.mousewheel.min.js"></script>
        <script type="text/javascript" src="<?php echo $data['Host']?>/js/jquery.smoothDivScroll-1.2.js"></script>
    <!--/ Parada libs -->

    <!-- FQA -->
        <script type="text/javascript"  src="<?php echo $data['Host']?>/js/jquery.scrollTo-1.4.2-min.js"></script>
        <script type="text/javascript"  src="<?php echo $data['Host']?>/js/jquery.localscroll-1.2.7-min.js"></script>
    <!-- /FQA -->
    <!-- Validation -->
    <script type="text/javascript" src="<?php echo $data['Host']?>/js/jquery.validationEngine-fr.js"  charset="utf-8"></script>
    <script type="text/javascript" src="<?php echo $data['Host']?>/js/jquery.validationEngine.js" charset="utf-8"></script>

    <link rel="stylesheet" href="<?php echo $data['Host']?>/css/validationEngine.jquery.css" type="text/css"/>

    <script type="text/javascript"  src="<?php echo $data['Host']?>/js/validation-login.js"></script>
    <script type="text/javascript" src="<?php echo $data['Host']?>/js/jquery.js"></script>



    <!-- Validation -->
    <?if($_SESSION['login']){?>
        <link rel="stylesheet" type="text/css" href="<?php echo $data['Host']?>/css/style_table_admin.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $data['Host']?>/css/green.css" />
        <script src="<?php echo $data['Host']?>/js/bootstrap.min.js"></script>

        <!-- jQuery Configuration -->

        <script type="text/javascript" src="<?php echo $data['Host']?>/js/script.js"></script>
<!--[if lte IE 6]>
<link href="<?php echo $data['Host']?>/css/green_ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
    <?php } else { ?>
        <script>
            /* Slide Show */
            $('#coin-slider').coinslider({ width: 900,height:395, navigation: true, delay: 1500 });
        </script>
    <?php } ?>


  <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-35319889-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>



</head>


<body>
<!-- Start navbar  -->

<nav id="nav" class="ry">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
        <?if(!$_SESSION['login']){?>

                <ul id="navbar">
                    <li><a href="<?php echo $data['Host']?>/acceuil-Edinars.html">Acceuil</a>
                        <ul  id="sous_nav" >
                            <li><a href="<?php echo $data['Host']?>/a-propos-de-Edinars.html">A Propos de E-Dinars</a></li>
                            <li><a href="<?php echo $data['Host']?>/comment-ca-marche-Edinars.html">Comment &ccedil;a marche</a></li>
                            <li><a href="<?php echo $data['Host']?>/pourquoi-choisir-Edinars.html">Pourquoi nous choisir</a></li>

                        </ul>
                    </li>
                    <li><a href="<?php echo $data['Host']?>/comment-acheter-Edinars.html">Achat</a>
                        <ul id="sous_nav">
                            <li><a href="<?php echo $data['Host']?>/comment-acheter-Edinars.html">Comment Acheter</a></li>
                            <li><a href="<?php echo $data['Host']?>/ou-acheter-Edinars.html">Ou Acheter</a></li>
                        </ul>

                    </li>
                    <li><a href="<?php echo $data['Host']?>/comment-vendre-Edinars.html">Vente</a>
                        <ul id="sous_nav">
                            <li><a href="<?php echo $data['Host']?>/comment-vendre-Edinars.html">Comment vendre</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Services</a>
                        <ul id="sous_nav">
                            <!--<li><a href="<?php echo $data['Host']?>/envoyer-un-sms-Edinars.html">Envoyer un SMS</a></li>-->
                            <li><a href="<?php echo $data['Host']?>/recharger-mobile-Edinars.html">Recharger Mobile</a></li>
                            <li><a href="<?php echo $data['Host']?>/e-commerce-Edinars.html">Site E-commerce</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Support</a>
                        <ul id="sous_nav">
                            <li><a href="<?php echo $data['Host']?>/conditions-utilisation-Edinars.html">Conditions d'utilisation</a></li>
                            <li><a href="<?php echo $data['Host']?>/questions-frequentes-Edinars.html">Questions fréquentes</a></li>
                            <li><a href="<?php echo $data['Host']?>/garanties-Edinars.html">Garanties avec Edinars</a></li>
                            <li><a href="<?php echo $data['Host']?>/tarifs-Edinars.html">Tarifs avec Edianrs</a></li>
                        </ul>
                    </li>
                    <li><a href="<?php echo $data['Host']?>/contact-Edinars.html">Contacts</a></li>
                </ul>

             <?} else {?>


                    <ul id="menu1" >
                            <li><a href="#">MON COMPTE</a>
                                <ul >
                                    <li class="<?if($data['PageFile']=='index'){?>current<?}?> li-first"><a href="<?php echo $data['Members']?>/mon-compte-Edinars.html">Accueil</a> </li>

                                    <li class="<?if($data['PageFile']=='transactions'){?>current<?}?>"><a href="<?php echo $data['Members']?>/mon-historique-Edinars.html">Historique </a> </li>

                                    <li class="<?if($data['PageFile']=='deposit'){?>current<?}?>"><a href="<?php echo $data['Members']?>/deposit-Edinars.html">Recharger Votre compte </a> </li>

                                    <li class="<?if($data['PageFile']=='profile'){?>current<?}?>"><a href="<?php echo $data['Members']?>/mon-profile-Edinars.html">Modifier votre profile</a> </li>
                                    <li class="<?if($data['PageFile']=='emails'){?>current<?}?>"><a href="<?php echo $data['Members']?>/mes-emails-Edinars.html">G&egrave;rer vos adresses emails</a> </li>
                                    <li class="<?if($data['PageFile']=='password'){?>current<?}?>"><a href="<?php echo $data['Members']?>/mes-acces-Edinars.html">Confidentialite</a> </li>
                                    <li class="<?if($data['PageFile']=='close'){?>current<?}?>"><a href="<?php echo $data['Members']?>/fermer-mon-compte-Edinars.html">Fermer votre compte </a></li>
                                </ul>
                            </li>
                            <li><a href="#">MARCHANDS</a>
                                <ul  >

                                    <li class="<?if($data['PageFile']=='products'){?>current<?}?> li-first"><a href="<?php echo $data['Members']?>/products-Edinars.html">Produits</a></li>

                                    <li class="<?if($data['PageFile']=='payment'){?>current<?}?>"><a href="<?php echo $data['Members']?>/paiments-Edinars.html">Paiement simple</a></li>

                                    <li class="<?if($data['PageFile']=='subscriptions'){?>current<?}?>" ><a href="<?php echo $data['Members']?>/subscriptions-Edinars.html">Abonnements</a></li>

                                    <li class="<?if($data['PageFile']=='donations'){?>current<?}?>"><a href="<?php echo $data['Members']?>/donations-Edinars.html">Donation</a></li>

                                </ul>
                            </li>
                            <li><a href="#">PAIEMENTS</a>
                                <ul >
                                    <li class="<?if($data['PageFile']=='retirer'){?>current<?}?> li-first"><a href="<?php echo $data['Members']?>/retirer-Edinars.html">Retirer de l'argent</a> </li>
                                    <li class="<?if($data['PageFile']=='envoyez'){?>current<?}?>"><a href="<?php echo $data['Members']?>/envoyez-Edinars.html">Envoyer un payement</a> </li>
                                    <li class="<?if($data['PageFile']=='demande'){?>current<?}?>"><a href="<?php echo $data['Members']?>/demande-Edianrs.html">Demander un payement</a></li>
                                </ul>
                            </li>
                            <li><a href="#">SERVICES</a>
                                <ul >
                                    <li class="<?if($data['PageFile']=='sms'){?>current<?}?>" ><a href="<?php echo $data['Members']?>/envoyer-un-sms-Edinars.html">Envoyer un SMS</a></li>
                                    <li class="<?if($data['PageFile']=='flexy'){?>current<?}?> li-first" ><a href="<?php echo $data['Members']?>/recharger-mobile-Edinars.html">Rechrager votre mobile</a></li>
                        
                                </ul>
                            </li>
                            <?if($data['ReferralPays']){?>
                                <li><a href="#">PARRAINAGE</a>
                                    <ul >
                                        <li class="<?if($data['PageFile']=='affdetails'){?>current<?}?> li-first"><a href="<?php echo $data['Members']?>/parrainage-Edinars.html">DETAIL DE PROGRAME</a> </li>
                                        <li class="<?if($data['PageFile']=='affdownline'){?>current<?}?>"><a href="<?php echo $data['Members']?>/DOWNLINE-Edinars.html">YOUR&nbsp;DOWNLINE</a> </li>
                                        <li class="<?if($data['PageFile']=='affbanners'){?>current<?}?>"><a href="<?php echo $data['Members']?>/bannieres-Edinars.html">DEMANDE UN PAIEMENT</a></li>
                                    </ul>
                                </li>
                            <?}?>
                            <?if($data['Advertising']){?>
                             <li class="<?if($data['PageFile']=='advertising'){?>current<?}?> li-first"><a href="<?php echo $data['Members']?>/publicite-Edinars.html">PUBLICIT&Egrave;</a> </li>
                            <?}?>
                            <li><a href="<?php echo $data['Members']?>/deconnexion.html">D&Egrave;CONNEXION</a>


                            </li>
                        </ul>

            <?php } ?>
               </div>
            </div>
   </div>



</nav>


<!-- End navbar  -->

<div class="container padding_zero">
<div class="row">
<?if(!$_SESSION['login']){?>
<div class="col-md-12 padding_zero">
    <div id="login">
            <form id="login-form"  method="post" >
                <span id="msgbox" style="display:none"></span>
                <input type="text" id="username" name="username"  placeholder="Identifiant"/>
                <input type="password" id="password" name="password" placeholder="Mot de passe"/>
                <input type="submit"   id="submit"   name="connecter" value="Se Connecter"   />
                <input type="button"   id="inscription" name="inscription"  value="Ouvrir un Compte"  />

            </form>

    </div>
</div>
<? }?>
<!-- Start header  -->
<header>
    <div class="logo">

            <?if($_SESSION['login']){?>

            <div class="col-md-12 text-right">

                        <div class="top-side">
                            <span><span>Numero Compte:</span> <?php echo $_SESSION['Mem_Id']?></span> |
                            <span><span>Solde:</span> <?php echo showBalance($data['Balance'], true)?></span> |
                            <span><span>Disponible:</span> <?php echo showBalance($data['Balance-disponible'], true)?></span> |
                            <span><span>Derni&egrave;re connexion:</span><?php echo $_SESSION['Connexion']?></span>
                        </div>
            </div>
                    <?php } ?>
        <div class="col-md-12"><div class="l"><img src="<?php echo $data['Host']?>/images/logo.png" alt="Edinars" /></div></div>



    </div>
</header>
</div>
</div>
<!-- End header  -->
