<?if(isset($data['ScriptLoaded'])){


$Form = new Base_Form("Connection", "frmconnection","login.php");
$Form->SetPhpCallback("formHandle");
$Form->Add(new Base_Text("Identifiant", "username", "", true, null));
$Form->Add(new Base_Password("Mot de passe", "password", "", true, new Base_Validators_NotEmpty("Saisissez votre Mot de passe")));
$Form->Add(new Base_Submit("send", "Connectez Vous"));

?>
<div class="content">
	<div id="wrapper">

	<img src="<?=$data['Host']?>/images/logo.png">
	<h2>Bienvenue - Edinars Enterprise</h2>
	<?php
	if(!$Form->Processed()){
		echo $Form;
	}else{
		if($data['Error']){
				echo "<p class='error'>".$data['Error'] ."</p>";

		 }
		echo $Form;
	}
	?>
	</div>
</div>
<?}else{?>SECURITY ALERT: Access Denied<?}?>
