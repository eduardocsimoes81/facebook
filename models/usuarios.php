<?php 
	class Usuarios extends model{

		public function verificarLogin(){

			if(!isset($_SESSION['lgsocial']) || (isset($_SESSION['lgsocial']) && empty($_SESSION['lgsocial']))){
				header("Location: ".BASE_URL."login");
			}

			if(isset($_SESSION['lgsocial']) && !empty($_SESSION['lgsocial'])){
				return true;
			}else{
				return false;
			}
		}

		public function logar($email, $senha){

			$sql = "SELECT * FROM usuarios WHERE email = :email AND senha = :senha";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':email', $email);
			$sql->bindValue(':senha', MD5($senha));
			$sql->execute();

			if ($sql->rowCount() > 0) {
				$sql = $sql->fetch();

				$_SESSION['lgsocial'] = $sql['id'];

				header("Location: ".BASE_URL);
				exit;
			}else{
				return "E-mail e/ou senha inválidos!";
			}
		}

		public function cadastrar($nome, $email, $sexo, $senha){

			$sql = "SELECT * FROM usuarios WHERE email = :email";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":email", $email);
			$sql->execute();

			if($sql->rowCount() == 0){
				$sql = "INSERT INTO usuarios SET nome = :nome, email = :email, sexo = :sexo, senha = :senha";
				$sql = $this->db->prepare($sql);
				$sql->bindValue(":email", $email);
				$sql->bindValue(":nome", $nome);
				$sql->bindValue(":sexo", $sexo);
				$sql->bindValue(":senha", md5($senha));
				$sql->execute();

				$id = $this->db->lastInsertId();
				$_SESSION['lgsocial'] = $id;

				header("Location: ".BASE_URL);
			}else{
				return "E-mail já está cadastrado!";
			}
		}

		public function getNome($id){
			$sql = "SELECT nome FROM usuarios WHERE id = :id";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':id', $id);
			$sql->execute();

			if($sql->rowCount() > 0) {
				$sql = $sql->fetch();

				return $sql['nome'];
			}else{
				return '';
			}
		}

		public function getDados($id){

			$array = array();

			$sql = "SELECT * FROM usuarios WHERE id = :id";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":id", $id);
			$sql->execute();

			if($sql->rowCount() > 0){
				$array = $sql->fetch();
			}

			return $array;
		}

		public function updatePerfil($array){

			$campos = array();

			if(count($array) > 0){
				$sql = "UPDATE usuarios SET ";
				foreach($array as $campo => $valor){
					$campos[] .= $campo." = '".$valor."'";
				}

				$sql .= implode(', ', $campos);
				$sql .= " WHERE id = '".($_SESSION['lgsocial'])."'";

				$sql = $this->db->prepare($sql);
				$sql->execute();

			}
		}

		public function getSugestoes($limit = 5){

			$array = array();
			$meuId = $_SESSION['lgsocial'];

			$r = new Relacionamentos();
			$ids = $r->getIdsFriends($meuId);

			if(count($ids) == 0){
				$ids[] = $meuId;
			}

			$sql = "SELECT usuarios.id,
						   usuarios.nome
					  FROM usuarios
					 WHERE usuarios.id != :meuId
					   AND usuarios.id NOT IN (".implode(',', $ids).")
				 	 ORDER BY RAND()
					 LIMIT $limit";

			$sql = $this->db->prepare($sql);
			$sql->bindValue(":meuId", $meuId);
			//$sql->bindValue(":limite", 2);
			$sql->execute();
			
			if($sql->rowCount() > 0){
				$array = $sql->fetchAll();
			}
			
			return $array;
		}

		public function procurar($q){

			$array = array();

			$q = addslashes($q);

			$sql = "SELECT * FROM usuarios WHERE nome LIKE '%".$q."%'";
			$sql = $this->db->prepare($sql);

			$sql->execute();

			if($sql->rowCount()){

				$array = $sql->fetchAll();
			}

			return $array;
		}
	}
 ?>