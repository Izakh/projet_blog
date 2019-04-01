<?php  
	class Model{
		private $bdd;//base de données avec la quelle interagir
		private $req;//requete mySQL
		private $table;//les nom de la table à la quelle le modele correspond
		private $columns;//les colonnes qui composent la table
		
		public function __construct($t,$c){//la table est une string, les colonnes sont une array
			$this->table = $t;
			$this->columns = $c;
		}
		function connect($database){//connection à la base de donnée
			try{
				$this->bdd = new PDO('mysql:host=db777865927.hosting-data.io;dbname='.$database, 'dbo777865927','Remz4.remz4', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
			}catch (Exception $e){
			    die('Erreur : ' . $e->getMessage());
			}
		}
		function read(){//lire toutes les colonnes de la table en question, le tri sera fait par le controlleur
			$req = $this->bdd->query('SELECT * FROM '.$this->table);
			return $req;
		}
		function readLimited($page){//meme chose que read(), mais n'affiche que les 4 premiers resultats
			$req = $this->bdd->query('SELECT * FROM '.$this->table.' LIMIT '.$page.',4');
			return $req;
		}
		function write(){//écriture dans une table, les variables sont récupérées à partir de $_POST
			$vals =array();
			$cols=array();
			foreach ($this->columns as $value) {
				if(isset($_POST[$value])){
					$vals[$value]=$_POST[$value];
				}elseif($value=='date'){
					$vals[$value]=date('Y-m-d H:i:s');
				}
			}
			$vals = implode("','",$vals);
			$cols = implode(",",$this->columns);
			unset($value);
			$req = $this->bdd->exec("INSERT INTO ".$this->table."(".$cols.") VALUES('".$vals."')");
		}
		function delete($id){//supprimer un élément à partir de son id
			$sql ='DELETE FROM '.$this->table.' WHERE id='.$id;
			$query = $this->bdd->exec($sql);
		}
		function update($id,$oldCol,$newCol){//modifier un post (titre et/ou contenu)
			$sql = "UPDATE ".$this->table." SET ".$oldCol ."='".$newCol."' WHERE id=".$id;
			$req = $this->bdd->exec($sql);
		}
	}
 ?>