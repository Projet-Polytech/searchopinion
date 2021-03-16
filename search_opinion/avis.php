<?php

/*-------------------------------------------------- fonctions ----------------------------------------------------------*/

function convertisseur_note_etoile($note) {

	$note_etoile = '';
	$etoile_full = '<img src=\'image/etoile_full.png\'>';
	$etoile_null = '<img src=\'image/etoile_null.png\'>';
	$etoile_demi = '<img src=\'image/etoile_demi.png\'>';

	for ($nbr=0; $nbr < 5; $nbr++) { 

		if ($note == 0) {
			$note_etoile .= $etoile_null;
		}

		if (($note <= 4) and ($note > 0)) {
			$note = 0;
			$note_etoile .= $etoile_demi;
		}

		if ($note >= 8) {
			$note -= 8;
			$note_etoile .= $etoile_full;
		}
	}

	return $note_etoile;
}


function maj_filtre () {
	$bdd = new PDO('mysql:host=localhost;port=3307;dbname=site_polytech;charset=utf8', 'root', '');
	$reponse = $bdd->query('SELECT salaire FROM avis');
	$note = array();
    while ($donnees = $reponse->fetch()) {
    	$note[] = $donnees['salaire'];
    }
    $minmax =array(min($note),max($note));
    return ($minmax);
}

/* -------------------------------------------------- variables formulaire -------------------------------------------------- */

$etoile_full = '<img src=\'image/etoile_full.png\'>';
$etoile_null = '<img src=\'image/etoile_null.png\'>';
$etoile_demi = '<img src=\'image/etoile_demi.png\'>';

$etoilemin = 0;

if (isset($_POST['etoile'])) {
	$etoilemin = $_POST['etoile'];
}

$totalcheck = array();

for ($i=1; $i < 6; $i++) { 

	if (isset($_POST['check'.$i])) {
	$check = unserialize($_POST['check'.$i]);
	$totalcheck = array_merge($totalcheck,$check);
	}
}

if (isset($_POST['amountRange'])) {
	$salairemin = $_POST['amountRange'];
}

/*---------------------------------------------------------- html ----------------------------------------------------------*/

?>

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
 		<form method="post" action="avis.php">
 			<h3>Salaire</h3>
 			<input type="range" name="amountRange" step="10" oninput="num.value = this.value"
 			value = <?php echo '\''.maj_filtre()[0].'\'' ?>
 			min = <?php echo '\''.maj_filtre()[0].'\'' ?>
 			max = <?php echo '\''.maj_filtre()[1].'\'' ?>
 			>
   		
    		<div><p><output id="num"><?php echo maj_filtre()[0] ?></output>€</p><p><?php echo maj_filtre()[1] ?>€</p></div>

    		<div class="demarcation"></div>

    		<h3>Durée (semaine)</h3>

    		<input type="checkbox" name="check1" value="a:2:{i:0;i:0;i:1;i:4;}"><label > 4 et -</label><br>
    		<input type="checkbox" name="check2" value="a:2:{i:0;i:4;i:1;i:8;}"><label > 4 à 8</label><br>
    		<input type="checkbox" name="check3" value="a:2:{i:0;i:8;i:1;i:12;}"><label > 8 à 12</label><br>
    		<input type="checkbox" name="check4" value="a:2:{i:0;i:12;i:1;i:16;}"><label > 12 à 16</label><br>
    		<input type="checkbox" name="check5" value="a:2:{i:0;i:16;i:1;i:100;}"><label > 16 et +</label><br>

    		<div class="demarcation"></div>

    		<h3>Nombre d'étoiles</h3>
    		<input type="radio" name="etoile" value="1"><label > 1 étoile et +</label><br>
    		<input type="radio" name="etoile" value="2"><label > 2 étoile et +</label><br>
    		<input type="radio" name="etoile" value="3"><label > 3 étoile et +</label><br>
    		<input type="radio" name="etoile" value="4"><label > 4 étoile et +</label><br>
    		<input type="radio" name="etoile" value="5"><label > 5 étoile</label><br>

    		<input type="submit" name="submit_filters" value="Appliquer">
    		
 		</form>
 	</aside>

 	<section>
 		

 		<div id="tri_stage">
 			<input type="button" name="btnsujet" value="intérêt sujet" class="selectbtntri">
 			<input type="button" name="btnaccessibilite" value="accessibilité" class="nonselectbtntri">
 			<input type="button" name="btnambiance" value="ambiance" class="nonselectbtntri">
 			<input type="button" name="btnencadrement" value="encadrement" class="nonselectbtntri">

 		</div>
 		

