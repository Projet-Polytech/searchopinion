<!DOCTYPE html>
<html lang="fr">
<head>
	<title></title>
    <meta charset="UTF-8" >
    <link  href="avis.css" rel="stylesheet">
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

 	<div id="page_test"><div class="page_test_test"></div></div>
 	<div id="bord_droit"><div class="page_test_test"></div></div>

 	<div id="page_avis">

 	<aside>
 		<p>
 			Italie<img src="image/index_2.png">Environement<img src="image/index_2.png">Résultats de votre recherche
 		</p>
 	</aside>

 	<aside id="avis_filtre">
 		<h2>Filtres</h2>
 		<form >
 			<h3>Salaire</h3>
 			<input type="range" name="amountRange" step="10" min="1200" max="2000" value="1200" oninput="num.value = this.value">
   		
    		<div><p><output id="num">1200</output>€</p><p>2000€</p></div>

    		<div class="demarcation"></div>

    		<h3>Durée (semaine)</h3>

    		<input type="checkbox" name="" value="4_et_-"><label > 4 et -</label><br>
    		<input type="checkbox" name="" value="4 à 8"><label > 4 à 8</label><br>
    		<input type="checkbox" name="" value="8 à 12"><label > 8 à 12</label><br>
    		<input type="checkbox" name="" value="12 à 16"><label > 12 à 16</label><br>
    		<input type="checkbox" name="" value="16 et +"><label > 16 et +</label><br>

    		<div class="demarcation"></div>

    		<h3>Nombre d'étoiles</h3>
    		<input type="radio" name="etoile" value="1_etoile"><label > 1 étoile et +</label><br>
    		<input type="radio" name="etoile" value="2_etoile"><label > 2 étoile et +</label><br>
    		<input type="radio" name="etoile" value="3_etoile"><label > 3 étoile et +</label><br>
    		<input type="radio" name="etoile" value="4_etoile"><label > 4 étoile et +</label><br>
    		<input type="radio" name="etoile" value="5_etoile"><label > 5 étoile</label><br>

    		<input type="submit" name="submit_filters" value="Appliquer">
    		
 		</form>
 	</aside>

 	<section>
 		

 		<div id="tri_stage">
 			<input type="button" name="btnsujet" value="sujet" class="selectbtntri">
 			<input type="button" name="btnaccessibilite" value="accessibilité" class="nonselectbtntri">
 			<input type="button" name="btnambiance" value="ambiance" class="nonselectbtntri">
 			<input type="button" name="btnencadrement" value="encadrement" class="nonselectbtntri">

 		</div>

<?php

try {
	$bdd = new PDO('mysql:host=localhost;port=3307;dbname=site_polytech;charset=utf8', 'root', '');
}

catch (Exception $e) {
    die('Erreur z(hsrthsrth: ' . $e->getMessage());
}

$reponse1 = $bdd->query('SELECT domaine, titre, note_globale, fk_localisation, salaire, duree, avis FROM avis');

while ($donnees = $reponse1->fetch())
{
	$domaine = $donnees['domaine'];

	$titre = $donnees['titre'];

	$note_globale = $donnees['note_globale'];

	$fk_localisation = $donnees['fk_localisation'];

	$salaire = $donnees['salaire'];

	$duree = $donnees['duree'];

	$avis = $donnees['avis'];

}

$reponse1->closeCursor();

echo 

'<div class=\'avis_stage avis_stage_ordre_2\'>
				<div class=\'avis_stage_logo\'><img src=\'image/logo_accueil.webp\'></div>

					<div class=\'avis_stage_gauche\'>

						<h1>'.$titre.'</h1>
				
						<div class=\'avis_stage_info\'><img src=\'image/logo_domaine_black.png\'>'.$domaine.'</div>
						<div class=\'avis_stage_info\'><img src=\'image/logo_localisation_black.png\'>'.$fk_localisation.'</div>

					</div>

				<div class=\'avis_stage_droit\'>

				
					<div class=\'avis_stage_etoile\'><img src=\'image/etoile_1.png\'><img src=\'image/etoile_1.png\'><img src=\'image/etoile_1.png\'><img src=\'image/etoile_2.png\'><img src=\'image/etoile_2.png\'></div>

					<div class=\'avis_stage_info_2\'><img src=\'image/calendrier.png\'>'.$duree.' semaines</div>
					<div class=\'avis_stage_info_2\'><img src=\'image/logo_billet_2.png\'>'.$salaire.' €</div>

				</div>

				<iframe src=\'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9508.996379979799!2d-0.5406837830637089!3d44.8818036295758!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd5528dfc3af92df%3A0xb86c663b296b5f78!2zU29jacOpdMOpIEfDqW7DqXJhbGUgZGVzIEJvaXM!5e0!3m2!1sfr!2sfr!4v1613683502141!5m2!1sfr!2sfr\' width=\'400\' height=\'300\' frameborder=\'0\' style=\'border:0;\' allowfullscreen=\'\' aria-hidden=\'false\' tabindex=\'0\'></iframe>

				
				<p><img src=\'image/guillemet_inv.png\'>'.substr($avis, 0,340).'...<img src=\'image/guillemet.png\'></p>
		</div>';



