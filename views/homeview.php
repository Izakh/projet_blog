
<!DOCTYPE html>
<html>
	<head>
		<title>Accueil</title>
	</head>
	<body>
		<?php require 'page_elements/header.php';?>
		
		<h1>Accueil</h1>

		<?php 
		echo$content;
		require 'page_elements/footer.php';
      	if(intval($_GET['page'])>0){
        echo '<a href="router.php?action=listposts&page='.(intval($_GET['page'])-4).'">Page précédente</a>';
        }
		?>
		
		<a href="router.php?action=listposts&page=<?=intval($_GET['page'])+4?>">Page suivante</a>
	</body>
</html>
