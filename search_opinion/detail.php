<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8"/>
		<link href="" rel="stylesheet" type="text/css" media="all">
		<Title>internship</Title>
	</head>
	<body>
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
					echo $entreprise['logo'] . $entreprise['nom'] . '<br />';
					echo $entreprise['logo'] . $entreprise['nom'] . '<br />';
					echo $avis['titre'] . '<br />';
					echo $avis['annee_stage'] . $avis['duree'] . $avis['localisation'] . $avis['salaire'];
					echo 'note globale : ' . $avis['note_globale'] . ' note salaire : ' . $avis['note_salaire'];
					echo 'note accueil : ' . $avis['note_accueil'] . ' note encadrement : ' . $avis['note_encadrement'];
					echo 'note intérêt : ' . $avis['note_interet'];
					echo '<p>' . $avis['avis'];
				}
				else {
					echo 'Cet avis n\'existe pas ou n\'est pas encore présent sur ce site. Nous vous prions de nous excuser pour ce manque et vous invitons à retourner découvrir les avis présents sur ce site.';
				}
				$description->closeCursor();
				$entreprise->closeCursor(); ?>
		</div>
	</body>
</html>