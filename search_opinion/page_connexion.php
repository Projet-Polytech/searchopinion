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
		// Compare the password from the database and the one given
		$isPasswordCorrect = password_verify($_POST['mdp'], $resultat['mdp']);
		if(!$resultat) {
			$pb_mail = 1;
		}
		else {
			if($isPasswordCorrect) {
				$_SESSION['email'] = $email;
				$redirection = true;
			}
			else {
				$pb_password = 1;
			}
		}
		$req->closeCursor();
	}
?>
<script type="text/javascript">
	if(<?php echo json_encode($redirection); ?>) {
		window.location.replace("compte.php"); 
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
	<?php include("header.php") ?>
	<div id="connexion">
		<h1>Connexion</h1>
		<div id="message">
			<?php if($pb_password == 1 | $pb_mail == 1) {
				echo '<p>D\'être déjà inscrit ? Si oui, réessayer de vous connecter ci-dessous, </br>sinon cliquez <a href="page_create_account.php">ici</a> pour vous inscrire.</p>';
			}
			else {
				echo '<p>Si vous n\'avez pas encore de compte, cliquez <a href="page_create_account.php">ici</a> pour vous inscrire.</p>';
			} ?>
		</div>
		<form action="page_connexion.php" method="POST">
			<div><label><div class="label">Adresse mail (étudiante): </div><input class="formule" id="mail" type="text" name="mail" pattern="[a-z0-9\.-]{3,}" minlength="5" maxlength="35" placeholder=" ex : prenom.nom" title="Votre adresse mail" required autofocus>@etu.univ-tours.fr</label></div>
			<div><label><div class="label">Mot de passe : </div><input class="formule" type="password" name="mdp" id="mdp" placeholder="Mot de passe" title="Entrez votre mot de passe" pattern="^[a-zA-Z0-9\?\!\@\+\*\$\&\_\:\.\-\#]{4,25}$" required></label></div>
			<div><p><input type="submit" name="envoyer" value="Valider" id="inscrire" /></p></div>
		</form>
	</div>
	<?php include('footer.php'); ?>
</body>
</html>
