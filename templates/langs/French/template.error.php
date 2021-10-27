<!-- Start content  -->
<div class="content">
	
	<article class="col-3">
		<div class="col_title">Error sure de Edinars</div>
		<div class="col_text">
				<p class="pm">
				  <?php 
					switch ($_GET['error']) {
                    case '1' :
                        echo "Le champ identifiant il est vide ou non existant ";
                        break;
                    case '2' :
                        echo "Le champ produit est vide ou non existant ";
                        break;
                    case '3' :
                        echo "Le champ prix il est vide ou non existant ou il contien une valeurs null";
                        break;   
                    case '4' :
                        echo "Le champ action il est vide ou non existant";
                        break;
                    case '5' :
                        echo "Le champ identifiant il est vide ou non existant";
                        break;
                    case '6' :
                        echo "le champ pincode ou prehashkey est vide ou non existant";
                        break;
                    case '7' :
                        echo "il ya un error dans la transaction " .$_GET['trx'];
                        break;
                    } ?>       
                    </p>
		</div>
	</article>
	<div class="clr"></div>

</div>

<!-- End content  -->