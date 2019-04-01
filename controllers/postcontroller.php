<?php 
	function listPosts($reponse){//lister les posts
		$content="";	
		while ($data=$reponse->fetch()){
		 	$content.= '<h2>'.$data['title'].':</h2><p class="post">'.$data['content']."</p><p>".$data['date']."</p>";
		 	if(isset($_SESSION['user'])){
		 		$content.="<a href ='router.php?action=listcomments&postId=".$data['id']."'>Commenter </a>";
		 		if($_SESSION['isAdmin']==1){
		 			$content.= "<a href='router.php?action=delete&table=posts&id=".$data['id']."'>Supprimer </a>	<a href='router.php?action=update&id=".$data['id']."'>Modifier </a>";
		 		}
		 	}
		}
		require 'views/homeview.php';
	}
	function post(){//créer un nouveau post à partir des variables contenues dans $_POST
		$postModel = new Model('posts',array(0=>'content',1=>'date',2=>'title'));
		$postModel->connect('db777865927');
		if(isset($_POST['title'])&&isset($_POST['content'])&&$_SESSION['isAdmin']=1){
    		$postModel->write();
		}
		require "views/postview.php";
	}
	function update(){//modifier le titre et/ou le contenu d'un post
		require "views/updateview.php";
		$postModel = new Model('posts',array(0=>'content',1=>'date',2=>'title'));
			$postModel->connect('db777865927');
			if($_SESSION['isAdmin']!=1){
				header('Location: index.php');
			}
			if(isset($_GET['id'])&&isset($_POST['newContent'])&&isset($_POST['newTitle'])){
				if($_POST['newContent']!=""&&$_POST['newTitle']!=""){
					$postModel->update($_GET['id'],'content',$_POST['newContent']);
					$postModel->update($_GET['id'],'title',$_POST['newTitle']);
				}else if($_POST['newContent']!=""&&$_POST['newTitle']==""){
					$postModel->update($_GET['id'],'content',$_POST['newContent']);
				}else if($_POST['newContent']==""&&$_POST['newTitle']!=""){
					$postModel->update($_GET['id'],'title',$_POST['newTitle']);
				}
				header('Location:router.php?');	
			}
	}
?>

