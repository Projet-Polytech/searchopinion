<?php 

session_start();

if (isset($_SESSION['email'])) {}
else {header('Location:deconnexion.php');}

include("connexion_bdd.php"); 
include("fonctions.php");




$etoile_full = '<img src=\'image/etoile_full.png\'>';
$etoile_null = '<img src=\'image/etoile_null.png\'>';
$etoile_demi = '<img src=\'image/etoile_demi.png\'>';

//Modification of the password 

if(isset($_POST['pass1']) AND isset($_POST['pass2'])) {
	$modification = $bdd->prepare('UPDATE utilisateurs SET mdp = :mdp WHERE mail = :mail');
	$modification->bindParam(':mdp', $pass_hash);
	$modification->bindParam('mail', $_SESSION['email']);
	$pass_hash = password_hash($_POST['pass1'], PASSWORD_DEFAULT);
	try {
		$modification->execute();
		$message = 1;
	}
	catch(Exception $e) {
		echo "Erreur :".$e->getMessage();
		$message = 0;
	}
}
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
 			<a href="deconnexion.php"><img src="image/deco2.png"></a>
 			<p><?php echo $_SESSION['email'] ?></p>
 		</div>

 		<h2>Changer de mot de passe</h2>
 		<div id="block" class="col-3 input-effect">

 			<form method="post" action="compte.php">
 				<input type="password" name="pass1" class="compte_password" title="Entrez votre mot de passe" pattern="^[a-zA-Z0-9\?\!\@\+\*\$\&\_\:\.\-\#]{4,25}$" id="pwd">
 				<label class="label1">mot de passe</label>
 				<input type="password" name="pass2" class="compte_password_2" id="pwd_verif" title="Entrez votre mot de passe" pattern="^[a-zA-Z0-9\?\!\@\+\*\$\&\_\:\.\-\#]{4,25}$">
 				<label class="label2">mot de passe</label>
				<input id='inpmdp' type="submit" value="" readonly>
			</form>

 		</div>
 		<?php if(isset($message)) {
			if($message == 1) {
				echo '<p>Votre mot de passe a bien été modifié.</p>';
			}
			elseif ($message == 0) {
			 	echo '<p>Il y a eu un problème lors de votre changement de mot de passe merci de réessayer.</p>';
			 }
		} ?>
 		<h2>Mes avis</h2>
 		<div id="block2">
 			<?php

$requete =
'SELECT  a.date_depot date_depot, a.note_globale note_globale, a.id_stage id_stage, e.nom nom
FROM avis a
INNER JOIN entreprises e
ON a.fk_num_siret = e.num_siret
WHERE a.fk_mail = \''.$_SESSION['email'].'\'';

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
 	<?php
			include("footer.php");
	?>

 	
 
	
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

//Control of the second password :
	const pwd_2 = document.getElementById('pwd_verif');
	pwd_2.addEventListener('input', function(){
		if(pwd_2.value !== document.getElementById('pwd').value) {
			pwd_2.style.border = 'solid 1px #FF0000';
			document.getElementById('inpmdp').setAttribute('type', 'text');
		}
		else {
			pwd_2.style.border = 'solid 1px #c9c7c7';
			document.getElementById('inpmdp').setAttribute('type', 'submit');
		}
	});
</script>

</body>
</html>