<?php session_start() ?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8"/>
	<link  href="avis.css" rel="stylesheet" type="text/css" media="all">
	<title>Dépôt d'un avis</title>
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
	<div id="create_account">
		<form action="script_create_account.php" method="POST" >
			<div><label><div class="label">Adresse mail (étudiante): <span class="interrogation" data-descr="Nous vous conseillons de rediriger votre adresse mail étudiante vers une boîte mail personnelle pour simplifier les échanges. Vous pouvez faire cela sur CELENE via l'onglet &quot;Redirection boîte mail&quot;.">?</span></div><input class="formule" id="mail" type="text" name="mail" pattern="[a-z0-9\.-]{3,}" minlength="5" maxlength="35" placeholder=" ex : prenom.nom" title="Votre adresse mail" required autofocus>@etu.univ-tours.fr</label></div>
			<div><label><div class="label">Nom : </div><div id="auto_nom"></div><input class="formule" id="nom" type="text" name="nom" placeholder="Nom" title="Votre nom" ></label></div>
			<div><label><div class="label">Prénom : </div><div id="auto_prenom"></div><input class="formule" id="prenom" type="text" name="prenom" placeholder="Prénom" title="Votre prénom" ></label></div>
			<div><label><div class="label">Mot de passe : <span class="interrogation" data-descr="Nous vous conseillons de ne pas utiliser un même mot de passe sur plusieurs sites.">?</span></div><input class="formule" type="password" name="mdp" id="mdp" placeholder="Mot de passe" title="Créez un mot de passe" required></label></div>
			<div><p><input type="submit" name="envoyer" value="Valider" id="inscrire" /></p></div>
		</form>
	</div>
	<!-- Partie Javascript -->
	<script type="text/javascript">
		let prenom;
		let nom;
		//Autocompletion of the names with the email adress
		const mail = document.getElementById('mail');
		mail.addEventListener('input', function(){
			if(mail.value.indexOf(".") !== -1) {
				const noms = mail.value.split(".");
				prenom = noms[0];
				nom = noms[1];
				document.getElementById('prenom').style.display = 'none';
				prenom = prenom.charAt(0).toUpperCase() + prenom.slice(1);
				document.getElementById('auto_prenom').innerHTML = prenom;
				if(nom.match(/-[0-9]$/) !== null) {
					document.getElementById('nom').style.display = 'none';
					nom = nom.charAt(0).toUpperCase() + nom.slice(1,-2);
					document.getElementById('auto_nom').innerHTML = nom;
				}
				else {
					document.getElementById('nom').style.display = 'none';
					nom = nom.charAt(0).toUpperCase() + nom.slice(1);
					document.getElementById('auto_nom').innerHTML = nom;
				}
			}
			else {
				document.getElementById('prenom').style.display = 'none';
				prenom = mail.value.charAt(0).toUpperCase() + mail.value.slice(1);
				document.getElementById('auto_prenom').innerHTML = prenom;
			}
		});

		//envoie des nom et prenom auto complété
		const submit = document.getElementById('inscrire');
		submit.addEventListener('click', function() {
			const name = document.getElementById('nom');
			name.setAttribute('value', nom);

			const surname = document.getElementById('prenom');
			surname.setAttribute('value', prenom);
		});
	</script>
</body>
</html>