<!DOCTYPE html>
<html>
	<head>
		<title></title>
	</head>
	<body>
		<?php require 'page_elements/header.php';?>
		<h2> Se connecter</h2>
		<form method="post" action="router.php?action=login">
		<p>Nom:</p>
		<label for="name"></label>
		<input type="text" name="name" id="name" pattern="[a-zA-Z0-9]{0,255}" required/>
		<p>Mot de passe:</p>
		<label for="password"></label>
		<input type="password" name="password" id="password" required/>
		<br>
		<input type="submit" value="Envoyer" />
		</form>
		<?php require 'page_elements/footer.php';  ?>
	</body>
</html>