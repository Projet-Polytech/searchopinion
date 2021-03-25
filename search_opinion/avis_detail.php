<?php 

include("connexion_bdd.php"); 

$id_stage = $_GET['id_stage'];

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

$etoile_full = '<img src=\'image/etoile_full.png\'>';
$etoile_null = '<img src=\'image/etoile_null.png\'>';
$etoile_demi = '<img src=\'image/etoile_demi.png\'>';

/*-------------------------------------------------- variables ----------------------------------------------------------*/

$requete =
'SELECT  a.domaine domaine, a.titre titre,  a.fk_localisation fk_localisation,  a.salaire salaire, a.duree duree, a.avis avis, a.date_depot date_depot,      a.note_accessibilite note_accessibilite, a.note_accueil note_accueil, a.note_encadrement note_encadrement, a.note_interet note_interet, a.fk_mail fk_mail, e.nom nom
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

	$note_accessibilite = $donnees['note_accessibilite'];

	$note_accueil = $donnees['note_accueil'];

	$note_encadrement = $donnees['note_encadrement'];

	$note_interet = $donnees['note_interet'];

	$nom = $donnees['nom'];

	$fk_mail = $donnees['fk_mail'];
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<title></title>
    <meta charset="UTF-8" >
    <link  href="avis_detail.css" rel="stylesheet">
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
 	<aside>

 	<a href=""><img src="image/retour2.png">Résultats précedents</a>

 	<p>Italie<img src="image/index_2.png">Environement<img src="image/index_2.png">Nom du stage</p>

 	

 	</aside>
 	<div id="leftside">
 	</div>
 	<div id="rightside">
 	</div>
 	<section>

 		<div id="detail_left">
 			<img src="image/generale.png">
 			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9508.996379979799!2d-0.5406837830637089!3d44.8818036295758!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd5528dfc3af92df%3A0xb86c663b296b5f78!2zU29jacOpdMOpIEfDqW7DqXJhbGUgZGVzIEJvaXM!5e0!3m2!1sfr!2sfr!4v1613683502141!5m2!1sfr!2sfr"  frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
 		</div>
 		<div id="detail_right">
 			<h1><?php echo $titre ?></h1>
 			<p><?php echo $date ?></p>
 			<div id="info_detail">
 				<div><img src="image/logo_domaine_black.png"><?php echo $domaine ?></div>
 				<div><img src="image/logo_billet_2.png"><?php echo $salaire.' €'; ?></div>			
 				<div><img src="image/calendrier.png"><?php echo $duree.' semaines'; ?></div>
 				<div><img src="image/logo_localisation_black.png"><?php echo $fk_localisation ?></div>
 			</div>

 			<div id="etoile_detail">
 				<div id="details_interet">
 					<div class="avis_stage_etoile"><?php echo convertisseur_note_etoile($note_interet*4); ?></div>interet
 				</div>
 				<div id="details_ambiance">
 					<div class="avis_stage_etoile"><?php echo convertisseur_note_etoile($note_accueil*4); ?></div>ambiance
 				</div>
 				<div id="details_accessibilite">
 					<div class="avis_stage_etoile"><?php echo convertisseur_note_etoile($note_accessibilite*4); ?></div>accessiblité
 				</div>
 				<div id="details_encadrement">
 					<div class="avis_stage_etoile"><?php echo convertisseur_note_etoile($note_encadrement*4); ?></div>encadrement
 				</div>
 				
 			</div>
 			<p>
 				<img src="image/guillemet_inv.png">

 				<?php echo $avis ?> 

 				<img src="image/guillemet.png">
 			</p>
 			<a href=<?php echo 'mailto:'.$fk_mail; ?>><img src="image/enveloppe.png">Plus d'info</a>
 		</div>
 		
 	</section>
 	<footer></footer>
 

</body>
</html>