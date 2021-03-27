<?php session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:\\wamp64\\PHPMailer-master\\src\\Exception.php';
require 'C:\\wamp64\\PHPMailer-master\\src\\PHPMailer.php';
require 'C:\\wamp64\\PHPMailer-master\\src\\SMTP.php';
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
		//echo $individus . "individus";
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
			//Version phpMailer qui fonctionne avec gmail mais pas Zimbra
			$mail = new PHPMailer();
			$mail->isSMTP();
			//$mail->SMTPDebug = 1;

			$mail->Host = 'smtp.gmail.com';             //Adresse IP ou DNS du serveur SMTP
			$mail->Port = 587;                          //Port TCP du serveur SMTP
			$mail->SMTPAuth = true;                        //Utiliser l'identification
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; //Protocole de sécurisation des échanges avec le SMTP
			$mail->Username   =  'site.stage.polytech@gmail.com';   //Adresse email à utiliser
			$mail->Password   =  'Mdp@Adm!n!str@t3ur';         //Mot de passe de l'adresse email à utiliser

			$mail->setFrom('site.stage.polytech@gmail.com', 'Site stages Polytech');
			$mail->AddAddress($email);
			$mail->Subject    =  'Verification de votre email';                      //Le sujet du mail
			$mail->WordWrap   = 50; 			                   //Nombre de caracteres pour le retour a la ligne automatique
			$mail->msgHTML(file_get_contents('mail_verif.html'), __DIR__); 		   //Le contenu au format HTML
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
		<div id="account_created">
			<?php if($uni_mail == 1) {
				//Si l'adresse mail a déjà été utilisée pour un compte
				echo '<p>Cette adresse mail est déjà utilisée. Vous avez peut-être déjà un compte alors cliquez <a href="page_connexion.php">ici</a> pour vous connecter. Ou cliquez <a href="page_create_account.php">ici</a> pour réessayer avec une autre adresse.</p>';
			}
			else {
				//Si tout est bon et que l'envoie de mail fonctionne :
				//echo '<p>Vous voilà inscrit. </br> Vous allez maintenant recevoir un mail pour confirmer cette inscription et vous pourrez ensuite entrer un avis sur un stage réalisé.</p>';
				//Si tout est bon mais que l'envoie de mail ne fonctionne pas :
				echo '<p>Vous voilà inscrit. </br> Pour valider votre inscription cliquez <a href="verified_account.php">ici</a> et vous pourrez ensuite entrer un avis ou consulter des avis que vous avez déjà rédigé.</p>';
			} ?>
			<p><a href="accueil.php">Retourner sur le site.</a></p>
		</div>
	</body>
</html>