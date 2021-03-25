<?php session_start();
include("connexion_bdd.php");
$authentification = $bdd->prepare('UPDATE utilisateurs SET authentification=1 WHERE mail = :mail');
$authentification->bindParam(':mail', $_SESSION['email']);
try {
	$authentification->execute();
}
catch(Exception $e){
	echo "Erreur :".$e->getMessage();
} ?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8"/>
	<link  href="../search_opinion/formulaire.css" rel="stylesheet" type="text/css" media="all">
	<title>Dépôt d'un avis</title>
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
	<div id="verified_account">
		<p>La création de votre compte a bien été finalisée. Vous pouvez maintenant rédiger un avis <a href="../send_opinion/depot_avis.php">ici</a> ou bien retourner consulter des avis pour votre recherche de stage <a href="accueil.php">ici</a>.</p>
	</div>
</body>
</html>