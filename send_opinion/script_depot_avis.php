 <?php session_start();
include("../search_opinion/connexion_bdd.php");
//initializing variables
$pb_entreprise = 0;
$pb_creation = 0;
$siret = $_POST['siret'];
$email = $_SESSION['email'];
if($_POST['pays'][0] === '\'' | $_POST['pays'][0] === '"'){
	$localistation = '';
}
else if($_POST['pays'] == "France") {
	if($_POST['departement'][0] === '\'' | $_POST['departement'][0] === '"'){
		$localisation = '';
	}
	else {
		$localisation = $_POST['departement'];
	}
}
else {
	$localisation = $_POST['pays'];
}
$depot = date("Y-m-d");
$note_localisation = $_POST['note_localisation']*2;
$note_accueil = $_POST['note_accueil']*2;
$note_encadrement = $_POST['note_encadrement']*2;
$note_interet = $_POST['note_interet']*2;
$note_globale = intval(array_sum([$note_localisation,$note_accueil,$note_encadrement,$note_interet]));
//Adjustment of the variables to avoid complication in the database
$avis = addslashes($_POST['avis']);
$avis = str_replace('<', "&lt;", $avis);
$avis = str_replace('>', "&gt;", $avis);
$nom = addslashes($_POST['entreprise']);
$logo = str_replace(' ', '', strtolower($nom)) . '.png';
$sujet = addslashes($_POST['sujet']);
$adresse = addslashes($_POST['adresse']);

//Create a new instance when the company isn't in the database
$verification = $bdd->prepare('SELECT COUNT(*) AS num_siret FROM entreprises WHERE num_siret = :siret');
$verification->bindParam(':siret', $siret);
$verification->execute();
$verif = $verification->fetch();
if($verif['num_siret'] != 1) {
	$entreprise = $bdd->prepare("INSERT INTO entreprises VALUES(:num_siret, :logo, :nom)");
	$entreprise->bindParam(':num_siret', $siret);
	$entreprise->bindParam(':nom', $nom);
	$entreprise->bindParam(':logo', $logo);
	try {
		$entreprise->execute();
	}
	catch(Exception $e){
		echo "Erreur :".$e->getMessage();
		$pb_entreprise = 1;
	}
	$entreprise->closeCursor();
}
$verification->closeCursor();
//Insert the opinion in the database
$creation = $bdd->prepare("INSERT INTO avis VALUES(NULL, :titre, :duree, :localisation, :adresse, :salaire, :domaine, :depot, :note_localisation, :note_accueil, :note_encadrement, :note_interet, :avis, :note_globale, :num_siret, :email)");
$creation->bindParam(':titre', $sujet);
$creation->bindParam(':duree', $_POST['duree']);
$creation->bindParam(':localisation', $localisation);
$creation->bindParam(':adresse', $adresse);
$creation->bindParam(':salaire', $_POST['salaire']);
$creation->bindParam(':domaine', $_POST['domaine']);
$creation->bindParam(':depot', $depot);
$creation->bindParam(':note_localisation', $note_localisation);
$creation->bindParam(':note_accueil', $note_accueil);
$creation->bindParam(':note_encadrement', $note_encadrement);
$creation->bindParam(':note_interet', $note_interet);
$creation->bindParam(':avis', $avis);
$creation->bindParam(':note_globale', $note_globale);
$creation->bindParam(':num_siret', $siret);
$creation->bindParam(':email', $email);
try {
	$creation->execute();
}
catch(Exception $e){
	echo "Erreur :".$e->getMessage();
	$pb_creation = 1;
}
 ?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8"/>
	<link  href="../search_opinion/formulaire.css" rel="stylesheet" type="text/css" media="all">
	<title>Dépôt d'un avis</title>
</head>
<body>
	<?php include("../search_opinion/header.php") ?>
	<div id="retour_depot_avis">
		<?php if($pb_entreprise == 1 | $pb_creation == 1) {
			echo "<p>Il y a eu un problème lors de la création de l'instance de votre entreprise merci de nous contacter par mail pour analyser ce problème. Ou cilquez <a href='depot_avis.php'>ici</a> pour réessayer.</p>";
		}
		else {
			echo "<p>Merci pour votre avis. Nous vous invitons à entrer un autre avis <a href='depot_avis.php'>ici</a> ou à retourner sur la <a href='../search_opinion/accueil.php'>page principale</a> pour entamer des recherches sur votre prochain stage en vous aiguillant grâce aux nombreux avis déposés par d'autres étudiants.</p>";
		} ?>
	</div>
	<?php include('../search_opinion/footer.php'); ?>
</body>
</html>
