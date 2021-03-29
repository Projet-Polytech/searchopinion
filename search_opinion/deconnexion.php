<?php

session_start();

$_SESSION = array();
session_unset();
session_destroy();


include("connexion_bdd.php");
include("fonctions.php");

/* -------------------------------------------------- variables session -------------------------------------------------- */


?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<title></title>
    <meta charset="UTF-8" >
    <link  href="deconnexion.css" rel="stylesheet">
</head>

<body>
	<?php include('header.php') ?>
	<section>
		<img src="image/deco3.png">
		<h1>Vous avez été déconnecté</h1>
	</section>
	<footer></footer>
</body>

</html>