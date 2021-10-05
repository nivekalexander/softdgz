<?php

require_once('./models/movimiento.php');
require_once("./models/logacciones.php");

class MovimientoController
{	
	private $movimiento;

	function __Construct()	{
		$this->movimiento = new Movimiento();
		$this->logacciones = new Logacciones();
	}
	public function Seleccionar()
	{

		$this->movimiento->Select();

	}
	public function Insertar()
	{
		$datos= $this->movimiento;

		$datos->idUsuario=$_REQUEST['idusuario'];
        $datos->fecha=$_REQUEST['fecha'];
        $datos->hora=$_REQUEST['hora'];
        $datos->cantidad=$_REQUEST['cantidad'];
        $datos->observacion=$_REQUEST['observacion'];
        $datos->idmaterial=$_REQUEST['idmaterial'];
		//logacciones datos
		$datos2=$this->logacciones;
		$datos2->creadoPor=$_REQUEST['iduserlogin'];//iduserlogin se usara como global

		$datos->idLogAcciones=$this->logacciones->Insert($datos2);


		$this->movimiento->Insert($datos);
																				

	}										

	public function Eliminar()
	{	

		$datos= $this->logacciones;
		$datos->eliminadoPor=$_REQUEST['iduserlogin'];
		$datos->id=$_REQUEST['idlogaccion'];

		$this->logacciones->Delete($datos);
	}

	public function Actualizar()
	{
		$datos = $this->movimiento;
		$datos2 = $this->logacciones;

		$datos->nombre=$_REQUEST['nombre'];
		$datos->precioVenta=$_REQUEST['precioVenta'];
		$datos->precioCompra=$_REQUEST['precioCompra'];
		$datos->cantidad=$_REQUEST['cantidad'];
		$datos->precioProduccion=$_REQUEST['precioProduccion'];
		$datos->observacion=$_REQUEST['observacion'];
		$datos->id=$_REQUEST['idmovimiento'];	

		$datos2->actualizadoPor=$_REQUEST['iduserlogin'];
		$datos2->idLogAcciones=$_REQUEST['idlogaccion'];

		$this->logacciones->Update($datos2);
		$this->movimiento->Update($datos);
	}

}

?>