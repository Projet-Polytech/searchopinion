<?php session_start();
	include("connexion_bdd.php");
	//initialisétion des variables
	$pseudo = 0;
	$mail = 0;
	$confmdp = 0;
	//vérification de l'unicité du compte à créer puis création du compte
	if(isset($_POST['mail']) AND isset($_POST['nom']) AND isset($_POST['prenom']) AND isset($_POST['annee_pol']) AND isset($_POST['mdp'])) {
		$verification = $bdd->query('SELECT mail FROM utilisateurs');
		$individus = $verification->fetchAll();
		// Vérification de l'unicité du mail
		if(in_array(htmlspecialchars($_POST['mail']), array_column($individus, 'mail'))) {
			$mail = 1;
		}
		// Si le compte n'existe pas encore, création du compte
		if($mail == 0) {
			// Si le mot de passe de vérification est identique au premier mot de passe entré
			if(htmlspecialchars($_POST['confirmation']) === htmlspecialchars($_POST['mdp'])) {
				$_SESSION['nom'] = htmlspecialchars($_POST['pseudo']);
				$_SESSION['connected'] = true;
				$_SESSION['couleur'] = htmlspecialchars($_POST['couleur']);
				$nom = $_SESSION['nom'];
				$mail = htmlspecialchars($_POST['mail']);
				$couleur = $_SESSION['couleur'];
				$creation = $bdd->prepare("INSERT INTO individu VALUES(NULL, :pseudo, :mail, :mdpass, :couleur)");
				$creation->bindParam(':pseudo', $nom);
				$creation->bindParam(':mail', $mail);
				$creation->bindParam(':mdpass', $pass_hache);
				$creation->bindParam(':couleur', $couleur);
				$pass_hache = password_hash(htmlspecialchars($_POST['mdp']), PASSWORD_DEFAULT);
				try {
					$creation->execute();
				}
				catch(Exception $e){
					echo "Erreur :".$e->getMessage();
				}
				$recup_id = $bdd->prepare("SELECT id from individu WHERE pseudo = ':pseudo'");
				$recup_id->bindParam(':pseudo', $nom);
				$recup_id->execute();
				$resultat= $recup_id->fetch();
				$_SESSION = $resultat['id'];
			}
			else {
				$confmdp = 1;
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8"/>
	<link  href="autre.css" rel="stylesheet" type="text/css" media="all">
	<title>Compte créé</title>
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
	<body>
		<div id="inscription">
			<?php if($mail == 1) {
				//Si l'adresse mail a déjà été utilisée pour un compte
				echo '<p>Cette adresse mail est déjà utilisée. Vous avez peut-être déjà un compte alors cliquez <a href="feuille_connexion.php">ici</a> pour vous connecter. Ou cliquez <a href="feuille_inscription.php">ici</a> pour réessayer avec une autre adresse.</p>';
			}
			else if($pseudo == 1) {
				//Si le pseudo est déjà utilisé pour un compte
				echo '<p>Ce pseudo est déja utilisé pour ce compte veuillez réessayer avec un autre en cliquant <a href="feuille_inscription.php">ici</a>.</p>';
			}
			else if($confmdp == 1) {
				//Si le mot de passe de vérification n'est pas correcte
				echo '<p>Le mot de passe de vérification n\'est pas identique au premier, veuillez réessayer <a href="feuille_inscription.php">ici</a>.</p>';
			}
			else {
				//Si tout est bon :
				echo '<p>Vous voilà inscrit. <\hr> Veuillez maintenant vous connecter <a href="feuille_connexion.php">ici</a> pour pouvoir lire et participer à un forum autour de morceaux du monde entier. Vous pourrez aussi compléter votre compte dans l\'onglet "compte" afin d\'accéder à des recommendations personnalisées pour découvrir de nouveaux titres que vous pourriez aimer.</p>';
			} ?>
			<p><a href="pays.php">Retourner sur le site.</a></p>
		</div>
	</body>
</html>