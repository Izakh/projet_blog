<?php
	function login($reponse){//connection d'un utilisateur, le mot de passe est haché par sécurité
		if(isset($_POST['name'],$_POST['password'])){
			while ($data=$reponse->fetch()){
				$testPassword=password_verify($_POST['password'],$data['password']);//comparaison des hash du mdp fourni et de celui stocké
				if($_POST['name']==$data['name']&&$testPassword){
					$_SESSION['user']=$data['name'];
					if($data['isAdmin']==1){
						$_SESSION['isAdmin']=1;
					}else{
						$_SESSION['isAdmin']=0;
					}
					header('Location:router.php');
				}
			}
			if(!password_verify($_POST['password'],$data['password'])){
				echo "Identifiant ou mot de passe erroné";
			}
		}
		require 'views/loginview.php';
	}
	function logout(){//déconnexion (les variables stockées dans $_SESSION sont purgées)
		session_destroy();
		header('Location:router.php');
	}
	function listUsers($reponse){//lister les utilisateurs
		$content="";
		while ($data=$reponse->fetch()){
			if($data['isAdmin']==0){
				$content.= '<p>Nom:'.htmlspecialchars($data['name']).'<br> <a href="index.php?action=delete&id='.$data['id'].'&table=users&redir=manageUsers">Supprimer</a></p><br>';
			}
		}	
		require "views/userview.php";
	}
	function register(){//Enregistrer un nouvel utilisateur
		$userModel = new Model('users',array(0=>'isAdmin',1=>'name',2=>'password'));
		$userModel->connect('db777865927');
		require "views/registerview.php";
		if(isset($_POST['name'])&&isset($_POST['password'])&&isset($_POST['isAdmin'])){
			$_POST['password']=password_hash($_POST['password'], PASSWORD_DEFAULT);
			$userModel->write();
			unset($_POST);
			header('Location:router.php');
		}
	}
?>