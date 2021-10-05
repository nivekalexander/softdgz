<?php


class Usuario
{
	private $pdo;


	public function __construct(){
		try  				 {	$this->pdo=Database::Conectar(); }
		catch (Exception $e) {	die($e->getMessage());			 }
	}

	public function Select($rol){
		try  {
			$sql=$this->pdo->prepare("SELECT * FROM tbl_usuario 
				
				INNER JOIN tbl_rol 
				INNER JOIN tbl_sexo 
				WHERE tbl_usuario.idRol = ?
				AND tbl_usuario.idSexo = tbl_sexo.id
				ORDER BY tbl_usuario.id DESC");
				$sql->execute(array($rol));
			return $sql->fetchALL(PDO::FETCH_OBJ);
			}
		catch (Exception $e) {	die($e->getMessage());			 }
	}




	public function Insert(Usuario $data)	{

		try  {
			$sql="INSERT INTO tbl_usuario(user,nombre,password,direccion,idRol,fechaNacimento,observacion,seccion,idSexo,telefono,edad)
									VALUES(?,?,?,?,?,?,?,?,?,?,?)";
				
			$this->pdo->prepare($sql)
			->execute(
				array(
					$data->user,
					$data->nombre,
					md5($data->password),
					$data->direccion,
					$data->idRol,
					$data->fechaNacimiento,
					$data->observacion,
					$data->seccion,
					$data->idSexo,
					$data->telefono,
					$data->edad
				)
			);
			}
		catch (PDOException $e) {	
			$usuExist = $e->getCode();
			if($usuExist == 23000){
				echo json_encode( "El usuario ya existe");
			}else{
				die($e->getMessage());
			}											
		}
	}

    public function Update(Usuario $data){

		try  				 {
			$sql="UPDATE tbl_usuario SET user=?,nombre=?,password=?,direccion=?,idRol=?,fechaNacimento=?,observacion=?,seccion=?,idSexo=?,telefono=?,edad=? WHERE id = ?";
			$this->pdo->prepare($sql)
			->execute(
				array(
				$data->user,
				$data->nombre,
				md5($data->password),
				$data->direccion,
				$data->idRol,
				$data->fechaNacimiento,
				$data->observacion,
				$data->seccion,
				$data->idSexo,
				$data->telefono,
				$data->edad,
				$data->id
				)
			);
		}
		catch (Exception $e) {	die($e->getMessage());			 }
		}

	public function Delete($id){

		try {
			$sql="DELETE FROM tbl_usuario WHERE id=?";
			$this->pdo->prepare($sql)
			->execute(
				array(
					$id
				)	
			);
		}
		catch (Exception $e) {	die($e->getMessage());			 }
	}
	public function Get($id){
	
		try {
			$sql=$this->pdo->prepare("SELECT * FROM tbl_usuarioWHERE tbl_usuario.id = ?");
			$sql->execute(array($id));
			
			echo json_encode($sql->fetchALL(PDO::FETCH_OBJ));
									
									
		}
		catch (Exception $e) {	die($e->getMessage());			 }
	}
								

	public function Login($user,$pass){

		try { 
								
			$datos= new Usuario;

			$sql=$this->pdo->prepare("SELECT 
			tbl_usuario.nombre, tbl_usuario.password, tbl_usuario.idRol, tbl_usuario.id
			FROM tbl_usuario
			WHERE tbl_usuario.user = ? 
			AND tbl_usuario.password = ?;");

			if($sql->execute(array($user,$pass))){

				$result =$sql->fetch(PDO::FETCH_ASSOC);
				$datos->name=$result['nombre'];
				$datos->passw=$result['password'];
				$datos->rol=$result['idRol'];
				$datos->userId=$result['id'];
				//Login
				$sql2=$this->pdo->prepare("INSERT INTO tbl_login 
				(idUsuario,userName) 
				values (?,?);"); 	
				if($sql2->execute(array($datos->userId,$user))){	
					$result2 =$sql2->fetch(PDO::FETCH_ASSOC);
						$datos->login="SI";
				}else{
						$datos->login="NO";
				}
			}
			
			return $datos;
			}

		catch (Exception $e) { }
	}

	public function Logout($id){
                                   
		try{ 
			$sql=$this->pdo->prepare("DELETE FROM tbl_login WHERE idUsuario = ?;");
			$sql->execute(array($id));
		}

		catch (Exception $e) { die($e->getMessage());			}
	}



 	public function UpdatePassPerfil(Usuario $datos){

		try {
			$sql="UPDATE tbl_usuario SET password = ?  WHERE id = ?";
			$this->pdo->prepare($sql)
			->execute(
				array(
					md5($data->password),
					$data->id
				)
			);
		}
		catch (Exception $e) {	die($e->getMessage());			 }
	}
}


?>