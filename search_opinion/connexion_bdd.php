<?php
try {
	$bdd = new PDO('mysql:host=localhost;port=3308;dbname=bdsite;charset=utf8', 'root', ''array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}

catch(Exception $e) {
	die('Erreur : '.$e->getMessage());
} ?>