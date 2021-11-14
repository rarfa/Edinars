<?php

// include("config.php");
define("DIR_ROOT", "./");
require DIR_ROOT . 'includes/All_files.php';

if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
    header('location:/espace_client');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="csrf_token" content="<?=$_SESSION['csrf_token']?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Erecovery Enterprise - Services de paiements online">
    <meta name="author" content="Sarl Erecovery Enterprise">
    <title>E-Recovery - Services de Paiements en Algerie</title>

    <meta name="theme-color" content="#e30613" />

    <!-- core CSS -->
    <link href="<?=$base_url?>css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="https://fontawesome.io/assets/font-awesome/css/font-awesome.css" rel="stylesheet"> -->
    <link rel="stylesheet" type="text/css" id="theme" href="<?=$base_url?>css/fontawesome/css/font-awesome.min.css"/>
    <link href="<?=$base_url?>css/animate.min.css" rel="stylesheet">
    <link href="<?=$base_url?>css/owl.carousel.css" rel="stylesheet">
    <link href="<?=$base_url?>css/owl.transitions.css" rel="stylesheet">
    <link href="<?=$base_url?>css/prettyPhoto.css" rel="stylesheet">
    <link href="<?=$base_url?>css/main.css" rel="stylesheet">
    <link href="<?=$base_url?>css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="images/ico/favicon_last.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?=$base_url?>images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?=$base_url?>images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?=$base_url?>images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?=$base_url?>images/ico/apple-touch-icon-57-precomposed.png">
    <?php require "includes/google_analytics.php"; ?>
    <script> var base_url = '<?=$base_url?>'; </script>
    <script src="js/jquery.js"></script>
</head><!--/head-->
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5a4eacebd7591465c70680ff/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
<body id="home" class="homepage" >

    <header id="header">
        <nav id="main-menu" class="navbar navbar-default navbar-fixed-top" role="banner" style="max-height:117px;">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><img src="<?=$base_url?>images/logo.svg" alt="logo" height="80"></a>
                </div>

                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <!--<li class="scroll active"><a href="#accueil">Accueil</a></li>-->
                        <li class="scroll"><a href="<?=$base_url?>#features">Particuliers</a></li>
                        <li class="scroll"><a href="<?=$base_url?>#work-process">Professionnels</a></li>
                        <li class="scroll"><a href="#" data-toggle="modal" data-target="#login-modal" role="button" class="login_btn">Se Connecter</a></li>
                        <!-- <li class="scroll"><a href="./#animated-number">Mon Compte</a></li> -->
                        <li class="scroll"><a href="<?=$base_url?>#contactus">Contact</a></li>
                    </ul>
                </div>
            </div><!--/.container-->
        </nav><!--/nav-->
    </header><!--/header-->

    <?php

    require "includes/header.login.php";
    require "includes/includer.php";
    ?>

    <footer id="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                     Copyright © 2021 <b>E-Recovery</b>. Tous droits réservés
                </div>
                <div class="col-sm-6">
                    <ul class="social-icons">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer><!--/#footer-->


    <script src="<?=$base_url?>js/bootstrap.min.js"></script>
    <script src="<?=$base_url?>js/owl.carousel.min.js"></script>
    <script src="<?=$base_url?>js/mousescroll.js"></script>
    <script src="<?=$base_url?>js/jquery.prettyPhoto.js"></script>
    <script src="<?=$base_url?>js/jquery.isotope.min.js"></script>
    <script src="<?=$base_url?>js/jquery.inview.min.js"></script>
    <script src="<?=$base_url?>js/wow.min.js"></script>
    <script src="<?=$base_url?>js/main.js?update=<?=time()?>"></script>
    <script src="<?=$base_url?>js/validation-login.js"></script>
    <script src="<?=$base_url?>js/common.js?update=<?=time()?>"></script>


</body>
</html>
