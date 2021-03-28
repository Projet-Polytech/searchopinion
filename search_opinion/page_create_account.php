<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8"/>
	<link  href="formulaire.css" rel="stylesheet" type="text/css" media="all">
	<title>Dépôt d'un avis</title>
</head>
<body>
	<?php include("header.php") ?>
	<div id="create_account">
		<form action="script_create_account.php" method="POST" >
			<div><label><div class="label">Adresse mail (étudiante): <span class="interrogation" data-descr="Nous vous conseillons de rediriger votre adresse mail étudiante vers une boîte mail personnelle pour simplifier les échanges. Vous pouvez faire cela sur CELENE via l'onglet &quot;Redirection boîte mail&quot;.">?</span></div><input class="formule" id="mail" type="text" name="mail" pattern="^[a-z0-9-]{2,}\.[a-z0-9-]{2,}$" minlength="3" maxlength="32" placeholder=" ex : prenom.nom" title="Votre adresse mail" required autofocus>@etu.univ-tours.fr</label></div>
			<div><label><div class="label">Nom : </div><div id="auto_nom"></div><input class="formule" type="text" name="nom" id="nom"></label></div>
			<div><label><div class="label">Prénom : </div><div id="auto_prenom"></div><input class="formule" type="text" name="prenom" id="prenom"></label></div>
			<div><label><div class="label">Mot de passe : <span class="interrogation" data-descr="Nous vous conseillons de ne pas utiliser un même mot de passe sur plusieurs sites.">?</span></div><input class="formule" type="password" name="mdp" id="mdp" placeholder="Mot de passe" title="Créez un mot de passe" oncopy="return false" oncut="return false" required></label></div>
			<div><label><div class="label">Confirmation mot de passe : </div><input class="formule" type="password" name="mdp_verif" id="mdp_verif" placeholder="Recopiez votre mot de passe" title="Confirmer votre mot de passe" onpast="return false" required></label></div>
			<div><p><input type="submit" name="envoyer" value="Valider" id="inscrire" readonly /></p></div>
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
				prenom = prenom.charAt(0).toUpperCase() + prenom.slice(1);
				document.getElementById('auto_prenom').innerHTML = prenom;
				if(nom.match(/-[0-9]$/) !== null) {
					nom = nom.charAt(0).toUpperCase() + nom.slice(1,-2);
					document.getElementById('auto_nom').innerHTML = nom;
				}
				else {
					nom = nom.charAt(0).toUpperCase() + nom.slice(1);
					document.getElementById('auto_nom').innerHTML = nom;
				}
			}
			else {
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
		//Control for the second password :
		const mdp_2 = document.getElementById('mdp_verif');
		mdp_2.addEventListener('input', function(){
			if(mdp_2.value !== document.getElementById('mdp').value) {
				mdp_2.style.border = '2px inset #FF0000';
				document.getElementById('inscrire').setAttribute('type', 'text');
			}
			else {
				mdp_2.style.border = '2px inset #e0e0e0';
				document.getElementById('inscrire').setAttribute('type', 'submit');
			}
		});
	</script>
</body>
</html>
