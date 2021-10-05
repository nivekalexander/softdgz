<?php

require_once("./models/comprador.php");

class CompradorController
{	
    private $comprador;
    private $logacciones;
    function __Construct()	{
    $this->comprador = new Comprador();
    }
    public function Select()
	{

		$this->comprador->Select();

	}
    public function Insertar()
    {
        $datos= $this->comprador;
        $datos->nombre=$_REQUEST['nombre'];
        $datos->direccion=$_REQUEST['direccion'];
        $datos->telefono=$_REQUEST['telefono'];
        $datos->saldo=$_REQUEST['saldo'];
        $datos->observacion=$_REQUEST['observacion'];
       
        $this->comprador->Insert($datos);
    }										

    public function Eliminar()
    {	
        $id=$_REQUEST['id'];
        $this->comprador->Delete($id);

    }

    public function Actualizar()
    {
        $datos= $this->comprador;
        $datos->nombre=$_REQUEST['nombre'];
        $datos->direccion=$_REQUEST['direccion'];
        $datos->telefono=$_REQUEST['telefono'];
        $datos->saldo=$_REQUEST['saldo'];
        $datos->observacion=$_REQUEST['observacion'];
        $datos->id=$_REQUEST['id'];
        $this->comprador->Update($datos);

        
    }

}

?>