<?php

/*-------------------------------------------------- connexion bd -----------------------------------------------------*/

try {
	$bdd = new PDO('mysql:host=localhost;port=3307;dbname=site_polytech;charset=utf8', 'root', '');
}

catch (Exception $e) {
    die('Erreur z(hsrthsrth: ' . $e->getMessage());
}

/*-------------------------------------------------- requete -----------------------------------------------------*/

$requete =array(

'SELECT  a.domaine domaine,  a.note_globale note_globale,  a.fk_localisation fk_localisation,  a.salaire salaire, a.duree duree, a.avis avis, e.nom nom
FROM avis a
INNER JOIN entreprises e
ON a.fk_num_siret = e.num_siret
ORDER BY note_interet DESC, note_globale DESC',

'SELECT  a.domaine domaine,  a.note_globale note_globale,  a.fk_localisation fk_localisation,  a.salaire salaire, a.duree duree, a.avis avis, e.nom nom
FROM avis a
INNER JOIN entreprises e
ON a.fk_num_siret = e.num_siret
ORDER BY note_accessibilite DESC, note_globale DESC',

'SELECT  a.domaine domaine,  a.note_globale note_globale,  a.fk_localisation fk_localisation,  a.salaire salaire, a.duree duree, a.avis avis, e.nom nom
FROM avis a
INNER JOIN entreprises e
ON a.fk_num_siret = e.num_siret
ORDER BY note_accueil DESC, note_globale DESC',

'SELECT  a.domaine domaine,  a.note_globale note_globale,  a.fk_localisation fk_localisation,  a.salaire salaire, a.duree duree, a.avis avis, e.nom nom
FROM avis a
INNER JOIN entreprises e
ON a.fk_num_siret = e.num_siret
ORDER BY note_encadrement DESC, note_globale DESC'

);

/*-------------------------------------------------- tri -----------------------------------------------------*/

for ($nombre_de_tri = 0; $nombre_de_tri <= 3; $nombre_de_tri++) {

    if ($nombre_de_tri == 0) {
    	echo     '<div id=\'avis_stage_tri_'.$nombre_de_tri.'\' class =\'selectpage\'>';
    }

    else {
    	echo     '<div id=\'avis_stage_tri_'.$nombre_de_tri.'\' class =\'nonselectpage\'>';
    }

    $reponse1 = $bdd->query($requete[$nombre_de_tri]);

/*-------------------------------------------------- données requete -----------------------------------------------------*/

	$nbrminrequete = 0;
	$nbrtotalrequete = 0;

    while ($donnees = $reponse1->fetch()) {

    	$nbrtotalrequete +=1;

		$domaine = $donnees['domaine'];

		$note_globale = $donnees['note_globale'];

		$fk_localisation = $donnees['fk_localisation'];

		$salaire = $donnees['salaire'];

		$duree = $donnees['duree'];

		$avis = $donnees['avis'];

		$titre = $donnees['nom'];

/*-------------------------------------------------- application filtres -----------------------------------------------------*/

		$nbrfor = 1;
		for ($i=0; $i < count($totalcheck)-1; $i++) { 
			if (($duree<$totalcheck[$i]) OR ($duree>$totalcheck[$i+1]))
				$nbrfor += 1;
		}

		if ($note_globale < $etoilemin*8) {
			echo "";
			$nbrminrequete += 1;
		}
		
		else if (count($totalcheck) == $nbrfor) {
			echo "";
			$nbrminrequete += 1;
		}

		else if ($salaire < $salairemin) {
			echo "";
			$nbrminrequete += 1;
		}

/*-------------------------------------------------- stage requete -----------------------------------------------------*/
		else {
			echo 
	   
	    	'<div class=\'avis_stage \'>
				<div class=\'avis_stage_logo\'><img src=\'image/logo_accueil.webp\'></div>

					<div class=\'avis_stage_gauche\'>

						<h1>'.$titre.'</h1>
				
						<div class=\'avis_stage_info\'><img src=\'image/logo_domaine_black.png\'>'.$domaine.'</div>
						<div class=\'avis_stage_info\'><img src=\'image/logo_localisation_black.png\'>'.$fk_localisation.'</div>

					</div>

				<div class=\'avis_stage_droit\'>

				
					<div class=\'avis_stage_etoile\'>'.convertisseur_note_etoile($note_globale).'</div>

					<div class=\'avis_stage_info_2\'><img src=\'image/calendrier.png\'>'.$duree.' semaines</div>
					<div class=\'avis_stage_info_2\'><img src=\'image/logo_billet_2.png\'>'.$salaire.' €</div>

				</div>

				<iframe src=\'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9508.996379979799!2d-0.5406837830637089!3d44.8818036295758!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd5528dfc3af92df%3A0xb86c663b296b5f78!2zU29jacOpdMOpIEfDqW7DqXJhbGUgZGVzIEJvaXM!5e0!3m2!1sfr!2sfr!4v1613683502141!5m2!1sfr!2sfr\' width=\'400\' height=\'300\' frameborder=\'0\' style=\'border:0;\' allowfullscreen=\'\' aria-hidden=\'false\' tabindex=\'0\'></iframe>

				
				<p><img src=\'image/guillemet_inv.png\'>'.substr($avis, 0,340).'...<img src=\'image/guillemet.png\'></p>
			</div>';
		}

	}

	$reponse1->closeCursor();

	if ($nbrtotalrequete == $nbrminrequete) {
		echo '<div id=\'no_result_stage\'>Aucun Résultats trouvés, élargissez votre recherche</div>';
	}

	echo '</div>';

}

