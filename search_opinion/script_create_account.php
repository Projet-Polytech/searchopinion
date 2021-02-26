<?php session_start();
	include("connexion_bdd.php");
	//initialisation des variables
	$mail = 0;
	//vérification de l'unicité du compte à créer puis création du compte
	if(isset($_POST['mail']) AND isset($_POST['nom']) AND isset($_POST['prenom']) AND isset($_POST['mdp'])) {
		$email = htmlspecialchars($_POST['mail']) . "@etu.univ-tours.fr";
		$verification = $bdd->query('SELECT mail FROM utilisateurs');
		$individus = $verification->fetchAll();
		// Vérification de l'unicité du mail
		if(in_array($email, array_column($individus, 'mail'))) {
			$mail = 1;
		}
		// Si le compte n'existe pas encore, création du compte
		if($mail == 0) {
			$_SESSION['nom'] = htmlspecialchars($_POST['nom']);
			$_SESSION['connected'] = true;
			$nom = $_SESSION['nom'];
			$prenom = htmlspecialchars($_POST['prenom']);
			$creation = $bdd->prepare("INSERT INTO utilisateurs VALUES(:mail, :nom, :prenom, :mdpass, 0)");
			$creation->bindParam(':mail', $email);
			$creation->bindParam(':nom', $nom);
			$creation->bindParam(':prenom', $prenom);
			$creation->bindParam(':mdpass', $pass_hash);
			//$creation->bindParam(':authentification', 0);
			$pass_hash = password_hash(htmlspecialchars($_POST['mdp']), PASSWORD_DEFAULT);
			try {
				$creation->execute();
			}
			catch(Exception $e){
				echo "Erreur :".$e->getMessage();
			}
		}
	}
	else {
		echo "something is missing";
	}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8"/>
	<link  href="avis.css" rel="stylesheet" type="text/css" media="all">
	<title>Compte créé</title>
</head>
<body>
	<header>
		<div id="header_logo">
			<img src="image/Logo_Polytech_5.png">
		</div>

		<div id="header_contact"><a href="">Contact<img src="image/index.png"></a></div>
		
		<div id="header_Compte">
			<a href="">Inscription<img src="image/index.png"></a>
		</div>

		<div id="header_Connexion">
			<a href="">Connexion<img src="image/index.png"></a>
		</div>

		<div id="header_Publier">
			<a href=""><img src="image/+_1.png"> Publier</a>
		</div>
	</header>
	<body>
		<div id="inscription">
			<?php if($mail == 1) {
				//Si l'adresse mail a déjà été utilisée pour un compte
				echo '<p>Cette adresse mail est déjà utilisée. Vous avez peut-être déjà un compte alors cliquez <a href="feuille_connexion.php">ici</a> pour vous connecter. Ou cliquez <a href="feuille_inscription.php">ici</a> pour réessayer avec une autre adresse.</p>';
			}
			else {
				//Si tout est bon :
				echo '<p>Vous voilà inscrit. <\hr> Vous allez maintenant recevoir un mail pour confirmer cette inscription et vous pourrez ensuite entrer un avis sur un stage réalisé.</p>';
			} ?>
			<p><a href="accueil.html">Retourner sur le site.</a></p>
		</div>
	</body>
</html>