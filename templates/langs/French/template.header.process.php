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
    <link href="<?php echo $data['Host']?>/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $data['Host']?>/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $data['Host']?>/css/style_table_admin.css" />
    <script type="text/javascript" language="JavaScript">document.oncontextmenu=new Function("return false")</script>
    
    <!-- Validation -->
       <script type="text/javascript" src="<?php echo $data['Host']?>/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="<?php echo $data['Host']?>/js/jquery.validationEngine-fr.js"  charset="utf-8"></script>
    <script type="text/javascript" src="<?php echo $data['Host']?>/js/jquery.validationEngine.js" charset="utf-8"></script>
    
    <link rel="stylesheet" href="<?php echo $data['Host']?>/css/validationEngine.jquery.css" type="text/css"/>
   

</head>

<body>
<section class="headerpay">
<!-- Start header  -->
 <div class="container">
  <div class="row">
    <div class="col-md-12">
<header>
    <div class="logo">
        <div class="l"><a href="https://www.edinars.net/" title="edinars"><img src="<?php echo $data['Host']?>/images/logo.png" /></a>
            <div class="top-side-process">
<?if($post['step']==1){?>
    <div class="col_title">&Egrave;tape 1 - Connection aux compte</div>
        <div class="col_text ">
            <p class="pm">
            <form method="post" id="payment-form" >
                <input type="hidden" id="step" name="step" value="<?php echo $post['step']?>">
                <table style="width: 705px;color: #fff;" class="tablconnection" id="rounded-corner-long" summary="Connection aux compte" >
                    <tr>
                        <td></td>
                        <td></td>
                        <td rowspan="5" class="rounded-foot-left">
                                            <input type="submit" id="submit" name="send" value="Connectez-vous" />    
                                            <br><br>
                                            <?if($post['step']==1){?>
                                                    <input type="button" id="submit" name="Annuler" value="Annuler" onclick="document.location.href='<?php echo $post['ucancel']?>'" />
                                            <?}?>
                        </td>
                    </tr>
                    <tr>
                        <td align="centre">Identifiant (*)</td>
                        <td><input type="text" id="username" name="username"  maxlength="128" value="<?php echo prntext($post['username'])?>" class="validate[required,custom[email]] text-input"></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Mot de passe (*)</td>
                        <td><input type="password" id="password" name="password"  maxlength="30" value="<?php echo prntext($post['password'])?>" class="validate[required,optional,minSize[9]] text-input"></td>
                        <td></td>
                    </tr>
                        <?if($data['UseTuringNumber']){?>
                    <tr>
                        <td>Code de s&egrave;curit&egrave; (*):</td>
                        <td> <input type="text" id="turing" name="turing" size="30" maxlength="32""></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center" ><img src="<?php echo $data['Host']?>/turing.htm" width="150" height="30" border="1"></td>
                    </tr>
                    <?}?>
                    
                    <tr>
                        <td colspan=2 >SI VOUS N'AVEZ PAS DE COMPTE
                         <a href="ouvrir-un-compte-Edinars/<?php echo $post['member']?>" target=new>CLIQUEZ ICI</a></td>
                        <td></td>
                    </tr>            
                    
                </tfoot>
                <tbody>
                </tbody>
            </table>
            </form>
        </p>
        </div>
<?}elseif($post['step']==2){?>
<div class="col_title">&Egrave;tape 2 - Confirmation de Paiement</div>
        <div class="col_text">
            <p class="pm">
<form method="post" id="payment-form" >
<input type="hidden" id="step" name="step" value="<?php echo $post['step']?>">
                 
    <table id="rounded-corner-long" summary="Connection aux compte">
        <tr>
            <td></td>
            <td></td>
            <td rowspan="4" class="rounded-foot-left">
                    <input type="submit" id="submit" name="send" value="payer" />
                    <br>
                    <input type="submit" id="submit" name="back" value="Annuler" />
                </td>
            </tr>
        <tr>
            <td nowrap >Paiement Pour: <?php echo prntext($post['member'])?> </td>
            <td >Notes <em>(En option)</em></td>
            <td></td>
        </tr>
        <tr>
            <td nowrap>Produit/Service: <?php echo prntext($post['produit'])?> </td>
            <td rowspan="2"><textarea name="notes" cols=30 rows=3><?php echo prntext($post['notes'])?></textarea></td>
            <td></td>
            
        </tr>
        <tr>
            <td>Total:<?php echo prnsumm($post['total'])?>&nbsp;<?php echo prntext($data['Currency'])?></td>
            <td></td>
            <td></td>
        </tr>
        
    </tfoot>
    <tbody>
    </tbody>
</table>
    </form>
        </p>
        </div>
<?}elseif($post['step']==3){?>
<div class="col_title"> Error sure le Paiement</div>
        <div class="col_text">
            <p class="pm">
                    <p align="center">
                    Error sure le Paiement.
                    </a>
                    <br>
            </p>
    
<?} ?>
            </div>
        </div>
        
    </div>
</header>
</div>
</div>
</div>
<!-- End header  -->
</section>
<!-- content -->
