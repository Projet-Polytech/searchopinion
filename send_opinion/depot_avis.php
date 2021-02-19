<?php session_start(); ?>
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
	<!-- Connexion base de donnée -->
	<?php include("../search_opinion/connexion_bdd.php") ?>
	<div id="avis">
		<h1>Dépôt d'un avis sur un stage réalisé</h1>
		<form action="" method="POST">
			<label>Nom de l'entreprise : <input class="formule" id="nom" type="text" list="entreprises" name="entreprise" placeholder="Nom de l'entreprise" title="Le nom de l'entreprise dans laquelle vous avez fait votre stage" required></label>
			<datalist id="entreprises">
				<?php $entreprises = $bdd->query('SELECT nom FROM entreprises');
					while($entreprise = $entreprises->fetch()) {
						echo '<option value="' . $entreprise['nom'] . '">';
					}
					$entreprises->closeCursor(); ?>
			</datalist>
			<label>Numéro Siret de l'entreprise : <div id="auto_siret"></div><input class="formule" id="siret" type="text" name="siret" placeholder="Numéro Siret" title="Le numéro Siret de l'entreprise" required></label>
			<label>Titre du stage : <input class="formule" type="text" name="titre" placeholder="Titre du stage" title="Titre du stage" required></label>
			<label>Date du stage : <input class="formule" type="month" name="date" placeholder="YYYY-MM" pattern="[0-9]{4}-[0-9]{2}" title="Date du stage" required></label>
			<label>Durée du stage (en semaine) : <input class="formule" type="number" name="duree" title="Durée du stage en semaine" required></label>
			<p>Localisation de l'entreprise : </p>
			<label>Pays : <input class="formule" type="text" name="pays" placeholder="" title="" required></label>
			<label>Adresse : <input class="formule" type="text" name="pays" placeholder="" title="" required></label>
			<label>Vous pouvez ici rédiger un avis personnel détaillé du stage : <input class="formule" type="text" name="pays" placeholder="" title="" required></label>
			<label>Note d'accueil : <input class="formule" type="number" name="accueil" min="0" max="5" step="0.5" placeholder=" /5" pattern="[0-5](\.5)?" title="Note de l'accueil reçu" required></label>
			<label>Note de l'environnement : <input class="formule" type="number" name="environnement" min="0" max="5" step="0.5" placeholder=" /5" pattern="[0-5](\.5)?" title="Note de l'environnement du stage" required></label>
			<label>Note de l'intérêt scientifique : <input class="formule" type="number" name="interet" min="0" max="5" step="0.5" placeholder=" /5" pattern="[0-5](\.5)?" title="Note de l'intérêt scientifique du stage" required></label>
			<label>Note du salaire versé : <input class="formule" type="number" name="note_salaire" min="0" max="5" step="0.5" placeholder=" /5" pattern="[0-5](\.5)?" title="Note de l'accueil reçu" required></label>

			<div><p><input type="submit" name="envoyer" value="Envoyer" id="inscrire" /></p></div>
		</form>
	</div>
</body>
</html>
<!-- Partie Javascript -->
<script type="text/Javascript">
	//Auto completion of the siret number
	function addSiret(nom) {
		<?php $nom =  '<script type="text/Javascript">document.write(nom)</script>';
			$searchSiret = $bdd->prepare('SELECT num_siret FROM entreprises WHERE nom = :nom');
			$searchSiret->bindParam(':nom', $nom);
			$searchSiret->execute();
			$nbr = $searchSiret.rowCount(); ?>
		const nbr = <?php echo json_encode($nbr); ?>;
		if(nbr == 1) {
			const num_siret = <?php echo json_encode($searchSiret->fetch()); ?>;
			document.getElementById('auto_siret').textContent = num_siret;
		}
		<?php $searchSiret.closeCursor(); ?>
	}
	const nom = document.getElementById('nom');
	nom.addEventListener('input',addSiret(nom.value)); 
</script>