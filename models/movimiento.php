<?php

	class Movimiento
	{
		private $pdo;

		public function __Construct(){
		try  				 {	$this->pdo=Database::Conectar(); }
		catch (Exception $e) {	die($e->getMessage());			 }
		}

		public function Select(){
	    try  {
			$sql=$this->pdo->prepare("SELECT * FROM tbl_movimiento ORDER BY id DESC");
			$sql->execute();
			return $sql->fetchALL(PDO::FETCH_OBJ);
		}
		catch (Exception $e) {	die($e->getMessage());			 }
		}


		public function Insert(Movimiento $data){
		
		try  {
			$sql="INSERT INTO tbl_movimiento (idUsuario,fecha,hora,cantidad,observacion,idmaterial,idLogAcciones)
								VALUES(?,?,?,?,?,?,?)";
			$this->pdo->prepare($sql)
				->execute(
					array(
					$data->idUsuario,
					$data->fecha,
					$data->hora,
					$data->cantidad,
					$data->observacion,
					$data->idmaterial,
					$data->idLogAcciones
					)
				);
				}
		catch (Exception $e) {	die($e->getMessage());			 }
		}

        public function Update(Movimiento $data){

            try   {

                $sql= "UPDATE tbl_movimiento SET idUsuario=?,fecha=?,hora=?,cantidad=?,observacion=?,idmaterial=?,idLogAcciones=? WHERE id=?;";
                $this->pdo->prepare($sql)
					->execute(
						array(
							$data->idUsuario,
							$data->fecha,
							$data->hora,
							$data->cantidad,
							$data->observacion,
							$data->idmaterial,
							$data->idLogAcciones,
							$data->id
						)
					); 
            }catch (Exception $e) {
                die($e->getMessage());
            
            }
        }

		public function Delete(Movimiento $data){
			try {
				$sql="UPDATE tbl_movimiento SET eliminadoPor=?,eliminadoDateTime=? WHERE id=?;";
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