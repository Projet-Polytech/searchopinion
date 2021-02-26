<!DOCTYPE html>
<html lang="fr">
<head>
	<title></title>
    <meta charset="UTF-8" >
    <link  href="accueil.css" rel="stylesheet">
</head>

<body>
	
	
	<header>
		<div id="header_logo">
				<img src="image/Logo_Polytech_5.png">
		</div>

		<div id="header_contact"><a href="">Contact<img src="image/index.png"></a></div>

		<div id="header_Publier">
			<a href=""><img src="image/+_1.png"> Publier</a>
		</div>

		<div id="header_Connexion">
			<a href="">Connexion<img src="image/index.png"></a>
		</div>
		
		<div id="header_Compte">
			<a href="">Inscription<img src="image/index.png"></a>
		</div>
	</header>

	<div id="fond_accueil">
		<h1>Stage & avis</h1>
		<h2>Rechercher les stages selon des critères<br>Et selon d'autres critères</h2>
		<div id="recherche_global">
			<form action="recherche.php" method="post">

				<div id="recherche">
					<div id="recherche_localisation">Localisation<img src="image/logo_localisation_2.png"></div>
					<select multiple class="chosen" name="select[]" style="width:300px;">
				        <optgroup label="fruit">
				            <option value="1">apples</option>
				            <option value="2">pears</option>
				        </optgroup>
				        <optgroup label="veg">
				            <option value="3">neeps</option>
				            <option value="4">tatties</option>
				        </optgroup>
				        <optgroup label="omnivore">
				            <option value="5">bear</option>
				            <option value="6">rats</option>
				            <option value="7">bear</option>
				            <option value="8">rats</option>
				            <option value="9">bear</option>
				            <option value="10">rats</option>
				        </optgroup>
    				</select>
	 				<!-- Connexion à la base de données -->
					<?php include("connexion_bdd.php");
					// Sélection des titres de musique, nom des artistes, nom des pays et nom des styles musicaux pour faciliter la recherche
						$lieux = $bdd->query('SELECT lieu FROM localisation');
						//echo '<option value="Toute localisation">';
						while($lieu = $lieux->fetch()) {
							//echo '<option value="' . $lieu['lieu'] . '">';
						}
						$lieux->closeCursor(); ?>
					
				</div>
				<div id="recherche_2">
					<div id="recherche_domaine">Domaine<img src="image/logo_domaine.png"></div>
					<input type="text" name="" placeholder="ex : informatique">
				</div>
				<a href="">
				<div id="recherche_3"><div id="recherche_final"><img src="image/logo_loupe.png"></div><div id="recherche_fleche_3"></div></div>
				</a>
			</form>
		</div>
		
	</div>

	<aside>
		<h2>Retrouvez les stages les mieux notés<br>& vos dernières recherches</h2>
	</aside>

	<section>

		<div id="stage_populaire">

			<div class="accueil_stage">
				<div class="accueil_stage_logo"><img src="image/logo_accueil.webp"></div>
				<div class="accueil_stage_etoile"><img src="image/etoile_1.png"><img src="image/etoile_1.png"><img src="image/etoile_1.png"><img src="image/etoile_2.png"><img src="image/etoile_2.png"></div>
				<div class="accueil_stage_info"><img src="image/logo_domaine_black.png">Informatique</div>
				<div class="accueil_stage_info"><img src="image/logo_localisation_black.png">Lyon</div>
				<h1>Tesla</h1>
				<p><img src="image/guillemet_inv.png">Encore un extrait du début de l'avis sur un autre stage pour test. Dans l'idéale on met là aussi 4-5 lignes pour donner envie de lire la suite ...<img src="image/guillemet.png"></p>
				<time>14/02/2020</time>
			</div>

			<div class="accueil_stage">
				<div class="accueil_stage_logo"><img src="image/generale.png"></div>
				<div class="accueil_stage_etoile"><img src="image/etoile_1.png"><img src="image/etoile_1.png"><img src="image/etoile_1.png"><img src="image/etoile_2.png"><img src="image/etoile_2.png"></div>
				<div class="accueil_stage_info"><img src="image/logo_domaine_black.png">Génie civil</div>
				<div class="accueil_stage_info"><img src="image/logo_localisation_black.png">Bordeaux</div>
				<h1>Société générale</h1>
				<p><img src="image/guillemet_inv.png">Extrait du début de l'avis sur le stage. Dans l'idéale on met 4-5 lignes pour donner envie de lire la suite ...<img src="image/guillemet.png"></p>
				<time>14/02/2020</time>
			</div>

			<div class="accueil_stage"></div>
			<div class="accueil_stage"></div>
			<div class="accueil_stage"></div>
			
		</div>
			
		<div id="stage_visite">
			<div class="accueil_stage" id="stage_info">
				<h2>Plus d'infos avec des liens qui renvoie à des pages</h2>
				<a href="">Des infos</a>
				<a href="">D'autres infos</a>
			</div>
			<div class="accueil_stage"></div>
			<div class="accueil_stage"></div>
			<div class="accueil_stage"></div>
			<div class="accueil_stage"></div>
		</div>
	</section>
	<footer>
		
	</footer>

	
</body>
</html>


			

	 			
	 		
	<input type="submit" name="envoyer" value="&#x2713;" />