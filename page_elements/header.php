<header>
	<nav>
		<?php//affichage de la barre de navigation 
		echo '<a href="router.php?action=listposts&page=0"> Accueil </a>';
		if(!isset($_SESSION['user'])){
			echo "<a href='router.php?action=register'> S'inscrire </a>
			<a href='router.php?action=login'> Se connecter </a>";
		}elseif(isset($_SESSION['user'])){
			echo "<a href='router.php?action=logout'> Se déconnecter </a>";
			if($_SESSION['isAdmin']===1){
				echo "<a href='router.php?action=post'> Poster </a><a href='router.php?action=manageusers'>Gerer les utilisateurs </a><a href='router.php?action=listreported'> Commentaires signalés </a>";
			}
		}
		?>
	</nav>
</header>