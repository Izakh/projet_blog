	<footer>	
	<div class="footer">
		<?php//le footer inclut les pages css et une barre fixe en bas de page identifiant l'utilisateur
			if(isset($_SESSION['user'])){
				echo '<br>Connecté en tant que '.htmlspecialchars($_SESSION['user']);
			}
		?>
	<link rel="stylesheet" type="text/css" href="style/bootStrap.css">
	<link rel="stylesheet" type="text/css" href="style/style.css">
	<link rel="stylesheet" type="text/css" href="style/largeStyle.css">
	</div>
</footer>
