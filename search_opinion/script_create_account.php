<?php session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master\\src\\Exception.php';
require 'PHPMailer-master\\src\\PHPMailer.php';
require 'PHPMailer-master\\src\\SMTP.php';
	include("connexion_bdd.php");
	//initializing variables
	$uni_mail = 0;
	$etat_mail = "";
	//uniqueness check then creation of the account
	if(isset($_POST['mail']) AND isset($_POST['nom']) AND isset($_POST['prenom']) AND isset($_POST['mdp']) AND isset($_POST['mdp_verif'])) {
		$email = htmlspecialchars($_POST['mail']) . "@etu.univ-tours.fr";
		$verification = $bdd->prepare('SELECT COUNT(*) AS mail FROM utilisateurs WHERE mail = :mail');
		$verification->bindParam(':mail', $email);
		$verification->execute();
		$individus = $verification->fetch();
		// uniqueness of the email
		if($individus['mail'] != 0) {
			$uni_mail = 1;
		}
		$verification->closeCursor();
		// if everything is alrigth create the account on the database
		if($uni_mail == 0) {
			$_SESSION['nom'] = htmlspecialchars($_POST['nom']);
			$_SESSION['connected'] = true;
			$nom = $_SESSION['nom'];
			$prenom = htmlspecialchars($_POST['prenom']);
			$creation = $bdd->prepare("INSERT INTO utilisateurs VALUES(:mail, :nom, :prenom, :mdpass, 0)");
			$creation->bindParam(':mail', $email);
			$creation->bindParam(':nom', $nom);
			$creation->bindParam(':prenom', $prenom);
			$creation->bindParam(':mdpass', $pass_hash);
			$pass_hash = password_hash(htmlspecialchars($_POST['mdp']), PASSWORD_DEFAULT);
			try {
				$creation->execute();
			}
			catch(Exception $e){
				echo "Erreur :".$e->getMessage();
			}

			//send an email to check for authentification with phpMailer
			//phpMailer version that work with @gmail.com but not @etu.univ-tours
			$mail = new PHPMailer();
			$mail->isSMTP();
			//$mail->SMTPDebug = 1;

			$mail->Host = 'smtp.gmail.com';
			$mail->Port = 587;
			$mail->SMTPAuth = true;
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
			$mail->Username   =  'site.stage.polytech@gmail.com';
			$mail->Password   =  'Mdp@Adm!n!str@t3ur';

			$mail->setFrom('site.stage.polytech@gmail.com', 'Site stages Polytech');
			$mail->AddAddress($email);
			$mail->Subject    =  'Verification de votre email';
			$mail->WordWrap   = 50;
			$mail->msgHTML(file_get_contents('mail_verif.html'), __DIR__);
			$mail->AltBody = 'Votre inscription est presque finie. Veuillez répondre à ce mail en expliquant que vous n\'avez pas reçu de lien pour valider votre inscription.';
			if (!$mail->send()) {
			    $etat_mail = $mail->ErrorInfo;
			} else{
			    $etat_mail = 'Message bien envoyé';
			}

			$_SESSION['email'] = $email;
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
	<link  href="formulaire.css" rel="stylesheet" type="text/css" media="all">
	<title>Compte créé</title>
</head>
<body>
	<?php include("header.php") ?>
	<body>
		<div id="account_created">
			<?php if($uni_mail == 1) {
				//If the email adress has already been used for an account
				echo '<p>Cette adresse mail est déjà utilisée. Vous avez peut-être déjà un compte alors cliquez <a href="page_connexion.php">ici</a> pour vous connecter. Ou cliquez <a href="page_create_account.php">ici</a> pour réessayer avec une autre adresse.</p>';
			}
			else {
				//If everything is alright and the email part too
				//echo '<p>Vous voilà inscrit. </br> Vous allez maintenant recevoir un mail pour confirmer cette inscription et vous pourrez ensuite entrer un avis sur un stage réalisé.</p>';
				//If everything is alright except the email part
				echo '<p>Vous voilà inscrit. </br> Pour valider votre inscription cliquez <a href="verified_account.php">ici</a> et vous pourrez ensuite entrer un avis ou consulter des avis que vous avez déjà rédigé.</p>';
			} ?>
			<p><a href="accueil.php">Retourner sur le site.</a></p>
		</div>
	</body>
</html>