<?php

require_once('./models/compras.php');
require_once("./models/logacciones.php");
require_once("./models/material.php");

class ComprasController
{	
	private $compras;

	function __Construct()	{

		$this->compras = new Compras();
		$this->logacciones = new Logacciones();
		$this->material = new Material();

	}
	public function Select()
	{

		$this->compras->Select();

	}
	public function Insertar()
	{
		// $datos representa variables para la tabla compra
		// $data2 representa datos para logacciones
		// $data3 representa datos para material
		$datos= $this->compras;
		$datos->cantidad=$_REQUEST['cantidad'];
		$datos->fecha=$_REQUEST['fecha'];
		
		$datos->idMaterial=$_REQUEST['idMaterial'];
		$datos->idProveedor=$_REQUEST['idProveedor'];
		$datos->idTipoPago=$_REQUEST['idTipoPago'];
		$datos->numeroFactura=$_REQUEST['numeroFactura'];
		$datos->observacion=$_REQUEST['observacion'];
		$datos->precioVenta=$_REQUEST['precioVenta'];

		//logacciones datos
		$datos2=$this->logacciones;
		$datos2->creadoPor=$_REQUEST['iduserlogin'];//iduserlogin se usara como global
		
		$datos->idLogAcciones=$this->logacciones->Insert($datos2);

		$this->compras->Insert($datos);

		//datos para la tabla material
		$datos3=$this->material;
		$datos3=$datos->cantidad;
		$datos3=$datos->idMaterial

		$this->material->sumMaterial($datos3);
																				
	}										

	public function Eliminar()
	{	
		
		$datos= $this->logacciones;
		$datos2= $this->material;

		$datos2->idMaterial=$_REQUEST['idMaterial'];
		$datos2->cantidad=$_REQUEST['cantidad'];

		$this->material->resMaterial($datos2);

		$datos->eliminadoPor=$_REQUEST['iduserlogin'];
		$datos->idLogAcciones=$_REQUEST['idlogaccion'];

		$this->logacciones->Delete($datos);

	}

	public function Actualizar()
	{
		

		$datos3= $this->logacciones;
		$datos2= $this->material;
		
		$datos= $this->compras;

		$datos->id=$_REQUEST['idCompra'];
		$datos->fecha=$_REQUEST['fecha'];
		$datos->idMaterial=$_REQUEST['idMaterialAnterior'];
		$datos->idProveedor=$_REQUEST['idProveedor'];
		$datos->idTipoPago=$_REQUEST['idTipoPago'];
		$datos->numeroFactura=$_REQUEST['numeroFactura'];
		$datos->observacion=$_REQUEST['observacion'];
		$datos->precioVenta=$_REQUEST['precioVenta'];

		$datos2->idMaterial=$datos->idMaterial;
		$datos2->cantidad=$_REQUEST['cantidadAnterior'];
		

		$this->material->resMaterial($datos2);

		$datos->idMaterial=$_REQUEST['idMaterialActual'];

		$datos2->idMaterial=$datos->idMaterial;
		$datos2->cantidad=$_REQUEST['cantidadActual'];
		
		$datos->cantidad=$datos2->cantidad;

		$this->material->sumMaterial($datos2);

		$datos3->actualizadoPor=$_REQUEST['iduserlogin'];
		$datos3->idLogAcciones=$_REQUEST['idlogaccion'];

		$this->logacciones->Update($datos3);

		$this->compras->Update($datos);

	}

}

?>