<?php

include("connexion_bdd.php");
include("fonctions.php");

/* -------------------------------------------------- variables session -------------------------------------------------- */

session_start();

if (isset($_GET['Localisation'])) {
	$_SESSION['Localisation'] = $_GET['Localisation'];
}

$lieu = $_SESSION['Localisation'];

if ($lieu == 'Toute localisation') {
	$lieu = 'a.fk_localisation';
}

if (isset($_GET['domaine'])) {
	$_SESSION['domaine'] = $_GET['domaine'];
}

/* -------------------------------------------------- on remet les valueur à 0 -------------------------------------------------- */

$etoile_full = '<img src=\'image/etoile_full.png\'>';
$etoile_null = '<img src=\'image/etoile_null.png\'>';
$etoile_demi = '<img src=\'image/etoile_demi.png\'>';

$etoilemin = 0;
$salairemin = 0;
$totalcheck = array();
$nbr_sem = '';

$etoile_a = '';
$salaire_a = '';

$checked_input = array (
    'etoile1' => '',
    'etoile2' => '',
    'etoile3' => '',
    'etoile4' => '',
    'etoile5' => '',
    'check1' => '',
    'check2' => '',
    'check3' => '',
    'check4' => '',
    'check5' => '',
    'amountRange' => maj_filtre($lieu,$_SESSION['domaine'])[0]);


/* -------------------------------------------------- variables du filtre -------------------------------------------------- */

if (isset($_GET['etoile'])) {
	$etoilemin = $_GET['etoile'];
	$checked_input['etoile'.$etoilemin] = 'checked';
	$etoile_a = '&etoile='.$etoilemin;

}

for ($i=1; $i < 6; $i++) { 

	if (isset($_GET['check'.$i])) {

		$nbr_sem .= 'check'.$i.'='.$_GET['check'.$i].'&';
		$check = unserialize($_GET['check'.$i]);
		$totalcheck = array_merge($totalcheck,$check);
		$checked_input['check'.$i] = 'checked';
	}
}