?>

<?php

/*  -------------------------------------------------- code html stage save -----------------------------------------------------

	<div id="avis_stage_tri_2" class="nonselectpage">
		<div class="avis_stage ">
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
	</div>
*/
?>
		
 	</section>

 	</div>

 	<footer></footer>

<script type="text/javascript">
  // <![CDATA[

var btnsujet = document.querySelector("input[name='btnsujet']");
var btnaccessibilite = document.querySelector("input[name='btnaccessibilite']");
var btnambiance = document.querySelector("input[name='btnambiance']");
var btnencadrement = document.querySelector("input[name='btnencadrement']");
var tri_0 = document.querySelector("#avis_stage_tri_0");
var tri_1 = document.querySelector("#avis_stage_tri_1");
var tri_2 = document.querySelector("#avis_stage_tri_2");
var tri_3 = document.querySelector("#avis_stage_tri_3");

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

    tri_0.className = "selectpage";
    tri_1.className = "nonselectpage";
    tri_2.className = "nonselectpage";
    tri_3.className = "nonselectpage";
  }
} 

function updatebtnaccessibilite() {
  if (btnaccessibilite.className === "nonselectbtntri") {

    btnsujet.className = "nonselectbtntri";
    btnaccessibilite.className = "selectbtntri";
    btnambiance.className = "nonselectbtntri";
    btnencadrement.className = "nonselectbtntri";

    tri_0.className = "nonselectpage";
    tri_1.className = "selectpage";
    tri_2.className = "nonselectpage";
    tri_3.className = "nonselectpage";
  }
} 

function updatebtnambiance() {
  if (btnambiance.className === "nonselectbtntri") {

    btnsujet.className = "nonselectbtntri";
    btnaccessibilite.className = "nonselectbtntri";
    btnambiance.className = "selectbtntri";
    btnencadrement.className = "nonselectbtntri";

    tri_0.className = "nonselectpage";
    tri_1.className = "nonselectpage";
    tri_2.className = "selectpage";
    tri_3.className = "nonselectpage";
  }
} 

function updatebtnbtnencadrement() {
  if (btnencadrement.className === "nonselectbtntri") {

    btnsujet.className = "nonselectbtntri";
    btnaccessibilite.className = "nonselectbtntri";
    btnambiance.className = "nonselectbtntri";
    btnencadrement.className = "selectbtntri";

    tri_0.className = "nonselectpage";
    tri_1.className = "nonselectpage";
    tri_2.className = "nonselectpage";
    tri_3.className = "selectpage";
  }
} 
  // ]]>

</script>

</body>
	
</html>

