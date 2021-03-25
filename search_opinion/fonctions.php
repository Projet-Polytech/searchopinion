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

		if ($note >= 8) {
			$note -= 8;
			$note_etoile .= $etoile_full;
		}
	}

	return $note_etoile;
}


function maj_filtre () {
	$bdd = new PDO('mysql:host=localhost;port=3306;dbname=site_polytech;charset=utf8', 'root', '');
	$reponse = $bdd->query('SELECT salaire FROM avis');
	$note = array();
    while ($donnees = $reponse->fetch()) {
    	$note[] = $donnees['salaire'];
    }
    $minmax =array(min($note),max($note));
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

?>