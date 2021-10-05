<?php

	class Nomina
	{
		private $pdo;

		public function __Construct(){
		try  				 {	$this->pdo=Database::Conectar(); }
		catch (Exception $e) {	die($e->getMessage());			 }
		}

		public function Select(){
	    try  {
			$sql=$this->pdo->prepare("SELECT * FROM tbl_nomina ORDER BY id DESC");
			$sql->execute();
			return $sql->fetchALL(PDO::FETCH_OBJ);
		}
		catch (Exception $e) {	die($e->getMessage());			 }
		}


		public function Insert(Nomina $data){
		
		try  {
			$sql="INSERT INTO tbl_nomina (idUsuario,totalProducido,fecha,totalDeducido,idLogAcciones)
								VALUES(?,?,?,?,?)";
			$this->pdo->prepare($sql)
				->execute(
					array(
					$data->idUsuario,
					$data->totalProducido,
					$data->fecha,
					$data->totalDeducido,
					$data->idLogAcciones
					)
				);
				}
		catch (Exception $e) {	die($e->getMessage());			 }
		}

        public function Update(Nomina $data){

            try   {

                $sql= "UPDATE tbl_nomina SET idUsuario=?,totalProducido=?,fecha=?,totalDeducido=?,idLogAcciones=? WHERE id=?;";
                $this->pdo->prepare($sql)
					->execute(
						array(
							$data->idUsuario,
							$data->totalProducido,
							$data->fecha,
							$data->totalDeducido,
							$data->idLogAcciones,
							$data->id
						)
					); 
            }catch (Exception $e) {
                die($e->getMessage());
            
            }
        }

		public function Delete(Nomina $data){
			try {
				$sql="UPDATE tbl_nomina SET eliminadoPor=?,eliminadoDateTime=? WHERE id=?;";
				$this->pdo->prepare($sql)
					->execute(
						array(
						$data->eliminadoPor,
						$data->eliminadoDateTime,
						$id
						)
					);
				}
			catch (Exception $e) {	die($e->getMessage());			 }
			}



	}
?>