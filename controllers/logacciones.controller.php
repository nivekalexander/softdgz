<?php

require_once('./models/logacciones.php');

class LogaccionesController
{	
	private $logacciones;

	function __Construct()	{
		$this->logacciones = new Logacciones();
	}
	public function Select()
	{

		$this->logacciones->Select();

	}
	public function Insertar()
	{
		$datos= $this->logacciones;

		$datos->creadoPor 	= $_REQUEST['creadoPor'];																	
		$datos->creadoPor 	= $_REQUEST['creadoDateTime'];	

		$this->logacciones->Insert($datos);

	}										

	public function Eliminar()
	{	

		$datos= $this->logacciones;
		$datos->eliminadoPor 	= $_REQUEST['eliminadoPor'];																	
		$datos->eliminadoDateTime= $_REQUEST['eliminadoDateTime'];	
		$datos->id= $_REQUEST['id'];	

		$this->logacciones->Delete($datos);

	}

	public function Actualizar()
	{

		$datos= $this->logacciones;
		$datos->actualizadoPor 	= $_REQUEST['actualizadoPor'];																	
		$datos->actualizadoDateTime= $_REQUEST['actualizadoDateTime'];	
		$datos->id= $_REQUEST['id'];	

		$this->logacciones->Update($datos);

	}

}

?>