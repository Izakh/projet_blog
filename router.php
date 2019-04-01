<?php
	session_start();
	function load($class){/*Tout objet initialisé non reconnu sera passé en parametre a cette fonction pour essayer de la retrouver dans le
      dossier Classes*/
		require 'Classes/'.$class.'.php';
	}
	spl_autoload_register('load');
	//initialisation et connection des modèles à la BDD
	$commentModel = new Model('comments',array(0=>'author',1=>'content',2=>'postId',3=>'date'));
	$commentModel->connect('db777865927');

	$userModel = new Model('users',array(0=>'isAdmin',1=>'name',2=>'password'));
	$userModel->connect('db777865927');

	$reportedModel = new Model('reported',array(0=>'author',1=>'content',2=>'postId',3=>'date'));
	$reportedModel->connect('db777865927');

	$postModel = new Model('posts',array(0=>'content',1=>'date',2=>'title'));
	$postModel->connect('db777865927');

	if(isset($_GET['action'])){//Une action est passée dans l'url
		
		switch($_GET['action']){
			case"listposts"://Generer une liste des posts créés par l'auteur
              require 'controllers/postcontroller.php';
              $start = intval($_GET['page']);
              if(intval($_GET['page']) >= 0){
                listPosts($postModel->readLimited($start));
              }else{
                listPosts($postModel->readLimited(0));
              }
			break;
			case"listcomments"://Générer une liste de commentaires correspondant au post en question
				require 'controllers/commentcontroller.php';
				listComments($commentModel->read(),$_GET['postId']);
			break;
			case"addcomment"://Ajouter commentaire
				require 'controllers/commentcontroller.php';
				addComment();
			break;
			case"post"://ajouter post
				require "controllers/postcontroller.php";
				post();
			break;
			case"delete"://Supprimer composant (post,commentaire,utilisateur*sauf admin)
				if(isset($_SESSION['user'])&&$_SESSION['isAdmin']!=1){/*si l'utilisateur n'est pas l'administrateur il est renvoyé à
                  l'accueil*/
					header('Location: router.php');
				}
				if(isset($_GET['id'])&&isset($_GET['table'])){
					if($_GET['table']=='posts'){
						$postModel->delete($_GET['id']);
						header('Location: router.php?');
					}elseif($_GET['table']=='users'){
						$userModel->delete($_GET['id']);
						header('Location: router.php?action=manageusers');
					}elseif($_GET['table']=="reported"){
						$commentModel->delete($_GET['postId']);
						$reportedModel->delete($_GET['id']);
						header('Location: router.php?action=listreported');
                    }
                }
			break;
			case"update"://modification d'un post (titre et/ou contenu)
				require "controllers/postcontroller.php";
				update();
			break;
			case"register"://inscription d'un nouvel utilisateur
			require"controllers/usercontroller.php";
				register();
			break;
			case"login"://connection utilisateur
				require "controllers/usercontroller.php";
				login($userModel->read());
            	header("Location:router.php");
			break;
			case"logout"://déconnexion
				require "controllers/usercontroller.php";
				logout();
			break;
			case"manageusers"://affichage de la liste des utilisateurs
				if($_SESSION['isAdmin']!=1){
					header('Location: router.php');
				}
				require "controllers/usercontroller.php";
				listUsers($userModel->read());
			break;
			case"report"://signalement d'un commentaire
				if(isset($_GET['id'])&&isset($_GET['author'])&&isset($_GET['content'])){
					$duplicate=FALSE;
					$reported = $reportedModel->read();
					while($data = $reported->fetch()){//vérification que le commentaire n'est pas déja signalé
						if($_GET['id']==$data['postId']){
							$duplicate=TRUE;
						}
					}
					if(!$duplicate){
						$_POST['author']=$_GET['author'];
						$_POST['content']=$_GET['content'];
						$_POST['postId']=$_GET['id'];
						$reportedModel->write();
					}
					header('Location:router.php?action=listcomments&postId='.$_GET['prevId']);
				}
			break;
			case"listreported"://lister les commentaires signalés
			require "controllers/commentcontroller.php";
				listReported($reportedModel->read());
			break;
			default://si l'action passée n'est pas reconnue, afficher la page d'accueil
			require 'controllers/postcontroller.php';
			listPosts($postModel->readLimited(0));
	}	
	}else{//si aucune action n'est passée,  afficher la page d'accueil
     	header('Location:views/homeview.php');
	}
?>