<?php

	class Venta
	{
		private $pdo;

		public function __Construct(){
            try  				 {	$this->pdo=Database::Conectar(); }
            catch (Exception $e) {	die($e->getMessage());			 }
		}

		public function Select(){
            try  {
                $sql=$this->pdo->prepare("SELECT * FROM tbl_venta ORDER BY id DESC");
                $sql->execute( );
                return $sql->fetchALL(PDO::FETCH_OBJ);
            }
            catch (Exception $e) {	die($e->getMessage());			 }
		}


		public function Insert(Venta $data){
		
            try  {
                $sql="INSERT INTO tbl_venta (numeroFactura,fecha,idTipoPago,observacion,precioVenta,cantidad,idLogAcciones,idComprador,idMaterial,idUsuario)
                    VALUES(?,?,?,?,?,?,?,?,?,?)";
                $this->pdo->prepare($sql)
                ->execute(
                    array(
                        $data->numeroFactura,
                        $data->fecha,
                        $data->idTipoPago,
                        $data->observacion,
                        $data->precioVenta,
                        $data->cantidad,
                        $data->idLogAcciones,
                        $data->idComprador,
                        $data->idMaterial,
                        $data->idUsuario
                    )
                );
            }
            catch (Exception $e) {	die($e->getMessage());			 }
		}

        public function Update(Venta $data){

            try   {

                $sql= "UPDATE tbl_venta SET numeroFactura=?,fecha=?,idTipoPago=?,observacion=?,precioVenta=?,cantidad=?,idLogAcciones=?,idComprador=?,idMaterial=?,idUsuario=? WHERE id=?;";
                $this->pdo->prepare($sql)
					->execute(
						array(
							$data->numeroFactura,
                            $data->fecha,
                            $data->idTipoPago,
                            $data->observacion,
                            $data->precioVenta,
                            $data->cantidad,
                            $data->idLogAcciones,
                            $data->idComprador,
                            $data->idMaterial,
                            $data->idUsuario,
                            $data->id
						)
					); 
            }catch (Exception $e) {
                die($e->getMessage());
            }
        }

		public function subtractMaterial(Venta $data){
			try {
				$sql="UPDATE tbl_material SET cantidad=cantidad-? WHERE id=?";
				$this->pdo->prepare($sql)
                ->execute(
                    array(
                        $data->cantidad,
                        $data->id
                    )
                );
			}
			catch (Exception $e) {	die($e->getMessage());			 }
		}



	}
?>