if (isset($_GET['amountRange'])) {
	$salairemin = $_GET['amountRange'];
	$checked_input['amountRange'] = $salairemin;
	$salaire_a = '&amountRange='.$salairemin;

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

 	<?php
			include("header.php");
	?>	

 	<div id="page_test"><div class="page_test_test"></div></div>
 	<div id="bord_droit"><div class="page_test_test"></div></div>

 	<div id="page_avis">

 	<aside>
 		<p>
 			<?php echo sup_num_location($_SESSION['Localisation']); ?><img src="image/index_2.png"><?php echo $_SESSION['domaine']; ?><img src="image/index_2.png">Résultats de votre recherche
 		</p>
 	</aside>

 	<aside id="avis_filtre">
 		<h2>Filtres</h2>
 		<form method="get" action="avis.php">
 			<h3>Salaire</h3>
 			<input type="range" name="amountRange" step="10" oninput="num.value = this.value"
 			value = <?php echo '\''.$checked_input['amountRange'].'\'' ?>
 			min = <?php echo '\''.maj_filtre($lieu,$_SESSION['domaine'])[0].'\'' ?>
 			max = <?php echo '\''.maj_filtre($lieu,$_SESSION['domaine'])[1].'\'' ?>
 			>
   		
    		<div><p><output id="num"><?php echo $checked_input['amountRange'] ?></output>€</p><p><?php echo maj_filtre($lieu,$_SESSION['domaine'])[1] ?>€</p></div>

    		<div class="demarcation"></div>

    		<h3>Durée (semaine)</h3>

    		<input type="checkbox" name="check1" value="a:2:{i:0;i:0;i:1;i:4;}" <?php echo $checked_input['check1']; ?>><label > 4 et -</label><br>
    		<input type="checkbox" name="check2" value="a:2:{i:0;i:4;i:1;i:8;}" <?php echo $checked_input['check2']; ?>><label > 4 à 8</label><br>
    		<input type="checkbox" name="check3" value="a:2:{i:0;i:8;i:1;i:12;}" <?php echo $checked_input['check3']; ?>><label > 8 à 12</label><br>
    		<input type="checkbox" name="check4" value="a:2:{i:0;i:12;i:1;i:16;}" <?php echo $checked_input['check4']; ?>><label > 12 à 16</label><br>
    		<input type="checkbox" name="check5" value="a:2:{i:0;i:16;i:1;i:100;}" <?php echo $checked_input['check5']; ?>><label > 16 et +</label><br>

    		<div class="demarcation"></div>

    		<h3>Nombre d'étoiles</h3>
    		<input type="radio" name="etoile" value="1" <?php echo $checked_input['etoile1']; ?>><label > 1 étoile et +</label><br>
    		<input type="radio" name="etoile" value="2" <?php echo $checked_input['etoile2']; ?>><label > 2 étoile et +</label><br>
    		<input type="radio" name="etoile" value="3" <?php echo $checked_input['etoile3']; ?>><label > 3 étoile et +</label><br>
    		<input type="radio" name="etoile" value="4" <?php echo $checked_input['etoile4']; ?>><label > 4 étoile et +</label><br>
    		<input type="radio" name="etoile" value="5" <?php echo $checked_input['etoile5']; ?>><label > 5 étoile</label><br>

    		<input type="submit" name="submit_filters" value="Appliquer">
    		
 		</form>
 		<a href="avis.php">Réinitialiser</a>
 	</aside>

 	<section>
 		

 		<div id="tri_stage">
 			<p>Trier par</p>
 			<input type="button" name="btnsujet" value="intérêt sujet" class="selectbtntri">
 			<input type="button" name="btnaccessibilite" value="localisation" class="nonselectbtntri">
 			<input type="button" name="btnambiance" value="accueil" class="nonselectbtntri">
 			<input type="button" name="btnencadrement" value="encadrement" class="nonselectbtntri">

 		</div>
 		

<?php

/*-------------------------------------------------- connexion bd -----------------------------------------------------*/

try {
	$bdd = new PDO('mysql:host=localhost;port=3306;dbname=site_polytech;charset=utf8', 'root', '');
}

catch (Exception $e) {
    die('Erreur z(hsrthsrth: ' . $e->getMessage());
}

/*-------------------------------------------------- requete -----------------------------------------------------*/

if ($lieu != 'a.fk_localisation') {
	$lieu = '\''.$_SESSION['Localisation'].'\'';
}

$requete =array(

'SELECT  a.id_stage id_stage, a.fk_domaine domaine,  a.note_globale note_globale,  a.fk_localisation fk_localisation,  a.salaire salaire, 
a.duree duree, a.avis avis,a.adresse adresse, e.nom nom, e.logo logo
FROM avis a
INNER JOIN entreprises e
ON a.fk_num_siret = e.num_siret
WHERE a.fk_localisation = '.$lieu.' AND a.fk_domaine = \''.$_SESSION['domaine'].'\'
ORDER BY note_interet DESC, note_globale DESC',

'SELECT  a.id_stage id_stage, a.fk_domaine domaine,  a.note_globale note_globale,  a.fk_localisation fk_localisation,  a.salaire salaire, 
a.duree duree, a.avis avis,a.adresse adresse, e.nom nom, e.logo logo
FROM avis a
INNER JOIN entreprises e
ON a.fk_num_siret = e.num_siret
WHERE a.fk_localisation = '.$lieu.' AND a.fk_domaine = \''.$_SESSION['domaine'].'\'
ORDER BY note_localisation DESC, note_globale DESC',

'SELECT  a.id_stage id_stage, a.fk_domaine domaine,  a.note_globale note_globale,  a.fk_localisation fk_localisation,  a.salaire salaire, 
a.duree duree, a.avis avis,a.adresse adresse, e.nom nom, e.logo logo
FROM avis a
INNER JOIN entreprises e
ON a.fk_num_siret = e.num_siret
WHERE a.fk_localisation = '.$lieu.' AND a.fk_domaine = \''.$_SESSION['domaine'].'\'
ORDER BY note_accueil DESC, note_globale DESC',

'SELECT  a.id_stage id_stage, a.fk_domaine domaine,  a.note_globale note_globale,  a.fk_localisation fk_localisation,  a.salaire salaire, 
a.duree duree, a.avis avis,a.adresse adresse, e.nom nom, e.logo logo
FROM avis a
INNER JOIN entreprises e
ON a.fk_num_siret = e.num_siret
WHERE a.fk_localisation = '.$lieu.' AND a.fk_domaine = \''.$_SESSION['domaine'].'\'
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

    	$id_stage = $donnees['id_stage']; 

		$domaine = $donnees['domaine'];

		$note_globale = $donnees['note_globale'];

		$fk_localisation = $donnees['fk_localisation'];
		$fk_localisation = sup_num_location($fk_localisation);

		$salaire = $donnees['salaire'];

		$duree = $donnees['duree'];

		$avis = $donnees['avis'];

		$adresse = $donnees['adresse'];

		$titre = $donnees['nom'];

		$logo = $donnees['logo'];

/*-------------------------------------------------- application filtres -----------------------------------------------------*/

		$nbrfor = 0;
		for ($i=0; $i < count($totalcheck)-1; $i=$i+2) { 
			if (($duree<$totalcheck[$i]) OR ($duree>$totalcheck[$i+1])) {
				$nbrfor += 2;
			}
		}

		if ($note_globale < $etoilemin*8) {
			echo "";
			$nbrminrequete += 1;
		}
		
		else if ((count($totalcheck) == $nbrfor) AND (count($totalcheck) != 0)) {
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
				<div class=\'avis_stage_logo\'><img src=\'image/'.$logo.'\'></div>

					<div class=\'avis_stage_gauche\'>

						<a href=avis_detail.php?'.$nbr_sem.'id_stage='.$id_stage.$etoile_a.$salaire_a.

						'>'.$titre.'</a>
				
						<div class=\'avis_stage_info\'><img src=\'image/piece.png\'>'.$salaire.' €</div>
						<div class=\'avis_stage_info\'><img src=\'image/calendrier.png\'>'.$duree.' semaines</div>

					</div>

				<div class=\'avis_stage_droit\'>

				
					<div class=\'avis_stage_etoile\'>'.convertisseur_note_etoile($note_globale).'</div>

					<div class=\'avis_stage_info_2\'><img src=\'image/logo_domaine_black.png\'>'.$domaine.'</div>
					<div class=\'avis_stage_info_2\'><img src=\'image/logo_localisation_black.png\'>'.$fk_localisation.'</div>

				</div>'.$adresse.'

				<p><img src=\'image/guillemet_inv.png\'>'.htmlentities(substr($avis, 0,340)).'...<img src=\'image/guillemet.png\'></p>
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
		
 	</section>

 	</div>

 	<?php
			include("footer.php");
	?>

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

