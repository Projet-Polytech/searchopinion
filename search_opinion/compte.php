<?php 

include("connexion_bdd.php"); 
include("fonctions.php");

session_start();

$_SESSION['adressemail'] = 'adresse@mail';

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

 	<?php
			include("header.php");
	?>

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
 			<?php

$requete =
'SELECT  a.date_depot date_depot, a.note_globale note_globale, a.id_stage id_stage, e.nom nom
FROM avis a
INNER JOIN entreprises e
ON a.fk_num_siret = e.num_siret
WHERE a.fk_mail = \''.$_SESSION['adressemail'].'\'';

$reponse1 = $bdd->query($requete);
$nbr_result = $reponse1->rowCount();

if ($nbr_result != 0) {

	while ($donnees = $reponse1->fetch()) {

	$date = $donnees['date_depot'];
	$date = str_replace('-','/',$date);

	$note_globale = $donnees['note_globale'];

	$id_stage = $donnees['id_stage'];

	$nom = $donnees['nom'];

	echo '
	<a class=\'stagecompte\' href=\'avis_detail.php?id_stage='.$id_stage.'&page=compte\'>
 		<p>'.$nom.' |<span>'.$date.'</span></p>
 		'.convertisseur_note_etoile($note_globale).'
 	</a>';
	}
}

else {
	echo '<a  class=\'stagecompte\' href=\'\'><p>Vous n\'avez pas encore déposé d\'avis</p></a>';
}

$reponse1->closeCursor();

/*
<a class="stagecompte" href="">
 	<p>Nom de l'entreprise |<span>11/03/2021</span></p>
 	<img src='image/etoile_full.png'><img src='image/etoile_full.png'><img src='image/etoile_full.png'><img src='image/etoile_full.png'><img src='image/etoile_full.png'>
 </a>
*/
 			?>


 			
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