
<!DOCTYPE html>
<html>
	<head>
		<title></title>
	</head>
	<body>
		<?php 
			require 'page_elements/header.php';
		?>
		<form method="post" id="updateForm" action="router.php?action=update&id=<?php echo $_GET['id']?>">
		<p>Nouveau Titre:</p>
		<label for="newTitle"></label>
		<input type="text" name="newTitle" id="newTitle" pattern="[a-zA-Z0-9\s]{0,255}"/><br>
		<p>Nouveau Contenu:</p>
		<textarea name="newContent" form="updateForm"></textarea>
		<input type="submit" value="Envoyer" />
		</form>
		<?php require 'page_elements/footer.php';?>
	</body>

</html>