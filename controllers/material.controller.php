<?php

require_once('./models/material.php');
require_once("./models/logacciones.php");

class MaterialController
{	
	private $material;

	function __Construct()	{
		$this->material = new Material();
		$this->logacciones = new Logacciones();
	}
	public function Select()
	{

		$this->material->Select();

	}
	public function Insertar()
	{
		$datos= $this->material;

		$datos->nombre= $_REQUEST['nombre'];
		$datos->precioVenta= $_REQUEST['precioVenta'];
		$datos->precioCompra= $_REQUEST['precioCompra'];
		$datos->cantidad= $_REQUEST['cantidad'];
		$datos->precioProduccion= $_REQUEST['precioProduccion'];
		$datos->observacion= $_REQUEST['observacion'];
		
		//logacciones datos
		$datos2=$this->logacciones;
		$datos2->creadoPor=$_REQUEST['iduserlogin'];//iduserlogin se usara como global

		$datos->idLogAcciones=$this->logacciones->Insert($datos2);


		$this->material->Insert($datos);
																				

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
		$datos = $this->material;
		$datos2 = $this->logacciones;

		$datos->nombre=$_REQUEST['nombre'];
		$datos->precioVenta=$_REQUEST['precioVenta'];
		$datos->precioCompra=$_REQUEST['precioCompra'];
		$datos->cantidad=$_REQUEST['cantidad'];
		$datos->precioProduccion=$_REQUEST['precioProduccion'];
		$datos->observacion=$_REQUEST['observacion'];
		$datos->id=$_REQUEST['idMaterial'];	

		$datos2->actualizadoPor=$_REQUEST['iduserlogin'];
		$datos2->idLogAcciones=$_REQUEST['idlogaccion'];

		$this->logacciones->Update($datos2);
		$this->material->Update($datos);
	}

}

?>