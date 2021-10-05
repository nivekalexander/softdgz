<?php

	class Produccion
	{
		private $pdo;

		public function __Construct(){
		try  				 {	$this->pdo=Database::Conectar(); }
		catch (Exception $e) {	die($e->getMessage());			 }
		}

		public function Select(){
	    try  {
			$sql=$this->pdo->prepare("SELECT * FROM tbl_produccion ORDER BY id DESC");
			$sql->execute();
			return $sql->fetchALL(PDO::FETCH_OBJ);
		}
		catch (Exception $e) {	die($e->getMessage());			 }
		}


		public function Insert(Produccion $data){
		
		try  {
			$sql="INSERT INTO tbl_produccion (cantidad,fecha,hora,idLogAcciones,idMaterial,idTurno,idUsuario,observacion)
								VALUES(?,?,?,?,?,?,?,?)";
			$this->pdo->prepare($sql)
				->execute(
					array(
					$data->cantidad,
                    $data->fecha,
                    $data->hora,
                    $data->idLogAcciones,
                    $data->idMaterial,
                    $data->idTurno,
                    $data->idUsuario,
                    $data->observacion
					)
				);
				}
		catch (Exception $e) {	die($e->getMessage());			 }
		//despues de realizar esta accion ejecuta logAcciones
		}
		

        public function Update(Produccion $data){

            try   {

                $sql= "UPDATE tbl_produccion SET cantidad=?,fecha=?,hora=?,idLogAcciones=?,idMaterial=?,idTurno=?,idUsuario=?,observacion=? WHERE id=?;";
                $this->pdo->prepare($sql)
					->execute(
						array(
							$data->cantidad,
                            $data->fecha,
                            $data->hora,
                            $data->idLogAcciones,
                            $data->idMaterial,
                            $data->idTurno,
                            $data->idUsuario,
                            $data->observacion,
                            $data->id						)
					); 
            }catch (Exception $e) {
                die($e->getMessage());
            
            }
			//despues de realizar esta accion ejecuta logAcciones
        }

		public function Delete(Produccion $data){
			//cambiar estado a eliminado
			try {
				$sql="UPDATE tbl_produccion SET eliminadoPor=?,eliminadoDateTime=? WHERE id=?;";
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