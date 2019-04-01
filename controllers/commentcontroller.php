<?php  
	function listComments($reponse,$postId){//lister les commentaires correspondant au post dont l'id est passé en parametre($postId)
		$content="";
		while ($data=$reponse->fetch()){
			if($data['postId']===$postId){
				$content.= '<p>'.htmlspecialchars($data['author']).': '.htmlspecialchars($data['content'])."</p><a class='report' href='router.php?action=report&prevId=".$data['postId']."&id=".$data['id']."&author=".htmlspecialchars($data['author'])."&content=".htmlspecialchars($data['content'])."&postId=".$data['postId']."'>Signaler</a><br>";
			}
		}
		require'views/commentview.php';
		
	}
	function addComment(){//commenter, les variables sont récupérées dans $_POST
		$commentModel = new Model('comments',array(0=>'author',1=>'content',2=>'postId',3=>'date'));
		$commentModel->connect('db777865927');
		if(isset($_POST['content'],$_POST['postId'],$_POST['author'])){
			$commentModel->write();
			header('Location: router.php?action=listcomments&postId='.$_POST['postId']);
		}
	}
	function listReported($reponse){//lister les commentaires signalés 
		$content="<br>";
		while ($data=$reponse->fetch()){
			$content.= '<p> Commentaire de '.htmlspecialchars($data['author']).':<br>'.htmlspecialchars($data['content'])."</p>"."<a href='router.php?action=delete&table=reported&id=".$data['id']."&postId=".$data['postId']."'>Supprimer</a><br>";
		}
		require "views/reportedview.php";
	}
?>