<?php if(isset($_SESSION['email'])) {
	$registered = 1;
}
else {
	$registered = 0;
} ?>
<header>
	<div id="header_logo">
		<img src="../search_opinion/image/Logo_Polytech_5.png">
	</div>

	<div id="header_contact"><a href="">Contact<img src="../search_opinion/image/index.png"></a></div>
	
	<div id="header_Compte">
		<?php if($registered == 1) {
			echo '<a href="../search_opinion/compte.php">Compte<img src="../search_opinion/image/index.png"></a>';
		}
		else {
			echo '<a href="../search_opinion/page_create_account.php">Inscription<img src="../search_opinion/image/index.png"></a>';
		} ?>
	</div>

	<div id="header_Connexion">
		<a href="../search_opinion/page_connexion.php">Connexion<img src="../search_opinion/image/index.png"></a>
	</div>

	<div id="header_Publier">
		<?php if($registered == 1) {
			echo '<a href="../send_opinion/depot_avis.php"><img src="../search_opinion/image/+_1.png"> Publier</a>';
		}
		else {
			echo '<a href="../search_opinion/page_create_account.php"><img src="../search_opinion/image/+_1.png"> Publier</a>';
		} ?>
	</div>
</header>