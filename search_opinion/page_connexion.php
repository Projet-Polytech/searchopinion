<?php session_start();
	include("connexion_bdd.php");
	//initializing variables
	$pb_password = 0;
	$pb_mail = 0;
	$redirection = false;
	if(isset($_POST['mail']) and isset($_POST['mdp'])) {
		$email = htmlspecialchars($_POST['mail']) . "@etu.univ-tours.fr";
		$req = $bdd->prepare("SELECT * FROM utilisateurs WHERE mail = :mail");
		$req->bindParam('mail', $email);
		$req->execute();
		$resultat = $req->fetch();
		// Comparaison du pass envoyé via le formulaire avec la base
		$isPasswordCorrect = password_verify($_POST['mdp'], $resultat['mdp']);
		if(!$resultat) {
			$pb_mail = 1;
		}
		else {
			if($isPasswordCorrect) {
				$_SESSION['connected'] = true;
				$_SESSION['email'] = $email;
				$redirection = true;
			}
			else {
				$pb_password = 1;
			}
		}
	}
?>
<script type="text/javascript">
	if(<?php echo json_encode($redirection); ?>) {
		window.location.replace("../send_opinion/depot_avis.php"); //plutôt mettre la page de gestion de compte
	}
</script>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8"/>
	<link  href="formulaire.css" rel="stylesheet" type="text/css" media="all">
	<title>Connexion</title>
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
	<div id="connexion">
		<h1>Connexion</h1>
		<div id="message">
			<?php if($pb_password == 1 | $pb_mail == 1) {
				echo '<p>Etes-vous sûr d\'être déjà inscrit ? Si vous l\'êtes, réessayer de vous connecter ci-dessous, sinon cliquez <a href="page_create_account.php">ici</a> pour vous inscrire.</p>';
			}
			else {
				echo '<p>Si vous n\'avez pas encore de compte, cliquez <a href="page_create_account.php">ici</a> pour vous inscrire.</p>';
			} ?>
		</div>
		<form action="page_connexion.php" method="POST">
			<div><label><div class="label">Adresse mail (étudiante): </div><input class="formule" id="mail" type="text" name="mail" pattern="[a-z0-9\.-]{3,}" minlength="5" maxlength="35" placeholder=" ex : prenom.nom" title="Votre adresse mail" required autofocus>@etu.univ-tours.fr</label></div>
			<div><label><div class="label">Mot de passe : </div><input class="formule" type="password" name="mdp" id="mdp" placeholder="Mot de passe" title="Entrez votre mot de passe" required></label></div>
			<div><p><input type="submit" name="envoyer" value="Valider" id="inscrire" /></p></div>
		</form>
	</div>
</body>
</html>