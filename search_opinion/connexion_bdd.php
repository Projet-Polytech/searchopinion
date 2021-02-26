<?php
try {
	$bdd = new PDO('mysql:host=localhost;port=3306;dbname=bdsite;charset=utf8', 'root', '');
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}

catch(Exception $e) {
	die('Erreur : '.$e->getMessage());
} ?>