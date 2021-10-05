<?php

	class Material
	{
		private $pdo;

		public function __Construct(){
		try  				 {	$this->pdo=Database::Conectar(); }
		catch (Exception $e) {	die($e->getMessage());			 }
		}

		public function Select(){
	    try  {
			$sql=$this->pdo->prepare("SELECT * FROM tbl_material ORDER BY id DESC");
			$sql->execute();
			return $sql->fetchALL(PDO::FETCH_OBJ);
		}
		catch (Exception $e) {	die($e->getMessage());			 }
		}


		public function Insert(Material $data){
		
		try  {
			$sql="INSERT INTO tbl_material (nombre,precioVenta,precioCompra,cantidad,precioProduccion,observacion,idLogAcciones)
								VALUES(?,?,?,?,?,?,?)";
			$this->pdo->prepare($sql)
				->execute(
					array(
					$data->nombre,
					$data->precioVenta,
					$data->precioCompra,
					$data->cantidad,
					$data->precioProduccion,
					$data->observacion,
					$data->idLogAcciones
					)
				);
				}
		catch (Exception $e) {	die($e->getMessage());			 }
		}

        public function Update(Material $data){

            try   {

                $sql= "UPDATE tbl_material SET nombre=?,precioVenta=?,precioCompra=?,cantidad=?,precioProduccion=?,observacion=? WHERE id=?;";
                $this->pdo->prepare($sql)
					->execute(
						array(
							$data->nombre,
							$data->precioVenta,
							$data->precioCompra,
							$data->cantidad,
							$data->precioProduccion,
							$data->observacion,
							$data->id
						)
					); 
            }catch (Exception $e) {
                die($e->getMessage());
            
            }
        }

		public function sumMaterial(Material $data){
			try {
				$sql="UPDATE tbl_material SET cantidad=cantidad+? WHERE id=?;";
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
		public function resMaterial(Material $data){
			try {
				$sql="UPDATE tbl_material SET cantidad=cantidad-? WHERE id=?;";
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
		public function updateMaterial(Material $data){
			try {
				$sql="UPDATE tbl_material SET cantidad=cantidad-? WHERE id=?;";
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