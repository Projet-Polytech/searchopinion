<?php  if(isset($_SESSION['email'])) {
	$registered = 1;
}
else {
	$registered = 0;
} ?>
<header>
	<div id="header_logo">
		<a href="http://www1.polytech-reseau.org/accueil/">
			<img src="../search_opinion/image/logo_polytech_5.png">
		</a>
	</div>

	<div id="header_contact">
		<a href="#footer">Contact<img src="../search_opinion/image/index.png"></a>
	</div>

	<div id="header_accueil">
		<a href="../search_opinion/accueil.php">Accueil<img src="../search_opinion/image/index.png"></a>
	</div>

	<div id="header_Publier">
		<?php if($registered == 1) {
			echo '<a href="../send_opinion/depot_avis.php"><img src="../search_opinion/image/+_1.png"> Publier</a>';
		}
		else {
			echo '<a href="../search_opinion/page_create_account.php"><img src="../search_opinion/image/+_1.png"> Publier</a>';
		} ?>
	</div>

	<div id="header_Connexion">
		<?php if($registered == 1) {
			echo '<a href="../search_opinion/deconnexion.php">Déconnexion<img src="../search_opinion/image/index.png"></a>';
		}
		else {
			echo '<a href="../search_opinion/page_connexion.php">Connexion<img src="../search_opinion/image/index.png"></a>';
		} ?>
	</div>

	<div id="header_Compte">
		<?php if($registered == 1) {
			echo '<a href="../search_opinion/compte.php">Compte<img src="../search_opinion/image/index.png"></a>';
		}
		else {
			echo '<a href="../search_opinion/page_create_account.php">Inscription<img src="../search_opinion/image/index.png"></a>';
		} ?>
	</div>
	
</header>
