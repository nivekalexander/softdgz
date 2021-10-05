<?php

	class Menu
	{
		private $pdo;

		public function __Construct(){
		try  				 {	$this->pdo=Database::Conectar(); }
		catch (Exception $e) {	die($e->getMessage());			 }
		}

		public function Select(){
	    try  {
			$sql=$this->pdo->prepare("SELECT tbl_menu.id,tbl_menu.nombre,tbl_menu.icon,tbl_menu_rol.idRol 
			FROM tbl_menu INNER JOIN tbl_menu_rol 
			WHERE tbl_menu.id=tbl_menu_rol.idMenu ORDER BY tbl_menu.id DESC");
			$sql->execute();
			return $sql->fetchALL(PDO::FETCH_OBJ);
		}
		catch (Exception $e) {	die($e->getMessage());			 }
		}


		public function InsertMenu(Menu $data){
		
		try  {
			$sql="INSERT INTO tbl_menu (nombre,icon)
								VALUES(?,?)";
			$this->pdo->prepare($sql)
				->execute(
					array(
					$data->nombre,
					$data->icon
					)
				);
				}
		catch (Exception $e) {	die($e->getMessage());			 }
		}
		public function InsertMenuRol(Menu $data){
		
			try  {
				$sql="INSERT INTO tbl_menu_rol (idMenu,idRol)
									VALUES(?,?)";
				$this->pdo->prepare($sql)
					->execute(
						array(
						$data->idMenu,
						$data->idRol
						)
					);
					}
			catch (Exception $e) {	die($e->getMessage());			 }
			}
        public function UpdateMenu(Menu $data){

            try   {

                $sql= "UPDATE tbl_menu SET nombre=?,icon=? WHERE id=?;";
                $this->pdo->prepare($sql)
					->execute(
						array(
							$data->nombre,
							$data->icon,
							$data->id
						)
					); 
            }catch (Exception $e) {
                die($e->getMessage());
            
            }
        }
		public function UpdateMenuRol(Menu $data){

            try   {

                $sql= "UPDATE tbl_menu_rol SET idMenu=?,idRol=? WHERE id=?;";
                $this->pdo->prepare($sql)
					->execute(
						array(
							$data->idMenu,
							$data->idRol,
							$data->id
						)
					); 
            }catch (Exception $e) {
                die($e->getMessage());
            
            }
        }
		public function Delete($id){
			try {
				$sql="DELETE FROM tbl_menu WHERE id=?;";
				$this->pdo->prepare($sql)
					->execute(
						array(
						$id
						)
					);
				}
			catch (Exception $e) {	die($e->getMessage());			 }
		}
		public function DeleteMenuRol($id){
			try {
				$sql="DELETE FROM tbl_menu_rol WHERE id=?;";
				$this->pdo->prepare($sql)
					->execute(
						array(
						$id
						)
					);
				}
			catch (Exception $e) {	die($e->getMessage());			 }
		}



	}
?>