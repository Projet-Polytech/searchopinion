<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8"/>
	<link  href="../search_opinion/formulaire.css" rel="stylesheet" type="text/css" media="all">
	<title>Dépôt d'un avis</title>
</head>
<body>
	<?php include("../search_opinion/connexion_bdd.php");
	include("../search_opinion/header.php"); ?>
	<div id="depot_avis">
		<form action="script_depot_avis.php" method="POST">
			<h1>Dépôt d'un avis sur un stage réalisé</h1>
			<label><div class="label">Numéro Siret de l'entreprise : </div><input class="formule" id="siret" type="text" name="siret" pattern="[0-9A-Z]{14}" placeholder="Numéro Siret" title="Le numéro Siret de l'entreprise" required autofocus></label>
			<label><div class="label">Nom de l'entreprise : </div><div id="auto_nom"></div><input class="formule" id="nom" type="text" name="entreprise" placeholder="Nom de l'entreprise" title="Le nom de l'entreprise dans laquelle vous avez fait votre stage" ></label>
			<label><div class="label">Sujet du stage : </div><input class="formule" type="text" name="sujet" placeholder="Sujet du stage" title="Sujet du stage" required></label>
			<label><div class="label">Durée du stage : </div><input class="formule" type="number" name="duree" min="0" max="30" title="Durée du stage en semaine" required> semaines</label>

			<p></br>Localisation de l'entreprise : </p>
			<label><div class="label">Pays : </div><input class="formule" type="text" id="pays" name="pays" placeholder="ex: France" title="Entrez le pays de votre stage" list="liste_pays" required></label>
			<datalist id="liste_pays">
				<option value="France">
				<?php $localisations = $bdd->query('SELECT lieu FROM localisation WHERE lieu NOT REGEXP "^[0-9]"');
						while($pays = $localisations->fetch()) {
							echo '<option value="' . $pays['lieu'] . '">';
						}
						$localisations->closeCursor(); ?>
			</datalist>
			<label id="dep"><div class="label">Département : </div><input class="formule" type="text" name="departement" placeholder="ex: Indre-et-Loire" title="Entrez le département de votre stage" list="liste_dep" ></label>
			<datalist id="liste_dep">
				<option value="France">
				<?php $localisations = $bdd->query('SELECT lieu FROM localisation WHERE lieu REGEXP "^[0-9]"');
						while($dep = $localisations->fetch()) {
							echo '<option value="' . $dep['lieu'] . '">';
						}
						$localisations->closeCursor(); ?>
			</datalist>

			<label><div class="label">Adresse : <span class="interrogation" data-descr="Pensez à rentrer la ville dans laquelle vous avez réalisé votre stage.">?</span></div><input class="formule" type="text" name="adresse" placeholder="ex: 7 avenue Marcel Dassault Tours" title="Entrez l'adresse de l'entreprise" required></label>
			<label><div class="label">Salaire perçu (mensuel brut) : </div><input class="formule" type="number" name="salaire" placeholder="ex: 400" min="0" max="10000" title="Salaire perçu" required>€/mois</label>
			<label><div class="label">Domaine du stage : </div><select name="domaine" class="formule" title="Domaine du stage" required>
				<?php $domaines = $bdd->query('SELECT nom_domaine FROM domaine');
				while($dom = $domaines->fetch()) {
					echo '<option value="' . $dom['nom_domaine'] . '">' . $dom['nom_domaine'] . '</option>';
				}
				$domaines->closeCursor(); ?>
			</select></label>
			<label><div class="label">Vous pouvez ici rédiger un avis personnel détaillé du stage : </div><textarea class="formule" name="avis" title="Rédigez un avis personnel sur le stage" required></textarea></label>
			<table id="note">
				<tr><td class="label">Note d'accueil : </td><td><input class="note" type="number" name="note_accueil" min="0" max="5" step="0.5" placeholder=" /5" pattern="[0-5](\.5)?" title="Note de l'accueil reçu" required></td></tr>
				<tr><td class="label">Note de l'accessibilité au site : </td><td><input class="note" type="number" name="note_accessibilite" min="0" max="5" step="0.5" placeholder=" /5" pattern="[0-5](\.5)?" title="Note de l'accessibilité au site" required></td></tr>
				<tr><td class="label">Note de l'intérêt scientifique : </td><td><input class="note" type="number" name="note_interet" min="0" max="5" step="0.5" placeholder=" /5" pattern="[0-5](\.5)?" title="Note de l'intérêt scientifique du stage" required></td></tr>
				<tr><td class="label">Note de l'encadrement du stage : </td><td><input class="note" type="number" name="note_encadrement" min="0" max="5" step="0.5" placeholder=" /5" pattern="[0-5](\.5)?" title="Note de l'encadrement du stage" required></td></tr>
			</table>

			<div><p><input type="submit" name="envoyer" value="Envoyer" id="inscrire" /></p></div>
		</form>
	</div>
	<?php $sirets = $bdd->query('SELECT num_siret, nom FROM entreprises');
	$sirets->execute();
	$nums_siret = $sirets->fetchAll();
	$sirets->closeCursor(); ?>
	<!-- Javascript part -->
	<script type="text/javascript">
		//Auto completion of the siret number
		const siret = document.getElementById('siret');
		let nom;
		siret.addEventListener('input', function(event) {
			let nums_siret = <?php echo json_encode($nums_siret) ?>;
			for(let i=0; i < nums_siret.length; i++) {
				if(nums_siret[i][0] === event.target.value) {
					document.getElementById('nom').style.display = 'none';
					document.getElementById('auto_nom').innerHTML = nums_siret[i][1];
					nom = num_siret[i][1];
				}
			}
		});
		//Send the name with the form
		const submit = document.getElementById('inscrire');
		submit.addEventListener('click', function() {
			const name = document.getElementById('nom');
			name.setAttribute('value', nom);
		});
		//Presence or not of the department input
		const pays = document.getElementById('pays');
		pays.addEventListener('input', function() {
			if (pays.value === "France") {
				document.getElementById('dep').style.display = 'block';
			}
			else {
				document.getElementById('dep').style.display = 'none';
			}
		});
	</script>
</body>
</html>