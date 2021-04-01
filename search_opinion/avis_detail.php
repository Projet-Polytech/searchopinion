<?php 

/*-------------------------------------------------- sessions ----------------------------------------------------------*/

include("connexion_bdd.php"); 
include("fonctions.php");

session_start();

$id_stage = $_GET['id_stage'];

$etoile_full = '<img src=\'image/etoile_full.png\'>';
$etoile_null = '<img src=\'image/etoile_null.png\'>';
$etoile_demi = '<img src=\'image/etoile_demi.png\'>';

/*-------------------------------------------------- variables filtres ( si vient de avis.php )----------------------------------------------------------*/

$nbr_sem = '';
$etoile_a = '';
$salaire_a = '';

if (isset($_GET['etoile'])) {
	$etoile_a = '&etoile='.$_GET['etoile'];
}

for ($i=1; $i < 6; $i++) { 

	if (isset($_GET['check'.$i])) {
		$nbr_sem .= 'check'.$i.'='.$_GET['check'.$i].'&';	
	}
}

if (isset($_GET['amountRange'])) {
	$salaire_a = '&amountRange='.$_GET['amountRange'];
}

/*-------------------------------------------------- requete ----------------------------------------------------------*/

$requete =
'SELECT  a.fk_domaine domaine, a.titre titre,  a.fk_localisation fk_localisation,  a.salaire salaire, a.duree duree, a.avis avis, a.date_depot date_depot, a.adresse adresse, a.note_accessibilite note_accessibilite, a.note_accueil note_accueil, a.note_encadrement note_encadrement, a.note_interet note_interet, a.fk_mail fk_mail, e.nom nom, e.logo logo
FROM avis a
INNER JOIN entreprises e
ON a.fk_num_siret = e.num_siret
WHERE a.id_stage = '.$id_stage;

$reponse1 = $bdd->query($requete);

while ($donnees = $reponse1->fetch()) {

	$domaine = $donnees['domaine'];

	$titre = $donnees['titre'];

	$fk_localisation = $donnees['fk_localisation'];

	$salaire = $donnees['salaire'];

	$duree = $donnees['duree'];

	$avis = $donnees['avis'];

	$date = $donnees['date_depot'];
	$date = str_replace('-','/',$date);

	$adresse = $donnees['adresse'];

	$note_accessibilite = $donnees['note_accessibilite'];

	$note_accueil = $donnees['note_accueil'];

	$note_encadrement = $donnees['note_encadrement'];

	$note_interet = $donnees['note_interet'];

	$nom = $donnees['nom'];

	$logo = $donnees['logo'];

	$fk_mail = $donnees['fk_mail'];
}

$reponse1->closeCursor();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<title></title>
    <meta charset="UTF-8" >
    <link  href="avis_detail.css" rel="stylesheet">
</head>
	
<body>

 	<?php
			include("header.php");
	?>
 	<aside>
 	<?php 

 	if (isset($_GET['page']) == NULL) {
 		echo '<a href=\'avis.php?'.$nbr_sem.$etoile_a.$salaire_a.'\'>

 		<img src=\'image/retour2.png\'>Résultats précedents</a>

 		<p>'.sup_num_location ($_SESSION['Localisation']).'<img src=\'image/index_2.png\'>'.$_SESSION['domaine'].'<img src=\'image/index_2.png\'>'.$nom.'</p>';

 	}

 	?>

 	</aside>
 	<div id="leftside">
 	</div>
 	<div id="rightside">
 	</div>
 	<section>

 		<div id="detail_left">

 			<?php echo '<img src=\'image/'.$logo.'\'>'.$adresse ?> 
 		</div>
 		<div id="detail_right">
 			<h1><?php echo $titre ?></h1>
 			<h2><?php echo $nom ?></h2>
 			<p><?php echo $date ?></p>
 			<div id="info_detail">
 				<div><img src="image/piece.png"><?php echo $salaire.' €'; ?></div>
 				<div><img src="image/logo_domaine_black.png"><?php echo $domaine ?></div>		
 				<div><img src="image/calendrier.png"><?php echo $duree.' semaines'; ?></div>
 				<div><img src="image/logo_localisation_black.png"><?php echo $fk_localisation ?></div>
 			</div>

 			<div id="etoile_detail">
 				<div id="details_interet">
 					<div class="avis_stage_etoile"><?php echo convertisseur_note_etoile($note_interet*4); ?></div>Interêt
 				</div>
 				<div id="details_ambiance">
 					<div class="avis_stage_etoile"><?php echo convertisseur_note_etoile($note_accueil*4); ?></div>Ambiance
 				</div>
 				<div id="details_accessibilite">
 					<div class="avis_stage_etoile"><?php echo convertisseur_note_etoile($note_accessibilite*4); ?></div>Localisation
 				</div>
 				<div id="details_encadrement">
 					<div class="avis_stage_etoile"><?php echo convertisseur_note_etoile($note_encadrement*4); ?></div>Encadrement
 				</div>
 				
 			</div>
 			<p>
 				<img src="image/guillemet_inv.png">

 				<?php echo htmlentities($avis) ?> 

 				<img src="image/guillemet.png">
 			</p>
 			<a href=<?php echo 'mailto:'.$fk_mail; ?>><img src="image/enveloppe.png">Contacter pour plus d'info</a>
 		</div>
 		
 	</section>
 	<?php
			include("footer.php");
	?>
 

</body>
</html>