?>

		<div class="avis_stage avis_stage_ordre_1">
				<div class="avis_stage_logo"><img src="image/logo_accueil.webp"></div>

					<div class="avis_stage_gauche">

						<h1>Tesla</h1>
				
						<div class="avis_stage_info"><img src="image/logo_domaine_black.png">Informatique</div>
						<div class="avis_stage_info"><img src="image/logo_localisation_black.png">Lyon</div>

					</div>

				<div class="avis_stage_droit">

				
					<div class="avis_stage_etoile"><img src="image/etoile_1.png"><img src="image/etoile_1.png"><img src="image/etoile_1.png"><img src="image/etoile_2.png"><img src="image/etoile_2.png"></div>

					<div class="avis_stage_info_2"><img src="image/calendrier.png">12 semaines</div>
					<div class="avis_stage_info_2"><img src="image/logo_billet_2.png">1800 €</div>

				</div>

				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9508.996379979799!2d-0.5406837830637089!3d44.8818036295758!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd5528dfc3af92df%3A0xb86c663b296b5f78!2zU29jacOpdMOpIEfDqW7DqXJhbGUgZGVzIEJvaXM!5e0!3m2!1sfr!2sfr!4v1613683502141!5m2!1sfr!2sfr" width="400" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

				
				<p><img src="image/guillemet_inv.png">Encore un extrait du début de l'avis sur un autre stage pour test. Dans l'idéale on met là aussi 4-5 lignes pour donner envie de lire la suite. Cette fois extrait plus long donc au moins 10 lignes pour que ça remplisse Vous êtes à la recherche d’une offre de stage ? StudentJob vous propose de nombreuses annonces de stage dans la vente ...<img src="image/guillemet.png"></p>
		</div>

		<div class="avis_stage avis_stage_ordre_2">
				<div class="avis_stage_logo"><img src="image/logo_accueil.webp"></div>

					<div class="avis_stage_gauche">

						<h1>Sociétée générale</h1>
				
						<div class="avis_stage_info"><img src="image/logo_domaine_black.png">Informatique</div>
						<div class="avis_stage_info"><img src="image/logo_localisation_black.png">Lyon</div>

					</div>

				<div class="avis_stage_droit">

				
					<div class="avis_stage_etoile"><img src="image/etoile_1.png"><img src="image/etoile_1.png"><img src="image/etoile_1.png"><img src="image/etoile_2.png"><img src="image/etoile_2.png"></div>

					<div class="avis_stage_info_2"><img src="image/calendrier.png">12 semaines</div>
					<div class="avis_stage_info_2"><img src="image/logo_billet_2.png">1800 €</div>

				</div>

				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9508.996379979799!2d-0.5406837830637089!3d44.8818036295758!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd5528dfc3af92df%3A0xb86c663b296b5f78!2zU29jacOpdMOpIEfDqW7DqXJhbGUgZGVzIEJvaXM!5e0!3m2!1sfr!2sfr!4v1613683502141!5m2!1sfr!2sfr" width="400" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

				
				<p><img src="image/guillemet_inv.png">Encore un extrait du début de l'avis sur un autre stage pour test. Dans l'idéale on met là aussi 4-5 lignes pour donner envie de lire la suite. Cette fois extrait plus long donc au moins 10 lignes pour que ça remplisse Vous êtes à la recherche d’une offre de stage ? StudentJob vous propose de nombreuses annonces de stage dans la vente ...<img src="image/guillemet.png"></p>
		</div>


		

 	</section>

 	</div>

 	<footer></footer>

<script type="text/javascript">
  // <![CDATA[

var btnsujet = document.querySelector("input[name='btnsujet']");
var btnaccessibilite = document.querySelector("input[name='btnaccessibilite']");
var btnambiance = document.querySelector("input[name='btnambiance']");
var btnencadrement = document.querySelector("input[name='btnencadrement']");
var classementouest = document.querySelector("#classementouest");
var classementest = document.querySelector("#classementest");

btnsujet.addEventListener('click', updatebtnsujet);
btnaccessibilite.addEventListener('click', updatebtnaccessibilite);
btnambiance.addEventListener('click', updatebtnambiance);
btnencadrement.addEventListener('click', updatebtnbtnencadrement);

function updatebtnsujet() {
  if (btnsujet.className === "nonselectbtntri") {

    btnsujet.className = "selectbtntri";
    btnaccessibilite.className = "nonselectbtntri";
    btnambiance.className = "nonselectbtntri";
    btnencadrement.className = "nonselectbtntri";

    classementouest.className = "selectpage";
    classementest.className = "nonselectpage";
  }
} 

function updatebtnaccessibilite() {
  if (btnaccessibilite.className === "nonselectbtntri") {

    btnsujet.className = "nonselectbtntri";
    btnaccessibilite.className = "selectbtntri";
    btnambiance.className = "nonselectbtntri";
    btnencadrement.className = "nonselectbtntri";

    classementouest.className = "selectpage";
    classementest.className = "nonselectpage";
  }
} 

function updatebtnambiance() {
  if (btnambiance.className === "nonselectbtntri") {

    btnsujet.className = "nonselectbtntri";
    btnaccessibilite.className = "nonselectbtntri";
    btnambiance.className = "selectbtntri";
    btnencadrement.className = "nonselectbtntri";

    classementouest.className = "selectpage";
    classementest.className = "nonselectpage";
  }
} 

function updatebtnbtnencadrement() {
  if (btnencadrement.className === "nonselectbtntri") {

    btnsujet.className = "nonselectbtntri";
    btnaccessibilite.className = "nonselectbtntri";
    btnambiance.className = "nonselectbtntri";
    btnencadrement.className = "selectbtntri";

    classementouest.className = "selectpage";
    classementest.className = "nonselectpage";
  }
} 
  // ]]>

</script>

</body>
	
</html>

