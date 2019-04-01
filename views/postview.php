<!DOCTYPE html>
<html>
	<head>
		<title></title>
	</head>
	<body>
		<?php require 'page_elements/header.php';?>
		<h1>Poster</h1>
		<form method="post" id="postForm" action="router.php?action=post">
		<label for="title">Titre:</label>
		<input type="text" name="title" id="title" pattern="[a-zA-Z0-9\s]{0,255}" required/><br>
		<textarea name="content" form="postForm"></textarea>
		<input type="submit" value="Envoyer" /></form>
		<?php require 'page_elements/footer.php';?>
	</body>
</html>