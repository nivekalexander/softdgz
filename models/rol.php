<?php

	class Rol
	{
		private $pdo;

		public function __Construct(){
            try  				 {	$this->pdo=Database::Conectar(); }
            catch (Exception $e) {	die($e->getMessage());			 }
		}

		public function Select(){
            try  {
                $sql=$this->pdo->prepare("SELECT * FROM tbl_rol ORDER BY id DESC");
                $sql->execute();
                return $sql->fetchALL(PDO::FETCH_OBJ);
            }
            catch (Exception $e) {	die($e->getMessage());			 }
		}


		public function Insert(Rol $data){
		
            try  {
                $sql="INSERT INTO tbl_rol (nombre)
                                    VALUES(?)";
                $this->pdo->prepare($sql)
                    ->execute(
                        array(
                            $data->nombre
                        )
                    );
                    }
            catch (Exception $e) {	die($e->getMessage());			 }
		}

        public function Update(Rol $data){

            try   {

                $sql= "UPDATE tbl_rol SET nombre=? WHERE id=?;";
                $this->pdo->prepare($sql)
					->execute(
						array(
							$data->nombre,
							$data->id
						)
					); 
            }catch (Exception $e) {
                die($e->getMessage());
            
            }
        }

		public function Delete($id){
			try {
				$sql="DELETE FROM tbl_rol WHERE id=?";
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