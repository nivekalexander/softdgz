<?php

	class Proveedor
	{
		private $pdo;

		public function __Construct(){
            try  				 {	$this->pdo=Database::Conectar(); }
            catch (Exception $e) {	die($e->getMessage());			 }
		}

		public function Select(){
            try  {
                $sql=$this->pdo->prepare("SELECT * FROM tbl_proveedor ORDER BY id DESC");
                $sql->execute();
                return $sql->fetchALL(PDO::FETCH_OBJ);
            }
            catch (Exception $e) {	die($e->getMessage());			 }
		}


		public function Insert(Proveedor $data){
		
            try  {
                $sql="INSERT INTO tbl_proveedor (nombre,direccion,telefono,saldo,observacion)
                                    VALUES(?,?,?,?,?)";
                $this->pdo->prepare($sql)
                    ->execute(
                        array(
                            $data->nombre,
                            $data->direccion,
                            $data->telefono,
                            $data->saldo,
                            $data->observacion
                        )
                    );
                }
            catch (Exception $e) {	die($e->getMessage());			 }
		}

        public function Update(Proveedor $data){

            try   {

                $sql= "UPDATE tbl_proveedor SET nombre=?,direccion=?,telefono=?,saldo=?,observacion=? WHERE id=?;";
                $this->pdo->prepare($sql)
					->execute(
						array(
							$data->nombre,
                            $data->direccion,
                            $data->telefono,
                            $data->saldo,
                            $data->observacion,
                            $data->id
						)
					); 
            }catch (Exception $e) {
                die($e->getMessage());
            
            }
        }

		public function Delete($id){
			try {
				$sql="DELETE FROM tbl_proveedor WHERE id=?;";
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