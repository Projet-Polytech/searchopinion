<!DOCTYPE html>
<html lang="fr">
<head>
	<title></title>
    <meta charset="UTF-8" >
    <link  href="accueil.css" rel="stylesheet">
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
			<a href="">Publier un avis</a>
		</div>

		<div id="bandeau_Connexion">
			<a href="">Connexion</a>
		</div>
		<div id="bandeau_Compte">
			<a href="">Céer un compte</a>
		</div>
		
		
	</header>

	<div id="page_accueil">
		<div id="grandtitre">Stage &<br /> avis</div>
		<h2>Rechercher les stages selon des critères<br>Et selon d'autres critères</h2>
		<div id="barre_recherche">
			<form action="recherche.php" method="post">
	 			<input type="text" name="recherche" size="30" list="liste_all" placeholder="Recherche" />
	 			<datalist id="liste_all">
	 				<!-- Connexion à la base de données -->
					<?php include("connexion_bdd.php");
					// Sélection des titres de musique, nom des artistes, nom des pays et nom des styles musicaux pour faciliter la recherche
						$lieux = $bdd->query('SELECT localisation FROM avis');
						echo '<option value="Toute localisation">';
						while($lieu = $lieux->fetch()) {
							echo '<option value="' . $lieu['localisation'] . '">';
						}
						$lieux->closeCursor(); ?>
				</datalist>
	 			<input type="submit" name="envoyer" value="&#x2713;" />
	 		</form>
		</div>

		<div id="slide2"></div>

	</div>

	
</body>
	
</html>
