<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8"/>
	<link  href="autre.css" rel="stylesheet" type="text/css" media="all">
	<title>internship</title>
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
	<?php if(isset($_GET['id_stage'])) {
		$id_stage = htmlspecialchars($_GET['id_stage']);
	} ?>
	<div id="avis">
		<?php include("connexion_bdd.php");
			$description = $bdd->prepare('SELECT * FROM avis WHERE id_stage = :id_stage');
			$description->bindParam(':id_stage', $id_stage);
			$description->execute();
			$avis = $description->fetch();
			if($description->rowCount() == 1) {
				$entreprises = $bdd->prepare('SELECT nom,logo FROM entreprises WHERE num_siret = :num_siret');
				$entreprises->bindParam(':num_siret', $avis['fk_num_siret']);
				$entreprises->execute();
				$entreprise = $entreprises->fetch();
				$logo_entreprise = $entreprise['logo'];
				$nom_entreprise = $entreprise['nom'];
				$titre = $avis['titre'];
				$annee_stage = $avis['annee_stage'];
				$duree = $avis['duree'];
				$localisation = $avis['localisation'];
				$adresse = $avis['adresse'];
				$salaire = $avis['salaire'];
				$note_salaire = $avis['note_salaire']/10;
				$note_globale = $avis['note_globale']/10;
				$note_accueil = $avis['note_accueil']/10;
				$note_encadrement = $avis['note_encadrement']/10;
				$note_interet = $avis['note_interet']/10;
				$avis = $avis['avis'];
				$entreprises->closeCursor();
			}
			else {
				echo 'Cet avis n\'existe pas ou n\'est pas encore présent sur ce site. Nous vous prions de nous excuser pour ce manque et vous invitons à retourner découvrir les avis présents sur ce site.';
			} 
			$description->closeCursor();
			if(preg_match("#^[0-9]#",$localisation)) {
				$localisation = str_replace(" - "," ",$localisation);
				$localisation = "$localisation France";
			}
			//Conversion des notes en étoiles :
			function stars($note) { //reste à gérer la demi étoile.
				$whole_star = "";
				$empty_star = "";
				if(strpos($note,".")) { 
					$note -= 1;
				}
				for ($i = 0; $i < $note; $i++) {
					$whole_star = $whole_star . "&#9733;";
				}
				for ($i = $note; $i < 5; $i++) {
					$empty_star = $empty_star . "&#9734;";
				}
				return $note = $whole_star . $empty_star;
			}
			$note_globale = stars($note_globale);
			$note_accueil = stars($note_accueil);
			$note_encadrement = stars($note_encadrement);
			$note_interet = stars($note_interet);
			$note_salaire = stars($note_salaire);

			echo $logo_entreprise;
			echo '<h1>' . $nom_entreprise . '</h1>';
			echo '<h2>' . $titre . '</h2>';
			echo '<div id="chiffres">';
			echo '<div id="dates"><p>En : ' . $annee_stage . '<br />Pendant : ' . $duree . ' semaines<br/>';
			echo 'Rémunéré : ' . $salaire . '€/mois</p></div>';
			echo '<div id="adresse"><p>' . $adresse . '<br />' . $localisation . '</p></div>';
			echo '<table><tr><th>Note globale</th><th>' . $note_globale . '</th></tr>';
			echo '<tr><td>Accueil</td><td>' . $note_accueil . '</td></tr>';
			echo '<tr><td>Encadrement</td><td>' . $note_encadrement . '</td></tr>';
			echo '<tr><td>Intérêt</td><td>' . $note_interet . '</td></tr>';
			echo '<tr><td>Salaire</td><td>' . $note_salaire . '</td></tr></table>'; 
			echo '</div>';
			echo '<div id="para_avis"><strong>Avis</strong><p>' . $avis .'</p></div>'; ?>
	</div>
</body>
</html>