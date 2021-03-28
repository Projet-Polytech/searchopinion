<?php

include("connexion_bdd.php");

session_start();

//echo var_dump($_SESSION['nbr_week1']);
/*
$_SESSION['nbr_week1'] = 'dkgjegjkerg1';
$_SESSION['nbr_week2'] = 'dkgjegjkerg2';


for ($i=1; $i < 6; $i++) { 
	if ($_SESSION['nbr_week'.$i] =! NULL) {
		unset($_SESSION['nbr_week'.$i]);
	}
}


echo var_dump($_SESSION['nbr_week1']);
echo var_dump($_SESSION['nbr_week2']);

*/


/* -------------------------------------------------- variables du filtre ---------------------------------------


$totalcheck = array();
$nbr_sem = '';

if (isset($_GET['etoile'])) {
	$etoilemin = $_GET['etoile'];
	$etoile_a = '&etoile='.$etoilemin;
}

for ($i=1; $i < 6; $i++) { 

	if (isset($_GET['check'.$i])) {
		$nbr_sem .= 'check'.$i.'='.$_GET['check'.$i].'&';
		$check = unserialize($_GET['check'.$i]);
		$totalcheck = array_merge($totalcheck,$check);		
	}
}

if (isset($_GET['amountRange'])) {
	$salairemin = $_GET['amountRange'];
	$salaire_a = '&amountRange='.$salairemin;
}

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

		if (($note < 8) and ($note > 4)) {
			$note = 0;
			$note_etoile .= $etoile_full;
		}

		if ($note >= 8) {
			$note -= 8;
			$note_etoile .= $etoile_full;
		}
	}

	return $note_etoile;
} 



$requete_domaine = $bdd->query('SELECT DISTINCT fk_domaine FROM avis');

	while($domaine = $requete_domaine->fetch()) {
		echo $domaine['fk_domaine'].'<br>'; 
	}

$requete_domaine->closeCursor(); 

$requete_localisation = $bdd->query('SELECT DISTINCT fk_localisation FROM avis');

	while($localisation = $requete_localisation->fetch()) {
		echo $localisation['fk_localisation'].'<br>'; 
	}

$requete_localisation->closeCursor(); 


----------- */


$requete =
'SELECT  a.date_depot date_depot, a.note_globale note_globale, a.id_stage id_stage, e.nom nom
FROM avis a
INNER JOIN entreprises e
ON a.fk_num_siret = e.num_siret
WHERE a.fk_localisation = a.fk_localisation';

if ($reponse1 =! NULL) {
	$reponse1 = $bdd->query($requete);

	while ($donnees = $reponse1->fetch()) {

	$note_globale = $donnees['note_globale'];
	echo $note_globale ;

	$id_stage = $donnees['id_stage'];

	$nom = $donnees['nom'];
	echo $nom ;
	}
}
/*
$requete =
'SELECT  a.date_depot date_depot, a.note_globale note_globale, a.id_stage id_stage, e.nom nom
FROM avis a
INNER JOIN entreprises e
ON a.fk_num_siret = e.num_siret
WHERE a.fk_mail = \'adresse@mail\'';

$reponse1 = $bdd->query($requete);

$total = $reponse1->rowCount();
echo $total;



//if ( mysql_num_rows($requete)) {
	//echo 'diff_null';
	
//}

}


$duree = 4;

$totalcheck = array();

for ($i=1; $i < 6; $i++) { 

	if (isset($_GET['check'.$i])) {
		$check = unserialize($_GET['check'.$i]);
		$totalcheck = array_merge($totalcheck,$check);
	}
}

echo var_dump($totalcheck);
echo count($totalcheck);

$nbrfor = 0;

for ($i=0; $i < count($totalcheck)-1; $i=$i+2) {
	echo 'entre'.$totalcheck[$i].'et'.$totalcheck[$i+1];
	if (($duree<$totalcheck[$i]) OR ($duree>$totalcheck[$i+1])) {
		$nbrfor += 2;
	}
}

echo $nbrfor;

----------- */
?>