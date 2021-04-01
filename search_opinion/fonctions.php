<?php 

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
			$note_etoile .= $etoile_demi;
		}

		if ($note >= 8) {
			$note -= 8;
			$note_etoile .= $etoile_full;
		}
	}

	return $note_etoile;
} 


function maj_filtre ($localisation,$domaine) {
	if ($localisation != 'a.fk_localisation') {
		$localisation = '\''.$localisation.'\'';
	}
	
	$bdd = new PDO('mysql:host=localhost;port=3306;dbname=site_polytech;charset=utf8', 'root', '');
	$reponse = $bdd->query('SELECT a.salaire salaire FROM avis a WHERE a.fk_localisation = '.$localisation.' AND a.fk_domaine = \''.$domaine.'\'');
	$note = array();
    while ($donnees = $reponse->fetch()) {
    	$note[] = $donnees['salaire'];
    }
    $minmax =array(min($note),max($note));

    $reponse->closeCursor(); 
    return ($minmax);
}


function sup_num_location ($location) {

	if (ctype_digit($location[2])) {
		return(substr($location, 6, 100));
	}

	elseif (ctype_digit($location[1])) {
		return(substr($location, 5, 100));	
	}

	else {
		return($location);
	}
}


function db_localisation () {
	$bdd = new PDO('mysql:host=localhost;port=3306;dbname=site_polytech;charset=utf8', 'root', '');
	$reponse = $bdd->query('SELECT DISTINCT fk_localisation FROM avis');
	$pattern = '';
    while ($donnees = $reponse->fetch()) {
    	$localisation = $donnees['fk_localisation'];
    	$pattern .= $localisation.'|';
    }

    $pattern .= 'Toute localisation';

    $reponse->closeCursor(); 
    
    return ($pattern);
}


?>