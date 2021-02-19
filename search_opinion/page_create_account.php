<?php session_start() ?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8"/>
	<link  href="autre.css" rel="stylesheet" type="text/css" media="all">
	<title>Dépôt d'un avis</title>
</head>
<body>
	<header>
		<div id="bandeau_contact">
			<a href="">Contact</a>
		</div>

		<div id="bandeau_logo">
			<img src="Logo_Polytech_2.png">
		</div>
		<div id="bandeau_Avis">
			<a href="">+ Avis</a>
		</div>

		<div id="bandeau_Connexion">
			<a href="">Connexion</a>
		</div>
		<div id="bandeau_Compte">
			<a href="">Inscription</a>
		</div>
	</header>
	<div id="create_account">
		<form action="script_create_account.php" method="POST" >
			<div><label>Adresse mail : </br><input class="formule" type="text" name="mail" minlength="5" placeholder=" ex : prenom.nom" title="Votre adresse mail" required autofocus>@etu.univ-tours.fr</label></div>
			<div><label>Nom : </br><input class="formule" type="text" name="nom" placeholder="Nom" title="Votre nom" required></label></div>
			<div><label>Prénom : </br><input class="formule" type="text" name="prénom" placeholder="Prénom" title="Votre prénom" required></label></div>
			<div><label>Année d'entrée à Polytech : </br><input class="formule" type="number" min="2000" max="2050" name="annee_pol" placeholder="ex : 2019" title="L'année de votre entrée à Polytech" required></label></div>
			<div><label>Mot de passe : </br><input class="formule" type="password" name="mdp" id="mdp" placeholder="Mot de passe" title="Créez un mot de passe" required></label></div>
			<div><p><input type="submit" name="envoyer" value="S'inscrire" id="inscrire" /></p></div>
		</form>
	</div>
</body>
</html>