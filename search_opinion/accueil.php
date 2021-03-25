<?php 

include("connexion_bdd.php");
include("fonctions.php");


?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<title></title>
    <meta charset="UTF-8" >
    <link  href="accueil.css" rel="stylesheet">
</head>

<body>
	
	<div id="accueil">
		<header>
			<div id="header_logo">

				<a href="http://www1.polytech-reseau.org/accueil/">
					<img src="image/logo_polytech_5.png">
				</a>
					
			</div>

			<div id="header_contact">
				<a href="#footer">Contact<img src="image/index.png"></a>
			</div>

			<div id="header_accueil">
				<a href="accueil.php">Accueil<img src="image/index.png"></a>
			</div>

			<div id="header_Publier">
				<a href=""><img src="image/+_1.png">Publier</a>
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
			
			<form action="recherche.php" method="post">

				<div class="recherche">
					<h3>Localisation<img src="image/logo_localisation_2.png"></h3>

					<input list="Localisation" type="text" placeholder="ex : Paris">
						<datalist id="Localisation">
							<option value="Toute localisation">
						  	<?php 

							$lieux = $bdd->query('SELECT lieu FROM localisation');

							while($lieu = $lieux->fetch()) {
								echo '<option value="'.sup_num_location ($lieu['lieu']).'">';
							}
							$lieux->closeCursor(); 

							?>

						</datalist>
				</div>

				<div class="recherche">
					<h3>Domaine<img src="image/logo_domaine.png"></h3>
					<input type="text" name="" placeholder="ex : informatique">
				</div>
					
				<div id="recherche_button">
					<input type="submit" name="" value="" >
				
				</div>
					
			</form>
			
		</div>
	</div>

	<aside>
		<h2>Retrouvez les stages les mieux notés<br>& vos dernières recherches</h2>
	</aside>

	<section>

		<div id="stage_populaire">

			<a href="" class="accueil_stage">
				<div class="accueil_stage_logo"><img src="image/logo_accueil.webp"></div>
				<div class="accueil_stage_etoile"><img src="image/etoile_full.png"><img src="image/etoile_full.png"><img src="image/etoile_full.png"><img src="image/etoile_demi.png"><img src="image/etoile_null.png"></div>
				<div class="accueil_stage_info"><img src="image/logo_domaine_black.png">Informatique</div>
				<div class="accueil_stage_info"><img src="image/logo_localisation_black.png">Lyon</div>
				<h1>Tesla</h1>
				<p><img src="image/guillemet_inv.png">Encore un extrait du début de l'avis sur un autre stage pour test. Dans l'idéale on met là aussi 4-5 lignes pour donner envie de lire la suite ...<img src="image/guillemet.png"></p>
				<time>14/02/2020</time>
			</a>

			<?php 

$requete =

'SELECT  a.id_stage id_stage, a.domaine domaine,  a.note_globale note_globale,  a.fk_localisation fk_localisation, a.avis avis, e.nom nom
FROM avis a
INNER JOIN entreprises e
ON a.fk_num_siret = e.num_siret
ORDER BY note_globale DESC, note_interet DESC';

$reponse1 = $bdd->query($requete);

for ($i = 0; $i <= 3; $i++) {

	$donnees = $reponse1->fetch();

	$id_stage = $donnees['id_stage']; 

	$domaine = $donnees['domaine'];

	$note_globale = $donnees['note_globale'];

	$fk_localisation = $donnees['fk_localisation'];

	$avis = $donnees['avis'];

	$nom = $donnees['nom'];

	$fk_localisation = sup_num_location ($fk_localisation);

	if (strlen($fk_localisation) > 14 ) {
		$fk_localisation = substr($fk_localisation, 0, 12).'...';
	}

	echo
	'<a href=\'avis_detail.php?id_stage='.$id_stage.'\' class=\'accueil_stage\'>
		<div class=\'accueil_stage_logo\'><img src=\'image/generale.png\'></div>
		<div class=\'accueil_stage_etoile\'>'.convertisseur_note_etoile($note_globale).'

		</div>
		<div class=\'accueil_stage_info\'><img src=\'image/logo_domaine_black.png\'>'.$domaine.'</div>
		<div class="accueil_stage_info"><img src="image/logo_localisation_black.png">'.$fk_localisation.'</div>
		<h1>'.$nom.'</h1>
		<p><img src="image/guillemet_inv.png">'.substr($avis, 0,160).' ...<img src="image/guillemet.png"></p>
		<time>14/02/2020</time>
	</a>';
}		

			?>
			
		</div>
			
		<div id="stage_visite">
			<div class="accueil_stage" id="stage_info">
				<h2>Plus d'infos avec des liens qui renvoie à des pages</h2>
				<a href="">Des infos</a>
				<a href="">D'autres infos</a>
			</div>
			<a href="" class="accueil_stage"></a>
			<a href="" class="accueil_stage"></a>
			<a href="" class="accueil_stage"></a>
			<a href="" class="accueil_stage"></a>
		</div>
	</section>
	<footer id="footer">
		
	</footer>

	
</body>
</html>


			

