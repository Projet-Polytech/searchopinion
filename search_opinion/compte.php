<?php 

include("connexion_bdd.php"); 


$etoile_full = '<img src=\'image/etoile_full.png\'>';
$etoile_null = '<img src=\'image/etoile_null.png\'>';
$etoile_demi = '<img src=\'image/etoile_demi.png\'>';


?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<title></title>
    <meta charset="UTF-8" >
    <link  href="compte.css" rel="stylesheet">
</head>
	
<body>

 	<header>

 		<div id="header_logo">
				<img src="image/Logo_Polytech_5.png">
		</div>

 		<div id="header_contact"><a href="">Contact<img src="image/index.png"></a></div>
		
		<div id="header_Compte">
			<a href="">Inscription<img src="image/index.png"></a>
		</div>

		<div id="header_Connexion">
			<a href="">Connexion<img src="image/index.png"></a>
		</div>

		<div id="header_Publier">
			<a href=""><img src="image/+_1.png"> Publier</a>
		</div>
		
		
 	</header>

 	<section>
 		<div id="topcompte">
 			<h1><img src="image/account.png">Mon Compte</h1>
 			<a href=""><img src="image/deco2.png"></a>
 			<p>adressemail@gmail.com</p>
 		</div>

 		<h2>Changer de mot de passe</h2>
 		<div id="block" class="col-3 input-effect">

 			<form method="post" action="avis.php">
 				<input type="password" name="pass1" class="compte_password">
 				<label class="label1">mot de passe</label>
 				<input type="password" name="" class="compte_password_2">
 				<label class="label2">mot de passe</label>
				<input id='inpmdp' type="submit" value="">
			</form>

 		</div>
 		<h2>Avis</h2>
 		<div id="block2">
 			<a class="stagecompte" href="">
 				<p>Nom de l'entreprise |<span>11/03/2021</span></p>
 				<img src='image/etoile_full.png'><img src='image/etoile_full.png'><img src='image/etoile_full.png'><img src='image/etoile_full.png'><img src='image/etoile_full.png'>
 			</a>
 			<a class="stagecompte" href="">
 				<p>Nom de l'entreprise |<span>11/03/2021</span></p>
 				<img src='image/etoile_full.png'><img src='image/etoile_full.png'><img src='image/etoile_full.png'><img src='image/etoile_full.png'><img src='image/etoile_full.png'>
 			</a>
 			<a  class="stagecompte" href=""><p>Vous n'avez pas encore déposé d'avis</p></a>
 			
 		</div>
 		
 	</section>

 	<footer></footer>
 
	
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script type="text/javascript">

// <![CDATA[

$(window).load(function(){
	$(".col-3 input").val("");
		
	$(".input-effect input").focusout(function(){
		if($(this).val() != ""){
			$(this).addClass("has-content");
		}else{
			$(this).removeClass("has-content");
		}
	})
});

// ]]>

</script>

</body>
</html>