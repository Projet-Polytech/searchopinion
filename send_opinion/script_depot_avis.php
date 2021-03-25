 <?php session_start();
include("../search_opinion/connexion_bdd.php");
//initializing variables
$pb_entreprise = 0;
$pb_creation = 0;
$siret = htmlspecialchars($_POST['siret']);
if($_POST['pays'] == "France") {
	$localisation = htmlspecialchars($_POST['departement']);
}
else {
	$localisation = htmlspecialchars($_POST['pays']);
}
$depot = date("Y-m-d");
$note_accessibilite = $_POST['note_accessibilite']*2;
$note_accueil = $_POST['note_accueil']*2;
$note_encadrement = $_POST['note_encadrement']*2;
$note_interet = $_POST['note_interet']*2;
$note_globale = intval(array_sum([$note_accessibilite,$note_accueil,$note_encadrement,$note_interet])/2);//diviser par deux pour l'affichage en demi étoile
//Modification du champs avis pour un bon enregistrement dans la bdd (et pour éviter les failles XSS)
$avis = addslashes($_POST['avis']);
$avis = str_replace('<', "&lt;", $avis);
$avis = str_replace('>', "&gt;", $avis);
$nom = addslashes($_POST['entreprise']);
$sujet = addslashes($_POST['sujet']);
$adresse = addslashes($_POST['adresse']);
$email = $_SESSION['email'];

//créer une instance pour l'entreprise si celle-ci n'existe pas
$verification = $bdd->prepare('SELECT COUNT(*) AS num_siret FROM entreprises WHERE num_siret = :siret');
$verification->bindParam(':siret', $siret);
$verification->execute();
$verif = $verification->fetch();
if($verif['num_siret'] != 1) {
	$entreprise = $bdd->prepare("INSERT INTO entreprises VALUES(:num_siret, :logo, :nom)");
	$entreprise->bindParam(':num_siret', $siret);
	$entreprise->bindParam(':nom', $nom);
	$entreprise->bindParam(':logo', $pb_entreprise);
	try {
		$entreprise->execute();
		$entreprise->closeCursor();
	}
	catch(Exception $e){
		echo "Erreur :".$e->getMessage();
		$pb_entreprise = 1;
		$entreprise->closeCursor();
	}
}
$verification->closeCursor();
//entrer l'avis dans la table
$creation = $bdd->prepare("INSERT INTO avis VALUES(NULL, :titre, :annee, :duree, :localisation, :adresse, :salaire, :domaine, :depot, :note_access, :note_accueil, :note_encadrement, :note_interet, :avis, :note_globale, :num_siret, :email)");
$creation->bindParam(':titre', $sujet);
$creation->bindParam(':annee', $_POST['date']);
$creation->bindParam(':duree', $_POST['duree']);
$creation->bindParam(':localisation', $localisation);
$creation->bindParam(':adresse', $adresse);
$creation->bindParam(':salaire', $_POST['salaire']);
$creation->bindParam(':domaine', $_POST['domaine']);
$creation->bindParam(':depot', $depot);
$creation->bindParam(':note_access', $note_accessibilite);
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
	<header>
		<div id="header_logo">
			<img src="../search_opinion/image/Logo_Polytech_5.png">
		</div>

 		<div id="header_contact"><a href="../search_opinion/accueil.php">Contact<img src="../search_opinion/image/index.png"></a></div>
		
		<div id="header_Compte">
			<a href="../search_opinion/accueil.php">Inscription<img src="../search_opinion/image/index.png"></a>
		</div>

		<div id="header_Connexion">
			<a href="../search_opinion/page_connexion.php">Connexion<img src="../search_opinion/image/index.png"></a>
		</div>

		<div id="header_Publier">
			<a href="depot_avis.php"><img src="../search_opinion/image/+_1.png"> Publier</a>
		</div>
	</header>
	<div id="retour_depot_avis">
		<?php if($pb_entreprise == 1 | $pb_creation == 1) {
			echo "<p>Il y a eu un problème lors de la création de l'instance de votre entreprise merci de nous contacter par mail pour analyser ce problème. Ou cilquez <a href='depot_avis.php'>ici</a> pour réessayer.</p>";
		}
		else {
			echo "<p>Merci pour votre avis. Nous vous invitons à entrer un autre avis <a href='depot_avis.php'>ici</a> ou à retourner sur la <a href='../search_opinion/accueil.php'>page principale</a> pour entamer des recherches sur votre prochain stage en vous aiguillant grâce aux nombreux avis déposés par d'autres étudiants.</p>";
		} ?>
	</div>
</body>
</html>