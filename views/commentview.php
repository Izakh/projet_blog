<!DOCTYPE html>
<html>
	<head>
		<title>Commentaires</title>
	</head>
	<body>
		<?php require 'page_elements/header.php';?>

		<h1>Commentaires</h1>

		<?php echo $content; ?>

		<form method="post" id="commentForm"action="router.php?action=addcomment&postId=<?=$_GET['postId']?>">
		<textarea name="content" form="commentForm"></textarea>
		<input type="hidden" name="postId" value="<?=$_GET['postId']?>">
		<input type="hidden" name="author" value="<?=$_SESSION['user']?>">
		<input type="submit" value="Envoyer">
		</form>
		<?php require 'page_elements/footer.php';?>
	</body>
</html>