<?php 

include("connexion_bdd.php");
include("fonctions.php");

session_start();

$_SESSION['page'] = 1;

?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<title></title>
    <meta charset="UTF-8" >
    <link  href="accueil.css" rel="stylesheet">
</head>

<body>
	
	<div id="accueil">

		<?php
			include("header.php");
		?>

		<div id="fond_accueil">

			<h1>Stages & avis</h1>

			<h2>Rechercher les stages selon des critères<br>Et selon d'autres critères</h2>
			
			<form action="avis.php" method="get">

				<div class="recherche">
					<h3>Localisation<img src="image/logo_localisation_2.png"></h3>
					<p>Parmi les avis existants</p>

					<input list="Localisation" type="text" placeholder="ex : Paris" name="Localisation" id="localisation" required pattern=<?php echo '\''.db_localisation().'\''?>>
						<datalist id="Localisation">
							<option value="Toute localisation">
						  	<?php 

						  	$requete_localisation = $bdd->query('SELECT DISTINCT fk_localisation FROM avis');
						  	$distinct_localisation = [];

							while($lieu = $requete_localisation->fetch()) {
								echo '<option value="'.$lieu['fk_localisation'].'">';
								array_push($distinct_localisation, $lieu['fk_localisation']);
							}

							$requete_localisation->closeCursor(); 

							?>

						</datalist>
				</div>

				<div class="recherche">
					<h3>Domaine<img src="image/logo_domaine.png"></h3>
					
					<select name="domaine" id="domaine">

						
					<?php 

					$requete_filiere = $bdd->query('SELECT DISTINCT fk_localisation, fk_domaine FROM avis');
					$domaines = $requete_filiere->fetchAll();
					$requete_filiere->closeCursor();

					?>

					</select>
				
				</div>
					
				<div id="recherche_button">
					<input type="submit" name="" value="" >
				</div>
					
			</form>
			
		</div>
	</div>
	<!-- Javascript part to adapt the domain the user can choose depending on the localisation he selected -->
	<script type="text/javascript">
		const localisation = document.getElementById("localisation");
		let domaines = <?php echo json_encode($domaines) ?>;
		let distinct_domain = [];
		const distinct_localisation = <?php echo json_encode($distinct_localisation) ?>;
		for(let i = 0; i < domaines.length; i++) {
			if(!distinct_domain.includes(domaines[i][1])) {
				let option = document.createElement('option');
				option.setAttribute('value', domaines[i][1]);
				option.setAttribute('id', domaines[i][1]);
				option.textContent = domaines[i][1];
				document.getElementById('domaine').appendChild(option);
				distinct_domain.push(domaines[i][1]);
			}
		}
		//console.log(distinct_domain);
		//remove the domain that are not linked to the chosen localisation in the database
		localisation.addEventListener('input', function() {
			if(localisation.value !== 'Toute localisation' && distinct_localisation.includes(localisation.value)) {
				good_ones = [];
				for(let i = 0; i < domaines.length; i++) {
					if((domaines[i][0] === localisation.value) && (!good_ones.includes(domaines[i][1]))) {
						good_ones.push(domaines[i][1]);
					}
				}
				for(let i = 0; i < distinct_domain.length; i++) {
					if(!good_ones.includes(distinct_domain[i])) {
						document.getElementById('domaine').removeChild(document.getElementById(distinct_domain[i]));
					}
				}
			}
		});
	</script>

	<aside>
		<h2>Retrouvez les stages les mieux notés<br>& vos dernières recherches</h2>
	</aside>

	<section>

		<div id="stage_populaire">
<?php /* --------------------------- sauvegarde 
			<a href="" class="accueil_stage">
				<div class="accueil_stage_logo"><img src="image/logo_accueil.webp"></div>
				<div class="accueil_stage_etoile"><img src="image/etoile_full.png"><img src="image/etoile_full.png"><img src="image/etoile_full.png"><img src="image/etoile_demi.png"><img src="image/etoile_null.png"></div>
				<div class="accueil_stage_info"><img src="image/logo_domaine_black.png">Informatique</div>
				<div class="accueil_stage_info"><img src="image/logo_localisation_black.png">Lyon</div>
				<h1>Tesla</h1>
				<p><img src="image/guillemet_inv.png">Encore un extrait du début de l'avis sur un autre stage pour test. Dans l'idéale on met là aussi 4-5 lignes pour donner envie de lire la suite ...<img src="image/guillemet.png"></p>
				<time>14/02/2020</time>
			</a>
*/ ?>

<?php 

$requete =

'SELECT  a.id_stage id_stage, a.fk_domaine domaine,  a.note_globale note_globale,  a.fk_localisation fk_localisation, a.avis avis, a.date_depot date_depot, e.nom nom, e.logo logo, d.abr_domaine abr_domaine
FROM avis a
INNER JOIN entreprises e
ON a.fk_num_siret = e.num_siret
INNER JOIN domaine d
ON a.fk_domaine = d.nom_domaine
ORDER BY note_globale DESC, note_interet DESC';

$reponse1 = $bdd->query($requete);

for ($i = 0; $i <= 4; $i++) {

	$donnees = $reponse1->fetch();

	$id_stage = $donnees['id_stage']; 

	$abr_domaine = $donnees['abr_domaine'];

	$note_globale = $donnees['note_globale'];

	$fk_localisation = $donnees['fk_localisation'];

	$avis = $donnees['avis'];

	$date = $donnees['date_depot'];
	$date = str_replace('-','/',$date);

	$nom = $donnees['nom'];

	$logo = $donnees['logo'];

	$fk_localisation = sup_num_location ($fk_localisation);

	if (strlen($fk_localisation) > 14 ) {
		$fk_localisation = substr($fk_localisation, 0, 12).'...';
	}

	echo
	'<a href=\'avis_detail.php?id_stage='.$id_stage.'&page=accueil\' class=\'accueil_stage\'>
		<div class=\'accueil_stage_logo\'><img src=\'image/'.$logo.'\'></div>
		<div class=\'accueil_stage_etoile\'>'.convertisseur_note_etoile($note_globale).'

		</div>
		<div class=\'accueil_stage_info\'><img src=\'image/logo_domaine_black.png\'>'.$abr_domaine.'</div>
		<div class="accueil_stage_info"><img src="image/logo_localisation_black.png">'.$fk_localisation.'</div>
		<h1>'.$nom.'</h1>
		<p><img src="image/guillemet_inv.png">'.htmlentities(substr($avis, 0,150)).' ...<img src="image/guillemet.png"></p>
		<time>'.$date.'</time>
	</a>';
}	

$reponse1->closeCursor(); 	

			?>
			
		</div>
			
		<div id="stage_visite">
			<div class="accueil_stage" id="stage_info">
				<h2>Vos dernières recherches grâce aux cookies <br>( Bientôt disponible )</h2>
				<img src="image/arrow.png">
			</div>
			<a href="" class="accueil_stage"></a>
			<a href="" class="accueil_stage"></a>
			<a href="" class="accueil_stage"></a>
			<a href="" class="accueil_stage"></a>
		</div>
	</section>
	<?php
			include("footer.php");
	?>

</body>
</html>


			

